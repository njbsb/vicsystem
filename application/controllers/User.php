<?php
class User extends CI_Controller
{
    public function index()
    {
        $usertype = $this->session->userdata('user_type');
        if ($usertype == 'student') {
            redirect('home');
        }
        if ($usertype == 'mentor') {
            $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
            $users = $this->user_model->get_user('', $sig_id);
        } elseif ($usertype == 'admin') {
            $users = $this->user_model->get_user();
        }
        $data = array(
            'title' => 'Manage Users',
            'users' => $users
        );
        print_r($data['users']);
        $this->load->view('templates/header');
        $this->load->view('user/index', $data);
        // $this->load->view('templates/footer');
    }

    public function login()
    {
        if ($this->session->userdata('username')) {
            redirect(site_url());
        }
        $this->form_validation->set_rules('username', 'username', 'required|callback_id_active');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Login'
            );
            $this->load->view('templates/header');
            $this->load->view('user/login', $data);
        } else {

            # user clicked on Login
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $user_id = $this->user_model->login($username, $password);
            if ($user_id) {
                # successful login
                $user_data = array(
                    'username' => $user_id,
                    'user_type' => $this->user_model->get_usertype($user_id),
                    'isMentor' => false,
                    'isStudent' => false,
                    'isAdmin' => false,
                    // 'isMentor' => $this->user_model->get_mentor_status($user_id),
                    // 'isStudent' => $this->user_model->get_student_status($user_id),
                    // 'isAdmin' => $this->user_model->get_admin_status($user_id),
                    'logged_in' => true
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in as ' . $user_id);
                redirect(site_url());
            } else {
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('login');
            }
        }
    }

    public function register()
    {
        $usertype = $this->input->post('usertype');
        if (!$usertype) {
            redirect('login');
        }
        # if user didnt select either mentor or student from login page, he will be redirected to login page again

        # VALUE RETRIEVAL
        # this will return no value if we came from login page
        # but will return value if we submit registration form
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $sig_id = $this->input->post('sig_id');
        $dob = $this->input->post('dob');

        $mentor = 'mentor';
        $student = 'student';
        // $mentor_typeid = $this->user_model->get_mentor_usertype_id();
        // $student_typeid = $this->user_model->get_student_usertype_id();

        if ($usertype == $mentor) {
            $position = $this->input->post('position');
            $roomnum = $this->input->post('roomnum');
            $orgrole_id = $this->input->post('orgrole_id');
        } elseif ($usertype == $student) {
            $program_code = $this->input->post('program_code');
            $phonenum = $this->input->post('phonenum');
        }
        # END VALUE RETRIEVAL

        # VALIDATION OF REGISTRATION FORM
        if ($id && $name && $email && $password && $sig_id && $dob) {
            $this->form_validation->set_rules('id', 'ID', 'required|callback_id_exist');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'matches[password]');
            if ($usertype == $mentor && $position && $roomnum && $orgrole_id) {
                $this->form_validation->set_rules('position', 'Position', 'required');
                $this->form_validation->set_rules('roomnum', 'Room number', 'required');
                $this->form_validation->set_rules('orgrole_id', 'Organization role', 'required');
            } elseif ($usertype == $student && $program_code && $phonenum) {
                $this->form_validation->set_rules('program_code', 'Program', 'required');
                $this->form_validation->set_rules('phonenum', 'Phone Number', 'required');
            }
        }
        # END VALIDATION

        if ($this->form_validation->run() === FALSE) {
            # ON FIRST LANDING TO REGISTRATION FORM
            # NO REGISTRATION DATA IS SUBMITTED

            if ($usertype) {
                # if user selected either 'mentor' or 'student' from login page
                // $data['usertype_name'] = ucfirst($this->user_model->get_usertypename($usertype));
                $data['usertype_name'] = ucfirst($usertype);
            } else {
                redirect('login');
            }
            $data['usertype'] = $usertype; # this is to be sent as value in the registration form
            $data['title'] = 'Register' . ' ' . ucfirst($usertype);
            $data['sigs'] = $this->sig_model->get_sig();

            # this will fetch data from previously filled registration form when validation error occurs
            $data['id'] = $id;
            $data['name'] = $name;
            $data['email'] = $email;
            $data['sig_id'] = $sig_id;
            $data['dob'] = $dob;
            // $data['program_code'] = $program_code;

            $this->load->view('templates/header');

            if ($usertype == $mentor) {
                // MENTOR
                $data['position'] = $position;
                $data['roomnum'] = $roomnum;
                $data['orgrole_id'] = $orgrole_id;
                $data['mentorroles'] = $this->role_model->get_mentor_roles();
                $this->load->view('user/mentor/register', $data);
            } elseif ($usertype == $student) {
                // STUDENT
                $data['program_code'] = $program_code;
                $data['phonenum'] = $phonenum;
                $data['programs'] = $this->program_model->get_programs();
                $this->load->view('user/student/register', $data);
            }
        } else {
            # INSERT DATA TO DB
            $enc_password = md5($this->input->post('password'));
            $userdata = array(
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => $enc_password,
                'sig_id' => $sig_id,
                'usertype_id' => $usertype,
                'dob' => $dob
            );
            $this->user_model->register_user($userdata);

            if ($usertype == $mentor_typeid) {
                # send data to mentor model
                $mentordata = array(
                    'matric' => $id,
                    'position' => $position,
                    'roomnum' => $roomnum,
                    'orgrole_id' => $orgrole_id
                );
                $this->mentor_model->register_mentor($mentordata);
            } elseif ($usertype = $student_typeid) {
                # send data to student model
                $studentdata = array(
                    'matric' => $id,
                    'phonenum' => $phonenum,
                    'program_code' => $program_code
                );
                $this->student_model->register_student($studentdata);
            }
            $data['title'] = 'Registration Successful';
            $data['content'] = 'Your registration is currently pending admin\'s approval. Your admin will contact you once your registration is approved';
            $this->load->view('templates/header');
            $this->load->view('user/register_success', $data);
        }
    }

    public function profile()
    {
        $id = $this->session->userdata('username');
        $user = $this->user_model->get_user($id);
        $sig_id = $user['sig_id'];
        $usertype = $user['usertype'];
        $this->load->view('templates/header');
        switch ($usertype) {
            case 'admin':
                $data = array(
                    'title' => 'User Profile',
                    'user' => $user,
                    'admin' => $this->admin_model->get_admin($id)
                );
                $this->load->view('user/admin/profile', $data);
                break;
            case 'mentor':
                $data = array(
                    'title' => 'User Profile',
                    'user' => $user,
                    'mentor' => $this->mentor_model->get_mentor($id),
                    'activity_roles' => $this->committee_model->get_activityroles($id)
                );
                $this->load->view('user/mentor/profile', $data);
                break;
            case 'student':
                $data = array(
                    'title' => 'User Profile',
                    'user' => $user,
                    'student' => $this->student_model->get_student($id),
                    'activity_roles' => $this->committee_model->get_activityroles($id),
                    'org_roles' => $this->committee_model->get_orgroles($id, $sig_id)
                );
                $data['student']['year'] = date('Y') - $data['student']['yearjoined'] + 1;
                $this->load->view('user/student/profile', $data);
                break;
        }
    }

    public function edit()
    {
        $id = $this->session->userdata('username'); # get the current session user 
        if (!$id) {
            redirect('home');
        }
        $user = $this->user_model->get_user($id);
        $usertype = $user['usertype'];
        $data = array(
            'title' => 'Update Profile',
            'sigs' => $this->sig_model->get_sig(),
            'programs' => $this->program_model->get_programs(),
            'mentors' => $this->mentor_model->get_mentor(),
            'usertype' => $usertype
        );
        $this->load->view('templates/header');
        switch ($usertype) {
            case 'admin':
                $data['admin'] = $this->admin_model->get_admin($id);
                $this->load->view('user/admin/update', $data);
                break;
            case 'mentor':
                $data['mentor'] = $this->mentor_model->get_mentor($id);
                $this->load->view('user/mentor/update', $data);
                break;
            case 'student':
                $data['student'] = $this->student_model->get_student($id);
                $this->load->view('user/student/update', $data);
                break;
        }
    }

    public function update($user_id)
    {
        $usertype_id = $this->user_model->get_usertype_id($user_id);
        $config = array(
            'upload_path' => './assets/images/profile',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 500,
            'max_width' => 2048,
            'max_height' => 2048,
            'file_name' => $user_id . '-' . substr(md5(rand()), 0, 10)
        );
        $this->load->library('upload', $config);

        if (@$_FILES['profile_image']['name'] != NULL) {
            if ($this->upload->do_upload('profile_image')) {
                $profile_image = $this->upload->data('file_name');
            } else {
                $profile_image = 'default.jpg';
            }
        }
        switch ($usertype_id) {
            case '1':
                //
                break;
            case '2':
                $userdata = array('profile_image' => $profile_image);
                $this->user_model->update_user($user_id, $userdata);
                $mentordata = array('roomnum' => $this->input->post('roomnum'));
                $this->mentor_model->update_mentor($user_id, $mentordata);
                break;
            case '3':
                $userdata = array('profile_image' => $profile_image);
                $this->user_model->update_user($user_id, $userdata);
                $studentdata = array('phonenum' => $this->input->post('phonenum'));
                $this->student_model->update_student($user_id, $studentdata);
                break;
        }
        redirect('profile');
    }

    public function delete($id)
    {
        $usertype_id = $this->user_model->get_usertype($id);
        if ($usertype_id) {
            switch ($usertype_id) {
                case 1:
                    # admin
                    $this->admin_model->delete_admin($id);
                    break;
                case 2:
                    # mentor
                    $this->mentor_model->delete_mentor($id);
                    break;
                case 3:
                    # student
                    $this->student_model->delete_student($id);
                    break;
            }
            $this->user_model->delete_user($id);
        }
        redirect('user');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('isStudent');
        $this->session->unset_userdata('isMentor');
        $this->session->unset_userdata('isAdmin');
        $this->session->set_flashdata('logged_out', 'You have successfully logged out!');
        redirect('login');
    }

    public function id_exist($id)
    {
        $id_exist = $this->user_model->id_exist($id);
        if ($id_exist == true) {
            $this->form_validation->set_message('id_exist',  'User already exists. Please select another ID');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function id_active($id)
    {
        $id_active = $this->user_model->id_active($id);
        if ($id_active == false) {
            $this->form_validation->set_message('id_active', "This user's account is either disabled or has not been validated yet. Contact your admin.");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function validate($id)
    {
        $data['title'] = 'Validate: ' . $id;
        $data['user'] = $this->user_model->get_user($id);
        $usertype = $data['user']['usertype'];
        // validate
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('sig_id', 'SIG', 'required');
        if ($usertype == 'mentor') {
            $this->form_validation->set_rules('position', 'Position', 'required');
            $this->form_validation->set_rules('roomnum', 'Room Number', 'required');
            $this->form_validation->set_rules('orgrole_id', 'SIG Role', 'required');
        } elseif ($usertype == 'student') {
            $this->form_validation->set_rules('phonenum', 'Phone Number', 'required');
            $this->form_validation->set_rules('program_code', 'Program Code', 'required');
            $this->form_validation->set_rules('mentor_matric', 'Mentor Matric', 'required');
        }

        if ($this->form_validation->run() === FALSE) {

            $data['sigs'] = $this->sig_model->get_sig();
            $data['userstatuses'] = $this->user_model->get_userstatus();
            $this->load->view('templates/header');
            $this->load->view('user/validate', $data);

            if ($usertype == 'mentor') {
                # IF MENTOR
                $data['mentorroles'] = $this->role_model->get_mentor_roles();
                $data['mentor'] = $this->mentor_model->get_mentor($id);
                $this->load->view('user/mentor/validate_mentor', $data);
            } elseif ($usertype == 'student') {
                # IF STUDENT
                $data['sigmentors'] = $this->mentor_model->get_sigmentors($data['user']['sig_id']);
                $data['programs'] = $this->program_model->get_programs();
                $data['student'] = $this->student_model->get_student($id);
                $this->load->view('user/student/validate_student', $data);
            }
            $this->load->view('templates/footer');
        } else {
            # FORM SUBMISSION HERE
            $userdata = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'sig_id' => $this->input->post('sig_id'),
                'dob' => $this->input->post('dob'),
                'userstatus_id' => $this->input->post('userstatus_id')
            );
            if ($usertype == 'mentor') {
                $mentordata = array(
                    'position' => $this->input->post('position'),
                    'roomnum' => $this->input->post('roomnum'),
                    'orgrole_id' => $this->input->post('orgrole_id'),
                );
                if ($this->mentor_model->mentor_exist($id)) {
                    $this->mentor_model->update_mentor($id, $mentordata);
                } else {
                    $this->mentor_model->register_mentor($mentordata);
                }
            } elseif ($usertype == 'student') {
                $studentdata = array(
                    'matric' => $id,
                    'phonenum' => $this->input->post('phonenum'),
                    'program_code' => $this->input->post('program_code'),
                    'mentor_matric' => $this->input->post('mentor_matric')
                );
                if ($this->student_model->student_exist($id)) {
                    $this->student_model->update_student($id, $studentdata);
                } else {
                    $this->student_model->register_student($studentdata);
                }
            }
            $this->user_model->update_user($id, $userdata);
            redirect('user');
        }
    }

    public function set_userstatus($user_id)
    {
    }
}
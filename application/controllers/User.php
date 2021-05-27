<?php
defined('BASEPATH') or exit('No direct script access allowed!');
require FCPATH . 'vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use SebastianBergmann\Diff\Diff;

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

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
            $usertype = $this->user_model->get_usertype($username);
            $user = $this->user_model->get_user($username);
            if ($user['userstatus'] != 'active') {
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('login');
            }
            $user_id = $this->user_model->login($username, $password);
            if ($user_id) {
                # successful login
                $user_data = array(
                    'username' => $user_id,
                    'user_type' => $usertype,
                    'logged_in' => true,
                    'userphoto' => $user['userphoto']
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
        $dob = $this->input->post('dob');
        $gender = $this->input->post('gender');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        # REGISTER SHOULD ONLY LIMIT TO USER TABLE AND BASIC INFO ONLY
        # END VALUE RETRIEVAL

        # VALIDATION OF REGISTRATION FORM
        if ($id && $name && $email && $password && $dob) {
            $this->form_validation->set_rules('id', 'ID', 'required|callback_id_exist');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'matches[password]');
        }

        if ($this->form_validation->run() === FALSE) {
            # ON FIRST LANDING TO REGISTRATION FORM
            # NO REGISTRATION DATA IS SUBMITTED
            $data = array(
                'usertype' => $usertype,
                'title' => 'Register as' . ' ' . ucfirst($usertype),
                'id' => $id,
                'name' => $name,
                'dob' => $dob,
                'gender' => $gender,
                'email' => $email
            );
            # this will fetch data from previously filled registration form when validation error occurs

            $this->load->view('templates/header');
            $this->load->view('user/register', $data);
        } else {
            # INSERT DATA TO DB
            $enc_password = md5($this->input->post('password'));
            $userdata = array(
                'id' => $id,
                'name' => $name,
                'usertype' => $usertype,
                'dob' => $dob,
                'gender' => $gender,
                'email' => $email,
                'password' => $enc_password
            );
            $this->user_model->register_user($userdata);

            $data = array(
                'title' => 'Registration Successful',
                'content' => 'Your registration is currently pending your admin\'s approval. Your admin will inform you once your registration is approved'
            );
            $this->load->view('templates/header');
            $this->load->view('user/register_success', $data);
        }
    }

    public function validate($id)
    {
        # user = user to be validated
        $data = array(
            'title' => 'Validate: ' . $id,
            'user' => $this->user_model->get_user($id),
            'userstatus' => $this->user_model->get_userstatus(),
            'mentors' => $this->mentor_model->get_mentor(),
            'superior' => $this->user_model->get_user_superior($id)
        );
        // validate
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('dob', 'date of birth', 'required');
        $this->form_validation->set_rules('userstatus', 'user status', 'required');

        if ($this->form_validation->run() === FALSE) {
            # ADMIN VALIDATES THE NEW USER
            $this->load->view('templates/header');
            $this->load->view('user/validate', $data);
        } else {
            # ADMIN SUBMITS FORM
            $superior_id = $this->input->post('superior_id');
            if (!isset($superior_id)) {
                $superior_id = NULL;
            }
            $userdata = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'dob' => $this->input->post('dob'),
                'userstatus' => $this->input->post('userstatus'),
                'superior_id' => $superior_id
            );
            $this->user_model->update_user($id, $userdata);
            redirect('user');
        }
    }

    public function profile()
    {
        $id = $this->session->userdata('username');
        $user = $this->user_model->get_user($id);
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
                $mentor = $this->mentor_model->get_mentor($id);
                if (!isset($mentor)) {
                    $mentor = array(
                        'matric' => '',
                        'position' => '',
                        'roomnum' => ''
                    );
                }
                $data = array(
                    'title' => 'User Profile',
                    'user' => $user,
                    'mentor' => $mentor,
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
                    'org_roles' => $this->committee_model->get_orgroles($id)
                );
                // $data['student']['year'] = date('Y') - $data['student']['yearjoined'] + 1;
                $yearjoined = $data['student']['yearjoined'];
                if (date('Y') - $yearjoined + 1 > 4) {
                    $duration = '(' . $yearjoined . ' - ' . ($yearjoined + 4) . ')';
                    $data['student']['year'] = 'Alumni ' . $duration;
                } else {
                    $data['student']['year'] = date('Y') - $yearjoined + 1;
                }
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
            'programs' => $this->program_model->get_programs(),
            'superior' => $this->user_model->get_user_superior($id),
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
                $data['roles'] = $this->role_model->get_mentor_roles();
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
        $usertype = $this->user_model->get_usertype($user_id);
        $usertype = $this->session->userdata('user_type');
        # upload photo logics
        $upload_file = $_FILES['userphoto']['tmp_name'];
        if ($upload_file) {
            $data = file_get_contents($upload_file);
            $type = pathinfo($_FILES["userphoto"]["name"], PATHINFO_EXTENSION);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $userdata = array(
                'userphoto' => $base64
            );
            $this->user_model->update_user($user_id, $userdata);
        }
        # specific for each user
        switch ($usertype) {
            case 'admin':
                //
                break;
            case 'mentor':
                // $upload_file = $_FILES['userphoto']['tmp_name'];
                // if ($upload_file) {
                //     $data = file_get_contents($upload_file);
                //     $type = pathinfo($_FILES["userphoto"]["name"], PATHINFO_EXTENSION);
                //     $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                //     $userdata = array(
                //         'userphoto' => $base64
                //     );
                //     $this->user_model->update_user($user_id, $userdata);
                // }
                $role_id = $this->input->post('role_id');
                $roomnum = $this->input->post('roomnum');
                $position = $this->input->post('position');
                if ($role_id and $roomnum and $position) {
                }
                $mentordata = array(
                    'matric' => $user_id,
                    'role_id' => $this->input->post('role_id'),
                    'roomnum' => $this->input->post('roomnum'),
                    'position' => $this->input->post('position')
                );
                $this->mentor_model->update_mentor($user_id, $mentordata);
                break;
            case 'student':

                $studentdata = array(
                    'matric' => $user_id,
                    'program_id' => $this->input->post('program_id'),
                    'phonenum' => $this->input->post('phonenum'),
                    'parent_num1' => $this->input->post('parent1'),
                    'parent_num2' => $this->input->post('parent2'),
                    'address' => $this->input->post('address')
                );
                $this->student_model->update_student($user_id, $studentdata);
                break;
        }
        redirect('profile');
    }

    public function delete($id)
    {
        $usertype = $this->user_model->get_usertype($id);
        if ($usertype) {
            switch ($usertype) {
                case 'admin':
                    # admin
                    $this->admin_model->delete_admin($id);
                    break;
                case 'mentor':
                    # mentor
                    $this->mentor_model->delete_mentor($id);
                    break;
                case 'student':
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
        $this->session->unset_userdata('user_type');
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

    public function download()
    {
        $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $users = $this->user_model->get_user('', $sig_id);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="hello.xlsx"');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        foreach ($users as $i => $user) {
            $sheet->setCellValue('A' . $i + 1, $user['id']);
            $sheet->setCellValue('B' . $i + 1, $user['name']);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function upload()
    {
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
        switch ($extension) {
            case 'xlsx':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                break;
            case 'xls':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                break;
            case 'csv':
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                break;
        }
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        $sheetcount = count($sheetdata);
        if ($sheetcount > 1) {
            for ($i = 1; $i < $sheetcount; $i++) {
                $id = $sheetdata[$i][0];
                $name = $sheetdata[$i][1];
                $usertype = $sheetdata[$i][2];
                $phonenum = $sheetdata[$i][3];
                $dob = $sheetdata[$i][4];
                $gender = $sheetdata[$i][5];
                $email = $sheetdata[$i][6];
                $data[] = array(
                    'id' => $id,
                    'name' => $name,
                    'usertype' => $usertype,
                    'phonenum' => $phonenum,
                    'dob' => $dob,
                    'gender' => $gender,
                    'email' => $email,
                );
            }
            $rowaffected = $this->user_model->import_user($data);
            if ($rowaffected > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">' . $rowaffected . ' rows affected</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">' . $rowaffected . ' rows affected</div>');
            }
            redirect(site_url('academicplan/mentor'));
        }
    }
}
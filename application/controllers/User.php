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
        $today = time();
        switch ($usertype) {
            case 'admin':
            case 'mentor':
                $users = $this->user_model->get_user();
                foreach ($users as $i => $user) {
                    $users[$i]['validationstatus'] = ($user['validated']) ? "<i class='fas fa-check-circle'></i> Validated" : "<i class='fas fa-hourglass-half'></i>  Pending";
                    $users[$i]['validationicon'] = ($user['validated']) ? "<i class='fas fa-check-circle'></i>" : "<i class='fas fa-hourglass-half'></i>";
                    if ($user['usertype'] == 'student') {
                        if ($user['startdate'] and $today >= strtotime($user['startdate'])) {
                            $unistatus = 'On Going';
                            if ($user['enddate'] and $today >= strtotime($user['enddate'])) {
                                $unistatus = 'Graduated';
                            }
                        } else {
                            $unistatus = 'Unregistered';
                        }
                    } else {
                        if ($user['startdate'] and $today > strtotime($user['startdate'])) {
                            $unistatus = 'In Duty';
                            if ($user['enddate'] and $today >= strtotime($user['enddate'])) {
                                $unistatus = 'Retired';
                            }
                        } else {
                            $unistatus = 'Unregistered';
                        }
                    }
                    switch ($user['usertype']) {
                        case 'student':
                            $profileExist = $this->student_model->student_exist($user['id']);
                            break;
                        case 'mentor':
                            $profileExist = $this->mentor_model->mentor_exist($user['id']);
                            break;
                    }
                    $users[$i]['profileicon'] = ($profileExist) ? "<i class='fas fa-check-circle'></i>" : "<i class='fas fa-question-circle'></i>";
                    $users[$i]['profilestatus'] = ($profileExist) ? "Completed" : "Missing";
                    $users[$i]['unistatus'] = $unistatus;
                    $users[$i]['profileexist'] = $profileExist;
                }
                break;
            case 'student':
                redirect('home');
                break;
        }
        $data = array(
            'title' => 'Manage Users',
            'users' => $users
        );
        $this->load->view('templates/header');
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
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
            $this->load->view('templates/footer');
        } else {
            # user clicked on Login
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $usertype = $this->user_model->get_usertype($username);
            $user = $this->user_model->get_user($username);
            if (!$user['validated']) {
                $this->session->set_flashdata('login_failed', 'Login is invalid');
                redirect('login');
            }
            $user_id = $this->user_model->login($username, $password);
            // default password and incomplete profile variable 
            if ($usertype == 'admin') {
                $profileComplete = true;
            } else {
                switch ($usertype) {
                    case 'mentor':
                        $userspecific = $this->mentor_model->get_mentor_profile($username);
                        break;
                    case 'student':
                        $userspecific = $this->student_model->get_student_profile($username);
                        break;
                }
                $profileComplete = (isset($userspecific)) ? true : false;
            }
            $defaultPassword = $this->user_model->check_defaultpassword($username);
            $user = $this->user_model->get_user($username);
            if ($user_id) {
                # successful login
                $user_data = array(
                    'username' => $user_id,
                    'user_type' => $usertype,
                    'logged_in' => true,
                    'userphoto' => $user['userphoto'],
                    'profilecomplete' => $profileComplete,
                    'defaultpassword' => $defaultPassword
                );
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in as ' . $user_id);
                if (md5($username) == $password) {
                    # check if default password is equal to username
                    // redirect('changepassword');
                } else {
                }
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
        $phonenum = $this->input->post('phonenum');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        # REGISTER SHOULD ONLY LIMIT TO USER TABLE AND BASIC INFO ONLY
        # END VALUE RETRIEVAL

        # VALIDATION OF REGISTRATION FORM
        if ($id && $name && $phonenum && $email && $password && $dob) {
            $this->form_validation->set_rules('id', 'ID', 'required|callback_id_exist');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('phonenum', 'phone number', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'matches[password]');
        }
        if ($this->form_validation->run() === FALSE) {
            # ON FIRST LANDING TO REGISTRATION FORM
            # NO REGISTRATION DATA IS SUBMITTED
            $data = array(
                'usertype' => $usertype,
                'title' => 'Sign up as' . ' ' . ucfirst($usertype),
                'id' => $id,
                'name' => $name,
                'dob' => $dob,
                'gender' => $gender,
                'phonenum' => $phonenum,
                'email' => $email
            );
            # this will fetch data from previously filled registration form when validation error occurs
            $this->load->view('templates/header');
            $this->load->view('user/register', $data);
            $this->load->view('templates/footer');
        } else {
            # INSERT DATA TO DB
            $enc_password = md5($password);
            $userdata = array(
                'id' => $id,
                'name' => $name,
                'usertype' => $usertype,
                'dob' => $dob,
                'gender' => $gender,
                'phonenum' => $phonenum,
                'validated' => false,
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
            $this->load->view('templates/footer');
        }
    }

    public function validate($id)
    {
        # user = user to be validated
        $user = $this->user_model->get_user($id);
        if ($user['usertype'] = 'mentor') {
            $mentordata = $this->mentor_model->get_mentor($user['id']);
            $roomno = $mentordata['roomnum'];
        } else {
            $roomno = null;
        }
        $user['status'] = ($user['validated']) ? 'Validated' : 'Pending';
        $data = array(
            'title' => 'Validate: ' . $id,
            'user' => $user,
            'roomno' => $roomno,
            'mentors' => $this->mentor_model->get_mentor(),
            'superior' => $this->user_model->get_user_superior($id)
        );
        // form validation
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('dob', 'date of birth', 'required');
        $this->form_validation->set_rules('phonenum', 'phone number', 'required');
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $this->form_validation->set_rules('startdate', 'join date', 'required');
        if ($user['usertype'] != 'mentor') {
            $this->form_validation->set_rules('enddate', 'leave date', 'required');
        }


        if ($this->form_validation->run() === FALSE) {
            # load validation page
            $this->load->view('templates/header');
            $this->load->view('user/validate', $data);
            $this->load->view('templates/footer');
        } else {
            # form submission
            $superior_id = $this->input->post('superior_id');
            if (!isset($superior_id)) {
                $superior_id = NULL;
            }
            $validatedvalue = $this->input->post('validated');
            $validated = ($validatedvalue) ? true : false;
            $userdata = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phonenum' => $this->input->post('phonenum'),
                'dob' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'superior_id' => $superior_id,
                'startdate' => $this->input->post('startdate'),
                'enddate' => $this->input->post('enddate'),
                'validated' => $validated
            );
            $this->user_model->update_user($id, $userdata);
            if ($user['usertype'] = 'mentor') {
                $mentordata = array('roomnum' => $this->input->post('roomno'));
                if ($this->input->post('roomno') != null) {
                    $this->mentor_model->update_mentor($id, $mentordata);
                }
            }
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
                    'admin' => $this->user_model->get_user($id)
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
                    'activity_roles' => $this->committee_model->get_mentor_activityroles($id)
                );
                $this->load->view('user/mentor/profile', $data);
                break;
            case 'student':
                $student = $this->student_model->get_student($id);
                $yearjoined = $student['yearjoined'];
                $year = date('Y') - $yearjoined + 1;
                $duration = sprintf('(%s - %s)', $yearjoined, $yearjoined + 4);
                $student['year'] = ($year > 4) ? 'Alumni ' . $duration : $year;
                $data = array(
                    'title' => 'User Profile',
                    'user' => $user,
                    'student' => $student,
                    'activity_roles' => $this->committee_model->get_activityroles($id),
                    'org_roles' => $this->committee_model->get_orgroles($id)
                );
                $this->load->view('user/student/profile', $data);
                break;
        }
        $this->load->view('templates/footer');
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
                // $data['admin'] = $this->user_model->get_user($id);
                // $this->load->view('user/admin/update', $data);
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
        if ($this->session->userdata['profilecomplete']) {
            $this->load->view('templates/footer');
        }
    }

    public function changepassword()
    {
        if (!$this->session->userdata('username')) {
            redirect(site_url());
        }
        $username = $this->session->userdata('username');

        $this->form_validation->set_rules('password1', 'password 1', 'required');
        $this->form_validation->set_rules('password2', 'password 2', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('user/passwordchange');
            if (!$this->session->userdata('defaultpassword')) {
                $this->load->view('templates/footer');
            }
        } else {
            $password1 = $this->input->post('password1');
            $password2 = $this->input->post('password2');
            if ($password1 != $password2) {
                $this->session->set_flashdata('password_changed', 'Password unmatch');
                redirect('passwordreset');
            } else {
                # tukaq password
                $password = md5($password1);
                $this->user_model->change_password($username, $password);
                $passwordDefault = $this->user_model->check_defaultpassword($username);
                if ($this->session->userdata('defaultpassword') != $passwordDefault) {
                    $this->session->set_userdata('defaultpassword', $passwordDefault);
                }
                $this->session->set_flashdata('password_changed', 'Password changed successfully');
                redirect('home');
            }
        }
    }

    public function resetpassword()
    {
        $userid = $this->input->post('user_id');
        $securitycode = $this->input->post('securitycode');
        if (!$userid or !$securitycode) {
            redirect('login');
        }
        $passwordnew = $this->input->post('password1');
        $passwordconfirm = $this->input->post('password2');
        if ($passwordnew && $passwordconfirm) {
            $this->form_validation->set_rules('password1', 'new password', 'required');
            $this->form_validation->set_rules('password2', 'confirm password', 'required');
        }
        if ($this->form_validation->run() === FALSE) {
            $user = $this->user_model->get_user($userid);
            $this->load->view('templates/header');
            $errorcode = '';
            $erroruser = '';
            $errorstring = '';
            $validated = true;
            if ($user) {
                if ($securitycode != substr($user['phonenum'], -4)) {
                    $errorcode = "wrong security code.";
                    $validated = false;
                }
            } else {
                $erroruser = "user not found";
            }
            $errorstring .= $erroruser;
            $errorstring .= ($errorstring != '' && $errorcode != '') ? $errorstring .= ' & ' . $errorcode : $errorcode;
            $data = array(
                'userid' => $userid,
                'user' => $user,
                'securitycode' => $securitycode,
                'errormessage' => $errorstring,
                'validated' => $validated
            );
            $this->load->view('user/passwordreset', $data);
            $this->load->view('templates/footer');
        } else {
            if ($passwordnew == $passwordconfirm) {
                $encrypted = md5($passwordnew);
                $this->user_model->reset_password($userid, $encrypted);
                print "<script type=\"text/javascript\">alert('Password has been reset. Please login using your new password');</script>";
                redirect('login');
            }
        }
    }

    public function update($user_id)
    {
        $usertype = $this->user_model->get_usertype($user_id);
        $usertype = $this->session->userdata('user_type');
        $userdata = array('phonenum' => $this->input->post('phonenum'));
        # upload photo logics
        $upload_file = $_FILES['userphoto']['tmp_name'];
        if ($upload_file) {
            $data = file_get_contents($upload_file);
            $type = pathinfo($_FILES["userphoto"]["name"], PATHINFO_EXTENSION);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $userdata['userphoto'] = $base64;
            $this->session->set_userdata('userphoto', $base64);
        }
        $this->user_model->update_user($user_id, $userdata);

        $profileExist = false;
        # specific for each user
        switch ($usertype) {
            case 'admin':
                break;
            case 'mentor':
                $role_id = $this->input->post('role_id');
                $roomnum = $this->input->post('roomnum');
                $position = $this->input->post('position');
                if ($role_id and $roomnum and $position) {
                }
                $mentordata = array(
                    'matric' => $user_id,
                    'role_id' => $this->input->post('role_id'),
                    'roomnum' => $this->input->post('roomnum'),
                    'position' => $this->input->post('position'),
                );
                $this->mentor_model->update_mentor($user_id, $mentordata);
                $profileExist = $this->mentor_model->mentor_exist($user_id);
                break;
            case 'student':
                $studentdata = array(
                    'matric' => $user_id,
                    'program_id' => $this->input->post('program_id'),
                    'parent_num1' => $this->input->post('parent1'),
                    'parent_num2' => $this->input->post('parent2'),
                    'address' => $this->input->post('address')
                );
                $this->student_model->update_student($user_id, $studentdata);
                $profileExist = $this->student_model->student_exist($user_id);
                break;
        }
        if ($this->session->userdata('profilecomplete') != $profileExist) {
            $this->session->set_userdata('profilecomplete', $profileExist);
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
        $users = $this->user_model->get_userdata();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="UserList.xlsx"');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Matric');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'User Type');
        $sheet->setCellValue('D1', 'SIG');
        $sheet->setCellValue('E1', 'Superior ID');
        $sheet->setCellValue('F1', 'Superior Name');
        $sheet->setCellValue('G1', 'Phone Number');
        $sheet->setCellValue('H1', 'DOB');
        $sheet->setCellValue('I1', 'Gender');
        $sheet->setCellValue('J1', 'Start Date');
        $sheet->setCellValue('K1', 'End Date');
        $sheet->setCellValue('L1', 'Year Joined');
        $sheet->setCellValue('M1', 'Validated');
        $sheet->setCellValue('N1', 'Email');
        $sheet->setCellValue('O1', 'Created At');
        $sheet->setCellValue('P1', 'Program ID');
        $sheet->setCellValue('Q1', 'Parent 1');
        $sheet->setCellValue('R1', 'Parent 2');
        $sheet->setCellValue('S1', 'Address');
        $sheet->setCellValue('T1', 'Position');
        $sheet->setCellValue('U1', 'Room Number');
        foreach ($users as $i => $user) {
            $i += 1;
            $sheet->setCellValue('A' . $i + 1, $user['id']);
            $sheet->setCellValue('B' . $i + 1, $user['name']);
            $sheet->setCellValue('C' . $i + 1, $user['usertype']);
            $sheet->setCellValue('D' . $i + 1, $user['sig_id']);
            $sheet->setCellValue('E' . $i + 1, $user['superior_id']);
            $sheet->setCellValue('F' . $i + 1, $user['mentorname']);
            $sheet->setCellValue('G' . $i + 1, $user['phonenum']);
            $sheet->setCellValue('H' . $i + 1, $user['dob']);
            $sheet->setCellValue('I' . $i + 1, $user['gender']);
            $sheet->setCellValue('J' . $i + 1, $user['startdate']);
            $sheet->setCellValue('K' . $i + 1, $user['enddate']);
            $sheet->setCellValue('L' . $i + 1, $user['yearjoined']);
            $sheet->setCellValue('M' . $i + 1, $user['validated']);
            $sheet->setCellValue('N' . $i + 1, $user['email']);
            $sheet->setCellValue('O' . $i + 1, $user['createdat']);
            $sheet->setCellValue('P' . $i + 1, $user['program_id']);
            $sheet->setCellValue('Q' . $i + 1, $user['parent_num1']);
            $sheet->setCellValue('R' . $i + 1, $user['parent_num2']);
            $sheet->setCellValue('S' . $i + 1, $user['address']);
            $sheet->setCellValue('T' . $i + 1, $user['position']);
            $sheet->setCellValue('U' . $i + 1, $user['roomnum']);
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
                $id = $sheetdata[$i][0]; #A
                $name = $sheetdata[$i][1]; #B
                $usertype = $sheetdata[$i][2]; #C
                $superior_id = $sheetdata[$i][3]; #D
                $phonenum = $sheetdata[$i][4]; #E
                $dob = date('Y-m-d', strtotime($sheetdata[$i][5])); #F
                $gender = $sheetdata[$i][6]; #G
                $email = $sheetdata[$i][7]; #H
                // $startdate =  date('Y-m-d', strtotime($sheetdata[$i][8])); #I
                // $enddate = date('Y-m-d', strtotime($sheetdata[$i][9])); #J
                $sdate = DateTime::createFromFormat('j/n/Y', $sheetdata[$i][8]);
                $startdate2 = $sdate->format('Y-m-d');
                $edate = DateTime::createFromFormat('j/n/Y', $sheetdata[$i][9]);
                $enddate2 = $edate->format('Y-m-d');
                $password = md5($id);
                $data[] = array(
                    'id' => $id,
                    'name' => $name,
                    'usertype' => $usertype,
                    'superior_id' => $superior_id,
                    'phonenum' => $phonenum,
                    'dob' => $dob,
                    'gender' => $gender,
                    'email' => $email,
                    'password' => $password,
                    'startdate' => $startdate2,
                    'enddate' => $enddate2,
                    'validated' => true
                );
            }
            $rowaffected = $this->user_model->import_user($data);
            if ($rowaffected > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">' . $rowaffected . ' rows affected</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning">' . $rowaffected . ' rows affected</div>');
            }
            redirect(site_url('user'));
        }
    }

    public function download_template()
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="UserUploadTemplate.xlsx"');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'User Type');
        $sheet->setCellValue('D1', 'Superior ID');
        $sheet->setCellValue('E1', 'Phone Number');
        $sheet->setCellValue('F1', 'DOB');
        $sheet->setCellValue('G1', 'Gender');
        $sheet->setCellValue('H1', 'Email');
        $sheet->setCellValue('I1', 'Start Date');
        $sheet->setCellValue('J1', 'End Date');

        $sheet->setCellValue('A2', 'A16000');
        $sheet->setCellValue('B2', 'Ali');
        $sheet->setCellValue('C2', 'student');
        $sheet->setCellValue('D2', 'K0001');
        $sheet->setCellValue('E2', '0130000111');
        $sheet->setCellValue('F2', '01/02/1997');
        $sheet->setCellValue('G2', 'm');
        $sheet->setCellValue('H2', 'a160000@siswa.ukm.edu.my');
        $sheet->setCellValue('I2', '01/01/2020');
        $sheet->setCellValue('J2', '31/12/2024');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    # to delete after completing UI improvement
    public function register_success()
    {
        $data = array(
            'title' => 'Registration Successful',
            'content' => 'Your registration is currently pending your admin\'s approval. Your admin will inform you once your registration is approved'
        );
        $this->load->view('templates/header');
        $this->load->view('user/register_success', $data);
        $this->load->view('templates/footer');
    }
}
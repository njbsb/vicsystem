<?php
require FCPATH . 'vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use SebastianBergmann\Diff\Diff;

class Student extends CI_Controller
{

    public function index()
    {
        $usertype = $this->session->userdata('user_type');
        $username = $this->session->userdata('username');
        if (!$username) {
            redirect(site_url());
        }
        $sig_id = $this->sig_model->get_sig_id($username);
        $sig = $this->sig_model->get_sig($sig_id);
        switch ($usertype) {
            case 'student':
                redirect(site_url());
                break;
            case 'mentor':
                $students = $this->student_model->get_student('', $sig_id);
                $title = $sig['code'] . ' Students';
                break;
            case 'admin':
                $students = $this->student_model->get_student();
                $title = 'All Students';
                break;
        }
        $data = array(
            'title' => $title,
            'students' => $students
        );
        $this->load->view('templates/header');
        $this->load->view('student/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($student_id)
    {
        $student = $this->student_model->get_student($student_id);
        if (!array_filter($student)) {
            show_404();
        }
        $yearjoined = $student['yearjoined'];
        if (date('Y') - $yearjoined + 1 > 4) {
            $duration = ' (' . $yearjoined . ' - ' . ($yearjoined + 4) . ')';
            $student['year'] = 'Alumni' . $duration;
        } else {
            $student['year'] = date('Y') - $yearjoined + 1;
        }
        $data = array(
            'student' => $student,
            'activity_roles' => $this->committee_model->get_activityroles($student_id),
            'org_roles' => $this->committee_model->get_orgroles($student_id)
        );
        $this->load->view('templates/header');
        $this->load->view('student/view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($student_id = NULL)
    {
        if ($this->session->userdata('user_type') == 'mentor') {
            redirect('student');
        }
        $sig_id = $this->sig_model->get_sig_id($this->session->userdata('username'));
        $student = $this->student_model->get_student($student_id);
        if (empty($student) || !array_filter($student) || $student_id == FALSE) {
            show_404();
        }
        if ($student['sig_id'] != $sig_id) {
            redirect('student');
        }
        $data = array(
            'title' => 'Edit Student: ' . $student['id'],
            'student' => $student,
            'programs' => $this->program_model->get_programs(),
            'sigs' => $this->sig_model->get_sig(),
            'mentors' => $this->mentor_model->get_sigmentors($student['sig_id'])
        );
        $this->load->view('templates/header');
        $this->load->view('student/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        $student_id = $this->input->post('student_id');
        $userdata = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'sig_id' => $this->input->post('sig_id'),
            'dob' => $this->input->post('dob')
        );
        $studentdata = array(
            'phonenum' => $this->input->post('phonenum'),
            'program_code' => $this->input->post('program_code'),
            'mentor_matric' => $this->input->post('mentor_matric')
        );
        $this->student_model->update_student($student_id, $studentdata);
        $this->user_model->update_user($student_id, $userdata);
        redirect('student/' . $student_id);
    }

    public function matric_exist($student_id)
    {
        $verifymatric = $this->student_model->verifymatric($student_id);
        if ($verifymatric == true) {
            $this->form_validation->set_message('matric_exist',  'User already exists. Please select another matric');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function download()
    {
        $students = $this->student_model->get_studentdata();
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="StudentList.xlsx"');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Matric');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'DOB');
        $sheet->setCellValue('D1', 'Phone Number');
        $sheet->setCellValue('E1', 'Year Joined');
        $sheet->setCellValue('F1', 'Email');
        $sheet->setCellValue('G1', 'Mentor ID');
        $sheet->setCellValue('H1', 'Mentor Name');
        $sheet->setCellValue('I1', 'Gender');
        $sheet->setCellValue('J1', 'Program Code');
        $sheet->setCellValue('K1', 'Parent Contact 1');
        $sheet->setCellValue('L1', 'Parent Contact 2');
        $sheet->setCellValue('M1', 'Address');
        foreach ($students as $i => $student) {
            $i += 1;
            $sheet->setCellValue('A' . $i + 1, $student['id']);
            $sheet->setCellValue('B' . $i + 1, $student['name']);
            $sheet->setCellValue('C' . $i + 1, $student['dob']);
            $sheet->setCellValue('D' . $i + 1, $student['phonenum']);
            $sheet->setCellValue('E' . $i + 1, $student['yearjoined']);
            $sheet->setCellValue('F' . $i + 1, $student['email']);
            $sheet->setCellValue('G' . $i + 1, $student['superior_id']);
            $sheet->setCellValue('H' . $i + 1, $student['mentorname']);
            $sheet->setCellValue('I' . $i + 1, $student['gender']);
            $sheet->setCellValue('J' . $i + 1, $student['program_id']);
            $sheet->setCellValue('K' . $i + 1, $student['parent_num1']);
            $sheet->setCellValue('L' . $i + 1, $student['parent_num2']);
            $sheet->setCellValue('M' . $i + 1, $student['address']);
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}
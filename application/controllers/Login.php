<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
        parent:: __construct();
        $this->load->model('AdminModel');
		$this->load->model('studentModel');
		$this->load->model('teacherModel');
		$this->load->model('applicantModel');
		if ($this->session->has_userdata('authenticated')){
			$this->session->set_flashdata('status','Please logout first'); 
			if ($this->session->userdata('authenticated') == '1')
				redirect('Admin/dashboard');
			elseif ($this->session->userdata('authenticated') == '2')
				redirect('Faculty/dashboard');
			elseif ($this->session->userdata('authenticated') == '3')
				redirect('Student/dashboard');
		}
    }

	public function index()
	{
		$this->load->view('Login/home');
	}

	public function student()
	{
        $this->load->view('Login/student');
	}

	public function faculty()
	{
        $this->load->view('Login/faculty');
	}

	public function admin()
	{
        $this->load->view('Login/admin');
	}

	public function applicant()
	{
        $this->load->view('Login/applicant');
	}

	public function admin_login(){
		$data = $this->AdminModel->login();
			if($data != NULL){ 
				if($data->status == 1){
					$auth_userdetails = [
						'adminID' => $data->adminID,
						'firstname' =>  $data->firstname,
						'lastname' =>  $data->lastname,
						'adminNumber' =>  $data->adminNumber
					];
					$this->session->set_userdata('auth_user',$auth_userdetails);
					$this->session->set_userdata('authenticated',"1");
					$this->session->set_flashdata('success','');
					redirect('Admin/dashboard');
				}
				else{
					$this->session->set_flashdata('status','Account is deactivated'); 
 					redirect('Login/admin');
				}
			}
			else{
				$this->session->set_flashdata('status','Invalid Username or Password'); 
				redirect('Login/admin');
			}
	}

	public function student_login(){
		$data = $this->studentModel->login();
			if($data != NULL){  
				if($data->status == 1){
					$auth_userdetails = [
						'studentID' => $data->studentID,
						'username' => $data->username,
						'studentNumber' => $data->studentNumber,
						'firstname' => $data->firstname,
						'middlename' => $data->middlename,
						'lastname' => $data->lastname,
						'extname' => $data->extname,
						'course' => $data->course_chosen,
						'LRN' => $data->LRN,
						'gender' => $data->gender,
						'age' => $data->age,
						'birthday' => $data->birthday,
						'birthplace' => $data->birthplace,
						'contactnum' => $data->contactnum,
						'firstname' => $data->firstname,
						'landline' => $data->landline,
						'email' => $data->email,
						'unit' => $data->unit,
						'street' => $data->street,
						'barangay' => $data->barangay,
						'city' => $data->city,
						'province' => $data->province,
						'zipcode' => $data->zipcode,
						'school' => $data->last_school_attended,
						'track' => $data->track,
						'school_address' => $data->school_address,
						'yearlevel' => $data->year_level,
						'yeargraduated' => $data->year_graduated,
						'category' => $data->category,
						'gpa' => $data->gpa,
						'form137' => $data->form_137,
						'medical_record' => $data->medical_record,
						'goodmoral' => $data->good_moral
					];
					$this->session->set_userdata('auth_user',$auth_userdetails);
					$this->session->set_userdata('authenticated',"3");
					$this->session->set_flashdata('success','');
					redirect('Student/Dashboard');
				}
				else{
					$this->session->set_flashdata('status','Account is deactivated');
 					redirect('Login/student');
				}
			}
			else{
				$this->session->set_flashdata('status','Invalid Username or Password'); 
				redirect('Login/student');
			}
	}

	public function faculty_login(){
		$data = $this->teacherModel->login();
			if($data != NULL){  
				if($data->status == 1){
					$auth_userdetails = [
						
					];
					$this->session->set_userdata('auth_user',$auth_userdetails);
					$this->session->set_userdata('authenticated',"2");
					redirect('FacultyController/dashboard');
				}
				else{
					$this->session->set_flashdata('status','Account is deactivated');  
 					redirect('Login/faculty');
				}
			}
			else{
				$this->session->set_flashdata('status','Invalid Username or Password'); 
				redirect('Login/faculty');
			}
	}

	public function applicant_login(){
		$data = $this->applicantModel->login();
		if($data != NULL){ 
			$this->session->set_userdata('authenticated',"4");
			$auth_userdetails = [
				'applicantID' => $data->applicantID,
				'applicantNumber' => $data->applicantNumber,
				'firstname' => $data->firstname,
				'middlename' => $data->middlename,
				'lastname' => $data->lastname,
				'extname' => $data->extname,
				'course' => $data->course_chosen,
				'LRN' => $data->LRN,
				'gender' => $data->gender,
				'age' => $data->age,
				'birthday' => $data->birthday,
				'birthplace' => $data->birthplace,
				'contactnum' => $data->contactnum,
				'firstname' => $data->firstname,
				'landline' => $data->landline,
				'email' => $data->email,
				'unit' => $data->unit,
				'street' => $data->street,
				'barangay' => $data->barangay,
				'city' => $data->city,
				'province' => $data->province,
				'zipcode' => $data->zipcode,
				'school' => $data->last_school_attended,
				'track' => $data->track,
				'school_address' => $data->school_address,
				'yearlevel' => $data->year_level,
				'yeargraduated' => $data->year_graduated,
				'category' => $data->category,
				'gpa' => $data->gpa,
				'form137' => $data->form_137,
				'medical_record' => $data->medical_record,
				'goodmoral' => $data->good_moral
			];
			$this->session->set_userdata('auth_user',$auth_userdetails);
			$this->session->set_userdata('authenticated',"4");
			redirect('Applicant/'.$data->applicantID);
		}
		else{
			$this->session->set_flashdata('status','Applicant number not found'); 
			redirect('Login/applicant');
		}
	}
	
}

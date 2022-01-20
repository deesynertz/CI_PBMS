<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Main extends CI_Controller {

	public function __construct(){
		parent:: __construct();

		if($this->session->userdata('logged_in') !== TRUE){
			//$this->session->set_flashdata('warning','You dont have access please login first');
			redirect(base_url('login'));
		}

		$this->load->model('DataController_Model','data_model');
		$this->load->model('Project_Model','project_model');
		$this->load->model('Main_Model','main_Model');
		

	}


	public function dashboard()
	{
		if ($this->session->userdata('roleID') == 1) {
		  $this->load->model('Auth_Model','auth_model');

			$userID = $this->session->userdata('authID');

			$data['all']	        = $this->data_model->tittlesArray();
			$data['title_active'] 	= ucfirst('dashboard');
			$data['breadcrumb']		= $this->uri->segments;
			$this->setUserdataByID($this->session->userdata('authID'));

			// all request
			$data['requests'] = $this->auth_model->userRequest('request');
			$data['authorized'] = $this->auth_model->userRequest('active', 'domant');
			// all users
			// 
			
			// $data['projects']= $this->project_model->getProjectNameWithStatusByUserID($userID);
			// $data['fivActvy']= $this->project_model->getLatestProjectActivityByUserID($userID);
			// $data['projectCount'] = $this->project_model->noProjectByUserID($userID);
			// $data['project_status'] = $this->data_model->project_status();

	
			// var_dump($data['requests']);
	
			$this->load->view('admin/dashboard', $data);
		} else {
			$this->redirectPage($this->session->userdata('roleID'));
		}
	}

	public function fetchData()
	{
		// if ($this->input->is_ajax_request()) {
			$chartdata = $this->main_Model->chartS();
			echo json_encode($chartdata);
		// }
	}

	function calculationWeeks ($dataToCalculate) {
		$i = 0;
		$len = count($dataToCalculate);
		$chartDiference = [];
		foreach($dataToCalculate as $row){
			if ($i == ($len  - 2)) {
				$this.$chartDiference['oneweekBefore'] = $row->spent;
			} else if ($i == ($len  - 1)){
				$this.$chartDiference['twoweekBefore'] = $row->spent;
			}
			$i++;
		}

		// $this.chartDiference.push($this->$oneweekBefore, $this->$twoweekBefore);

		return $this.$chartDiference;
	}

	public function profile()
	{
		$userID = $this->session->userdata('authID');

		$data['all']	        = $this->data_model->tittlesArray();
		$data['title_active'] 	= ucfirst('profile');
		$data['projectCount'] = $this->project_model->noProjectByUserID($userID);
		$data['project_status'] = $this->data_model->project_status();

		$this->setUserdataByID($userID);

		$this->load->view('/users/profile_view', $data);
	}


	public function edit_profile()
	{
		$this->form_validation->set_rules('inputName', 'Full Name', 'required');
		//$this->form_validation->set_rules('inputEmail', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('location', 'Location', 'required');


		if ($this->form_validation->run() == false) {

			$this->profile();

		}else {

			$fullName = $this->input->post('inputName');
			$location = (!empty($this->input->post('location')))? $this->input->post('location') : null;
			$skill	  = (!empty($this->input->post('skill')))? $this->input->post('skill') : null;
			$education = (!empty($this->input->post('education')))? $this->input->post('education') : null;
			$experience = (!empty($this->input->post('experience')))? $this->input->post('experience'): null;


			$authID = $this->session->userdata('authID');
			$this->load->model('Auth_Model','auth_model');

			if ($this->session->userdata('name') === $fullName){

				if (!empty($this->session->userdata('location'))){
					// update
					$userData = array('education'=>$education,'skill'=>$skill,'location'=>$location,
						'experience'=>$experience);

					$this->auth_model->__update_detail_table($authID,$userData);

				}else {
					$userData = array(
						'education'=>$education,'skill'=>$skill,'location'=>$location,
						'experience'=>$experience, 'userID'=>$authID);

					$this->auth_model->__insert_detail_table($userData);
				}

				redirect(base_url('profile'));

			}else {
				$userData = array(
					'fullName' 	=> $fullName,
					'location'	=> $location,
					'skill' 	=> $skill,
					'education' => $education,
					'experience'=> $experience,
				);
				$edit_callback = $this->auth_model->__update_detail_table($authID,$userData,'all');

				//redirect(base_url('profile'));
			}
		}
	}

	private function setUserdataByID($userID)
	{
		$this->load->model('Auth_Model','auth_model');
		$getUserProfile = $this->auth_model->getUserProfileByID($userID);

		if ($getUserProfile->num_rows() > 0) {

			$user_table = $getUserProfile->row_array();

			$userProfile = array(
				'name' 		=> $user_table['fullName'],
				'email'		=> $user_table['email'],
				'userPic'	=> $user_table['userPic'],
				'roleName'	=> $user_table['roleName'],
				'skill' 	=> $user_table['skill'],
				'education' => $user_table['education'],
				'location'  => $user_table['location'],
				'experience'=> $user_table['experience'],
			);

			return $this->session->set_userdata($userProfile);
		}

	}


	public function notification()
	{
		$proID = 2;
		
		$userID = $this->session->userdata('authID');
		$data = $this->project_model->handleNotification($userID);

		if ($data->num_rows() > 0) {

			foreach ($data->result() as $key) {


				$match = ($key->proID == $proID) ? 'yes' : 'NO' ;

				echo $match;	
			}
				
		}

		// echo $data;

		// echo '<pre>';
		// var_dump($data['not']);
		// echo '</pre>';
	}


	private function redirectPage($roleID) {
		if ($roleID == 1) {
			redirect(base_url('dashboard'));
		} else if($roleID == 2) {
			redirect(base_url('profile'));
		} else {
			redirect(base_url('login'));
		}
	}

}

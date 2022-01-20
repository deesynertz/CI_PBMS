<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller
{
	public function __construct(){
		parent:: __construct();
		$this->load->model('DataController_Model','data_model');
		$this->load->library('form_validation');
	}


	//$route['registration'];
	public function registration()
	{
		$this->load->model('Auth_Model','auth_model');
		$data['all']	        = $this->data_model->tittlesArray();
		$data['title_active'] 	= ucfirst('dashboard');
		$data['title_active'] 	= ucfirst('registration');

		$this->form_validation->set_rules('fullName', 'Full Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');


		if ($this->form_validation->run() == false) {

			$this->load->view('auth/registration', $data);

		}else {

			$pass = $this->input->post('confirm_password');
			$userData = array(
				'fullName' => $this->input->post('fullName'),
				'email'=> $this->input->post('email'),
				'password' => SHA1($pass),
				'userPic'  => 'default_avatar.jpg',
				'roleID'   => 2
			);

			$callback = $this->auth_model->userRegistration($userData);

			if ($callback > 0) {

				$this->session->set_flashdata('success', 'You are registered successful now you can login');
				redirect(base_url('login'));

			}else {

				$this->session->set_flashdata('warning','something went wrong!!');
				$this->load->view('auth/registration', $data);
			}
		}

	}

	//$route['login']
	public function login()
	{
		if ($this->session->userdata('logged_in') !== TRUE){

			$this->load->model('Auth_Model','auth_model');

			$data['all']	        = $this->data_model->tittlesArray();
			$data['title_active'] 	= ucfirst('login');

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');


			if ($this->form_validation->run() == false) {

				$this->load->view('auth/login',$data);

			}else {
				$email 		= 	$this->input->post('email');
				$password 	= 	$this->input->post('password');

				$validate		=	$this->auth_model->isUserExist($email,SHA1($password));

				if($validate->num_rows() > 0) {
					$data = $validate->row_array();
					$account_permision		=	$this->auth_model->accoutPermision($data['ID']);

					if($account_permision->num_rows() > 0) {
						$this->createSession($data);

						if ($this->session->userdata('logged_in') == TRUE) {
							$all = $data['all'];
							$this->session->set_flashdata('success','welcome to'.$all['title']);
							$this->redirectPage($this->session->userdata('roleID'));
							}else {
							$this->session->set_flashdata('error', 'Access Denied Contact to admin');
							$this->redirectPage($this->session->userdata('roleID'));
						}
					}else {
						$this->session->set_flashdata('warning', 'Access Denied Inactive account');
						$this->redirectPage($this->session->userdata('roleID'));
					}
				}else{
					$this->session->set_flashdata('error','Invalid Username or Password');
					redirect(base_url('login'));
				}
			}

		}else{
			$this->redirectPage($this->session->userdata('roleID'));
		}
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

	public function logout()
	{
		$this->session->set_flashdata('info', 'You are now logged out');
		$this->session->sess_destroy();
		redirect(base_url());
	}


	public function createSession($data){
			$sessionData = array(
				'authID'  	=> $data['ID'],
				'userID' 	=> $data['email'],
				'roleID' 	=> $data['roleID'],
				'status'  => $data['status'],
				'logged_in' => TRUE
			);

			$this->session->set_userdata($sessionData);
		return $this->session->set_userdata($sessionData);
	}

	// fetch user
	public function fetch_request_account()
	{
		if ($this->input->is_ajax_request()) {
			$this->load->model('Auth_Model','auth_model');
			$data = $this->auth_model->get_users('request');
			echo json_encode($data);
		}
	}

	public function fetch_activated_account()
	{
		if ($this->input->is_ajax_request()) {
			$this->load->model('Auth_Model','auth_model');
			$data = $this->auth_model->get_users('active');
			echo json_encode($data);
		}
	}

	public function select_single_user($projectID){
		$this->load->model('Auth_Model','auth_model');
		$data = $this->auth_model->get_one_user($projectID);
		echo json_encode($data);
	}


	// allow user
	public function user_permision() {
		if ($this->input->is_ajax_request()) {
			$userID = $this->input->post('userID');
			$action = $this->input->post('action');
			$this->load->model('Auth_Model','auth_model');

			if ($this->auth_model->user_permision($userID, $action)) {
				$data = array('response' => 'success');
			} else {
				$data = array('response' => 'error');
			}
			
			echo json_encode($data);
		}
	}

	// disable user
	public function disable_account()
	{
		if ($this->input->is_ajax_request()) {
			$dis_id = $this->input->post('dis_id');
			$this->load->model('Auth_Model','auth_model');

			if ($this->auth_model->allow_user($dis_id, 'domant')) {
				$data = array('response' => 'success');
			} else {
				$data = array('response' => 'error');
			}
			
			echo json_encode($data);
		}
	}

	// enable
	public function enable_account()
	{
		if ($this->input->is_ajax_request()) {
			$allow_id = $this->input->post('allow_id');
			$this->load->model('Auth_Model','auth_model');

			if ($this->auth_model->allow_user($allow_id, 'active')) {
				$data = array('response' => 'success');
			} else {
				$data = array('response' => 'error');
			}
			
			echo json_encode($data);
		}
	}

	// delete user
	public function delete_account()
	{
		if ($this->input->is_ajax_request()) {
			$del_id = $this->input->post('del_id');
			$this->load->model('Auth_Model','auth_model');

			if ($this->auth_model->del_user($del_id)) {
				$data = array('response' => 'success');
			} else {
				$data = array('response' => 'error');
			}
			
			echo json_encode($data);
		}
	}

}

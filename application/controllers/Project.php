<?php

class Project extends CI_Controller
{
	public function __construct() {
		parent::__construct();

		if ($this->session->userdata('logged_in') != TRUE) {
			# authorize if your not loggedin return user back to the login page 
			redirect(base_url('login'));
		}

		# load model into this controller
		$this->load->model('DataController_Model', 'data_model');
		$this->load->model('Project_Model', 'project_model');
	}

	# Now you can access the function if your loggedin

	public function view_all() {
		if ($this->session->userdata('roleID') == 2) {
			# set data array to carry varibales loaded into view
			$userID = $this->session->userdata('authID');

			$data['all']	        = $this->data_model->tittlesArray();
			$data['title_active'] 	= ucfirst('projects');
			$data['breadcrumb']		= $this->uri->segments;
			$data['projects'] = $this->project_model->allProjectsByUserID($userID);
			$data['projectCount'] = $this->project_model->noProjectByUserID($userID);
			$data['project_status'] = $this->data_model->project_status();

			# load the view and pass $data variable array
			$this->load->view('/projects/project-view', $data);
		} else {
			$this->redirectPage($this->session->userdata('roleID'));
		}
	}

	public function project_add() {
		if ($this->session->userdata('roleID') == 2) {
			# set data array to carry varibales loaded into view
			$userID = $this->session->userdata('authID');

			$data['all']	      = $this->data_model->tittlesArray();
			$data['title_active'] = ucfirst('add Project');
			$data['breadcrumb']		= $this->uri->segments;
			// $data['statusArray'] = $this->project_model->__getStatus();
			$data['projectCount'] = $this->project_model->noProjectByUserID($userID);
			$data['purposes_opt'] = $this->data_model->purpose_option();
			$data['project_status'] = $this->data_model->project_status();



			# set rule to those filed in oder to validate them
			$this->form_validation->set_rules('pName', 'Project Name', 'required');
			$this->form_validation->set_rules('cName', 'Client Company', 'required');
			$this->form_validation->set_rules('lPhone', 'Phone Number', 'required|integer');
			$this->form_validation->set_rules('lName', 'Project Leader', 'required');
			$this->form_validation->set_rules('estimatedBudget', 'Estimated Budget', 'required|numeric');
			$this->form_validation->set_rules('estimatedDuration', 'Estimated Duration', 'required|integer');

			# validate them
			if ($this->form_validation->run() == false) {
				# return error message or page by default...
				# load the view and pass $data variable array
				$this->load->view('/projects/project_add', $data);
			} else {

				# create variable to use
				$projectData = array(
					'projectName' => $this->input->post('pName'),
					'owner' => $this->session->userdata('authID'),
					'leader' => $this->input->post('lName'),
					'contact' => $this->input->post('lPhone'),
					'duration' => $this->input->post('estimatedDuration'),
					'budget' => $this->input->post('estimatedBudget'),
					'description' => $this->input->post('description'),
					'compName' => $this->input->post('cName'),
					'budget_purpose' => serialize($this->input->post('purpose')),
					'projectStatus' => $this->input->post('status')

				);

				# send data into model to create project into table
				$tb_project = $this->project_model->__create_project($projectData);

				# check the callback if was success or not
				if ($tb_project > 0) {
					# redirect to the project view after success
					redirect(base_url('project'));
				}
			}
		} else {
			$this->redirectPage($this->session->userdata('roleID'));
		}
	}

	public function project_settings() {
		if ($this->session->userdata('roleID') == 2) {
			# set data array to carry varibales loaded into view

			$curUrl = $this->uri->segment(3);
			$userID = $this->session->userdata('authID');

			$data['all']	        = $this->data_model->tittlesArray();
			$data['title_active'] 	= ucfirst('project Settings');
			$data['breadcrumb']		= $this->uri->segments;
			$userID = $this->session->userdata('authID');
			$data['project'] = $this->project_model->singleProjectByID($curUrl);
			$data['purposes_opt'] = $this->data_model->purpose_option();
			$data['projectCount'] = $this->project_model->noProjectByUserID($userID);
			$data['project_status'] = $this->data_model->project_status();

			# set rule to those filed in oder to validate them
			$this->form_validation->set_rules('estimatedDuration', 'Estimated Duration', 'required');
			$this->form_validation->set_rules('estimatedBudget', 'Estimated Budget', 'required');

			# validate them
			if ($this->form_validation->run() == false) {
				# return error message or page by default...
				# load the view and pass $data variable array
				$this->load->view('/projects/project_settings', $data);
			} else {

				# create variable to use
				$activity = "The '" . $this->input->post('proName') . "' created successfuly";
				$projectData = array(
					// 'projectID' => $this->uri->segment(3),
					// 'currentAmount' => $this->input->post('estimatedBudget'),
					// 'spentAmount' =>  0.00,
					// 'info' => $activity
					'projectStatus' => $this->input->post('proStatus')
				);

				# send data into model in order to complete the setting process
				// $this->project_model->expenditureInsert($tbProjectDetails);
				$tb_project = $this->project_model->updateProjectDetails($curUrl, $projectData);

				# redirect to all project preview
				// redirect(base_url('project/') . 'project_detail/' . $curUrl);
				redirect(base_url('project'));
			}
		} else {
			$this->redirectPage($this->session->userdata('roleID'));
		}
	}

	public function project_detail() {
		if ($this->session->userdata('roleID') == 2) {
			# set data array to carry varibales loaded into view
			$curUrl = $this->uri->segment(3);
			$userID = $this->session->userdata('authID');

			$data['all']	        = $this->data_model->tittlesArray();
			$data['title_active'] 	= ucfirst('project Details');
			$data['breadcrumb']		= $this->uri->segments;
			
			$data['Expenditures'] = $this->project_model->ExpenditureActivities($curUrl);
			$data['activities'] = $this->project_model->ActivitiesOnly($curUrl);
			$data['project'] = $this->project_model->singleProjectByID($curUrl);
			$data['summary'] = $this->project_model->ExpensesChartS($curUrl);

			$data['projectDoc'] = $this->project_model->fetchProjectDoc_Model($curUrl);
			$data['projectCount'] = $this->project_model->noProjectByUserID($userID);
			$data['project_status'] = $this->data_model->project_status();

			# load the view and pass $data variable array
			$this->load->view('/projects/project_detail', $data);
		} else {
			$this->redirectPage($this->session->userdata('roleID'));
		}
	}

	public function fetchDataSummary($projectId) {
		// if ($this->input->is_ajax_request()) {
			$chartdata = $this->project_model->ExpensesChartS($projectId);
			echo json_encode($chartdata);
		// }
	}

	function fetchProjectDoc($projectId) {
		$projectDoc = $this->project_model->fetchProjectDoc_Model($projectId);
		echo json_encode($projectDoc);
	}

	public function delete_document() {
		$this->load->helper("file");
		if ($this->input->is_ajax_request()) {
			$doc_id = $this->input->post('doc_id');
			$doc_name = $this->input->post('doc_name');

			$path = $_SERVER['DOCUMENT_ROOT'].'/CI/assets/documents/';
			$file = glob($path.$doc_name);

			foreach($file as $filename) {
				if(unlink($filename)) {
					if ($this->project_model->delete_document($doc_id)) {
						$data = array('response' => 'success');
					} else {
						$data = array('response' => 'error occured in DB');
					}
				}else {
					$data = array('response' => 'something went wrong !!');
				}
			}
			echo json_encode($data);
		}
	}

	public function delete_project(){
		$proj_id = $this->input->post('proj_id');
		if ($this->project_model->delete_project($proj_id)) {
			$data = array('response' => 'success');
		} else {
			$data = array('response' => 'error');
		}

		echo json_encode($data);
	}

	function uploadDocument($projectID) {
		if (isset($_FILES['docName']['name'])) {
			$path = './assets/documents/';
			$allowed_Type = 'pdf|doc|docx|png|jpeg|jpg';

			$config['upload_path'] = $path;
			$config['allowed_types'] = 'pdf|doc|docx|png|jpeg|jpg';
			$config['max_size'] = 1024;
			$config['max_width'] = "*";
			$config['max_height'] = "*";

			// $config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			$json = array();

			if (!$this->upload->do_upload('docName')) {
				// echo ($this->upload->display_errors());
				$json['error'] = $this->upload->display_errors();
				// print_r($this->upload->data());
				echo json_encode($json);
			}else {

				$info = $this->upload->data();

				$projectDocumnet = array(
					'projectID' => $projectID, 
					'path' => $info['file_name'], 
					'docType' => $info['file_ext']
				);

				$result = $this->project_model->upload_document($projectDocumnet);
				echo json_encode($result);
			}

		}
	}

	public function project_update(){
		if ($this->session->userdata('roleID') == 2) {
			# set data array to carry varibales loaded into view
			$curUrl = $this->uri->segment(3);
			$userID = $this->session->userdata('authID');

			$data['all']	        = $this->data_model->tittlesArray();
			$data['title_active'] 	= ucfirst('project Update');
			$data['breadcrumb']		= $this->uri->segments;
			$userID = $this->session->userdata('authID');
			$data['project'] = $this->project_model->singleProjectByID($curUrl);
			// $data['statusArray'] = $this->project_model->__getStatus();
			$data['purposes_opt'] = $this->data_model->purpose_option();
			$data['projectCount'] = $this->project_model->noProjectByUserID($userID);
			$data['project_status'] = $this->data_model->project_status();

			# load the view and pass $data variable array


				# set rule to those filed in oder to validate them
				$this->form_validation->set_rules('proName', 'Project Name', 'required');
				$this->form_validation->set_rules('proDescription', 'Project Description', 'required');
				$this->form_validation->set_rules('proStatus', 'Estimated Budget', 'required');
				$this->form_validation->set_rules('compName', 'Client Company', 'required');
				$this->form_validation->set_rules('leader', 'Project Leader', 'required');
				$this->form_validation->set_rules('phone', 'Phone Number', 'required|integer');
				
				$this->form_validation->set_rules('estimatedBudget', 'Estimated Budget', 'required|numeric');
				
				$this->form_validation->set_rules('estimatedDuration', 'Estimated Duration', 'required|integer');
	
				# validate them
				if ($this->form_validation->run() == false) {
					# return error message or page by default...
					# load the view and pass $data variable array
					$this->load->view('/projects/project_edit', $data);


				} else {
					# create variable to use
					$projectData = array(
						'projectName' => $this->input->post('proName'),
						'owner' => $this->session->userdata('authID'),
						'leader' => $this->input->post('leader'),
						'contact' => $this->input->post('phone'),
						'duration' => $this->input->post('estimatedDuration'),
						'budget' => $this->input->post('estimatedBudget'),
						'description' => $this->input->post('proDescription'),
						'compName' => $this->input->post('compName'),
						'budget_purpose' => serialize($this->input->post('purpose')),
						'projectStatus' => $this->input->post('proStatus')
	
					);
	
					# send data into model to create project into table
					$this->project_model->updateProjectDetails($curUrl, $projectData);
					redirect(base_url('project/') . 'project_detail/' . $curUrl);

				}
		} else {
			$this->redirectPage($this->session->userdata('roleID'));
		}
	}

	private function redirectPage($roleID) {
		if ($roleID == 1) {
			redirect(base_url('dashboard'));
		} else if ($roleID == 2) {
			redirect(base_url('profile'));
		} else {
			redirect(base_url('login'));
		}
	}


	// add expenditure
	public function expenditureAjax(){
		if ($this->input->is_ajax_request()) {

			$activityID = $this->input->post('activityID');
			$forWhat  = $this->input->post('forWhat');
			$spentAmount  	 = $this->input->post('spentAmount');
			$info  	 = $this->input->post('info');

			$expenditureInfo = array(
				'activityID' => $activityID, 'forWhat' => $forWhat, 'spentAmount' => $spentAmount,
				'info' => $info
			);

			# send data into model to insert them into table
			if($this->project_model->expenditureInsert($expenditureInfo)){
				$data = array('success' => 'Expenditure added successful');
			}else {
				$data = array('error' => 'Something went wrong');

			}

			echo json_encode($data);
		}
	}


	// ADD ACTIVITIES IN SETTING PAGE
	public function upload_activities(){
		if ($this->input->is_ajax_request()) {
			$projectID = $this->input->post('projectID');
			$content  = $this->input->post('content');
			$amount  	 = $this->input->post('amount');
			$estBagdet  	 = $this->input->post('estBagdet');

			$activitiesArray = $this->project_model->ActivitiesOnly($projectID);
			if (count($activitiesArray->result()) > 0) {
				$amountSet = 0;
				foreach ($activitiesArray->result() as $key) {
					$amountSet += $key->amount;
					$estimeted = $key->budget;
				}

				if (($estimeted - $amountSet) < $amount) {
					$data = array('error' => 'No enough money');
				}else {
					$activity = array(
						'projectID' => $projectID, 'content' => $content, 'amount' => $amount
					);

					if ($this->project_model->upload_activities($activity)) {
						$data = array('success' => 'acctivity created successful');
					} else {
						$data = array('error' => 'Something went wrong');
					}
				}
			}else {
				if ($amount > $estBagdet) {
					$data = array('error' => 'No enough money');
				}else {
					$activity = array(
						'projectID' => $projectID,'content' => $content, 'amount' => $amount
					);
			
					if ($this->project_model->upload_activities($activity)) {
						$data = array('success' => 'acctivity created successful');
					} else {
						$data = array('error' => 'Something went wrong');
					}
				}
			}

			echo json_encode($data);
		}
	}

	public function check_amount($projectID) {
		if ($this->input->is_ajax_request()) {
			$data = $this->project_model->checkCurrentBudgetSatatus($projectID);
			echo json_encode($data);
		}
	}


	public function fetchActivities($projectID) {
		if ($this->input->is_ajax_request()) {
			$activitiesArray = $this->project_model->ActivitiesOnly($projectID);
			$data = $activitiesArray->result();

			echo json_encode($data);
		}
	}

	public function updateActivityStatus() {
		if ($this->input->is_ajax_request()) {

			$activityID = $this->input->post('activityID');
			$projectID = $this->input->post('projectID');


			$activitiesArray = $this->project_model->ActivitiesOnly($projectID);
			$dataArray = $activitiesArray->result();

			foreach ($dataArray as $key) {
				if ($activityID == $key->activityID) {
					if ($key->status == "on hold") {
						$status = 'complete';
					}else if ($key->status == "complete") {
						$status = 'on hold';
					} else {
						$status = 'cancelled';
					}
				}
			}

			if ($this->project_model->updateActivityStatus($activityID,$status)) {
				$data = array('success' => true);
			}

			echo json_encode($data);
		}
	}
	
	public function projectStatus() {
		if ($this->input->is_ajax_request()) {

			$userID = $this->input->post('userID');
			$projects = $this->project_model->allProjectsByUserID($userID)->result();

			foreach ($projects as $project) {
				if ($project->activity != null  && $project->projectStatus != 3 &&$project->projectStatus != 1) {
					$activities = $this->project_model->ActivitiesOnly($project->proID)->result();

					$countStatus = 0;
					foreach ($activities as $activitie) {
						if ($activitie->status == "complete") {
							$countStatus += 1;
						}
					}

					if (count($activities) == $countStatus) {
						$status = 4;
						$projectData = array('projectStatus' => $status);
						$this->project_model->updateProjectDetails($project->proID, $projectData);
						$data =  array('response' => "complete");
					}else {
						$status = 2;
						$projectData = array('projectStatus' => $status);
						$this->project_model->updateProjectDetails($project->proID, $projectData);
						$data =  array('response' => "on hold");
					}
				}else {
					$status = 3;
					$data = "cancelled";
					$data =  array('response' => "cancelled");
					// $this->project_model->updateProjectDetails($project->proID, $projectData);
				}	
			}

			echo json_encode($data);
		}
	}

}

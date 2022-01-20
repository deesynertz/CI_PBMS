<?php


class Project_Model extends CI_Model {

	public function __create_project($data){
		$this->db->insert('tb_project', $data);
		return $this->db->insert_id();
	}

	public function __insert_project_budget($data)
	{
		$this->db->insert('tb_project_budget', $data);
		return $last_id = $this->db->insert_id();
	}

	public function updateProjectDetails($projectID, $data) {
		$this->db->where('ID', $projectID);
		return $this->db->update('tb_project', $data);
	}

	public function allProjectsByUserID($userID)
	{
		// $select = "SELECT p.ID AS proID, projectName AS proName, projectStatus, budget, SUM(IFNULL(spentAmount, 0)) AS spent, ((datediff(curdate(),createdOn) * 100) / duration) AS progress, (budget - SUM(IFNULL(spentAmount, 0))) AS currentAmount, p.createdOn FROM tb_project AS p LEFT JOIN tb_project_details AS d ON  p.ID = d.projectID WHERE owner = '" . $userID . "' GROUP BY p.ID ORDER BY p.ID ASC;";

		$select = "SELECT p.ID AS proID, projectName AS proName, projectStatus, budget, p.createdOn,
		(SELECT COUNT(*) FROM tb_activities ac WHERE ac.projectID = p.ID GROUP BY p.ID) AS activity,
		(SELECT SUM(IFNULL(spentAmount, 0)) FROM tb_activities ac LEFT JOIN tb_expenditure ep ON ep.activityID = ac.ID WHERE projectID = p.ID GROUP BY projectID) AS spent FROM tb_project p WHERE owner = '".$userID."' GROUP BY p.ID ORDER BY p.ID ASC";
		return $this->db->query($select);
	}


	public function singleProjectByID($projectID)
	{
		// $select = "SELECT p.ID AS proID, projectName AS proName, owner, leader, contact AS phone,budget,description,compName,budget_purpose AS purpose, projectStatus,createdOn, datediff(curdate(),createdOn) AS daysRemain, duration, spentAmount as spent,spentOn, SUM(IFNULL(spentAmount, 0)) AS totalSum, info FROM tb_project p LEFT JOIN tb_project_details pd ON projectID = p.ID WHERE p.ID = '" . $projectID . "' ORDER BY createdOn";

		$select = "SELECT p.ID AS proID, projectName AS proName, owner, leader, contact AS phone,budget,description,compName,budget_purpose AS purpose, projectStatus,createdOn,duration,datediff(curdate(),createdOn) AS diffDays, (SELECT SUM(IFNULL(spentAmount, 0)) FROM tb_activities ac JOIN tb_expenditure ep ON ep.activityID = ac.ID WHERE projectID = p.ID GROUP BY projectID) AS totalSum FROM tb_project p WHERE p.ID = '".$projectID."'";

		return $this->db->query($select)->result_array();
	}

	public function ExpenditureActivities($projectID) {
		$select ="SELECT ac.ID AS activityID,content,status,amount, ep.ID AS expID,spentAmount,forWhat,info,spentOn, (SELECT budget FROM tb_project p WHERE p.ID = ac.projectID) AS budget FROM tb_activities ac JOIN tb_expenditure ep ON activityID = ac.ID 
		WHERE ac.projectID = '".$projectID."'";

		return $this->db->query($select);
	}

	public function ActivitiesOnly($projectID) {
		$select ="SELECT ac.ID AS activityID,content,status,amount, (SELECT budget FROM tb_project p WHERE p.ID = ac.projectID) AS budget, projectID, IFNULL((SELECT SUM(spentAmount) FROM tb_expenditure WHERE activityID = ac.ID GROUP BY activityID), 0) AS spentOverActity FROM tb_activities ac WHERE ac.projectID = '".$projectID."'";

		return $this->db->query($select);
	}




	public function expenditureInsert($projectDetails)
	{
		$this->db->insert('tb_expenditure', $projectDetails);
		return $last_id = $this->db->insert_id();
	}

	public function __getAllProjects()
	{
		return $this->db->get('tb_project');
	}

	public function getProjectNameWithStatusByUserID($userID) {

		$select = "SELECT p.ID AS proID, projectName AS proName,budget, p.status AS proStatus, statusName,createdOn,((datediff(curdate(),createdOn) * 100) / duration) AS progress,(SELECT MIN(currentAmount) FROM tb_project_details WHERE projectID = p.ID GROUP BY projectID) AS minAmount FROM pbms_db.tb_project p LEFT JOIN tb_status ON  tb_status.ID = p.status WHERE owner = '" . $userID . "' AND p.status != 3 LIMIT 2";

		return $this->db->query($select);	
	}

	public function get_projectID_by_authID($authID)
	{
		$select = "SELECT pr.ID AS proID FROM tb_project pr WHERE pr.owner ='" . $authID . "'";
		$query = $this->db->query($select);
		if (count($query->result()) > 0) {
			return $query->row_array();
		}
	}

	public function ExpensesChartS($projectID) {
		$selectSet = "SET @counter = 0";
		$select = "SELECT SUM(spentAmount) spent, budget, @counter:=@counter+1 AS noWeek 
		FROM tb_project p, tb_activities ac, tb_expenditure ep WHERE  p.ID = projectID AND ac.ID = activityID AND projectID = '".$projectID."' GROUP BY (SELECT EXTRACT(WEEK FROM spentOn)) ORDER BY (SELECT EXTRACT(WEEK FROM spentOn))";
		$query = $this->db->query($selectSet);
		$query = $this->db->query($select);
		// $query = $this->db->get('tb_project');
		return $query->result();
	}

	public function upload_document($data)
	{
		$result = $this->db->insert('tb_project_files', $data);
		return $result;
	}

	function fetchProjectDoc_Model($projectID)
	{
		$select = "SELECT * FROM tb_project_files f WHERE f.projectID = '" . $projectID . "'";
		$query = $this->db->query($select);
		return $query->result();
	}

	public function delete_document($doc_id)
	{
		return $this->db->delete('tb_project_files', array('ID' => $doc_id));
	}

	public function delete_project($pro_id)
	{
		return $this->db->delete('tb_project', array('ID' => $pro_id));
	}

	public function getLatestProjectActivityByUserID($userID)
	{
		// projectName, spentOn, spentAmount
		$select = "SELECT pr.ID AS proID, projectName, spentOn, duration, info, forWhat, spentAmount FROM tb_project_details pdt LEFT JOIN tb_project pr  ON pr.ID = pdt.projectID 
		WHERE pr.owner ='" . $userID . "' ORDER BY spentOn DESC LIMIT 5";

		// $select = "SELECT ID AS proID FROM tb_project p WHERE owner ='".$userID."'";
		return $this->db->query($select);
	}

	// COUNT
	public function noProjectByUserID($userID)
	{
		$select = "SELECT * FROM ((SELECT COUNT(*) AS total FROM tb_project WHERE owner = '" . $userID . "') AS T1 ,(SELECT COUNT(*) AS complited FROM tb_project WHERE projectStatus = 4 AND owner ='" . $userID . "') T2, (SELECT COUNT(*) AS cancelled FROM tb_project WHERE projectStatus = 3 AND owner ='" . $userID . "') T3, (SELECT COUNT(*) AS onhold FROM tb_project WHERE projectStatus = 2 AND owner ='" . $userID . "') T4, (SELECT COUNT(*) AS settings FROM tb_project WHERE projectStatus = 1 AND owner ='" . $userID . "') T5);";
		$countProject = $this->db->query($select);

		return $countProject->row();
	}

	public function paritialSettings($userID)
	{
		$select = "SELECT ID,owner, duration,((datediff(curdate(),createdOn) * 100)/ duration) AS progress, status FROM tb_project WHERE owner ='" . $userID . "' AND status != 3";

		$result = $this->db->query($select);
	}


	// STATUS
	public function projectStatusFetch($userID)
	{
		$select = "SELECT ID,owner, duration,((datediff(curdate(),createdOn) * 100)/ duration) AS progress, status FROM tb_project WHERE owner ='" . $userID . "' AND status != 3";

		$result = $this->db->query($select);

		$retVal = ($result->num_rows() > 0) ? $result->result() : array();
		foreach ($retVal as $key) {
			$prog = (round($key->progress <= 99, 0)) ? 1 : 2;
			$canIUpdate = ($prog != $key->status) ? true : false;

			if ($canIUpdate) {
				// now update the status
				$this->db->query("UPDATE tb_project SET status='" . $prog . "' WHERE ID ='" . $key->ID . "'");
				$this->project_model->updateStatusColumn($key->ID, $prog);
			}
		}
	}

	public function checkCurrentBudgetSatatus($projectID){
		$check = "SELECT budget, spent, (budget - spent) AS remain FROM ((SELECT budget FROM  tb_project p WHERE p.ID = '".$projectID."') T1,(SELECT SUM(IFNULL(spentAmount, 0)) spent FROM tb_activities ac JOIN tb_expenditure ep ON activityID = ac.ID AND projectID = '".$projectID."' GROUP BY ac.projectID) T2)";

		return $this->db->query($check)->row();
	}


	public function updateActivityStatus($activityID, $setValue) {
		$this->status = $setValue;
		return $this->db->update('tb_activities', $this, array('ID'=> $activityID));
	}

	public function upload_activities($activity){
		return $this->db->insert('tb_activities', $activity);
	}

}

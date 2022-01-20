<?php


class Auth_Model extends CI_Model
{
	public function userRegistration($userData)
	{
		$this->db->insert('tb_user', $userData);
		return $last_id = $this->db->insert_id();
	}

	public function isUserExist($email, $password)
	{
		// Validate
		$select = "SELECT ID,email,roleID FROM tb_user user WHERE user.email='" . $email . "' AND user.password='" . $password . "' LIMIT 1";

		return $query = $this->db->query($select);
	}


	public function accoutPermision($userID)
	{
		$select = "SELECT permission_status FROM tb_user WHERE ID='" . $userID . "' AND 
		permission_status ='active'";
		return $this->db->query($select);
	}


	public function select_detail_table($userID)
	{

		$query = $this->db->where('userID', $userID);
		$query = $this->db->get('tb_details', 1);

		if ($query->num_rows() > 0) {
			return $detail_table = $query->row_array();
		} else {
			return null;
		}
	}

	//$insert = "INSERT INTO tb_details VALUES ('".$data."') WHERE userID='".$userID."'";

	public function __insert_detail_table($data)
	{
		$this->db->insert('tb_details', $data);
	}
	public function __update_detail_table($userID, $data)
	{
		// update
		$this->db->where('userID', $userID);
		$this->db->update('tb_details', $data);
	}

	public function getUserProfileByID($userID)
	{

		$select = "SELECT * FROM tb_user user LEFT JOIN tb_role role ON role.ID = roleID 
		LEFT JOIN tb_details detail ON user.ID = detail.userID WHERE user.ID='" . $userID . "' LIMIT 1";
		return $this->db->query($select);

		//var_dump($query);

		//		$query = $this->db->join('tb_role as role','role.ID = user.roleID');
		//		$query = $this->db->get_where('tb_user as user' , array('user.ID' => $userID));

		//		return $query;
	}

	public function edit_user_info($condition, $userData, $flag)
	{
		if ($flag === 'details') {

			echo $condition;

			// TODO: update experience too
			$this->db->where('userID', $condition);
			$this->db->update('tb_details', $userData);
		}

		//		return $last_id = $this->db->insert_id();
	}


	// all request
	public function userRequest($first, $option = null)
	{
		$roleId = $this->session->userdata('roleID');

		if ($option == null) {
			$requests = "SELECT user.ID AS userID, fullName,email,userPic,roleID,permission_status,registeredOn, role.roleName FROM tb_user user LEFT JOIN tb_role role ON role.ID = roleID 
			WHERE user.ID != '" . $roleId . "' AND permission_status = '".$first."'";
		} else {
			$roleId = $this->session->userdata('roleID');
			$requests = "SELECT user.ID AS userID, fullName,email,userPic,roleID,permission_status,registeredOn, role.roleName FROM tb_user user LEFT JOIN tb_role role ON role.ID = roleID 
			WHERE user.ID != '" . $roleId . "' AND permission_status = '".$first."' OR permission_status = '".$option."'";
		}
		
		return $this->db->query($requests);
	}

	public function get_one_user($pro_id)
	{
		$this->db->select('*');
		$this->db->from('tb_user');
		$this->db->where('ID', $pro_id);
		$query = $this->db->get();
		if (count($query->result()) > 0) {
			return $query->row();
		}
	}

	// allow user 

	public function get_users($condition) {
		$roleId = $this->session->userdata('roleID');
		$requests = "SELECT user.ID AS userID, fullName,email,userPic,roleID,permission_status,registeredOn, role.roleName FROM tb_user user LEFT JOIN tb_role role ON role.ID = roleID 
		WHERE user.ID != '".$roleId."' AND permission_status = '".$condition."'";

		$query = $this->db->query($requests);

		if (count($query->result()) > 0) {
			return $query->result();
		}
		// return $this->db->query($requests);
	}

	public function user_permision($userID, $setValue){
		$this->permission_status = $setValue;
		return $this->db->update('tb_user', $this, array('ID'=> $userID));
	}

	public function dis_user($allow_id){
		$this->permission_status = 'domant';
		return $this->db->update('tb_user', $this, array('ID'=> $allow_id));
	}

	public function del_user($allow_id){
		return $this->db->delete('tb_user', array('ID'=> $allow_id));
	}
}

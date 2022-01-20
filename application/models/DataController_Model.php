<?php


class DataController_Model extends CI_Model
{
	//headers
	public function tittlesArray(){

		//Public
		$title 			= "PBMS ";
		$main_p 		= "Home";
		$active_class 	= "active";
		$title_full		= "PROJECT BUDGET MS";

		return array(
			'title'        => $title,
			'main_p'       => $main_p,
			'active_class' => $active_class,
			'title_full'   => $title_full
		);
	}

	public function purpose_option()
	{
		return array('material' => 'Material', 'risk' => 'Risk Management', 'salary' => 'Salary', 'others' => 'Others');
	}

	public function project_status()
	{
		return array(1 => 'Settings', 2 => 'On Hold', 3 => 'Cancelled', 4 => 'Complete');
	}




}
/*
 CREATE TABLE tb_role (
    ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    roleName VARCHAR(25) NOT NULL
);

 CREATE TABLE tb_user (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fullName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(900) NOT NULL,
    image VARCHAR(900) NULL,
    roleID INT NOT NULL, -- tb_role(ID)
    registeredOn DATE DEFAULT CURRENT_DATE(),

    CONSTRAINT FOREIGN KEY (roleID) REFERENCES tb_role(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_details (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    education VARCHAR(255) NULL,
    skill VARCHAR(255) NULL,
    location VARCHAR(900) NULL,
    userID INT NOT NULL, -- tb_user(ID)

    CONSTRAINT FOREIGN KEY (userID) REFERENCES tb_user(ID) ON DELETE CASCADE ON UPDATE CASCADE
);
*/

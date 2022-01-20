<?php


class Main_Model extends CI_Model {

    public function test_model() {
        # code...
        return 'This information come from model function';
    }

    public function chartS()
    {
        $selectSet = "SET @counter = 0" ;

        $select = "SELECT SUM(spentAmount) spent, budget, @counter:=@counter+1 AS noWeek FROM tb_project, tb_project_details WHERE  tb_project.ID = projectID AND projectID = '4' GROUP BY (SELECT EXTRACT(WEEK FROM spentOn)) ORDER BY (SELECT EXTRACT(WEEK FROM spentOn))";
		$query = $this->db->query($selectSet);
		$query = $this->db->query($select);

        // $query = $this->db->get('tb_project');
        return $query->result();
    }
    
}



/*
CREATE TABLE tb_role (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    roleName VARCHAR(25) NOT NULL
);

CREATE TABLE tb_status (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    statusName VARCHAR(25) NOT NULL
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


CREATE TABLE tb_project (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    projectName VARCHAR(255) NOT NULL,
    owner INT NOT NULL, -- tb_user(ID)
    leader INT NOT NULL,
    duration INT NOT NULL,
    budget DECIMAL (12, 2) NOT NULL,
    description VARCHAR(900) NULL,
    compName VARCHAR(900) NULL,
    status INT NOT NULL, -- tb_status(ID)
    createdOn DATE DEFAULT CURRENT_DATE(),

    CONSTRAINT FOREIGN KEY (owner) REFERENCES tb_user(ID) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (status) REFERENCES tb_status(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_project_budget (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    projectID INT NOT NULL, -- tb_project(ID)
    currentAmount DECIMAL (12, 2) NOT NULL,
    spentAmount DECIMAL (12, 2) NOT NULL,
    spentOn DATE DEFAULT CURRENT_DATE(),

    CONSTRAINT FOREIGN KEY (projectID) REFERENCES tb_project(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tb_project_files (
	ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    projectID INT NOT NULL, -- tb_project(ID)
    path VARCHAR(900) NOT NULL,
    uploadedDate DATE DEFAULT CURRENT_DATE(),

    CONSTRAINT FOREIGN KEY (projectID) REFERENCES tb_project(ID) ON DELETE CASCADE ON UPDATE CASCADE
);

*/

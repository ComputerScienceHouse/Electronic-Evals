<?php

class FreshmenProjModel extends Model{

	function FreshmenProjModel(){
		parent::Model();
		
		//load the database
		$this->load->database();
	}
	
	function getCurrentProject(){
	
		$result = $this->db->query("
			SELECT * FROM freshmenproject 
			ORDER BY id DESC LIMIT 1");
		
		return $result;
	}
	
	function getProject($year){
		
		$result = $this->db->query("
			SELECT * FROM freshmenproject 
			WHERE year = '".$year."'
			LIMIT 1");
		
		return $result;
	}
	
	function getNotes($year, $memid){
	
		$result = $this->db->query("
			SELECT freshmenprojectinfo.* , member.* , introprocess.*
			FROM member
			LEFT JOIN introprocess ON introprocess.member_id = member.id
			LEFT JOIN freshmenprojectinfo ON intro_process_id = introprocess.id
			LEFT JOIN freshmenproject 
				ON freshmenproject.id = freshmenprojectinfo.freshmen_project_id
			WHERE member.id = '" . $memid . "'
			AND freshmenproject.year = '" . $year . "'
			LIMIT 1");
				
		return $result;
		
	}
	
	function getCommitteeHeads($result){
	
		$row = $result->row();
		$pres = $row->president;
		$vice = $row->vice_president;
		$secretary = $row->secretary;
		$treasurer = $row->treasurer;
		
		//to guaranteee that the results show in a particular order,
		//union the different results together; no, a LEFT JOIN won't work
		$result = $this->db->query("
			SELECT first_name, last_name FROM member
			WHERE id = '" . $pres . "'
			UNION SELECT first_name, last_name FROM member
			WHERE id = '" . $vice . "'
			UNION SELECT first_name, last_name FROM member
			WHERE id = '" . $secretary . "'
			UNION SELECT first_name, last_name FROM member
			WHERE id = '" . $treasurer . "'");
	
		return $result;
	}
}

?>
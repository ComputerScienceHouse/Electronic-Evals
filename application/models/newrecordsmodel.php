<?php

class NewRecordsModel extends Model{

	function NewRecordsModel(){
		parent::Model();
		
		//load the database
		$this->load->database();
	}

	function recordMeeting($meetingtype, $quarter, 
		$week, $eventid, $year = 2009){
		
		$this->db->query("INSERT INTO meeting 
			(quarter, week, type_id, event_id, year)
			VALUES('" . $quarter . "', '" . $week . "', '" . $meetingtype . "',
			'" . $eventid . "', '" . $year . "')");
	
		//if success, return true
	}
	
	function recordAttendees($ids, $hostid, $eventid){
	
		for($i = 0; $i < sizeof($ids); ++$i){
			$this->db->query("INSERT INTO attendanceentry
				(member_id, host, event_id)
				VALUES ('" . $ids[$i] . "', '" . $hostid . "', '" . $eventid . "')");
		}
		
		//if success, return true
	}
	
	function createAttended(){
	
		$this->db->query("INSERT INTO canbeattended () VALUES()");
		
		return $this->db->call_function('insert_id');
	}	
}

?>
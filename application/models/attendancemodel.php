<?php

class AttendanceModel extends Model{

	function AttendanceModel(){
		parent::Model();
		
		//load the database
		$this->load->database();
	}
	
	function getAttendance($memberid, $year = 2009){
				
		$result = $this->db->query("
			SELECT meetingtype.id FROM attendanceentry
			LEFT JOIN meeting ON attendanceentry.id = meeting.id
			LEFT JOIN meetingtype ON meeting.type_id = meetingtype.id
			WHERE attendanceentry.member_id = " . $memberid);
		
		return $result;
	}
	
	function getTotalHouseMeetings($memberid, $year = 2009){
		
		//grab attendance records
		$result = $this->db->query("
			SELECT meetingtype.id FROM attendanceentry
			LEFT JOIN meeting ON attendanceentry.event_id = meeting.event_id
			LEFT JOIN meetingtype ON meeting.type_id = meetingtype.id
			WHERE attendanceentry.member_id = " . $memberid . "
			AND meetingtype.id = 1 AND meeting.year = " . $year);
	
		return $result->num_rows();
	}
	
	function getTotalCommitteeMeetings($memberid, $year = 2009){
		
		//grab attendance records
		$result = $this->db->query("
			SELECT meetingtype.id FROM attendanceentry
			LEFT JOIN meeting ON attendanceentry.event_id = meeting.event_id
			LEFT JOIN meetingtype ON meeting.type_id = meetingtype.id
			WHERE attendanceentry.member_id = " . $memberid . "
			AND meetingtype.id != 1 and meeting.year = " . $year);
		
		return $result->num_rows();
	}
	
	function getMissedHouseMeetings($memberid, $year = 2009){
		
		//grab meetings the member did not go to
		$result = $this->db->query("
			SELECT DISTINCT meeting.event_id, meeting.quarter, meeting.week
			FROM meeting
			LEFT JOIN attendanceentry ON 
				attendanceentry.event_id = meeting.event_id
			WHERE meeting.type_id = 1 AND meeting.year = 2009
			AND (meeting.event_id) NOT IN 
			(SELECT meeting.event_id
			FROM meeting
			LEFT JOIN attendanceentry ON
				attendanceentry.event_id = meeting.event_id
			WHERE meeting.type_id = 1 AND attendanceentry.member_id = 1)
			");
	
		if($result->num_rows() == 0){
			$result = "none";
		}
		return $result;
	}
	
	function getAllMembers(){
		
		$result = $this->db->query('SELECT * FROM member');
		
		return $result;
	}
	
	function getAllMeetings(){
		
		$result = $this->db->query('SELECT * FROM meetingtype');
		
		return $result;
	}
}


?>
<?php

class Attendance extends Controller{

	function Attendance(){
		parent::Controller();
	}
	
	function index(){
		$data = array(
			'msg' => ''
			);
		$this->load->view('attendance_records', $data);
	}
	
	function newRecords(){
	
		//load our needed models
		$this->load->model('attendancemodel');
		
		//grab data
		$members = $this->attendancemodel->getAllMembers();
		$meetings = $this->attendancemodel->getAllMeetings();
		
		$data = array(
			'members' => $members,
			'meetings' => $meetings
			);
			
		//load our views
		$this->load->view('newrecords', $data);
		
	}
	
	function submitRecords(){
		
		print_r($_POST);
		
		$ids = array();
	
		$i = 0;
		foreach($_POST as $key => $val){
			if($key == "hostName"){
				break;
			}
			else{
				$ids[$i] = $key;
				echo $ids[$i] . "\n";
				++$i;
			}
		}
		
		$this->load->model('newrecordsmodel');
		
		$eventid = $this->newrecordsmodel->createAttended();
		
		$this->newrecordsmodel->recordMeeting($_POST['meetingType'],
			$_POST['Quarter'], $_POST['Week'], $eventid);
			
		$this->newrecordsmodel->recordAttendees($ids, 
			$_POST['hostName'], $eventid);
		
		echo "Done!";
		
	}
	
	function viewAttendance($memid){
		
		//load our needed models
		$this->load->model('attendancemodel');

		//grab attendance totals
		$housetotal = $this->attendancemodel->getTotalHouseMeetings($memid);
		$committeetotal = 
			$this->attendancemodel->getTotalCommitteeMeetings($memid);
		$missedhouse = $this->attendancemodel->getMissedHouseMeetings($memid);
		
		//store in an array to be passed to the view
		$data = array(
			'housetotal' => $housetotal,
			'committeetotal' => $committeetotal,
			'missedhouse' => $missedhouse
			);
		
		//finally, load the view
		$this->load->view('attendance_records', $data);
	}
}

?>
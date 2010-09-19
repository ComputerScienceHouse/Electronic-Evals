<?
class Spring extends Controller{

	function Spring(){
		parent::Controller();
		$this->load->model('majorprojmodel');
		$this->load->model('attendancemodel');
	}

	function showMember($memid){
	
		//grab attendance totals
		$housetotal = $this->attendancemodel->getTotalHouseMeetings($memid);
		$committeetotal = 
			$this->attendancemodel->getTotalCommitteeMeetings($memid);
		$missedhouse = $this->attendancemodel->getMissedHouseMeetings($memid);
		
		//grab major project results
		$majorproj = $this->majorprojmodel->getProject($memid);
		
		//store in an array to be passed to the view
		$attendancedata = array(
			'housetotal' => $housetotal,
			'committeetotal' => $committeetotal,
			'missedhouse' => $missedhouse
			);
		
		$projdata = array(
			'majorproj' => $majorproj
		);
			
		//finally, load the view
		$this->load->view('attendance_records', $attendancedata);
		$this->load->view('majorproject', $projdata);
	}
}
?>
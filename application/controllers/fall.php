<?php

class Fall extends Controller{

	function Fall(){
		parent::Controller();
		$this->load->model('freshmenprojmodel');
		$this->load->model('packetprocess');
	}

	function showMember($memid, $year){
		
		
		
		$project = $this->freshmenprojmodel->getCurrentProject();
		$heads = $this->freshmenprojmodel->getCommitteeHeads($project);
		$notes = $this->freshmenprojmodel->getNotes($year, $memid);
		$packetinfo = $this->packetprocess->getStatus($memid);
		
		$projdata = array(
			'project' => $project,
			'heads' => $heads
		);
		
		$notesdata = array(
			'notes' => $notes,
			'year' => $year
		);
		
		$this->load->view('viewpacketstatus', $packetinfo);
		$this->load->view('viewproject', $projdata);
		$this->load->view('viewnotes', $notesdata);
		//$this->attendance->viewAttendance($memid);
		
	}
	
	function updatePacket(){
	
		//determine which users were checked
		$sigs = array();
	
		$i = 0;
		foreach($_POST as $key => $val){
			if($key != "submit"){
				$sigs[$i] = $key;
			}
			$i++;
		}
		
		//pass to the model for processing
		$memid = 1;//GRAB FROM SESSION
		$this->packetprocess->updatePacket($memid, $sigs);
		
		//need to someone obtain the year so that it loads properly for
		//future years.  I may write a CI library that determines which
		//academic year we are in so that it can be done automatically
		//except to see hard-coded lines like this replaced with something
		//like that in a future version
		$this->showMember($memid, 2010);
	}
}
?>
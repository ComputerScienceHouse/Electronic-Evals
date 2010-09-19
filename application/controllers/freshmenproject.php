<?php

class FreshmenProject extends Controller{

	function FreshmenProject(){
		parent::Controller();
		$this->load->model('freshmenprojmodel');
	}
	
	function viewCurrent(){
	
		$project = $this->freshmenprojmodel->getCurrentProject();
		$heads = $this->freshmenprojmodel->getCommitteeHeads($project);
		
		$data = array(
			'project' => $project,
			'heads' => $heads
		);
	
		$this->load->view('viewproject', $data);
	}
	
	function viewNotes($year, $memid){
	
		$notes = $this->freshmenprojmodel->getNotes($year, $memid);
		
		$data = array(
			'notes' => $notes,
			'year' => $year
			);
		
		$this->load->view('viewnotes', $data);
	}
	
	function viewproject($year){
	
	}
	
	function create(){
	
	}
}
?>
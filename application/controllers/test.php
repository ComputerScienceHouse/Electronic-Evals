<?php

class Test extends Controller{

	function Test(){
		parent::Controller();
	}
	
	function index(){
		$this->load->model('testmodel');
		$this->testmodel->doStuff();
		$this->load->view('test');
	}
}
?>
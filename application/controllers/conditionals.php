<?

class Conditionals extends Controller{

	function Conditionals(){
		parent::Controller();
	
		$this->load->model('conditionalsmodel');
	}
	
	function viewConditional($memid){
	
		$cond = $this->conditionalsmodel->getConditional($memid);
	
		$data = array(
			'conditional' => $cond
		);
		
		$this->load->view('conditionals', $data);
	}
}

?>
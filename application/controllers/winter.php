<?

class Winter extends Controller{

	function Winter(){
		parent::Controller();
		$this->load->model('winterresultmodel');
	}
	
	function getResult($memid, $year=2010){
	
		$winterstatus = $this->winterresultmodel->getStatus($memid, $year);
	
		$data = array(
			"winterstatus" => $winterstatus
		);
		
		$this->load->view('winterresult', $data);
	}
	
	function getAllResults($year=2010){
	
		$winterstatus = $this->winterresultmodel->getAllStatus($year);
		
		$data = array(
			'winterstatusall' => $winterstatus
		);
	
		$this->load->view('winterresult', $data);
	}

}

?>
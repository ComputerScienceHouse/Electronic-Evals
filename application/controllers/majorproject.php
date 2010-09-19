<?

class MajorProject extends Controller{

	function MajorProject(){
		parent::Controller();
	
		$this->load->model('majorprojmodel');
	}

	function viewMajorProject($memid){
	
		$result = $this->majorprojmodel->getProject($memid);

		$data = array(
			'majorproj' => $result
		);
		
		$this->load->view('majorproject', $data);
	}
	
	function addMajorProject(){
		
		$title = $this->input->post('title');
		$commitid = $this->input->post('commitid'); 
		$desc = $this->input->post('desc');
		
		$memid = 1;//PULL FROM SESSION
		$this->majorprojmodel->createProject($memid, $title, $commitid, $desc);
		
		$this->viewMajorProject($memid);
	}
}
?>
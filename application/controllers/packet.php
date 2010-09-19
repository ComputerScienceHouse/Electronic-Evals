<?

class Packet extends Controller{

	function Packet(){
		parent::Controller();

		$this->load->model('packetprocess');
	}

	function viewStatus($memid){

		$packetinfo = $this->packetprocess->getStatus($memid);
		
		$this->load->view('viewpacketstatus', $packetinfo);
	}
}
?>
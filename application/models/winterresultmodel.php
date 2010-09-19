<?

class WinterResultModel extends Model{

	function WinterResultModel(){
		parent::Model();
		$this->load->database();
	}
	
	function getStatus($memid, $year){
	
		$result = $this->db->query("
			SELECT winterevalinfo.*, winterevalresult.* 
			FROM member
			LEFT JOIN winterevalinfo ON winterevalinfo.member_id = member.id
			LEFT JOIN winterevalresult ON winterevalresult.winter_eval_id = winterevalinfo.id
			WHERE member.id = '".$memid."' AND winterevalinfo.school_year = '".$year."' LIMIT 1");
			
		return $result;
	}
	
	function getAllStatus($year){
	
		$result = $this->db->query("
			SELECT member.*, winterevalresult.* 
			FROM member
			LEFT JOIN winterevalinfo ON winterevalinfo.member_id = member.id
			LEFT JOIN winterevalresult ON winterevalresult.winter_eval_id = winterevalinfo.id
			WHERE winterevalinfo.school_year = '".$year."'");
			
		return $result;
	}
}
?>
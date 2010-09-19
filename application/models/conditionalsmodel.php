<?

class ConditionalsModel extends Model{

	function ConditionalsModel(){
		parent::Model();
		
		//load the database
		$this->load->database();
	}

	function getConditional($memid){
	
		$result = $this->db->query("
			SELECT member.*, conditional.* FROM member
			LEFT JOIN introprocess ON introprocess.member_id = member.id
			LEFT JOIN conditional ON evaluation_id = introprocess.conditional_id
			WHERE member.id = '".$memid."'
			AND conditional.date_completed = '0000-00-00'
			ORDER BY conditional.date_given ASC");

		return $result;

	}

}


?>
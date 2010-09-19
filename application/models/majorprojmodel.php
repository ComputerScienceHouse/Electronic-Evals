<?

class MajorProjModel extends Model{

	function MajorProjModel(){
		parent::Model();
		
		$this->load->database();
	}

	function getProject($memid){
	
		//grab all of the member's major proejcts
		$result = $this->db->query("
			SELECT majorproject.*, majorprojectresult.*, projectcategory.name
			FROM member
			LEFT JOIN membermajorprojectmapping ON membermajorprojectmapping.member_id = member.id
			LEFT JOIN majorproject ON majorproject.id = membermajorprojectmapping.project_id
			LEFT JOIN majorprojectresult ON majorprojectresult.project_id = majorproject.id
			LEFT JOIN projectcategory ON projectcategory.id = majorproject.committee_id
			WHERE member.id = '".$memid."' ORDER BY membermajorprojectmapping.id DESC");
	
		return $result;
	}
	
	function createProject($memid, $title, $commitid, $desc){
	
		$this->db->query("
			INSERT INTO majorproject
			(title, committee_id, description) 
			VALUES ('".$title."', '".$commitid."', '".$desc."')");
			
		$this->db->query("
			INSERT INTO membermajorprojectmapping
			(project_id, member_id)
			VALUES (LAST_INSERT_ID(), '".$memid."')");
	
	
	}

}
?>
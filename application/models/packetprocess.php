<?

class PacketProcess extends Model{

	function PacketProcess(){
		parent::Model();
		$this->load->database();
	}
	
	function updatePacket($memid, $sigs){
	
		//loop through each signature
		foreach($sigs as $id){

			//insert an entry into the signature table for the given member
			//and for each other member's id
			//the first sub-query gets the packet_id, or the member who
			//obtained the signature.  The second sub-query obtains the 
			//signature ID of the member
			$this->db->query("
				INSERT INTO signature
				(packet_id, signer_id)
				VALUES (
					(SELECT packetinfo.id
					FROM introprocess
					LEFT JOIN packetinfo ON 
						packetinfo.process_id = introprocess.id
					WHERE introprocess.member_id = '".$memid."'
					ORDER BY introprocess.id DESC LIMIT 1),
					(SELECT id FROM packetdefinitionmember
					WHERE member_id = '".$id."'
					ORDER BY id DESC LIMIT 1))
			");		
		}	
	}
	
	function getMaxSigCount(){
	
		$result = $this->db->query(
			"SELECT packetdefinitionmember.id 
			FROM packetdefinition
			LEFT JOIN packetdefinitionmember ON 
				packetdefinition.id = 
				packetdefinitionmember.packet_definition_id
			WHERE packetdefinition.id = 
				(SELECT packetdefinition.id 
				FROM packetdefinition 
				ORDER BY packetdefinition.id DESC LIMIT 1)");		
				
		return $result->num_rows();
	}

	function getStatus($memid){
	
		//so the below is retarded, and I know it.  A better idea would be
		//to modify the mySQL table "packetinfO" to include a simple counter
		//dunno why i didn't afterwards, expect it in the next version of this
		//file
		$result = $this->db->query("
			SELECT signature.id, packetinfo.date_assigned, packetinfo.date_due,
			packetinfo.date_submitted, packetinfo.committee_info,
			packetinfo.projects_info, packetinfo.notes
			FROM member
			LEFT JOIN introprocess ON introprocess.member_id = member.id
			LEFT JOIN packetinfo ON packetinfo.process_id = introprocess.id
			LEFT JOIN signature ON signature.packet_id = packetinfo.id
			LEFT JOIN packetdefinitionmember ON 
				packetdefinitionmember.id = signature.signer_id
			WHERE member.id = '".$memid."'");
	
		$totalsigs = $result->num_rows();
		
		$numeboard = $this->db->query("
			SELECT signature.id FROM member
			LEFT JOIN introprocess ON introprocess.member_id = member.id
			LEFT JOIN packetinfo ON packetinfo.process_id = introprocess.id
			LEFT JOIN signature ON signature.packet_id = packetinfo.id
			LEFT JOIN packetdefinitionmember ON 
				packetdefinitionmember.id = signature.signer_id
			WHERE member.id = '".$memid."' 
			AND packetdefinitionmember.eboard = 1");
			
		$numoff_floor = $this->db->query("
			SELECT signature.id FROM member
			LEFT JOIN introprocess ON introprocess.member_id = member.id
			LEFT JOIN packetinfo ON packetinfo.process_id = introprocess.id
			LEFT JOIN signature ON signature.packet_id = packetinfo.id
			LEFT JOIN packetdefinitionmember ON 
				packetdefinitionmember.id = signature.signer_id
			WHERE member.id = '".$memid."' 
			AND packetdefinitionmember.off_floor = 1");
			
		$membersigs = $totalsigs - $numeboard->num_rows() 
			- $numoff_floor->num_rows();
		$maxsigs = $this->getMaxSigCount();
		
		//grab all missing sigs
		$missingsigs = $this->db->query("
			SELECT packetdefinitionmember.id, member.first_name, 
				member.last_name, member.id AS member_id
			FROM packetinfo
			LEFT JOIN packetdefinitionmember ON 
				packetdefinitionmember.packet_definition_id = 
				packetinfo.packet_definition_id
			LEFT JOIN member ON member.id = packetdefinitionmember.member_id
			WHERE (packetdefinitionmember.id) NOT IN 
			(SELECT packetdefinitionmember.id
			FROM signature
			LEFT JOIN packetinfo ON packetinfo.id = signature.packet_id
			LEFT JOIN introprocess ON introprocess.id = packetinfo.process_id
			LEFT JOIN packetdefinitionmember ON 
				packetdefinitionmember.id = signature.signer_id
			LEFT JOIN member ON member.id = packetdefinitionmember.member_id
			WHERE introprocess.member_id ='".$memid."')");
		
		if($missingsigs->num_rows() == 0){
			$missingsigs = "none";
		}
		$siginfo = array(
			'totalmembersigs' => $membersigs,
			'totaleboardsigs' => $numeboard,
			'totalnumoff_floor' => $numoff_floor,
			'maxsigs' => $maxsigs,
			'membersigs' => $result,
			'missingsigs' => $missingsigs
		);
		
		return $siginfo;
	}

}
?>
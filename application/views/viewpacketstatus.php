<html>

<h1>Packet Status</h1>

<?

$this->load->helper('form');

if(isset($totalmembersigs)){

	//extract date info
	$info = $membersigs->row();
	$duedate = $info->date_due;
	$dateassigned = $info->date_assigned;
	$datesubmitted = $info->date_submitted;
	$notes = $info->notes;
	$commitinfo = $info->committee_info;
	$projinfo = $info->projects_info;
	
	//print due date for packet/date it was submitted
	if($datesubmitted != 0000-00-00){ 
		echo "Date Submitted: " 
			. date("l, M d", strtotime($datesubmitted));
	}
	else{
		?>
		Date Given: <? echo date("l, M d", strtotime($dateassigned)); ?>
		<br>
		<b>Due Date: <? echo date("l, M d", strtotime($duedate)) . "</b>";
	}
	?>
	<br><br>
	<?
	echo ($totalmembersigs / $maxsigs * 100) . "% Complete<br>"
		. "Total Member Signatures: " . $totalmembersigs . "<br>"
		. "Total E-Board Signatures: " . $totaleboardsigs->num_rows() . "<br>"
		. "Total Off-floor Signatures: " . $totalnumoff_floor->num_rows() 
		. "<br>";
		
	 if($missingsigs != "none"){
		?><h3>Missing Signatures</h3><?
	
		echo form_open('fall/updatePacket');
		
		//display checkboxes for user to indicate if they got their signature
		foreach($missingsigs->result() as $needsig){
			echo $needsig->first_name . " " 
				. $needsig->last_name;
			
			echo form_checkbox($needsig->member_id, '1', FALSE) . "<br>";
		}
		
		echo form_submit('submit', 'Update Packet');
		echo form_close() . "<br>";
	}
	?>
	
	<br>
	Notes:<br>
	<? 
	echo $notes;
	?><br><br><?
	if($commitinfo){
		echo "Committee information filled out";
	}
	else{
		echo "Committee inforation needs to be filled out";
	}
	if($projinfo){
		echo "<br>Project information filled out";
	}
	else{
		echo "<br>Project information needs to be filled out";
	}
	
	
	
}
else{
echo "WTF?";
}




?>


</html>
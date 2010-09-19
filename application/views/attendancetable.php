<html>
<?php

//load the database
$this->load->database();

//create table tag and fill top left corner with a blank
echo "<table border=\"1\">\n
		<tr><td>&nbsp;</td>";
		
//grab all the meetings from 10 weeks ago in order of their insertion ID.  This will be used
//to build the header of the table as we will only get the last 10 week and quarter #s, not actual
//records or anything else
$weekresult = $this->db->query("SELECT meeting.week, meeting.quarter
					FROM meeting
					GROUP BY meeting.week, meeting.quarter
					ORDER BY meeting.id
					DESC
					LIMIT 10");

//print table header - nothing special
foreach($weekresult->result_array() as $resultA){
	echo "<td>" . $resultA['quarter'] . " - " . $resultA['week'] . "</td>";
}

//alright, so now we want the name and meetingID for the meetings we want to show
//the user as attended, this is going to form the left most column
$meetingresult = $this->db->query("SELECT name, id FROM meetingtype WHERE id < 12");

foreach($meetingresult->result_array() as $meetingresultA){
	
	//reset the week results so that we can use them again for the next row
	//$this->db->call_function('mysql_data_seek', $weekresult, 0);
	
	//vars
	$meetingname = $meetingresultA['name'];
	$meetingID = $meetingresultA['id'];
	
	//print off the row header
	echo "<tr><td>" . $meetingname . "</td>\n";
	
	//loop through each week
	foreach($weekresult->result_array() as $weekRA){
	
		//vars
		$week = $weekRA['week'];
		$quarter = $weekRA['quarter'];
		
		//grab all the meetings of the same type of each week
		$eventResult = $this->db->query("
			SELECT meeting.event_id 
			FROM meeting
			WHERE meeting.type_id = '" . $meetingID . "' AND meeting.week = '" . $week . "'
			AND meeting.quarter = '" . $quarter . "'");
			
		//so now we check to see if the meeting exists
		if($eventResult->num_rows() == 0){
			
			//the meeting for this week, of this quarter, of that type was never held
			//so we need to correctly mark this meeting so as not to confuse the user
			//that they "missed" a meeting that was never held
			echo "<td><center>---</center></td>\n";
		}
		else{ 
		
			//the meeting was held, so we should proceed to check if the user actually
			//went to the meeting
			
			//grab the event id of the meeting
			$eventRA = $eventResult->row_array();
			$eventID = $eventRA['event_id'];
			
			//alright, so the meeting actually exists, lets now see if the user attended it or not
			$attendedResult = $this->db->query("
				SELECT id 
				FROM attendanceentry
				WHERE id = '" . $memberid . "' AND event_id = '" . $eventID . "'");
				
			//check if we found the user
			if(mysql_num_rows($attendedResult) == 0){
				
				//the user was not there, place an X
				echo "<td><center>";
				echo "<img src=\"images/redx.png\" alt=\"You did not attend this meeting\"></img>";
				echo "</center></td>\n";
			}
			else{
				
				//we found their attendance record, mark it with a "check"
				echo "<td><center>";
				echo "<img src=\"images/check.png\" alt=\"You attended this meeting\"></img>";
				echo "</center></td>\n";
			}
		}
	}//END weekresult WHILE loop
	
	//end the row for this meeting type
	echo "</tr>\n";
}
echo "</tr>\n
</table>";

?>
</html>
<?php
	
	//do a basic security check
	
	
?>

<html>
<head>
<title>Attendance Entry - Electronic Evals</title>
<script type="text/javascript">
	var baseurl = "<? echo base_url();?>";
</script>
<script src="<?=site_url('scripts/prototype.js')?>" type="text/javascript"></script>
<script src="<?=site_url('scripts/newrecords.js')?>" type="text/javascript"></script>
<script src="<?=site_url('scripts/scriptaculous.js')?>" type="text/javascript"></script>
</head>

<table border="0">
<?php

//create the form
echo form_open('attendance/submitRecords') . "\n";

$i = 0;
$c = 0;
echo "<tr><td>";
	
//loop through all the retrieved members
foreach($members->result() as $row){

	//dump the DB result contents
	$firstname = $row->first_name;
	$lastname = $row->last_name;
	$id = $row->id;
	
	//print out a new column
	if($c < 4){
		?>
		<input type="checkbox" value="0" id="<?php echo $i; ?>" name="<?php echo $id;?>">
		<?php
		echo $firstname . " " . $lastname . "<br>";
		$c++;
	}
	else{
		$c = 0;
		?>
		</td>
		<td style="text-align:top">
		<input type="checkbox" value="1" id="<?php echo $i; ?>" name="<?php echo $id;?>">
		<?php
		echo $firstname . " " . $lastname . "<br>";
		$c++;
	}

	$i++;
}
?>
</tr>
</table>
<br>
Host's Name:
<br>
<input type="textfield" name="hostName" id="hostName">
<br>
Meeting Type: 
<br>
<input type="button" id="attendanceSelector" onClick="toggleAttendance()" value="Seminar Entry">
<br>
<br>
<div id="attendancestuff">
Meeting:
<br>
<?php
	
	//print out all the different meetings into the form of a drop-down menu
	echo "<select id=\"meetingType\" name=\"meetingType\">n";
	foreach($meetings->result_array() as $row){
		echo "<option value=\"" . $row['id'] . "\" name=\"" . $row['name'] . "\">" . $row['name'] . "</option>n";
	}
?>

</select>
</div>
<br>
Date:
<br>
<select id="Quarter" name="Quarter">
	<option value="1" id="qtr1">Q1</option>
	<option value="2" id="qtr2">Q2</option>
	<option value="3" id="qtr3">Q3</option>
</select>
<select id="Week" name="Week">
	<option value="1" id="wk1">W1</option>
	<option value="2" id="wk2">W2</option>
	<option value="3" id="wk3">W3</option>
	<option value="4" id="wk4">W4</option>
	<option value="5" id="wk5">W5</option>
	<option value="6" id="wk6">W6</option>
	<option value="7" id="wk7">W7</option>
	<option value="8" id="wk8">W8</option>
	<option value="9" id="wk9">W9</option>
	<option value="10" id="wk10">W10</option>
</select>

<?php
echo br(2);
echo form_submit('submit', 'Add Records');
echo form_close();
?>
<br>
<br>
</html>
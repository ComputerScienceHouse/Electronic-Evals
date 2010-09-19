<html>

<h1>Freshmen Project</h1>

<?php

if(isset($project)){

	echo "Current Project: <br>President | Vice-President | Secretary | Treasurer<br>";
	
	//print out project information
	$proj = $project->row();
	
	foreach($heads->result() as $row){
		echo $row->first_name . " " . $row->last_name;
		echo " | ";
	}
	?>
	<br><br>
	<p>Money Raised: <? echo $proj->money_raised; ?>
	<br>
	<? echo $proj->description;
	?></p><?
	
}



?>

<html>
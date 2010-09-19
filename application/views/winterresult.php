<html>

<h1>Winter Evaluations Result</h1>
<?
if(isset($winterstatusall)){

	echo "<br>";
	foreach($winterstatusall->result() as $status){
	
		$name = $status->first_name . " " . $status->last_name;
		$points = $status->housing_points_earned;
	
		echo $name . " - " . $points . " points<br>";
	}
}
else if(isset($winterstatus)){

	$status = $winterstatus->row();
	
	?> <h3> <? echo $status->school_year; ?> </h3><?
	echo "<br><h4>Project Info:</h4>" . $status->project_info;
	echo "<br><h4>Event Info:</h4>" . $status->event_info;
	echo "<br><h4>Future Info:</h4>" . $status->future_info;
	echo "<br>". $status->housing_points_earned . " points";

}

?>

</html>
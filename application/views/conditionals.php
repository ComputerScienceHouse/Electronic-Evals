<html>



<?

//FIX ME LATER
foreach($conditional->result() as $cond){

	$startdate = $cond->date_given;
	$enddate = $cond->date_due;
	$compdate = $cond->date_completed;
	$desc = $cond->description;
	$reason = $cond->reason;
	?>

	Start/Due Date:<br>
	<? echo $startdate . " - " . $enddate; ?>
	<br>
	Completed Date:<br>
	<? echo $compdate; ?>
	<br>
	<br>
	Description:<br>
	<? echo $desc; ?>
	<br>
	Reason:<br>
	<? echo $reason; ?>
<br>
<br>
	
<?}?>

</html>
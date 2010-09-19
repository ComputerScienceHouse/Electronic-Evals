<?

//convert the database result to a single row
$info = $notes->row();

//extract some data
$year = $year;
$name = $info->first_name . " " . $info->last_name;

$personalnotes = $info->notes;
$passed = $info->passed;
$account = $info->account;
$startdate = $info->date_started;
$enddate = $info->date_completed;


?>



<h1> <? echo $year; ?> Freshmen Project Notes </h1>

<?

echo $startdate . " - " . $enddate;
?>
<br>
<?
echo $personalnotes;





?>
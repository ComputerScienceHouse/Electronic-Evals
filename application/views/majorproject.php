<?

$this->load->helper('form');
$this->load->helper('html');

?>

<html>

<h1>Major Projects</h1>

<?
 
if(isset($majorproj)){

	foreach($majorproj->result() as $proj){
	
		$title = $proj->title;
		$comitname = $proj->name;
		$desc = $proj->description;
		$pass = $proj->passed == 1 ? "PASSED" : "";
		$date = $proj->date;
	
		?>
		
		<h3><? echo $title;?></h3>
		<? echo "Committee: " . $comitname . "<br> " . $date . " <b>" . $pass . "</b>";?><br>
		<? echo $desc;?>
		
		<br><hr><br>
		
	<?}

}

?><h3>Create a new Major Project</h3><br><?

//create form for submitting new projects
echo form_open('majorproject/addMajorProject') . "\n";
	echo form_label('Title: '); echo form_input('title') . br() . "\n";
	echo form_label('Committee: '); echo form_input('commitid') . br() . "\n";
	echo form_label('Description: ') . br() . "\n"; 
	$attr = array(
		'name' => 'desc',
		'rows' => '8',
		'cols' => '75'
	);
	echo form_textarea($attr) . br() . "\n";
	echo form_submit('submit', 'Create Project') . "\n";
echo form_close();
br();

?>



</html>
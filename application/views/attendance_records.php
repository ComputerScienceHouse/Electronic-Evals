<html>

<h1>Attendance Records</h1>
<?php
$this->load->helper('form');
$this->load->helper('html');

echo "Total House meetings attended: " . $housetotal . " of 13" . br(2);
echo "Total Committee meetings attended: " . $committeetotal . " of 25" 
	. br(2);
if($missedhouse != "none"){
	echo "You missed House meetings on these dates:" . br();
	foreach($missedhouse->result() as $row){
		echo "Quarter " . $row->quarter . " week " . $row->week . br();
	}
}
/*
br(3);
echo form_open('attendance/submitAttendance');
	echo form_label('Username:  ');
	echo form_input('username') . br();
	echo form_submit('submit', 'Add Record');
echo form_close();
br(3);
*/
?>
</html>
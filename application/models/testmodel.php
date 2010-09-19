<?php

class TestModel extends Model{

	function TestModel(){
		parent::Model();
	}
	
	function doStuff(){
	
		$this->load->database();
		
		$query = $this->db->query("SELECT * FROM `Users`");

		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
			  echo $row->id . " - ";
			  echo $row->FirstName . " ";
			  echo $row->LastName;
		   }
		}
		else{
			echo "That was a bad query!";
		}
	}
}

?>
<?php

class TestModel extends Model{

	function TestModel(){
		parent::Model();
	}
	
	function doStuff(){
	
		$this->load->database();
		
		$query = $this->db->query("YOUR QUERY");

		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
			  echo $row->title;
			  echo $row->name;
			  echo $row->body;
		   }
		}
		else{
			echo "That was a bad query!";
		}
	}
}

?>
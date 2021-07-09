<?php
require_once "config.php";

  if(isset($_GET['id'])){
	
	  $id= $_GET['id'];
	  
	  $sql = "DELETE FROM `todo_task` WHERE id=$id";

	if ($link->query($sql) === TRUE) {
		echo "Record deleted successfully";
		header("Location: index.php");
	} else {
		echo "Error deleting record: " . $link->error;
	}

	$link->close();
	  
  }


 ?>
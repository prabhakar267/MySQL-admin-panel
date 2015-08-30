<?php
require_once "inc.database.php";

if(isset($_POST["submit"])){
	$fname = trim($_POST["fname"]);
	$lname = trim($_POST["lname"]);
	$marks = (int)$_POST["marks"];
	
	if($fname != "" AND $lname != "" AND $marks != ""){
		$connectionStatus = connect_db();
		$status = insert_data($connectionStatus, $fname, $lname, $marks);
		if($status){
			header("Location: index.php?id=success&msg=Insertion was successfull");
		} else {
			header("Location: index.php?id=success&msg=Error: Insertion Error");
		}
	} else {
		header("Location: index.php?id=error&msg=Error: All fields mandatory");
	}
}
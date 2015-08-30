<?php
require_once "inc.database.php";

if(isset($_POST["submit"])){
	$id = (int)$_POST["id"];
	$choice = $_POST["choice"];
	$newValue = $_POST["update-value"];

	if($id != "" AND $choice != "" AND $newValue != ""){
        $connectionStatus = connect_db();
        $status = update_data($connectionStatus, $id, $choice, $newValue);
		if($status){
			header("Location: index.php?id=success&msg=updation was successfull");
		} else {
			header("Location: index.php?id=error&msg=Invalid data entered!");
		}
	} else {
		header("Location: index.php?id=error&msg=Error: All fields mandatory");
	}
}

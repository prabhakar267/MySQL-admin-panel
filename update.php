<?php
 

if(isset($_POST["submit"])){
	$id = $_POST["id"];
	$choice = $_POST["choice"];
	$newValue = $_POST["update-value"];

	
	if($id != "" AND $choice != "" AND $newValue != ""){
          include "inc.database.php";
        $connectionStatus = connect_db();
        $status = update_data($connectionStatus, $id, $choice, $newValue);
			if($status){
				header("Location: index.php?id=success&v=updation was successfull");
			}else{
				header("Location: index.php?id=success&v=Error: Incorrect User Id");
			}
	}
	else {header("location:index.php?id=error&v=Error: All fields mandatory");
	}


}
 else{
	header("location:index.php");
}

?>
<?php
 

if(isset($_POST["submit"])){
	              
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$marks = $_POST["marks"];
	
	if($fname != "" AND $lname != "" AND $marks != ""){
          include "inc.database.php";
        $connectionStatus = connect_db();
        $status = insert_data($connectionStatus, $fname, $lname, $marks);
			if($status){
				header("Location: index.php?id=success&v=Insertion was successfull");
			}else{
				header("Location: index.php?id=success&v=Error: Insertion Error");
			}
	}
	else {header("location:index.php?id=error&v=Error: All fields mandatory");
	}


}
 else{
	header("location:index.php");
}

?>
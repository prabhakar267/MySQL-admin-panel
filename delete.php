<?php
 

if(isset($_POST["submit"])){
	$id = $_POST["id"];
	
	if($id != ""){
          include "inc.database.php";
        $connectionStatus = connect_db();
        $status = delete_data($connectionStatus, $id);
			if($status){
				header("Location: index.php?id=success&v=Deletion was successfull");
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
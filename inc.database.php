<?php
function connect_db(){
    $connectionStatus = mysqli_connect("localhost", "root", "696163", "basic phpmyadmin");
    if(!$connectionStatus){
        echo "Error connecting database";
        die;
    }
    return $connectionStatus;
}

function select_data($connectionStatus){
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($connectionStatus, $query);
    if(mysqli_num_rows($result) > 0){
       mysqli_close($connectionStatus);
       return $result;
    }
    return false;
}

function insert_data($connectionStatus, $fname, $lname, $marks){
	$query = "INSERT INTO `users`(`fname`,`lname`,`marks`) VALUES ('$fname','$lname','$marks')";
	$result = mysqli_query($connectionStatus, $query);
		
	
	if(mysqli_affected_rows($connectionStatus)){
        return true;
    }
        return false;
	
}

function update_data($connectionStatus, $id, $choice, $newValue, $marks){
	if ($choice == "marks"){
	   $query = "UPDATE `users` SET `marks`='$newValue' WHERE `id`=$id";
	} else if($choice == "fname"){
        $query = "UPDATE `users` SET `fname`='$newValue' WHERE `id`=$id";
    } else if($choice == "lname"){
        $query = "UPDATE `users` SET `lname`='$newValue' WHERE `id`=$id";
    }
    
    $result = mysqli_query($connectionStatus, $query);
    
	if(mysqli_affected_rows($connectionStatus)){
        return true;
    } 
    return false;
}

function delete_data($connectionStatus, $id){
	$query = "DELETE FROM `users` WHERE `id` = $id";
	$result = mysqli_query($connectionStatus, $query);
    
	if(mysqli_affected_rows($connectionStatus)){
        return true;
    }
    return false;
}


?>
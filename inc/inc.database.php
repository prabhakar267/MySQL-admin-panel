<?php


// establish connection with mysql database
function connect_db(){
    require_once 'config.php';
    
    $connectionStatus = mysqli_connect($MYSQL_HOSTNAME, $MYSQL_USERNAME, $MYSQL_PASSWORD, $MYSQL_DATABASE);
    if(!$connectionStatus){
        echo "Error connecting database";
        die;
    }
    return $connectionStatus;
}

// fetch all data from database
function select_data($connectionStatus){
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($connectionStatus, $query);
    if(mysqli_num_rows($result) > 0){
       mysqli_close($connectionStatus);
       return $result;
    }
    return false;
}

// insert a new row in database
function insert_data($connectionStatus, $fname, $lname, $marks){
	$query = "INSERT INTO `users`(`fname`,`lname`,`marks`) VALUES ('$fname','$lname','$marks')";
	$result = mysqli_query($connectionStatus, $query);

	if(mysqli_affected_rows($connectionStatus)){
        return true;
    } else {
        return false;
    }
}

//update data for any row
function update_data($connectionStatus, $id, $choice, $newValue, $marks){
    $query = "UPDATE `users` SET ";

    if($choice == "marks"){
	   $query .= "`marks`='$newValue'";
	} else if($choice == "fname"){
        $query .= "`fname`='$newValue'";
    } else if($choice == "lname"){
        $query .= "`lname`='$newValue'";
    }

    $query .= " WHERE `id`=$id"; 
    
    $result = mysqli_query($connectionStatus, $query);
    
	if(mysqli_affected_rows($connectionStatus)){
        return true;
    } else {
        return false;
    }
}

function delete_data($connectionStatus, $id){
	$query = "DELETE FROM `users` WHERE `id` = $id";
	$result = mysqli_query($connectionStatus, $query);
    
	if(mysqli_affected_rows($connectionStatus)){
        return true;
    }
    return false;
}

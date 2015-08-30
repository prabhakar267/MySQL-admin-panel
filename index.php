<?php
	require_once "inc.database.php";
	$connectionStatus = connect_db();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="prabhakar gupta">
	<title>Basic MySQL Admin Panel</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>
    <div class="col-md-12" id="wrapper">
    	<div class="row">
        	<div class="col-md-2">
	            <div class="form-wrapper">
	                <form method="post" action="insert.php">
		                <input class="form-control" name="fname" placeholder="Enter first name" required>
		                <input class="form-control" name="lname" placeholder="Enter last name" required>
						<input class="form-control" name="marks" placeholder="Enter marks" required>
		                <button type="submit" class="btn btn-success" name="submit">INSERT</button>
	                </form>
	            </div>
	            <div class="form-wrapper">
	                <form method="post" action="update.php">
						<select class="form-control" name="choice">
							<option>Choose field</option>
							<option value="fname">First Name</option>
							<option value="lname">Last Name</option>
							<option value="marks">Marks</option>
						</select>
						<input class="form-control" name="id" placeholder="User ID" required>
		                <input class="form-control" name="update-value" placeholder="Enter new value" required>
		                <button type="submit" class="btn btn-warning" name="submit">UPDATE</button>
	                </form>
	            </div>
	            <div class="form-wrapper">
	                <form method="post" action="delete.php">
		                <input class="form-control" name="id" placeholder="User ID" required>
		                <button type="submit" class="btn btn-danger" name="submit">DELETE</button>
	                </form>
	            </div>
	        </div>
	        <div class="col-md-10" id="right-section">
	            <h1>STUDENT's DATA SHEET</h1>
				<table class="table table-hover table-condensed">
					<tr>	
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Marks</th>
						<th>Result</th>
					</tr>
	            
<?php		
	$PASSING_MARKS = 40; //passing marks
	$query_result = select_data($connectionStatus);
	while($query_row = mysqli_fetch_assoc($query_result)){
		$marks_scored = $query_row["marks"];
		
		echo "<tr>
				<td>" . $query_row["id"] . "</td>
				<td>" . $query_row["fname"] . "</td>
				<td>" . $query_row["lname"] . "</td>
				<td>" . $marks_scored . "</td>
				<td>";
		echo ($PASSING_MARKS < $marks_scored) ? '<span id="success">PASS</span>' : '<span id="error">FAIL</span>';
		echo "</td>
			</tr>";
	}
?>						
				</table>
				<div id="message">
<?php
	if(isset($_GET["id"])){
		echo "<div id='".$_GET["id"]."'>".$_GET["msg"]."</div>";		
	}
?>
				</div>
	        </div> 
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>
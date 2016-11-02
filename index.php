<?php
	require_once "inc/inc.database.php";
	$connectionStatus = connect_db();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="prabhakar gupta">
	<title>MySQL Admin Panel</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>

<a href="https://github.com/prabhakar267/MySQL-admin-panel" target="_blank"><img src="public/img/right-dusk-blue@2x.png" class="github-fork" /></a>

<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">MySQL Admin Panel</a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="#" data-toggle="modal" data-target="#myModal">Instructions</a></li>
				<li><a href="https://github.com/prabhakar267/MySQL-admin-panel" target="_blank">Get the Code</a></li>
			</ul>
		</div>
	</div>
</nav>

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
		$marks_scored = (int)$query_row["marks"];
		
		if($marks_scored > 100 || $marks_scored <= 0)
			echo '
					<tr class="warning">';
		else
			echo '
					<tr>';
		echo "
						<td>" . $query_row["id"] . "</td>
						<td>" . $query_row["fname"] . "</td>
						<td>" . $query_row["lname"] . "</td>
						<td>" . $marks_scored . "</td>
						<td>";
		echo ($PASSING_MARKS < $marks_scored) ? '<span id="success">PASS</span>' : '<span id="danger">FAIL</span>';
		echo "</td>
					</tr>";
	}
?>						
				</table>
				<div id="message">
<?php
	if(isset($_GET["id"])){
		echo '<div class="alert alert-' . $_GET["id"] . ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $_GET["msg"] . '</div>';
	}
?>
				</div>
	        </div> 
        </div>
    </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">MySQL Admin Panel</h4>
			</div>
			<div class="modal-body text-justify">
				MySQL Admin Panel is a simple platform built for performing basic operations (insert, update and delete) on a single table maintained in MySQL. The operations performed are done in PHP.<hr>The current example uses a student record having First Name and Last Name of student. Along with that it takes marks scored by every student. Using the marks, it is determined whether the student has passed or failed the exam.
				<ul>
					<li>If student has scored below 40, (s)he is considered to be fail otherwise pass.</li>
					<li>If student marks are entered wrongly (i.e., more than 100 or a negative number) then that student record is marked in warning colour scheme.</li>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</body>
</html>
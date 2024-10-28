<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
?>
<html lang = "eng">
	<head>
		<title>Patient Record Management System - Appointment</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "shortcut icon" href = "../images/logo.png" />
		<link rel = "stylesheet" type = "text/css" href = "../css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "../css/customize.css" />
	</head>
<body>
	<div class = "navbar navbar-default navbar-fixed-top">
		<img src = "../images/logo.png" style = "float:left;" height = "55px" /><label class = "navbar-brand">Patient Record Management System</label>
			<?php
				$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
				$q = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = '$_SESSION[admin_id]'") or die(mysqli_error());
				$f = $q->fetch_array();
			?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php
							echo $f['firstname']." ".$f['lastname'];
							$conn->close();
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a class = "me" href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>

	<div id = "sidebar">
			<ul id = "menu" class = "nav menu">
				<li><a href = "home.php"><i class = "glyphicon glyphicon-home"></i> Dashboard</a></li>
				<li><a href = "patient.php"><i class = "glyphicon glyphicon-user"></i> Patient</a></li>
				<li><a href = "appointment.php"><i class = "glyphicon glyphicon-calendar"></i> Appointments</a></li>
			</ul>
	</div>

	<div id = "content">
		<br />
		<br />
		<br />
		<div class = "panel panel-primary">
			<div class = "panel-heading">
				<label>SET APPOINTMENT</label>
			</div>
			<div class = "panel-body">
				<form id = "form_appointment" method = "POST" enctype = "multipart/form-data">
					<div class = "form-group">
						<label for = "patient_id">Patient ITR No:</label>
						<input class = "form-control" name = "patient_id" type = "text" required = "required">
					</div>
					<div class = "form-group">
						<label for = "doctor_name">Doctor Name:</label>
						<input class = "form-control" name = "doctor_name" type = "text" required = "required">
					</div>
					<div class = "form-group">
						<label for = "appointment_date">Appointment Date:</label>
						<input class = "form-control" name = "appointment_date" type = "date" required = "required">
					</div>
					<div class = "form-group">
						<label for = "health_issue">Health Issue / Query:</label>
						<textarea class = "form-control" name = "health_issue" required = "required"></textarea>
					</div>
					<button class = "btn btn-primary" name = "save_appointment"><span class = "glyphicon glyphicon-save"></span> SAVE</button>
				</form>
			</div>	
		</div>	
	</div>

	<div id = "footer">
		<label class = "footer-title">&copy; Copyright Caresync@2024</label>
	</div>

	<?php include("script.php"); ?>

	<?php
		// Add the appointment to the database
		if(ISSET($_POST['save_appointment'])){
			$patient_id = $_POST['patient_id'];
			$doctor_name = $_POST['doctor_name'];
			$appointment_date = $_POST['appointment_date'];
			$health_issue = $_POST['health_issue'];

			$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
			$conn->query("INSERT INTO `appointments` (patient_id, doctor_name, appointment_date, health_issue) VALUES ('$patient_id', '$doctor_name', '$appointment_date', '$health_issue')") or die(mysqli_error());

			echo "<script>alert('Appointment successfully added!')</script>";
			echo "<script>window.location = 'appointment.php'</script>";
			$conn->close();
		}
	?>
</body>
</html>

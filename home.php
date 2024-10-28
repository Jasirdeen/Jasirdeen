<!DOCTYPE html>
<?php
	require_once 'logincheck.php';
	$date = date("Y", strtotime("+ 8 HOURS"));
	$conn = new mysqli("localhost", "root", "", "hcpms") or die(mysqli_error());
?>
<html lang="eng">
	<head>
		<title>Caresync-Patient Record Management System</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="../images/logo.png" />
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="../css/customize.css" />
		<?php require 'script.php'?>
		<style>
			/* Set the background color */
			body {
				background-color: #c6f6f4;
				font-family: Arial, sans-serif;
				margin: 0;
				padding: 0;
			}

			/* Style for the introduction section with background image */
			.intro-section {
				background-image: url('../images/doc.jpg');
				background-size: cover;
				background-position: center;
				border-radius: 15px;
				padding: 60px 20px;
				text-align: center;
				margin-bottom: 20px;
				box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
				position: relative;
				color: white;
			}

			/* Semi-transparent overlay for text readability */
			.intro-section::before {
				content: "";
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
				border-radius: 15px;
				z-index: 1;
			}

			/* Styling text above the overlay */
			.intro-section h1, .intro-section p {
				position: relative;
				z-index: 2;
			}

			.intro-section h1 {
				color: #f8f9fa;
				font-weight: bold;
				font-size: 36px;
				margin-bottom: 20px;
			}

			.intro-section p {
				font-size: 22px;
				color: #f8f9fa;
			}
		</style>
	</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<img src="../images/logo.png" style="float:left;" height="55px" /><label class="navbar-brand">Online Healthcare Record Management System</label>
		<?php 
			$q = $conn->query("SELECT * FROM `admin` WHERE `admin_id` = $_SESSION[admin_id]") or die(mysqli_error());
			$f = $q->fetch_array();
		?>
			<ul class="nav navbar-right">	
				<li class="dropdown">
					<a class="user dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="glyphicon glyphicon-user"></span>
						<?php 
							echo $f['firstname']." ".$f['lastname'];
						?>
						<b class="caret"></b>
					</a>
				<ul class="dropdown-menu">
					<li>
						<a class="me" href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
	</div>
	<div id="sidebar">
		<ul id="menu" class="nav menu">
			<li><a href="home.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
			<li><a href=""><i class="glyphicon glyphicon-cog"></i> Accounts</a>
				<ul>
					<li><a href="admin.php"><i class="glyphicon glyphicon-cog"></i> Administrator</a></li>
					<li><a href="user.php"><i class="glyphicon glyphicon-cog"></i> User</a></li>
				</ul>
			</li>
			<li><li><a href="patient.php"><i class="glyphicon glyphicon-user"></i> Patient</a></li></li>
			<li><a href=""><i class="glyphicon glyphicon-folder-close"></i> Sections</a>
				<ul>
					<li><a href="fecalysis.php"><i class="glyphicon glyphicon-folder-open"></i> Fecalysis</a></li>
					<li><a href="maternity.php"><i class="glyphicon glyphicon-folder-open"></i> Maternity</a></li>
					<li><a href="hematology.php"><i class="glyphicon glyphicon-folder-open"></i> Hematology</a></li>
					<li><a href="dental.php"><i class="glyphicon glyphicon-folder-open"></i> Dental</a></li>
					<li><a href="xray.php"><i class="glyphicon glyphicon-folder-open"></i> Xray</a></li>
					<li><a href="rehabilitation.php"><i class="glyphicon glyphicon-folder-open"></i> Rehabilitation</a></li>
					<li><a href="sputum.php"><i class="glyphicon glyphicon-folder-open"></i> Sputum</a></li>
					<li><a href="urinalysis.php"><i class="glyphicon glyphicon-folder-open"></i> Urinalysis</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div id="content">
		 <br />
		 <br />
		 <br />

		 <!-- Introduction Section with Image -->
		 <div class="intro-section">
			<h1>Welcome to Caresync</h1>
			<p>Your friendly, interactive medical bot. We're here to assist you in managing your health records efficiently and easily.</p>
		 </div>

		 <!-- Appointment Form -->
		 <h3>Set an Appointment</h3>
		 <form id="form_appointment" method="POST" enctype="multipart/form-data">
			 <div class="form-group">
				 <label for="patient_id">Patient ITR No:</label>
				 <input class="form-control" name="patient_id" type="text" required="required">
			 </div>
			 <div class="form-group">
				 <label for="doctor_name">Doctor Name:</label>
				 <input class="form-control" name="doctor_name" type="text" required="required">
			 </div>
			 <div class="form-group">
				 <label for="appointment_date">Appointment Date:</label>
				 <input class="form-control" name="appointment_date" type="date" required="required">
			 </div>
			 <div class="form-group">
				 <label for="health_issue">Health Issue / Query:</label>
				 <textarea class="form-control" name="health_issue" required="required"></textarea>
			 </div>
			 <button class="btn btn-primary" name="save_appointment"><span class="glyphicon glyphicon-save"></span> SAVE</button>
		 </form>
		 <!-- End of Appointment Form -->
			
		 <!-- Langflow Chatbot Integration -->
		 <h3>Caresync Bot</h3>
		 <div style="margin-right: 100px;">
			 <script src="https://cdn.jsdelivr.net/gh/logspace-ai/langflow-embedded-chat@v1.0.6/dist/build/static/js/bundle.min.js"></script>

			 <langflow-chat
				 window_title="Caresync final jas"
				 flow_id="24ee2acd-dfe9-450c-bf1b-e31618fafc6b"
				 host_url="http://localhost:7860"
			 ></langflow-chat>
		 </div>
		 <!-- End of Langflow Chatbot Integration -->
			
	</div>
	<div id="footer">
		<label class="footer-title">&copy; Copyright Caresync@2024</label>
	</div>

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

<!DOCTYPE html>
<html>
<head>
	<title>Database Insertion</title>
</head>
<body>
	<h1>Database Insertion</h1>

	<?php 

	$host = "localhost";
	$user = "task1";
	$pass = "0000";
	$db = "task1";

	$conn = new mysqli($host, $user, $pass, $db);

	if($conn->connect_error) {
		echo "Database Connection Failed!";
		echo "<br>";
		echo $conn->connect_error;
	}
	else {
		echo "Database Connection Successful!";
		
		$stmt = $conn->prepare("insert into user (fName, lName, gender, email, uName, password, rEmail) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $p1, $p2, $p3, $p4, $p5, $p6, $p7);
		$p1 = $_POST['fname'];
		$p2 = $_POST['lname'];
		$p3 = $_POST['gender'];
		$p4 = $_POST['email'];
		$p5 = $_POST['uname'];
		$p6 = $_POST['password'];
		$p7 = $_POST['remail'];
		$status = $stmt->execute();

		if($status) {
			echo "Data Insertion Successful.";
		}
		else {
			echo "Failed to Insert Data.";
			echo "<br>";
			echo $conn->error;
		}
	}

	$conn->close();

	?>

</body>
</html>
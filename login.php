<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login</title>
  </head>
  <body>
  	<center>

	    <h1>Login</h1>

	    <?php

			$userNameErr = $passwordErr = "" ;

			$userName = "";
			$password = "";
			$msg = "";
			$flag = 0;

			if($_SERVER["REQUEST_METHOD"] == "POST") 
			{

				if(empty($_POST['uname'])) {
				  $userNameErr = "Please fill up the username properly";
				  }
				else {
				  $userName = $_POST['uname'];
				}

				if(empty($_POST['password'])) {
				  $passwordErr = "Please fill up the password properly";
				}
				else {
				  $password = $_POST['password'];
				}

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
				
					$stmt1 = $conn->prepare("select uName, password from user where uName=? and password=?");
					$stmt1->bind_param("ss", $p1, $p2);
					$p1 = $_POST['uname'];
					$p2 = $_POST['password'];
					$stmt1->execute();
					$res2 = $stmt1->get_result();

					$user = $res2->fetch_assoc();

					if($user) {
						echo "Login Successful.";
						$flag= 1;
					}
					else {
						echo "<br>";
						echo "Failed to Login.";
						echo "<br>";
						echo $conn->error;
					}

				}

				$conn->close();

            	if ($flag>0)
	            {
	                echo "<br>";
	        
	                $_SESSION['userNameV'] = $userName;
	                $_SESSION['passwordV'] = $password;
	            
	                echo "UserName: " . $_SESSION['userNameV'];
	                echo "<br>";
	                echo "Password is: " . $_SESSION['passwordV'];
	                echo "<br>";
	                echo "***Printed using SESSION***";
	            }

	        }

	        session_unset();
		    session_destroy();

	    ?>

	    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
	    	
			<fieldset style="width: 30%; margin: auto ;">
	        <legend>Login </legend>

	        <label for="uname">UserName:</label>
	        <input type="text" name="uname" id="uname" value="<?php echo $userName; ?>">
	        <br>
	        <p style="color:red"><?php echo $userNameErr; ?></p>

	        <label for="pass">Password:</label>
	        <input type="password" name="password" id="password" value="<?php echo $password; ?>">
	        <br>
	        <p style="color:red"><?php echo $passwordErr; ?></p>
	       

			</fieldset>
			<br>

			<input type="submit" value="Login">
			<a href="registration.php" title="">Not yet registered?</a>

	    </form>

      </center>
    </body>
</html>
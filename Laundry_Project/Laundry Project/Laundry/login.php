<!doctype html>
<html lang='en'>
	<head>
		<meta charset='UTF-8'>
		<title>Laundry Management</title>
		<link rel='stylesheet' type='text/css' href='css/mainStyle.css'>
	</head>
	<body>
		<div id="main">
		<?PHP
			//header("Content-Type: text/html; charset=utf8");
			
			// Check if submit for login html, to avoid access directly 
			if(!isset($_POST["submit"])){
				exit("Invalid");
			} 
			
			include 'dbConnect.php'; // Connect to Database
			session_start(); //declare session variables
			
			$username = $_POST['username'];//get username from POST
			$passowrd = $_POST['password'];//get password from POST

			if ($username && $passowrd){ // username and password cannot be void or null
					 $sql = "select userID, username, type from laundryuser where username = '$username' and password='$passowrd'";
					 
					 $result = mysqli_query($conn, $sql );
					 if($rows = mysqli_fetch_assoc($result)){
						$_SESSION['userId'] = $rows["userID"];
						$_SESSION['username'] = $rows["username"];
						$_SESSION['usertype'] = $rows["type"];
						header("refresh:0;url=laundryBooking.php");//login success, go to user/admin page
						exit;
					 }else{
						echo "<label id='ErrorMsg'><h4>
								Login Error. <br>
								Username or Password incorrect. Please check and login again. <br>
								</h4>
								</lable>";
						pagelink();
					 }
					 

			}else{
						echo "Username and Password cannot be void or null";
						pagelink();
			}

			mysqli_close($conn);//close datebase connection
			
			function pagelink(){
				echo "<p>
						<a href='login.html'><input class='but' type='button' name='login' value='Go Back to Login'></a>
					</p>";
			}
		?>
	</div>
</body>
</html>
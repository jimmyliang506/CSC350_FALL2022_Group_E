<?php  
	date_default_timezone_set('America/New_York');
	session_start(); //declare session variables
	
	if(!isset($_SESSION['userId'])){
		exit("Invalid");
	}
	
	$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : "";
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
	$usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : "";
	
	include 'dbConnect.php'; // Connect to Database
	include 'bookingDayTimeDropBox.php';
	if($usertype == 0){
		userLaundryPage($username, $userId, $conn);
	}else if($usertype == 1){
		adminLaundryPage($username, $userId, $conn);
	}else{
		exit("Invalid");
	}
	mysqli_close($conn);//close datebase connection
	
	function adminLaundryPage($username, $userId, $conn){
		echo "
			<!doctype html>
				<html lang='en'>
					<head>
						<meta charset='UTF-8'>
						<title>Laundry Management</title>
						<link rel='stylesheet' type='text/css' href='css/mainStyle.css'>
					</head>
					<body>
			";		
		echo "<div id='main'>";
		echo "<a href='logout.php'><img src='images/Logout.jpg' title='Logout' height='35' width='40'/></a>";
		echo "<h3>Hello ".$username.", Welcome Back </h3>";
		echo "
			<p>
				<a href='register.html'><button class='leftBtn' type='button' id='buttonRegister' name='Register'>User Register</button></a>
				<a href='manageUser.php'><button class='rightBtn' type='button' id='buttonModify' name='Modify'>User Management</button></a>
			</p>
			<p>
				<a href='laundrySchedule.php'><button class='leftBtn' type='button' id='buttonLaundrySchedule' name='LaundrySchedule'>Schedule Management</button></a>
				<a href='manageBooking.php'><button class='rightBtn' type='button' id='buttonManageBooking' name='ManageBooking'>Booking Management</button></a>
			</p>";
		echo "</div></body></html>";
	}

	function userLaundryPage($username, $userId, $conn){
		echo "
			<!doctype html>
				<html lang='en'>
					<head>
						<meta charset='UTF-8'>
						<title>Laundry Booking</title>
						<link rel='stylesheet' type='text/css' href='css/mainStyle.css'>
					</head>
					<body>
			";	
		echo "<div id='main'>";
		echo "<a href='logout.php'><img src='images/Logout.jpg' title='Logout' height='35' width='40'/></a>";
		echo "<h3>Hello ".$username.", Welcome Back </h3>";
		
		//if user has valid booking record in current week, display the booking record
		$datenow = date('Y-m-d H:i:s',time());
		
		$sql = "select booking.bookingID, booking.CreateTime, booking.ExpiredTime, schedule.Day, schedule.ScheduledTime from booking join schedule on booking.FK_scheduleID = schedule.scheduleID where booking.FK_userID = '$userId' and unix_timestamp('$datenow') > unix_timestamp(CreateTime) and unix_timestamp('$datenow') < unix_timestamp(ExpiredTime);";
		
		$result = mysqli_query($conn, $sql );
		if($rows = mysqli_fetch_assoc($result)){
			$bookingId = $rows["bookingID"];
			$createTime = $rows["CreateTime"];
			$expiredTime = $rows["ExpiredTime"];
			$lDay = $rows["Day"];
			$TimeSpot = $rows["ScheduledTime"];
			
			echo "You Laundry Booking Record : <br>";
			echo "<table border='1' style='margin:auto'><tr>
					<td>Username</td>
					<td>LaundryDay</td>
					<td>LaundryTime</td>
					<td>CreateTime</td>
					<td>ExpiredTime</td>
					</tr>";
			echo "<tr>
				<td>$username</td>
				<td>$lDay</td>
				<td>$TimeSpot</td>
				<td>$createTime</td>
				<td>$expiredTime</td>
				</tr>";
			echo 	"</table>"."<br>";
		}else{//if user doesn't have valid booking record in current week, display select menu
			echo "<p>You have not book an appointment for laundry, please make a book an appointment.<br></p>";
			bookingDropBox($conn);
		}
		echo "</div>";
		echo "
					</body>
				</html>
			";
	}
?>

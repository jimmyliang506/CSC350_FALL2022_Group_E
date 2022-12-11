<?php 
	date_default_timezone_set('America/New_York');
	session_start(); //declare session variables
	$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : "";
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
	$usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : "";

    $bookingScheduleId = $_POST['ctype'];//get password from POST

    include('dbConnect.php');//Connect Database
	
	$datenow = date('Y-m-d H:i:s',time());
	$expiredTime = date('Y-m-d H:i:s', strtotime("next Monday")-1);

	$selSql = "Select bookingID from booking where FK_userID = '$userId'";
	$result = mysqli_query( $conn, $selSql); //check if use has history booking record
	if ($result){
		if($row = mysqli_fetch_assoc($result)) {
			//update use has history booking record
			$upSql = "update booking set FK_scheduleID='$bookingScheduleId', CreateTime='$datenow', ExpiredTime='$expiredTime' where FK_userID='$userId'";
			$result = mysqli_query( $conn, $upSql);
			if($result){
				echo "Booking Success";
				sleep(1);
				header("refresh:0;url=laundryBooking.php");
			}else{
				echo "'$upSql' exec failed"."<br>";
			}
		}else{
			//insert use booking record
		$insSql="insert into booking(bookingID, FK_userID, FK_scheduleID, CreateTime, ExpiredTime) values (null,'$userId','$bookingScheduleId','$datenow','$expiredTime')";
		
		$result = mysqli_query($conn, $insSql);
		if($result){
			//echo "Booking Success";
			sleep(1);
			header("refresh:0;url=laundryBooking.php");
		}
	}
	}else{
		echo "'$selSql' exec failed"."<br>";
	}
    mysqli_close($conn);//close datebase connection
?>
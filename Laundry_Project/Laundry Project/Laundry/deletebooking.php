<?php
	header("Content-type:text/html;charset=utf-8");
	if(!isset($_POST['bookingId'])){
        exit("Invalid");
    }

    $bookingId = $_POST['bookingId'];
	
	include('dbconnect.php');//链接数据库
	
	//delete booking
	$upateSql="delete from booking where bookingId = '$bookingId'";
	$result = mysqli_query( $conn, $upateSql);
		
	if($result){
		echo 'Booking record '.$bookingId.' delete successed.';
	}
	else {
		echo 'Booking record '.$bookingId.' delete failed.';
	}
	
    $conn->close();//关闭数据库
?>


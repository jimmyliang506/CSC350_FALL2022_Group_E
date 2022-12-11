<?php
	header("Content-type:text/html;charset=utf-8");
	if(!isset($_POST['userId']) || !isset($_POST['username'])){
        exit("Invalid");
    }

    $userId = $_POST['userId'];
	$username = $_POST['username'];
	
	include('dbconnect.php');//链接数据库
	
	//check if user have booking record
	$selBookingSql="select * from booking where FK_userID = '$userId'";
	$result = mysqli_query($conn, $selBookingSql );
	if($result && mysqli_fetch_row($result)){
		echo 'User:'.$username.' has booking record, please delete booking record first.';
    }else {
		//delete user
		$upateSql="delete from laundryuser where userID = '$userId'";
		$result = mysqli_query( $conn, $upateSql);
		
		if($result){
			echo $username.' delete successed.';
		}
		else {
			echo $username.'--'.$userId.' delete failed.';
		}
	}
    $conn->close();//关闭数据库
?>


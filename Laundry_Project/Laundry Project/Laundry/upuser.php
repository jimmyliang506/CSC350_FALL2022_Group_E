<?php
	header("Content-type:text/html;charset=utf-8");

	if(!isset($_POST['userId']) || !isset($_POST['username']) || !isset($_POST['usertype']) || !isset($_POST['password'])){
        exit("Invalid");
    }
	
    $userId = $_POST['userId'];
	$username = $_POST['username'];
    $usertype = $_POST['usertype'];
    $password = $_POST['password'];
	
	include('dbconnect.php');
    $upateSql="update laundryuser set username = '$username', type = '$usertype', password = '$password' where userID = $userId";
	$result = mysqli_query( $conn, $upateSql);
	
	if($result){
        echo $username.' update successed.';
		
    }
	else {
		echo $username.' update failed.';
	}
   
    $conn->close();
?>


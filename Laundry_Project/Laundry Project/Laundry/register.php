<?php 
    // Check if register for register html, to avoid access directly 
    if(!isset($_POST["register"])){
        exit("Invalid");
    } 

    $username = $_POST['username'];//get username from POST
    $passowrd = $_POST['password'];//get password from POST
	$usertype = $_POST['usertype'];//get password from POST

    include('dbConnect.php');//Connect Database
    $insSql="insert into laundryuser(userID, username, password, type) values (null,'$username','$passowrd', '$usertype')";
    $selSql = "select username from laundryuser where username = '$username'";
	
	$result = mysqli_query($conn, $selSql );
	if($result && mysqli_fetch_row($result)){
        echo '<p>User:'.$username.' already exist.</p>';
    }else {
		$result = mysqli_query($conn, $insSql);
		if($result){
			echo "<script>alert('User $username Register Success.')</script>";
			header("refresh:0;url=laundryBooking.php");//Register success, go to admin page
		}
	}
   
    mysqli_close($conn);//close datebase connection
?>

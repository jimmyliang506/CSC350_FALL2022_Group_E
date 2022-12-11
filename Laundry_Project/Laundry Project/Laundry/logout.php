<?php 
	session_start();
	if(isset($_SESSION['username'])){
		session_unset(); // delete user from session
		session_destroy(); // delete session data
	}
	sleep(1);
	header("refresh:0;url=login.html");
	
?>
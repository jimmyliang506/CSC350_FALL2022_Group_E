<?php 
// Connect MYSQL
$conn = mysqli_connect("localhost", "root", "root");
if ($conn->connect_error) {
    die("Connect failed " . $conn->connect_error);
} 

// select database
if(!mysqli_select_db($conn, "laundry"))
{
	die("Connect database test faied.");
}
?>

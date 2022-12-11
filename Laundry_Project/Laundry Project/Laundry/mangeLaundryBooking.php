<?php
session_start(); //declare session variables

if(!isset($_SESSION['userId'])){
	exit("Invalid");
}

echo "<script language = 'JavaScript'>";
echo "function modify(a){
		var trobj = a.parentNode.parentNode; //get row object
		var tdobj = trobj.getElementsByTagName('td');
		for(var i =0;i<tdobj.length-1;i++){
		//change to input type
			tdobj[i].innerHTML =\"<input onblur='submit(this)' type=\"input\" value='\" +tdobj[i].innerText+ \" '/>\";
		}
		tdobj[i].innerHTML = \"<input type='button' onclick='confirm(this)' value='Confirm'/>\";
	}";
		 
echo "function delete(a){}";

echo "function confirm(a){}";
	
echo "</script>";



$userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";
$usertype = isset($_SESSION['usertype']) ? $_SESSION['usertype'] : "";

include 'dbConnect.php'; // Connect to Database

$userArr = array();
echo "<h4>Booking List</h4>";
echo "<table border='1'><tr>
		<td>BookingID</td>
		<td>UserID</td>
		<td>ScheduleID</td>
		<td>CreateTime</td>
		<td>ExpiredTime</td>
		<td>Action</td>
		</tr>";


	$selSql = "Select bookingId, userId, scheduleID, CreateTime, Expiredtime from booking";
	$result = mysqli_query( $conn, $selSql);
	if ($result) 
	{
		while($row = mysqli_fetch_assoc($result) )
		{
			$bookingId = $row["bookingId"];
			$userId = $row["userId"];
			$scheduleID = $row["scheduleID"];
			$CreateTime = $row["CreateTime"];
			$Expiredtime = $row["Expiredtime"];
			
			echo "<tr>
				<td>$bookingId</td>
				<td>$userId</td>
				<td>$scheduleID</td>
				<td>$CreateTime</td>
				<td>$Expiredtime</td>
				<td>
					<a href='modify.html'><input type='button' name='modify' onclick='modify(this)' value='Modify'/></a>
					<a href='delete.php'><input type='button' name='delete' onclick='delete(this)' value='Delete'/></a>
				</td>
				</tr>";
		}
	}
	else
	{
		echo "'$selSql' exec failed"."<br>";
	}


echo 	"</table>"."<br>";

mysqli_close($conn);
?>
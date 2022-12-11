<?php
session_start(); //declare session variables

if(!isset($_SESSION['userId'])){
	exit("Invalid");
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>LaundrySchedule</title>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
</head>
<body>
<div id="main">
<a href="laundryBooking.php"><img src="images/Goback.png" title="Back to Manage Page" height="35" width="40"/></a>
<?php
include 'dbConnect.php'; // Connect to Database

$userArr = array();
echo "<h3>Schedule List</h3>";
echo "<table border='1' width='50%'><thead><tr>
		<td>ScheduleID</td>
		<td>ScheduledDay</td>
		<td>ScheduledTime</td>
		</tr></thead><tbody id='laundryScheduleTable'>";

	$selSql = "Select scheduleID, Day, ScheduledTime from schedule";
	$result = mysqli_query( $conn, $selSql);
	if ($result) 
	{
		while($row = mysqli_fetch_assoc($result) )
		{
			$scheduleId = $row["scheduleID"];
			$schduleDay = $row["Day"];
			$scheduledTime = $row["ScheduledTime"];
			
			echo "<tr>
				<td>$scheduleId</td>
				<td>$schduleDay</td>
				<td>$scheduledTime</td>
				</tr>";
		}
	}
	else
	{
		echo "'$selSql' exec failed"."<br>";
	}

echo   "</tbody>";
echo 	"</table>";
?>
<label id="pageNum"></label>/<label id="totalPage"></label><br>
<button class="but" type="button" id="buttonFirst" disabled="true" onclick="first()">FirstPage</button>
<button class="but" type="button" id="buttonPre" disabled="true" onclick="pre()">PrePage</button>
<button class="but" type="button" id="buttonNext" disabled="true" onclick="next()">NextPage</button>
<button class="but" type="button" id="buttonLast" disabled="true" onclick="last()">LastPage</button>

</div>
</body>
<?php
mysqli_close($conn);
?>

</html>
<script type="text/javascript" src="js/paging.js"></script>
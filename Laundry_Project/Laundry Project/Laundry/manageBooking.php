<?php
session_start(); //declare session variables

if(!isset($_SESSION['userId'])){
	exit("Invalid");
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ManageBooking </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/layerStyle.css">
	<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"> </script>
	<script type="text/javascript">
	 $(function(){
	 $("#submitd").click(function(){
	   var conta = {bookingId:$("#bookingIdForDelete").get(0).value};
	   var urla = 'deletebooking.php';
	   $.post(urla,conta,function(data){
		   alert(data);
	  });
	 });
	 });
	</script>
</head>
<body>
<div id="main">
<a href="laundryBooking.php"><img src="images/Goback.png" title="Back to Manage Page" height="35" width="40"/></a>
<?php
include 'dbConnect.php'; // Connect to Database

$userArr = array();
echo "<h3>Booking List</h3>";
echo "<table border='1'><thead><tr>
		<td>BookingID</td>
		<td>UserID</td>
		<td>UserName</td>
		<td>ScheduleID</td>
		<td>LaundryDay</td>
		<td>LaundryTime</td>
		<td>CreateTime</td>
		<td>ExpiredTime</td>
		<td>Action</td>
		</tr></thead><tbody id='laundryScheduleTable'>";
	
	$selSql = "Select bookingID, FK_userID, FK_scheduleID, username, Day, ScheduledTime, CreateTime, Expiredtime from booking join laundryuser on booking.FK_userID = laundryuser.userID join schedule on booking.FK_scheduleID = schedule.scheduleID";
	$result = mysqli_query( $conn, $selSql);
	if ($result) 
	{
		while($row = mysqli_fetch_assoc($result) )
		{
			$bookingId = $row["bookingID"];
			$userId = $row["FK_userID"];
			$userName = $row["username"];
			$scheduleId = $row["FK_scheduleID"];
			$sDay = $row["Day"];
			$sTimeSpot = $row["ScheduledTime"];
			$CreateTime = $row["CreateTime"];
			$Expiredtime = $row["Expiredtime"];
			
			echo "<tr>
				<td>$bookingId</td>
				<td>$userId</td>
				<td>$userName</td>
				<td>$scheduleId</td>
				<td>$sDay</td>
				<td>$sTimeSpot</td>
				<td>$CreateTime</td>
				<td>$Expiredtime</td>
				<td>
					<a href='javascript:void(0)' onclick='deletebooking(this)'>Delete</a>
				</td>
				</tr>";
		}
	}
	else
	{
		echo "'$selSql' exec failed"."<br>";
	}
echo   "</tbody>";
echo 	"</table>"."<br>";
?>
<label id="pageNum"></label>/<label id="totalPage"></label><br>
<button class="but" type="button" id="buttonFirst" disabled="true" onclick="first()">FirstPage</button>
<button class="but" type="button" id="buttonPre" disabled="true" onclick="pre()">PrePage</button>
<button class="but" type="button" id="buttonNext" disabled="true" onclick="next()">NextPage</button>
<button class="but" type="button" id="buttonLast" disabled="true" onclick="last()">LastPage</button>

<div id="deleteContentLayer" style="">
    <div style="width:500px;height:40px;">
        Delete User<hr>
        <form style=" margin-left: 100px;" action="" method="post">
			BookingId：<input id="bookingIdForDelete" type="text" value="" name="bookingId" readonly><br>
            UserId：<input id="userIdForDelete" type="text" value="" name="userId" readonly><br>
			Username：<input id="usernameForDelete" type="text" value="" name="username" readonly><br>
            LaundryDay：<input id="lDayForDelete" type="text" value="" name="scheculeDay" readonly><br>
			LaundryTime：<input id="lTimeForDelete" type="text" value="" name="scheculeTime" readonly><br>
			Expiredtime：<input id="eTimeForDelete" type="text" value="" name="Expiredtime" readonly><br>
			<label>Are you sure to delete this booking record?</label><br>
			<button id="submitd">Yes</button>
			<button id="canceld">No</button>
        </form>
    </div>
</div>
<div id="changeContentBGLayer">
</div>
</div>
</body>
<script>
	function deleteBookingFunc() {
        document.getElementById('changeContentBGLayer').style.display = 'block';
        document.getElementById('deleteContentLayer').style.display = 'block';
    }

		 function deletebooking(a){
             var trobj = a.parentNode.parentNode; 
             var tdobj = trobj.getElementsByTagName("td");

			 document.getElementById("bookingIdForDelete").value = tdobj[0].innerText;
			 document.getElementById("userIdForDelete").value = tdobj[1].innerText;
			 document.getElementById("usernameForDelete").value = tdobj[2].innerText;
			 document.getElementById("lDayForDelete").value = tdobj[4].innerText;
			 document.getElementById("lTimeForDelete").value = tdobj[5].innerText;
			 document.getElementById("eTimeForDelete").value = tdobj[7].innerText;
			 
			 deleteBookingFunc();
         }
</script>
<?php
mysqli_close($conn);
?>
</html>
<script type="text/javascript" src="js/paging.js"></script>
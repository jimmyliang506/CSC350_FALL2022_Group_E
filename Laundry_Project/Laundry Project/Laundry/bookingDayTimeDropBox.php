<?php
function bookingDropBox($conn){
echo "<script language = 'JavaScript'>";
echo "var onecount;";
echo "onecount=0;";
echo "subcat = new Array();";

	$scheduleTimeSql = "select scheduleID, Day, ScheduledTime from schedule left join booking on schedule.scheduleID = booking.FK_scheduleID where booking.FK_scheduleID is NULL;";
	$result = mysqli_query($conn,$scheduleTimeSql);
	$count = 0;
	while($res = mysqli_fetch_assoc($result)){
		echo "subcat[".$count."]"."= new Array('".$res["scheduleID"]."','".$res["Day"]."','".$res["ScheduledTime"]."');";

	$count++;
	}
	echo "onecount=$count;";


//联动函数
echo "function changelocation(locationid)";
echo "{";
echo "document.myform.ctype.length = 0;";
echo "var locationid=locationid;";
echo "var i;";
echo "for (i=0;i < onecount; i++)";
echo "{";
echo "if (subcat[i][1] == locationid)";
echo "{";
echo "document.myform.ctype.options[document.myform.ctype.length] = new Option(subcat[i][2], subcat[i][0]);";
echo "}";
echo "}";
echo "}";
echo "</script>";
?>


<?php
echo "<form method='post' name='myform' action='makeBooking.php'>";
echo "<select name='type' onChange='changelocation(document.myform.type.options[document.myform.type.selectedIndex].value)' size='1'>";
echo "<option selected value=''>Please Select Day</option>";
		$scheduleDaySql = "select DISTINCT(Day) from schedule;";
		$result = mysqli_query($conn, $scheduleDaySql );
		while($res = mysqli_fetch_assoc($result)){
			echo "<option value='".$res["Day"]."'>".$res["Day"]."</option>";
		}

echo "</select>";
echo "&nbsp&nbsp";
echo "<select name='ctype'>";
	echo "<option selected value=''>Please Select Time</option>";
echo "</select>";
echo "&nbsp&nbsp";
echo "<input class='but' type='submit' name='Submit' value='Confirm'>";
echo "</form>";
	
}
?> 
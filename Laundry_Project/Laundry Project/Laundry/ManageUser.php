<?php
session_start(); //declare session variables

if(!isset($_SESSION['userId'])){
	exit("Invalid");
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ManageUser </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/layerStyle.css">
	<link rel="stylesheet" type="text/css" href="css/mainStyle.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"> </script>
	<script type="text/javascript">
	 $(function(){
	 $("#submit").click(function(){
	   var cont = {userId:$("#muserId").get(0).value,username:$("#musername").get(0).value,usertype:$("#musertype").get(0).value,password:$("#mpassword").get(0).value};
	   var url = 'upuser.php';
	   $.post(url,cont,function(data){
		   alert(data);
	  });
	 });
	 });
	 $(function(){
	 $("#submitd").click(function(){
	   var conta = {userId:$("#muserIdForDelete").get(0).value,username:$("#musernameForDelete").get(0).value};
	   var urla = 'deuser.php';
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
echo "<h3>User List</h3>";
echo "<table border='1'><thead><tr>
		<td>UserId</td>
		<td>Username</td>
		<td>Usertype</td>
		<td>Password</td>
		<td>Action</td>
		</tr></thead><tbody id='laundryScheduleTable'>";

	$selSql = "Select userID, username, type, password from laundryuser";
	$result = mysqli_query( $conn, $selSql);
	if ($result) 
	{
		while($row = mysqli_fetch_assoc($result) )
		{
			$userId = $row["userID"];
			$username = $row["username"];
			$usertype = $row["type"];
			$userpw = $row["password"];
			
			echo "<tr>
				<td>$userId</td>
				<td>$username</td>
				<td>$usertype</td>
				<td> <input style='border:none;BACKGROUND-COLOR:transparent;text-align:center' type='password' size='8' value=$userpw readonly/></td>
				<td>
					<a href='javascript:void(0)' onclick='modify(this)'>Modify</a>
					<a href='javascript:void(0)' onclick='deleteu(this)'>Delete</a>
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


<div id="modifyContentLayer" style="">
    <div style="width:500px;height:40px;">
        Modify User<hr>
        <form style=" margin-left: 100px;" action="" method="post">
			UserId：<input id="muserId" type="text" value="" name="userId" readonly><br>
            Username：<input id="musername" type="text" value="" name="username" ><br>
			Password：<input id="mpassword" type="password" value="" name="password" ><br>
			<!--  Usertype：<input id="musertype" type="text" value="" name="usertype"><br> -->
			Usertype: <select name="usertype" id="musertype">
								<option value ="0">user</option>
								<option value ="1">administrator</option>
							</select><br>
			<button id="submit">Submit</button>
			<button id="cancel">Cancel</button>
        </form>
    </div>
</div>
<div id="deleteContentLayer" style="">
    <div style="width:500px;height:40px;">
        Delete User<hr>
        <form style=" margin-left: 100px;" action="" method="post">
			UserId：<input id="muserIdForDelete" type="text" value="" name="userId" readonly><br>
            Username：<input id="musernameForDelete" type="text" value="" name="username" readonly><br>
			<label>Are you sure to delete this user?</label><br>
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
    function modifyUserFunc() {
        document.getElementById('changeContentBGLayer').style.display = 'block';
        document.getElementById('modifyContentLayer').style.display = 'block';
    }
	function DeleteUserFunc() {
        document.getElementById('changeContentBGLayer').style.display = 'block';
        document.getElementById('deleteContentLayer').style.display = 'block';
    }

         function modify(a){
             var trobj = a.parentNode.parentNode; 
             var tdobj = trobj.getElementsByTagName("td");

			 document.getElementById("muserId").value = tdobj[0].innerText;
			 document.getElementById("musername").value = tdobj[1].innerText;
			 document.getElementById("musertype").value = tdobj[2].innerText;
			 document.getElementById("mpassword").value = tdobj[3].firstElementChild.value;
			 //alert(tdobj[3].firstElementChild.value)
			 modifyUserFunc();
         }
		 
		 function deleteu(a){
             var trobj = a.parentNode.parentNode;
             var tdobj = trobj.getElementsByTagName("td");

			 document.getElementById("muserIdForDelete").value = tdobj[0].innerText;
			 document.getElementById("musernameForDelete").value = tdobj[1].innerText;
			 
			 DeleteUserFunc();
         }
</script>
<?php
mysqli_close($conn);
?>
</html>
<script type="text/javascript" src="js/paging.js"></script>
<!DOCTYPE html>
<?php
session_start(); 
error_reporting(1);
$con = mysql_connect("localhost","root","") or die(mysql_error());
?>
<?php
  
if($_REQUEST['con']==1)
{
// remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy(); 
	header( "Location: home.php" );
}

?>
<html>

<head>
  <title>Mess Management </title>
  <link href="site3.css" rel="stylesheet">
</head>
<?php
 $password = $_SESSION['pass'];
			
	$email = $_SESSION['email'];
$conn = new mysqli("localhost", "root", "", "mess_management");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM hostel_admin WHERE Email_Id='$email' AND Password=md5($password)";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hostel = $row["Hostel_Name"];
$beg = $row["Sem_Beg"];
$end = $row["Sem_End"];
$date = date('Y-m-d');
if($date>=$beg&&$date<=$end)
{
	$datetime1 = new DateTime($beg);
$datetime2 = new DateTime($date);
}
else if($date>=$beg)
{
	$datetime1 = new DateTime($beg);
$datetime2 = new DateTime($end);
}
else
{
	$datetime1 = new DateTime($beg);
$datetime2 = new DateTime($beg);
}
$diff = date_diff($datetime1, $datetime2);
$diff = $diff->format('%R%a days');
$conn->close();

?>
<body>
<ul id = "menu">
<li><a href='hostel_admin.php'>Home</a></li>
<li><a href='logout.php? con = 1'>Log Out</a></li>

	
</ul>

<div id="main" align = "center">

  <h1>Mess Mangment Portal For Hostel Administrator</h1> 
</div>

<div id="main" align = "left">
<table>
<tr> <td>Logged in as ADMINISTRATOR of Hostel </td><td> <?php echo ": ".$row["Hostel_Name"]; ?></td><td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td><td>Hostel strength &nbsp </td><td><?php echo ": ".$row["Hostel_Strength"]; ?></td></tr>
  <tr> <td>Advance per Student &nbsp </td><td><?php echo ": ".$row["Advance_per_student"]; ?></td><td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td><td>Per diet Cost &nbsp </td><td><?php echo ": ".$row["Per_Diet_Cost"]; ?></td></tr>
  <tr> <td>Semester Began On &nbsp </td><td><?php echo ": ".$row["Sem_Beg"]; ?></td><td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </td><td>Semester Ends On &nbsp </td><td><?php echo ": ".$row["Sem_End"]; ?></td></tr>
  <tr> <td>Total days this semester till today &nbsp </td><td><?php echo ": ".$diff ?></td></tr>
 </table>
  </div>

<div id="main" align = "center">
  <?php
echo "<p> <b><font size='6' face='verdana' color='green'>Bill Per Mess</font></b></p>";
// Create connection
$conn = new mysqli("localhost", "root", "", "mess_management");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql2 = "SELECT * FROM mess WHERE Hostel_Name='$hostel'"; 
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    echo "<table><tr><th>Mess_No</th><th>&nbsp &nbsp Strength</th><th>&nbsp &nbsp Diets_Cancelled</th><th>&nbsp &nbsp Total_Days</th><th>&nbsp &nbsp Total_Diets</th><th>&nbsp &nbsp Total_Bill</th></tr>";
    // output data of each row
	$connection = mysql_connect("localhost", "root", ""); // Establishing connection with server..
	$db = mysql_select_db("mess_management", $connection);
    while($row2 = $result2->fetch_assoc()) {
		$messno = $row2["Mess_No"];
		$result5 = mysql_query("SELECT * FROM mystudent WHERE Hostel_Name = '$hostel' AND Mess_No = '$messno '");
		$strength = mysql_num_rows($result5);
		$result5 = mysql_query("SELECT * FROM `diet_cancel` WHERE Hostel = '$hostel' AND Mess_No = '$messno' AND For_Diet = 'Dinner' AND Date <= '$date'");
$cancel_dinner_total = mysql_num_rows($result5);
$result6 = mysql_query("SELECT * FROM `diet_cancel` WHERE Hostel = '$hostel' AND Mess_No = '$messno' AND For_Diet = 'Lunch' AND Date <= '$date'");
$cancel_lunch_total = mysql_num_rows($result6);
$result7 = mysql_query("SELECT * FROM `diet_cancel` WHERE Hostel = '$hostel' AND Mess_No = '$messno' AND For_Diet = 'Breakfast' AND Date <= '$date'");
$cancel_breakfast_total = mysql_num_rows($result7);
$diets_cancelled_total = $cancel_dinner_total + $cancel_lunch_total+ 0.5*$cancel_breakfast_total;
		$total_diets = $strength*$diff*2.5-$diets_cancelled_total;
		$bill = $total_diets*$row["Per_Diet_Cost"];
        echo "<tr><td>&nbsp &nbsp &nbsp &nbsp ".$row2["Mess_No"]."</td><td>&nbsp &nbsp &nbsp &nbsp ".$strength."</td><td>&nbsp &nbsp &nbsp &nbsp ".$diets_cancelled_total."</td><td>&nbsp &nbsp &nbsp &nbsp ".$diff."</td><td>&nbsp &nbsp &nbsp &nbsp ".$total_diets."</td><td>&nbsp &nbsp &nbsp &nbsp ".$bill."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<p> <b><font size="6" face="verdana" color="green">Bill Per Student</font></b></p>
  <?php


// Create connection
$conn = new mysqli("localhost", "root", "", "mess_management");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql2 = "SELECT * FROM mystudent WHERE Hostel_Name='$hostel'"; 
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    echo "<table><tr><th>Email_Id</th><th>&nbsp &nbsp &nbsp &nbsp Mess_No</th><th>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Roll_No</th><th>&nbsp &nbsp Diets_Cancelled</th><th>&nbsp &nbsp Total_Days</th><th>&nbsp &nbsp Total_Diets</th><th>&nbsp &nbsp Total_Bill</th></tr>";
    // output data of each row
	$connection = mysql_connect("localhost", "root", ""); // Establishing connection with server..
	$db = mysql_select_db("mess_management", $connection);
    while($row2 = $result2->fetch_assoc()) {
		$mess = $row2["Mess_No"];
		$email = $row2["Email_Id"];
		$result5 = mysql_query("SELECT * FROM `diet_cancel` WHERE Hostel = '$hostel' AND Email_Id = '$email' AND Mess_No = '$mess' AND For_Diet = 'Dinner' AND Date <= '$date'");
		$cancel_dinner_total = mysql_num_rows($result5);
		$result6 = mysql_query("SELECT * FROM `diet_cancel` WHERE Hostel = '$hostel' AND Email_Id = '$email' AND Mess_No = '$mess' AND For_Diet = 'Lunch' AND Date <= '$date'");
		$cancel_lunch_total = mysql_num_rows($result6);
		$result7 = mysql_query("SELECT * FROM `diet_cancel` WHERE Hostel = '$hostel' AND Email_Id = '$email' AND Mess_No = '$mess' AND For_Diet = 'Breakfast' AND Date <= '$date'");
		$cancel_breakfast_total = mysql_num_rows($result7);
		$diets_cancelled_total = $cancel_dinner_total + $cancel_lunch_total+ 0.5*$cancel_breakfast_total;
		$total_diets = $diff*2.5-$diets_cancelled_total;
		$bill = $total_diets*$row["Per_Diet_Cost"];
        echo "<tr><td>&nbsp &nbsp &nbsp &nbsp ".$row2["Email_Id"]."</td><td>&nbsp &nbsp &nbsp &nbsp ".$row2["Mess_No"]."</td><td>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ".$row2["Roll_No"]."</td><td>&nbsp &nbsp &nbsp &nbsp ".$diets_cancelled_total."</td><td>&nbsp &nbsp &nbsp &nbsp ".$diff."</td><td>&nbsp &nbsp &nbsp &nbsp ".$total_diets."</td><td>&nbsp &nbsp &nbsp &nbsp ".$bill."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
</div>
</body>
</html> 

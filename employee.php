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
<?php
 $password = $_SESSION['pass'];
			
	$email = $_SESSION['email'];
$conn = new mysqli("localhost", "root", "", "mess_management");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM employee WHERE Email_Id='$email' AND Password=md5($password)";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$hostel = $row["Hostel_Name"];
$mess_no = $row["Mess_No"];
$name = $row["Name"];
$last_paid = $row["Last_Paid"];
$sql2 = "SELECT * FROM mess WHERE Hostel_Name='$hostel' AND Mess_No = '$mess_no'";
$result2 = $conn->query($sql2);
$row2 = $result2->fetch_assoc();
$salary = $row2["Employee_Salary"];
$sql3 = ("SELECT * FROM hostel_admin WHERE Hostel_Name ='$hostel'");
$result3 = $conn->query($sql3);
$row3 = $result3->fetch_assoc();
$sem_beg = $row3["Sem_Beg"];
$sem_end = $row3["Sem_End"];
$date = date('Y-m-d');
if($last_paid>$date)
	$diff = 0;
else
{
	if($date>$sem_end)
		$date = $sem_end;
	$datetime1 = new DateTime($date);
	$datetime2 = new DateTime($last_paid);
	$diff = $datetime1->diff($datetime2);
	$m = $diff->format('%m month');
	$d = $diff->format('%d days');
}
$to_pay = $m*$salary + $d*$salary/(30.4375);
?>
<html>

<head>
  <title>Mess Management</title>
  <link href="site3.css" rel="stylesheet">
</head>
<body>
<ul id = "menu">
<li><a href='mess_manager.php'>Home</a></li>
<li><a href='logout.php? con = 1'>Log Out</a></li>
</ul>

<div id="main" align = "center">

  <h1>Mess Mangment Portal for Mess Employee</h1> 
</div>

<div id="main" align = "left">
<table>
<tr> <td>Logged in from email ID </td><td> <?php echo ": ".$email; ?></td></tr>
<tr> <td>Logged in as Employee of Hostel </td><td> <?php echo ": ".$hostel; ?></td></tr> 
  <tr><td>Your Mess No &nbsp </td><td><?php echo ": ".$mess_no; ?></td></tr>
  <tr> <td>Your Name &nbsp </td><td><?php echo ": ".$name; ?></td></tr>
  <tr><td>Last Paid On &nbsp </td><td><?php echo ": ".$last_paid; ?></td></tr>
  <tr> <td>Your salary per month is &nbsp </td><td><?php echo ": ".$salary; ?></td></tr>
  <tr><td>Your amount is due for duration&nbsp </td><td><?php echo ": ".$diff->format('%m month, %d days'); ?></td></tr>
  <tr> <td>Your income due is &nbsp </td><td><?php echo ": ".round($to_pay); ?></td></tr>
 </table>

</body>
</html> 

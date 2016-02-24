<!DOCTYPE html>
<?php
  session_start();
?>
<html>

<head>
  <title>Mess Management</title>
  <link href="site.css" rel="stylesheet">
</head>

<body>
<ul id = "menu">
<li><a class ="mainlinks" href='home.php'>Home</a></li>

<li><a class ="mainlinks" href='registration_student.php'>Registration As</a><br>
<div class ="submenu">
		<ul class = "abc"><div class="sublist">
            <li><a href='registration_student.php'>Student</a></li><br>
			<li><a href='registration_mess_manager.php'>Mess Manager</a></li><br>
            <li><a href='registration_emp.php'>Mess_emp</a></li><br>
            <li><a href='registration_hostel_admin.php'>hostel_admin</a></li><br></div>
        </ul>
	</div>	
</li>
</div>
<li><a class ="mainlinks" href='login_student.php'>Log In</a><br>
<div class ="submenu">
<ul class = "abc"><div class="sublist">
            <li><a href='login_student.php'>Student</a></li><br>
			 <li><a href='login_mess_manager.php'>Mess Manager</a></li><br>
            <li><a href='login_emp.php'>Mess_emp</a></li><br>
            <li><a href='login_hostel_admin.php'>hostel_admin</a></li><br></div>
        </ul>
		</div>
</li>
</ul>
<div id = "main" align = "left">
  <h1><img src="iitbhu_80.png"> <span style="padding-left:250px;"></span> Mess Mangment Portal, IIT (BHU), Varanasi</h1></div>
  <div id = "main" align = "center">
 <p><font size="3" color=#3BB9FF><b>&#34 There are people in the world so hungry, that God cannot appear to them except in the form of bread.&#34 &#45 Mahatma Gandhi</b></font></p> 
<script type="text/javascript">
<!-->
var image1=new Image()
image1.src="1.jpg"
var image2=new Image()
image2.src="2.jpg"
var image3=new Image()
image3.src="3.jpg"
var image4=new Image()
image4.src="4.jpg"
//-->
</script>
<center>
<img src="1.jpg" name="slide" width="800" height="300">
<script type="text/javascript">
<!--
var step=1
function slideit(){
document.images.slide.src=eval("image"+step+".src")
if(step<4)
step++
else
step=1
setTimeout("slideit()",2500)
}
slideit()
//-->
</script>
</center>
<p><font size="6" color="red"><b>NOTIFICATIONS</b></font></p>
  <p>DETAILS 2</p>
  <p>DETAILS 3</p>
  

</div>
</body>
</html> 

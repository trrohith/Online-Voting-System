<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$uname = mysql_real_escape_string($_POST['uname']);
	$email = mysql_real_escape_string($_POST['email']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));
	
	$uname = trim($uname);
	$email = trim($email);
	$upass = trim($upass);
	
	// username and email exist or not
	$query = "SELECT user_name FROM users WHERE user_name='$uname'";
	$result = mysql_query($query);
	$count = mysql_num_rows($result); // if username not found then register
	$query1 = "SELECT user_email FROM users WHERE user_email='$email'";
	$result1 = mysql_query($query);
	$count1 = mysql_num_rows($result);
	
	if($count == 0 && $count1 == 0){
		
		if(mysql_query("INSERT INTO users(user_name,user_email,user_pass) VALUES('$uname','$email','$upass')"))
		{
			?>
			<script>alert('You have been succesfully registered');</script>
			<?php
			header("Location: index.php");
		}
		else
		{
			?>
			<script>alert('Error while registering you...');</script>
			<?php
		}		
	}
	else if($count!=0){
			?>
			<script>alert('Sorry Apartment Number already registered.');</script>
			<?php
	}
	else if($count1!=0){
			?>
			<script>alert('Sorry Email ID already registered.');</script>
			<?php
	}
	
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
	<div id="left">
    <label>Purva</label>
    </div>
</div>
</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="Your Apartment Number" required /></td>
</tr>
<td><input type="email" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="index.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
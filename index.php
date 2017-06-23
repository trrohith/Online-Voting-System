<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
	$username = mysql_real_escape_string($_POST['username']);
	
	$username = trim($username);
	if($username=='Admin1'){
		$username='Admin';
	}

	$res=mysql_query("SELECT user_id, user_name, user_pass,voted FROM users WHERE user_name='$username'");
	$row=mysql_fetch_array($res);
	
	$count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
	
	if($count == 1)
	{
		$_SESSION['user'] = $row['user_id'];
		if($row['voted']=='false'){
			header("Location: home.php");
		}
		else{

		session_destroy();
		unset($_SESSION['user']);
		header("Location: index.php");
		}
	}
	else
	{
		session_destroy();
		unset($_SESSION['user']);
		header("Location: index.php");
	}
	
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" href="style.css" type="text/css" />

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="barcode.js"></script>

<script type="text/javascript">

var sound = new Audio("barcode.wav");

$(document).ready(function() {

	barcode.config.start = 0.1;
	barcode.config.end = 0.9;
	barcode.config.video = '#barcodevideo';
	barcode.config.canvas = '#barcodecanvas';
	barcode.config.canvasg = '#barcodecanvasg';
	barcode.setHandler(function(barcode) {
		document.getElementById("result").value=barcode;
		document.getElementById("login").click();
	});
	barcode.init();

});

</script>
</head>
<body>
<div id="header">
	<div id="left">
    <label>Organization Name</label>
    </div>
</div>
</head>
<body>
<div id="barcode">
	<video id="barcodevideo" autoplay></video>
	<canvas id="barcodecanvasg" ></canvas>
</div>
<canvas id="barcodecanvas" ></canvas>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">

<tr>
<td><input id="result" type="text" name="username" placeholder="Your ID" required /></td>
</tr>
<tr>
<td><button id="login" type="submit" name="btn-login">Sign In</button></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>
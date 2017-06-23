<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
$res=mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysql_fetch_array($res);
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['user_name']; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
	<div id="left">
    <label>Organization Name</label>
    </div>
    <div id="right">
    	<div id="content">
        	Welcome <?php echo $userRow['committee']; ?>&nbsp;<a href="logout.php?logout">Sign Out</a>
        </div>
    </div>
</div>

<div id="body">
    <?php
    if($userRow['user_name']=="Admin"){
        session_destroy();
         unset($_SESSION['user']);
        header("Location: Admin.php");
    }
    else if($userRow['user_name']=="Admin1"){
        include 'adminPanel.php';
    }
    else{
        include 'voters.php';
    }
    ?>
</div>

</body>
</html>
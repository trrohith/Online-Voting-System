<?php
if(isset($_POST['btn-vote']))
{
	$query2 = "SELECT category FROM categories WHERE committee = '".$userRow['committee']."'";
	$result2 = mysql_query($query2);
	$votes = array();
	while ($outer = mysql_fetch_array($result2)) { 
		$votes[] = $_POST[$outer['category']];
	}
	$postVote=true;
	foreach($votes as $value) {
		if($value==''){
			$postVote=false;
		}
	}

	if(!$postVote){
			?>
			<script>alert('You have not selected all options');</script>
			<?php
	}
	else{
		foreach($votes as $value) {
			$query = "UPDATE candidates SET votes = votes + 1 WHERE id = '".$value."'";
			mysql_query($query);
			$query1 = "UPDATE users SET voted='true' WHERE user_id = '".$userRow['user_id']."'";
			mysql_query($query1);
			header("Location: logout.php?logout");
			
	}
	}
}
?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
</head>
<body>
<center>
<div id="vote-form">
<form method="post">
<?php
$query = "SELECT id,name,category FROM candidates WHERE committee = '".$userRow['committee']."' order by id asc";
$query2 = "SELECT category FROM categories WHERE committee = '".$userRow['committee']."' order by id asc";
$result = mysql_query($query);
$result2 = mysql_query($query2);
?>
<p>Select the candidates:
<?php 
$data = array();
while($med = mysql_fetch_array($result)) { 
  		$data[]=$med;
	} 
while ($outer = mysql_fetch_array($result2)) { 
	$ocategeory = $outer['category'];
	echo "<br><h1>";
	echo $ocategeory;
	echo "</h1>";
	foreach($data as $med)	 {
		$id = $med['id']; 
  		$name = htmlspecialchars($med['name']); 
 		 $category = $med['category'];
 		 if($category==$ocategeory){
  			echo "<br><input type=\"radio\" name=\"$category\" value=\"$id\" />$name";  
  		}
	}
}
?>

<table align="center" width="30%" border="0">
<tr>
<br><td><button type="submit" name="btn-vote">Vote</button></td>
</tr></table></form></div>
</center></body></body></p>
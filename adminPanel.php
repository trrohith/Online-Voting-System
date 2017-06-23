<p>Results will be displayed here</p>
<?php
  if(isset($_POST['btn-add-committee']))
  {
    $committee = $_POST['committee'];
    $committee = str_replace(' ', '_', $committee);
    $query = "INSERT INTO committees(committee) VALUES('$committee')";
    $result = mysql_query($query);
  }
  else if(isset($_POST['btn-remove-committee']))
  {
    $committee = $_POST['committee'];
    $query = "DELETE FROM committees WHERE committee='$committee'";
    $result = mysql_query($query);
  }
	else if(isset($_POST['btn-add-category']))
	{
		$category = $_POST['category'];
    $committee = $_POST['committee_add'];
    $category = str_replace(' ', '_', $category);
		$query = "INSERT INTO categories(category,committee) VALUES('$category','$committee')";
		$result = mysql_query($query);
	}
	else if(isset($_POST['btn-remove-category']))
	{
		$category = $_POST['category'];
		$query = "DELETE FROM categories WHERE id='$category'";
		$result = mysql_query($query);
	}
	else if(isset($_POST['btn-add-candidate']))
	{
		$candidate = $_POST['candidate'];
		$categoryid = $_POST['category_add'];
    $query = "SELECT category,committee FROM categories where id = $categoryid";
  $result =   mysql_query($query);
  while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
    $committee = $row{committee};
    $category = $row{category};
    $query1 = "INSERT INTO candidates(`name`, `category`,`committee`, `votes`) VALUES('$candidate','$category','$committee','0')";
    $result1 = mysql_query($query1);
  }
		
	}
	else if(isset($_POST['btn-remove-candidate']))
	{
		$candidate = $_POST['candidate_remove'];
		$query = "DELETE FROM candidates WHERE id='$candidate'";
		$result = mysql_query($query);
	}



	$query = "SELECT name,votes,category,committee FROM candidates order by id";
	$result = mysql_query($query);
	$query2 = "SELECT id,category,committee FROM categories order by id";
	$result2 = mysql_query($query2);
	$data = array();
	while($med = mysql_fetch_array($result)) { 
  		$data[]=$med;
	} 
	while ($outer = mysql_fetch_array($result2)) { 
	$ocategeory = $outer['category'];
  $ocommittee = $outer['committee'];
	echo "<br><h1>";
  echo $ocommittee;
  echo ' - ';
	echo $ocategeory;
	echo "</h1>";
	foreach($data as $med)	 {
		$votes = $med['votes']; 
  		$name = htmlspecialchars($med['name']); 
 		 $category = $med['category'];
     $committee = $med['committee'];
 		 if($category==$ocategeory && $committee == $ocommittee){
  			echo "<br>Votes for ";
  			echo $name;
  			echo " is ";
  			echo $votes;
  		}
	}
}
?>
<br><br>
<center>

<div id="add-committee">
Add a committee
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="committee" placeholder="Enter a committee you would like to add" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-add-committee">Add</button></td>
</tr>
<tr>
</tr>
</table>
</form>
</div>


<br>
<div id="remove-committee" >
Remove a committee
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td>
<?php
  $query = 'SELECT committee FROM committees';
  $result =   mysql_query($query);
  echo '<select name="committee" id="committee">';
  while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
    echo '<option value="'.$row{committee}.'">
            '.$row{committee}.'</option>';
  }
  echo '</select>';
  echo '</td>';
  ?></td>
</tr>
<tr>
<td><button type="submit" name="btn-remove-committee">Remove</button></td>
</tr>
<tr>
</tr>
</table>
</form>
</div>

<br>
<div id="add-category">
Add a category
<form method="post">
<table align="center" width="50%" border="0">
<tr>
<td><input type="text" name="category" placeholder="Enter a category you would like to add" required /></td>
<td>
<?php
$query = 'SELECT committee FROM committees';
  $result =   mysql_query($query);
  echo '<select name="committee_add" id="committee_add">';
  while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
    echo '<option value="'.$row{committee}.'">
            '.$row{committee}.'</option>';
  }
  echo '</select>';
  echo '</td>';
  ?></td>
</tr>
<tr>
<td colspan=2><button type="submit" name="btn-add-category">Add</button></td>
</tr>
<tr>
</tr>
</table>
</form>
</div>


<br>
<div id="remove-category" >
Remove a category
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td>
<?php
	$query = 'SELECT id,category,committee FROM categories';
  $result =   mysql_query($query);
  echo '<select name="category" id="category">';
  while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
    echo '<option value="'.$row{id}.'">
            '.$row{committee}.' - '.$row{category}.'</option>';
  }
  echo '</select>';
  echo '</td>';
  ?></td>
</tr>
<tr>
<td><button type="submit" name="btn-remove-category">Remove</button></td>
</tr>
<tr>
</tr>
</table>
</form>
</div>


<br>
<div id="add-candidate" >
Add a candidate
<form method="post">
<table align="center" width="50%" border="0">
<tr>
<td><input type="text" name="candidate" placeholder="Enter a candidate name you would like to add" required /></td>
<td>
<?php
$query = 'SELECT id,category,committee FROM categories';
  $result =   mysql_query($query);
  echo '<select name="category_add" id="category_add">';
  while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
    echo '<option value="'.$row{id}.'">
            '.$row{committee}.' - '.$row{category}.'</option>';
  }
  echo '</select>';
  echo '</td>';
  ?></td>
</tr>
<tr>
<td colspan=2><button type="submit" name="btn-add-candidate">Add</button></td>
</tr>
<tr>
</tr>
</table>
</form>
</div>


<br>
<div id="remove-candidate" >
Remove a candidate
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td>
<?php
	$query = 'SELECT * FROM candidates';
  $result =   mysql_query($query);
  echo '<select name="candidate_remove" id="candidate_remove">';
  while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
    echo '<option value="'.$row{id}.'">
            '.$row{committee}.' - '.$row{category}.' - '.$row{name}.'</option>';
  }
  echo '</select>';
  echo '</td>';
  ?></td>
</tr>
<tr>
<td><button type="submit" name="btn-remove-candidate">Remove</button></td>
</tr>
<tr>
</tr>
</table>
</form>
</div>


<br>
<h1>
<p>List of currently registered users:</p>
</h1>
<?php
	$query = 'SELECT user_name FROM users';
  $result =   mysql_query($query);
  $data = array();
  while($row = mysql_fetch_array($result,MYSQLI_ASSOC)){
  	$data[]=$row;
  }
  asort($data);
  array_diff($data,['Admin']);
  foreach ($data as $value) {
  	if(!($value['user_name']=='Admin')){
    echo "<br>$value[user_name]";}
  }
?>
<br>
</center>
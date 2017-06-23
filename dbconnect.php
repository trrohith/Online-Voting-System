<?php
error_reporting( E_ALL & ~E_DEPRECATED & ~E_NOTICE );
if(!mysql_connect("localhost","username","password"))
{
	die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("Data"))
{
	die('oops database selection problem ! --> '.mysql_error());
}

?>
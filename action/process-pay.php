<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
$user  = $_POST['username'];
$pass = $_POST['password'];
$table = "tbl_accounts";
$query = "SELECT * FROM $table WHERE username='$user' AND password='$pass'";
$q = mysql_query_md($query);
$count = mysql_num_rows_md($q);
if($count==1)
{
	$row = mysql_fetch_md_assoc($q);
	foreach($row as $key=>$val)
	{
		$_SESSION[$key] = $val;
	}
	echo 1;
	
}
if($count==0)
{
	echo $count;
}
?>
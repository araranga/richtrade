<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
$email  = $_POST['email'];
$pass = $_POST['password'];
$table = "tbl_accounts";
$query = "SELECT * FROM $table WHERE email='$email' ";
$q = mysql_query_md($query);
$count = mysql_num_rows_md($q);
if($count==1)
{
	echo 1;	
$row = mysql_fetch_md_assoc($q);	
$to = $row['email'];
$subject = "Password Retrieval";
$txt = "Here is your password:".$row['password'];
$headers = "From: noreply@pocketfighters.com" . "\r\n" .
"CC: ardeenathanraranga@gmail.com";
mail($to,$subject,$txt,$headers);	
}
if($count==0)
{
	echo $count;	
}
?>
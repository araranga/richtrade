<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
$email  = $_POST['email'];


$q = mysql_query_md("SELECT * FROM tbl_betakey WHERE user IS NULL LIMIT 1");
$row = mysql_fetch_md_assoc($q);
$count = mysql_num_rows_md($q);




if(empty($email)){
	$count = 0;
}
if($count==1)
{
	echo 1;	
		
$to = $_POST['email'];
$subject = "PocketFighterz - Beta Keys";
$txt = "Here is your betakey:  ".$row['betakey'];
$headers = "From: noreply@pocketfighters.com" . "\r\n" .
"CC: ardeenathanraranga@gmail.com";
mail($to,$subject,$txt,$headers);	
}
if($count==0)
{
	echo $count;	
}
?>
<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
if($_SESSION['role']!=1)
{
	#	exit("hey your not allowed here");
}
if($_GET['task']=='')
{
	
	include($_GET['pages']."/jlcdaily.php");
}
if($_GET['task']!='')
{
	include($_GET['pages']."/".$_GET['task'].".php");
}


?>

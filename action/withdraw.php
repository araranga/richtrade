<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$tbl = "tbl_withdraw_history";
$primary = "id";
/*SQL*/
if($_POST['submit']!='' && $_POST['task']=='add')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$fields = formquery($_POST);
	mysql_query_md("INSERT INTO $tbl SET $fields");
	echo '<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done adding data.</li></ul></div>';
}

if($_GET['task']=='setclaim')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	mysql_query_md("UPDATE $tbl SET claim_status=1 WHERE $primary=".$_GET['id']);
	echo '<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done editing data.</li></ul></div>';
}


if($_POST['submit']!='' && $_POST['task']=='delete')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$fields = formquery($_POST);
	mysql_query_md("DELETE FROM $tbl WHERE $primary=".$_POST[$primary]);
	echo '<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done deleting the data.</li></ul></div>';
}
/*SQL*/
























if($_SESSION['role']!=1)
{
	exit("hey your not allowed here");
}
if($_GET['task']=='')
{
	
	include($_GET['pages']."/main.php");
}
if($_GET['task']=='setclaim')
{
	
	include($_GET['pages']."/main.php");
}

if($_GET['task']=='csv')
{
	csv();
}
if($_GET['task']=='add')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/add.php");
}
if($_GET['task']=='edit')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/edit.php");
}
if($_GET['task']=='delete')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/delete.php");
}

?>

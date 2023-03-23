<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$tbl = "tbl_files";
$primary = "id";
/*SQL*/
$refresh = 0;
if($_POST['submit']!='' && $_POST['task']=='add')
{
	unset($_POST['submit']);
	unset($_POST['task']);

$target_dir = "uploads/";

$datafile = explode(".", $_FILES["filename"]["name"]);


$_POST['link'] = $target_file = $target_dir .time().rand().".".end($datafile);


if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {

}

$_POST['filename'] = $_FILES["filename"]["name"];


	$_POST['createdby'] = $_SESSION['username'];
	$fields = formquery($_POST);

	echo "INSERT INTO $tbl SET $fields";
	mysql_query_md("INSERT INTO $tbl SET $fields");

	#setcookie('noti', "Done adding data",60, "/");

	$_SESSION['noti'] = "Done adding data.";

	$refresh = 1;

}

if($_POST['submit']!='' && $_POST['task']=='edit')
{
	unset($_POST['submit']);
	unset($_POST['task']);



$datarow = mysql_fetch_md_assoc(mysql_query_md("SELECT link FROM tbl_files WHERE $primary=".$_POST[$primary]));
unlink($datarow['link']);

$target_dir = "uploads/";

$datafile = explode(".", $_FILES["filename"]["name"]);


$_POST['link'] = $target_file = $target_dir .time().rand().".".end($datafile);


if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file)) {

}

$_POST['filename'] = $_FILES["filename"]["name"];








	$fields = formquery($_POST);







	mysql_query_md("UPDATE $tbl SET $fields WHERE $primary=".$_POST[$primary]);
	#setcookie('noti', "Done editing data",60, "/");
	$_SESSION['noti'] = "Done editing data.";
	$refresh = 1;
}


if($_POST['submit']!='' && $_POST['task']=='delete')
{
	unset($_POST['submit']);
	unset($_POST['task']);


	$datarow = mysql_fetch_md_assoc(mysql_query_md("SELECT link FROM tbl_files WHERE $primary=".$_POST[$primary]));
	unlink($datarow['link']);




	$fields = formquery($_POST);
	mysql_query_md("DELETE FROM $tbl WHERE $primary=".$_POST[$primary]);
	$_SESSION['noti'] = "Done deleting data.";
	$refresh = 1;
}
/*SQL*/
if($refresh){
moveredirect("index.php?pages=".$_REQUEST['pages']);
exit();	
}

if($_SESSION['role']!=1)
{
	#	exit("hey your not allowed here");
}
if($_GET['task']=='')
{
	
	include($_GET['pages']."/main.php");
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

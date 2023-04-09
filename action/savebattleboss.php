<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
require_once("../battlefunc.php");

if(empty($_REQUEST['hero'])){
	exit();
}
if(empty($_REQUEST['boss'])){
	exit();
}


savebattleboss($_REQUEST['hero'],$_REQUEST['boss']);
?>
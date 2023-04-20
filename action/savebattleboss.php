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
$hero = loadpoke($_REQUEST['hero']);
$boss = loadboss($_REQUEST['boss']);


if($hero['level']<$boss['level']){
	
	exit("Required level for this boss must be: {$boss['level']}");
}




savebattleboss($_REQUEST['hero'],$_REQUEST['boss']);
?>
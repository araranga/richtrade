<?php
session_start();
require_once("../connect.php");
require_once("../function.php");


if(empty($_REQUEST['battlehash'])){
	exit();
}


savebattle($_REQUEST['battlehash']);

?>
<div class="countdowndata"></div>
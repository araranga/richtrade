<?php
session_start();
require_once("connect.php");
require_once("function.php");
require_once("battlefunc.php");


$qpoke = mysql_query_md("SELECT * FROM tbl_battle WHERE id=2164");		
while($rowqpoke = mysql_fetch_md_assoc($qpoke)){
	echo $rowqpoke['id']."<br>";
generatebattle($rowqpoke['id']);
}	

?>
asdasd

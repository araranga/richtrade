<?php
session_start();
require_once("../connect.php");
require_once("../function.php");


$qpoke = mysql_query_md("SELECT * FROM tbl_battle WHERE p1poke!='' AND p2poke!='' AND logs IS NULL");		
while($rowqpoke = mysql_fetch_md_assoc($qpoke)){
	echo $rowqpoke['id'];
generatebattle($rowqpoke['id']);
}	

?>

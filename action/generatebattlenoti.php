<?php
session_start();
require_once("../connect.php");
require_once("../function.php");

$id = $_SESSION['accounts_id'];
$qpoke = mysql_query_md("SELECT * FROM tbl_battle WHERE (p1user='$id') AND v1 IS NULL AND logs IS NOT NULL");
	
while($rowqpoke = mysql_fetch_md_assoc($qpoke)){
	echo "Watch Here : <a href='index.php?pages=pokebattleview&id={$rowqpoke['id']}&v=1'>Battle ID {$rowqpoke['id']}</a><br><script>window.location='index.php?pages=pokebattleview&id={$rowqpoke['id']}'</script>";
	mysql_query_md("UPDATE tbl_battle SET v1 = 1 WHERE id = {$rowqpoke['id']}");
	exit();
}

$qpoke = mysql_query_md("SELECT * FROM tbl_battle WHERE (p2user='$id') AND v2 IS NULL AND logs IS NOT NULL");
	
while($rowqpoke = mysql_fetch_md_assoc($qpoke)){
	
	mysql_query_md("UPDATE tbl_battle SET v2 = 1 WHERE id = {$rowqpoke['id']}");
	echo "Watch Here : <a href='index.php?pages=pokebattleview&id={$rowqpoke['id']}&v=2'>Battle ID {$rowqpoke['id']}</a><br><script>window.location='index.php?pages=pokebattleview&id={$rowqpoke['id']}'</script>";
}	

?>
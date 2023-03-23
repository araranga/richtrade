<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_pokemon_users");

while($row = mysql_fetch_md_assoc($q)){
	echo $row['id']."---".$row['hash']."\n";
	//generatemoves($row['hash']);
	randomskills($row['hash']);
}



	

?>
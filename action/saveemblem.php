<?php
session_start();
require_once("../connect.php");
require_once("../function.php");




if(empty($_REQUEST['hash'])){

	exit();

}

if(empty($_REQUEST['emblem'])){

	exit();

}



$emblem = $_REQUEST['emblem'];

$hash = $_REQUEST['hash'];





$poke = loadpoke($hash);

$user = $_SESSION['accounts_id'];

if($user!=$poke['user']){

	echo "Warrior is not yours.";

	exit();		

}
mysql_query_md("UPDATE tbl_pokemon_users SET emblem='$emblem' WHERE id='{$poke['id']}'");
?>
<script>

window.location = 'index.php?pages=pokemon';

</script>
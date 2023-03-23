<?php
session_start();
require_once("../connect.php");
require_once("../function.php");




if(empty($_REQUEST['hash'])){

	exit();

}

if(empty($_REQUEST['amount'])){

	exit();

}



$amount = $_REQUEST['amount'];

$hash = $_REQUEST['hash'];





$poke = loadpoke($hash);







if($amount<=0){

	echo "Please add correct amount";

	exit();

}





if(!empty($poke['is_market'])){

	echo "Warrior is already on market";

	exit();

}





$user = $_SESSION['accounts_id'];

if($user!=$poke['user']){

	echo "Warrior is not yours.";

	exit();		

}







mysql_query_md("INSERT INTO tbl_market SET user='$user',pokeid='{$poke['id']}',amount='$amount'");

mysql_query_md("UPDATE tbl_pokemon_users SET is_market='1' WHERE id='{$poke['id']}'");

?>
<script>

window.location = 'index.php?pages=pokemon';

</script>
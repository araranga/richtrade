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

$qmarket = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE (is_market IS NULL  OR is_market!=1) AND user='{$poke['user']}'");
$qmarketcount = mysql_num_rows_md($qmarket);



$marketcount = mysql_query_md("SELECT * FROM tbl_market WHERE pokeid='{$poke['id']}' ORDER by amount DESC");
$mcount = mysql_fetch_md_assoc($marketcount);


if($mcount['amount']>$amount){

	echo "Amount must be higher on the last selling ({$mcount['amount']}).";
	exit();	
	
}





if($qmarketcount<=1){
	

	echo "Unable to process. You only have 1 Warrior. Its must be 2 or more.";

	exit();

	
}


if($poke['level']<25){
	
	echo "Warrior must be atleast level 15 onwards to qualified into selling";
	exit();
}


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
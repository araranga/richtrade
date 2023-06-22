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





$poke = loadweapon($hash);

if($amount<=0){

	echo "Please add correct amount";

	exit();

}


$marketcount = mysql_query_md("SELECT * FROM tbl_market_item WHERE pokeid='{$poke['id']}' ORDER by amount DESC");
$mcount = mysql_fetch_md_assoc($marketcount);


if($mcount['amount']>$amount){

	echo "Amount must be higher on the last selling ({$mcount['amount']}).";
	exit();	
	
}





if(!empty($poke['is_market'])){

	echo "Item is already on market";

	exit();

}





$user = $_SESSION['accounts_id'];

if($user!=$poke['user']){

	echo "Item is not yours.";

	exit();		

}







mysql_query_md("INSERT INTO tbl_market_item SET user='$user',pokeid='{$poke['id']}',amount='$amount'");
mysql_query_md("UPDATE tbl_items_users SET is_market='1',pokemon = '' WHERE id='{$poke['id']}'");

?>
<script>

window.location = 'index.php?pages=treasure';

</script>
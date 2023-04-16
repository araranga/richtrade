<?php
session_start();
require_once("../connect.php");
require_once("../function.php");


if(empty($_REQUEST['item'])){
	exit();
}
if(empty($_REQUEST['hero'])){
	exit();
}




$poke = loadpoke($_REQUEST['hero']);
$weapon = loadweapon($_REQUEST['item']);


if($poke['user']!=$_SESSION['accounts_id']){
	
	exit("not allowed 1");
}


if($weapon['user']!=$_SESSION['accounts_id']){
	
	exit("not allowed 2");
}


mysql_query_md("UPDATE tbl_items_users SET pokemon = '' WHERE hash='{$weapon['hash']}'");
mysql_query_md("UPDATE tbl_items_users SET pokemon = '' WHERE pokemon='{$poke['id']}'");
mysql_query_md("UPDATE tbl_items_users SET pokemon = '{$poke['id']}' WHERE hash='{$weapon['hash']}'");
?>
Successful to Equip(<?php echo $weapon['pokename']; ?>) to (<?php echo $poke['pokename']; ?>)
<script>
setTimeout(myGreeting, 5000);

function myGreeting(){
	
  window.location = 'index.php?pages=treasure';	
}

</script>
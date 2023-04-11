<?php
session_start();
require_once("../connect.php");
require_once("../function.php");

$poke = loadpoke($_REQUEST['battlehash']);

if(empty($_REQUEST['battlehash'])){
	echo "Missing param";
	exit();
}

if($poke['user']!=$_SESSION['accounts_id']){
	echo "Not allowed";
	exit();
}

$queryxcountbattle = "SELECT * FROM tbl_battle WHERE (p1poke='{$poke['id']}') AND winner IS NOT NULL AND v1 IS NULL";
$qxqueryxcountbattle = mysql_query_md($queryxcountbattle);
$countxbattle = mysql_num_rows_md($qxqueryxcountbattle);
if(!empty($countxbattle)){
	$databattlecount = mysql_fetch_md_assoc($qxqueryxcountbattle);
	$view = 1;
	?>
	Your are still have pending battle watch <a href='/index.php?pages=pokebattleview&id=<?php echo $databattlecount['id']; ?>&v1=1'>here</a><hr>
	<script>
		window.location = "/index.php?pages=pokebattleview&id=<?php echo $databattlecount['id']; ?>&v=1";
	</script>
	<?php
	exit();
}

$queryxcountbattle = "SELECT * FROM tbl_battle WHERE (p2poke='{$poke['id']}') AND winner IS NOT NULL AND v2 IS NULL";
$qxqueryxcountbattle = mysql_query_md($queryxcountbattle);
$countxbattle = mysql_num_rows_md($qxqueryxcountbattle);
if(!empty($countxbattle)){
	$databattlecount = mysql_fetch_md_assoc($qxqueryxcountbattle);
	?>
	Your are still have pending battle watch  <a href='/index.php?pages=pokebattleview&id=<?php echo $databattlecount['id']; ?>&v2=1'>here</a><hr>
	<script>
		window.location = "/index.php?pages=pokebattleview&id=<?php echo $databattlecount['id']; ?>&v=2";
	</script>	
	<?php
	exit();
}



savebattle($_REQUEST['battlehash']);

?>
<div class="countdowndata<?php echo $poke['id']; ?>" data-hash='<?php echo $_REQUEST['battlehash']; ?>'></div>
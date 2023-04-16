<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);
$release = array();
$release[] = "Select Item";
$q2 = mysql_query_md("SELECT * FROM tbl_items");
while($row2 = mysql_fetch_md_assoc($q2)){
	$release[$row2['id']] = $row2['title_name'];
}

	if($_POST['itemid']!='')
	{
		$item = loaditem($_POST['itemid']);
		//$qty = 1;
		$qty = $_POST['qty'];
		
		$total = $qty * $item['price'];
		
		$_POST['withdraw'] = $total;
		
		if($_POST['qty']==0 || $_POST['qty']<0)
		{
			$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to qty.<br>";
		}
		
		if($_POST['password']!=$row['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Password do not match.<br>";
		}
		if($_POST['withdraw']==0 || $_POST['withdraw']<0)
		{
						$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to purchase.<br>";
		}
		if($_POST['withdraw']>$row['balance']) 
		{
			$error .= "<i class=\"fa fa-warning\"></i>Amount to purchase(".$_POST['withdraw'].") is insufficient on current balance(".$row['balance']."). Please input valid amount.<br>";
		}
		
		if($error=='')
		{
		$sum  = $row['balance'] - $_POST['withdraw'];
		$is_use = 0;
		if($item['target_attr']=='pokeballs'){
			mysql_query_md("UPDATE tbl_accounts SET pokeballs= pokeballs + $qty WHERE accounts_id='$accounts_id'");
			$is_use = 1;
		}
		if($item['target_attr']=='chest'){
			mysql_query_md("UPDATE tbl_accounts SET chest= chest + $qty WHERE accounts_id='$accounts_id'");
			$is_use = 1;
		}		
		
		addeco($_POST['withdraw'] * 0.05);
		mysql_query_md("INSERT INTO tbl_income SET user='{$accounts_id}', message='Your Purchase a items({$item['title_name']} X $qty): -{$_POST['withdraw']}'");
		mysql_query_md("UPDATE tbl_accounts SET balance='".$sum."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		
$xas = 1;
$priceper = $_POST['withdraw'] / $qty;
while($xas<=ceil($_POST['qty']))
{		
		
		$trans = transgen();
		mysql_query_md("INSERT INTO tbl_item_history SET transnum='$trans',
		accounts_id='$accounts_id',
		amount='".$priceper."',
		itemid='".$_POST['itemid']."',
		qty='1',
		is_use='$is_use'
		");	
$xas++;
}		
		
		
		
		$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
		$row = mysql_fetch_md_assoc($q);		
		}		
		
		
		
	}




?>
<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done on purchasing your item. Please see below</li></ul></div>
<?php
}
?>
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>
<style>
.ui.card, .ui.cards>.card {
	width:183px;
	    margin-left: 36px;
}
</style>
<?php
$field = array();
$field[] = array("type"=>"select","value"=>"itemid","label"=>"Item Name","option"=>$release,"attributes"=>array("onchange"=>"itemshow()"));
//$field[] = array("type"=>"number","value"=>"qty","label"=>"Qty","option"=>$release);
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
?>
<h1>Your Items</h1>
<form method='GET' action='?pages=useitems'>
<div id="poke-container" class="ui cards">
<input type='hidden' name='pages' value='useitems'>
<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT COUNT(*) as total,itemid FROM tbl_item_history WHERE accounts_id='$myuser' AND is_use=0 GROUP by itemid");		

	while($rowqpokesx = mysql_fetch_md_assoc($qpokes)) {
		
		$rowqpokes = loaditem($rowqpokesx['itemid']);
		
?>	
		<div id='pokeitemv2-<?php echo $rowqpokes['id']; ?>' class="ui card" >

		   <div class="image">
		   <br/>
		   <img class='uipokeimg' srcset="sprites/items/<?php echo $rowqpokes['image']; ?>"></div><br>
		   <h4><?php echo $rowqpokes['title_name']; ?> x <?php echo $rowqpokesx['total']; ?></h4>
		   <p><?php echo $rowqpokes['description']; ?></p>
		</div>
<?php
	}
?>	
	

			<div id='pokeitemv2-xxx' class="ui card">
			   <div class="image">
			   <br/>
			    <img class='uipokeimg' srcset="sprites/items/poke-ball.png"></div><br>
			   <h4>Quest Scroll x <?php echo $row['pokeballs']; ?></h4>
			   <p>Use to hire Warriors</p>
			</div>	
			<div id='pokeitemv2-xxx' class="ui card">
			   <div class="image">
			   <br/>
			    <img class='uipokeimg' srcset="sprites/items/chest.png"></div><br>
			   <h4>Chest x <?php echo $row['chest']; ?></h4>
			   <p>Open this to get a chance to get rare items.</p>
			</div>	
		
		
</div>	
</form>
<script>
jQuery('#walletbalance').text("<?php echo number_format($row['balance'],2); ?>");
</script>
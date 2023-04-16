<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);



$release = array();
$release[] = "Select Item";

$q2 = mysql_query_md("SELECT * FROM tbl_items");
while($row2 = mysql_fetch_md_assoc($q2)){
	$release[$row2['id']] = $row2['title_name'];
}

	if($_POST['submit']!='')
	{
		$item = loaditem($_POST['itemid']);
		$qty = 1;
		$_POST['qty'] = 1;
		
		$total = $qty * $item['price'];
		
		$_POST['withdraw'] = $total;
		

		
		if($_POST['password']!=$row['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Password do not match.<br>";
		}
		if($_POST['withdraw']==0 || $_POST['withdraw']<0)
		{
						$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to withdraw.<br>";
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
			mysql_query_md("UPDATE tbl_accounts SET pokeballs= pokeballs + 1 WHERE accounts_id='$accounts_id'");
			$is_use = 1;
		}
		
		
		
		
		mysql_query_md("UPDATE tbl_accounts SET balance='".$sum."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		$trans = transgen();
		mysql_query_md("INSERT INTO tbl_item_history SET transnum='$trans',
		accounts_id='$accounts_id',
		amount='".$_POST['withdraw']."',
		itemid='".$_POST['itemid']."',
		qty='".$_POST['qty']."',
		is_use='$is_use'
		");	
		$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
		$row = mysql_fetch_md_assoc($q);		
		}		
		
		
		
	}




?>
<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done requesting for withdrawal please see status <a href='?pages=itemhistory'>here</a> </li></ul></div>
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
$field[] = array("type"=>"number","value"=>"qty","label"=>"Qty");
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
?>
<h1>Shop - Your Wallet(<span id='walletbalance'><?php echo number_format($row['balance'],2); ?></span>)</h1>



<div class="alert alert-info alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i>Hey!</h5>
20% of the amount purchase item here will be go the system fund which helps the economy conversion.
</div>


<div class="panel panel-default">
   <div class="panel-body">
      <form id='catchpoke' method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
         <?php echo loadform($field,$sdata); ?>
		 

<div id="poke-container" class="ui cards">

<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT * FROM tbl_items");		

	while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
		
		
?>	
		<div id='pokeitem-<?php echo $rowqpokes['id']; ?>' class="ui card itemshops" style='display:none;'>

		
		   <div class="image"><img class='uipokeimg' srcset="sprites/items/<?php echo $rowqpokes['image']; ?>"></div><br>
		   <h4><?php echo $rowqpokes['title_name']; ?></h4>
		   <p><?php echo $rowqpokes['description']; ?></p>
		   <span>Price:<?php echo number_format($rowqpokes['price'],2); ?></span>
		</div>
<?php
	}
?>	
		
		
</div>		 
		 
         <center><input class='btn btn-primary btn-lg' type='button' onclick="catchpokemon()" name='submit' value='Submit'></center>
      </form>
   </div>
</div> 

<script>
	function catchpokemon(){
		
		jQuery('#battlenow').trigger('click');
		jQuery('#battlebody').html("");
		jQuery('#battlebody').html("<p>Loading..</p>");
		jQuery.post("action/shopsave.php", jQuery( "#catchpoke" ).serialize(), function(result){
			jQuery('#pokeitemsholder').html(result);
			jQuery('#password').val('');
			location.href = "#pokeitemsholder";
		});				
	}
</script>

<script>
function itemshow(){
	jQuery('.itemshops').hide();
	if(jQuery('#itemid').val()!=0){
		jQuery('#pokeitem-'+jQuery('#itemid').val()).show();
	}
}
</script>

<hr>

<div id='pokeitemsholder'>
	<h1>Your Items</h1>
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
			   <h4>Quest Scroll x <?php echo $_SESSION['pokeballs']; ?></h4>
			   <p>Hire a fighters alongside with you.</p>
			</div>		
			<div id='pokeitemv2-xxx' class="ui card">
			   <div class="image">
			   <br/>
			    <img class='uipokeimg' srcset="sprites/items/chest.png"></div><br>
			   <h4>Chest x <?php echo $_SESSION['chest']; ?></h4>
			   <p>Open this to get a chance to get rare items.</p>
			</div>
	
	
	</div>	
</div>





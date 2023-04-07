<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);

$poke = loadpoke($_GET['pokeid']);


$q1 = mysql_query_md("SELECT * FROM tbl_market WHERE pokeid='{$poke['id']}' AND buyer IS NULL");
$row1 = mysql_fetch_md_assoc($q1);

if(empty($row1)){
	exit("your not allow");
}

function trans()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 12; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

	if($_POST['submit']!='')
	{
		$_POST['withdraw'] = $row1['amount'];
		if($_POST['password']!=$row['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Password do not match.<br>";
		}
		if($_POST['withdraw']==0 || $_POST['withdraw']<0)
		{
						$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to pay.<br>";
		}
			
		
		if($_POST['withdraw']>$row['balance']) 
		{
			$error .= "<i class=\"fa fa-warning\"></i>Amount to pay(".$_POST['withdraw'].") is insufficient on current balance(".$row['balance'].").<br>";
		}
		
		if($error=='')
		{
		$sum  = $row['balance'] - $_POST['withdraw'];
		mysql_query_md("UPDATE tbl_accounts SET balance='".$sum."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		$trans = trans();
		$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
		
		addeco($_POST['withdraw'] * 0.05);
		$total = $_POST['withdraw'] - ($_POST['withdraw'] * 0.20);
		
		
		mysql_query_md("UPDATE tbl_market SET buyer='{$_SESSION['accounts_id']}',sold='1' WHERE pokeid='{$poke['id']}'");
		mysql_query_md("UPDATE tbl_pokemon_users SET user='{$_SESSION['accounts_id']}',is_market='0' WHERE id='{$poke['id']}'");
		mysql_query_md("UPDATE tbl_accounts SET balance= balance + {$total}  WHERE accounts_id='{$row1['user']}'");


		mysql_query_md("INSERT INTO tbl_income SET user='{$row1['user']}', message='Your Marketplace item sold: {$total} to ID:{$_SESSION['fullname']}'");
		
		
		$seller = loadmember($row1['user']);
		
		$to = $seller['email'];
		$subject = "PocketFighterz - MarketPlace - Item Sold: {$poke['hash']}";
		$txt = "Your Marketplace item sold: {$total} to ID:{$_SESSION['fullname']}";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$mailtemp = file_get_contents("sprites/email.txt");
		
		
		$mailtemplate = str_replace(array("SUBJECT_DATA","CONTENT_DATA","P_DATA"),array("MarketPlace - Sold: {$poke['hash']}","You earn: {$total}","Please note that your price was deducted by 20%. for System fee."),$mailtemp);

		// More headers
		$headers .= "From: noreply@pocketfighters.com" . "\r\n" .
		"CC: hero@pocketfighters.com";

		mail($to,$subject,$mailtemplate,$headers);		

		$row = mysql_fetch_md_assoc($q);		
		?>
		<script>
			window.location = 'index.php?pages=pokemon';
		</script>
		<?php
		exit();
		}
	}
	
$field[] = array("type"=>"text","value"=>"bank_name","label"=>"Bank Name");
$field[] = array("type"=>"text","value"=>"bank_accountname","label"=>"Account Name");
$field[] = array("type"=>"text","value"=>"bank_accountnumber","label"=>"Account Number");
//
$field[] = array("type"=>"text","value"=>"name","label"=>"Fullname");
$field[] = array("type"=>"text","value"=>"address","label"=>"Address");
$field[] = array("type"=>"text","value"=>"phone","label"=>"Phone Number");
//
$field[] = array("type"=>"number","value"=>"withdraw","label"=>"Amount to withraw");
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password");
//
?>
<h2>Buy Warrior Balance:(<?php echo $row['balance']; ?>)</h2>   


<?php
$myuser = $_GET['pokeid'];
$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE hash='$myuser'");		

	while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
?>	
		<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
		<div class='typedataholder'>
			<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
				
				<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
			<?php } ?>	
		</div>
		
		   <div class="image">  
				<div class='mainchar flipme showchar' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'></div>		   
		   </div>
		   <h4><?php echo $rowqpokes['pokename']; ?></h4>
		   <h5 style='font-weight:700;'>Amount:<?php echo number_format($row1['amount'],2); ?></h5>
		   <p class='idsdata'>ID:#<?php echo $rowqpokes['hash']; ?></p>
		   <span>Level:<?php echo $rowqpokes['level']; ?></span>
		   <span>Attack:<?php echo $rowqpokes['attack']; ?></span>
		   <span>Defense:<?php echo $rowqpokes['defense']; ?></span>
		   <span>HP:<?php echo $rowqpokes['hp']; ?></span>
		   <span>Speed:<?php echo $rowqpokes['speed']; ?></span>
		   <span>Critical:<?php echo $rowqpokes['critical']; ?></span>
		   <span>Accuracy:<?php echo $rowqpokes['accuracy']; ?></span><br/>	


		   <span>
		   
		   <?php 
		   $games = $rowqpokes['win'] + $rowqpokes['lose'];
		   
			if(!empty($games)) {
				echo "Win Rate:".number_format(($rowqpokes['win'] / $games) * 100,2)."%"; 
				echo "<br>"."W/L:".$rowqpokes['win']."/".$games;
			}
		   echo "<br>";
		   
			
		   ?>
		   
		   </span>
		</div>
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
.bank,.remit,.remitmain,.smartpadala,.antibug
{
	display:none;
}
</style>
<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done Purchasing the Pokemon</li></ul></div>
<?php
}
?>
<?php
$field = array();

//$field[] = array("type"=>"select","value"=>"claimtype","label"=>"Select Mode of Withdrawal","option"=>array("btc"=>"Gcash"));
//$field[] = array("type"=>"text","value"=>"address","label"=>"GCASH Number:");
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
//$field[] = array("type"=>"number","value"=>"withdraw","label"=>"Amount to withdraw:");
//$field[] = array("type"=>"select","value"=>"stores","label"=>"Branch","option"=>getarrayconfig('stores'));
?>

<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>&pokeid=<?php echo $_GET['pokeid'];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Buy'></center>
      </form>
   </div>
</div> 

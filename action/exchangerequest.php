<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);
function trans()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 12; $i++) {
        $randstring .= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

	if($_POST['submit']!='' && $_POST['amounttoconv'])
	{
		if($_POST['password']!=$row['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Password do not match.<br>";
		}
		if($_POST['amounttoconv']==0 || $_POST['amounttoconv']<0)
		{
					$error .= "<i class=\"fa fa-warning\"></i>Please input valid and not empty amount to convert.<br>";
		}
		if($_POST['withdraw']>$row['balance']) 
		{
			//$error .= "<i class=\"fa fa-warning\"></i>Amount to withdraw(".$_POST['withdraw'].") is insufficient on current balance(".$row['balance']."). Please input valid amount.<br>";
		}
		
		if($error=='')
		{
		// $sum  = $row['balance'] - $_POST['withdraw'];
		// mysql_query_md("UPDATE tbl_accounts SET balance='".$sum."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		$trans = trans();
		$amount = $_POST['amounttoconv'];
		mysql_query_md("INSERT INTO tbl_exchange_history SET amount='$amount',transnum='$trans',claimtype='".$_POST['claimtype']."',claimtype_id='".$_POST['claimtype_id']."',accounts_id='$accounts_id'");		
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
<h2>Exchange Request</h2>   
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
<div class="noti">
<ul class="fa-ul">
<li><i class="fa fa-check fa-li"></i>Done requesting for exchange please see status <a href='?pages=exchangehistory'>here</a> </li>
<li><i class="fa fa-check fa-li"></i>Also Please send amount of (<?php echo $_POST['final_amount']; ?> (Tether or <?php echo $_POST['amounttoconv']; ?> amount coins from <?php echo $_POST['claimtype']; ?>)) to wallet address: <span style='color:red;font-weight:700;'><?php echo systemconfig("admin_btc_address"); ?></span></li>
</ul>
</div>
<?php
}
?>




<?php if(!empty($_GET['fromCrypto'])) { ?>

<?php
$tether = getTetherRate();
$field = array();

$sdata = array();
$sdata['claimtype'] = $_GET['fromCrypto'];



///////
$attributes = array();
$attributes['readonly'] = "readonly";
$field[] = array("type"=>"text","value"=>"claimtype","label"=>"Coin Origin:","attributes"=>$attributes);


///////
$attributes = array();
$attributes['onkeyup'] = "computeexchange()";
$field[] = array("type"=>"text","value"=>"amounttoconv","label"=>"Amount to Convert:","attributes"=>$attributes);


///////
$attributes = array();
$attributes['readonly'] = "readonly";
$field[] = array("type"=>"text","value"=>"amounttoconvtorecieve","label"=>"Tether(USDT) Converted Amount:","attributes"=>$attributes);


////
$attributes = array();
$attributes['readonly'] = "readonly";
$field[] = array("type"=>"text","value"=>"deduct","label"=>"Deduction (Processing Fee 5%):","attributes"=>$attributes);


////
$attributes = array();
$attributes['readonly'] = "readonly";
$field[] = array("type"=>"text","value"=>"final_amount","label"=>"Final Amount:","attributes"=>$attributes);


$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
//$field[] = array("type"=>"select","value"=>"stores","label"=>"Branch","option"=>getarrayconfig('stores'));


$coinrate = getCoinRate($_GET['cid']);

?>	

<a href='/index.php?pages=exchangerequest'>Select different coins</a>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
      	<input type='hidden' name='claimtype_id' value='<?php echo $_GET['cid']; ?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Submit'></center>
      </form>
   </div>
</div> 



<script>
function computeexchange(){
				jQuery('#amounttoconvtorecieve , #deduct, #final_amount').val(0);
            const input = document.getElementById('amounttoconv');


            let value = input.value;
			let valuemain = input.value;

			if(value==''){
				return;
			}

            // Check if the input contains any characters other than digits and decimal point

            // Remove any characters that are not digits or decimal points
            value = value.replace(/[^0-9.]/g, '');

            // Ensure only one decimal point is allowed
            const parts = value.split('.');
            if (parts.length > 2) {
                value = parts[0] + '.' + parts.slice(1).join('');
            }

            // Set the cleaned value back to the input field
            input.value = value;
	
            if (/[^0-9.]/.test(valuemain)) {
                return false; // Invalid input, stop further processing
            }
	
			
			
	
	var btcRateUsd = parseFloat("<?php echo $coinrate['data']['priceUsd']; ?>");
	var usdtRateUsd = parseFloat("<?php echo $tether['data']['priceUsd']; ?>");
	var btcAmount = parseFloat(jQuery('#amounttoconv').val());
	
	var conv = convertBtcToUsdt(btcRateUsd, usdtRateUsd, btcAmount);
	
	console.log(conv);
	var deduct = conv * 0.05;
	jQuery('#amounttoconvtorecieve').val(conv);
	jQuery('#deduct').val(deduct);

	jQuery('#final_amount').val(conv - deduct);
	
}

  
	function convertBtcToUsdt(btcRateUsd, usdtRateUsd, btcAmount) {
		// Calculate the amount of USDT
		return (btcAmount * btcRateUsd) / usdtRateUsd;
	}  

</script>



<?php  } ?>



<?php if(empty($_GET['fromCrypto'])) { ?>

<?php
$field = array();
$field[] = array("type"=>"text","value"=>"coins","label"=>"Search a coin.");



?>	
<p>Search a coin like bitcoin etc.</p>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Search'></center>
      </form>
   </div>
</div> 
<hr>



<?php
	
	$cryptodata = fetchCryptoData(20);

	if(!empty($_REQUEST['coins'])){

		$cryptodata = fetchCryptoDataSearch(20,$_POST['coins']);
	}
				$tether = getTetherRate();
				$final_rate = $tether['data']['priceUsd'];	


				$total = count($cryptodata['data']);
?>

<?php
if($total==0) {
?>
<p> No result for coin search:  <?php echo $_REQUEST['coins']; ?>.</p>

<p>Try using its coin id eg. btc,slp,eth.</p>
<?php
}
?>


<div class="panel panel-default" style="<?php if($total==0) { echo "display:none;"; } ?>">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
									        <thead>
									        <tr>
											    
									            <th>Symbol</th>
									            <th>Name</th>
									            <th>priceUsd</th>
									            <th>Value for 1 USD</th>
												<th></th>
									        </tr>
									        </thead>
                                    <tbody>
													<?php foreach($cryptodata['data'] as $d) { ?>
														<?php


															$crypto = convertCrypto(1,$d['priceUsd'],$final_rate);
															
															$cryptofinal = number_format(1 / $d['priceUsd'],10);
														?>
											        <tr>
														
											            <td><?php echo $d['symbol']; ?></td>
											            <td><?php echo $d['name']; ?></td>
											            <td><?php echo $d['priceUsd']; ?></td>
											            <td><?php echo $cryptofinal; ?></td>
														<td>
														<a href='/index.php?pages=exchangerequest&fromCrypto=<?php echo $d['symbol']; ?>&cid=<?php echo $d['id']; ?>'>Select</a>
														</td>
											        </tr>
													<?php  } ?>									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 


<?php  } ?>







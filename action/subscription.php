<?php
session_start();
require_once("./connect.php");
require_once("./function.php");


		$rate = array();


for ($x = 1; $x <= 5; $x++) {
  
  $rdata = array();

  $rdata['rate_id'] = $x;
  $rdata['rate_name'] = $x." Months";

  if($x==1){

      $rdata['rate_name'] = $x." Month";
  }
  $rdata['rate_start'] = systemconfig("table_amount") * $x;
  $rdata['rate_end'] = 1;
  $rdata['rate_bonus'] = 1;

  $rate[] = $rdata;
}

  $is_active = 1;

  if(empty($_SESSION['deadline'])){
      $is_active = 0;
  }else

  {

$today = date("Y-m-d h:i:s");
$expire = $_SESSION['deadline']; //from database

$today_time = strtotime($today);
$expire_time = strtotime($expire);

if ($expire_time < $today_time) { 

     $is_active = 0;
 }

}



$countdown = strtotime($_SESSION['deadline']);


$cdtest =  date("M d, Y h:i:s",$countdown);

?>

<?php if(empty($is_active)) { ?>
<div class="callout callout-warning">
      <h5>Please resubscribe your account below.</h5>

      <p>You will lose the chance of getting large bonuses every month.</p>
</div>
<?php } else {
?>
<div class="callout callout-info">
      <h5>Your Subscription Expires In:.</h5>



<div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clock"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                  <p id="demo">Loading</p>
                </span>
              </div>
              <!-- /.info-box-content -->
</div>
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $cdtest; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>

</div>

<?php

} ?>
<style>
	label.btn.btn-default.text-center.active {
    background-color: #b3b3b3;
}
#paymentproceed {
	display:none;
}
</style>
<script type="text/javascript">
	
	function triggercheckout(aa){
		jQuery('.choicescc').removeClass('active');
		
		jQuery(aa).addClass('active');
		jQuery('#pricecc').text(jQuery(aa).attr('data-price'));

		jQuery('#item_name').val(jQuery(aa).attr('data-rate_name')+" Subscription");
		jQuery('#item_desc').val("Subscription Payment for Account : <?php echo $_SESSION['username']; ?>");
		jQuery('#item_number').val(jQuery(aa).attr('data-rate_id'));
		jQuery('#amountf').val(jQuery(aa).attr('data-rate_start'));

		jQuery('#referral').text(jQuery(aa).attr('data-rate_end')+"%");

		jQuery('#matrix').text(jQuery(aa).attr('data-rate_bonus')+" months");

		

    jQuery('#item_name2').val(jQuery(aa).attr('data-rate_name')+" Subscription");
    jQuery('#item_desc2').val("Subscription Payment for Account : <?php echo $_SESSION['username']; ?>");
    jQuery('#item_number2').val(jQuery(aa).attr('data-rate_id'));
    jQuery('#amountf2').val(jQuery(aa).attr('data-rate_start'));

		
	}
</script>
<div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-12">
              <h3 class="my-3">Subscription Fee</h3>
<!--               <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
 -->
              <hr>

              <h4 class="mt-3">Select Months: <small>Please select one</small></h4>
              <div class="btn-group btn-group-toggle">

              	<?php 
              	foreach($rate as $data) { 

              		$fields = array();

              		foreach($data as $k=>$v){
              			$v = addslashes($v);
              			$fields[]  = "data-{$k}='$v'";
              		}
              		$price = "$".number_format($data['rate_start'],2);
              		$fields[] = "data-price='$price'";
              	
              	?>
                <label id="dc<?php echo $data['rate_id']; ?>" <?php echo implode(" ", $fields); ?>  class="btn btn-default text-center choicescc" onclick="triggercheckout(this)">
                  <span class="text-xl">$<?php echo number_format($data['rate_start'],2); ?></span>
                  <br>
                  <?php echo ($data['rate_name']); ?>
                </label>
                <?php } ?>


              </div>
          <div class="row mt-4">

            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> 
                    This will unlock bonus for every downline up to 10th level.

               </div>
            </div>
          </div>
              <div class="bg-gray py-2 px-3 mt-4">
                <h2 id="pricecc"class="mb-0">
                  $80.00
                </h2>
              </div>

              <div class="mt-4">
                <div class="btn btn-primary btn-lg btn-flat" onclick="checkmeout()">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Proceed To Payment
                </div>

              </div>


            </div>
          </div>

        </div>
        <!-- /.card-body -->
      </div>
<script type="text/javascript">
	<?php
		$current = current($rate);
	?>
	function start(){
	jQuery('#dc<?php echo $current['rate_id']; ?>').trigger('click');
	}
	function checkmeout(){
		jQuery('#paymentproceed').submit();
	}

</script>

<?php  $url = "http://".$_SERVER['HTTP_HOST']."/"; ?>
<form id='paymentproceed' action="https://www.coinpayments.net/index.php" method="post">
    <input type="hidden" name="cmd" value="_pay_simple">
    <input type="hidden" name="reset" value="1">
    <input type="hidden" name="merchant" value="<?php echo systemconfig('merchant_id'); ?>">
    <input type="hidden" name="currency" value="USD">    
    <input type="hidden" id='item_name' name="item_name" value="Test">
    <input type="hidden" id='item_desc' name="item_desc" value="Test Description">
    <input type="hidden" id='item_number' name="item_number" value="1">
    <input type="hidden" id='custom' name="custom" value="<?php echo $_SESSION['accounts_id']; ?>">
    <input type="hidden" id='invoice' name="invoice" value="SF-<?php echo rand(); ?>">
    <input type="hidden" id='amountf' name="amountf" value="1.00000000">
    <input type="hidden" name="want_shipping" value="0">
    <input type="hidden" name="success_url" value="<?php echo $url; ?>dashboard/index.php">
    <input type="hidden" name="cancel_url" value="<?php echo $url; ?>dashboard/index.php?pages=subscription">
    <input type="hidden" name="ipn_url" value="<?php echo $url; ?>dashboard/ipn2.php">
    <input type="image" src="https://www.coinpayments.net/images/pub/buynow-wide-blue.png" alt="Buy Now with CoinPayments.net">
</form>




<?php if($_GET['debugpay']==1) { ?>
<form id='paymentproceed2' action="<?php echo $url; ?>dashboard/ipn2.php" method="post">
    <input type="hidden" name="cmd" value="_pay_simple">
    <input type="hidden" name="reset" value="1">
    <input type="hidden" name="merchant" value="<?php echo systemconfig('merchant_id'); ?>">
    <input type="hidden" name="ipn_mode" value="hmac">    
    <input type="hidden" name="currency" value="USD">  
    <input type="hidden" name="currency1" value="USD">   
    <input type="hidden" id='item_name2' name="item_name" value="Test">
    <input type="hidden"  name="txn_id" value="txn<?php echo rand(); ?>">
    <input type="hidden" id='item_desc2' name="item_desc" value="Test Description">
    <input type="hidden" id='item_number2' name="item_number" value="1">
    <input type="hidden" id='custom2' name="custom" value="<?php echo $_SESSION['accounts_id']; ?>">
    <input type="hidden" id='invoice2' name="invoice" value="SF-<?php echo rand(); ?>">
    <input type="hidden" id='amountf2' name="amount1" value="1.00000000">
    <input type="hidden" name="want_shipping" value="0">
     <input type="hidden" name="status" value="100">
    <input type="hidden" name="success_url" value="<?php echo $url; ?>dashboard/index.php">
    <input type="hidden" name="cancel_url" value="<?php echo $url; ?>dashboard/index.php?pages=subscription">
    <input type="hidden" name="ipn_url" value="<?php echo $url; ?>dashboard/ipn.php">
    <input type="image" src="https://www.coinpayments.net/images/pub/buynow-wide-blue.png" alt="Buy Now with CoinPayments.net">
</form>
<?php } ?>
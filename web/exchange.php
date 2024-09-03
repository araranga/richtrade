<?php
session_start();
require_once("../connect.php");
require_once("../function.php");
?>
<!DOCTYPE html>
<html lang="en">
<?php include("inc/header.php"); ?>


<?php $cms = cmsdata(1); ?>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->

	
	
	<?php include("inc/menu.php"); ?>
    <!-- Navbar End -->











<!-- EXCHANGE -->

    <div class="container-xxl bg-light py-5 my-5">
        <div class="container py-5">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6">Exchange now!</h1>
                <p class="text-primary fs-5 mb-5">Please note that you need to create account to proceed in exchange.</p>
				<a href=''>Click here to register</a>
				<br/>
            </div>
			<?php
				$cryptodata = fetchCryptoData(50);

				$tether = getTetherRate();
				
			

				
				$final_rate = $tether['data']['priceUsd'];

				

	
			
			?>

<div class="table-wrapper richtrade-table-wrapper">
    <table class="fl-table richtrade-fl-table">
        <thead>
        <tr>
		    <th>Rank</th>
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
			<td><?php echo $d['rank']; ?></td>
            <td><?php echo $d['symbol']; ?></td>
            <td><?php echo $d['name']; ?></td>
            <td><?php echo $d['priceUsd']; ?></td>
            <td><?php echo $cryptofinal; ?></td>
			<td>
			<button data-price-usd='<?php echo $d['priceUsd']; ?>' 
			data-symbol='<?php echo $d['symbol']; ?>' 
			data-name='<?php echo $d['name']; ?>' 
			data-id='<?php echo $d['id']; ?>'
			onclick='openPopup(this)'>
			Exchange Now
			</button>
			</td>
        </tr>
		<?php  } ?>

        <tbody>
    </table>
</div>			
			
            </div>
        </div>
    </div>		

<!--  EXCHANGE END -->

<style>
  /* Styling for the overlay */
  .richtrade-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
    z-index: 1000; /* Ensure it's above everything else */
    justify-content: center;
    align-items: center;
    overflow: auto;
  }
  
  /* Styling for the popup content */
  .richtrade-popup {
    background-color: #fefefe;
    padding: 20px;
    border-radius: 8px;
    max-width: 80%;
    max-height: 80%;
    overflow: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  }
  

  .richtrade-table-wrapper {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch; /* For smooth scrolling on touch devices */
    margin: 0 auto;
  }

  .richtrade-fl-table {
    width: 100%;
    border-collapse: collapse;
  }

  .richtrade-fl-table th,
  .richtrade-fl-table td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
  }

  .richtrade-fl-table th {
    background-color: #f4f4f4;
  }

  @media (max-width: 600px) {
    .richtrade-fl-table th,
    .richtrade-fl-table td {
      display: block;
      width: 100%;
    }

    .richtrade-fl-table th {
      text-align: right;
    }

    .richtrade-fl-table td {
      text-align: right;
      position: relative;

      white-space: nowrap;
    }

    .richtrade-fl-table td::before {
      content: attr(data-label);
      position: absolute;
      left: 0;

      padding-left: 10px;
      font-weight: bold;
      white-space: nowrap;
      background: #f4f4f4;
      border-right: 1px solid #ddd;
    }
  }  
  
  .inputexchange{
	  
	  width:100%;
  }
  
  .exchangep{

    color: green;
    font-weight: 700;

	  
  }
</style>
<div id="overlay" class="richtrade-overlay">

  <!-- Popup content -->
  <div id="popup" class="richtrade-popup">
	<a onclick="closePopup()" href='javascript:void(0)' style='float:right;'>Close</a>
	<p></p>
    <h3>Exchange <span id='exchange-name'></span> to Tether(USDT)</h3>
    <div>
		<p class='exchangep'><span id='exchange-name2'></span> amount to Exchange:</p>
		<input onkeyup="computeexchange()" id='amounttoconv' type='text' class='inputexchange'>
	</div>
	<p></p>
     <div>
		<p class='exchangep'>Tether(USDT) amount to Receive:</p>
		<input id='amounttoconvtorecieve' type='text' readonly class='inputexchange'>
		<p>5% will deducted as processing fee amounting: <span id='deduct'></span></p>
	</div>   
	
	<input id='data-price-usd' type='hidden'>
	<input id='data-symbol' type='hidden'>
	<input id='data-id' type='hidden'>	
			<button onclick='processexhange()'>Process</button>
	
  </div>
  
</div>
<script>
//index.php?pages=exchangerequest&fromCrypto=BTC&cid=bitcoin

function processexhange() {
    var dataSymbol = jQuery('#data-symbol').val();
    var dataId = jQuery('#data-id').val();    
    var amountToConv = parseFloat(jQuery('#amounttoconv').val());

    if (amountToConv) {
        window.location = '/index.php?pages=exchangerequest&fromCrypto=' + dataSymbol + '&cid=' + dataId + '&amount=' + amountToConv;
    }
}


function computeexchange(){

            const input = document.getElementById('amounttoconv');
            let value = input.value;
			let valuemain = input.value;

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
	
			
			
	
	var btcRateUsd = parseFloat(jQuery('#data-price-usd').val());
	var usdtRateUsd = parseFloat("<?php echo $final_rate; ?>");
	var btcAmount = parseFloat(jQuery('#amounttoconv').val());
	
	var conv = convertBtcToUsdt(btcRateUsd, usdtRateUsd, btcAmount);
	
	console.log(conv);
	var deduct = conv * 0.05;
	jQuery('#amounttoconvtorecieve').val(conv);
	jQuery('#deduct').text(deduct);
	
}
  // Function to open the popup $tether['data']['rateUsd']
  function openPopup(aaa) {
	jQuery('#amounttoconv').val(0);
	jQuery('#amounttoconvtorecieve').val(0);
    document.getElementById('overlay').style.display = 'flex'; // Show the overlay
	
	jQuery('#exchange-name').text(jQuery(aaa).attr('data-name'));
	jQuery('#exchange-name2').text(jQuery(aaa).attr('data-name'));
	jQuery('#data-price-usd').val(jQuery(aaa).attr('data-price-usd'));
	jQuery('#data-symbol').val(jQuery(aaa).attr('data-symbol'));
	jQuery('#data-id').val(jQuery(aaa).attr('data-id'));
	
  }

  // Function to close the popup
  function closePopup() {
    document.getElementById('overlay').style.display = 'none'; // Hide the overlay
  }
  
	function convertBtcToUsdt(btcRateUsd, usdtRateUsd, btcAmount) {
		// Calculate the amount of USDT
		return (btcAmount * btcRateUsd) / usdtRateUsd;
	}  

</script>


<?php include("inc/footer.php"); ?>

</body>

</html>
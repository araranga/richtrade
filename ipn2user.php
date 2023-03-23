<?php  
	include("connect.php");
	include("function.php");
    // Fill these in with the information from your CoinPayments.net account.
    $cp_merchant_id = '';
    $cp_ipn_secret = '';
    $cp_debug_email = 'ardeenathanraranga@gmail.com';

    //These would normally be loaded from your database, the most common way is to pass the Order ID through the 'custom' POST field.
 echo "<pre>";
     //var_dump($_REQUEST);

$paymentsave = array();

    $rates = array();
    $rates['rate_name'] = "{$_POST['item_number']} Months Subscription";
    $rates['rate_start'] = $_POST['item_number'] * systemconfig("table_amount");
    $rates['rate_bonus'] = $_POST['item_number'];
    $owner = userdata($_POST['custom']);

    //var_dump($rates);


    $order_currency = 'USD';
    $order_total = $rates['rate_start'];



    $paymentsave['accounts_id'] = $_POST['custom'];
    $paymentsave['amount'] = $_POST['amount1'];
    $paymentsave['ptype'] = "subscription";
    $paymentsave['transnum'] = $_POST['txn_id'];
    $paymentsave['rate'] = $_POST['item_number'];
    $paymentsave['remarks'] = "Subscription Payment For: {$owner['username']} -- {$rates['rate_name']} - {$rates['rate_start']}";
    $paymentsave['inv'] = $_POST['invoice'];


   //var_dump($paymentsave);

  


if(empty($owner['deadline'])){


$date=date_create(date("Y-m-d"));
date_add($date,date_interval_create_from_date_string("{$rates['rate_bonus']} months"));
$fd = date_format($date,"Y-m-d h:i:s");
$deadline = $fd;


} else {


$today = date("Y-m-d h:i:s");
$expire = $owner['deadline']; //from database

$today_time = strtotime($today);
$expire_time = strtotime($expire);

if ($expire_time < $today_time) { 

$date=date_create(date("Y-m-d"));
date_add($date,date_interval_create_from_date_string("{$rates['rate_bonus']} months"));
$fd = date_format($date,"Y-m-d h:i:s");
$deadline = $fd;


}else{

$date=date_create($owner['deadline']);
date_add($date,date_interval_create_from_date_string("{$_POST['item_number']} months"));
$fd = date_format($date,"Y-m-d h:i:s");
$deadline = $fd;


}



}










    function errorAndDie($error_msg) {
        global $cp_debug_email;
        if (!empty($cp_debug_email)) {
            $report = 'Error: '.$error_msg."\n\n";
            $report .= "POST Data\n\n";
            foreach ($_POST as $k => $v) {
                $report .= "|$k| = |$v|\n";
            }
            mail($cp_debug_email, 'CoinPayments IPN Error', $report);
        }
        die('IPN Error: '.$error_msg);
    }


    if(empty($rates['rate_start'])){
        errorAndDie('Rate is empty');
    }

    if(empty($owner['accounts_id'])){
        errorAndDie('Owner is empty');
    }


    if (!isset($_POST['ipn_mode']) || $_POST['ipn_mode'] != 'hmac') {
        errorAndDie('IPN Mode is not HMAC');
    }

    if (!isset($_SERVER['HTTP_HMAC']) || empty($_SERVER['HTTP_HMAC'])) {
        //errorAndDie('No HMAC signature sent.');
    }

    $request = file_get_contents('php://input');
    if ($request === FALSE || empty($request)) {
        errorAndDie('Error reading POST data');
    }

    if (!isset($_POST['merchant']) || $_POST['merchant'] != trim($cp_merchant_id)) {
        //errorAndDie('No or incorrect Merchant ID passed');
    }

    // $hmac = hash_hmac("sha512", $request, trim($cp_ipn_secret));
    // if (!hash_equals($hmac, $_SERVER['HTTP_HMAC'])) {
    // //if ($hmac != $_SERVER['HTTP_HMAC']) { <-- Use this if you are running a version of PHP below 5.6.0 without the hash_equals function
    //    // errorAndDie('HMAC signature does not match');
    // }

    // HMAC Signature verified at this point, load some variables.

    $ipn_type = $_POST['ipn_type'];
    $txn_id = $_POST['txn_id'];
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $amount1 = floatval($_POST['amount1']);
    $amount2 = floatval($_POST['amount2']);
    $currency1 = $_POST['currency1'];
    $currency2 = $_POST['currency2'];
    $status = intval($_POST['status']);
    $status_text = $_POST['status_text'];

    if ($ipn_type != 'button') { // Advanced Button payment
        //die("IPN OK: Not a button payment");
    }

    //depending on the API of your system, you may want to check and see if the transaction ID $txn_id has already been handled before at this point

    // Check the original currency to make sure the buyer didn't change it.
    if ($currency1 != $order_currency) {
        errorAndDie('Original currency mismatch!');
    }

    // Check amount against order total
    if ($amount1 < $order_total) {
        errorAndDie('Amount is less than order total!');
    }
 
    if ($status >= 100 || $status == 2) {
        // payment is complete or queued for nightly payout, success
    } else if ($status < 0) {
        //payment error, this is usually final but payments will sometimes be reopened if there was no exchange rate conversion or with seller consent
    } else {
        //payment is pending, you can optionally add a note to the order page
    }



   

    $parents = array_reverse(explode("/",$owner['path']));
    unset($parents[0]);
    //var_dump($parents);
    $parent_limit = 1 + 9;


    foreach($parents as $pk=>$pv){
        if($pk==$parent_limit){
            break;
        }

        if($pv==0){
            break;
        }
        $bonussave = array();
        $bonus = userdata($pv);

        $bonussave['send'] = $owner['username'];
        $bonussave['receiver'] = $bonus['username'];

        $bonussave['sid'] = $owner['accounts_id'];
        $bonussave['rid'] = $bonus['accounts_id'];

        $bonussave['ptype'] = $paymentsave['ptype'];
        $bonussave['remarks'] = $bonus['username'];
        $bonussave['amount'] = $bonus['username'];


        //var_dump($bonus);


if(!empty($bonus['deadline'])){

            $today = date("Y-m-d h:i:s");
            $expire = $bonus['deadline']; //from database

            $today_time = strtotime($today);
            $expire_time = strtotime($expire);

            if ($expire_time < $today_time) { 

            }else{

                        $bonusrates = ratedata($bonus['rate']);

                        $percent = (systemconfig("table_percent") / 100) * $_POST['amount1'];
                        $bns = systemconfig("table_percent");

                        $end = number_format($_POST['amount1'],2);
                        $start = number_format($percent,2);
                        $bonussave['remarks'] = "Table Bonus: {$bns}%($start) of {$end} from {$owner['username']}";
                        $bonussave['amount'] = $percent;

                        $pquery = "INSERT INTO  tbl_bonus_history SET ".formquery($bonussave);
                        mysql_query_md($pquery);


            }

}




    }

$pquery = "INSERT INTO  tbl_payment_history SET ".formquery($paymentsave);
mysql_query_md($pquery);
mysql_query_md("UPDATE tbl_accounts SET deadline='{$deadline}' WHERE accounts_id='{$paymentsave['accounts_id']}'");
?>
<script>
    window.location = '<?php echo $_SERVER['HTTP_REFERER']; ?>&success=1';
</script>
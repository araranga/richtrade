<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$tbl = "tbl_members";
$primary = "id";
/*SQL*/
$refresh = 0;
if($_POST['submit']!=''){
	$_POST['stores'] = $_SESSION['stores'];

	var_dump($_POST);
}
if($_POST['submit']!='' && $_POST['task']=='add')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$_POST['createdby'] = $_SESSION['username'];
	$fields = formquery($_POST);

	echo "INSERT INTO $tbl SET $fields";

	exit();
	mysql_query_md("INSERT INTO $tbl SET $fields");
	#setcookie('noti', "Done adding data",60, "/");

	$_SESSION['noti'] = "Done adding data.";

	$refresh = 1;
}

if($_POST['submit']!='' && $_POST['task']=='edit')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$fields = formquery($_POST);
	mysql_query_md("UPDATE $tbl SET $fields WHERE $primary=".$_POST[$primary]);
	#setcookie('noti', "Done editing data",60, "/");
	$_SESSION['noti'] = "Done editing data.";
	$refresh = 1;
}


if($_POST['submit']!='' && $_POST['task']=='delete')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$fields = formquery($_POST);
	mysql_query_md("DELETE FROM $tbl WHERE $primary=".$_POST[$primary]);
	$_SESSION['noti'] = "Done deleting data.";
	$refresh = 1;
}






if($_POST['submit']!='' && $_POST['task']=='mutual-delete-delete')
{
	$tbl = "tbl_mutual";
	mysql_query_md("DELETE FROM $tbl WHERE $primary=".$_POST[$primary]);


	mysql_query_md("DELETE FROM tbl_schedule_mutual WHERE loan_id=".$_POST[$primary]);



	$_SESSION['noti'] = "Done deleting loan data.";
	$refresh = 1;
	moveredirect("index.php?id={$_POST['user']}&task=edit&pages=members");
	exit();
}

if($_POST['submit']!='' && $_POST['task']=='loan-delete-delete')
{
	$tbl = "tbl_loan";
	mysql_query_md("DELETE FROM $tbl WHERE $primary=".$_POST[$primary]);


	mysql_query_md("DELETE FROM tbl_schedule WHERE loan_id=".$_POST[$primary]);

	mysql_query_md("DELETE FROM tbl_expenses WHERE loan_id=".$_POST[$primary]);




	$_SESSION['noti'] = "Done deleting loan data.";
	$refresh = 1;
	moveredirect("index.php?id={$_POST['user']}&task=edit&pages=members");
	exit();
}

if($_POST['submit']!='' && $_POST['task']=='processsavings')
{

if($_REQUEST['ptype']!='savings'){


$with =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM tbl_passbook WHERE user='{$_REQUEST['id']}' AND ptype='withdraw'"));
$save =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM tbl_passbook WHERE user='{$_REQUEST['id']}' AND ptype='savings'"));

$w = $with['total'];
$s = $save['total'];
$total = $s - $w;


if($_REQUEST['amount']>$total){

	$_SESSION['noti'] = "Unable to process withdrawal. Amount is insufficient";
	moveredirect($_POST['refer'].'#tabs-3');
	exit();

}



}






	$tbl = "tbl_passbook";
	$sqli = mysql_query_md_insert("INSERT INTO $tbl SET createdby='{$_SESSION['username']}',actual='{$_REQUEST['actual']}',amount='{$_REQUEST['amount']}',remarks='{$_REQUEST['remarks_payment']}',ptype='{$_REQUEST['ptype']}',user='{$_REQUEST['id']}',stores='{$_SESSION['stores']}'");


	$user = mysql_fetch_md_array(mysql_query_md("SELECT name FROM tbl_members WHERE id='{$_REQUEST['id']}'"));
	$name = $user['name'];

	$current = date("Y-m-d");
	$amt = number_format($_POST['amount'],2);
	$remarks = "Withdrawal Release {$amt} for $name - $current";

	if($_REQUEST['ptype']!='savings'){

	mysql_query_md("INSERT INTO tbl_expenses SET amount='{$_REQUEST['amount']}',remarks='{$remarks}',passbook_id='{$sqli}',actual='{$current}',createdby='{$_SESSION['username']}',stores='{$_SESSION['stores']}'");

	}	



	$_SESSION['noti'] = "Done creating savings/withdrawal.";
	moveredirect($_POST['refer'].'#tabs-3');
	exit();


}


if($_POST['submit']!='' && $_POST['task']=='processsavings-edit')
{

	$tbl = "tbl_passbook";
	mysql_query_md("UPDATE $tbl SET createdby='{$_SESSION['username']}',actual='{$_REQUEST['actual-edit']}',amount='{$_REQUEST['amount-edit']}',remarks='{$_REQUEST['remarks_payment-edit']}',ptype='{$_REQUEST['ptype-edit']}' WHERE id='{$_REQUEST['editid']}'");



	$userp = mysql_fetch_md_array(mysql_query_md("SELECT user FROM tbl_passbook WHERE id='{$_REQUEST['editid']}'"));


	$user = mysql_fetch_md_array(mysql_query_md("SELECT name FROM tbl_members WHERE id='{$userp['user']}'"));
	$name = $user['name'];


	$current = date("Y-m-d");
	$amt = number_format($_POST['amount-edit'],2);
	$remarks = "Withdrawal Release {$amt} for $name - $current";
	mysql_query_md("DELETE FROM tbl_expenses WHERE passbook_id = '{$_REQUEST['editid']}'");
	
	if($_REQUEST['ptype-edit']!='savings'){
	
	mysql_query_md("DELETE FROM tbl_expenses WHERE passbook_id = '{$_REQUEST['editid']}'");

	mysql_query_md("INSERT INTO tbl_expenses SET amount='{$_REQUEST['amount-edit']}',remarks='{$remarks}',passbook_id='{$_REQUEST['editid']}',actual='{$current}',createdby='{$_SESSION['username']}',stores='{$_SESSION['stores']}'");


}





	$_SESSION['noti'] = "Done creating savings/withdrawal.";
	moveredirect($_POST['refer'].'#tabs-3');
	exit();


}


if($_POST['submit']!='' && $_POST['task']=='processpay')
{
	$tbl = "tbl_schedule";

	if(empty($_REQUEST['penalty_payment'])){
		$_REQUEST['penalty_payment'] = 0;
	}

   $query  = mysql_query_md("SELECT * FROM tbl_schedule WHERE id ='{$_REQUEST['schedule_id']}'");
   $row=mysql_fetch_md_assoc($query);

   if($row['is_paid']!='yes'){

   	$loan  = mysql_query_md("UPDATE tbl_loan SET loop_paid = loop_paid + 1 WHERE id = {$row['loan_id']}");

   }


   	if(!empty($_REQUEST['savings_payment'])){
   		mysql_query_md("DELETE FROM tbl_passbook WHERE schedule_id ='{$_REQUEST['schedule_id']}'");
   		mysql_query_md("INSERT INTO tbl_passbook SET amount='{$_REQUEST['savings_payment']}',actual='{$_REQUEST['date_payment']}',ptype='savings',schedule_id ='{$_REQUEST['schedule_id']}',remarks='{$_REQUEST['remarks_payment']}',user='{$row['user_id']}',createdby='{$_SESSION['username']}',stores='{$_SESSION['stores']}'");
	}






	mysql_query_md("UPDATE $tbl SET createdby='{$_SESSION['username']}',actual='{$_REQUEST['date_payment']}',savings='{$_REQUEST['savings_payment']}',penalty='{$_REQUEST['penalty_payment']}',remarks='{$_REQUEST['remarks_payment']}',is_paid='yes' WHERE id ='{$_REQUEST['schedule_id']}'");


	$_SESSION['noti'] = "Done marking the payment.";
	moveredirect($_POST['refer']."#loandataajax{$_REQUEST['schedule_id']}");
	exit();
}







if($_POST['submit']!='' && $_POST['task']=='processpaymutual')
{
	$tbl = "tbl_schedule_mutual";

	if(empty($_REQUEST['penalty_payment'])){
		$_REQUEST['penalty_payment'] = 0;
	}

   $query  = mysql_query_md("SELECT * FROM tbl_schedule WHERE id ='{$_REQUEST['schedule_id']}'");
   $row=mysql_fetch_md_assoc($query);

   if($row['is_paid']!='yes'){

   	$loan  = mysql_query_md("UPDATE tbl_mutual SET loop_paid = loop_paid + 1 WHERE id = {$row['loan_id']}");

   }
   $_REQUEST['savings_payment'] = 0;


	mysql_query_md("UPDATE $tbl SET createdby='{$_SESSION['username']}',actual='{$_REQUEST['date_payment']}',savings='{$_REQUEST['savings_payment']}',penalty='{$_REQUEST['penalty_payment']}',remarks='{$_REQUEST['remarks_payment']}',is_paid='yes' WHERE id ='{$_REQUEST['schedule_id']}'");


	$_SESSION['noti'] = "Done marking the payment.";
	moveredirect($_POST['refer']."#loandataajax{$_REQUEST['schedule_id']}");
	exit();
}












if($_POST['submit']!='' && $_POST['task']=='loan-save')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$tbl = "tbl_loan";
	$_POST['loan_date'] = $_POST['loan_date']." 00:00:00";
	$_POST['loan_start'] = $_POST['loan_start']." 00:00:00";

	$_POST['net'] = $_POST['amount'] + ($_POST['amount'] * percentget($_POST['interest']));


	if($_POST['payment_type']=='weekly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 4);
	}
	if($_POST['payment_type']=='monthly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 1);
	}
	if($_POST['payment_type']=='cutoff'){
		$_POST['loop_number'] =  ($_POST['terms'] * 2);
	}


	$_POST['penalty_fee'] = ($_POST['amount'] * percentget($_POST['penalty'])) / $_POST['loop_number'];

	$_POST['loop_amount'] = $_POST['net'] / $_POST['loop_number'];

	$_POST['interest_amount'] = ($_POST['amount'] * percentget($_POST['interest']));
	$_POST['createdby'] = $_SESSION['username'];
	$fields = formquery($_POST);
	
	$_SESSION['noti'] = "Done adding loan data.";
	$refresh = 1;
	$sqli = mysql_query_md_insert("INSERT INTO $tbl SET $fields");






	if($_POST['is_release']){


	$user = mysql_fetch_md_array(mysql_query_md("SELECT name FROM tbl_members WHERE id='{$_POST['user']}'"));
	$name = $user['name'];

	$current = date("Y-m-d");
	$amt = number_format($_POST['amount'],2);
	$remarks = "Loan Release {$amt} for $name - $current";



	mysql_query_md("INSERT INTO tbl_expenses SET amount='{$_REQUEST['amount']}',remarks='{$remarks}',loan_id='{$sqli}',actual='{$current}',createdby='{$_SESSION['username']}',stores='{$_SESSION['stores']}'");
	
	$date = generatedate($_POST);




	foreach($date as $s){

		$array = array();

		$array['schedule'] = $s;
		$array['payment'] = $_POST['loop_amount'];
		$array['user_id'] = $_POST['user'];
		$array['loan_id'] = $sqli;
		$array['stores'] = $_SESSION['stores'];
		$fieldsv2 = formquery($array);
		mysql_query_md("INSERT INTO tbl_schedule SET $fieldsv2");

	}




	}



	moveredirect("index.php?id={$sqli}&uid={$_POST['user']}&task=loan-edit&pages=".$_REQUEST['pages']);
	#moveredirect("index.php?id={$_POST['user']}&task=edit&pages=".$_REQUEST['pages']);





	exit();	
}

if($_POST['submit']!='' && $_POST['task']=='loan-edit-save')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$tbl = "tbl_loan";
	$_POST['loan_date'] = $_POST['loan_date']." 00:00:00";
	$_POST['loan_start'] = $_POST['loan_start']." 00:00:00";

	$_POST['net'] = $_POST['amount'] + ($_POST['amount'] * percentget($_POST['interest']));


	if($_POST['payment_type']=='weekly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 4);
	}
	if($_POST['payment_type']=='monthly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 1);
	}
	if($_POST['payment_type']=='cutoff'){
		$_POST['loop_number'] =  ($_POST['terms'] * 2);
	}


	$_POST['penalty_fee'] = ($_POST['amount'] * percentget($_POST['penalty'])) / $_POST['loop_number'];

	$_POST['loop_amount'] = $_POST['net'] / $_POST['loop_number'];

	$_POST['interest_amount'] = ($_POST['amount'] * percentget($_POST['interest']));
	$fields = formquery($_POST);
	$_SESSION['noti'] = "Done adding loan data.";
	$refresh = 1;







	if($_POST['is_release']){


	$user = mysql_fetch_md_array(mysql_query_md("SELECT name FROM tbl_members WHERE id='{$_POST['user']}'"));
	$name = $user['name'];

	$current = date("Y-m-d");
	$amt = number_format($_POST['amount'],2);
	$remarks = "Loan Release {$amt} for $name - $current";

	
	mysql_query_md("INSERT INTO tbl_expenses SET amount='{$_REQUEST['amount']}',remarks='{$remarks}',loan_id='{$_POST['id']}',actual='{$current}',createdby='{$_SESSION['username']}',stores='{$_SESSION['stores']}'");



	$date = generatedate($_POST);


	

	foreach($date as $s){

		$array = array();

		$array['schedule'] = $s;
		$array['payment'] = $_POST['loop_amount'];
		$array['user_id'] = $_POST['user'];
		$array['loan_id'] = $_POST['id'];
		$array['stores'] = $_SESSION['stores'];
		$fieldsv2 = formquery($array);
		mysql_query_md("INSERT INTO tbl_schedule SET $fieldsv2");

	}




	}









	mysql_query_md("UPDATE $tbl SET $fields WHERE $primary=".$_POST[$primary]);
	moveredirect("index.php?id={$_POST['id']}&uid={$_POST['user']}&task=loan-edit&pages=".$_REQUEST['pages']);
	exit();	
}









if($_POST['submit']!='' && $_POST['task']=='mutual-save')
{
	unset($_POST['submit']);
	unset($_POST['task']);
	$tbl = "tbl_mutual";
	#$_POST['loan_date'] = $_POST['loan_date']." 00:00:00";
	$_POST['loan_start'] = $_POST['loan_start']." 00:00:00";

	$_POST['net'] = $_POST['amount'] + ($_POST['amount'] * percentget($_POST['interest']));
	if($_POST['payment_type']=='weekly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 4);
	}
	if($_POST['payment_type']=='monthly'){
		$_POST['loop_number'] =  ($_POST['terms'] * 1);
	}
	if($_POST['payment_type']=='cutoff'){
		$_POST['loop_number'] =  ($_POST['terms'] * 2);
	}


	$_POST['net'] = $_POST['amount'] * $_POST['loop_number'];

	$_POST['penalty_fee'] = 0;
	$_POST['penalty'] = 0;

	$_POST['loop_amount'] = $_POST['amount'];

	$_POST['interest_amount'] = $_POST['amount'];
	
	$fields = formquery($_POST);
	$_POST['createdby'] = $_SESSION['username'];
	$_SESSION['noti'] = "Done adding life insurance data.";
	$refresh = 1;
	$sqli = mysql_query_md_insert("INSERT INTO $tbl SET $fields");





	if($_POST['is_release']){


	$user = mysql_fetch_md_array(mysql_query_md("SELECT name FROM tbl_members WHERE id='{$_POST['user']}'"));
	$name = $user['name'];

	$current = date("Y-m-d");
	$amt = number_format($_POST['amount'],2);
	$remarks = "Loan Release {$amt} for $name - $current";
	$date = generatedate($_POST);
	foreach($date as $s){

		$array = array();

		$array['schedule'] = $s;
		$array['payment'] = $_POST['loop_amount'];
		$array['user_id'] = $_POST['user'];
		$array['loan_id'] = $sqli;
		$array['stores'] = $_SESSION['stores'];
		$fieldsv2 = formquery($array);
		mysql_query_md("INSERT INTO tbl_schedule_mutual SET $fieldsv2");

	}




	}



	moveredirect("index.php?id={$sqli}&uid={$_POST['user']}&task=mutual-edit&pages=".$_REQUEST['pages']);
	#moveredirect("index.php?id={$_POST['user']}&task=edit&pages=".$_REQUEST['pages']);





	exit();	
}













/*SQL*/
if($refresh){
moveredirect("index.php?pages=".$_REQUEST['pages']);
exit();	
}

if($_SESSION['role']!=1)
{
	#	exit("hey your not allowed here");
}
if($_GET['task']=='')
{
	
	include($_GET['pages']."/main.php");
}
if($_GET['task']=='add')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/add.php");
}
if($_GET['task']=='edit')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/edit.php");
}
if($_GET['task']=='delete')
{
	echo "<a href='?pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/delete.php");
}


if($_GET['task']=='loan')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/loan.php");
}
if($_GET['task']=='loan-edit')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/loan-edit.php");
}
if($_GET['task']=='loan-delete')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/loan-delete.php");
}





if($_GET['task']=='mutual')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/mutual.php");
}

if($_GET['task']=='mutual-edit')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/mutual-edit.php");
}
if($_GET['task']=='mutual-delete')
{
	echo "<a href='?id={$_GET['uid']}&task=edit&pages=".$_GET['pages']."'>Go back</a>";
	include($_GET['pages']."/mutual-delete.php");
}

?>

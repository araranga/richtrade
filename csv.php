<?php
include("connect.php");
include("function.php");

	header('Content-Type: text/csv; charset=utf-8');

		header('Content-Disposition: attachment; filename=payout-'.$_GET['r']."-".rand().'.csv');

		// create a file pointer connected to the output stream

		$output = fopen('php://output', 'w');



		$rows = mysql_query_md("SELECT transnum,amount,address,b.username FROM  tbl_withdraw_history as a JOIN tbl_accounts as b WHERE claim_status=0 AND a.accounts_id=b.accounts_id AND claimtype='".$_GET['r']."'
		");

		$array = explode(",","transnum,amount,address,username");	






		fputcsv($output,$array);

		// loop over the rows, outputting them

		while ($row = mysql_fetch_md_assoc($rows)) 

		{

		foreach($row as $key=>$val)

		{

		$row[$key] = "\"".$val."\"";

		}

		fputcsv($output, $row);

		}
?>
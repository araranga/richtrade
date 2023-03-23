<?php
if(!empty($_GET['uid'])){
   $primary = "id";
   $pid = $_GET['uid'];
   $tbl = "tbl_members";
   $query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
   while($row=mysql_fetch_md_assoc($query))
   {
      foreach($row as $key=>$val)
      {
          $sdata[$key] = $val;
      }
   }

}


for($i=1;$i<=24;$i++){
   if($i==1){
      $terms[$i] = "$i month";
   }else{
      $terms[$i] = "$i months";
   }
   
}

$ptype = array();

$ptype['monthly'] = "Monthly";
$ptype['weekly'] = "Weekly";
$ptype['cutoff'] = "Cutoff (every 15th and end of month)";




$week = array();

$week['monday'] = "Monday";
$week['tuesday'] = "Tuesday";
$week['wednesday'] = "Wednesday";
$week['thursday'] = "Thursday";
$week['friday'] = "Friday";
$week['saturday'] = "Saturday";
$week['sunday'] = "Sunday";


$release = array();
$release['0'] = "No";
$release['1'] = "Yes";



$field[] = array("type"=>"select","value"=>"loandesc","label"=>"Loan Class","option"=>getarrayconfig('loanclass'));
$field[] = array("type"=>"select","value"=>"loan_type","option"=>array("Collateral"=>"Collateral","Not Collateral"=>"Not Collateral"),"label"=>"Type of Loan");
$field[] = array("type"=>"number","value"=>"amount","attributes"=>array("onkeyup"=>"autogenloan()"));
$field[] = array("type"=>"number","value"=>"interest","label"=>"Interest (%)","attributes"=>array("onkeyup"=>"autogenloan()"));
$field[] = array("type"=>"number","value"=>"interest_amount","label"=>"Interest Amount","attributes"=>array("readonly"=>"readonly"));
$field[] = array("type"=>"number","value"=>"net","label"=>"Net Amount","attributes"=>array("readonly"=>"readonly"));
$field[] = array("type"=>"number","value"=>"penalty","label"=>"Penalty Rate (%)");
$field[] = array("type"=>"select","value"=>"terms","label"=>"Number of Months","option"=>getarrayconfig('loanterms'),"attributes"=>array("onchange"=>"autogenloan()"));

$field[] = array("type"=>"select","value"=>"payment_type","label"=>"Payment Type","option"=>$ptype);
$field[] = array("type"=>"select","value"=>"helper","label"=>"What days of week(for weekly payment)","option"=>$week);
$field[] = array("type"=>"number","value"=>"weeklyamount","label"=>"Amortization Amount");
$field[] = array("type"=>"date","value"=>"loan_date","label"=>"Loan Date");
$field[] = array("type"=>"date","value"=>"loan_start","label"=>"Payment Start Date");
$field[] = array("type"=>"text","value"=>"remarks");
$field[] = array("type"=>"select","value"=>"is_release","label"=>"Loan Is Released?","option"=>$release);


$field[] = array("skip"=>"text","label"=>"CO MAKER 1");
$field[] = array("type"=>"text","value"=>"name1","label"=>"Name");
$field[] = array("type"=>"text","value"=>"occupation1","label"=>"Occupation");
$field[] = array("type"=>"text","value"=>"address1","label"=>"Address");
$field[] = array("type"=>"text","value"=>"contact1","label"=>"Contact Number");

$field[] = array("skip"=>"text","label"=>"CO MAKER 2");
$field[] = array("type"=>"text","value"=>"name2","label"=>"Name");
$field[] = array("type"=>"text","value"=>"occupation2","label"=>"Occupation");
$field[] = array("type"=>"text","value"=>"address2","label"=>"Address");
$field[] = array("type"=>"text","value"=>"contact2","label"=>"Contact Number");

?>
<h2>Add Loan - <?php echo  $sdata['name']; ?></h2>
<p>Warning: If you click the Loan is release to "Yes" you will not able to change anything and it will create a autommated scheduled payment</p>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>-save'>
      <input type='hidden' name='user' value='<?php echo $_GET['uid'];?>'>
            <?php echo loadform($field,$sdata); ?>

         <hr>

         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 
<style>
   input[type="number"],input[type="date"],input[type="text"] ,select{
      width:230px;
      height: 30px;
   }
   tr.members-loan-helper {
    display: none;
}
</style>

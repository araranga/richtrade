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

   $query  = mysql_query_md("SELECT * FROM tbl_mutual WHERE $primary='{$_GET['id']}'");
   while($row=mysql_fetch_md_assoc($query))
   {
      foreach($row as $key=>$val)
      {
          $sdata[$key] = str_replace("00:00:00","",$val);
      }
   }



   if($sdata['loan_date']){
      $sdata['loan_date'] = formatedateinput($sdata['loan_date']);
   }
   if($sdata['loan_start']){
      $sdata['loan_start'] = formatedateinput($sdata['loan_start']);
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

$field[] = array("type"=>"number","value"=>"amount","label"=>"Premium Account (amount)");
$field[] = array("type"=>"select","value"=>"terms","label"=>"Number of Months","option"=>getarrayconfig('mutualterms'));
$field[] = array("type"=>"select","value"=>"payment_type","label"=>"Payment Type","option"=>$ptype);
$field[] = array("type"=>"select","value"=>"helper","label"=>"What days of week(for weekly payment)","option"=>$week);
$field[] = array("type"=>"date","value"=>"loan_start","label"=>"Payment Start Date");
$field[] = array("type"=>"text","value"=>"remarks");


$show = 1;
if($sdata['is_release']){
   $show = 0;
   $sdata['is_release'] = "Yes";
}

$show = 0;
?>
<h2>Delete Mutual Fund - <?php echo  $sdata['name']; ?></h2>

<?php
if($show) {
?>
<p>Warning: If you click the Loan is release to "Yes" you will not able to change anything and it will create a autommated scheduled payment</p>
<?php } ?>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>-delete'>
      <input type='hidden' name='user' value='<?php echo $_GET['uid'];?>'>
      <input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
         
         <?php echo loadform($field,$sdata,$show); ?>

         <hr>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Delete Loan'></center>
      </form>
   </div>
</div> 



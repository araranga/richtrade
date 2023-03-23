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

   $query  = mysql_query_md("SELECT * FROM tbl_loan WHERE $primary='{$_GET['id']}'");
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


$field[] = array("type"=>"select","value"=>"loandesc","label"=>"Loan Class","option"=>getarrayconfig('loanclass'));
$field[] = array("type"=>"select","value"=>"loan_type","option"=>array("Collateral"=>"Collateral","Not Collateral"=>"Not Collateral"),"label"=>"Type of Loan");
$field[] = array("type"=>"number","value"=>"amount","attributes"=>array("onkeyup"=>"autogenloan()"));
$field[] = array("type"=>"number","value"=>"interest","label"=>"Interest (%)","attributes"=>array("onkeyup"=>"autogenloan()"));
$field[] = array("type"=>"number","value"=>"interest_amount","label"=>"Interest Amount","attributes"=>array("readonly"=>"readonly"));
$field[] = array("type"=>"number","value"=>"net","label"=>"Net Amount","attributes"=>array("readonly"=>"readonly"));
$field[] = array("type"=>"number","value"=>"penalty","label"=>"Penalty Rate (%)");
$field[] = array("type"=>"select","value"=>"terms","label"=>"Number of Months","option"=>getarrayconfig('loanterms'),"attributes"=>array("onchange"=>"autogenloan()"));

$field[] = array("type"=>"select","value"=>"payment_type","label"=>"Payment Type","option"=>$ptype,"attributes"=>array("onchange"=>"autogenloan()"));
$field[] = array("type"=>"select","value"=>"helper","label"=>"What days of week(for weekly payment)","option"=>$week);
$field[] = array("type"=>"number","value"=>"weeklyamount","label"=>"Amortization Amount");
$field[] = array("type"=>"date","value"=>"loan_date","label"=>"Loan Date");
$field[] = array("type"=>"date","value"=>"loan_start","label"=>"Payment Start Date");
$field[] = array("type"=>"text","value"=>"remarks");
$field[] = array("type"=>"select","value"=>"is_release","label"=>"Loan Is Released?","option"=>$release);

$fielda = $field;

$field = array();

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


$show = 1;
if($sdata['is_release']){
   $show = 0;
   $sdata['is_release'] = "Yes";
}
?>
<h2>Edit Loan - <?php echo  $sdata['name']; ?></h2>

<?php
if($show) {
?>
<p>Warning: If you click the Loan is release to "Yes" you will not able to change anything and it will create a autommated scheduled payment</p>
<?php } ?>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>-save'>
      <input type='hidden' name='user' value='<?php echo $_GET['uid'];?>'>
      <input type='hidden' name='id' value='<?php echo $_GET['id'];?>'>
         
         <table style='width: 1000px;'>
           <tr>
            <td><?php echo loadform($fielda,$sdata,$show); ?></td>
            <td><?php echo loadform($field,$sdata,$show); ?></td>
          </tr>
       </table>

         <hr>
         <?php
            if($show) {
         ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Edit Loan'></center>
         <?php } ?>
      </form>
   </div>
</div> 

 <button id='createpayment2' type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2">Create Custom Payment</button>
 <br/><br/>





<style>
.overdue {
  background-color: #efa3a3!important;
}
</style>


         <?php
            if(!$show) {

 $query = "SELECT * FROM tbl_schedule WHERE loan_id='{$_GET['id']}' ORDER by schedule ASC";

 $q = mysql_query_md($query);

         ?>
<div class="panel panel-default">
   <div class="panel-body">
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>
               <tr role='row'>
                  
                  <th>Schedule Date</th>
                  <th>Amount</th>
                  <th>Savings</th>
                  <th>Penalty</th>
                  <th>Actual Date</th>
                  <th>Total</th>
                  <th>Remarks</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody class='loaneditbody'>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid = $row['accounts_id'];
                    $roledata = ($row['role'] >= 1 ? 'Administrator' : 'Teller');

                    $actual = date("F d,Y",strtotime($row['actual']));
                    $schedule = date("F d, Y",strtotime($row['schedule']));

                    if(empty($row['actual'])){
                     $actual = " - ";
                    }

                    $total = number_format($row['payment'] + $row['savings'] + $row['penalty'],2);


                    $json_loan = array();

                    $row['schedule'] = $schedule;

                    foreach($row as $kd=>$vd){
                     $vd = addslashes($vd);
                     $json_loan[] = "tableloandata-{$kd}='$vd'";
                    }

                    $overdue = 0;

                    if(strtotime($row['schedule']) <= strtotime(date("Y-m-d")) && $row['is_paid']!='yes'){

                        $overdue = 1;

                    }
                  ?>
               <tr class='<?php if($overdue) { echo "overdue"; } ?>' id='loandataajax<?php echo $row['id']; ?>' <?php echo implode(" ",$json_loan); ?>>
                  <td><?php echo $schedule; ?></td>
                  <td><?php echo number_format($row['payment'],2); ?></td>
                  <td><?php echo number_format($row['savings'],2); ?></td>
                  <td><?php echo number_format($row['penalty'],2); ?></td>
                  <td><?php echo $actual; ?></td>
                  <td><?php echo $total; ?></td>
                  <td><?php echo $row['remarks']; ?></td>                                   
                  <td>
                    <?php if($row['is_paid']=='no') { ?>
                     <input onclick="createpayment(<?php echo $row['id']; ?>);" type="button" class="btn btn-primary btn-sm" style='width: 111px;' value="Create Payment">
                    <?php }  
                    else 
                    { 
                      echo "Paid -- <strong>Encoded by: {$row['createdby']}</strong><div class='spacerdata'></div>"; 
                      if($_SESSION['role']==1){
                      ?>
                          <input onclick="createpayment(<?php echo $row['id']; ?>);" type="button" class="btn btn-primary btn-sm" style='width: 111px;' value="Edit Payment">
                      <?php
                      }
                    }
                    ?>
                  </td>
               </tr>
               <?php
                  }
                  ?>
            </tbody>
         </table>
      </div>
   </div>
</div> 
         <?php } ?>



<script>
   function createpayment(data){
      
      jQuery('#schedule_paymenthead').text('Create Payment for');
      var ajax = jQuery('#loandataajax'+data);
      jQuery('#schedule_payment').text(ajax.attr('tableloandata-schedule'));
      jQuery('#amount_payment').val(ajax.attr('tableloandata-payment'));
      jQuery('#date_payment').val("<?php echo date("Y-m-d"); ?>");
      jQuery('#createpayment').trigger('click');
       jQuery('#schedule_id').val(ajax.attr('tableloandata-id'));
       jQuery('#savings_payment').val(ajax.attr('tableloandata-savings'));
       jQuery('#penalty_payment').val(ajax.attr('tableloandata-penalty'));
       
       if(ajax.attr('tableloandata-is_custom')==1){
        jQuery('#deleted').show();
       }else{
        jQuery('#deleted').hide();
       }
       
   }


   function processpay(){





   }
</script>

 <button id='createpayment' type="button" style="display:none;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><span id='schedule_paymenthead'></span> <span id='schedule_payment'></span></h4>
        </div>
        <div class="modal-body">
          <form id='createpaymentform' method="POST" action="?pages=<?php echo $_GET['pages'];?>">
         <input type='hidden' name="schedule_id" id="schedule_id">
         <input type='hidden' name="task" value="processpay">
         <input type='hidden' name="refer" value="index.php?pages=<?php echo $_GET['pages']; ?>&task=<?php echo $_GET['task']; ?>&id=<?php echo $_GET['id']; ?>&uid=<?php echo $_GET['uid']; ?>">
         <?php
            $payment = array();
            $payment[] = array("type"=>"date","value"=>"date_payment","label"=>"Actual Payment Date");
            $payment[] = array("type"=>"number","value"=>"amount_payment","label"=>"Amount","attributes"=>array("readonly"=>"readonly"));
            $payment[] = array("type"=>"number","value"=>"savings_payment","label"=>"Savings");

            $penalty_type = "hidden";

            if($_SESSION['role']==1) {
              $penalty_type = "number";
              $payment[] = array("type"=>$penalty_type,"value"=>"penalty_payment","label"=>"Penalty");


            }




            $payment[] = array("type"=>"textarea","value"=>"remarks_payment","label"=>"Remarks");
         ?>
         <?php echo loadform($payment,$sdata); ?>
       
        </div>
        <div class="modal-footer">
         <input class='btn btn-default' type='submit' name='submit' value='Mark as Paid'>
         <?php if($_SESSION['role']==1) { ?>
         <input id='deleted' class='btn btn-default' type='submit' name='submit' value='Delete'>
         <?php } ?>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      </form>
    </div>



  </div>



  <!-- Modal -->
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Create Custom Payment</h4>
        </div>
        <div class="modal-body">
          <form id='createpaymentform' method="POST" action="?pages=<?php echo $_GET['pages'];?>">
         <input type='hidden' name="schedule_id" id="schedule_id">
         <input type='hidden' name="user_id" value="<?php echo $_GET['uid']; ?>">
         <input type='hidden' name="loan_id" value="<?php echo $_GET['id']; ?>">
         <input type='hidden' name="task" value="processpaycustom">
         <input type='hidden' name="refer" value="index.php?pages=<?php echo $_GET['pages']; ?>&task=<?php echo $_GET['task']; ?>&id=<?php echo $_GET['id']; ?>&uid=<?php echo $_GET['uid']; ?>">
         <?php
            $payment = array();
            $payment[] = array("type"=>"date","value"=>"date_payment","label"=>"Actual Payment Date");
            $payment[] = array("type"=>"number","value"=>"amount_payment","label"=>"Amount");
            $payment[] = array("type"=>"number","value"=>"savings_payment","label"=>"Savings");

            $penalty_type = "hidden";

            if($_SESSION['role']==1) {
              $penalty_type = "number";
              $payment[] = array("type"=>$penalty_type,"value"=>"penalty_payment","label"=>"Penalty");


            }




            $payment[] = array("type"=>"textarea","value"=>"remarks_payment","label"=>"Remarks");
         ?>
         <?php echo loadform($payment,$sdata); ?>
       
        </div>
        <div class="modal-footer">
         <input class='btn btn-default' type='submit' name='submit' value='Mark as Paid'>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      </form>
    </div>



  </div>



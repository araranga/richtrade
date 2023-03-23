<?php
 $total = countquery("SELECT id FROM tbl_passbook WHERE user='{$_REQUEST['id']}' ORDER by actual DESC");
 $limit = getlimit(100,$_GET['p']);
 $query = "SELECT * FROM tbl_passbook WHERE user='{$_REQUEST['id']}' ORDER by actual DESC $limit";
 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,100);



$with =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM tbl_passbook WHERE user='{$_REQUEST['id']}' AND ptype='withdraw'"));
$save =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM tbl_passbook WHERE user='{$_REQUEST['id']}' AND ptype='savings'"));



?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}
</style>




<div class="panel panel-default">
   <div class="panel-body"> 

        <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                      Remaining Balance: <?php echo number_format($save['total'] - $with['total'],2); ?>
                  </div>
               </div>
            </div>           
         </div>

              
            <button id='createpayment1' onclick="addsw('Add Savings','savings')" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Savings</button>
            <button id='createpayment2' onclick="addsw('Add Withdraw','withdraw')"  type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Withdraw</button>



    
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
                  <th>Date</th>
                  <th>Savings</th>
                  <th>Dividend</th>
                  <th>Withdraw</th>
                  <th>Running Balance</th>
                  <th>Remarks</th>
                  <th>C/O</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $balance = 0;
                  while($row=mysql_fetch_md_array($q))
                  {
                    $withdraw = 0;
                    $save = 0;
                    $dividend = 0;
                    if($row['ptype']=='savings'){
                        $save = $row['amount'];
                        $balance = $balance + $row['amount'];
                    }

                    else if($row['ptype']=='dividend'){

                        $dividend = $row['amount'];
                        $balance = $balance + $row['amount'];
                    }

                    else{
                       $withdraw = $row['amount'];
                       $balance = $balance - $row['amount'];
                    }
                    $pid = $row['id'];
                    $interest_amount = ($row['amount'] * percentget($row['interest']));


$sub1 =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM tbl_passbook WHERE user='{$_REQUEST['id']}' AND ptype='withdraw' AND actual <= '{$row['actual']}'"));
$add1 =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM tbl_passbook WHERE user='{$_REQUEST['id']}' AND ptype='savings' AND actual <= '{$row['actual']}'"));
$add2 =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM tbl_passbook WHERE user='{$_REQUEST['id']}' AND ptype='dividend' AND actual <= '{$row['actual']}'"));

$adddata1 = $add1['total'];
$adddata2 = $add2['total'];
$adddata3 = $sub1['total'];



$running = ($adddata1 + $adddata2) - $adddata3;


                  ?>
               <tr>
                  <td><?php echo date("m-d-Y",strtotime($row['actual'])); ?></td>
                  <td><?php echo number_format($save,2); ?></td>
                  <td><?php echo number_format($dividend,2); ?></td>
                  <td><?php echo number_format($withdraw,2); ?></td>
                  <td><?php echo number_format($running,2); ?></td>
                  <td><?php echo $row['remarks']; ?></td>
                  <td><?php echo $row['createdby']; ?></td>
                  <td>
                    <?php
                        $ajax = array();
                        $row['actual'] = date("Y-m-d",strtotime($row['actual']))."T".date("H:i",strtotime($row['actual']));
                        $row['actualv2'] = date("Y-m-d h:i A",strtotime($row['actual']));
                        foreach($row as $k=>$v){
                          $ajax[] = "data-{$k}='$v'";
                        }
                    ?>
                     <input <?php echo implode(" ", $ajax); ?> onclick="editpass(this)" type="button" class="btn btn-primary btn-sm" value="Edit">
                     <?php  if($_SESSION['role']==1) { ?>
<!--                      <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=loan-delete&id=$pid&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="Delete"> -->
                     <?php } ?>
                  </td>
               </tr>
               <?php
                  }
                  ?>
            </tbody>
         </table>
      </div>
<div class="row">
               <div class="col-sm-6">
                  <div class="dataTables_paginate paging_simple_numbers">
                     <ul class="pagination">
                      <?php
                        for($c=1;$c<=$pagecount;$c++)
                        {
                          $active = '';

                          if($_GET['p']=='' && $c==1)
                          {
                            $active = 'active';
                          }
                          if($c==$_GET['p'])
                          {
                            $active = 'active';
                          }
                          $url = "?&id={$_GET['id']}&task=edit&search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&p=".$c."#tabs-3";
                      ?>
                        <li class="paginate_button <?php echo $active; ?>" aria-controls="dataTables-example" tabindex="0"><a href="<?php echo $url; ?>"><?php echo $c; ?></a></li>
                      <?php
                        }
                      ?>
                     </ul>
                  </div>
               </div>
            </div> 



            <button id='createpayment3' style='display:none;' type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalEdit">Add Withdraw</button>
   </div>

</div>

  <script type="text/javascript">
        function addsw(label,type){

            jQuery('#addheadings').text(label);
            jQuery('#ptype').val(type);

        }

        function editpass(data)
        {
          var json = jQuery(data);
          jQuery('#createpayment3').trigger('click');
          jQuery('#addheadings2').text('Update entry - '+json.attr('data-actualv2'));

          jQuery('#actual-edit').val(json.attr('data-actual'));
          jQuery('#amount-edit').val(json.attr('data-amount'));
          jQuery('#ptype-edit').val(json.attr('data-ptype')).trigger('click');
          jQuery('#remarks_payment-edit').val(json.attr('data-remarks'));
          jQuery('#editid').val(json.attr('data-id'));
          //alert(jQuery(data).attr('data-id'));
        }

        
  </script>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id='addheadings' class="modal-title">Add Savings / Withdrawal</h4>
        </div>
        <div class="modal-body">
          <form id='createpaymentform' method="POST" action="?pages=<?php echo $_GET['pages'];?>">
         <input type='hidden' name="task" value="processsavings">
         <input type='hidden' name="id" value="<?php echo $_GET['id']; ?>">
         <input type='hidden' id='ptype' name="ptype" value="savings">
         <input type='hidden' name="refer" value="index.php?pages=<?php echo $_GET['pages']; ?>&task=<?php echo $_GET['task']; ?>&id=<?php echo $_GET['id']; ?>">
         <?php
            $payment = array();
            $payment[] = array("type"=>"datetime-local","value"=>"actual","label"=>"Date");
            $payment[] = array("type"=>"number","value"=>"amount","label"=>"Amount");
           #$payment[] = array("type"=>"select","value"=>"ptype","label"=>"Add Type","option"=>array("withdrawal"=>"Withdraw","savings"=>"Savings"));
            $payment[] = array("type"=>"textarea","value"=>"remarks_payment","label"=>"Remarks");
         ?>
         <?php echo loadform($payment,$sdata); ?>
       
        </div>
        <div class="modal-footer">
         <input class='btn btn-default' type='submit' name='submit' value='Mark as Paid'>
         <?php  if($_SESSION['role']==1) { ?>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         <?php } ?>
        </div>
      </div>
      </form>
    </div>
  </div>






    <!-- Modal -->
  <div class="modal fade" id="myModalEdit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 id='addheadings2' class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <form id='createpaymentform' method="POST" action="?pages=<?php echo $_GET['pages'];?>">
         <input type='hidden' name="task" value="processsavings-edit">
         <input type='hidden' id='editid' name="editid">
         <input type='hidden' name="refer" value="index.php?pages=<?php echo $_GET['pages']; ?>&task=<?php echo $_GET['task']; ?>&id=<?php echo $_GET['id']; ?>">
         <?php
            $payment = array();
            $payment[] = array("type"=>"datetime-local","value"=>"actual-edit","label"=>"Date");
            $payment[] = array("type"=>"number","value"=>"amount-edit","label"=>"Amount");
            $payment[] = array("type"=>"select","value"=>"ptype-edit","label"=>"Add Type","option"=>array("withdraw"=>"Withdraw","savings"=>"Savings"));
            $payment[] = array("type"=>"textarea","value"=>"remarks_payment-edit","label"=>"Remarks");
         ?>
         <?php echo loadform($payment,$sdata); ?>
       
        </div>
        <div class="modal-footer">
         <input class='btn btn-default' type='submit' name='submit' value='Save'>
         <?php if($_SESSION['role']==1) { ?>
         <input class='btn btn-default' type='submit' name='submit' value='Delete'>
         <?php } ?>
         <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      </form>
    </div>
  </div>
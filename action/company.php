<?php
session_start();
require_once("./connect.php");
require_once("./function.php");

?>
<?php
 #echo "<a href='?pages=".$_GET['pages']."&task=jlcdaily'>Go back</a>";
 #q = mysql_query_md($query);
 $pagecount = getpagecount($total,100000);

$data_loan =mysql_fetch_md_array(mysql_query_md("SELECT SUM(payment + penalty) as total FROM `tbl_schedule` WHERE is_paid = 'yes' AND  stores = '{$_SESSION['stores']}'"));

$data_mutual =mysql_fetch_md_array(mysql_query_md("SELECT SUM(payment + penalty) as total FROM `tbl_schedule_mutual` WHERE is_paid = 'yes' AND  stores = '{$_SESSION['stores']}'"));

$data_savings =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM `tbl_passbook` WHERE ptype='savings' AND  stores = '{$_SESSION['stores']}'"));

$data_withdraw =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM `tbl_passbook` WHERE ptype='withdraw' AND  stores = '{$_SESSION['stores']}'"));

$data_releases =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM `tbl_loan` WHERE is_release = 1 AND  stores = '{$_SESSION['stores']}'"));

$data_expenses =mysql_fetch_md_array(mysql_query_md("SELECT SUM(amount) as total FROM `tbl_expenses` WHERE loan_id IS NULL AND passbook_id IS NULL AND  stores = '{$_SESSION['stores']}'"));


$unpaid = mysql_fetch_md_array(mysql_query_md("SELECT SUM(payment) as total FROM `tbl_schedule` WHERE is_paid!='yes' AND  stores = '{$_SESSION['stores']}'"));
$unpaid_mutual =mysql_fetch_md_array(mysql_query_md("SELECT SUM(payment) as total FROM `tbl_schedule_mutual` WHERE is_paid!='yes' AND  stores = '{$_SESSION['stores']}'"));




$added = array($data_loan['total'],$data_mutual['total'],$data_savings['total']);
$deduct = array($data_withdraw['total'],$data_releases['total'],$data_expenses['total']);



$total = array_sum($added);
$totaldeduct = array_sum($deduct);
?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}
</style>

<h2>Company Health</h2>  
<p class='headerprint' style='display:none;'>Daily Collection Record for - <?php echo $_GET['date1']; ?></p>
<div class="panel panel-default">
   <div class="panel-body">  
      <div class="table-responsive">

         
         <br/>
         <table border='1' class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>
               <tr role='row'>
                  <th>Collection Details</th>
                  <th>Amount</th>  
               </tr>
            </thead>
            <tbody>
                <tr>
                  <td style='width: 50%;'>Loan Collection</td>
                  <td><?php echo number_format($data_loan['total'],2); ?></td>
                </tr>

                <tr>
                  <td>Mutual Fund Collection</td>
                  <td><?php echo number_format($data_mutual['total'],2); ?></td>
                </tr>

                <tr>
                  <td>Savings from Customer</td>
                  <td><?php echo number_format($data_savings['total'],2); ?></td>
                </tr>



            </tbody>
            <tfoot>      
                  <tr>
                  <td>Total</td>
                  <td><?php echo number_format($total,2); ?></td>
                  </tr>        
            </tfoot>
         </table>






         <table border='1' class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>
               <tr role='row'>
                  <th>Expenses Details</th>
                  <th>Amount</th> 
               </tr>
            </thead>
            <tbody>
                <tr>
                  <td style='width: 50%;'>Withdrawal from Customer</td>
                  <td><?php echo number_format($data_withdraw['total'],2); ?></td>
                </tr>

                <tr>
                  <td>Loan Releases</td>
                  <td><?php echo number_format($data_releases['total'],2); ?></td>
                </tr>
                <tr>
                  <td>Other Expenses</td>
                  <td><?php echo number_format($data_expenses['total'],2); ?></td>
                </tr>


            </tbody>
            <tfoot>      
                  <tr>
                  <td>Total</td>
                  <td><?php echo number_format($totaldeduct,2); ?></td>
                  </tr>        
            </tfoot>
         </table>



         <table border='1' class="table table-striped table-bordered table-hover dataTable no-footer">
            <tbody>


                <tr>
                  <td style="width:50%;">Remaning Balance</td>
                  <td style='color:green'><strong><?php echo number_format(($total - $totaldeduct),2); ?></strong></td>
                </tr>
                <tr>
                  <td style="width:50%;">Unpaid Loans</td>
                  <td style='color:red'><strong><?php echo number_format(($unpaid['total'] + $unpaid_mutual['total']),2); ?></strong></td>
                </tr>



            </tbody>
         </table>


</div>






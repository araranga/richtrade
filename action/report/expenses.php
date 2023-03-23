<?php
 #echo "<a href='?pages=".$_GET['pages']."&task=jlcdaily'>Go back</a>";
 #$_GET['is_paid'] = 'yes';  
 $field = array("remarks","amount");
 //$_GET['ptype'] = 'withdraw';
 $where = getwheresearch($field);


 $datefield = "actual";



 if($_GET['date1'] != '' && $_GET['date2'] != ''){

    if(empty($where)){

      $where = "WHERE $datefield BETWEEN '{$_GET['date1']} 00:00:00' and '{$_GET['date2']} 23:00:00'";
    }else{

      $where .= "AND $datefield BETWEEN '{$_GET['date1']} 00:00:00' and '{$_GET['date2']} 23:00:00'";
    }

 }

 if(empty($where)){
  $where = "WHERE (loan_id IS NULL AND passbook_id IS NULL)";
 }else{
  $where .= "AND (loan_id IS NULL AND passbook_id IS NULL)";
 }
 
      if(empty($where)){

      $where = "WHERE stores = '{$_SESSION['stores']}'";
    }else{

      $where .= " AND stores = '{$_SESSION['stores']}'";
    }


 
$groupby = '';
if(empty($_GET['filter']))
{

$filter = "SELECT a.*,MONTH(actual) as month,WEEK(actual) as week,YEAR(actual) as year,DAY(actual) as day FROM tbl_expenses as a";

}else{

$filter = "SELECT a.*,MONTH(actual) as month,WEEK(actual) as week,YEAR(actual) as year,DAY(actual) as day,SUM(amount) as total FROM tbl_expenses as a";

  if($_GET['filter']=='weekly'){
    $groupby = "GROUP by week,year";
  }
  if($_GET['filter']=='daily'){
    $groupby = "GROUP by day,month,year";
  }
  if($_GET['filter']=='yearly'){
    $groupby = "GROUP by year";
  }

  if($_GET['filter']=='monthly'){
    $groupby = "GROUP by month,year";
  }

}


 $total = countquery("$filter $where $groupby");


 #echo $where;

 //primary query
 $limit = getlimit(100,$_GET['p']);

  $query = "$filter $where $groupby $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,100);


$field_data = array();
foreach($field as $ff){
    $field_data[] = ucfirst(str_replace("_", " ", $ff));
}
?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}
</style>
<h2>Expenses - Report</h2>


<p class='headerprint' style='display:none;'>Loan Release Record for - <?php echo $_GET['date1']; ?></p>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">

            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                    Filter the date per day.


                    <form method=''>
                    <table>
<!--              


  -->  
                    <?php if(empty($_GET['filter'])) { ?>
                     <tr>
                        <td>Search Keyword:</td>
                        <td><input type='text' value='<?php echo $_GET['search']; ?>' name='search'></td>
                      </tr>

                      <tr>
                        <td>To:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>    
                      <tr>
                        <td>From:</td>
                        <td><input type='date' value='<?php echo $_GET['date2']; ?>' name='date2'></td>
                      </tr>

                    <?php } ?>
                      <tr>
                        <td>Filter By:</td>
                        <td>
                          <select name='filter'>
                            <option value=''>None</option>
                            <option <?php if($_GET['filter']=='daily') { echo "selected='selected'"; } ?> value='daily'>Daily</option>
                            <option <?php if($_GET['filter']=='weekly') { echo "selected='selected'"; } ?>  value='weekly'>Weekly</option>
                            <option <?php if($_GET['filter']=='monthly') { echo "selected='selected'"; } ?>  value='monthly'>Monthly</option>
                            <option <?php if($_GET['filter']=='yearly') { echo "selected='selected'"; } ?>  value='yearly'>Yearly</option>
                          </select>
                        </td>
                      </tr>




                    </table>
                    <br/>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>                    
                    <input type='submit' name='search_button' class="btn btn-primary"/>
                    <?php if($_GET['search_button']) {  ?>
                      <input type='button' onclick="window.location = 'index.php?pages=<?php echo $_GET['pages'];?>&task=<?php echo $_GET['task'];?>'" name='cleaar' value="Clear Search " class="btn btn-primary"/>
                    <?php } ?>


                    <input value="Print as CSV" onclick="window.location='uploads/<?php echo $_GET['date1'].$_GET['task']; ?>.csv';" type='button' name='print' class="btn btn-primary"/>


                    </form>
                  </div>
               </div>
            </div>            
         </div>    
      <div class="table-responsive">

         
         <br/>
         <table border='1' class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>

               <?php if(empty($_GET['filter'])) { ?>
                  <th>Remarks</th>
               <?php } ?>
                  <th>Amount</th>
                  <th>Date</th>
                  <?php if(empty($_GET['filter'])) { ?>
                  <th>C/O</th>
                  <?php } ?>
               </tr>
            </thead>
            <tbody>
               <?php
               $totalamount = 0;
               $csv = array();
               if(empty($_GET['filter'])) { 
               $csv[] = array("Name","Address","Label","Loan Amount","Net Amount","Interest Amount","Interest Rate","Terms","Balance","Release","C/O");
               }else{
                $csv[] = array("Total Amount","Date");
               }
                  while($row=mysql_fetch_md_array($q))
                  {

                    $csvrow = array();
                    $interest_amount = ($row['amount'] * percentget($row['interest']));
                    $balance = ($row['loop_number'] - $row['loop_paid']) * $row['loop_amount'];
                    
                    $date = date("Y-m-d",strtotime($row['actual']));


                    if($row['total']){
                      $row['amount'] = $row['total'];
                    }


                    if(!empty($_GET['filter'])){
                      $totalamount += $row['total'];
                      $date = $row['week']; 
                      $year  = $row['year'];
                      $week = $row['week'];
                      $month = $row['month'];
                      $day = $row['day'];

                        if($_GET['filter']=='weekly'){

                        $dto = new DateTime();
                        $ret['week_start'] = $dto->setISODate($year, $week)->format('Y-m-d');
                        $ret['week_end'] = $dto->modify('+6 days')->format('Y-m-d');

                        $date =   $ret['week_start']." - ". $ret['week_end'];

                        }

                        if($_GET['filter']=='daily'){

                          $date = date("Y-m-d",strtotime($row['actual']));

                        }


                        if($_GET['filter']=='monthly'){

                          $date = date("Y-m",strtotime($row['actual']));

                        }

                        if($_GET['filter']=='yearly'){

                          $date = date("Y",strtotime($row['actual']));

                        }

                    }
                  ?>
               <tr>
                 <?php if(empty($_GET['filter'])) { ?>
                  <td><?php echo $csvrow[] = $row['remarks']; ?></td>
                  <?php } ?>
                  <td><?php echo $csvrow[] = number_format($row['amount'],2); ?></td>
                  <td><?php echo $csvrow[] = $date; ?></td>
                  <?php if(empty($_GET['filter'])) { ?>
                  <td><?php echo $csvrow[] = $row['createdby']; ?></td>
                  <?php } ?>
                  
               </tr>
               <?php
                  $csv[] = $csvrow;
                  }

                  
                  ?>

            </tbody>
            <tfoot>
                   <?php  
                  if (!empty($totalamount)) {
                    $totalamount = number_format($totalamount,2);

                    $csv[] = array("Total :".$totalamount);
                    echo "<tr><td colspan='3'>Total : {$totalamount}</td></tr>";
                  }




                  createcsv($csv,$_GET['date1'].$_GET['task']);
                  ?>                
            </tfoot>
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


                          $urldata = $_GET;
                          unset($urldata['p']);
                          $url = "?";
                          foreach($urldata as $uk=>$uv){
                              $url .= "$uk=$uv&";
                          }

                          #$url = "?search=".$_GET['search']."&pages=".$_GET['pages']."&task=Submit&p=".$c;
                      ?>
                        <li class="paginate_button <?php echo $active; ?>" aria-controls="dataTables-example" tabindex="0"><a href="<?php echo $url; ?>"><?php echo $c; ?></a></li>
                      <?php
                        }
                      ?>
                     </ul>
                  </div>
               </div>
            </div>      
   </div>
</div>

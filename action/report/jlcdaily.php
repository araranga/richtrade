<?php

 #$_GET['is_paid'] = 'yes';  
 $field = array("amount","remarks","is_paid");
 $where = getwheresearch($field);


 $datefield = "actual";


 if($_GET['date1'] == ''){
  $_GET['date1'] = date("Y-m-d");
 }

 if($_GET['date1'] != ''){

    if(empty($where)){

      $where = "WHERE $datefield LIKE '%{$_GET['date1']}%'";
    }else{

      $where .= "AND $datefield LIKE '%{$_GET['date1']}%'";
    }

 }




 $total = countquery("SELECT actual, SUM(amount) as amt FROM (SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,loan_id,(1) as tips FROM tbl_schedule WHERE stores='{$_SESSION['stores']}' UNION SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,loan_id,(2) as tips FROM tbl_schedule_mutual WHERE stores='{$_SESSION['stores']}' UNION SELECT id,user,actual,amount,createdby,(0) as loan_id,(3) as tips FROM tbl_passbook WHERE schedule_id IS NULL AND stores='{$_SESSION['stores']}' AND ptype='savings') as tbl WHERE actual IS NOT NULL GROUP by actual");


 #echo $where;

 //primary query
 $limit = getlimit(100000,$_GET['p']);

$query = "SELECT actual, SUM(amount) as amt FROM (SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,loan_id,(1) as tips FROM tbl_schedule WHERE stores='{$_SESSION['stores']}' UNION SELECT id,user_id,actual,(payment + penalty + savings) as amount,createdby,loan_id,(2) as tips FROM tbl_schedule_mutual WHERE stores='{$_SESSION['stores']}' UNION SELECT id,user,actual,amount,createdby,(0) as loan_id,(3) as tips FROM tbl_passbook WHERE schedule_id IS NULL AND stores='{$_SESSION['stores']}' AND ptype='savings') as tbl WHERE actual IS NOT NULL GROUP by actual ORDER by actual DESC $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,100000);


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
<h2>JLC Collection</h2>


<p class='headerprint' style='display:none;'>Daily JLC Collection</p>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">

            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                  <!-- 
                    <form method=''>
                    <table>                
                      <tr>
                        <td>To:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>    


                    </table>
                    <br/>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>                    
                    <input type='submit' name='search_button' class="btn btn-primary"/> -->

                    <input value="Print as PDF" onclick="printData('dataTables-example')" type='button' name='print' class="btn btn-primary"/>


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
                  <th>Date</th>
                  <th>Amount</th> 
               </tr>
            </thead>
            <tbody>
               <?php
               $totalamount = 0;
               $csv = array();

               $csv[] = array("Date","Amount");
                  while($row=mysql_fetch_md_array($q))
                  {

                    $csvrow = array();
                    $pid = $row['id'];
                    $totalamount += $row['amount'];




                    
                  ?>
               <tr>
                  <td>
                    <a href='index.php?pages=report&task=dailycollect&date1=<?php echo date("Y-m-d",strtotime($row['actual'])); ?>'>
                    <?php echo $csvrow[] = date("Y-m-d",strtotime($row['actual'])); ?>
                    </a>
                  </td>
                  <td><?php echo $csvrow[] = number_format($row['amt'],2); ?></td>
                  
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
                          $url = "?search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&task={$_GET['task']}&p=".$c;
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

<?php
 $field = array("name","address","contact","custom_label","is_paid");
 $_GET['is_paid'] = 'yes';
  $datefield = "actual";





 $where = getwheresearch($field);



if($_GET['date1'] != ''){

    if(empty($where)){

      $where = "WHERE $datefield LIKE '%{$_GET['date1']}%'";
    }else{

      $where .= "AND $datefield LIKE '%{$_GET['date1']}%'";
    }

 }

      if(empty($where)){

      $where = "WHERE a.stores = '{$_SESSION['stores']}'";
    }else{

      $where .= " AND a.stores = '{$_SESSION['stores']}'";
    }


 
 $total = countquery("SELECT a.*,name,address,custom_label,contact FROM tbl_schedule_mutual as a LEFT JOIN tbl_members as b ON b.id=a.user_id $where");
 //primary query
 $limit = getlimit(100,$_GET['p']);
 $query = "SELECT a.*,name,address,custom_label,contact FROM tbl_schedule_mutual as a LEFT JOIN tbl_members as b ON b.id=a.user_id $where $limit";

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
<h2>Life Insurances - Collections</h2>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
<!--             <div class="col-md-3">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=add"; ?>';" type="button" class="btn btn-primary" value="Add New Data">
                  </div>
               </div>
            </div> -->
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <?php unset($field_data[4]); ?>
                    Search by: <?php echo (implode(", ", $field_data)); ?>
                    <form method=''>


                    <table>
<!--                     


                      <tr>
                        <td>From:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>  -->    



                      <tr>
                        <td>Search Keyword:</td>
                        <td><input type='text' value='<?php echo $_GET['search']; ?>' name='search'></td>
                      </tr>

                      <tr>
                        <td>To:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>    


                    </table>


                 
                    <input type='hidden' value='<?php echo $_GET['task']; ?>' name='task'>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='submit' name='search_button' class="btn btn-primary"/>





                    <?php if($_GET['search_button']) {  ?>
                      <input type='button' onclick="window.location = 'index.php?pages=<?php echo $_GET['pages'];?>&task=<?php echo $_GET['task'];?>'" name='cleaar' value="Clear Search " class="btn btn-primary"/>
                    <?php } ?>

                    
                    </form>
                  </div>
               </div>
            </div>            
         </div>    
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
                  
                  <th>Name</th>
                  <th>Amount</th>
                  <th>Schedule Date</th>
                  <th>Actual Payment Date</th>
                  <th>C/O</th>           
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid = $row['loan_id'];
                    $balance = ($row['loop_number'] - $row['loop_paid']) * $row['loop_amount'];
                  ?>
               <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['payment']; ?></td>
                  <td><?php echo date("Y-m-d",strtotime($row['schedule'])); ?></td>
                  <td><?php echo date("Y-m-d",strtotime($row['actual'])); ?></td>
                  <td><?php echo $row['createdby']; ?></td>


                  <td>
                     <input onclick="window.location='<?php echo "?pages=".'members'."&task=mutual-edit&id=$pid&uid={$row['user_id']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="View Details">
                  </td>
               </tr>
               <?php
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
                          $url = "?task={$_GET['task']}&search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&p=".$c;
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

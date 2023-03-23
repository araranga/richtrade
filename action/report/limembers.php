<?php
 $field = array("name","address","contact","custom_label");
 $where = getwheresearch($field);


      if(empty($where)){

      $where = "WHERE a.stores = '{$_SESSION['stores']}'";
    }else{

      $where .= " AND a.stores = '{$_SESSION['stores']}'";
    }


 
 $total = countquery("SELECT a.*,name,address,custom_label,contact FROM tbl_mutual as a LEFT JOIN tbl_members as b ON b.id=a.user $where");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT a.*,name,address,custom_label,contact FROM tbl_mutual as a LEFT JOIN tbl_members as b ON b.id=a.user $where $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);


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
<h2>Life Insurances - Members</h2>
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
                    Search by: <?php echo (implode(", ", $field_data)); ?>
                    <form method=''>
                    <input type='text' value='<?php echo $_GET['search']; ?>' name='search'>
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
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Category</th>
                  <th>Premium Amount</th>
                  <th>Terms</th>
                  <th>Balance</th>
                  <th>Payment Schedule</th>            
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid = $row['id'];
                    $balance = ($row['loop_number'] - $row['loop_paid']) * $row['loop_amount'];
                  ?>
               <tr>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['contact']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $row['custom_label']; ?></td>

                  <td><?php echo number_format($row['amount'],2); ?></td> 
                  <td><?php echo ($row['terms'] / 12); ?> Years</td>
                  <td><?php echo number_format($balance,2); ?></td>
                  <td><?php echo ucfirst($row['payment_type']); ?></td>

                  <td>
                     <input onclick="window.location='<?php echo "?pages=".'members'."&task=mutual-edit&id=$pid&uid={$row['user']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="View Details">
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

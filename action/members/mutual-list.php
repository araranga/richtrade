<?php
$_GET['user'] = $_GET['id'];
 $field = array("amount","terms","remarks","user");
 $where = getwheresearch($field);
 $total = countquery("SELECT id FROM tbl_mutual $where");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_mutual $where $limit";

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
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
            <div class="col-md-3">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=mutual&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary" value="Add Mutual Fund">
                  </div>
               </div>
            </div>
            <div class="col-md-9">  
            </div>            
         </div>    
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
                  <th>Premium Amount</th>
                  <th>Net Amount</th>
                  <th>Terms</th>
                  <th>Remarks</th>
<!--                   <th>Penalty</th> -->
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid = $row['id'];
                    $interest_amount = ($row['amount'] * percentget($row['interest']));
                  ?>
               <tr>
                  <td><?php echo number_format($row['amount'],2); ?></td>
                  <td><?php echo number_format($row['net'],2);  ?></td>
                  <td><?php echo ($row['terms'] / 12); ?> Years</td>
                  <td><?php echo $row['payment_type']; ?></td>
<!--                   <td><?php echo $row['penalty']; ?>%</td> -->
                  <td>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=mutual-edit&id=$pid&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="Edit">
                     <?php  if($_SESSION['role']==1) { ?>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=mutual-delete&id=$pid&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="Delete">
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
                          $url = "?&id={$_GET['id']}&task=edit&search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&p=".$c;
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

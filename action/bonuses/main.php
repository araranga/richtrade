<?php
 $field = array("transnum","username");
 $where = getwheresearch($field);
 $total = countquery("SELECT id FROM tbl_bonus_history");
 //primary query
 $limit = getlimit(10,$_GET['p']);
$query = "SELECT * FROM tbl_bonus_history $where $limit";




 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);


?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}
</style>
<h2>Bonus History</h2>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                    Search by: Username,Transact#:
                    <form method=''>
                    <input type='text' value='<?php echo $_GET['search']; ?>' name='search'>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='submit' name='search_button' class="btn btn-primary"/>
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
                  <th>Sender</th>
                  <th>Receiver</th>
                  <th>Amount</th>
                  <th>Type</th>
                  <th>Remarks</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid =  $row['id'];
                  ?>
               <tr>
                  <td><?php echo $row['send']; ?></td>
                  <td><?php echo $row['receiver']; ?></td>
                  <td><?php echo $row['amount']; ?></td>
                  <td><?php echo $row['ptype']; ?></td>
                  <td><?php echo $row['remarks']; ?> - <?php echo $row['history']; ?></td>

                  <td>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=view&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="View">
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
                          $url = "?search=&pages=".$_GET['pages']."&search_button=Submit&p=".$c;
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

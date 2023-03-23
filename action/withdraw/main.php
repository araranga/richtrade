<?php
 $field = array("transnum","email","username");
 $where = getwheresearch($field);
 $total = countquery("SELECT id FROM tbl_withdraw_history");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_withdraw_history as a LEFT JOIN tbl_accounts as b on a.accounts_id=b.accounts_id $where $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);


?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}
</style>
<h2>Payouts</h2>
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
         <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                    Export by:
                    <form action='csv.php'> 
                    <select name='r'>
                        <option value='btc'>Bitcoin</option>
                        <option value='kc'>Kringle Coins</option>
                        <option value='billc'>The Billion Coins</option>
                    </select>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='hidden' name='task' value='csv'>
                    <input type='submit' name='export' class="btn btn-primary"/>
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
                  <th>Trans #</th>
                  <th>UserName / Email</th>
                  <th>Type</th>
                  <th>Coin</th>
				  <th>Amount</th>
                  <th>Status</th>
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
                  <td><?php echo $row['transnum']; ?> / <?php echo $row['address']; ?></td>
                  <td><?php echo $row['username']; ?></td>
                  <td><?php echo $row['claimtype']; ?></td>
                  <td><?php echo $row['amount']; ?></td>
				  <td><?php echo $row['conv']; ?></td>
                  <td>
                    <?php
                    if($row['claim_status']==0)
                    {
                      echo "Pending";
                    } 
                    else
                    {
                      echo "Claimed";
                    }
                    ?>
                  </td>
                  <td>
<?php
if($row['claim_status']==0)
{
?>
    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=setclaim&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Mark as Claim">
<?php
}
?>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=delete&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Delete">
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

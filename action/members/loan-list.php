<?php
 $_GET['user'] = $_GET['id'];
 $field = array("amount","terms","remarks","penalty","interest","user");
 $where = getwheresearch($field);
 $total = countquery("SELECT id FROM tbl_loan $where");
 //primary query
 $limit = getlimit(100,$_GET['p']);
 $query = "SELECT * FROM tbl_loan as a $where ORDER by loan_date DESC $limit";

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
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
            <div class="col-md-3">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=loan&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary" value="Add New Loan">
                  </div>
               </div>
            </div>
            <div class="col-md-9">
<!--                <div class="panel panel-default">
                  <div class="panel-body">
                    Search by: <?php echo (implode(", ", $field_data)); ?>
                    <form method=''>
                    <input type='text' value='<?php echo $_GET['search']; ?>' name='search'>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='submit' name='search_button' class="btn btn-primary"/>
                    </form>
                  </div>
               </div> -->
            </div>            
         </div>    
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
                  <th>Description</th>
                  <th>Loan Amount</th>
                  <th>Net Amount</th>
                  <th>Interest Amount</th>
                  <th>Interest</th>
                  <th>Terms</th>
                  <th>Balance</th>
                  <th>C/O</th>
                  
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

                    if($row['balance']<=0) {
                      $row['balance'] = 0;
                    }        

                  ?>
               <tr>
                  <td>
                    <a style='color:green;' href='<?php echo "?pages=".$_GET['pages']."&task=loan-edit&id=$pid&uid={$_GET['id']}"; ?>'>
                      <?php echo $row['loandesc']; ?>
                    </a>
      
                  </td>
                  <td><?php echo number_format($row['amount'],2); ?></td>
                  <td><?php echo number_format($row['net'],2);  ?></td>
                  <td><?php echo number_format($interest_amount,2); ?></td>
                  <td><?php echo $row['interest']; ?>%</td>
                  <td><?php echo $row['terms']; ?></td>
                  
                  <td><?php echo number_format($row['balance'],2); ?></td>
                  <td><?php echo $row['createdby']; ?></td>
                
<!--                   <td><?php echo $row['penalty']; ?>%</td> -->
                  <td>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=loan-edit&id=$pid&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="Edit">
                     <?php  if($_SESSION['role']==1) { ?>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=loan-delete&id=$pid&uid={$_GET['id']}"; ?>';" type="button" class="btn btn-primary btn-sm" value="Delete">
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

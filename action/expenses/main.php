<?php
 $field = array("amount","remarks");
 $_GET['loan_id'] = NULL;
 $_GET['passbook_id'] = NULL;

 $datefield = "actual";

$where = getwheresearch($field);
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


 
 $total = countquery("SELECT id FROM tbl_expenses $where");
 #echo $where;

 //primary query
 $limit = getlimit(1000,$_GET['p']);






 $query = "SELECT * FROM tbl_expenses $where ORDER by actual ASC $limit";

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
<h2>Expenses</h2>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
            <div class="col-md-3">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=add"; ?>';" type="button" class="btn btn-primary" value="Add New Data">
                  </div>
               </div>
            </div>
            <div class="col-md-9">
               <div class="panel panel-default">
                  <div class="panel-body">
                    Search by: <?php echo (implode(", ", $field_data)); ?>


                    <form method=''>
                    <table>
                      <tr>
                        <td>Search Keyword:</td>
                        <td><input type='text' value='<?php echo $_GET['search']; ?>' name='search'></td>
                      </tr>


                      <tr>
                        <td>From:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>                   
                      <tr>
                        <td>To:</td>
                        <td><input type='date' value='<?php echo $_GET['date2']; ?>' name='date2'></td>
                      </tr>    


                    </table>
                    <?php if($_GET['search_button']) {  ?>
                      <a href='index.php?pages=<?php echo $_GET['pages'];?>'> Clear Search </a><br/>
                    <?php } ?>
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
                  <th>Remarks</th>
                  <th>Amount</th>
                  
                  <th>C/O</th>
                  <th>Date</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid = $row['id'];
                  ?>
               <tr>
                  <td><?php echo $row['remarks']; ?></td>
                  <td><?php echo number_format($row['amount'],2); ?></td>
                  
                  <td><?php echo $row['createdby']; ?></td>
                  <td><?php echo date("Y-m-d",strtotime($row['actual'])); ?></td>
                  <td>
                    <?php if(empty($row['loan_id']) && empty($row['passbook_id']) && $_SESSION['role']==1) { ?>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=edit&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Edit">
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=delete&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Delete">
                   <?php }  else {
                      echo " - ";
                   } ?>
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
                          $url = "?search=".$_GET['search']."&pages=".$_GET['pages']."&search_button=Submit&p=".$c;
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

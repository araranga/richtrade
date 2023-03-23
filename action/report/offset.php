<?php
 #echo "<a href='?pages=".$_GET['pages']."&task=jlcdaily'>Go back</a>";
 #$_GET['is_paid'] = 'yes';  
 $field = array("name","address","contact","is_offset");
 $_GET['is_offset'] = '1';
  $where = getwheresearch($field);




      if(empty($where)){

      $where = "WHERE stores = '{$_SESSION['stores']}'";
    }else{

      $where .= " AND stores = '{$_SESSION['stores']}'";
    }



 $total = countquery("SELECT id FROM `tbl_members` $where");


 #echo $where;

 //primary query
 $limit = getlimit(20,$_GET['p']);

  $query = "SELECT * FROM `tbl_members` $where $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,20);


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
<h2>Offset Members</h2>


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

                     <tr>
                        <td>Search Keyword:</td>
                        <td><input type='text' value='<?php echo $_GET['search']; ?>' name='search'></td>
                      </tr>

<!--                       <tr>
                        <td>To:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>    
                      <tr>
                        <td>From:</td>
                        <td><input type='date' value='<?php echo $_GET['date2']; ?>' name='date2'></td>
                      </tr> -->

                    </table>
                    <br/>
                    <input type='hidden' name='pages' value='<?php echo $_GET['pages'];?>'>
                    <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>                    
                    <input type='submit' name='search_button' class="btn btn-primary"/>



                    <input value="Print as CSV" onclick="window.location='uploads/<?php echo $_GET['date1'].$_GET['task']; ?>.csv';" type='button' name='print' class="btn btn-primary"/>

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
         <table border='1' class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Label</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $totalamount = 0;
               $csv = array();

               $csv[] = array("Name","Address","Label","Balance","C/O");
                  while($row=mysql_fetch_md_array($q))
                  {

                    $csvrow = array();
                    $interest_amount = ($row['amount'] * percentget($row['interest']));
                    $balance = ($row['loop_number'] - $row['loop_paid']) * $row['loop_amount'];
                    
                  ?>
               <tr>
                  <td><?php echo $csvrow[] = $row['name']; ?></td>
                  <td><?php echo $csvrow[] = $row['address']; ?></td>
                  <td><?php echo $csvrow[] = $row['custom_label']; ?></td>

                  <td><a href='<?php echo "?pages=members&task=edit&id={$row['id']}"; ?>' target="_newtab" class='btn btn-primary btn-sm'>View</a></td>                 
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

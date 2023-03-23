<?php
 #echo "<a href='?pages=".$_GET['pages']."&task=jlcdaily'>Go back</a>";
 #$_GET['is_paid'] = 'yes';  
 $field = array("name","address","contact","amount");
 $where = getwheresearch($field);


 $datefield = "loan_release";



 if($_GET['date1'] != '' && $_GET['date2'] != ''){

    if(empty($where)){

      $where = "WHERE $datefield BETWEEN '{$_GET['date1']} 00:00:00' and '{$_GET['date2']} 23:00:00'";
    }else{

      $where .= " AND $datefield BETWEEN '{$_GET['date1']} 00:00:00' and '{$_GET['date2']} 23:00:00'";
    }

 }

     if(empty($where)){

      $where = "WHERE a.stores = '{$_SESSION['stores']}'";
    }else{

      $where .= " AND a.stores = '{$_SESSION['stores']}'";
    }








 $total = countquery("SELECT a.id FROM tbl_loan as a LEFT JOIN tbl_members as b ON a.user=b.id $where");


 #echo $where;

 //primary query
 $limit = getlimit(20,$_GET['p']);

  $query = "SELECT a.*,name,address,contact,custom_label,a.id as loanid FROM tbl_loan as a LEFT JOIN tbl_members as b ON a.user=b.id $where ORDER by loan_release ASC  $limit";

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
<h2>Loan Release</h2>


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

                      <tr>
                        <td>To:</td>
                        <td><input type='date' value='<?php echo $_GET['date1']; ?>' name='date1'></td>
                      </tr>    
                      <tr>
                        <td>From:</td>
                        <td><input type='date' value='<?php echo $_GET['date2']; ?>' name='date2'></td>
                      </tr>

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
                  <th>Loan Amount</th>
                  <th>Net Amount</th>
                  <th>Interest Amount</th>
                  <th>Interest</th>
                  <th>Terms</th>
<!--                   <th>Balance</th> -->
                  <th>Loan Release</th>
                  <th>C/O</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $totalamount = 0;
               $csv = array();

               $csv[] = array("Name","Address","Label","Loan Amount","Net Amount","Interest Amount","Interest Rate","Terms","Balance","Release","C/O");
                  while($row=mysql_fetch_md_array($q))
                  {


                    $csvrow = array();
                    $interest_amount = ($row['amount'] * percentget($row['interest']));



                    
                  ?>
               <tr>
                  <td><?php echo $csvrow[] = $row['name']; ?></td>
                  <td><?php echo $csvrow[] = $row['address']; ?></td>
                  <td><?php echo $csvrow[] = $row['custom_label']; ?></td>
                  <td><?php echo $csvrow[] = number_format($row['amount'],2); ?></td>
                  <td><?php echo $csvrow[] = number_format($row['net'],2);  ?></td>
                  <td><?php echo $csvrow[] = number_format($interest_amount,2); ?></td>
                  <td><?php echo $csvrow[] = $row['interest']; ?>%</td>
                  <td><?php echo $csvrow[] = $row['terms']; ?></td>
                  
<!--                   <td><?php echo $csvrow[] = number_format($balance,2); ?></td> -->
                  <td><?php echo $csvrow[] = date("Y-m-d",strtotime($row['loan_release'])); ?></td>
                  <td><?php echo $csvrow[] = $row['createdby']; ?></td>
                  
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

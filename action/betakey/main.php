<?php
 $field = array("title");
 $where = getwheresearch($field);
 $total = countquery("SELECT id FROM tbl_betakey $where");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_betakey $where $limit";

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
<h2>Beta Key Management</h2>
<div class="panel panel-default">
   <div class="panel-body">
         <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-body">
                    <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=add"; ?>';" type="button" class="btn btn-primary" value="Add New Data">
					
					
					<input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=generate"; ?>';" type="button" class="btn btn-primary" value="Generate">
                  </div>
               </div>
            </div>
            <div><hr></div>          
         </div>    
      <div class="table-responsive">

         
         <br/>
         <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
            <thead>
               <tr role='row'>
                  <th>Beta Key</th>
				  <th>User</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row=mysql_fetch_md_array($q))
                  {
                    $pid = $row['id'];
                    $roledata = ($row['role'] == 1 ? 'Administrator' : 'Member');
                  ?>
               <tr>
                  <td><?php echo $row['betakey']; ?></td>
                  <td><?php echo $row['user']; ?></td>
                  <td>
                     <input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=edit&id=$pid"; ?>';" type="button" class="btn btn-primary btn-sm" value="Edit">
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

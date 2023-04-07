<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
 $accounts_id = $_SESSION['accounts_id'];
//$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT id FROM tbl_income WHERE user='$accounts_id'");
 //primary query
 $limit = getlimit(50,$_GET['p']);
 $query = "SELECT * FROM tbl_income as a WHERE user='$accounts_id' ORDER by id DESC $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);
?>
<h2>Points Flow</h2>

<?php
if($total==0) {
?>
<p> No Battle Points history. </p>
<?php
}
?>
                    <div class="panel panel-default" style="<?php if($total==0) { echo "display:none;"; } ?>">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Message</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_md_array($q))
									{
										
									?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
											<td><?php echo $row['message']; ?></td>
                                            <td>
											<?php echo date("M d, Y h:i A",strtotime($row['timedata'])); ?>
											</td>
                                        </tr>
									<?php
									}
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
            <div class="row">
               <div class="col-sm-12">
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


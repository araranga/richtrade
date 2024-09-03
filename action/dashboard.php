<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
?>

<div class="callout callout-warning">
      <h5>Your Referral Url:</h5>
<div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-link"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                    <?php echo $_SERVER['HTTP_HOST']; ?>/register.php?refer=<?php echo $_SESSION['accounts_id']; ?>
                </span>
              </div>
              <!-- /.info-box-content -->
</div>
</div>





<hr>

<?php
$accounts_id = $_SESSION['accounts_id'];
$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT id FROM tbl_exchange_history $where");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_exchange_history as a $where $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);
?>
<h2>Exchange History</h2>
<?php
if($total==0) {
?>
<p> No withdrawals history. </p>
<?php
}
?>
                    <div class="panel panel-default" style="<?php if($total==0) { echo "display:none;"; } ?>">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tracking Number #</th>
                                            <th>Transfer From</th>
                                            <th>Coins Amount</th>
											<th>Claim Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_md_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['transnum']; ?></td>
                                            <td><?php echo $row['claimtype']; ?> To Tether</td>
                                            <td><?php echo $row['amount']; ?></td>

											<?php
											$tracking = $row['id']+1000000;
											?>
											<th>
                                                <?php 
                                                                                   
                                                if($row['claim_status']==0){ 
                                                    echo "Pending Transfer(You)";
                                                }
                                                if($row['claim_status']==1)
                                                {     
                                                    echo "<p>Transferred (On your account)</p>";
                                                }
                                                ?>
                                            </th>
                                            <td><?php echo $row['history']; ?></td>
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
			
<hr>


<?php
$accounts_id = $_SESSION['accounts_id'];
$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT id FROM tbl_invest_history $where");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_invest_history as a $where $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);
?>
<h2>Investment History</h2>


<?php
if($total==0) {
?>
<p> No investment history. </p>
<?php
}
?>
                    <div class="panel panel-default" style="<?php if($total==0) { echo "display:none;"; } ?>">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tracking Number #</th>
                                            <th>Coins Invested</th>
											<th>Payout Amount</th>
											<th>Payout Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_md_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $row['transnum']; ?></td>
                                            <td><?php echo $row['amount']; ?></td>
                                            <td><?php echo $row['conv']; ?></td>
                                            <td><?php echo $row['payout_date']; ?></td>
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


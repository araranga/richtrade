<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT id FROM tbl_withdraw_history $where");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_withdraw_history as a $where $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);
?>
<h2>Withdrawal History</h2>


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
                                            <th>Coins Withdraw</th>
											<th>Conversion</th>
                                            <th>Balance Remaining</th>
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
                                            <td><?php echo $row['amount']; ?></td>
											<td><?php echo $row['conv']; ?></td>
                                            <td><?php echo $row['new_balance']; ?></td>
											<?php
											$tracking = $row['id']+1000000;
											?>
											<th>
                                                <?php 
                                                if($row['claim_status']==0 && $row['claimtype']=='pickup'){ 
                                                echo "Pickup - <a href='pdf/withdrawal.php?id=".$row['transnum']."' target='_newtab'>Download Form Here</a>"; 
                                                }
                                                if($row['claim_status']==0 && $row['claimtype']=='remit'){ 
                                                    echo "On Process (Remittance) - ".$row['remit_name'];
                                                }

                                                if($row['claim_status']==0 && $row['claimtype']=='bank'){ 
                                                    echo "On Process (Bank Deposit) - ".$row['bank_name'];
                                                }
                                                if($row['claim_status']==0 && $row['claimtype']=='smartpadala'){ 
                                                    echo "On Process (Smart Padala)";
                                                }                                                
                                                if($row['claim_status']==0){ 
                                                    echo "Processing Request";
                                                }
                                                if($row['claim_status']==1)
                                                {     
                                                    echo "<p>Claimed</p>";
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


<?php
$q = mysql_query_md("SELECT * FROM tbl_package");
?>
<h2>Package</h2>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
							<input onclick="window.location='<?php echo "?pages=".$_GET['pages']."&task=add"; ?>';" type="button" class="btn btn-primary btn-lg" value="Add">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Package ID</th>
                                            <th>Package Name</th>
											<th>Per Cycle Earnings</th>
                                            <th>Total Earnings</th>
											<th>Account Counts</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_md_array($q))
									{
									?>
                                        <tr>
                                            <td><?php echo $pid = $row['package_id']; ?></td>
                                            <td><?php echo $row['package_name']; ?></td>
											<td><?php echo $row['cycle_earn']; ?></td>
                                            <td><?php echo $row['possible_earning']; ?></td>
											<td><?php echo $row['account_count']; ?></td>
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
                        </div>
                    </div>   

<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
 $accounts_id = $_SESSION['accounts_id'];
//$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT id FROM tbl_battle WHERE p1user='$accounts_id' OR p2user='$accounts_id'");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_battle as a WHERE p1user='$accounts_id' OR p2user='$accounts_id' ORDER by id DESC $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);
?>
<h2>Battle History</h2>

<?php
if($total==0) {
?>
<p> No Battle history. </p>
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
                                            <th>Player 1</th>
                                            <th>Player 2</th>
                                            <th>Winner</th>
                                            <th>Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									while($row=mysql_fetch_md_array($q))
									{
										
										$p1 = $row['p1user'];
										$p2 = $row['p2user'];
										$p1p = $row['p1poke'];
										$p2p = $row['p2poke'];										
										
										
										if($row['p1user']!=$accounts_id){
											$row['p1user'] = $p2;
											$row['p1poke'] = $p2p;
											
											$row['p2user'] = $p1;
											$row['p2poke'] = $p1p;											
											
										}else{
											
											
										}
									?>
                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td>
											
											
												<div id="poke-container" class="ui cards">

												<?php
												$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE id='{$row['p1poke']}'");		

													while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
												?>	
														<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
														<div class='typedataholder'>
															<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
																<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
															<?php } ?>	
														</div>
														
														   <div class="image">
													   
														
														   <div class='mainchar flipme showchar p1user' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'></div>
														   
														   </div>
														   <h4><?php echo $rowqpokes['pokename']; ?>		   
													</h4>
														   <p class='idsdata'>
														   <a target='_newtab' href='index.php?pages=viewpoke&pokeid=<?php echo $rowqpokes['hash']; ?>'>
														   ID:#<?php echo $rowqpokes['hash']; ?>
														   </a>
														   </p>
														   <span>Level:<?php echo $rowqpokes['level']; ?></span>
														   <span>Attack:<?php echo $rowqpokes['attack']; ?></span>
														   <span>Defense:<?php echo $rowqpokes['defense']; ?></span>
														   <span>HP:<?php echo $rowqpokes['hp']; ?></span>
														   <span>Speed:<?php echo $rowqpokes['speed']; ?></span>
														   <span>Critical:<?php echo $rowqpokes['critical']; ?></span>
														   <span>Accuracy:<?php echo $rowqpokes['accuracy']; ?></span><br/>	

														   <span>
														   
														   <?php 
														   $games = $rowqpokes['win'] + $rowqpokes['lose'];
														   
															if(!empty($games)) {
																echo "Win Rate:".number_format(($rowqpokes['win'] / $games) * 100,2)."%"; 
																echo "<br>"."W/L:".$rowqpokes['win']."/".$games;
															}
														   echo "<br>";
														   
														   
														   ?>
														   
														   </span><br/>	



															<span>Trainer:You</span>														   
														
														</div>
												<?php
													}
												?>	
														
														
												</div>									
											
											</td>
                                            <td>
											
												<div id="poke-container" class="ui cards">

												<?php
												$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE id='{$row['p2poke']}'");		

													while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
												?>	
														<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
														<div class='typedataholder'>
															<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
																<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
															<?php } ?>	
														</div>
														
														   <div class="image">
														   
														   <div class='mainchar  showchar ' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'></div>
														   </div>
														   <h4><?php echo $rowqpokes['pokename']; ?></h4>
														   <p class='idsdata'>
														   <a target='_newtab' href='index.php?pages=viewpoke&pokeid=<?php echo $rowqpokes['hash']; ?>'>
														   ID:#<?php echo $rowqpokes['hash']; ?>
														   </a>
														   </p>
														   <span>Level:<?php echo $rowqpokes['level']; ?></span>
														   <span>Attack:<?php echo $rowqpokes['attack']; ?></span>
														   <span>Defense:<?php echo $rowqpokes['defense']; ?></span>
														   <span>HP:<?php echo $rowqpokes['hp']; ?></span>
														   <span>Speed:<?php echo $rowqpokes['speed']; ?></span>
														   <span>Critical:<?php echo $rowqpokes['critical']; ?></span>
														   <span>Accuracy:<?php echo $rowqpokes['accuracy']; ?></span><br/>		 




														   <span>
														   
														   <?php 
														   $games = $rowqpokes['win'] + $rowqpokes['lose'];
														   
															if(!empty($games)) {
																echo "Win Rate:".number_format(($rowqpokes['win'] / $games) * 100,2)."%"; 
																echo "<br>"."W/L:".$rowqpokes['win']."/".$games;
															}
														   echo "<br>";
														   
														   
														   ?>
														   
														   </span><br/>	

														   
															<span>Trainer: ID#:<?php $x2= loadmember($row['p2user']); echo $x2['fullname'];?></span>	
														</div>
												<?php
													}
													
													if(empty($row['p2poke'])){
														echo "<p>We are still looking for your opponent</p>";
													}
												?>	
														
														
												</div>												
											
											
											</td>
                                            <td>
											
											<?php
											if(!empty($row['winner'])){
											if($row['winner']==$row['p1poke']){
												echo "You";
											}
											if($row['winner']==$row['p2poke']){
												echo "Enemy";
											}
											}
											echo "<hr>";
											if(empty($row['winner'])){
												echo "<br>OnGoing";
											}else{
												echo "<br><a href='index.php?pages=pokebattleview&id={$row['id']}'>View here</a>";
											}
											
											
											
											
											?>
											
											</td>
                                            <td><?php echo $row['battledata']; ?></td>
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


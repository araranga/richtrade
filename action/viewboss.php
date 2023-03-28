<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
 $accounts_id = $_SESSION['accounts_id'];
/*SELECT a.id FROM `tbl_movesv2` as a LEFT JOIN tbl_pokemon_moves as b ON a.id=b.move_id WHERE b.pokemon_id = 1 AND a.power !='' AND b.move_id IN (SELECT move_id FROM `tbl_pokemon_moves` WHERE `pokemon_id` LIKE '1' GROUP by move_id ORDER BY `tbl_pokemon_moves`.`move_id` DESC)  
GROUP by a.id*/
?>



												<?php
												$qpokes = mysql_query_md("SELECT * FROM tbl_bosses WHERE hash='{$_GET['pokeid']}'");		
												$skillsq = $rowqpokes = mysql_fetch_md_assoc($qpokes);
												
												
												$itemquery = "SELECT SUM(qty) as total,itemid FROM `tbl_item_history` WHERE `pokemon_id` LIKE '{$rowqpokes['id']}' GROUP by itemid";

												$itemq = mysql_query_md($itemquery);		
												
												$itemarray = array();
												
												while($itemrow = mysql_fetch_md_assoc($itemq)){
													$itemarray[] = $itemrow;
													
												}
												

												
												
												

														   $games = $rowqpokes['win'] + $rowqpokes['lose'];
														   
															if(!empty($games)) {
																$winrate = number_format(($rowqpokes['win'] / $games) * 100,2)."%"; 
																$wr = "W/L:".$rowqpokes['win']."/".$games;
															}
		
														   
														   ?>
												
												<div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
			
			<div class='typedataholder'>
				<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
					<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
				<?php } ?>	
			</div>			  
			  			
			
              <div class="card-body box-profile">

                <div class="text-center">
<img src='/sprites/boss/<?php echo $rowqpokes['main']; ?>' style='width:100%;'>	   

                </div>
<br>
                <h3 class="profile-username text-center"><?php echo $rowqpokes['pokename']; ?></h3>

                <p class="text-muted text-center">ID:#<?php echo $rowqpokes['hash']; ?></p>
				<p class="text-muted text-center"><strong>Reward: <?php echo $rowqpokes['reward']; ?></strong></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Attack</b> <a class="float-right"><?php echo $rowqpokes['attack']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Defense</b> <a class="float-right"><?php echo $rowqpokes['defense']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>HP</b> <a class="float-right"><?php echo $rowqpokes['hp']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Speed</b> <a class="float-right"><?php echo $rowqpokes['speed']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Critical</b> <a class="float-right"><?php echo $rowqpokes['critical']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Accuracy</b> <a class="float-right"><?php echo $rowqpokes['accuracy']; ?></a>
                  </li>

				  
                </ul>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
				  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Skills</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Battle Records</a></li>
                  
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
					<?php
					
					 $query = "SELECT * FROM tbl_battle_boss as a WHERE p2poke='{$rowqpokes['id']}' ORDER by id DESC";
					 $q = mysql_query_md($query);					
					?>
                    <div>
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Challenger</th>
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
															<div class='mainchar flipme showchar' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'></div>		   
													   </div>
														   <h4><?php echo $rowqpokes['pokename']; ?></h4>
														   <p class='idsdata'>ID:#<?php echo $rowqpokes['hash']; ?></p>
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



															<span>Trainer: ID#:<?php $x1= loadmember($rowqpokes['user']); echo $x1['fullname'];?></span>													   
														
														</div>
												<?php
													}
												?>	
														
														
												</div>									
											
											</td>                                         
                                            <td>
											
											<?php
											if(empty($row['winner'])){
												echo "<br>OnGoing";
											}else{
												echo "<br><a href='index.php?pages=pokebattleview-boss&id={$row['id']}'>View here</a>";
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
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="active tab-pane" id="settings">




<div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Power</th>
                                            <th>Element</th>

                                        </tr>
                                    </thead>
                                    <tbody>


										<tr>
										  <td><?php echo $skillsq['skillname1'];?></td>
										  <td><?php echo $skillsq['power1'];?></td>
										  <td><?php echo $skillsq['element1'];?></td>
										</tr>
										<tr>
										  <td><?php echo $skillsq['skillname2'];?></td>
										  <td><?php echo $skillsq['power2'];?></td>
										  <td><?php echo $skillsq['element2'];?></td>
										</tr>
										<tr>
										  <td><?php echo $skillsq['skillname3'];?></td>
										  <td><?php echo $skillsq['power3'];?></td>
										  <td><?php echo $skillsq['element3'];?></td>
										</tr>										
									                                        
									                                        
									                                        
									 </tbody>
                                </table>
                            </div>
                        </div>
                    </div>














                  </div>
                  <!-- /.tab-pane -->
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
                 			  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
				  
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
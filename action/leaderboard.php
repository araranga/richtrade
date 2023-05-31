<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
 $accounts_id = $_SESSION['accounts_id'];
//$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT *,((win - lose) * 20) as winrate FROM `tbl_pokemon_users` WHERE user IN (SELECT user FROM `tbl_battlelog` where battledata > now() - INTERVAL 10 day AND user NOT IN (SELECT accounts_id FROM `tbl_accounts` WHERE robot = 2) GROUP by user)   ORDER by winrate DESC LIMIT 20");
 //primary query
 $limit = getlimit(20,$_GET['p']);
 $query = "SELECT *,((win - lose) * 20) as winrate FROM `tbl_pokemon_users` WHERE user IN (SELECT user FROM `tbl_battlelog` where battledata > now() - INTERVAL 10 day AND user NOT IN (SELECT accounts_id FROM `tbl_accounts` WHERE robot = 2) GROUP by user)   ORDER by winrate DESC LIMIT 20";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,20);
?>
<h2>Leaderboard</h2>
<div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
<p>Starting: May 2023, User on top 5 will receive bonus monthly.</p>
<p>Top 1: 60 points</p>
<p>Top 2: 35 points</p>
<p>Top 3: 25 points</p>
<p>Top 4-5: 10 points</p>

<p>Formula:  WIN - LOSE * 20 AND must be have battle in last 3 days.</p>
</div>
<audio controls autoplay loop hidden>
    <source src="https://vgmsite.com/soundtracks/pokemon-gameboy-sound-collection/ijviptkm/120-pokemon%20gym.mp3" type="audio/mpeg">
</audio>
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

                                            <th style='width: 314px;'>Player</th>
                                            <th>MMR</th> 

                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$leaderpos = 0;
									while($row=mysql_fetch_md_array($q))
									{
										$leaderpos++;
									?>
                                        <tr>
                                            <td>
											<h3><?php echo $leaderpos;?></h3>
											
												<div id="poke-container" class="ui cards">

												<?php
												$rowqpokes = $row;
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
														</div>
														
														
												</div>									
											
											</td>                                        
                                            <td><span style='font-size: 49px;color: red;'><?php echo $row['winrate']; ?></span></td>
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


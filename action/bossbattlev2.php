<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
 $accounts_id = $_SESSION['accounts_id'];
//$_GET['accounts_id'] = $accounts_id;
 $field = array("transnum","email","username","accounts_id");
 $where = getwheresearch($field);

 $total = countquery("SELECT id FROM tbl_battle_boss WHERE p1user='$accounts_id'");
 //primary query
 $limit = getlimit(10,$_GET['p']);
 $query = "SELECT * FROM tbl_battle_boss as a WHERE p1user='$accounts_id' ORDER by id DESC $limit";

 $q = mysql_query_md($query);
 $pagecount = getpagecount($total,10);
?>
<h2>Battle History</h2>

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
 <style>
.coverrpgvs {
    padding: 10px;
    border-top: 1px solid gray;
    margin: 10px;
    max-width: 584px;
}
</style>
	<style>
	.rowbattlechar2{
		min-height: 150px;
		text-align: center;
		padding-top: 15px;
	}
.battlecharpop2 {
    margin: 0 auto;
}	
.rowbattlechar2 span {
    display: inherit;
    border: 1px solid #a5a0a0;	
    display: none;
	
}	
.popbutton2{
	
    margin-top: 43px;
}


.bname2 {
    font-size: 17px;
    font-weight: 700;
	word-wrap: break-word;
}	

.findingmatch{
	
    font-size: 83px;	
	
}
.rowbattledatedata {
   font-weight: 700;
    padding: 0px;
    border: 1px solid #b9b9b9;
    padding: 7px;
}

@media only screen and (max-width: 900px) {

.bname2 {
    font-size: 15px;
    font-weight: 700;
    height: 64px;
}	
img.vsinfo {
    width: 32px;
    margin-top: 49px;
}
.versusholder.rowbattlechar2 {
	width:100%!important;
}
}

	</style>
                    <div class="panel panel-default" style="<?php if($total==0) { echo "display:none;"; } ?>">

                        <div class="panel-body">
                            <div class="table-responsive">
							<?php 
							
							$modalsm = array();
							while($rowqpoke = mysql_fetch_md_assoc($q)){ 
	$p1 = loadpokev2($rowqpoke['p1poke']);
	$p2 =  mysql_fetch_md_assoc(mysql_query_md("SELECT * FROM tbl_bosses WHERE id='{$rowqpoke['p2poke']}'"));							
							?>
                                <div class='coverrpgvs'>
	<div style='width:100%'>
		<div class='rowbattledatedata'>Battle ID: <?php echo ($rowqpoke['id']); ?>
		<br> Date:<?php echo date("M d, Y h:i A",strtotime($rowqpoke['battledata'])); ?>
		
		
		<?php
		if(!empty($rowqpoke['winner'])){
			$extrasp1 = "";
			$extrasp2 = "";
			
		if($rowqpoke['winner']==$rowqpoke['p1poke']){
			
			$extrasp1 = "win";
			$extrasp2 = "pain";			
			
			echo "<br> Winner:<span style='color:red;'>".$p1['pokename']."</span>";
		}
		if($rowqpoke['winner']==$rowqpoke['p2poke']){
			
			$extrasp2 = "win";
			$extrasp1 = "pain";					
			
			echo "<br> Winner:<span style='color:red;'>".$p2['pokename']."</span>";
		}
		}
		else{
			
			echo "<br><span style='color:green;'>Finding match...</span>";
		}
		?>		
		
		
		</div>
		<div class='rowbattle2'>
		<div class='rowbattlechar2' style='width:30%;float:left;'>




			<?php 
			if(empty($rowqpoke['p1poke'])){
				echo "<div class='findingmatch'>?</div>";
			}else{
				
				$rand = "modalsm".rand();
				$buttonids = $modalsm[$rand] = $p1;
				?>
			<div class='bname2'><?php echo $p1['pokename']; ?></div>
			<div class="mainchar battlecharpop2 flipme <?php echo $extrasp1; ?>" style="background: url('actors/<?php echo $p1['front']; ?>') 0px 0px;height:64px!important;"></div>
		    <p class='idsdata'>ID:# <a href='index.php?pages=viewpoke&pokeid=<?php echo $p1['hash']; ?>'><?php echo $p1['hash']; ?></a></p>	

<button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $rand; ?>">
View Stats
</button>			
				<?php
			}
			?>










			
		</div>
		<div  class='rowbattlechar2' style='width:20%;float:left;'><img class='vsinfo' src='vs.png'></div>
		<div  class='rowbattlechar2' style='width:30%;float:left;'>


			<?php 
			if(empty($rowqpoke['p2poke'])){
				echo "<div class='findingmatch'>?</div>";
			}else{
				
				$rand = "modalsm".rand();
				$p2['is_boss'] = 1;
				$buttonids = $modalsm[$rand] = $p2;				
				
				?>
		    <div class='bname2'><?php echo $p2['pokename']; ?></div>
			<img src="/sprites/boss/<?php echo $p2['main']; ?>" style="height:94px;">	
		     <p class='idsdata'>ID:#<?php echo $p2['hash']; ?></p>		

			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?php echo $rand; ?>">
			View Stats
			</button>	
			 
				<?php
			}
			?>
			
		</div>
		
		<div class='versusholder rowbattlechar2' style='width:20%;float:left;'>
		<?php if(!empty($rowqpoke['winner'])){ ?>
		   <a href='<?php echo "index.php?pages=pokebattleview-boss&id={$rowqpoke['id']}"; ?>' class='btn btn-info btn-lg popbutton2'>Watch</a>
		<?php  } ?>
		 </div>		
		 
		<br style='clear:both;'/>
		</div>

	</div>
	 
	 

								</div>
							<?php } ?>
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



<?php
  foreach($modalsm as $k=>$v){
	  
	  $rowqpokes = $v;
	  ?>
	  

		<div class="modal fade" id="<?php echo $k ?>" aria-hidden="true" style="display: none;">
<div class="modal-dialog modal-sm">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title"><?php echo $rowqpokes['hash']; ?></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
														<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
														<div class='typedataholder'>
															<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
																<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
															<?php } ?>	
														</div>
														
														   <div class="image">
														   <?php if(empty($rowqpokes['is_boss'])) { ?>
														   <div class='mainchar  showchar ' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'></div>
														   <?php } else { ?>
														   <img src="/sprites/boss/<?php echo $rowqpokes['main']; ?>" style="width:100%;">	
														   <?php } ?>
														   </div>
														   
														   
														   <h4><?php echo $rowqpokes['pokename']; ?></h4>
														   <p class='idsdata'>

														   <?php if(empty($rowqpokes['is_boss'])) { ?>
														   <a target='_newtab' href='index.php?pages=viewpoke&pokeid=<?php echo $rowqpokes['hash']; ?>'>
														   ID:#<?php echo $rowqpokes['hash']; ?>
														   </a>
														   <?php } else { ?>
														   ID:#<?php echo $rowqpokes['hash']; ?>
														   <?php } ?>														   
														   
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
														   
														   if(empty($rowqpokes['emblem'])){
															   
															   $rowqpokes['emblem'] = 0;
															   
														   }
														   else{
															  $emb = loademblem($rowqpokes['emblem']); 
															   echo "<strong>Emblem: ".$emb['title_name']."</strong>";
														   }														   
														   ?>
														   
														   </span><br/>	
	
														</div>
</div>
</div>

</div>

		</div>	  
	  
	  <?php
	  
  }
?>
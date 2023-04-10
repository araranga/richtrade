<?php
session_start();
require_once("../connect.php");
require_once("../function.php");

$id = $_SESSION['accounts_id'];
$qpoke = mysql_query_md("SELECT * FROM tbl_battle WHERE (p1user='$id') AND v1 IS NULL AND logs IS NOT NULL");
	
while($rowqpoke = mysql_fetch_md_assoc($qpoke)){
	
	$hash = md5($rowqpoke['id']);
	
	
	$p1 = loadpokev2($rowqpoke['p1poke']);
	$p2 = loadpokev2($rowqpoke['p2poke']);	
?>

	<style>
	.rowbattlechar{
		min-height: 150px;
		text-align: center;
		padding-top: 15px;
	}
.battlecharpop {
    margin-left: 59px;
    margin-top: 21px;
}	
.rowbattlechar span {
    display: inherit;
    border: 1px solid #a5a0a0;	
    display: none;
	
}	
.popbutton{
	
    width: 100%;
    height: 50px;
    margin-top: 30px;
    font-size: 19px!important;	
	
}
.bname {
    font-size: 17px;
    font-weight: 700;
}	
	</style>
	<div style='width:100%'>
		
		<div class='rowbattle'>
		<div class='rowbattlechar' style='width:40%;float:left;'>
			<div class='bname'><?php echo $p1['pokename']; ?></div>
			<div class="mainchar battlecharpop flipme" style="background: url('actors/<?php echo $p1['front']; ?>') 0px 0px;height:64px!important;"></div>
		
			
		   <p class='idsdata'>ID:#<?php echo $p1['hash']; ?></p>
		   <span>Level:<?php echo $p1['level']; ?></span>		   
		   <span>Attack:<?php echo $p1['attack']; ?></span>
		   <span>Defense:<?php echo $p1['defense']; ?></span>
		   <span>Armor:
				<?php foreach(explode("|",$p1['pokeclass']) as $tt) { ?>
				<img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?>
			    <?php } ?>		   
		   </span>
		   <span>HP:<?php echo $p1['hp']; ?></span>
		   <span>Speed:<?php echo $p1['speed']; ?></span>
		   <span>Critical:<?php echo $p1['critical']; ?></span>
		   <span>Accuracy:<?php echo $p1['accuracy']; ?></span>
		   <span>	   
		   <?php 
		   $games = $p1['win'] + $p1['lose'];
		   
			if(!empty($games)) {
				echo "Win Rate:".number_format(($p1['win'] / $games) * 100,2)."%"; 
				echo "<br>"."W/L:".$p1['win']."/".$games;
			}
		   echo "<br>";
		   
		   
		   
		   if(empty($p1['emblem'])){
			   
			   $p1['emblem'] = 0;
			   
		   }
		   else{
			  $emb = loademblem($p1['emblem']); 
			   echo "<strong>Emblem: ".$emb['title_name']."</strong>";
		   }

		   ?>		   						
		</div>
		<div  class='rowbattlechar' style='width:20%;float:left;'><img src='vs.png'></div>
		<div  class='rowbattlechar' style='width:40%;float:left;'>
		    <div class='bname'><?php echo $p2['pokename']; ?></div>
			<div class="mainchar battlecharpop" style="background: url('actors/<?php echo $p2['front']; ?>') 0px 0px;height:64px!important;"></div>
			
		   <p class='idsdata'>ID:#<?php echo $p2['hash']; ?></p>
		   <span>Level:<?php echo $p2['level']; ?></span>		   
		   <span>Attack:<?php echo $p2['attack']; ?></span>
		   <span>Defense:<?php echo $p2['defense']; ?></span>
		   <span>Armor:
				<?php foreach(explode("|",$p2['pokeclass']) as $tt) { ?>
				<img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?>
			    <?php } ?>			   
		   </span>		   
		   <span>HP:<?php echo $p2['hp']; ?></span>
		   <span>Speed:<?php echo $p2['speed']; ?></span>
		   <span>Critical:<?php echo $p2['critical']; ?></span>
		   <span>Accuracy:<?php echo $p2['accuracy']; ?></span>
		   <span>	   
		   <?php 
		   $games = $p2['win'] + $p2['lose'];
		   
			if(!empty($games)) {
				echo "Win Rate:".number_format(($p2['win'] / $games) * 100,2)."%"; 
				echo "<br>"."W/L:".$p2['win']."/".$games;
			}
		   echo "<br>";
		   
		   
		   
		   if(empty($p2['emblem'])){
			   
			   $p2['emblem'] = 0;
			   
		   }
		   else{
			  $emb = loademblem($p2['emblem']); 
			   echo "<strong>Emblem: ".$emb['title_name']."</strong>";
		   }

		   ?>				
			
		</div>
		<br style='clear:both;'/>
		</div>
	</div>
	 
	 
     <input class="btn btn-info btn-lg popbutton" type="button" onclick="window.location='<?php echo "index.php?pages=pokebattleview&id={$rowqpoke['id']}&v=1"; ?>'" name="battle" value="Watch now">	
	
<?php
exit();
}

$qpoke = mysql_query_md("SELECT * FROM tbl_battle WHERE (p2user='$id') AND v2 IS NULL AND logs IS NOT NULL");
	
while($rowqpoke = mysql_fetch_md_assoc($qpoke)){
	$hash = md5($rowqpoke['id']);
	//mysql_query_md("UPDATE tbl_battle SET v2 = 1 WHERE id = {$rowqpoke['id']}");
	
	
	
	$p1 = loadpokev2($rowqpoke['p1poke']);
	$p2 = loadpokev2($rowqpoke['p2poke']);
	?>

	<style>
	.rowbattlechar{
		min-height: 150px;
		text-align: center;
		padding-top: 15px;
	}
.battlecharpop {
    margin-left: 59px;
    margin-top: 21px;
}	
.rowbattlechar span {
    display: inherit;
    border: 1px solid #a5a0a0;	
    display: none;
	
}	
.popbutton{
	
    width: 100%;
    height: 50px;
    margin-top: 30px;
    font-size: 19px!important;	
	
}
.bname {
    font-size: 17px;
    font-weight: 700;
}	
	</style>
	<div style='width:100%'>
		
		<div class='rowbattle'>
		<div class='rowbattlechar' style='width:40%;float:left;'>
			<div class='bname'><?php echo $p1['pokename']; ?></div>
			<div class="mainchar battlecharpop flipme" style="background: url('actors/<?php echo $p1['front']; ?>') 0px 0px;height:64px!important;"></div>
		
			
		   <p class='idsdata'>ID:#<?php echo $p1['hash']; ?></p>
		   <span>Level:<?php echo $p1['level']; ?></span>		   
		   <span>Attack:<?php echo $p1['attack']; ?></span>
		   <span>Defense:<?php echo $p1['defense']; ?></span>
		   <span>Armor:
				<?php foreach(explode("|",$p1['pokeclass']) as $tt) { ?>
				<img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?>
			    <?php } ?>		   
		   </span>
		   <span>HP:<?php echo $p1['hp']; ?></span>
		   <span>Speed:<?php echo $p1['speed']; ?></span>
		   <span>Critical:<?php echo $p1['critical']; ?></span>
		   <span>Accuracy:<?php echo $p1['accuracy']; ?></span>
		   <span>	   
		   <?php 
		   $games = $p1['win'] + $p1['lose'];
		   
			if(!empty($games)) {
				echo "Win Rate:".number_format(($p1['win'] / $games) * 100,2)."%"; 
				echo "<br>"."W/L:".$p1['win']."/".$games;
			}
		   echo "<br>";
		   
		   
		   
		   if(empty($p1['emblem'])){
			   
			   $p1['emblem'] = 0;
			   
		   }
		   else{
			  $emb = loademblem($p1['emblem']); 
			   echo "<strong>Emblem: ".$emb['title_name']."</strong>";
		   }

		   ?>		   						
		</div>
		<div  class='rowbattlechar' style='width:20%;float:left;'><img src='vs.png'></div>
		<div  class='rowbattlechar' style='width:40%;float:left;'>
		    <div class='bname'><?php echo $p2['pokename']; ?></div>
			<div class="mainchar battlecharpop" style="background: url('actors/<?php echo $p2['front']; ?>') 0px 0px;height:64px!important;"></div>
			
		   <p class='idsdata'>ID:#<?php echo $p2['hash']; ?></p>
		   <span>Level:<?php echo $p2['level']; ?></span>		   
		   <span>Attack:<?php echo $p2['attack']; ?></span>
		   <span>Defense:<?php echo $p2['defense']; ?></span>
		   <span>Armor:
				<?php foreach(explode("|",$p2['pokeclass']) as $tt) { ?>
				<img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?>
			    <?php } ?>			   
		   </span>		   
		   <span>HP:<?php echo $p2['hp']; ?></span>
		   <span>Speed:<?php echo $p2['speed']; ?></span>
		   <span>Critical:<?php echo $p2['critical']; ?></span>
		   <span>Accuracy:<?php echo $p2['accuracy']; ?></span>
		   <span>	   
		   <?php 
		   $games = $p2['win'] + $p2['lose'];
		   
			if(!empty($games)) {
				echo "Win Rate:".number_format(($p2['win'] / $games) * 100,2)."%"; 
				echo "<br>"."W/L:".$p2['win']."/".$games;
			}
		   echo "<br>";
		   
		   
		   
		   if(empty($p2['emblem'])){
			   
			   $p2['emblem'] = 0;
			   
		   }
		   else{
			  $emb = loademblem($p2['emblem']); 
			   echo "<strong>Emblem: ".$emb['title_name']."</strong>";
		   }

		   ?>				
			
		</div>
		<br style='clear:both;'/>
		</div>
	</div>
	 
	 
     <input class="btn btn-info btn-lg popbutton" type="button" onclick="window.location='<?php echo "index.php?pages=pokebattleview&id={$rowqpoke['id']}&v=2"; ?>'" name="battle" value="Watch now">	
	
	<?php
	exit();
}	

?>
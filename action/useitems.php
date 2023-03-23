<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);



$release = array();
$release[] = "Select Item";


$release2 = array();


$myuser = $_SESSION['accounts_id'];
$qpokesasd = mysql_query_md("SELECT a.*,b.title_name FROM tbl_item_history as a JOIN tbl_items as b ON a.itemid=b.id WHERE a.accounts_id='$myuser' AND a.is_use=0 ORDER by b.title_name");		

	while($rowqpokesxasd = mysql_fetch_md_assoc($qpokesasd)) {
		$release2[$rowqpokesxasd['id']] = $rowqpokesxasd['title_name']." - ".$rowqpokesxasd['transnum'];
	}



$q2 = mysql_query_md("SELECT * FROM `tbl_pokemon_users` WHERE user='{$_SESSION['accounts_id']}' ORDER by level ASC");
while($row2 = mysql_fetch_md_assoc($q2)){
	$release[$row2['id']] = "Level {$row2['level']} :"."-- ".$row2['pokename']." - ".$row2['hash'];
}

	if($_POST['submit']!='')
	{

		if($_POST['password']!=$row['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Password do not match.<br>";
		}

		foreach($_POST['items'] as $k){
			
			
			    $itemx = loaditemuser($k);
				$poketarget = $_POST['pokeid'];
				
				$_GET['pokeid'] = $poketarget;
				if(!empty($itemx['id'])){
					if($itemx['is_use']==0){
					
					$itemxdata = loaditem($itemx['itemid']);
					
					$datavalue = $itemxdata['datavalue'];
					$targetattr = $itemxdata['target_attr'];
					
					$success = 1;
					if($targetattr!='level' && $targetattr!='allstat'){
						
						mysql_query_md("UPDATE tbl_pokemon_users SET $targetattr = $targetattr + $datavalue WHERE id='$poketarget'");
						mysql_query_md("UPDATE tbl_item_history SET is_use=1,pokemon_id=$poketarget WHERE id='$k'");
					
					}
					
					else{
						if($targetattr=='level'){
							$levelrate = loadpokev2($poketarget);
							pokelevelup($poketarget,$levelrate['rate']);
							mysql_query_md("UPDATE tbl_item_history SET is_use=1,pokemon_id=$poketarget WHERE id='$k'");
							mysql_query_md("UPDATE tbl_pokemon_users SET exp = exp + 5 WHERE id='$poketarget'");
							
						}
						
						
						if($targetattr=='allstat'){
							
							$stats = array('attack','defense','hp','speed','critical','accuracy');
							
							$fieldx = array();
							
							
							foreach($stats as $ss){
								$fieldx[] = "$ss = $ss + $datavalue";
							}
							
							$fiedlquery = implode(",",$fieldx);
							
							//$levelrate = loadpokev2($poketarget);
							mysql_query_md("UPDATE tbl_item_history SET is_use=1,pokemon_id=$poketarget WHERE id='$k'");
							mysql_query_md("UPDATE tbl_pokemon_users SET $fiedlquery WHERE id='$poketarget'");
							
						}						
						
						
						
					}
					
					
						
					}
				
				}
			
		}

		
		
	}


$release = array();
$release[] = "Select Item";


$release2 = array();


$myuser = $_SESSION['accounts_id'];
$qpokesasd = mysql_query_md("SELECT a.*,b.title_name FROM tbl_item_history as a JOIN tbl_items as b ON a.itemid=b.id WHERE a.accounts_id='$myuser' AND a.is_use=0 ORDER by b.title_name");		

	while($rowqpokesxasd = mysql_fetch_md_assoc($qpokesasd)) {
		$release2[$rowqpokesxasd['id']] = $rowqpokesxasd['title_name']." - ".$rowqpokesxasd['transnum'];
	}



$q2 = mysql_query_md("SELECT * FROM `tbl_pokemon_users` WHERE user='{$_SESSION['accounts_id']}'");
while($row2 = mysql_fetch_md_assoc($q2)){
	$release[$row2['id']] = "Level {$row2['level']} :"."-- ".$row2['pokename']." - ".$row2['hash'];
}

?>
<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done applying items.</li></ul></div>
<?php
}
?>
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>
<style>
.ui.card, .ui.cards>.card {
	width:183px;
	    margin-left: 36px;
}
</style>
<?php


$field = array();
$field[] = array("type"=>"select","value"=>"pokeid","label"=>"Fighters","option"=>$release,"attributes"=>array("onchange"=>"itemshow()"));
//$field[] = array("type"=>"number","value"=>"qty","label"=>"Qty","option"=>$release);
$field[] = array("type"=>"select","value"=>"items[]","label"=>"Items","option"=>$release2,"attributes"=>array("multiple"=>""));
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
?>
<h1>Apply Items To Fighters</h1>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?><?php if(!empty($_GET['pokeid'])) { echo "&pokeid={$_GET['pokeid']}";} ?>'>
         <?php echo loadform($field,$_GET); ?>
		 


<div id="poke-container" class="ui cards">

<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$myuser'");		

	while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
?>	
		<div id='pokemon-<?php echo $rowqpokes['id']; ?>' class="ui card itemshops" style='width:250px;display:none'>
		<div class='typedataholder'>
			<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
				<div class='typesdata <?php echo $tt; ?>'><?php echo ucfirst($tt); ?></div>
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

		</div>
<?php
	}
?>	
		
		
</div>


<hr>	 
		 
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Use Item'></center>
      </form>
   </div>
</div> 


<script>
function itemshow(){
	jQuery('.itemshops').hide();
	if(jQuery('#pokeid').val()!=0){
		jQuery('#pokemon-'+jQuery('#pokeid').val()).show();
	}
}


  setTimeout(function(){
        itemshow();
    }, 500);
</script>

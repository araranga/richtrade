﻿<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$id = $_GET['id'];
$query = "SELECT * FROM tbl_battle WHERE id ='$id'";
$q = mysql_query_md($query);
$count = mysql_num_rows_md($q);
$row = mysql_fetch_md_assoc($q);


$logs = json_decode($row['logs'],true);


if(!empty($_GET['v']))
{
	if($_GET['v']==1){

		mysql_query_md("UPDATE tbl_battle SET v1='1' WHERE id ='$id'");
	}else{
		 mysql_query_md("UPDATE tbl_battle SET v2='1' WHERE id ='$id'");
	}
	
	
	
	
	
}


	$p1 = loadpokev2($logs[0]['dealer']);
	
	if($logs[0]['dealer']==$row['p1poke']){
		$p2play = $row['p2poke'];
	}
	if($logs[0]['dealer']==$row['p2poke']){
		$p2play = $row['p1poke'];
	}
	
	$p2 = loadpokev2($p2play);

$winmsg = "You Lose";
if($_SESSION['accounts_id']==$row['p1user']){
	mysql_query_md("UPDATE tbl_battle SET v1='1' WHERE id ='$id'");
	
	if($row['winner']==$row['p1poke']){
		$winmsg = "You Win";
	}	
	
}
if($_SESSION['accounts_id']==$row['p2user']){
	mysql_query_md("UPDATE tbl_battle SET v2='1' WHERE id ='$id'");
	
	if($row['winner']==$row['p2poke']){
		$winmsg = "You Win";
	}	
	
}

		if($row['winner']==$row['p2poke']){
			$loser_id = $row['p1poke'];
		}
		if($row['winner']==$row['p1poke']){
			$loser_id = $row['p2poke'];
		}	
$champion_id = $row['winner'];

?>

<?php

	
	
	

?>


<h2 style='word-break: break-all;'>Battle View ID#: <p><?php echo md5($_GET['id']); ?></p></h2>
<style>

@media screen and (max-width: 600px) {
.heroffsdmg{
	font-size:8px!important;
}
#heroeffs {
  margin-left:-28px!important;

}
.effectsrpg {
    width: 25px;
    height: 25px;
}
#enemyeffs {
  margin-left:117px!important;
}


.stadium {
    width: 289px!important;
    padding: 0px;
	background-position: 417px 427px!important;
}
.char h2 {
    font-size: 12px;
}

.char .data p {
    font-size:10px;
}


#dimScreen {
        width: 288px!important;
}

.btmsg {

    margin-left: -40px!important;
	
}

.prebattle {

    padding-top: 112px!important;
    margin-left: 22px!important;
}

}



.stadium{
width: 892px;
padding: 25px;
    overflow: hidden;
	max-height:340px;
}
body {
  font-family: "helvetica neue", helvetica, arial, sans-serif;
  font-size: 16px;
  padding-top: 30px;
}

header {
  text-align: center;
}
header img {
  max-height: 100px;
  cursor: pointer;
}

strong {
  font-weight: 600;
  line-height: 1.5em;
}

.type {
  display: inline-block;
  height: 30px;
  width: 30px;
  margin: 10px;
  background-image: url("http://orig15.deviantart.net/24d8/f/2011/057/3/5/ge___energy_type_icons_by_aschefield101-d3agp02.png");
  background-repeat: no-repeat;
  background-size: 500% 400%;
}
.type.electric {
  background-position: 100% 0;
}
.type.fire {
  background-position: 25% 33%;
}
.type.water {
  background-position: 63% 100%;
}
.type.grass {
  background-position: 100% 33%;
}
.type.fighting {
  background-position: 0 33%;
}

.row {
  display: block;
  min-height: 50px;
}

.instructions {
  text-align: center;
  padding: 20px 0;
}
.instructions p {
  font-size: 2em;
}

.characters {
  display: flex;
  justify-content: space-around;
  transition: visibility 0.3s ease, opacity 0.3s ease, height 0.3s ease;
}
.characters.hidden {
  visibility: hidden;
  opacity: 0;
  height: 0;
}

.char-container {
  width: 25%;
  text-align: center;
  padding: 25px 0;
  cursor: pointer;
}
.char-container img {
  max-height: 100px;
  margin-bottom: 13px;
  transition: transform 0.3s ease, margin 0.3s ease;
}
.char-container h2 {
  text-transform: capitalize;
  font-size: 1.5em;
  font-weight: 600;
  transition: font-size 0.3s ease;
}
.char-container:hover img {
  transform: scale(1.3);
  margin-bottom: 17px;
}
.char-container:hover h2 {
  font-size: 1.2em;
}
<?php
$dirname = "sprites/arena/";
$images = glob($dirname."*.png");
$countavatar = 0;
foreach($images as $image) {
    $finalimg = str_replace($dirname,"",$image);
	$character[$finalimg] = $finalimg;
}
?>	
.stadium {
  background: url('/sprites/arena/<?php echo array_rand($character); ?>') 175px 521px;
 
    border-radius: 24px;
}
.stadium > section {
  display: block;
  box-sizing: border-box;
}
.stadium > section .char {
  height: 175px;
  width:100%;

}
.stadium > section .char > * {

  text-transform: capitalize;
}
.stadium > section .char img {
  height: 150px;
}
.stadium > section .char .data {
  background: #CCC;
  width: 95%;
  padding: 15px 2%;
  box-sizing: border-box;
  top: 25px;
  border-radius: 24px;
}
.stadium > section .char .data progress {
  width: 100%;
}
.stadium > section .char .data p {
  text-align: right;
}

.attack-list {
  display: flex;
  flex-wrap: wrap;
  background: #FFFAFA;
  position: initial;
  transtion: opacity 0.3s ease;
  text-transform: capitalize;
}
.attack-list.disabled {
  opacity: 0.5;
  position: relative;
  z-index: -1;
  cursor: initial;
}
.attack-list li {
  width: 50%;
  text-align: center;
  padding: 25px 0;
  box-sizing: border-box;
  border: 1px solid #666;
  cursor: pointer;
  transition: background 0.3s ease;
}
.attack-list li:hover {
  background: #EEE;
}

.modal-out {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  width: 100vw;
  background: rgba(33, 33, 33, 0.75);
  z-index: 900;
}
.modal-out .modal-in {
  position: fixed;
  top: 15vh;
  left: 0;
  right: 0;
  width: 50vw;
  height: 70vh;
  margin: 0 auto;
  background: #FFFAFA;
}
.modal-out .modal-in header {
  position: relative;
  min-height: 30px;
  text-align: center;
  padding: 10px 3%;
  box-sizing: border-box;
}
.modal-out .modal-in header h1 {
  font-size: 2.2em;
}
.modal-out .modal-in .close {
  cursor: pointer;
  position: absolute;
  top: 13px;
  right: 13px;
}
.modal-out .modal-in section {
  box-sizing: border-box;
  padding: 25px 3%;
}

div#battlelogs {
    border: 1px solid black;
    padding: 10px;
    margin-top: 14px;
	min-height:160px;

}

.btllogs {
    border: 1px solid red;
    padding: 2px;
    margin-top: 6px;
	display:none;
}

.battlemsg {
    width: 600px;
    padding: 20px;
    position: absolute;
    z-index: 999;
	display:none;
}

.btmsg {
    width: 50%;
    background: #b7b1b1;
    padding: 10px;
    height: 121px;
    margin-left: 248px;
    text-align: center;
    padding-top: 39px;
    margin-top: 18px;
}

.fadebattle {
	opacity:0.3;
}

#dimScreen {
    width: 915px;
    height: 351px;
    padding: 20px;
    position: absolute;
    z-index: 999;
    background: rgba(0,0,0,0.5);
}

.prebattle {
    margin: 0 auto;
    width: 243px;
    font-size: 51px;
    color: white;
    padding-top: 118px;
}

#showfight{
	font-size:30px;
}

.rpg{
    float: left;
    width: 50%;
    text-align: center;	
}

.rpg2 {
    width: 148px;
    text-align: center;
    margin: 0 auto;
    padding-top: 55px;
}
.rpgleft{
	float:left;
}
.rpgright{
	float:right;
}



.effectsrpg {
    width: 25px;
    height: 25px;
}

#heroeffs {
  margin-left:-67px;margin-top:-30px;
  position:absolute;

}

#enemyeffs {
  margin-left:152px;margin-top:-30px;
  position:absolute;

}
.heroffsdmg{
font-size: 15px;
    color: red;
    background-color: black;
    font-weight: 700;
    padding: 3px;
}
</style>

<audio controls autoplay loop hidden>
    <source src="https://vgmsite.com/soundtracks/pokemon-gameboy-sound-collection/jucncspp/115-battle%20%28vs%20trainer%29.mp3" type="audio/mpeg">
</audio>

<div id="dimScreen">
	<div class='prebattle'><button id='showfight' type="button" onclick="showfight()" class="btn btn-primary">Show Fight!</button></div>
</div>


<section class="stadium">
<div class='battlemsg'>
	<div class='btmsg'><h2><?php echo $winmsg; ?></h2></div>
</div>


<section>
    <section class="hero rpg">
      <section class="char">

          
         <aside class="data rpgleft">
            <h2>
			<?php echo $p1['pokename']; ?>		
			</h2>
			<p><?php $x2= loadmember($p1['user']); echo $x2['fullname'];?></p>
            <div>
               <progress id='progressp2' max="<?php echo $p1['hp']; ?>" value="<?php echo $p1['hp']; ?>"></progress>
               <p><span id='progressp2txt'><?php echo $p1['hp']; ?></span>/<?php echo $p1['hp']; ?></p>
            </div>
         </aside>
      </section>
   </section> 




   <section class="enemy rpg">
      <section class="char">

          
         <aside class="data rpgleft">
            <h2>
			<?php echo $p2['pokename']; ?>
			</h2>
			<p><?php $x2= loadmember($p2['user']); echo $x2['fullname'];?></p>
            <div>
               <progress id='progressp1' max="<?php echo $p2['hp']; ?>" value="<?php echo $p2['hp']; ?>"></progress>
               <p><span id='progressp1txt'><?php echo $p2['hp']; ?></span>/<?php echo $p2['hp']; ?></p>
            </div>
         </aside>

      </section>
   </section>
   <br style='clear:both;'/>
</section>

		 <div class='rpgcov rpg2'>
		 
		<div class='herocover'>
		 <div id='heroeffs'>
		 
		 </div>
		 <div id='userhero<?php echo $p1['id']; ?>' class='heroc mainchar flipme rpgleft' style='background: url(/actors/<?php echo $p1['front']; ?>) 0px 0px;'></div>
        
		</div>

		<div class='enemycover'>
		  <div id='enemyeffs'>
		  </div>
		 <div id='userhero<?php echo $p2['id']; ?>' class='enemyc mainchar rpgleft' style='background: url(/actors/<?php echo $p2['front']; ?>) 0px 0px;'></div>
		</div>
		 

		 <br style='clear:both;'/>
		 </div>


	  
	  

   	  
	  
 
   <br style='clear:both;'/>
</section>


<script>
function p2atk(){
  $(".enemyc").removeClass('pain');
  $(".heroc").removeClass('battle');  
  $(".enemyc").addClass('battle');	
  $(".enemyc").animate(
    {
      "margin-right": "-30px",
      "margin-top": "-10px"
    },
    50,
    "swing"
  );
  $(".enemyc").animate(
    {
      "margin-right": "30px",
      "margin-top": "10px"
    },
    50,
    "swing"
  );
  $(".enemyc").animate(
    {
      "margin-right": "0px",
      "margin-top": "0px"
    },
    50,
    "swing"
  );	
  
 $(".heroc").addClass('pain');
}


function p1atk(){
  $(".heroc").removeClass('pain');
  $(".enemyc").removeClass('battle');  
  $(".heroc").addClass('battle');
    $(".heroc").animate(
      {
        "margin-left": "-30px",
        "margin-top": "10px"
      },
      50,
      "swing"
    );
    $(".heroc").animate(
      {
        "margin-left": "30px",
        "margin-top": "-10px"
      },
      50,
      "swing"
    );
    $(".heroc").animate(
      {
        "margin-left": "0px",
        "margin-top": "0px"
      },
      50,
      "swing"
    );	
	
	$(".enemyc").addClass('pain');
	
}
function showfight(){
	
	jQuery('#showfight').hide();
	jQuery('#dimScreen').hide();


	$( ".btllogs" ).each(function( index ) {
		setTimeout(function(){
			  var abc = "#blogs"+(index+1);
			  
			  var turn = jQuery(abc).attr('data-turn');
			  var dealer = jQuery(abc).attr('data-dealer');
			  var enemyhp = jQuery(abc).attr('data-enemyhp');
			  var dataturn = jQuery(abc).attr('data-turn');
			  var notes = jQuery(abc).attr('data-notes');
		      console.log(jQuery(abc).text());
			jQuery('#battlelogs').append("<br> Round"+jQuery(abc).attr('data-round')+" --"+notes);
			  
			  jQuery('#heroeffs').html('');
			  jQuery('#enemyeffs').html('');
//<span class='heroffsdmg'></span>	

//		  

var skillname = jQuery(abc).attr('data-skill');
var elementdata = jQuery(abc).attr('data-element');
var datadamage = jQuery(abc).attr('data-damage');

if (elementdata === undefined) {
	var elementdata = 'na';
}

if(datadamage=='0'){
	datadamage = 'Dodge!!';
}
	
				var imageele = '';
				if(elementdata!='na'){
					imageele = "<img src='/sprites/type/"+elementdata+".png' class='effectsrpg'>";
				}
				
	
			  if(turn==1){
				// 		

				
			    jQuery('#heroeffs').html("<span class='heroffsdmg'>"+imageele+skillname+"</span>");
				
				jQuery('#enemyeffs').html("<span class='heroffsdmg'> -"+datadamage+"</span>");  
                     				
				p1atk(); 
				jQuery('#progressp1').attr('value',enemyhp);
				jQuery('#progressp1txt').text(enemyhp);	

				
			  }else{
				  
				jQuery('#enemyeffs').html("<span class='heroffsdmg'>"+imageele+skillname+"</span>"); 
                jQuery('#heroeffs').html("<span class='heroffsdmg'> -"+datadamage+"</span>");				
				p2atk(); 
				jQuery('#progressp2').attr('value',enemyhp);
				jQuery('#progressp2txt').text(enemyhp);
				
				
				
			  }
		},2000 * (index+1)); 	  	  	    	    
	});	
	setTimeout(function(){
		jQuery('.battlemsg').fadeIn();
		jQuery('.hero').addClass('fadebattle');
		jQuery('.enemy').addClass('fadebattle');
		
		jQuery('#userhero<?php echo $loser_id; ?>').removeClass('pain').removeClass('battle').addClass('death');
		jQuery('#userhero<?php echo $champion_id; ?>').removeClass('pain').removeClass('battle').addClass('win');
	    //jQuery('#heroeffs').html('');
	    //jQuery('#enemyeffs').html('');		
		
		
		
	},2200 * (jQuery('.btllogs').length));
	
}
</script>


<?php
	
	$logc = 1;
	$round = 1;
	
	$turntime = 0;
	foreach($logs as $a){
		
		
		
		if($p1['id']==$a['dealer']){
			$turn = 1;
		}else{
			$turn = 2;
		}
	
		if($turntime % 2 == 0)  {
			$round++;
		}
	
		$turntime++;
	
	
		if(empty($a['element'])){
			$a['element'] = 'na';
		}
	?>
	
	<div id='blogs<?php echo $logc ?>' class='btllogs' data-skill='<?php echo $a['skillname']; ?>' data-element='<?php echo $a['element']; ?>' data-round='<?php echo $round - 1; ?>' data-turn='<?php echo $turn; ?>' data-dealer='<?php echo $a['dealer']; ?>' data-enemyhp='<?php echo $a['enemyhp']; ?>' data-damage='<?php echo $a['damage']; ?>' data-notes='<?php for ($x = 1; $x <= $round; $x++) { echo ">>>"; } ?><?php echo htmlentities(implode(" , ",$a['notes'])); ?>'>
	Turn <?php echo $logc ?>:
	</div>
	<?php
		$logc++;
	}
?>
<h2>Battle Logs:</h2>
<div id='battlelogs'>
</div>
<br style='clear:both;'/>

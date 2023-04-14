<?php
session_start();
require_once("./connect.php");
require_once("./function.php");

  $is_active = 1;

  if(empty($_SESSION['deadline'])){
      $is_active = 0;
  }else

  {

$today = date("Y-m-d h:i:s");
$expire = $_SESSION['deadline']; //from database

$today_time = strtotime($today);
$expire_time = strtotime($expire);

if ($expire_time < $today_time) { 

     $is_active = 0;
 }

}

$countdown = strtotime($_SESSION['deadline']);


$cdtest =  date("M d, Y h:i:s",$countdown);


$levelimit = $_SESSION['level'] + 9;
$path = $_SESSION['path'];
$aid = $_SESSION['accounts_id'];
$query_dl = "SELECT COUNT(accounts_id) as c FROM `tbl_accounts` WHERE path LIKE '{$path}%' AND level <= $levelimit ORDER BY `accounts_id` ASC";
$rowdl = mysql_fetch_md_array(mysql_query_md($query_dl));



 $query_ob = "SELECT SUM(amount) as c FROM `tbl_bonus_history` WHERE sid='{$_SESSION['accounts_id']}'";
$rowob = mysql_fetch_md_array(mysql_query_md($query_ob));


$query_dr = "SELECT COUNT(accounts_id) as c FROM `tbl_accounts` WHERE refer='{$_SESSION['accounts_id']}'";
$rowdr = mysql_fetch_md_array(mysql_query_md($query_dr));



if(empty($rowob['c'])){
  $rowob['c'] = 0;
}

$rowob['c'] = number_format($rowob['c'],2);

$current = date("Y-m-d");
$user = $_SESSION['accounts_id'];
$queryx = "SELECT * FROM tbl_battlelog WHERE user='$user' AND battledata LIKE '%$current%'";
$qx = mysql_query_md($queryx);
$countx = mysql_num_rows_md($qx);


$pokemons = mysql_num_rows_md(mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$user'"));
?>





<div class="row">
          <!-- ./col -->
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $pokemons; ?> / 6</h3>

                <p>Warriors</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo number_format(getcoin(),6); ?></h3>

                <p>Current Conversion</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-12 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
			  
<?php

$loaduser = loadmember($_SESSION['accounts_id']);
$battlebonus = 0;
	//check for subscription
 $date_now = new DateTime();
 $date2    = new DateTime($loaduser['deadline']);

if ($date_now > $date2) {
	$battlebonus = 0;
}
else{
	$battlebonus = $loaduser['deadline_bonus'];
}	

?>			  
			  
			  
			  
                <h3><?php echo $countx; ?> / <?php echo systemconfig("battlelimit") + $battlebonus; ?></h3>

                <p>Battle Energy</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>


<div class="callout callout-success" style='border-left-color: #f012be!important;'>

<div class="info-box">


              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                 		<div style='float:left;background-position: 1006px 145px!important;background: url(/sprites/npc/1.png) 0px 143px; width: 144px;height: 144px;border: 1px solid;border-radius: 64px;'></div>
						<p>Want more energy? purchase <a href='index.php?pages=activate' style='color:black!important;'>here!</a></p>
                </span>
              </div>
              <!-- /.info-box-content -->
</div>
</div>


<div class="callout callout-success">
      <h5>Your Wallet:</h5>
<div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-wallet"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                 		<?php echo number_format($_SESSION['balance'],2); ?>
                </span>
              </div>
              <!-- /.info-box-content -->
</div>
</div>


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


<?php if($pokemons==0) { ?>
<button id='nohero' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-nohero" style='display:none'>
                  Launch Primary Modal
</button>
	

<div class="modal fade" id="modal-nohero" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>			
            <div id='battlebodyhero' class="modal-body">
              <div class='kaira' style='float:left'></div>
			  <p>Hi I'm <strong>Kaira</strong>,
			  <br> It seems you are new to the <strong>PocketFighterZ World</strong>. Why don't you start here(<a href='/index.php?pages=catch'>CLICK ME</a>)
			  to hire a fighter to help you gain Coins and win some battles.
			  
			  
			  </p>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>	
<?php } ?>








<hr>
<h2>Your Warriors</h2>

<?php

$noemblems = mysql_num_rows_md(mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$user' AND emblem IS NULL AND (is_market IS NULL OR is_market = '')"));

?>

<?php if($noemblems>0) { ?>
<button id='noemblem' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-noemblem" style='display:none'>
                  Launch Primary Modal
</button>
	

<div class="modal fade" id="modal-noemblem" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>			
            <div id='battlebodyhero' class="modal-body">
              <div class='kaira' style='float:left; background-position:287px 144px!important;'></div>
			  <p>Hi I'm <strong>Julia</strong>,
			  <br>The new patch added some battle mechanism which <strong>Emblem</strong>.
			   Add the emblem of each of your warrior in <strong>My Fighters > Click Update Emblem on each Warrior available</strong>. This emblem system will help you win more on some battles. 
			   Good luck!
			  
			  
			  </p>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>	
<?php } ?>




<style>
.kaira{
    background: url(/sprites/npc/1.png) 0px 143px;
    width: 144px;
    height: 144px;
    border: 1px solid;
    border-radius: 64px;
	    margin: 21px;
}
</style>




<div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              You can battle 1 at a time only per hero. Please wait to load again.<br/>
			  <strong>Energy reset every 12AM PHT.</strong>
			  <br>
			  
			  <strong>Heroes will level every 6 wins of battle</strong>
</div>

<div id='pokemonjs' style='display:none;'></div>
<div id="poke-container" class="ui cards">
<style>
#overlayx {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}

#sellnowtoday {
    display: none;
}
</style>
<div id="overlayx">
</div>


<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$myuser'");		

	while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
?>	
		<div id='poke-<?php echo $rowqpokes['hash']; ?>' class="ui card">
		
		<div class='typedataholder'>
			<?php foreach(explode("|",$rowqpokes['pokeclass']) as $tt) { ?>
				
				<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
			<?php } ?>	
		</div>
		   <?php 
			if(empty($rowqpokes['weapon'])){
				$rowqpokes['weapon'] = "sword";
			}
		   ?>		
		   <div class="image">  
				<div class='mainchar flipme showcharbattle battle' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'>
					<div class='itemweapon itemweapon-<?php echo $rowqpokes['weapon']; ?>'></div>
				</div>		   
		   </div>
		   <hr>
		   <?php
			$levelnxt = ($rowqpokes['exp'] - (($rowqpokes['level']) * 6));
			$levelnxt2 = round(($levelnxt + 6) / 6,2) * 100;			   
			
			if($levelnxt2<=0){
				$levelnxt2 = 1;
			}
			
		   ?>		 
		   EXP need to LVL <?php echo ($rowqpokes['level'] +  1); ?>(<?php echo $levelnxt2; ?>%):
		   <progress id="progress<?php echo $rowqpokes['hash']; ?>" value="<?php echo $levelnxt2; ?>" max="100"> <?php echo $levelnxt; ?>% </progress>				   
		   <hr>	
		   <h4><?php echo $rowqpokes['pokename']; ?></h4>
		   <p class='idsdata'>ID:#<?php echo $rowqpokes['hash']; ?></p>
		   <span>Level:<?php echo $rowqpokes['level']; ?></span>
   		   
		   <span>Attack:<?php echo $rowqpokes['attack']; ?></span>
		   <span>Defense:<?php echo $rowqpokes['defense']; ?></span>
		   <span>HP:<?php echo $rowqpokes['hp']; ?></span>
		   <span>Speed:<?php echo $rowqpokes['speed']; ?></span>
		   <span>Critical:<?php echo $rowqpokes['critical']; ?></span>
		   <span>Accuracy:<?php echo $rowqpokes['accuracy']; ?></span>
		   



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
		   
		   </span>	
		   <div id='rowqpoke<?php echo $rowqpokes['id']; ?>' class='loadingbattle'>
			<?php
				$queryxcountbattle = "SELECT * FROM tbl_battle WHERE (p1poke='{$rowqpokes['id']}' OR p2poke='{$rowqpokes['id']}') AND winner IS NULL";
				$qxqueryxcountbattle = mysql_query_md($queryxcountbattle);
				$countxbattle = mysql_num_rows_md($qxqueryxcountbattle);
				if(!empty($countxbattle)){
					?>
					<i class="fas fa-spinner fa-spin"></i>Your Warrior already have pending battle. Please wait. See here: <a href="index.php?pages=pokebattle">Battles!</a>
					<?php
				}
			?>		
			<?php
			
				$view = 0;
				$queryxcountbattle = "SELECT * FROM tbl_battle WHERE (p1poke='{$rowqpokes['id']}') AND winner IS NOT NULL AND v1 IS NULL";
				$qxqueryxcountbattle = mysql_query_md($queryxcountbattle);
				$countxbattle = mysql_num_rows_md($qxqueryxcountbattle);
				if(!empty($countxbattle)){
					$databattlecount = mysql_fetch_md_assoc($qxqueryxcountbattle);
					$view = 1;
					?>
					Your battle is ready view  <a href='/index.php?pages=pokebattleview&id=<?php echo $databattlecount['id']; ?>&v=1'>here</a><hr>
					<?php
				}
			?>		

			<?php
				if($view==0){
				$queryxcountbattle = "SELECT * FROM tbl_battle WHERE (p2poke='{$rowqpokes['id']}') AND winner IS NOT NULL AND v2 IS NULL";
				$qxqueryxcountbattle = mysql_query_md($queryxcountbattle);
				$countxbattle = mysql_num_rows_md($qxqueryxcountbattle);
				if(!empty($countxbattle)){
					$databattlecount = mysql_fetch_md_assoc($qxqueryxcountbattle);
					?>
					Your battle is ready view  <a href='/index.php?pages=pokebattleview&id=<?php echo $databattlecount['id']; ?>&v=2'>here</a><hr>
					<?php
				}
				}
			?>			   
		   </div>
		   
			<input class="btn btn-info btn-lg btnbattle" type="button" onclick="window.location='index.php?pages=viewpoke&pokeid=<?php echo $rowqpokes['hash']; ?>'" name="battle" value="View">
			<?php if(empty($rowqpokes['is_market'])) { ?>
			 <input class="btn btn-primary btn-lg btnbattle" type="button" onclick="battleme('<?php echo $rowqpokes['hash']; ?>','<?php echo $rowqpokes['id']; ?>')" name="battle" value="Battle!">
		   <input class="btn btn-success btn-lg btnbattle" style='background-color: green;' type="button" onclick="emblemme('<?php echo $rowqpokes['hash']; ?>',<?php echo $rowqpokes['emblem']; ?>)" name="emblem" value="Update Emblem">			
		  
		   
		   <input class="btn btn-secondary btn-lg btnbattle" type="button" onclick="window.location='index.php?pages=useitems&pokeid=<?php echo $rowqpokes['id']; ?>'" name="battle" value="Upgrade!">
		   <input class="btn btn-info btn-lg btnbattle" style='background-color: #ff0000;' type="button" onclick="sellme('<?php echo $rowqpokes['hash']; ?>')" name="sell" value="Sell!">

			<?php } else { 
			?>
			<span style='color:red;'>This Warrior is on market</span>
			<?php
			} ?>
		</div>
<?php
	}
?>	
		
		
</div>

<button id='sellnowtoday' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary2">
                  Launch Primary Modal
                </button>
<button id='battlenow' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary1">
                  Launch Primary Modal
                </button>

<button id='emblemupdate' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary-emblem" style='display:none'>
                  Launch Primary Modal
</button>

	

	
<div class="modal fade" id="modal-primary2" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Sell this Warrior - <span class='hashbattlesell'></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>
			<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-info"></i>Hey!</h5>
			5% of the amount here when you sold this will be go to the system fund and helps the economy better.
			Please note that any warrior of you on market will not able to cancel it. So please put price that is reasonable ;)
			</div>			
			
			
            <div class="modal-body">
					Amount:<input class='form-control' type='number' id='sellamount'>
					
					
					<input class='form-control' type='hidden' id='sellhash'>
            </div>			
            <div id='sellbody' class="modal-body">
            </div>			
			
            <div class="modal-footer justify-content-between">
              <button id='savesell' type="button" onclick="savesell()" class="btn btn-primary">Sell Now</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>		

	
<div class="modal fade" id="modal-primary1" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Queue for Battle - <span class='hashbattle'></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>
			
            <div id='battlebody2' class="modal-body">
              <p>Loading…</p>
            </div>			
            <div id='battlebody' class="modal-body">
              <p>Loading…</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button id='savebattle' type="button" onclick="savebattle(this)" class="btn btn-primary">Lets Go!</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>				



<div class="modal fade" id="modal-primary-emblem" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update Emblem - <span class='hashbattleemblem'></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>

			
            <div class="modal-body">
				<table class='table table-striped table-bordered table-hover'>
					<tr>
						<td>Emblem Name</td>
						<td>Effects</td>
					</tr>
					
					<?php 
					$qemblem = mysql_query_md("SELECT * FROM tbl_emblem");
					while($qemblemrow = mysql_fetch_md_assoc($qemblem)) { 
							$countavatar++;
					?>
					<tr>
						<td>
						<input required id='emblemdatas<?php echo ($qemblemrow['id']); ?>' class='selectchar' type='radio' name='emblemradio' value='<?php echo ($qemblemrow['id']); ?>'>
						<label for="emblemdatas<?php echo ($qemblemrow['id']); ?>" >
						<img style='width:25px' src='/sprites/passive/<?php echo ($qemblemrow['image']); ?>'><?php echo ucfirst($qemblemrow['title_name']); ?>
						</label>
						</td>
						<td><?php echo ucfirst($qemblemrow['description']); ?></td>
					</tr>		
					<?php } ?>
				</table>			
            </div>			
            <div id='emblembody' class="modal-body">
            </div>			
			<input class='form-control' type='hidden' id='emblemhash'>
			<input class='form-control' type='hidden' id='emblemdata' value=''>
            <div class="modal-footer justify-content-between">
              <button id='updateemblem' type="button" onclick="saveemblem()" class="btn btn-primary">Update!</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>		
	

<script>


function saveemblem(){
	var hash = jQuery('#emblemhash').val();
	var emblem = jQuery('input[name="emblemradio"]:checked').val();;
		jQuery.post("action/saveemblem.php", {hash: hash,emblem:emblem}, function(result){
			jQuery('#sellbody').html(result);
		
		});		
	
}



function savesell(){
	var hash = jQuery('#sellhash').val();
	var amount = parseInt(jQuery('#sellamount').val());
	
	if(amount<=0){
		jQuery('#sellbody').html('Please add amount.');
		return;
	}
	
		jQuery.post("action/savesell.php", {hash: hash,amount:amount}, function(result){
			jQuery('#sellbody').html(result);
		
		});		
	
}

function sellme(battlehash){
		jQuery('.hashbattlesell').text(battlehash);
		jQuery('#sellhash').val(battlehash);
		jQuery('#sellnowtoday').trigger('click');
	
}

function emblemme(battlehash,emblemdata){
		jQuery('.hashbattleemblem').text(battlehash);
		jQuery('#emblemhash').val(battlehash);
		jQuery('#emblemdatas'+emblemdata).attr('checked','checked');
		jQuery('#emblemupdate').trigger('click');
	
}






	function battleme(battlehash,id){
		savebattle(battlehash,id);
	}
	
	
	function savebattle(battlehash,id){
			
		
		
		jQuery('#rowqpokes'+id).html('');
		jQuery('#battlebody').html("<p>Loading..</p>");
		jQuery.post("action/savebattle.php", {battlehash: battlehash}, function(result){
			jQuery('#rowqpoke'+id).html(result);
		});				
	}
	
	
	
	
</script>
<style>
.btn-group-lg>.btn, .btn-lg {
    font-size:12px!important;
    margin-top:5px;
    padding:10px;
}
.mainchar.flipme.showcharbattle {
    margin-top: 55px;
    margin-left: 83px;
}
</style>



<?php
$qweapons = mysql_query_md("SELECT * FROM tbl_weapons");
while($qweaponsr=mysql_fetch_md_array($qweapons))
{
	
	?>
<!--
<?php echo $qweaponsr['slug'];?>::<div class='itemweapondemo itemweapon-<?php echo $qweaponsr['slug'];?>'></div><br>	
-->
	<?php
}

?>
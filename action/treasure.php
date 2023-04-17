<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);
?>

<?php
$field = array();
$field[] = array("type"=>"password","value"=>"password","label"=>"Please enter password:");
?>
<h1>Treasure Hunt - Your Chest(<span id='walletbalancechest'><?php echo number_format($row['chest']); ?></span>)</h1>



<div class="alert alert-info alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h5><i class="icon fas fa-info"></i>Hey!</h5>
2% chance to get a item that helps your hero to win battle with rare battle weapons.
</div>


<div class="panel panel-default">
   <div class="panel-body">
      <form id='catchpoke' method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='button' onclick="catchpokemon()" name='submit' value='Open Chest'></center>
      </form>
   </div>
</div> 
<button id='battlenow' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-primary1">
                  Launch Primary Modal
                </button>
				
<div class="modal fade" id="modal-primary1" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Opening Chest</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>		
            <div id='battlebody' class="modal-body">
              <p>Loading…</p>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>	

<script>
	function catchpokemon(){
		
		jQuery('#battlenow').trigger('click');
		jQuery('#battlebody').html("");
		jQuery('#battlebody').html("<p>Loading..</p>");
		jQuery.post("action/treasure-save.php", jQuery( "#catchpoke" ).serialize(), function(result){
			jQuery('#pokeitemsholder2').html(result);
			jQuery('#password').val('');
			jQuery('#battlebody').html(result);
			location.href = "#pokeitemsholder";
		});				
	}
</script>

<script>
function itemshow(){
	jQuery('.itemshops').hide();
	if(jQuery('#itemid').val()!=0){
		jQuery('#pokeitem-'+jQuery('#itemid').val()).show();
	}
}
</script>

<hr>

<div id='pokeitemsholder'>
	<h1>Your Weapons</h1>
	<div id="poke-container" class="ui cards">
	<input type='hidden' name='pages' value='useitems'>
<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT * FROM `tbl_items_users` WHERE user ='$myuser'");		
$stats = array("hp","speed","critical","accuracy","attack","defense");
	
	if(empty(mysql_num_rows_md($qpokes))){
		
		echo "You have no weapon so far. Open a chest now!";
	}

	while($rowqpokesx = mysql_fetch_md_assoc($qpokes)) {
		

		
?>	
	<div class="ui card">
			   <div id="pokeitemv2-<?php echo $rowqpokesx['hash']; ?>" class="image">
			   <br>
			    <div class='itemweapondemo itemweapon-<?php echo $rowqpokesx['weapon']; ?>' style='margin: 0 auto;'></div>
			   <h6><?php echo $rowqpokesx['pokename']; ?></h6>
			   <p class='idsdata'>ID:#<?php echo $rowqpokesx['hash']; ?></p>
			   
			   <?php 
			   if(!empty($rowqpokesx['pokemon'])) { 
			   
					$pokedata = loadpokev2($rowqpokesx['pokemon']);
			   ?>
			   <p style='color:green'>Used by:<?php echo $pokedata['pokename']; ?></p>
			   <?php } ?>
			   <p>
			   <?php 
			   foreach($rowqpokesx as $fkey=>$fval){ 
					if(!empty($fval) && in_array($fkey,$stats)){
					echo ucfirst($fkey).": ".$fval."<br>";
					}
			   }
			   ?>
			   </p>
			</div>
		<?php if(empty($rowqpokesx['is_market'])) { ?>
		   <input data-json='<?php echo (json_encode($rowqpokesx,JSON_HEX_APOS)); ?>' class="btn btn-secondary btn-sm" type="button" onclick="equipitems('<?php echo $rowqpokesx['hash']; ?>','<?php echo $rowqpokesx['weapon']; ?>',this)" name="battle" value="Equip!">
		   <input class="btn btn-info btn-sm" style='background-color: #ff0000;margin-top:5px;' type="button" onclick="sellmeitems('<?php echo $rowqpokesx['hash']; ?>')" name="sell" value="Sell!">	
	    <?php } else { ?>
			<p>Item is on market</p>
		<?php } ?>
	</div>
<?php
	}
?>	
			
	
	
	</div>	
</div>




<script>
function saveselltreasure(){
	var hash = jQuery('#sellhash').val();
	var amount = parseInt(jQuery('#sellamount').val());
	
	if(amount<=0){
		jQuery('#sellbody').html('Please add amount.');
		return;
	}
	
		jQuery.post("action/saveselltreasure.php", {hash: hash,amount:amount}, function(result){
			jQuery('#sellbody').html(result);
		
		});		
	
}

function sellmeitems (battlehash){
		jQuery('.hashbattlesell').text(battlehash);
		jQuery('#sellhash').val(battlehash);
		jQuery('#sellnowtoday').trigger('click');
	
}


	function equipitems(battlehash,weapon,me){
		
		

		var attrd = jQuery.parseJSON(jQuery(me).attr('data-json'));
		<?php foreach($stats as $st) { ?>
		jQuery('.d<?php echo $st;?>').text('');
	


jQuery( ".d<?php echo $st;?>1" ).each(function( index ) {
  
		
		if(attrd.<?php echo $st;?>!=0){
			
			var main = parseInt(jQuery( this ).attr('data'));
			var total = main + parseInt(attrd.<?php echo $st;?>);
			jQuery( this ).find('.d<?php echo $st;?>').attr('style','');
			jQuery( this ).find('.d<?php echo $st;?>').text(' -> '+total).attr('style','color:green;');
		}		
		  
  
  
  
});	
		

		
		<?php } ?>

		
		jQuery('.hashbattle').text(battlehash);
		jQuery('#battlenowequip').trigger('click');
		jQuery('#battlebodyeq').html("");
		
		jQuery('.showchar2').html('<div class="itemweapon itemweapon-'+weapon+'"></div>');
		
		var htmlpoke = jQuery('#pokeitemv2-'+battlehash).html();
		jQuery('#battlebody2').html("<div class=\"ui card\">"+htmlpoke+"</div>");
		
		jQuery('#savebattle').attr('battlehash',battlehash);

	
		
		
		//toastr.success("Your battle has done watch here <a href=''>Watch</a>");
		
	}
	
	function showheroboss(heroid){
		
		jQuery('.heroselects').hide();
		jQuery('#pokehero-'+heroid).show();

		
	}
	
	function savequipfinal(id){
		
		

		
		var battlehash = jQuery(id).attr('battlehash');
		var heroselect = jQuery('#heroselect').val();
		
		if(heroselect==''){
			alert("please select hero");
			return
		}
		if(battlehash==''){
			alert("please select item");
			return
		}		
		jQuery('#battlebodyeq').html("<p>Loading..</p>");
		jQuery.post("action/saveequipitem.php", {item: battlehash,hero:heroselect}, function(result){
			jQuery('#battlebodyeq').html(result);
		});				
	}	

</script>
<button id='sellnowtoday' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-itemsell" style='display:none;'>
                  Launch Primary Modal
</button>
<div class="modal fade" id="modal-itemsell" style="display: none;">
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
              <button id='savesell' type="button" onclick="saveselltreasure()" class="btn btn-primary">Sell Now</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>	












<button id='battlenowequip' type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-equip" style='display:none;'>
                  Launch Primary Modal
                </button>
<div class="modal fade" id="modal-equip" style="display: none;">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Equip Item - <span class='hashbattle'></span></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>
			
		
			<div class="modal-body">
			<div id='battlebody3' class='secretequip'>

			<h4>HERO SELECT:</h4>
			<select id='heroselect' onchange='showheroboss(this.value)' style='width: 100%;margin-bottom: 11px;'>
			<option value=''>Select hero</option>
<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$myuser' AND (is_market IS NULL OR is_market!=1)");		

while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
?>
	<option value='<?php echo $rowqpokes['hash']; ?>'><?php echo $rowqpokes['pokename']; ?></option>
<?php
	}
?>	
			</select>
			<br>
<?php
$myuser = $_SESSION['accounts_id'];
$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user='$myuser' AND (is_market IS NULL OR is_market!=1)");		

	while($rowqpokes = mysql_fetch_md_assoc($qpokes)) {
?>	
		<div id='pokehero-<?php echo $rowqpokes['hash']; ?>' class="ui card heroselects" style='display:none;'>
		   <div class="image">  
				<div class='mainchar flipme showchar2 battle' style='background: url(/actors/<?php echo $rowqpokes['front']; ?>) 0px 0px;'>
					<div class="itemweapon itemweapon-sword"></div>
				</div>		   
		   </div>
		   <h4><?php echo $rowqpokes['pokename']; ?></h4>
		   
		   <span class='dattack1' data='<?php echo $rowqpokes['attack']; ?>'>Attack:<?php echo $rowqpokes['attack']; ?><span class='dattack'></span></span>
		   <span class='ddefense1' data='<?php echo $rowqpokes['defense']; ?>'>Defense:<?php echo $rowqpokes['defense']; ?><span class='ddefense'></span></span>
		   <span class='dhp1' data='<?php echo $rowqpokes['hp']; ?>'>HP:<?php echo $rowqpokes['hp']; ?><span class='dhp'></span></span>
		   <span class='dspeed1' data='<?php echo $rowqpokes['speed']; ?>'>Speed:<?php echo $rowqpokes['speed']; ?> <span class='dspeed'></span></span>
		   <span class='dcritical1' data='<?php echo $rowqpokes['critical']; ?>'>Critical:<?php echo $rowqpokes['critical']; ?><span class='dcritical'></span></span>
		   <span class='daccuracy1' data='<?php echo $rowqpokes['accuracy']; ?>'>Accuracy:<?php echo $rowqpokes['accuracy']; ?><span class='daccuracy'></span></span>		   
		   
		</div>
<?php
	}
?>	
						<hr>	
			</div>
			
            <div id='battlebody2' class='secretequip' style='margin-top: 73px;'>
              <p>Loading…</p>
            </div>				
	
			</div>				
            <div class="modal-footer justify-content-between">
              <button id='savebattle' type="button" onclick="savequipfinal(this)" class="btn btn-primary">Equip</button>
            </div>
            <div id='battlebodyeq' class='modal-body'>
             
            </div>			
			
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>				

<style>
.secretequip {
    float: left;
    width: 50%;
}

.showchar2 {
    margin: 0 auto;

}
</style>
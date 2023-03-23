<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
 $accounts_id = $_SESSION['accounts_id'];
 
if(empty($_GET['id'])){
	
	$_GET['id'] = 1;
}
?>
<hr>
Select a Pokemon:
<select name='pokessss' onchange='movepokedex(this.value)'>
<?php
$qpokesx = mysql_query_md("SELECT * FROM tbl_pokemon");	

while($selectpoke = mysql_fetch_md_assoc($qpokesx)){
?>

	<option <?php if($_GET['id']==$selectpoke['id']) { echo "selected='selected'"; } ?> value='<?php echo $selectpoke['id']; ?>'>#<?php echo $selectpoke['id']; ?> - <?php echo ucfirst($selectpoke['name']); ?></option>
<?php
}
?>
</select><hr>
<script>
function movepokedex(aaa){
	
	window.location = 'index.php?pages=pokedex&id='+aaa;
}
</script>




												<?php
												$qpokes = mysql_query_md("SELECT * FROM tbl_pokemon WHERE id='{$_GET['id']}'");		
												$rowqpokes = mysql_fetch_md_assoc($qpokes);



$poketype = mysql_query_md("SELECT * FROM `tbl_relation` as a LEFT JOIN tbl_type as b ON a.relation_id = b.id WHERE a.relation_type = 'type' AND pokemon='{$_GET['id']}'");		
while($rowpoketype = mysql_fetch_md_assoc($poketype)){
		$pokeclass[] = $rowpoketype['name'];
}	
		
		$pokeclassfin = implode("|",$pokeclass);
		
		
		
		
		$querys = "SELECT * FROM `tbl_movesv2` as a LEFT JOIN tbl_pokemon_moves as b ON a.id=b.move_id WHERE b.pokemon_id = '{$_GET['id']}' AND a.power !='' AND b.move_id IN (SELECT move_id FROM `tbl_pokemon_moves` WHERE `pokemon_id` LIKE '{$_GET['id']}' GROUP by move_id ORDER BY `tbl_pokemon_moves`.`move_id` DESC) GROUP by a.identifier";
		$skillsq = mysql_query_md($querys);		


		
		
												?>
												
												<div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
			
			<div class='typedataholder'>
				<?php foreach(explode("|",$pokeclassfin) as $tt) { ?>
					<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo ucfirst($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
				<?php } ?>	
			</div>			  
			  			
			
              <div class="card-body box-profile">

                <div class="text-center">
                  <img class="img-fluid img-circle" src="sprites/sprites/pokemon/other/official-artwork/<?php echo $_GET['id']; ?>.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo ucfirst($rowqpokes['name']); ?></h3>


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
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
          
                  <div class="active tab-pane" id="settings">


<div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              Only with the green label of SKILLS are usable in battle and it is randomly generated.
</div>

<div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Power</th>
                                            <th>Accuracy</th>
                                            <th>Element</th>

                                        </tr>
                                    </thead>
                                    <tbody>
<?php foreach($skillsq as $aaa) { 


	

?>
									    <tr <?php if($aaa['activate']) { echo "style='background-color: #00f900;'"; } else { echo "style='opacity: 0.85;'"; }?>>
                                            <td><?php echo $aaa['title']; ?></td>
                                            <td><?php echo $aaa['power']; ?></td>
                                            <td><?php echo $aaa['accuracy']; ?></td>
                                            <td><?php echo $aaa['typebattle']; ?></td>
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
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
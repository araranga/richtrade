<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
?>
<H2>GUIDES & ANNOUNCEMENT</h2>
<?php echo systemconfig("terms"); ?>


<H2>DAMAGES COMPUTATION</h2>

<?php
$q = mysql_query_md("SELECT * FROM tbl_damage");
/*
type
double_damage_from
double_damage_to
half_damage_from
half_damage_to
no_damage_from
no_damage_to
*/
?>
<div class='tableborderrpg'>
<table class='table table-striped table-bordered table-hover'>
	<tr>
		<td>Type</td>
		<td>Double Damage From</td>
		<td>Double Damage To</td>
		<td>Half Damage From</td>
		<td>Half Damage To</td>
		<td>No Damage From</td>
		<td>No Damage To</td>
	</tr>
	
	<?php while($row = mysql_fetch_md_assoc($q)) { ?>
	<tr>
		<td><?php echo ucfirst($row['type']); ?></td>
		
		
		
		<td>
		<?php foreach(explode("|",$row['double_damage_from']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>




		<td>
		<?php foreach(explode("|",$row['double_damage_to']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>




		<td>
		<?php foreach(explode("|",$row['half_damage_from']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>
		
		
		<td>
		<?php foreach(explode("|",$row['half_damage_to']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>


		<td>
		<?php foreach(explode("|",$row['no_damage_from']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>		


		<td>
		<?php foreach(explode("|",$row['no_damage_to']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>




	</tr>	
	<?php } ?>
</table>
</div>
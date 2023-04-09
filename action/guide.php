<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];
?>
<H2>GUIDES & ANNOUNCEMENT</h2>
<?php echo systemconfig("terms"); ?>


<H2>STATS</h2>
<div class='tableborderrpg'>
<table class='table table-striped table-bordered table-hover'>
	<tr>
		<td>Stat Name</td>
		<td>Effects</td>
	</tr>
	<tr>
		<td>Attack</td>
		<td>Uses to increase damage of skills</td>
	<tr>
	
	<tr>
		<td>Defense</td>
		<td>Reduce 1 dmg for every point.</td>
	<tr>

	<tr>
		<td>HP</td>
		<td>Health Bar (RPG gals you what this is use for).</td>
	<tr>
	
	<tr>
		<td>Speed</td>
		<td>Added chance to dodge every attack.</td>
	<tr>	
	
	<tr>
		<td>Critical</td>
		<td>Increase critical chance for every 1 pts.</td>
	<tr>

	<tr>
		<td>Accuracy</td>
		<td>Added chance to avoid dodge effect of attack.</td>
	<tr>	
	
</table>
</div>


<?php
$q = mysql_query_md("SELECT * FROM tbl_emblem");
?>
<H2>EMBLEMS</h2>
<p>Emblems can customize anytime.</p>
<div class='tableborderrpg'>
<table class='table table-striped table-bordered table-hover'>
	<tr>
		<td>Emblem Name</td>
		<td>Effects</td>
	</tr>
	
	<?php while($row = mysql_fetch_md_assoc($q)) { ?>
	<tr>
		<td><img src='/sprites/passive/<?php echo ($row['image']); ?>'><?php echo ucfirst($row['title_name']); ?></td>
		<td><?php echo ucfirst($row['description']); ?></td>
	</tr>		
	<?php } ?>
</table>
</div>

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
		<td colspan='3'>Attack (Outgoing)</td>
		<td colspan='3'>Defense (Ingoing)</td>
	</tr>
	
	<tr style='text-align:center;font-weight:700;'>
		<td>-</td>
		<td>+75%</td>
		<td>-35%</td>
		<td>-65%</td>
		<td>+75%</td>
		<td>-35%</td>
		<td>-65%</td>
	</tr>
	<?php while($row = mysql_fetch_md_assoc($q)) { ?>
	<tr>
		<td><?php echo ucfirst($row['type']); ?></td>
		
	


		<td>
		<?php foreach(explode("|",$row['double_damage_to']) as $tt) { 
			
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
		<?php foreach(explode("|",$row['no_damage_to']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>



	
		
		<td>
		<?php foreach(explode("|",$row['double_damage_from']) as $tt) { 
			
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
		<?php foreach(explode("|",$row['no_damage_from']) as $tt) { 
			
			if(!empty($tt)) { 
		
		?>
		<div class='typesdata <?php echo $tt; ?>'><img src='sprites/type/<?php echo strtolower($tt); ?>.png' style='width:25px;margin-right:1px;'><?php echo ucfirst($tt); ?></div>
		<?php } } ?>
		</td>	
		
		







	</tr>	
	<?php } ?>
</table>
</div>
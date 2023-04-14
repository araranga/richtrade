<?php
$primary = "id";
$pid = $_GET['id'];
$tbl = "tbl_weapons";
$query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
$sdata = array();
while($row=mysql_fetch_md_assoc($query))
{
	foreach($row as $key=>$val)
	{
		 $sdata[$key] = $val;
	}
}



$field[] = array("type"=>"text","value"=>"title_name","label"=>"Item Name");
$field[] = array("type"=>"text","value"=>"image","label"=>"Image Name");
$field[] = array("type"=>"text","value"=>"description","label"=>"Border Position");
$field[] = array("type"=>"text","value"=>"slug","label"=>"Slug");
?>
<h2>Weapons Edit</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
	  <input type='hidden' name='<?php echo $primary; ?>' value='<?php echo $sdata[$primary];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 


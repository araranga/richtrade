<?php
$primary = "id";
$pid = $_GET['id'];
$tbl = "tbl_emblem";
$query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
while($row=mysql_fetch_md_assoc($query))
{
	foreach($row as $key=>$val)
	{
		 $sdata[$key] = $val;
	}
}
$field[] = array("type"=>"text","value"=>"title_name","label"=>"Item Name");
$field[] = array("type"=>"text","value"=>"image","label"=>"Image Name");
$field[] = array("type"=>"textarea","value"=>"description","label"=>"Description");
$field[] = array("type"=>"number","value"=>"price","label"=>"Price");
$field[] = array("type"=>"number","value"=>"datavalue","label"=>"Data Value");
$field[] = array("type"=>"select","value"=>"target_type","label"=>"Target Data","option"=>array("user"=>"User","pokemon"=>"Pokemon"));
$field[] = array("type"=>"text","value"=>"target_attr","label"=>"Target Attribute");

//$field[] = array("type"=>"select","value"=>"stores","label"=>"Branch","option"=>getarrayconfig('stores'),"attr"=>"disabled");
?>
<h2>Are you sure you want to delete?</h2>
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

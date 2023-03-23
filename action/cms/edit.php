<?php
$primary = "id";
$pid = $_GET['id'];
$tbl = "tbl_cms";
$query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
while($row=mysql_fetch_md_assoc($query))
{
	foreach($row as $key=>$val)
	{
		 $sdata[$key] = $val;
	}
}
$field[] = array("type"=>"text","value"=>"pagetitle","label"=>"Page Name");
$field[] = array("type"=>"editor","value"=>"pagecontent","label"=>"Page Content");
$field[] = array("type"=>"editor","value"=>"p1","label"=>"Block A");
$field[] = array("type"=>"editor","value"=>"p2","label"=>"Block B");
$field[] = array("type"=>"editor","value"=>"p3","label"=>"Block C");
//$field[] = array("type"=>"file","value"=>"banner","label"=>"Banner");
?>
<h2>Edit CMS - <?php echo $sdata['pagetitle']; ?></h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>' enctype="multipart/form-data">
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
	  <input type='hidden' name='<?php echo $primary; ?>' value='<?php echo $sdata[$primary];?>'>
         <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 


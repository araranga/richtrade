<?php
$sdata = array();
$field[] = array("type"=>"text","value"=>"pagetitle","label"=>"Page Name");
$field[] = array("type"=>"editor","value"=>"pagecontent","label"=>"Page Content");
$field[] = array("type"=>"editor","value"=>"p1","label"=>"Block A");
$field[] = array("type"=>"editor","value"=>"p2","label"=>"Block B");
$field[] = array("type"=>"editor","value"=>"p3","label"=>"Block C");
//$field[] = array("type"=>"file","value"=>"banner","label"=>"Banner");
?>
<h2>Add New CMS</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>' enctype="multipart/form-data">
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
        <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 

<?php
$sdata = array();
$field[] = array("type"=>"text","value"=>"remarks","label"=>"File Description");
$field[] = array("type"=>"file","value"=>"filename","label"=>"File");
?>
<h2>Add New Files</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>' enctype="multipart/form-data">
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
        <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 

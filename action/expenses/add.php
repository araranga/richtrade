<?php
$sdata = array();
$field[] = array("type"=>"number","value"=>"amount","label"=>"Amount");
$field[] = array("type"=>"textarea","value"=>"remarks","label"=>"Remarks");
$field[] = array("type"=>"date","value"=>"actual","label"=>"Date");
?>
<h2>Add Expenses</h2>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
        <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 

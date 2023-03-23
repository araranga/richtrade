<?php
$sdata = array();
$field[] = array("type"=>"text","value"=>"title_name","label"=>"Item Name");
$field[] = array("type"=>"text","value"=>"image","label"=>"Image Name");
$field[] = array("type"=>"textarea","value"=>"description","label"=>"Description");
$field[] = array("type"=>"number","value"=>"price","label"=>"Price");
$field[] = array("type"=>"number","value"=>"datavalue","label"=>"Data Value");
$field[] = array("type"=>"select","value"=>"target_type","label"=>"Target Data","option"=>array("user"=>"User","pokemon"=>"Pokemon"));
$field[] = array("type"=>"text","value"=>"target_attr","label"=>"Target Attribute");
?>
<h2>Items</h2>


<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
        <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 



<?php
$sdata = array();
$field[] = array("type"=>"text","value"=>"rate_name","label"=>"Complan Name");
$field[] = array("type"=>"number","value"=>"rate_start","label"=>"Amount Fee");
$field[] = array("type"=>"number","value"=>"rate_end","label"=>"Direct Referral Bonus");
$field[] = array("type"=>"number","value"=>"rate_bonus","label"=>"Bonus Months in Table Matrix");
?>
<h2>Complan</h2>


<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
	  <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
        <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center>
      </form>
   </div>
</div> 



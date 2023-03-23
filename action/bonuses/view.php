<?php
$primary = "id";
$pid = $_GET['id'];
$tbl = "tbl_bonus_history";
$query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='{$_GET['id']}'");
while($row=mysql_fetch_md_assoc($query))
{
   foreach($row as $key=>$val)
   {
       $sdata[$key] = $val;
   }
}

$field[] = array("type"=>"text","value"=>"send","label"=>"Bonus From");
$field[] = array("type"=>"text","value"=>"receiver","label"=>"Bonus To");
$field[] = array("type"=>"text","value"=>"amount","label"=>"Amount");
$field[] = array("type"=>"textarea","value"=>"remarks","label"=>"Remakrs");
$field[] = array("type"=>"text","value"=>"history","label"=>"Date");
$field[] = array("type"=>"text","value"=>"ptype","label"=>"Type");




#$field[] = array("type"=>"select","value"=>"package_id","label"=>"Package","option"=>$options,"attr"=>"disabled");
?>
<h2>Bonus Data</h2>
<div class="panel panel-default">
   <div class="panel-body">
<!--       <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'> -->
     <input type='hidden' name='task' value='<?php echo $_GET['task'];?>'>
     <input type='hidden' name='<?php echo $primary; ?>' value='<?php echo $sdata[$primary];?>'>
         <?php echo loadform($field,$sdata); ?>
<!--          <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='<?php echo ucwords($_GET['task']);?>'></center> -->
<!--       </form> -->
   </div>
</div> 
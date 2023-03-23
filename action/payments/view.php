<?php
$primary = "id";
$pid = $_GET['id'];
$tbl = "tbl_payment_history";
$query  = mysql_query_md("SELECT a.*,b.username FROM tbl_payment_history as a LEFT JOIN tbl_accounts as b on a.accounts_id=b.accounts_id WHERE a.id='{$_GET['id']}'");
while($row=mysql_fetch_md_assoc($query))
{
   foreach($row as $key=>$val)
   {
       $sdata[$key] = $val;
   }
}

$field[] = array("type"=>"text","value"=>"username","label"=>"Username");

$field[] = array("type"=>"text","value"=>"amount","label"=>"Amount");
$field[] = array("type"=>"text","value"=>"history","label"=>"Date");
$field[] = array("type"=>"text","value"=>"ptype","label"=>"Payment Type");
$field[] = array("type"=>"text","value"=>"transnum","label"=>"Transaction ID");
$field[] = array("type"=>"textarea","value"=>"remarks","label"=>"Remarks");
$field[] = array("type"=>"text","value"=>"inv","label"=>"Invoice");


#$field[] = array("type"=>"select","value"=>"package_id","label"=>"Package","option"=>$options,"attr"=>"disabled");
?>
<h2>Payment Data</h2>
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
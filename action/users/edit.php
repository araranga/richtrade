<?php
$primary = "accounts_id";
$pid = $_GET['id'];
$tbl = "tbl_accounts";
$query  = mysql_query_md("SELECT * FROM $tbl WHERE $primary='$pid'");
while($row=mysql_fetch_md_assoc($query))
{
	foreach($row as $key=>$val)
	{
		 $sdata[$key] = $val;
	}
}
$field[] = array("type"=>"text","value"=>"username","label"=>"Username");
$field[] = array("type"=>"text","value"=>"fullname","label"=>"Fullname");
$field[] = array("type"=>"number","value"=>"balance","label"=>"Wallet");
$field[] = array("type"=>"text","value"=>"password","label"=>"Password");
$field[] = array("type"=>"email","value"=>"email","label"=>"Email");
$field[] = array("type"=>"select","value"=>"role","label"=>"Role","option"=>array("0"=>"Member","1"=>"Administrator"));



$complan = array();
$queryx  = mysql_query_md("SELECT * FROM tbl_rate");
$complan[0] = "Select a Complan";
while($rows=mysql_fetch_md_assoc($queryx))
{

		 $complan[$rows['rate_id']] = $rows['rate_name'];
	
}

$sdata['rate'] = $complan[$sdata['rate']];

//$field[] = array("type"=>"select","value"=>"stores","label"=>"Branch","option"=>getarrayconfig('stores'));
?>
<h2>Data</h2>
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

<hr>



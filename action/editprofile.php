<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];

	if($_POST['submit']!='')
	{
	
		if(countfield("email",$_POST['email'])!=0 && $_POST['email']!=$_SESSION['email'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Email is already exist.<br>";

		}
		
		if($error=='')
		{
		$_SESSION['email'] = $_POST['email'];
		unset($_POST['submit']);
		unset($_POST['task']);
		$fields = formquery($_POST);
		mysql_query_md("UPDATE tbl_accounts SET $fields WHERE accounts_id='$accounts_id'");
		$success = 1;
		}
	}



$field[] = array("type"=>"text","value"=>"username","attributes"=>array("disabled"=>"disabled"));
#$field[] = array("type"=>"password","value"=>"password","attributes"=>array("disabled"=>"disabled"));
$field[] = array("type"=>"text","value"=>"fullname","label"=>"Nickname");
//
$q = mysql_query_md("SELECT * FROM tbl_accounts WHERE accounts_id='$accounts_id'");
$row = mysql_fetch_md_assoc($q);
foreach($row as $key=>$val)
{
	$sdata[$key] = $val;
}

?>
<h2>Edit Profile</h2>   
<?php
if($error!='')
{
?>
<div class="warning"><ul class="fa-ul"><li><?php echo $error;?></li></ul></div>
<?php
}
?>


<?php
if($success!='')
{
?>
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done updating your details!.</li></ul></div>
<?php
}
?>



<form method='POST' action=''>
<div class="panel panel-default">
   <div class="panel-body">
      <form method='POST' action='?pages=<?php echo $_GET['pages'];?>'>
        <?php echo loadform($field,$sdata); ?>
         <center><input class='btn btn-primary btn-lg' type='submit' name='submit' value='Update'></center>
      </form>
   </div>
</div> 




</form>
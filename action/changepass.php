<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$accounts_id = $_SESSION['accounts_id'];

	if($_POST['submit']!='')
	{
	
		if($_POST['new_password1']!=$_POST['new_password2'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Input password is mismatch.<br>";

		}
		if($_POST['old_password']!=$_SESSION['password'])
		{
			$error .= "<i class=\"fa fa-warning\"></i>Please input the current password correctly.<br>";
		}
		
		if($error=='')
		{
		$_SESSION['password'] = $_POST['new_password1'];
		unset($_POST['submit']);
		$fields = formquery($_POST);
		mysql_query_md("UPDATE tbl_accounts SET password='".$_POST['new_password1']."' WHERE accounts_id='$accounts_id'");
		$success = 1;
		}
	}



$field[] = array("type"=>"password","value"=>"old_password","label"=>"Old Password");
$field[] = array("type"=>"password","value"=>"new_password1","label"=>"New Password");
$field[] = array("type"=>"password","value"=>"new_password2","label"=>"Confirm Password");
//
?>
<h2>Change Password</h2>   
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
<div class="noti"><ul class="fa-ul"><li><i class="fa fa-check fa-li"></i>Done updating your password!.</li></ul></div>
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
<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
$tbl = "tbl_system";
$primary = "id";
/*SQL*/
$refresh = 0;
if($_POST['submit']!='' && $_POST['task']=='configsave')
{


	foreach($_POST as $key=>$val){


		if(is_array($_POST[$key])){


		$newarray = array();
		$counter = 0;
		foreach($_POST[$key] as $k=>$v){


			if(empty($_POST[$key][$k]['label']) || empty($_POST[$key][$k]['value']) )
			{	


			}else{

				$counter++;

				$newarray[$counter]['label'] = $_POST[$key][$k]['label'];
				$newarray[$counter]['value'] = $_POST[$key][$k]['value'];
	
	 		}
			
		}
		$val = addslashes(json_encode($newarray));
		$s = "INSERT INTO $tbl SET code='$key',value='$val' ON DUPLICATE KEY UPDATE code='$key',value='$val'";
		#echo $s."<br>";
		mysql_query_md($s);
		}else{

		$val = addslashes($val);
		$s = "INSERT INTO $tbl SET code='$key',value='$val' ON DUPLICATE KEY UPDATE code='$key',value='$val'";
		#echo $s."<br>";
		mysql_query_md($s);		
		}


	}



	$_SESSION['noti'] = "Done updating configuration.";

	$refresh = 1;
}
/*SQL*/
if($refresh){
moveredirect("index.php?pages=".$_REQUEST['pages']);
exit();	
}

if($_SESSION['role']!=1)
{
	exit("hey your not allowed here");
}

include($_GET['pages']."/main.php");

?>
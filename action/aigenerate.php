<?php
session_start();
require_once("../connect.php");
require_once("../function.php");


$qpoke = mysql_query_md("SELECT * FROM tbl_accounts WHERE robot = 1 ORDER by RAND()");
	
while($rowqpoke = mysql_fetch_md_assoc($qpoke)){

			echo $id2 = $rowqpoke['accounts_id'];
			$qs = mysql_query_md("SELECT * FROM tbl_pokemon_users WHERE user = $id2 ORDER by RAND()");
			while($as = mysql_fetch_md_assoc($qs)){
				//echo $as['hash']."<br>";
				try{
					savebattlebot($as['hash'],$as['user']);
				}
				catch(Exception $e) {
					echo '<br>Message: ' .$e->getMessage();
				}
				
			}	
			
			
}


echo rand();
?>

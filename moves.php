<?php    

	include("connect.php");
	include("function.php");
	$x = 1;
	
//mysql_query_md();
	
		while($x<=844){
			

$json = file_get_contents('https://pokeapi.co/api/v2/move/'.$x);
$obj = json_decode($json,true);	


//mysql_query_md("INSERT INTO tbl_damage SET id='$x',type='{$obj['name']}',no_damage_to='{$array['no_damage_to']}',no_damage_from='{$array['no_damage_from']}',half_damage_to='{$array['half_damage_to']}',half_damage_from='{$array['half_damage_from']}',double_damage_from='{$array['double_damage_from']}',double_damage_to='{$array['double_damage_to']}'");


$id = $x;
$name = $obj['name'];
$power = $obj['power'];
$pp = $obj['pp'];
$accuracy = $obj['accuracy'];

		foreach($obj['names'] as $d){
				
				
				if($d['language']['name']=='en'){
					$title = $d['name'];
				}
	


		}
		

mysql_query_md("INSERT INTO tbl_moves SET id='$id',name='$name',power='$power',pp='$pp',accuracy='$accuracy',title='$title'");



$x++;

sleep(1);
		}	
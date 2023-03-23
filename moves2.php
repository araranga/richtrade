<?php    

	include("connect.php");
	include("function.php");
	$x = 1;
	
//mysql_query_md();
	
		while($x<=18){
			

$json = file_get_contents('https://pokeapi.co/api/v2/type/'.$x);
$obj = json_decode($json,true);	



$fields = array('double_damage_from','double_damage_to','half_damage_from','half_damage_to','no_damage_from','no_damage_to');

		$array = array();

foreach($fields as $a){
	
			
		$savearray = array();

		foreach($obj['damage_relations'][$a] as $d){
				
				
				$savearray[] = $d['name'];


		}
		
		$array[$a] = implode("|",$savearray);

}


var_dump($obj['name']);
var_dump($array);

//mysql_query_md("INSERT INTO tbl_damage SET id='$x',type='{$obj['name']}',no_damage_to='{$array['no_damage_to']}',no_damage_from='{$array['no_damage_from']}',half_damage_to='{$array['half_damage_to']}',half_damage_from='{$array['half_damage_from']}',double_damage_from='{$array['double_damage_from']}',double_damage_to='{$array['double_damage_to']}'");




		foreach($obj['moves'] as $d){
				
				
				echo $obj['name']."===".$d['name']."<br>";
	
	
	mysql_query_md("INSERT INTO tbl_moves_type SET name='{$obj['name']}',type='{$d['name']}'");

		}
		





$x++;

sleep(1);
		}	
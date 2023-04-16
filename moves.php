<?php    

function getluck($chance, $odds)
{
    $luck = rand(1, $odds);
	

    if ($chance >= $luck)
    {
        return "1-".$luck."-".$chance."-".$odds;
    }
    else
    {
        return "0-".$luck."-".$chance."-".$odds;
    }
}



for ($x = 0; $x <= 10000; $x++) {
   echo getluck(1,100)."<br>";
}

?>
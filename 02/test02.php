<?php
$sum_of_games = 0;
$allowed_colors = array("red"=>12, "green" => 13, "blue" => 14);

$file = file("input.txt");
foreach($file as $row)
{
	preg_match("/Game (\d+)/", $row, $matches);
	$gameid = $matches[1];
	$row = substr($row, strlen($matches[0])+1);

	$picks = explode(";", $row);
	$include = true;
	foreach($picks as $pick)
	{
		print PHP_EOL. $pick.PHP_EOL;
		preg_match_all("/(\d+) ([a-z]+).?/", $pick, $matches);
		foreach($matches[2] as $key => $color)
		{
			print PHP_EOL. $gameid .": ". $color .": ". $matches[1][$key];
	        	if(!isset($allowed_colors[$color]))
	        	{
		                print "not allowed game color: ". $color. PHP_EOL;
	        	        break;
		        }
			if($matches[1][$key] > $allowed_colors[$color])
			{
				$include = false;
				print " DISQ". PHP_EOL;
				break 2;		
			}
		}

	}
	if($include)
	{
		$sum_of_games += $gameid;
	}
			
}

print "Total: ". $sum_of_games. PHP_EOL;

?>


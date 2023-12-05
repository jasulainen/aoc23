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
	$mins = array("red" => null, "green" => null, "blue" => null);	
	foreach($picks as $pick)
	{
		print PHP_EOL. $pick.PHP_EOL;
		preg_match_all("/(\d+) ([a-z]+).?/", $pick, $matches);
		foreach($matches[2] as $key => $color)
		{
			print PHP_EOL. $gameid .": ". $color .": ". $matches[1][$key];
			if(is_null($mins[$color]) || $mins[$color] < $matches[1][$key])
			{
				$mins[$color] = $matches[1][$key];
			}
		}
		print_r($mins);

	}
	$sum_of_games += $mins["red"]*$mins["green"]*$mins["blue"];
}

print "Total: ". $sum_of_games. PHP_EOL;

?>


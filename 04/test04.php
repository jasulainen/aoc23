<?php

$file = file("input.txt");
$total_sum = 0;
$card_amount = array_fill(0,count($file),1);

foreach($file as $key => $row)
{
	$row = trim($row);
	$row = explode(":", $row)[1];
	$row = explode("|", $row);
	$win = readNumbers($row[0]);
	$my = readNumbers($row[1]);
	
	$amount_of_wins = 0;
	foreach($my as $number)
	{
		if(array_search($number, $win) !== FALSE)
		{
			$amount_of_wins++;
		}
	}
	
	if($amount_of_wins > 0)
	{
		for($i=$key+1; $i<=$amount_of_wins+$key; $i++)
		{
			$card_amount[$i]+=$card_amount[$key];
		}
	}
}

print_r($card_amount);
print array_sum($card_amount) . PHP_EOL;

function readNumbers($row)
{
	preg_match_all("/\d+/", $row, $matches);
	return $matches[0];
}

?>


<?php

$file = file("input.txt");
$total_sum = 0;

foreach($file as $row)
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
		$total_sum += pow(2, $amount_of_wins-1);
	
	print $total_sum . PHP_EOL;

}

function readNumbers($row)
{
	preg_match_all("/\d+/", $row, $matches);
	return $matches[0];
}

?>


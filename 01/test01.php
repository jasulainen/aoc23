<?php

$inputArr = file("../input.txt");
$total_sum = 0;

foreach($inputArr as $row)
{
	$matches = array();
	$sum = 0;
	preg_match_all("/\d/", $row, $matches);
	$sum=intval($matches[0][0])*10;
	$sum+= intval($matches[0][count($matches[0])-1]);
	$total_sum += $sum;
}

echo "Total: $total_sum";
?>

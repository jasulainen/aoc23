<?php

$inputArr = file("input.txt");

$total_sum = 0;

// i took a long time figuring out my regex wasnt working and reason was that if i would have traversed
// the string, i would have interpreted last word from the right. I didn't understand that until i got
// example solution in python and tested with my input data if it generates different sum and it really did.
// after that i updated this solutoin with quick and dirty hax :( 

$sr = array(
	"one" => "on1ne",
	"two" => "tw2wo",
	"three" => "thre3hree",
	"four" => "fou4our",
	"five" => "fiv5ive",
	"six" => "si6ix",
	"seven" => "seve7even",
	"eight" => "eigh8ight",
	"nine" => "nin9ine"
);


foreach($inputArr as $row)
{
	$matches = array();
	$sum = 0;
	$row=trim($row);
	print($row. PHP_EOL);
	// sad and fast hax coming..
	$row = preg_replace_callback("/one|two|three|four|five|six|seven|eight|nine/", "matchReplace", $row);
	$row = preg_replace_callback("/one|two|three|four|five|six|seven|eight|nine/", "matchReplace", $row);
	print($row. PHP_EOL);
	preg_match_all("/\d/", $row, $matches);
	$sum=intval($matches[0][0])*10;
	$sum+= intval($matches[0][count($matches[0])-1]);
	$total_sum += $sum;
}

echo "Total: $total_sum";

function matchReplace($matches)
{
	global $sr;
	return $sr[$matches[0]];	
}

?>

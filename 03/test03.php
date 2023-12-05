<?php

$tmpfile = file("input.txt");
foreach($tmpfile as $row )
{
	$file[] = trim($row);
}
$total_sum = 0;
$row_length = strlen($file[0]);

foreach ($file as $rowno => $row)
{
	$number = "";
	$start = null;
	for($pos=0; $pos<$row_length; $pos++)
	{
		if(is_numeric($row[$pos]))
		{
			$number.=$row[$pos];
			if(is_null($start))
			{
				$start=$pos;
			}
		}
		else
		{
			if(!is_null($start) && validate($rowno, $start, $pos-1))
			{
				print $number.PHP_EOL;
				$total_sum += intval($number);
			}
			$number = "";
			$start = null;
		}
	}
	
	if(!is_null($start) && validate($rowno, $start, $row_length-1))
	{
		// last char
		print $number.PHP_EOL;
		$total_sum += intval($number);
	}
}

print PHP_EOL. "Total: ". $total_sum . PHP_EOL;


function validate($rowno, $start, $end)
{
	global $file, $row_length;
	$test_str = "";
	print "Number found at $rowno ($start, $end)". PHP_EOL;

	for($j=$rowno-1; $j<=$rowno+1; $j++)
	{
		for($i=$start-1; $i<=$end+1; $i++)
		{
			if($i<0) $i=0;
			if(isset($file[$j][$i]))
				$test_str .= $file[$j][$i];
			else
				print "Out of bounds" . PHP_EOL;
		}
	}

	print "Test: ". $test_str . PHP_EOL;
	$bool =  preg_match("/[^0-9\.]/", $test_str);
	if(!$bool)
		print "Number skipped". PHP_EOL;
	return $bool;
}


?>

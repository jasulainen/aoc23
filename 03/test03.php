<?php

$tmpfile = file("input.txt");
foreach($tmpfile as $row )
{
	$file[] = trim($row);
}
$total_sum = 0;
$row_length = strlen($file[0]);
$coordinates = array();
$multipliers = array();

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
			if(!is_null($start) && validate($rowno, $start, $pos-1, $number))
			{
				print $number.PHP_EOL;
			}
			$number = "";
			$start = null;
		}
	}
	
	if(!is_null($start) && validate($rowno, $start, $row_length-1, $number))
	{
		// last char
		print $number.PHP_EOL;
	}
}

print PHP_EOL. "Total: ". $total_sum . PHP_EOL;
print "MULTIPLIERS:". PHP_EOL;
print_r($multipliers);


//look around for *
function validate($rowno, $start, $end, $number)
{
	global $file, $row_length, $coordinates, $multipliers, $total_sum;
	print "Number found at $rowno ($start, $end)". PHP_EOL;

	for($j=$rowno-1; $j<=$rowno+1; $j++)
	{
		for($i=$start-1; $i<=$end+1; $i++)
		{
			if($i<0) $i=0;
			if(isset($file[$j][$i]))
			{
				if($file[$j][$i] == "*")
				{
					print "* found at $j : $i" . PHP_EOL;
					if(empty($coordinates[$j][$i]))
					{
						$coordinates[$j][$i] = $number;
					}
					else
					{
						$multipliers[] = array($number, $coordinates[$j][$i]);
						$total_sum += intval($number)*intval($coordinates[$j][$i]);
						// we assume only 2 numbers to be attached to one wheel
						unset($coordinates[$j][$i]);
					}
				}

			}
		}
	}

	return false;
}


?>

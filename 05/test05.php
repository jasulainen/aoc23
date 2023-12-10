<?php
$file = file("input.txt");

preg_match_all("/\d+/", $file[0], $matches);
$seeds_trans = $matches[0];
$numbers = array();
$file[] = "\n";

foreach($file as $key => $row)
{
	if($key <2)
		continue;
	
	preg_match_all("/\d+/", $row,  $matches);
	if(empty($matches[0]))
	{
		// reset
		if(!empty($numbers))
		{
			translateMap($numbers);
			$numbers = array();

		}

		continue;
	}
	
	$numbers[] = $matches[0];

}

print_r($seeds_trans);
print "MIN: ". min($seeds_trans);


function translateMap ($numbers)
{
	global $seeds_trans;
	foreach($seeds_trans as $source_key => $source)
	{
		foreach($numbers as $row)
		{
			//osuuko
			if(($row[1] <= $source) && ($source <= ($row[1]+$row[2])))
			{
				print $row[1] ." <= $source && $source <= ". ($row[1]+$row[2]).PHP_EOL;
				$seeds_trans[$source_key] =  $row[0]+($source-$row[1]);
				print ("Translation: $source --> ". $seeds_trans[$source_key]. PHP_EOL);
				break;
			}
		}
	}
}

?>

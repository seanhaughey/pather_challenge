<?php
$handle = fopen("input-2.txt", "r");
$output = fopen("output.txt", "w");
$string = file_get_contents('input-2.txt');
$hash_markers = [];
$hash_loc = '0';
$hash_count = 0;

// find hash locations and save to an array
while ($hash_loc !== false) :
	$hash_loc = strpos($string, '#', $hash_loc+1);
	if ($hash_loc) {
		array_push($hash_markers, $hash_loc);
		$hash_count++;
	}
endwhile;
echo "count: $hash_count<br>";
foreach ($hash_markers as $marker) {
	echo "marker: $marker<br>";
}
// for loop runs for each hash character determined by the counter
for ($j = 0; $j < $hash_count-1; $j++) :
	// calculate vertical distance between the hashes
	$vertical = ceil($hash_markers[$j+1]/25) - ceil($hash_markers[$j]/25);
	echo "vertical = $vertical<br>";
	for ($i = 0; $i < $vertical; $i++) {
		$index = $hash_markers[$j] + 25;	
			echo "string: $string[$index]<br>";
			if ($string[$index] == "#"){
				$hash_markers[$j] += 25;
			} else {
			$string = substr_replace($string, '*', $hash_markers[$j]+25, 1);
			$hash_markers[$j] += 25;
			}
	}
	echo "hash marker = $hash_markers[$j]<br>";
	$x = $j + 1;
	echo "hash marker + 1 = $hash_markers[$x]<br>";

	$horizontal = $hash_markers[$j+1] - $hash_markers[$j];
	echo "horizontal = $horizontal<br>";
	if ($horizontal >= 0) :
		for ($i = 0; $i < $horizontal-1; $i++) {
			$string = substr_replace($string, '*', $hash_markers[$j]+1, 1);
			$hash_markers[$j] += 1;
		}
	else :
		$horizontal = abs($horizontal);
		for ($i = $horizontal-1; $i > 0; $i--) {
			$string = substr_replace($string, '*', $hash_markers[$j]-1, 1);
			$hash_markers[$j] -= 1;			
		}
	endif;
endfor;
$arr = str_split($string);
for ($i = 0; $i < count($arr); $i++) :
	if (ctype_space($arr[$i])) {
		$arr[$i] = "<br>";
	}
	echo $arr[$i];
endfor;

fwrite($output, $string);
fclose($output);

?>
<?php
$input = fopen("input-4.txt", "r");
$output = fopen("output.txt", "w");
// convert input.txt to string
$string = file_get_contents('input-4.txt');
$hash_markers = [];
$hash_loc = '0';
$hash_count = 0;
// convert string file to array
$arr = str_split($string);
$height = 0;
// determine the height of the rectangle
foreach ($arr as $value) {
	if ($value !== '.' && $value !== '#'):
		$height++;
	endif;
}

echo "height: $height<br>";
// determine the width of the rectangle
$width = count($arr)/$height;

echo "width: $width<br>";

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
	$vertical = ceil($hash_markers[$j+1]/$width) - ceil($hash_markers[$j]/$width);
	echo "vertical = $vertical<br>";
	// vertically replace non-hash characters with asterisks
	for ($i = 0; $i < $vertical; $i++) {
		$index = $hash_markers[$j] + $width;	
			if ($string[$index] == "#"){
				$hash_markers[$j] += $width;
			} else {
			$string = substr_replace($string, '*', $hash_markers[$j]+$width, 1);
			$hash_markers[$j] += $width;
			}
	}
	// calculate horizontal distance between the hashes
	$horizontal = $hash_markers[$j+1] - $hash_markers[$j];
	echo "horizontal = $horizontal<br>";
	// if horizontal distance is positive replace dots with asterisks from left to right
	if ($horizontal >= 0) :
		for ($i = 0; $i < $horizontal-1; $i++) {
			$string = substr_replace($string, '*', $hash_markers[$j]+1, 1);
			$hash_markers[$j] += 1;
		}
	// if horizontal distance is negative replace dots with asterisks from right to left
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
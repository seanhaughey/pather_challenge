<?php
$handle = fopen("input-4.txt", "r");
$output = fopen("output.txt", "w");
$string = file_get_contents('input-4.txt');
$hash_markers = [];
//echo input file
// if ($handle) {
//     while (($buffer = fgets($handle, 4096)) !== false) {
//         echo ($buffer) . '<br>';
//     }
//     if (!feof($handle)) {
//         echo "Error: unexpected fgets() fail\n";
//     }
// }
// echo '<br>';
$hash_loc = '0';
$hash_count = 0;
// finds hash locations and saves to an array
while ($hash_loc !== false) {
	$hash_loc = strpos($string, '#', $hash_loc+1);
	if ($hash_loc) {
		array_push($hash_markers, $hash_loc);
		$hash_count++;
	}
}
echo "count: $hash_count<br>";
foreach ($hash_markers as $marker) {
	echo "marker: $marker<br>";
}
for ($j = 0; $j < $hash_count-1; $j++) {
	$vertical = ceil($hash_markers[$j+1]/25) - ceil($hash_markers[$j]/25);
	echo "vertical = $vertical<br>";
	for ($i = 0; $i < $vertical; $i++) {
		$index = $hash_markers[$j] + 25;	
			echo "string: $string[$index]<br>";
			$string = substr_replace($string, '*', $hash_markers[$j]+25, 1);
			$hash_markers[$j] += 25;
	}
	echo "hash marker = $hash_markers[$j]<br>";

	$horizontal = $hash_markers[$j+1] - $hash_markers[$j];
	echo "horizontal = $horizontal<br>";
	if ($horizontal >= 0) {
		for ($i = 0; $i < $horizontal-1; $i++) {
			$string = substr_replace($string, '*', $hash_markers[$j]+1, 1);
			$hash_markers[$j] += 1;
		}
	} else {
		$horizontal = abs($horizontal);
		for ($i = $horizontal-1; $i > 0; $i--) {
			$string = substr_replace($string, '*', $hash_markers[$j]-1, 1);
			$hash_markers[$j] -= 1;			
		}
	}
}
$arr = str_split($string);
for ($i = 0; $i < count($arr); $i++) {
	if (ctype_space($arr[$i])) {
		$arr[$i] = "<br>";
	}
	echo $arr[$i];
}

fwrite($output, $string);
fclose($output);

?>
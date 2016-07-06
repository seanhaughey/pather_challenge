<?php
$handle = fopen("input-3.txt", "r");
$string = file_get_contents('input-3.txt');
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
while($hash_loc !== false){
	$hash_loc = strpos($string, '#', $hash_loc+1);
	if($hash_loc){
		array_push($hash_markers, $hash_loc);
		$hash_count++;
	}
}
echo "count: $hash_count<br>";
foreach($hash_markers as $marker){
	echo "marker: $marker<br>";
}

$horizontal = ceil($hash_markers[1]/25) - ceil($hash_markers[0]/25);
echo $horizontal . "<br>";
for($i=0; $i<$horizontal; $i++){
	$string = substr_replace($string, '*', $hash_markers[0]+25, 1);
	$hash_markers[0] += 25;
}
echo "hash marker 0 = $hash_markers[0]<br>";

$vertical = $hash_markers[1] - $hash_markers[0];
echo "vertical = $vertical<br>";
for($i=0; $i<$vertical-1; $i++){
	$string = substr_replace($string, '*', $hash_markers[0]+1, 1);
	$hash_markers[0] += 1;
}

// $string = strtr($string, ".", "\n");
$arr = str_split($string);
for($i=0; $i<count($arr); $i++){
	if (ctype_space($arr[$i])){
		$arr[$i] = "<br>";
	}
	echo $arr[$i];
}
//echo $string;
file_put_contents("../solution.txt", $string);

?>
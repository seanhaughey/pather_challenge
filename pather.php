<?php
$handle = fopen("input.txt", "r");
$string = file_get_contents('input.txt');
$hash_markers = [];
//echo $string;
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        echo ($buffer) . '<br>';
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
}
echo '<br>';
$hash_loc = '0';
$hash_count = -1;
while($hash_loc !== false){
	$hash_loc = strpos($string, '#', $hash_loc+1);
	if($hash_loc){
		array_push($hash_markers, $hash_loc);
		$hash_count++;
	}
}
foreach($hash_markers as $marker){
	echo "marker: $marker<br>";
	$string = substr_replace($string, '*', $marker+25, 1);
}
echo $string;

?>
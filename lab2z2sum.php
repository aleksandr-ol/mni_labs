<?php

//$na = array(2, 4, 6, 7, 9, 12, 13, 15, 15, 16, 16);
//$nb = array(2, 4, 6, 9, 9, 11, 12, 15);

$SumArray = array();
$na = explode(",",$_POST['mn_A']);
$nb = explode(",",$_POST['mn_B']);

$response_html = 
"<table  class=\"table table-bordered\">
	<thead>
	<tr>
		<th>i</th>
		<th>j</th>
		<th>k</th>
		<th>a[i]</th>
		<th>b[j]</th>
		<th>a[i]&lt;b[j]</th>
		<th>a[i]&gt;b[j]</th>
		<th>c</th>
	</tr>
	</thead>
	<tbody>";

function merge_sum ($a, $b, $i = 0, $j = 0){
	global $SumArray;
	global $response_html;

	$response_html = $response_html .
		"<tr>
			<td>  $i </td>
			<td> $j </td>
			<td>" . count($SumArray) . "</td>
			<td> $a[$i] </td>
			<td> $b[$j] </td>
			<td>";
			if($a[$i] < $b[$j]) 
				$response_html = $response_html . "так</td><td>";
			else
				$response_html = $response_html . "ні</td><td>";
			if($a[$i] > $b[$j])
				$response_html = $response_html . "так</td>";
			else
				$response_html = $response_html . "ні</td>";
			$response_html = $response_html . "<td>" . implode(",", $SumArray) . "</td>
		</tr>";

	//Проходимо обидва масиви методом злиття
	if (count($a) > $i){
		if ($a[$i] < $b[$j]) {
			array_push($SumArray, $a[$i]);
			merge_sum($a, $b, $i+1, $j);
		} elseif ($a[$i] > $b[$j]) {
			array_push($SumArray, $b[$j]);
			merge_sum($a, $b, $i, $j+1);
		} elseif ($a[$i] == $b[$j]) {
			array_push($SumArray, $a[$i]);
			array_push($SumArray, $a[$i]);
			merge_sum($a, $b, $i+1, $j+1);
		}
	}elseif (count($b) > $j) {
			array_push($SumArray, $b[$j]);
			merge_sum($a, $b, $i, $j+1);
	}
	//Проходимо обидва масиви методом злиття
}

merge_sum($nb, $na);
$response_html = $response_html . "</tbody></table>";
$result = array(
	'htmlTable' => $response_html
);

print_r(json_encode($result));

?>
<?php

//$na = array(2, 4, 6, 7, 9, 12, 13, 15, 15, 16, 16);
//$nb = array(2, 4, 6, 9, 9, 11, 12, 15);

$na = explode(",",$_POST['mn_A']);
$nb = explode(",",$_POST['mn_B']);

$response_html = 
"<table  class=\"table table-bordered\">
	<thead>
	<tr>
		<th>i</th>
		<th>j</th>
		<th>a[i]</th>
		<th>b[j]</th>
		<th>a[i]&lt;b[j]</th>
		<th>a[i]&gt;b[j]</th>
	</tr>
	</thead>
	<tbody>";

$booleanResults = array();

function merge_is_sub ($a, $b, $i = 0, $j = 0){
	global $booleanResults;
	global $response_html;

	$response_html = $response_html .
	"<tr>
		<td> $i </td>
		<td> $j </td>
		<td> $a[$i] </td>
		<td> $b[$j] </td>
		<td>";
		if($a[$i] < $b[$j]) 
			$response_html = $response_html . "так</td><td>";
		else
			$response_html = $response_html . "ні</td><td>";
		if($a[$i] > $b[$j])
			$response_html = $response_html . "так</td></tr>";
		else
			$response_html = $response_html . "ні</td></tr>";

	//Проходимо обидва масиви методом злиття, якщо в масиві А ще є елементи
	if (count($a) > $i){
		if ($a[$i] < $b[$j]) {
			array_push($booleanResults, false);
		} elseif ($a[$i] > $b[$j]) {
			if (count($b) > $j){
				merge_is_sub($a, $b, $i, $j+1);
				array_push($booleanResults, true);
			} else
				array_push($booleanResults, false);
		} elseif ($a[$i] == $b[$j]) {
			merge_is_sub($a, $b, $i+1, $j+1);
			array_push($booleanResults, true);
		}
	}
	//Проходимо обидва масиви методом злиття, якщо в масиві А ще є елементи

	if ($i == 0 and $j == 0){
		$booleanResults = array_unique($booleanResults);
		foreach ($booleanResults as $value)
			if (!$value)
				return "<div class = \"col\">B не являється підмножиною A</div>";
		return "<div class = \"col\">B Являється підмножиною A</div>";
	}
}

$result = merge_is_sub($nb, $na);
$response_html = $response_html . "</tbody></table>";
$result = array(
	'htmlTable' => $response_html,
	'result' => $result
);

print_r(json_encode($result));

?>
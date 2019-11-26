<!DOCTYPE html>
<html>
<head>
	<title>Вибрані питання інформатики</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<style type="text/css">
		.differentTable td, .differentTable th{
		   border-color: black;
		}
	</style>
</head>
<body>
<div class="row justify-content-center">
	<div class = "col">
		<h1>ЛР №9. Евристичний жадібний алгоритм розв’язування задачі комівояжера</h1>
	</div>
</div>
<div class="row">
	<div class="col">
		<p><b>Матриця: </b></p>
	</div>
	<div class="col">
	<table class = "table table-bordered differentTable">
	<thead></thead>
	<tbody>
<?php
// де 999 - нескінченність (більше ніж всі решта елементів)
$inf = 999;
$p = array (
	array($inf, 47, 10, 45, 10),
	array(35, $inf, 9, 7, 6),
	array(15, 11, $inf, 3, 4),
	array(17, 2, 3, $inf, 6),
	array(5, 48, 48, 30 , $inf)
);

foreach ($p as $value) {
	echo "<tr>";
	foreach ($value as $v) {
		echo "<td>$v</td>";
	}
	echo "<tr>";
}
?>
	</tbody>
	</table>
	</div>
	<div class="col"></div>
</div>
<table  class="table table-bordered differentTable">
	<thead>
	<tr>
		<th>r</th>
		<th>c</th>
		<th>m</th>
		<th>j</th>
		<th>j - позн.</th>
		<th>ел. менше m</th>
		<th>Позначки</th>
		<th>Маршрут</th>
	</tr>
	</thead>
	<tbody>
<?php
function echo_row ($r, $chek_p, $route, $m = "", $c = "", $j = ""){
	global $p;

	?>
		<tr>
			<td> <?php echo $r; ?> </td>
			<td> <?php echo ($c !== 0 ? $c:""); ?> </td>
			<td> <?php echo $m; ?> </td>
			<td> <?php echo $j; ?> </td>
			<td> <?php echo ($chek_p[$j] == 1  ? "+":"-"); ?> </td>
			<td> <?php echo $p[$r][$j] . "<" . $m . ($p[$r][$j] < $m ? "+":"-"); ?> </td>
			<td> <?php echo implode(",", $chek_p); ?> </td>
			<td> <?php echo implode(",", $route); ?> </td>
		</tr>

	<?php
}

$n = count($p);
$route = array ();

//об'являємо масив непозначених вершин, записавши 0 (коли відвідаєм озапишемо 1)
$chek_p = array();
for ($i=0; $i < $n; $i++)
		$chek_p[$i] = 0;
//об'являємо масив непозначених вершин, записавши 0 (коли відвідаєм озапишемо 1)

$r = 0;
$min = 999;
$chek_p[$r] = 1;
echo_row($r, $chek_p, $route);
for ($i=0; $i < $n; $i++) { 
	foreach ($p[$r] as $key => $value) {
		if(($chek_p[$key] !== 1) and ($value < $min)){
			$min = $value;
			$min_key = $key;
		}
		echo_row($r, $chek_p, $route, $min, $min_key, $key);
	}
	array_push($route, $min_key);
	$chek_p[$min_key] = 1;
	$r = $min_key;
	$min = $inf;
	$min_key = 0;
	echo_row($r, $chek_p, $route, $min, $min_key);
}

?>
	</tbody>
</table>
<pre>
<?php
	//print_r($route);
?>
</pre>
</body>
</html>
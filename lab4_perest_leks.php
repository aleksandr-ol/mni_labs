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
	<h1>ЛР №4. Лексикографічна генерація перестановок</h1>
</div>
<?php

$na = array (1, 1, 2, 7);

$result = array();

?>
<div class="row">
	<div class="col"><b>Масив: </b><?php echo implode(",", $na); ?></div>
</div>
<table  class="table table-bordered differentTable">
	<thead>
	<tr>
		<th>i</th>
		<th>i &gt; 0</th>
		<th>p[i-1] &gt;= p[i]</th>
		<th>j</th>
		<th>p[i-1] &gt;= p[j]</th>
		<th>s</th>
		<th>p</th>
		<th>Перестановки</th>
	</tr>
	</thead>
	<tbody>
<?php

function echo_row ($i, $j, $s, $result = array()){
	global $na;

	?>
		<tr>
			<td> <?php echo $i; ?> </td>
			<td> <?php echo $i . " > 0" . ($i>0 ? "+":"-"); ?> </td>
			<td> <?php echo $na[$i-1] . " >= " . $na[$i] . ($na[$i-1] >= $na[$i] ? "+":"-"); ?> </td>
			<td> <?php echo $j; ?> </td>
			<td> <?php echo $na[$i-1] . " >= " . $na[$j] . ($na[$i-1] >= $na[$j] ? "+":"-"); ?> </td>
			<td> <?php echo $s; ?> </td>
			<td> <?php echo implode(",", $na); ?> </td>
			<td> <?php echo implode(",", $result); ?> </td>
		</tr>

	<?php
}

function rearrangement (){
	global $na;
	global $result;

	$i = count($na) - 1;
	while ($i > 0 and $na[$i-1] >= $na[$i]){
		echo_row($i, $j, $s);
		$i = $i-1;
	}
	if ($i == 0)
		return false;

	$j = count($na) - 1;
	while ($na[$i-1] >= $na[$j]) { 
		echo_row($i, $j, $s);
		$j = $j-1;
	}

	echo_row($i, $j, $s);

	$temp = $na[$j];
	$na[$j] = $na[$i-1];
	$na[$i-1] = $temp;

	for ($s=0; $s < (count($na) - $i)/2; $s++) { 
		echo_row($i, $j, $s);
		$temp = $na[$i + $s];
		$na[$i + $s] = $na[count($na) - $s - 1];
		$na[count($na) - $s - 1] = $temp;
	}
	echo_row($i, $j, $s, $na);
	array_push($result, $na);
	return true;
}

do {
	$chek = rearrangement();
}while ($chek);

?>
</tbody>
</table>
<div class="row">
	<div class="col"><b>Перестановки: </b>
		<?php
		foreach ($result as $key => $value)
			echo "<i>$key</i> => (<i><b>" . implode(",", $value) . "</b></i>); ";
		?>
	</div>
</div>
</body>
</html>
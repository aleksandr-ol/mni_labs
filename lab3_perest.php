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
	<h1>ЛР №3. Рекурсивний алгоритм генерації перестановок</h1>
</div>
<?php

$na = array(3, 5, 2);

$result = array();

?>
<div class="row">
	<div class="col"><b>Масив: </b><?php echo implode(",", $na); ?></div>
</div>

<table  class="table table-bordered differentTable">
	<thead>
	<tr>
		<th>Генерувати</th>
		<th>k&lt;n</th>
		<th>k</th>
		<th>j</th>
		<th>Переставити</th>
		<th>c</th>
	</tr>
	</thead>
	<tbody>
<?php

function rearrangement ($k){
	global $na;
	global $result;

?>
	<tr>
		<td><?php echo "Генерувати(" . $k . ")"; ?></td>
		<td></td>
		<td> <?php echo $k; ?> </td>
		<td></td>
		<td></td>
		<td> <?php echo implode(",", $na); ?> </td>
	</tr>

<?php

	//Проходимо обидва масиви методом злиття
	if ($k < count($na)){
		for ($i=$k; $i < count($na); $i++) { 
			$temp = $na[$i];
			$na[$i] = $na[$k];
			$na[$k] = $temp;

			?>
				<tr>
					<td></td>
					<td> <?php echo $k . " &lt; " . count($na); ?> </td>
					<td> <?php echo $k; ?> </td>
					<td> <?php echo $i; ?> </td>
					<td> <?php echo "Переставити(" . $na[$i] . ", " . $na[$k] . ")"; ?> </td>
					<td> <?php echo implode(",", $na); ?> </td>
				</tr>
			<?php

			rearrangement($k+1);

			$temp = $na[$i];
			$na[$i] = $na[$k];
			$na[$k] = $temp;

			?>
				<tr>
					<td></td>
					<td> <?php echo $k . " &lt; " . count($na); ?> </td>
					<td> <?php echo $k; ?> </td>
					<td> <?php echo $i; ?> </td>
					<td> <?php echo "Переставити(" . $na[$i] . ", " . $na[$k] . ")"; ?> </td>
					<td> <?php echo implode(",", $na); ?> </td>
				</tr>
			<?php
		}
	}else {
		?>
			<tr>
				<td></td>
				<td></td>
				<td> <?php echo $k; ?> </td>
				<td></td>
				<td> <?php echo "Вивести (" . implode(",", $na) . ")"; ?> </td>
				<td> <?php echo implode(",", $na); ?> </td>
			</tr>

		<?php
		array_push($result, $na);
	}
	//Проходимо обидва масиви методом злиття
}

rearrangement(0);

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
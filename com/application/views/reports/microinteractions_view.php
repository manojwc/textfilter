<!DOCTYPE html>
<html>
<head>
	<title>Micro-Interactions</title>
</head>
<body>
	<h2>Micro-interactions by Date</h2>
	<table border="1">
		<tr>
			<th>Day</th>
			<th>Number of micro-interactions</th>
			
			
		</tr>
		<tbody>
			<?php foreach ($daywise as $key => $one_day): ?>
				<tr>
					<td><?php echo $one_day["activity_date"] ?></td>
					<td><?php echo $one_day["count"] ?></td>
					
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>
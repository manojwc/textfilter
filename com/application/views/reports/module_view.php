<!DOCTYPE html>
<html>
<head>
	<title>Module Report</title>
</head>
<body>
	<table border="1">
		<tr>
			<th>Learner Id</th>
			<th>Email</th>
			<th>Total Pages Complete</th>
			<th>Percentage</th>
		</tr>
	<?php foreach ($module_data as $key => $module): ?>
		<tr>
			<td><?php echo $module["learner_id"] ?></td>
			<td><?php echo $module["email"] ?></td>
			<td><?php echo $module["totalComplete"] ?></td>
			<td><?php echo $module["percentage"] ?></td>
		</tr>
	<?php endforeach ?>
	
	</table>
</body>
</html>
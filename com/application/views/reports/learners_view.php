<!DOCTYPE html>
<html>
<head>
	<title>Learners</title>
</head>
<body>
	<h2>Accessed Learners Completions</h2>
	<table border="1">
		<tr>
			<th>Learner Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>FIrst Accessed</th>
			<th>Completed Topics</th>
			
		</tr>
		<tbody>
			<?php foreach ($learner_topics as $key => $learner): ?>
				<tr>
					<td><?php echo $learner["learner_id"] ?></td>
					<td><?php echo $learner["first_name"] ?></td>
					<td><?php echo $learner["last_name"] ?></td>
					<td><?php echo $learner["email"] ?></td>
					<td><?php echo $learner["first_accessed_on"] ?></td>
					<td><?php echo $learner["count"] ?></td>
					
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>
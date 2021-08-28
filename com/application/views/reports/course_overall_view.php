<!DOCTYPE html>
<html>
<head>
	<title>Course Overall</title>
</head>
<body>

	<!-- <h2>Unique Users: <?php echo sizeof($unique_users);?></h2>
	<table border="1">
		<tr>
			<th>Learner Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>First Accessed On</th>
			
		</tr>
		<tbody>
			<?php foreach ($unique_users as $key => $learner): ?>
				<tr>
					<td><?php echo $learner["learner_id"] ?></td>
					<td><?php echo $learner["first_name"] ?></td>
					<td><?php echo $learner["last_name"] ?></td>
					<td><?php echo $learner["email"] ?></td>
					<td><?php echo $learner["activity_date"] ?></td>
					
				</tr>
			<?php endforeach ?>
		</tbody>
	</table> -->

	<h2>Completed Topics:</h2>
	<table border="1">
		<tr>
			<th>Learner Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Completed Topics</th>
			
		</tr>
		<tbody>
			<?php foreach ($learner_topics as $key => $learner): ?>
				<tr>
					<td><?php echo $learner["learner_id"] ?></td>
					<td><?php echo $learner["first_name"] ?></td>
					<td><?php echo $learner["last_name"] ?></td>
					<td><?php echo $learner["email"] ?></td>
					<td><?php echo $learner["count"] ?></td>
					
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<h2>All Component Views</h2>
	<table border="1">
		<tr>
			<th>Comp Id</th>
			<th>Module Title</th>
			<th>Topic Title</th>
			<th>Comp Title</th>
			<th>Comp Type</th>
			<th>Views</th>
		</tr>
		<tbody>
			<?php foreach ($course_comp_views as $key => $comp): ?>
				<tr>
					<td><?php echo $comp["comp_id"] ?></td>
					<td><?php echo $comp["moduleTitle"] ?></td>
					<td><?php echo $comp["topicTitle"] ?></td>
					<td><?php echo $comp["title"] ?></td>
					<td><?php echo $comp["type"] ?></td>
					<td><?php echo $comp["views"] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<h2>All Component Likes</h2>
	<table border="1">
		<tr>
			<th>Comp Id</th>
			<th>Comp Title</th>
			<th>Comp Type</th>
			<th>Likes</th>
		</tr>
		<tbody>
			<?php foreach ($course_comp_likes as $key => $comp): ?>
				<tr>
					<td><?php echo $comp["comp_id"] ?></td>
					<td><?php echo $comp["title"] ?></td>
					<td><?php echo $comp["type"] ?></td>
					<td><?php echo $comp["likes"] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Components Report</title>
</head>
<body>
	<table border="1">
		<tr>
			<th>Comp Id</th>
			<!-- <th></th> -->
			<th>Module Title</th>
			<th>Topic Title</th>
			<th>Page Title</th>
			<th>Component Title</th>
			<th>Comp Type</th>
			<th>Course Type</th>
			<th>Views</th>
			<th>Completed</th>
		</tr>
	<?php foreach ($course_comp_views as $key => $comp_views):
			if($comp_views["type"] != "question" && $comp_views["type"] != "text"){
	?>

		<tr>
			<td><?php echo $comp_views["comp_id"] ?></td>
			<!-- <td><?php echo $course_comp_likes[$key]["comp_id"] ?></td> -->
			<td><?php echo $comp_views["moduleTitle"] ?></td>
			<td><?php echo $comp_views["topicTitle"] ?></td>
			<td><?php echo $comp_views["pageTitle"] ?></td>
			<td><?php echo $comp_views["title"] ?></td>
			<td><?php echo ucfirst($comp_views["type"]) ?></td>
			<td><?php echo ucfirst($comp_views["source_type"]) ?></td>
			<td><?php echo $comp_views["views"] ?></td>
			<!-- Taking value for same comp_id from $course_comp_likes array -->
			<td><?php echo $course_comp_likes[$key]["likes"] ?></td>

		</tr>
	<?php } endforeach ?>

	</table>
</body>
</html>
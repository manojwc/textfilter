<!DOCTYPE html>
<html>
<head>
	<title>Page Report</title>
</head>
<body>
	<table border="1">
		<tr>
			<th>Page Id</th>
			<th>Module Title</th>
			<th>Topic Title</th>
			<th>Page Title</th>
			<th>Visits</th>			
			<th>Completed</th>
		</tr>
	<?php foreach ($page_visits as $key => $page): ?>
		<tr>
			<td><?php echo $page["page_id"] ?></td>
			<td><?php echo $page["moduleTitle"] ?></td>
			<td><?php echo $page["topicTitle"] ?></td>
			<td><?php echo $page["title"] ?></td>
			<td><?php echo $page["total"] ?></td>			
			<!-- Taking value for same page_id from $page_completions array -->
			<td><?php echo $page_completions[$key]["total"] ?></td>
			
		</tr>
	<?php endforeach ?>
	
	</table>
</body>
</html>
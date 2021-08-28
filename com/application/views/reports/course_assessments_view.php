<!DOCTYPE html>
<html>
<head>
	<title>Course Assessments Report</title>
</head>
<body>
	<table border="1">
		<tr>
			<th>Assessment</th>
			<th>Has Recommendations</th>
			<th>Required Score</th>
			<th>Total Attempts</th>
			<th>Distinct Learners</th>
			<th>Started</th>
			<th>Passed</th>
			<th>Failed</th>
			<th>Pass Percentage</th>
			<th>Details</th>

		</tr>
	<?php foreach ($all_assessments as $key => $assessment): ?>
		<tr>
			<td><?php echo $assessment["title"] ?></td>
			<td><?php echo ($assessment["recommendation_level"] == "none") ? "No" : "Yes" ?></td>
			<td><?php echo $assessment["required_score"] ?></td>
			<td><?php echo $assessment["total_attempts"] ?></td>
			<td><?php echo $assessment["total_learners"] ?></td>
			<td><?php echo $assessment["started"] ?></td>
			<td><?php echo $assessment["passed"] ?></td>
			<td><?php echo $assessment["failed"] ?></td>
			<td><?php echo round(($assessment["passed"]/$assessment["total_attempts"])*100)?></td>
			<td><a href="../../reports/assessment_question_stats/<?php echo $assessment['assess_id'] ?>" target="_blank">Details</a></td>
		</tr>
	<?php endforeach ?>

	</table>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Assessments Detailed Report</title>
	<style type="text/css">
		th{
			background-color: #D8D8D8
		}
	</style>
</head>
<body style="font-family: 'Calibri'; font-size: 16px">

	<?php foreach ($course_assessments as $key => $assessment):
			echo "<div style='background-color: #81DAF5; font-size: 20px; font-weight: bold'>".$assessment["title"] ." - ID(". $assessment["assess_id"].")</div>";
			if($assessment["assess_type"] == "module_assessment"){
	?>
	<table border="1">
		<tr>
			<th>Question</th>
			<th>Number of times answered</th>
			<th>Correctly answered</th>
			<th>Correctly answered percentage</th>
			<th>Option num</th>
			<th>Option text</th>
			<th>Option selected count</th>
		</tr>
	<?php foreach ($assessment["all_questions"] as $key_1 => $questions): ?>
		<tr>
			<td rowspan="<?php echo sizeof($questions['options']) + 1?>"><?php echo $questions["question_text"] ?></td>
			<td rowspan="<?php echo sizeof($questions['options']) + 1 ?>"><?php echo $questions["total_attempts"] ?></td>
			<td rowspan="<?php echo sizeof($questions['options']) + 1 ?>"><?php echo $questions["total_correct"] ?></td>
			<td rowspan="<?php echo sizeof($questions['options']) + 1 ?>"><?php echo round(($questions["total_correct"]/$questions["total_attempts"]) * 100) ?>%</td>
		</tr>
		<?php
			foreach ($questions["options"] as $key_2 => $option){
				echo "<tr>";
				echo "<td>".($key_2+1)."</td>";
				if($option["is_correct"] == 1){
					echo "<td style='background-color: #E0F8E0'>".$option["option_text"]."</td>";
				}else{
					echo "<td>".$option["option_text"]."</td>";
				}
				echo "<td>".$option["total_selects"]."</td>";
				echo "</tr>";
			}
		?>

	<?php endforeach ?>
	</table>
	<?php } endforeach ?>


</body>
</html>
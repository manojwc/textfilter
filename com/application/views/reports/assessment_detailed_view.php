<!DOCTYPE html>
<html>
<head>
	<title>Assessments Detailed Report</title>
</head>
<body style="font-family: 'Calibri'; font-size: 13px">
	<table border="1">
		<tr>
			<th>Question</th>
			<th>Total Attempts</th>
			<th>Correctly Answered</th>
			<th>Correct Percentage</th>
			<th>Option Num</th>
			<th>Option Text</th>
			<th>Selected</th>
		</tr>
	<?php foreach ($all_questions as $key => $questions): ?>
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
</body>
</html>
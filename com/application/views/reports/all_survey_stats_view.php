<!DOCTYPE html>
<html>
<head>
	<title>Survey Results</title>
	<style type="text/css">
		body{
			font-family: 'Calibri'; font-size: 12pt;
		}
		th{
			background-color: #D8D8D8
		}
		.moduleTitle{
			font-size: 16pt;
			font-weight: bold;
		}
		.subTitle{
			font-size: 14pt;
			font-weight: bold;
		}
		.questionTitle{
			font-size: 14pt;

		}
		.textResponse{
			font-size: 10pt;
			color: #333;
		}
	</style>
</head>
<body>

	<table>
		<tr>
			<th>Module Title</th>
			<th>Total Responses</th>
			<th>Excellent</th>
			<th>Good</th>
			<th>Satisfactory</th>
			<th>Poor</th>
			<th>Very Poor</th>
		</tr>

<?php foreach ($all_surveys as $key => $survey):
	echo '<tr>';
	echo '<td>'.$survey["module_title"].'</td>';
	echo '<td>'.$survey["stats"]["total_responses"].'</td>';
?>

	<?php foreach ($survey["stats"]["components"] as $key => $comp): ?>

		<?php if($comp["question"]["question_type"] == "single_select"){ ?>

			<?php foreach ($comp["responses"] as $key => $option){
				$option_percentage = (($option["count"]/$survey["stats"]["total_responses"])*100);
				$integerVal = intval($option_percentage);
				$rounded_option_percentage = ($option_percentage - $integerVal < 0.5) ? floor($option_percentage) : ceil($option_percentage);


				//echo '<td>'.$option["option_text"].'</td>';
				//echo '<td>'.$option["count"].'</td>';
				echo '<td>'.$rounded_option_percentage.'%</td>';

			} ?>

	<?php } endforeach ?>
	</tr>
<?php endforeach ?>
</table>
</body>
</html>


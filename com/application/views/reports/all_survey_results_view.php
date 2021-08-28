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
			background-color: #33D3D9;
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
		.dateText{
			font-size: 9pt;
			color: #666;
		}
	</style>
</head>
<body>

<?php foreach ($all_surveys as $key => $survey):
	echo "<table><tr><td colspan='3' class='moduleTitle'>".$survey["module_title"]."</td></tr></table>";
	echo "<table><tr class='subTitle'><td>Total Responses: </td><td colspan='2'>".$survey["stats"]["total_responses"]."</td></tr></table>";
?>

<?php foreach ($survey["stats"]["components"] as $key => $comp): ?>
	<table><tr><td colspan="3">&nbsp;</td></tr></table>
	<table border="1"><tr><td colspan="3" class="questionTitle"><?php echo $comp["question"]["question_text"] ?></td></tr></table>
	<?php if($comp["question"]["question_type"] == "single_select"){ ?>
		<table border="1">
			<tr>
				<th>Option</th>
				<th>Count</th>
				<th>Percentage</th>
			</tr>

		<?php foreach ($comp["responses"] as $key => $option){
			$option_percentage = (($option["count"]/$survey["stats"]["total_responses"])*100);
			$integerVal = intval($option_percentage);
			$rounded_option_percentage = ($option_percentage - $integerVal < 0.5) ? floor($option_percentage) : ceil($option_percentage);

			echo '<tr>';
			echo '<td>'.$option["option_text"].'</td>';
			echo '<td>'.$option["count"].'</td>';
			echo '<td>'.$rounded_option_percentage.'%</td>';
			echo '</tr>';
		} ?>

		</table>



	<?php } else if($comp["question"]["question_type"] == "text_entry"){ ?>
		<table border="1">

			<?php foreach ($comp["responses"] as $key => $learner_response){
				echo '<tr>';
				echo '<td align="left" class="dateText">'.$learner_response["response_date"].'</td>';
				echo '<td colspan="2" class="textResponse">';
				$combined_response = explode("$#$", $learner_response["response"]);
				//echo '<ul>';
				foreach ($combined_response as $key => $single_response) {

					if($single_response != ""){
						//echo '<li>'.$single_response.'</li>';
						echo  $single_response;

					}

				}
				//echo '</ul>';
				echo '</td></tr>';
			} ?>
		</table>
	<?php } else{}?>
<?php endforeach ?>
<table><tr><td colspan="3">&nbsp;</td></tr></table>
<table><tr><td colspan="3">&nbsp;</td></tr></table>
<?php endforeach ?>
</body>
</html>


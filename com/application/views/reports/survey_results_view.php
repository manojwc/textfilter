<!DOCTYPE html>
<html>
<head>
	<title>Survey Results</title>
</head>
<body>

<?php foreach ($survey_comps as $key => $comp): ?>
	<h3><?php echo $comp["question"]["question_text"] ?></h3>
	<?php if($comp["question"]["question_type"] == "single_select"){ ?>
		<table border="1">
			<tr>
				<th>Option</th>
				<th>Count</th>
				<th>Percentage</th>
			</tr>

		<?php foreach ($comp["responses"] as $key => $option){
			$option_percentage = (($option["count"]/$total_survey_responses)*100);
			$integerVal = intval($option_percentage);
			$rounded_option_percentage = ($option_percentage - $integerVal < 0.5) ? floor($option_percentage) : ceil($option_percentage);

			echo '<tr>';
			echo '<td>'.$option["option_text"].'</td>';
			echo '<td>'.$option["count"].'</td>';
			echo '<td>'.$rounded_option_percentage.'</td>';
			echo '</tr>';
		} ?>

		</table>



	<?php } else if($comp["question"]["question_type"] == "text_entry"){ ?>
		<table border="1">

			<?php foreach ($comp["responses"] as $key => $learner_response){
				echo '<tr><td>';
				echo $learner_response["response_date"]. "<br>";
				$combined_response = explode("$#$", $learner_response["response"]);
				echo '<ul>';
				foreach ($combined_response as $key => $single_response) {

					if($single_response != ""){
						echo '<li>'.$single_response.'</li>';

					}

				}
				echo '</ul>';
				echo '</td></tr>';
			} ?>
		</table>
	<?php } else{}?>
<?php endforeach ?>
</body>
</html>


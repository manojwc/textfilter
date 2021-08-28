<!DOCTYPE html>
<html>
<head>
	<title>Learner Report</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/learner_report.css') ?>"></link>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/material-design-iconic-font.min.css') ?>"></link>

	<style type="text/css">

	</style>
</head>
<body>
	<!-- <table class="statusTable" cellpadding="0" cellspacing="0" border="1">
		<thead>
			<tr>
				<th>Module</th>
				<th>Topic</th>
				<th>Page</th>
				<th>Mandatory</th>
				<th>Completion</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td rowspan="2">Business Services</td>
				<td rowspan="2">Overview</td>
			</tr>
			<tr>
				<td>What we do?</td>
				<td class="mandatory">Yes</td>
				<td></td>
			</tr>
		</tbody>
	</table> -->

	<div class="header">
		<div class="logo">
			<img src="<?php echo base_url('/assets/img/cg_ou_logo.png') ?>" alt="">
		</div>
		<div class="courseTitle">
			<?php
				if($status != "course_invalid"){
					echo $course["title"];
				}
			 ?>
		</div>
	</div>
	<div class="subheader">
		<div>Learner Report</div>
		<?php if($status != "learner_invalid"){ ?>
			<div class="learnerDiv"><?php echo ($learner["first_name"]." ".$learner["last_name"]) ?></div>
		<?php } ?>
	</div>

	<?php if($status != "valid"){ ?>
		<div class="errorMessage">
			<?php echo $message ?>

		</div>
	<?php } ?>

<?php if($status == "valid"){ ?>
	<div class="learnerData">
		<div class="topBanner">
			<div class="metaData">
				<div class="profileDiv">
					<div class="sectionTitle">Your Profile</div>
					<table class="rptTable" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="coloredCell">Profile Complete</td>
								<td><?php echo (sizeof($profile) > 0)? "Yes" : "No" ?></td>
							</tr>
							<?php foreach ($profile as $key => $param): ?>
								<tr>
									<td class="coloredCell"><?php echo $param["profile_title"] ?></td>
									<td><?php echo str_replace("$", "<br>", $param["profile_value"]) ?></td>
								</tr>
							<?php endforeach ?>

						</tbody>
					</table>
				</div>
				<div class="statsDiv">
					<div class="sectionTitle">Stats at a Glance</div>
					<table class="rptTable"  cellpadding="0" cellspacing="0">
						<tbody>
							<?php foreach ($learner_stats as $key => $stat): ?>
								<tr>
									<td class="coloredCell" width="300px"><?php echo $stat["title"] ?></td>
									<td><?php echo str_replace("$", "<br>", $stat["value"]) ?></td>
								</tr>
							<?php endforeach ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>


		<div class="courseData">
			<div class="sectionTitle">Detailed Completions</div>
			<button type="button" onclick="filterRecos()">Mandatory Only</button>
			<table id="statusTable" class="rptTable statusTable" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<th>Module</th>
						<th>Availability</th>
						<th>Topic</th>
						<th width="300px">Page</th>
						<!-- <th>Page ID</th> -->
						<th width="100px">Content Type</th>
						<th >Content Viewed</th>
						<th>Assessment Status</th>
						<th width="100px">Mandatory <!-- <input type="checkbox" name="mandatory" value="true"> --></th>
						<th width="100px">Page Completion</th>
					</tr>
				</thead>
				<tbody>

				<?php foreach ($report as $key => $module):
					$row_class_name = (($key%2) == 0) ? "coloredCell" : "";
				?>
					<tr class="<?php echo $row_class_name ?> modRow" data-total_recos="<?php echo $module['total_recos'] ?>">
						<?php if($module["status"] == 'active') { ?>
							<td rowspan="<?php echo $module['total_pages'] ?>" data-orig_span="<?php echo $module['total_pages'] ?>" data-total_recos="<?php echo $module['total_recos'] ?>" class="moduleTitle filterParent"><?php echo $module["title"] ?></td>
							<td rowspan="<?php echo $module['total_pages'] ?>" data-orig_span="<?php echo $module['total_pages'] ?>" data-total_recos="<?php echo $module['total_recos'] ?>" class="smallerFont filterParent">Available</td>
							<?php foreach ($module["topics"] as $key_1 => $topic): ?>
								<td rowspan="<?php echo sizeof($topic['pages']) ?>" data-orig_span="<?php echo sizeof($topic['pages']) ?>" data-total_recos="<?php echo $topic['total_recos'] ?>" class="<?php echo $row_class_name ?> filterParent"><?php echo $topic["title"] ?></td>

								<?php foreach ($topic["pages"] as $key_2 => $page): ?>
									<?php $reco_class = ($page['is_recommended']) ? "recoCell" : ""; ?>
									<td class="<?php echo $row_class_name." ".$reco_class ?> filterChild"><?php echo $page["title"] ?></td>
									<!-- <td class="<?php echo $row_class_name ?>"><?php echo $page["page_id"] ?></td> -->
									<?php if($page["type"] == "content"){ ?>
										<td class="<?php echo $row_class_name." ".$reco_class ?> smallerFont filterChild"><?php echo ucwords($page["comps"]["comp_type"])	?></td>
										<td class="<?php echo $row_class_name." ".$reco_class ?> iconTd filterChild">
											<?php if($page["comps"]["comp_viewed"]){ ?>
												<i class="zmdi zmdi-eye" alt="Viewed"></i>
											<?php } ?>
										</td>
										<td class="<?php echo $row_class_name." ".$reco_class ?> smallerFont filterChild" >
											<?php
												if($page["comps"]["comp_type"] == "assessment"){
													$assess_data = $page["comps"]["assess_data"];
													if($assess_data["status"] != "Not Attempted"){
														echo '<span class="'.strtolower($assess_data["status"]).'">';
														echo $assess_data["status"] . " (".$assess_data["score"]. "%)";
													}else{
														echo "Not Attempted";
													}
												}else{
												 	echo "-";
												}
											?>
										</td>
									<?php }else if($page["type"] == "survey") { ?>
										<td class="<?php echo $row_class_name." ".$reco_class ?> smallerFont filterChild">Evaluation</td>
										<td class="<?php echo $row_class_name." ".$reco_class ?> filterChild"></td>
										<td class="<?php echo $row_class_name." ".$reco_class ?> filterChild">-</td>
									<?php } ?>
									<td class="iconTd <?php echo $row_class_name." ".$reco_class ?> filterChild">
										<!-- <?php echo ($page["is_recommended"]) ? "Yes" : "No"; ?> -->
										<?php if($page['is_recommended']){ ?>
											<img class="mandatoryIcon" src="<?php echo base_url('/assets/img/Mandatory.svg') ?>" alt="Mandatory">
										<?php } ?>
									</td>
									<td class="iconTd <?php echo $row_class_name." ".$reco_class ?> filterChild">
										<?php if($page['is_complete']){ ?>
											<i class="zmdi zmdi-assignment-check completedIcon" alt="Completed"></i>
										<?php } ?>
									</td>
								</tr>
								<?php endforeach ?> <!-- page loop -->
							</tr>
							<?php endforeach ?> <!-- topic loop -->
							<?php }else{ ?>
								<td class="moduleTitle filterChild"><?php echo $module["title"] ?></td>
								<td class="smallerFont filterChild">Coming Soon</td>
								<td class="filterChild"></td>
								<td class="filterChild"></td>
								<td class="filterChild"></td>
								<td class="filterChild"></td>
								<td class="filterChild"></td>
								<td class="filterChild"></td>
								<td class="filterChild"></td>
							<?php } ?>
						</tr>
				<?php endforeach ?> <!-- module loop -->
				</tbody>
			</table>

		</div>

	</div>
<?php } ?>


	<!-- <table class="statusTable" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Module</th>
				<th>Topic</th>
				<th>Page</th>
				<th>Mandatory</th>
				<th>Completion</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td rowspan="4">Business Services</td>
				<td rowspan="2">Overview</td>
				<td>Pre-asssessment</td>
				<td>Yes</td>
				<td>Complete</td>
			</tr>
			<tr>
				<td>What we do?</td>
				<td class="mandatory">Yes</td>
				<td></td>
			</tr>
			<tr>
				<td rowspan="2">Spotlight</td>
				<td>WHere we go?</td>
				<td>No</td>
				<td></td>
			</tr>
			<tr>
				<td>How we go?</td>
				<td>No</td>
				<td></td>
			</tr>
		</tbody>
	</table> -->

	<<script src="<?php echo base_url('assets/jquery-2.2.3.min.js') ?>"></script>
	<script type="text/javascript">
		var toggleFilter = true;
		function filterRecos(){
			console.log("filterRecos");
			if(toggleFilter){
				$(".filterChild").each(function(index, el) {
					if($(this).hasClass("recoCell")){

					}else{
						$(this).hide();
						//$(this).remove();
					}
				});

				$(".filterParent").each(function(index, el) {
					var reqRowSpan = parseInt($(this).attr("data-total_recos"));
					reqRowSpan = (reqRowSpan == 1) ? (reqRowSpan + 1) : reqRowSpan;
					console.log(reqRowSpan)
					$(this).attr({
						"rowspan": reqRowSpan
					});

					if($(this).attr("data-total_recos") == 0){
						//console.log("hide fully");
						$(this).hide();
						//$(this).remove();
					}
				});

				/*$(".modRow").each(function(index, el) {
					if($(this).attr("data-total_recos") == 0){
						console.log("hide ROW fully");
						$(this).hide();
					}
				});*/
				$("#statusTable > tbody > tr").each(function(index, el) {
					//console.log($(this).hasClass("modRow"));
					var hasRecoChildren = $(this).find("td").hasClass("recoCell");
					if(!hasRecoChildren && !$(this).hasClass("modRow")){
						$(this).hide();
						//$(this).remove();
					}
					//console.log("hasRecoChildren = ", hasRecoChildren);
				});

			}else{
				$(".filterChild").each(function(index, el) {
					$(this).show();
				});

				$(".filterParent").each(function(index, el) {
					$(this).attr({
						"rowspan": $(this).attr("data-orig_span")
					});
					$(this).show();
				});

				/*$(".modRow").each(function(index, el) {
					$(this).show();
				});*/
				$("#statusTable > tbody > tr").each(function(index, el) {
					$(this).show();
				});
			}

			toggleFilter = !toggleFilter;


		}

	</script>

</body>
</html>
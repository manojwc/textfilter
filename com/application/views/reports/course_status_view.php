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
			<div class="printDiv">
				<a href="javascript: window.print()">Print this page</a>
			</div>
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
			<?php if ($display_content == "filtered") { ?>
			<div class="courseData">
					<div class="sectionTitle">
						Mandatory Content
						<button id="showAllBtn" type="button" class="lr-btn lr-btn-alt" onclick="showAll()">Show All Content</button>
					</div>
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

						<tr class="<?php echo $row_class_name ?>">
							<?php if($module["status"] == 'active' && $module['total_recos'] > 0) { ?>
								<td rowspan="<?php echo $module['total_recos'] ?>" class="moduleTitle"><?php echo $module["title"] ?></td>
								<td rowspan="<?php echo $module['total_recos'] ?>" class="smallerFont">Available</td>
								<?php foreach ($module["topics"] as $key_1 => $topic):
									if($topic['total_recos'] > 0){


								?>
									<td rowspan="<?php echo $topic['total_recos'] ?>" class="<?php echo $row_class_name ?>"><?php echo $topic["title"] ?></td>
									<?php foreach ($topic["pages"] as $key_2 => $page):										if($page['is_recommended']){

									?>
										<td class="<?php echo $row_class_name ?>"><?php echo $page["title"] ?></td>
										<!-- <td class="<?php echo $row_class_name ?>"><?php echo $page["page_id"] ?></td> -->
										<?php if($page["type"] == "content"){ ?>
											<td class="<?php echo $row_class_name ?> smallerFont"><?php echo ucwords($page["comps"]["comp_type"])	?></td>
											<td class="<?php echo $row_class_name ?> iconTd">
												<?php if($page["comps"]["comp_viewed"]){ ?>
													<i class="zmdi zmdi-eye" alt="Viewed"></i>
												<?php } ?>
											</td>
											<td class="<?php echo $row_class_name ?> smallerFont" >
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
											<td class="<?php echo $row_class_name ?> smallerFont">Evaluation</td>
											<td class="<?php echo $row_class_name ?>"></td>
											<td class="<?php echo $row_class_name ?>">-</td>
										<?php } ?>
										<td class="iconTd <?php echo $row_class_name ?>">
											<img class="mandatoryIcon" src="<?php echo base_url('/assets/img/Mandatory.svg') ?>" alt="Mandatory">
										</td>
										<td class="iconTd <?php echo $row_class_name ?>">
											<?php if($page['is_complete']){ ?>
												<i class="zmdi zmdi-assignment-check completedIcon" alt="Completed"></i>
											<?php } ?>
										</td>
									</tr>
									<?php	} endforeach ?> <!-- page loop -->
								</tr>

								<?php } endforeach ?> <!-- topic loop -->
							</tr>
					<?php } endforeach ?> <!-- module loop -->
					</tbody>
				</table>

			</div>

			<?php } else { ?>
			<div class="courseData">
					<div class="sectionTitle">
						Detailed Completions
						<button id="showMandBtn" type="button" class="lr-btn" onclick="showMandatory();">Filter By Mandatory</button>
					</div>
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
						<tr class="<?php echo $row_class_name ?>">
							<?php if($module["status"] == 'active') { ?>
								<td rowspan="<?php echo $module['total_pages'] ?>" class="moduleTitle"><?php echo $module["title"] ?></td>
								<td rowspan="<?php echo $module['total_pages'] ?>" class="smallerFont">Available</td>
								<?php foreach ($module["topics"] as $key_1 => $topic): ?>
									<td rowspan="<?php echo sizeof($topic['pages']) ?>" class="<?php echo $row_class_name ?>"><?php echo $topic["title"] ?></td>
									<?php foreach ($topic["pages"] as $key_2 => $page): ?>
										<td class="<?php echo $row_class_name ?>"><?php echo $page["title"] ?></td>
										<!-- <td class="<?php echo $row_class_name ?>"><?php echo $page["page_id"] ?></td> -->
										<?php if($page["type"] == "content"){ ?>
											<td class="<?php echo $row_class_name ?> smallerFont"><?php echo ucwords($page["comps"]["comp_type"])	?></td>
											<td class="<?php echo $row_class_name ?> iconTd">
												<?php if($page["comps"]["comp_viewed"]){ ?>
													<i class="zmdi zmdi-eye" alt="Viewed"></i>
												<?php } ?>
											</td>
											<td class="<?php echo $row_class_name ?> smallerFont" >
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
											<td class="<?php echo $row_class_name ?> smallerFont">Evaluation</td>
											<td class="<?php echo $row_class_name ?>"></td>
											<td class="<?php echo $row_class_name ?>">-</td>
										<?php } ?>
										<td class="iconTd <?php echo $row_class_name ?>">
											<!-- <?php echo ($page["is_recommended"]) ? "Yes" : "No"; ?> -->
											<?php if($page['is_recommended']){ ?>
												<img class="mandatoryIcon" src="<?php echo base_url('/assets/img/Mandatory.svg') ?>" alt="Mandatory">
											<?php } ?>
										</td>
										<td class="iconTd <?php echo $row_class_name ?>">
											<?php if($page['is_complete']){ ?>
												<i class="zmdi zmdi-assignment-check completedIcon" alt="Completed"></i>
											<?php } ?>
										</td>
									</tr>
									<?php endforeach ?> <!-- page loop -->
								</tr>
								<?php endforeach ?> <!-- topic loop -->
								<?php }else{ ?>
									<td class="moduleTitle"><?php echo $module["title"] ?></td>
									<td class="smallerFont">Coming Soon</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								<?php } ?>
							</tr>
					<?php endforeach ?> <!-- module loop -->
					</tbody>
				</table>

			</div>

			<?php } ?> <!-- End of display_content condition -->

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
	<script type="text/javascript">
		var currUrl = window.location.href;

		function showMandatory(){
			document.getElementById('showMandBtn').disabled = true;
			if(currUrl.indexOf("web") !== -1){
				var newURL = currUrl.replace("all", "filtered");
			}else{
				var newURL = currUrl + "/filtered";
			}
			location.href = newURL;
		}

		function showAll(){
			document.getElementById('showAllBtn').disabled = true;
			if(currUrl.indexOf("web") !== -1){
				var newURL = currUrl.replace("filtered", "all");
			}else{
				var newURL = currUrl.replace("/filtered", "");
			}
			location.href = newURL;
		}
	</script>
</body>
</html>
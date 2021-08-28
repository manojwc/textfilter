<!DOCTYPE HTML >

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/common_ui.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/formvalidation-master/dist/css/formValidation.css'); ?>" rel="stylesheet"> -->

<style type="text/css">
  	body{
    	background: #fff;
  	}

  	.logs-div{
	  	font-size: 12px;
	  	margin:5px;
	  	padding:5px;
  	}
  	.logs-table{
		margin-bottom: 0px!important;
		font-size: 11px;
	}

	.logs-table >tbody>tr>td{
		padding: 4px!important;
	}
	.msgBox{
	 	margin: 20px 0px;
		padding: 10px;
		display: none;
	}

	.processingDiv{
	 	margin: 20px 0px;
	 	padding: 10px;
	  	text-align:center;
	  	display: none;
	}

	.top-buffer{
		margin-top: 15px;
	}

	.bg-white{
		background: #FFFFFF;
	}

</style>
<!-- </head> -->

<body>
	<div class="container-fluid">

		<div class="row">
			<div class="column col-xs-12">
				<p>Before uploading the .csv file, make sure it is in the format of the sample csv file. You can choose the file and click Upload.</p>
				<form action="<?php echo base_url('index.php/subscriptions/upload_subscribers_csv') ?>" method="post" class="form-inline" enctype="multipart/form-data" name="form_csv" id="form_csv">
					<input type="hidden" name="course_id" value="<?php echo $course_id ?>">
					<div class="form-group">
					    <!-- <label for="userfile">Choose your file</label> -->
					    <input type="file" name="userfile" id="userfile">
					    <!-- <p class="help-block">Allowed files: CSV.</p> -->
					</div>
					<div class="form-group">
						<button id="submitBtn" type="submit" class="btn cg-alt-btn" disabled name="submit" class="btn btn-info">Upload</button>
					</div>

				</form>

			</div>

			<div id="message_div" class="column col-xs-12 " style="">

			        <div id="processingDiv" class="processingDiv bg-info top-buffer">
			          <img src="<?php echo base_url("assets/img/ajax-loader.gif"); ?>" /> Processing..
			        </div>

			        <div id="msgBox" class="msgBox bg-success top-buffer">
			          You have successfully updated the learner details. You may close this dialog now.
			        </div>

			        <div id="errorBox" class="msgBox bg-danger top-buffer">
			         	Please choose a valid .csv file.
			        </div>

		    </div> <!-- /End of Column -->


		</div>

		<div class="row">


			<?php
				//echo json_encode($mapping_logs);
				//if(count($mapping_logs)>0){
					//echo json_encode($csv_upload_status);

					if(sizeof($mapping_logs["successful"])>0){
						echo '<div  class="logs-div bg-success column col-xs-11 top-buffer" style="font-size:14px"><b>'.sizeof($mapping_logs["successful"]) .' learner/s assigned successfully.</b></div>';

					} //End of Successful entries IF loop

					if(sizeof($mapping_logs["invalid_emails"])>0){
						echo '<div class="logs-div bg-danger column col-xs-5 top-buffer"><p><b>Corrupt Data</b></p>The following learners have not been added, as their email address is incorrect. Please correct and upload again.';
						//$invalid_entries = explode("$", $mapping_logs["invalid_log"]);

						echo '<table class="table table-bordered bg-white logs-table"> ';
						foreach ($mapping_logs["invalid_emails"] as $single_learner) {
							echo '<tr>';
							echo '<td>'.$single_learner.'</td>';
							echo '</tr>';
						}
						echo '</table> ';

						echo '</div>';

					} //End of INVALID Logs IF loop

					if(sizeof($mapping_logs["duplicate_mapping"])>0){
						echo '<div  class="logs-div bg-warning column col-xs-5 top-buffer"><p><b>Duplicates</b></p>The following learners are already assigned to this event, so were not added again.';
						//$duplicate_entries = explode("||", $mapping_logs["duplicate_log"]);

						echo '<table class="table table-bordered bg-white logs-table"> ';
						foreach ($mapping_logs["duplicate_mapping"] as $single_learner) {

							echo '<tr>';
							echo '<td>'.$single_learner.'</td>';
							echo '</tr>';

						}
						echo '</table> ';

						echo '</div>';

					} //End of Duplicate Logs IF loop




				//} // End of csv upload status check loop



			?>


	</div>

<?php
	echo "all_learners = <br>";
	echo json_encode($all_learners);
?>

	<script src="<?php echo base_url("assets/jquery-2.2.3.min.js"); ?>"></script>
	<!-- <script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script> -->


<script type="text/javascript">
	var mapping_logs = <?php echo json_encode($mapping_logs); ?>;

	if(mapping_logs["successful"].length > 0){
		window.parent.csv_successfully_uploaded = true;
	}




	$(document).ready(
	    function(){
	        $('#userfile').change(function(){

                if ($(this).val()) {

                	var file_name = $(this).val();
                	if(file_name.substr( (file_name.length-4), 4 ) == ".csv"){
                		$('#submitBtn').attr('disabled',false);
                	}else{
                		$("#errorBox").fadeIn();
                	}

                    // or, as has been pointed out elsewhere:
                    // $('input:submit').removeAttr('disabled');
                }
            });
    });

	$("#form_csv").submit(function (e) {
		$("#errorBox").hide();
        $("#processingDiv").show(); ;
  	});

</script>
</body>
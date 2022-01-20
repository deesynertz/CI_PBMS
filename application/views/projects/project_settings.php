<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if (!empty($title_active) && isset($all)) {
						echo $all['title'] . ' | ' . $title_active;
					} ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Bootstrap4 Duallistbox -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
	<!-- BS Stepper -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/bs-stepper/css/bs-stepper.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.css">
	<!-- dropzonejs -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/dropzone/min/dropzone.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
	<div class="wrapper">

		<?php $this->load->view('/shared/header'); ?>

		<div class="content-wrapper">

			<?php $this->load->view('shared/breadcrumb'); ?>

			<!-- Main content -->

			<?php if (!empty($project)) : foreach ($project as $row) : ?>
					<section class="content pb-5">
						<div class="container-fluid">
							<form method="post" autocomplete="off" action="<?php echo base_url('project/'); ?>project_settings/<?php echo $this->uri->segment(3); ?>">
								<div class="row">
									<div class="col-12">
										<div class="card card-info">
											<div class="card-header">
												<h3 class="card-title">Project Information</h3>
											</div>
											<div class="card-body row">
												<div class="col-12 col-lg-6">
													<div class="form-group">
														<input type="hidden" value="<?php echo $row['proName'] ?>" name="pName">
														<label for="pName">Project Name</label>
														<input type="text" disabled="disabled" class="form-control" value="<?php echo $row['proName'] ?>">
													</div>

													<div class="form-group">
														<label for="description">Project Description</label>
														<textarea id="description" name="description" class="form-control" rows="5" disabled="disabled"><?php echo  $row['description']; ?>
											</textarea>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-12 col-lg-6">
																<label for="lName">status</label>
																<select id="proStatus" name="proStatus" class="form-control select2" style="width: 100%;">
																	<?php foreach ($project_status as $key => $opt_value) {
																		$selected = ($key == 1) ?  "selected" : 'null';
																		if ($key != 1) {
																			echo '<option value="' . $key . '" ' . $selected . '>' . $opt_value . '</option>';
																		}
																	} ?>
																</select>
															</div>
															<div class="col-12 col-lg-6">
																<label for="lName">Client Company</label>
																<input id="lName" disabled="disabled" class="form-control" value="<?php echo $row['compName'] ?>">
															</div>
														</div>
													</div>

												</div>

												<div class="col-12 col-lg-6">
													<div class="form-group">
														<div class="row">
															<div class="col-12 col-lg-6">
																<label>Project Leader</label>
																<input type="text" disabled="disabled" class="form-control" value="<?php echo $row['leader'] ?>">
															</div>
															<div class="col-12 col-lg-6">
																<label for="lPhone">Phone Number</label>
																<input type="number" id="lPhone" disabled="disabled" class="form-control" value="<?php echo $row['phone'] ?>">
															</div>
														</div>

													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-12 col-lg-6">
																<label for="estimatedBudget">Estimated Budget</label>
																<input type="number" id="estimatedBudget" name="estimatedBudget" placeholder="$100000" class="form-control <?php if (form_error('estimatedBudget')) {
																																																																							echo 'is-invalid';
																																																																						} else {
																																																																							echo 'valid';
																																																																						} ?>" value="<?php echo $row['budget'] ?>">
																<div class="<?php if (form_error('estimatedBudget')) {
																							echo 'invalid-feedback';
																						} ?>">
																	<div><?php echo form_error('estimatedBudget'); ?></div>
																</div>
															</div>
															<div class="col-12 col-lg-6">
																<label for="estimatedDuration">Estimated Duration(days)</label>
																<input type="number" id="estimatedDuration" name="estimatedDuration" placeholder="20 (days)" class="form-control
													   <?php if (form_error('estimatedDuration')) {
																echo 'is-invalid';
															} else {
																echo 'valid';
															} ?>" value="<?php echo $row['duration'] ?>">
																<div class="<?php if (form_error('estimatedDuration')) {
																							echo 'invalid-feedback';
																						} ?>">
																	<div><?php echo form_error('estimatedDuration'); ?></div>
																</div>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label for="lName">Purpose <small class="text-danger">&ast;</small></label>
														<?php $purpose = (!empty($row['purpose'])) ? unserialize($row['purpose']) : array();
														if (!empty($purpose)) :
															foreach ($purposes_opt as $opt_key => $opt_value) {
																if (in_array($opt_key, $purpose)) {
																	echo '<span class="badge badge-info mr-2 py-1">' . $opt_value . '</span>';
																}
															}
														else : ?>
															<div class="col-6 col-lg-4 mb-2 callout callout-warning">
																no data here
															</div>
														<?php endif; ?>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-12 col-lg-6">
																<label for="estimatedBudget">Estimated Budget</label>
																<input type="number" id="estimatedBudget" name="estimatedBudget" placeholder="$100000" class="form-control <?php echo (form_error('estimatedBudget')) ? 'is-invalid' : 'valid'; ?>" value="<?php echo $row['budget'] ?>">
																<div class="<?php echo (form_error('estimatedBudget')) ? 'invalid-feedback' : null; ?>">
																	<div><?php echo form_error('estimatedBudget'); ?></div>
																</div>
															</div>
															<div class="col-12 col-lg-6">
																<label for="estimatedDuration">Estimated Duration(days)</label>
																<input type="number" id="estimatedDuration" name="estimatedDuration" placeholder="20 (days)" class="form-control <?php echo (form_error('estimatedDuration')) ? 'is-invalid' : 'valid'; ?>" value="<?php echo $row['duration'] ?>">
																<div class="<?php echo (form_error('estimatedDuration')) ? 'invalid-feedback' : null; ?>">
																	<div><?php echo form_error('estimatedDuration'); ?></div>
																</div>
															</div>
														</div>

														<div class="row mt-4">
															<div class="col-10 row mr-1">
																<div class="col-6">
																	<label for="activityName">Activities</label>
																	<input type="text" id="activityName" placeholder="Activity Name" class="form-control <?php echo (form_error('activityName')) ? 'is-invalid' : 'valid'; ?>" name="activityName">
																	<div class="<?php echo (form_error('activityName')) ? 'invalid-feedback' : null; ?>">
																		<div><?php echo form_error('activityName'); ?></div>
																	</div>
																</div>
																<div class="col-4 pl-0">
																	<label for="actAmount">Amount</label>
																	<input type="number" id="actAmount" placeholder="Tsh 20000" class="form-control <?php echo (form_error('actAmount')) ? 'is-invalid' : 'valid'; ?>" name="actAmount">
																	<div class="<?php echo (form_error('actAmount')) ? 'invalid-feedback' : null; ?>">
																		<div><?php echo form_error('actAmount'); ?></div>
																	</div>
																</div>
																<div class="col-2 pl-0">
																	<label for="actAmount">Days</label>
																	<input type="number" id="ActivityDays" class="form-control" placeholder="4">
																</div>
															</div>
															<div class="col-2 mt-4 pt-1">
																<div class="push-right">
																	<input type="button" id="activityUpload" class="btn btn-primary float-right" value="Upload">
																</div>

															</div>
														</div>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-12">
										<a href="<?php echo base_url('project'); ?>" class="btn btn-secondary">Cancel</a>
										<input type="submit" value="Complete" class="btn btn-success float-right">
									</div>

								</div>
							</form>
						</div>
					</section>
			<?php endforeach;
			endif; ?>

		</div>

		<?php $this->load->view('/shared/footer'); ?>
	</div>


	<!-- jQuery -->
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="<?php echo base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>
	<!-- Bootstrap4 Duallistbox -->
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
	<!-- InputMask -->
	<script src="<?php echo base_url('assets/'); ?>plugins/moment/moment.min.js"></script>
	<script src="<?php echo base_url('assets/'); ?>plugins/inputmask/jquery.inputmask.min.js"></script>
	<!-- date-range-picker -->
	<script src="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?php echo base_url('assets/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Bootstrap Switch -->
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
	<!-- BS-Stepper -->
	<script src="<?php echo base_url('assets/'); ?>plugins/bs-stepper/js/bs-stepper.min.js"></script>
	<!-- dropzonejs -->
	<script src="<?php echo base_url('assets/'); ?>plugins/dropzone/min/dropzone.min.js"></script>

	<!-- Toastr -->
	<script src="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>

	<!-- AdminLTE App -->
	<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>

	<script>
		$(document).on('click', '#activityUpload', function(e) {
			e.preventDefault();

			var projectID = '<?php echo $this->uri->segment(3); ?>';
			var content = $('#activityName').val();
			var amount = $('#actAmount').val();
			var estBagdet = $('#estimatedBudget').val();

			$.ajax({
				url: "<?php echo base_url('upload_activity'); ?>",
				type: "POST",
				cache: false,
				data: {
					projectID: projectID,
					content: content,
					amount: amount,
					estBagdet: estBagdet
				},
				dataType: "json",
				success: function(data) {
					if (data.error) {
						toastr.error(`${data.error}`);
					} else {
						$('#activityName').val("");
						$('#actAmount').val("");
						toastr.success(`${data.success}`);
						// refreshPage(2.5);
					}
				}
			});

		});

		$(function() {
			// Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		});
	</script>
</body>

</html>
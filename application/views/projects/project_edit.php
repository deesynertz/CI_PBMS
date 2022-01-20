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
	<!-- dropzonejs -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/dropzone/min/dropzone.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
	<div class="wrapper">

		<?php $this->load->view('/shared/header'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<?php $this->load->view('shared/breadcrumb'); ?>


			<?php if (!empty($project)) : foreach ($project as $row) : ?>
					<section class="content pb-5">
						<div class="container-fluid">

							<form method="post" autocomplete="off" action="<?php echo base_url('project/'); ?>project_update/<?php echo $this->uri->segment(3); ?>">
								<div class="row">
									<div class="col-12">
										<div class="card card-info">
											<div class="card-header">
												<h3 class="card-title">Project Information</h3>
											</div>

											<div class="card-body row">
												<div class="col-12 col-lg-6">
													<div class="form-group">
														<label for="proName">Project Name</label>
														<input type="text" id="proName" class="form-control" name="proName" value="<?php echo $row['proName'] ?>">
													</div>

													<div class="form-group">
														<label for="proDescription">Project Description</label>
														<textarea id="proDescription" name="proDescription" rows="5" class="form-control" ><?php echo  $row['description']; ?>
														</textarea>
													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-12 col-lg-6">
																<label for="proStatus">status</label>
																<select id="proStatus" name="proStatus" class="form-control select2" style="width: 100%;">
																<?php foreach ($project_status as $key => $opt_value) {
																		$selected = ($key == $row['projectStatus']) ?  "selected" : 'null';
																		if ($key != 1) {
																			echo '<option value="' . $key . '" ' . $selected . '>' . $opt_value . '</option>';
																		}
																		} ?>
																</select>
															</div>
															<div class="col-12 col-lg-6">
																<label for="compName">Client Company</label>
																<input id="compName" name="compName" class="form-control" value="<?php echo $row['compName'] ?>">
															</div>
														</div>
													</div>

												</div>

												<div class="col-12 col-lg-6">
													<div class="form-group">
														<div class="row">
															<div class="col-12 col-lg-6">
																<label>Project Leader</label>
																<input type="text" id="leader" class="form-control" name="leader" value="<?php echo $row['leader'] ?>">
															</div>
															<div class="col-12 col-lg-6">
																<label for="phone">Phone Number</label>
																<input type="number" id="phone" name="phone" class="form-control" value="<?php echo $row['phone'] ?>">
															</div>
														</div>

													</div>

													<div class="form-group">
														<div class="row">
															<div class="col-12 col-lg-6">
																<label for="estimatedBudget">Estimated Budget</label>
																<input type="number" id="estimatedBudget" name="estimatedBudget" placeholder="$100000" class="form-control <?php echo (form_error('estimatedBudget')) ? 'is-invalid': 'valid'?>" value="<?php echo $row['budget'] ?>">
																<div class="<?php echo (form_error('estimatedBudget')) ? 'invalid-feedback': null; ?>">
																	<div><?php echo form_error('estimatedBudget'); ?></div>
																</div>
															</div>
															<div class="col-12 col-lg-6">
																<label for="estimatedDuration">Estimated Duration(days)</label>
																<input type="number" id="estimatedDuration" name="estimatedDuration" placeholder="20 (days)" class="form-control <?php echo (form_error('estimatedDuration'))? 'is-invalid' : 'valid'; ?>" value="<?php echo $row['duration'] ?>">
																<div class="<?php echo (form_error('estimatedDuration')) ?'invalid-feedback': null;?>">
																	<div><?php echo form_error('estimatedDuration'); ?></div>
																</div>
															</div>
														</div>
													</div>

													<div class="form-group">
														<label for="lName">Purpose <small class="text-danger">&ast;</small></label>

														<div class="select2-purple">
															<select class="select2" multiple="multiple" data-placeholder="purpose of budget" data-dropdown-css-class="select2-purple" style="width: 100%;" name="purpose[]">
																<?php $purpose = (!empty($row['purpose'])) ? unserialize($row['purpose']) : array();
																foreach ($purposes_opt as $opt_key => $opt_value) {

																	$selected = in_array($opt_key, $purpose) ?  "selected" : 'null';

																	echo '<option value="' . $opt_key . '" ' . $selected . '>' . $opt_value . '</option>';
																}

																// foreach ($purpose as $key => $value) {
																// 	$selected = in_array($value, $purposes_opt) ?  "selected" : 'null' ;
																// 	echo '<option value="'.$value.'" '.$selected.'>'.$selected.'</option>';
																// } 
																?>


																<!-- // <option value="salary">Salary</option>
																	// <option value="risk">Risk Management</option>
																	// <option value="material">Material</option>
																	// <option value="others">Others</option> -->

															</select>
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
										<input type="submit" value="Submit" class="btn btn-success float-right">
									</div>
								</div>
							</form>
						</div>
					</section>
			<?php endforeach;
			endif; ?>

			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<?php $this->load->view('/shared/footer'); ?>
	</div>
	<!-- ./wrapper -->

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
	<!-- AdminLTE App -->
	<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>
	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		});
	</script>
</body>

</html>
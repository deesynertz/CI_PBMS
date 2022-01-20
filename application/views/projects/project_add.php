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
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/fontawesome-free/css/all.min.css">
	<!-- daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/daterangepicker/daterangepicker.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Bootstrap4 Duallistbox -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
	<!-- BS Stepper -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/bs-stepper/css/bs-stepper.min.css">
	<!-- dropzonejs -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/dropzone/min/dropzone.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">


	<?php $this->load->view('/shared/header'); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<?php $this->load->view('shared/breadcrumb');?>

		<!-- Main content -->
		<section class="content pb-5">
			<div class="container-fluid">
				<form method="post" autocomplete="off" action="<?php echo base_url('project/')?>/project_add">
					<div class="row">

						<div class="col-12">
							<div class="card card-info">
								<div class="card-header">
									<h3 class="card-title">Project Information</h3>
								</div>
								<div class="card-body row">
									<div class="col-12 col-lg-6">
										<div class="form-group">
											<label for="pName">Project Name</label>
											<input type="text" id="pName" name="pName" placeholder="MSP Gateway"
												   class="form-control <?php if (form_error('pName')) {
													   echo 'is-invalid';} else { echo 'valid'; } ?>"
												   value="<?php echo set_value('pName')?>">
											<div class="<?php if (form_error('pName')) {
												echo 'invalid-feedback';} ?>">
												<div><?php echo form_error('pName'); ?></div>
											</div>
										</div>
										<div class="form-group">
											<label for="description">Project Description</label>
											<textarea id="description" name="description" class="form-control <?php if (form_error('description')) {
												echo 'is-invalid';} else { echo 'valid';} ?>" rows="5">
											<?php echo set_value('description') ?>
										</textarea>
										</div>
										<div class="form-group">
											<label for="status">Status</label>
											<select id="status" name="status" class="form-control select2" style="width: 100%;">
												<option selected disabled>Select one</option>
													<?php foreach ($project_status as $key => $opt_value) {
														$selected = ($key == 1) ?  "selected" : 'null';
															if ($key == 1) {
																echo '<option value="' . $key . '" ' . $selected . '>' . $opt_value . '</option>';
															}
														} ?>
											</select>
										</div>
									</div>

									<div class="col-12 col-lg-6">
										<div class="form-group">
											<label for="cName">Client Company</label>
											<input type="text" id="cName" name="cName" placeholder="axetrixhub, Inc"
												   class="form-control <?php if (form_error('cName')) {
													   echo 'is-invalid';} else { echo 'valid';} ?>"
												   value="<?php echo set_value('cName') ?>">
											<div class="<?php if (form_error('cName')) {
												echo 'invalid-feedback';
											} ?>">
												<div><?php echo form_error('cName'); ?></div>
											</div>
										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-12 col-lg-6">
													<label for="lName">Project Leader</label>
													<input type="text" id="lName" name="lName" placeholder="Anna Kweka"
														   class="form-control <?php if (form_error('lName')) {
															   echo 'is-invalid';
														   } else {
															   echo 'valid';
														   } ?>"
														   value="<?php echo set_value('lName') ?>">
													<div class="<?php if (form_error('lName')) {
														echo 'invalid-feedback';
													} ?>">
														<div><?php echo form_error('lName'); ?></div>
													</div>
												</div>
												<div class="col-12 col-lg-6">
													<label for="lPhone">Phone Number</label>
													<input type="number" id="lPhone" name="lPhone" placeholder="0744 004 897"
														   class="form-control <?php if (form_error('lPhone')) {
															   echo 'is-invalid';} else { echo 'valid';} ?>"
														   value="<?php echo set_value('lPhone') ?>">
													<div class="<?php if (form_error('lPhone')) {
														echo 'invalid-feedback';} ?>"><div><?php echo form_error('lPhone'); ?></div>
													</div>
												</div>
											</div>

										</div>

										<div class="form-group">
											<div class="row">
												<div class="col-12 col-lg-6">
													<label for="estimatedBudget">Estimated Budget</label>
													<input type="number" id="estimatedBudget" name="estimatedBudget" placeholder="$100000"
														   class="form-control <?php if (form_error('estimatedBudget')) {
															   echo 'is-invalid'; } else { echo 'valid'; } ?>"
														   value="<?php echo set_value('estimatedBudget') ?>">
													<div class="<?php if (form_error('estimatedBudget'))
													{ echo 'invalid-feedback'; } ?>">
														<div><?php echo form_error('estimatedBudget'); ?></div>
													</div>
												</div>
												<div class="col-12 col-lg-6">
													<label for="estimatedDuration">Estimated Duration(days)</label>
													<input type="number" id="estimatedDuration" name="estimatedDuration"
														   placeholder="20 (days)" class="form-control
													   <?php if (form_error('estimatedDuration')) { echo 'is-invalid';}
													else { echo 'valid';} ?>"
														   value="<?php echo set_value('estimatedDuration') ?>">
													<div class="<?php if (form_error('estimatedDuration')) {
														echo 'invalid-feedback';} ?>">
														<div><?php echo form_error('estimatedDuration'); ?></div>
													</div>
												</div>
											</div>
										</div>

										<div class="form-group">
											<label for="lName">Select Purpose</label>
											<div class="select2-purple">
												<select class="select2" multiple="multiple" data-placeholder="purpose of budget"
														data-dropdown-css-class="select2-purple" style="width: 100%;"
														name="purpose[]">
														<?php foreach ($purposes_opt as $opt_key => $opt_value) : ?>
													<option value="<?php echo $opt_key;?>"><?php echo $opt_value;?></option>
													<?php endforeach; ?>
													
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
							<a href="<?php echo base_url('project');?>" class="btn btn-secondary">Cancel</a>
							<input type="submit" value="submit Project" class="btn btn-success float-right">
						</div>

					</div>
				</form>
			</div>
		</section>
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
	$(function () {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Initialize Select2 Elements
		$('.select2bs4').select2({
			theme: 'bootstrap4'
		})

		//Datemask dd/mm/yyyy
		$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
		//Datemask2 mm/dd/yyyy
		$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
		//Money Euro
		$('[data-mask]').inputmask()

		//Date picker
		$('#reservationdate').datetimepicker({
			format: 'L'
		});

		//Date and time picker
		$('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

		//Date range picker
		$('#reservation').daterangepicker()
		//Date range picker with time picker
		$('#reservationtime').daterangepicker({
			timePicker: true,
			timePickerIncrement: 30,
			locale: {
				format: 'MM/DD/YYYY hh:mm A'
			}
		})
		//Date range as a button
		$('#daterange-btn').daterangepicker(
				{
					ranges   : {
						'Today'       : [moment(), moment()],
						'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
						'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
						'Last 30 Days': [moment().subtract(29, 'days'), moment()],
						'This Month'  : [moment().startOf('month'), moment().endOf('month')],
						'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					},
					startDate: moment().subtract(29, 'days'),
					endDate  : moment()
				},
				function (start, end) {
					$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
				}
		)

		//Timepicker
		$('#timepicker').datetimepicker({
			format: 'LT'
		})

		//Bootstrap Duallistbox
		$('.duallistbox').bootstrapDualListbox()

		//Colorpicker
		$('.my-colorpicker1').colorpicker()
		//color picker with addon
		$('.my-colorpicker2').colorpicker()

		$('.my-colorpicker2').on('colorpickerChange', function(event) {
			$('.my-colorpicker2 .fa-square').css('color', event.color.toString());
		})

		$("input[data-bootstrap-switch]").each(function(){
			$(this).bootstrapSwitch('state', $(this).prop('checked'));
		})

	})
	// BS-Stepper Init
	document.addEventListener('DOMContentLoaded', function () {
		window.stepper = new Stepper(document.querySelector('.bs-stepper'))
	})

	// DropzoneJS Demo Code Start
	Dropzone.autoDiscover = false

	// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
	var previewNode = document.querySelector("#template")
	previewNode.id = ""
	var previewTemplate = previewNode.parentNode.innerHTML
	previewNode.parentNode.removeChild(previewNode)

	var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
		url: "/target-url", // Set the url
		thumbnailWidth: 80,
		thumbnailHeight: 80,
		parallelUploads: 20,
		previewTemplate: previewTemplate,
		autoQueue: false, // Make sure the files aren't queued until manually added
		previewsContainer: "#previews", // Define the container to display the previews
		clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
	})

	myDropzone.on("addedfile", function(file) {
		// Hookup the start button
		file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
	})

	// Update the total progress bar
	myDropzone.on("totaluploadprogress", function(progress) {
		document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
	})

	myDropzone.on("sending", function(file) {
		// Show the total progress bar when upload starts
		document.querySelector("#total-progress").style.opacity = "1"
		// And disable the start button
		file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
	})

	// Hide the total progress bar when nothing's uploading anymore
	myDropzone.on("queuecomplete", function(progress) {
		document.querySelector("#total-progress").style.opacity = "0"
	})

	// Setup the buttons for all transfers
	// The "add files" button doesn't need to be setup because the config
	// `clickable` has already been specified.
	document.querySelector("#actions .start").onclick = function() {
		myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
	}
	document.querySelector("#actions .cancel").onclick = function() {
		myDropzone.removeAllFiles(true)
	}
	// DropzoneJS Demo Code End
</script>
</body>
</html>


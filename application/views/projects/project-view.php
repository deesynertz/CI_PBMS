<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if (!empty($title_active) && isset($all)) {echo $all['title'].' | '.$title_active; } ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/fontawesome-free/css/all.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">


	<?php $this->load->view('/shared/header');?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<?php $this->load->view('shared/breadcrumb');?>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<!-- Default box -->
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Projects</h3>

						<div class="card-tools">
							<a href="<?php echo  base_url('project/');?>project_add"
							   class="btn btn-primary">
								<i class="fas fa-plus"></i> ADD PROJECT
							</a>
						</div>
					</div>
					<div class="card-body p-0">
						<table class="table table-striped projects">
							<thead>
							<tr>
								<th style="width: 25%">
									Project Name
								</th>
								<th style="width: 13%">
									Budget Status
								</th>
								<!-- <th style="width: 13%">
									Project Progress
								</th> -->
								<th style="width: 5%" class="text-center">
									proStatus
								</th>
								<th style="width: 20%" class="text-center">
								Actions
								</th>
							</tr>
							</thead>
							<tbody>

							<?php if (!empty($projects) && $projects->num_rows() > 0) {
								foreach ($projects->result() as $row) { ?>
									<tr>
										<td>
											<a>
												<?php echo $row->proName;?>
											</a>
											<br/>
											<small>
												Created <?php echo $row->createdOn;?>
											</small>
										</td>
										<td class="project_progress">

											<?php if ($row->projectStatus == 1){ ?>
											<?php } else {?>
												<div class="progress progress-sm">

												<div class="progress-bar <?php 
													$budgetStatus = ((($row->budget - $row->spent) * 100)/$row->budget); 
													// $budgetStatus = (($row->currentAmount * 100)/$row->budget);
													$color=($budgetStatus <=40)? 'bg-red' :
													(($budgetStatus <=70)? 'bg-yellow': 'bg-green'); echo $color?>"

													role="progressbar" aria-valuenow="<?php echo $budgetStatus;?>"
													aria-valuemin="0" aria-valuemax="100"
													style="width: <?php echo $budgetStatus;?>%">
													</div>
												</div>
												<small><?php ($budgetStatus <= 0)? 0 :
													(($budgetStatus>=100)? 100: $budgetStatus);
													echo round($budgetStatus, 0)?>% 
													<span><?php 
													echo ($row->spent) ? '('.$row->spent.'/'.$row->budget.')' : '('.$row->budget.')';?></span></small>
											<?php } ?>

										</td>
										
										<td class="project-state">
											<?php $proStatus=($row->projectStatus == 1)? 'warning':
												(($row->projectStatus == 2)? 'info' : 
												(($row->projectStatus == 4) ? 'success' : 'danger'));?>
											<span class="badge badge-<?php echo $proStatus;?> mb-4">
												<?php  foreach ($project_status as $key => $value) {
													if($key == $row->projectStatus){
														echo $value;
													}
												} ?></span>
										</td>
										
										<td class="project-actions text-right pb-4">

										<div class="btn-group btn-group-sm">

											<?php if ($row->projectStatus == 1) :?>
												<a class="btn btn-info btn-sm" href="<?php echo base_url('project/');?>project_settings/<?php echo $row->proID;?>" id="<?php echo $row->proID;?>">&nbsp;Complete Settings</a>
											<?php else: ?>

												<a class="btn btn-primary btn-sm view_project"
											   href="<?php echo base_url('project/');?>project_detail/<?php echo $row->proID;?>">
												<i class="fas fa-eye"></i> Details</a>
												
												<a class="btn btn-info btn-sm edit_project <?php echo ($row->projectStatus == 4) ? 'disabled': null;?>" href="<?php echo base_url('project/');?>project_update/<?php echo $row->proID;?>">
												<i class="fas fa-pencil-alt"></i> Edit</a>
											<?php endif; ?>	
											<a class="btn btn-danger btn-sm delete_project <?php echo ($row->projectStatus == 4) ? 'disabled': null;?>"  href="#" 
												id="<?php echo $row->proID;?>">
												<i class="fas fa-trash"></i></a>
											</div>
										</td>
									</tr>
								<?php }
							} else { ?>

								<td colspan="6">
									No project registered yet !!
								</td>

							<?php } ?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->
				</div>
			</div>

		</section>

		<div class="modal fade" id="delete-product-mdl">
			<div class="modal-dialog">
				<div class="modal-content bg-danger">
					<div class="modal-header">
						<h4 class="modal-title">DELETE PROJECT</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete project?&hellip;</p>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
						<button type="button" id="yes_delete" value="yes" class="btn btn-outline-light">DELETE</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div class="modal fade" id="complete-setting-mdl">
			<div class="modal-dialog">
				<div class="modal-content bg-info">
					<div class="modal-header">
						<h4 class="modal-title">Info Modal</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>One fine body&hellip;</p>
					</div>
					<div class="modal-footer justify-content-between">
						<button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-outline-light">Save changes</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>

	</div>


	<?php $this->load->view('/shared/footer');?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/');?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Toastr -->
<script src="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/');?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/');?>dist/js/demo.js"></script>

<!-- <script src="<?php //echo base_url('assets/'); ?>customeAjax.js"></script> -->

<script>

	$(document).ready(function() {
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
	});

	$(function() {

		function updateProjectStatus() {

			var userID = '<?php echo $this->session->userdata('authID');?>';

			$.ajax({
				url: "<?php echo base_url('project');?>/projectStatus",
				method: "POST",
				data:{userID: userID},
				cache: false,
				// dataType: "json",
				success: function(response) {
					data = JSON.parse(response);
					// console.log(data);
					// if (data.response == 'complete') {
					// 	refreshPage(2.5);
					// } else {
					// 	// refreshPage(2.5);
					// }
				}
			})
		};

		function refreshPage(timeout){ 
			setInterval(function() { 
				updateProjectStatus();
				location.reload(true) 
			}, (timeout * 1000)); 
		}

		updateProjectStatus();

		$(document).on('click', '.delete_project', function(e) {
			e.preventDefault();

			var proj_id = $(this).attr('id');
			if (proj_id != '') {
					$('#delete-product-mdl').modal('show');
					$(document).on('click', '#yes_delete', function(ex){
						ex.preventDefault();
						var confim = $(this).attr('value');
						if (confim == "yes") {
							$('#delete-product-mdl').modal('hide');

							$.ajax({
								url: "<?php echo base_url('delete_project'); ?>",
								type: "POST",
								cache: false,
								dataType: "json",
								data: {
									proj_id: proj_id
								},
								success: function(data) {
									proj_id = '';
									confim = '';
									if (data.response == 'success') {
										toastr.success('Project Deleted Successfully');
										this.refresh_page(1000);
									} else {
										toastr.success(data.response)
									}
								}
							});
						}
					});
			}else {
				toastr.error('Empty ID');
			}
		});
	})
</script>

</body>
</html>







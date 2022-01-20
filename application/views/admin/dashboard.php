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
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- IonIcons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- Toastr -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
	<div class="wrapper">

		<?php $this->load->view('/shared/header'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">


			<?php $this->load->view('shared/breadcrumb'); ?>

			<div class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-12">

								<?php if ($requests->num_rows() > 0) : ?>
									<div class="card">

									<div class="card-header border-0">
										<h3 class="card-title">User Request </h3>
									</div>
									<div class="card-body table-responsive p-0">
										<table class="table table-striped table-valign-middle">
											<thead>
												<tr>
													<th>Fullname</th>
													<th>Status</th>
													<th>Registered On</th>
													<th></th>
												</tr>
											</thead>
											<tbody id="requests"></tbody>
										</table>
									</div>
									</div>

								<?php else : ?>
									<div class="callout callout-warning">
										<p>No Request Yet </p>
									</div>
								<?php endif; ?>
						</div>
					</div>

					<div class="row mt-5">
						<div class="col-12">
							<div class="card">
								<div class="card-header border-0">
									<h3 class="card-title">Authorized Users </h3>
								</div>

								<?php if ($authorized->num_rows() > 0) : ?>
									<div class="card-body table-responsive p-0">
										<table class="table table-striped table-valign-middle">
											<thead>
												<tr>
													<th>Fullname</th>
													<th>Status</th>
													<th>Registered On</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($authorized->result() as $row) : ?>
													<tr id="userId" value="<?php echo $row->userID;?>">
														<td>
															<a href="<?php echo base_url('project/'); ?>project_detail/<?php echo $row->userID; ?>" class="uppercase">
																<?php echo $row->fullName; ?></a>
														</td>
														<td>
															<small class="mr-1 <?php echo ($row->permission_status == 'active')? 'text-success' : 'text-warning'?>">
																<?php echo $row->permission_status; ?>
															</small>
														</td>
														<td><?php $date = DateTime::createFromFormat('Y-m-d', $row->registeredOn);
																echo $date->format('M d, Y');  ?>
														</td>
														<td>
															<a class="btn btn-primary btn-sm" id="view_user" value="<?php echo $row->userID;?>" href="#" >
																<i class="fas fa-eye"></i></a>

															<?php if($row->permission_status == 'domant') : ?>
																<a class="btn btn-warning btn-sm text-white" value="<?php echo $row->userID; ?>" href="#" id="enable_acc">&nbsp;<i class="fas fa-check"></i></a>
															<?php else : ?>
																<a class="btn btn-danger btn-sm" value="<?php echo $row->userID; ?>" href="#" id="disable_acc">
																&nbsp;<i class="fas fa-times"></i>&nbsp;</a>
															<?php endif;?>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								<?php else : ?>
									<div class="callout callout-warning">
										<p>No authorized User </p>
									</div>
								<?php endif; ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="showProfile">
      <div class="modal-dialog">


				<div class="modal-content">
					<div class="modal-header" id="title_acc"></div>
					<div class="modal-body" id="bodyModel"></div>
				</div>
			</div>
		</div>
				




		<?php $this->load->view('/shared/footer'); ?>

	</div>


	<!-- REQUIRED SCRIPTS -->
	<!-- jQuery -->
	<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="<?php echo base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>

	<!-- Toastr -->
	<script src="<?php echo base_url('assets/'); ?>plugins/toastr/toastr.min.js"></script>

	<!-- AdminLTE -->
	<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.js"></script>

	<!-- OPTIONAL SCRIPTS -->
	<script src="<?php echo base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->


	<script>
		var Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});

		function fetchRequests() {
			$.ajax({
				url: "<?php echo base_url('fetch_request'); ?>",
				type: "POST",
				cache: false,
				dataType: "json",
				success: function(data) {
					var tbody = "";

					for(var key in data){
						tbody += "<tr>";
						tbody += `<td>${data[key]['fullName']}</td>`;
						tbody += `<td>
							<small class="text-danger mr-1">${data[key]['permission_status']}</small>
							</td>`;
						tbody += `<td>${data[key]['registeredOn']}</td>`;
						tbody += `<td>
							<a class="btn btn-primary btn-sm view_user_req" id="${data[key]['userID']}" href="#"><i class="fas fa-eye"></i></a>

							<a class="btn btn-info btn-sm" value="${data[key]['userID']}" href="#" id="allow_acc"><i class="fas fa-check"></i></a>

							<a class="btn btn-danger btn-sm" value="${data[key]['userID']}" href="#" id="delete_acc"><i class="fas fa-trash"></i></a>
						</td>`;
						tbody += "</tr>";
					}
					$('#requests').html(tbody);
				}
			})
		};

		fetchRequests();

		$(document).on('click', '#enable_acc', function(e) {
			e.preventDefault();
			var enable_id = $(this).attr("value");
			if (enable_id == "") {
				toastr.error('ID required')
			} else {
				$.ajax({
					url: "<?php echo base_url('user_permision'); ?>",
					type: "POST",
					cache: false,
					dataType: "json",
					data: {
						userID: enable_id, action: 'active'
					},
					success: function(data) {
						fetchRequests();
						if (data.response == 'success') {
							toastr.success('User Activated Successfully')
						} else {
							toastr.success('User Activated Failed')
						}
					}
				})
			}
		});

		$(document).on('click', '#allow_acc', function(e) {
			e.preventDefault();
			var userID = $(this).attr("value");
			if (userID == "") {
				toastr.error('ID required')
			} else {
				$.ajax({
					url: "<?php echo base_url('user_permision'); ?>",
					type: "POST",
					cache: false,
					dataType: "json",
					data: {
						userID: userID, action: 'active'
					},
					success: function(data) {
						fetchRequests();
						if (data.response == 'success') {
							toastr.success('User Activated Successfully')
						} else {
							toastr.success('User Activated Failed')
						}
					}
				})
			}
		});

		$(document).on('click', '#disable_acc', function(e) {
			e.preventDefault();
			var dis_id = $(this).attr("value");
			if (dis_id == "") {
				toastr.error('ID required')
			} else {
				$.ajax({
					url: "<?php echo base_url('user_permision'); ?>",
					type: "POST",
					cache: false,
					dataType: "json",
					data: {
						userID: dis_id, action: 'domant'
					},
					success: function(data) {
						fetchRequests();
						if (data.response == 'success') {
							toastr.success('User Diactivated Successfully')
						} else {
							toastr.success('User Diactivated Failed')
						}
					}
				})
			}
		});

		$(document).on('click', '#delete_acc', function(e) {
			e.preventDefault();
			var del_id = $(this).attr("value");
			if (del_id == "") {
				toastr.error('ID required')
			} else {
				$.ajax({
					url: "<?php echo base_url('deleteUser'); ?>",
					type: "POST",
					cache: false,
					dataType: "json",
					data: {
						del_id: del_id
					},
					success: function(data) {
						fetchRequests();
						if (data.response == 'success') {
							toastr.success('User Activated Successfully')
						} else {
							toastr.success('User Activated Failed')
						}
					}
				})
			}
		});

		function getUserProfile(user_id) {
			$.ajax({
				url: "<?php echo base_url(); ?>auth/select_single_user/" + user_id,
				type: "POST",
				cache: false,
				dataType: "json",
				success: function(data) {
					$('#showProfile').modal('show');

					$('#title_acc').append(`<h4 class="modal-title" id="title">Account Preview</h4>\
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">\
							<span aria-hidden="true">&times;</span>\
						</button>`);
						$('#bodyModel').append(`
						<div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url('assets/media/avatars/');?>${data['userPic']}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">${data['fullName']}</h3>

                <p class="text-center ${(data['permission_status'] == 'request')? 'text-danger' : 'text-success'}">(${data['permission_status']})</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">${data['email']}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Reg On</b> <a class="float-right">${data['registeredOn']}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Role</b> <a class="float-right">${(data['roleID'] == 2) ? 'User' : 'Admin'}</a>
                  </li>
                </ul>
                <a href="#" class="btn ${(data['permission_status'] == 'request')? 'btn-primary' : 'btn-danger'} btn-block"><b>${(data['permission_status'] == 'request')? 'Activate' : 'Deactivate'}</b></a>
              </div>
            </div>
						
						`);
					}
			});
		}

		$(document).on('click', '#view_user', function() {
			$('#title_acc').html("");
			$('#bodyModel').html("");
			var user_id = $(this).attr('value');
			getUserProfile(user_id);

		});

		$(document).on('click', '.view_user_req', function() {
			$('#title_acc').html("");
			$('#bodyModel').html("");

			var id = $(this).attr('id');
			getUserProfile(id);
		});
	</script>

</body>

</html>



<!-- 
$noWords = 3; $stringChar = //array('"','&','*','$','%','>');

$string = str_replace//($stringChar, '', $row->info);

$stringImpl = array_slice//(explode(' ', $row->info, $noWords+1), 0, $noWords); 

echo implode//(' ', $stringImpl);?> ... -->
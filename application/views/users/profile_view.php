<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if (!empty($title_active) && isset($all)) {echo $all['title'].' | '.$title_active;} ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">
	<?php $this->load->view('/shared/header'); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1>Projects</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Projects</li>
						</ol>
					</div>
				</div>
			</div><!-- /.container-fluid -->
		</section>

		<!-- Main content -->
		<section class="content pb-4">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-8">
						<div class="row">
							<div class="col-md-12">
								<?php if(!empty($this->session->userdata('location'))) : ?>
									<div class="card card-info">
										<div class="card-header">
											<h3 class="card-title">About Me</h3>

											<div class="card-tools">
												<button type="button" class="btn btn-tool" data-toggle="modal"
														data-target="#modal-lg"><i class="fas fa-user-edit"></i>
												</button>
											</div>

										</div>
										<div class="card-body">
											<?php if($this->session->userdata('education')) : ?>
												<strong><i class="fas fa-book mr-1"></i> Education</strong>
												<p class="text-muted">
													<?php echo $this->session->userdata('education')?>
												</p>
												<hr>
											<?php endif;?>
											<?php if($this->session->userdata('location')) : ?>
											<strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

											<p class="text-muted"><?php echo $this->session->userdata('location')?></p>

											<hr>
											<?php endif;?>
											<?php if($this->session->userdata('skill')) : ?>
											<strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

											<p class="text-muted">
												<span class="tag bad-danger"><?php echo $this->session->userdata('skill')?></span>
											</p>

											<hr>
											<?php endif;?>
											<?php if($this->session->userdata('experience')) : ?>
											<strong><i class="far fa-file-alt mr-1"></i> Experience</strong>

											<p class="text-muted"><?php echo $this->session->userdata('experience')?></p>
											<?php endif;?>
										</div>
										<!-- /.card-body -->
									</div>
								<?php else:?>
									<div class="callout callout-warning">
										<p>Please edit your profile </p>
									</div>
								<?php endif;?>
							</div>

							<?php if(empty($this->session->userdata('location'))) : ?>
								<div class="col-md-12">
								<div class="card card-info">
									<div class="card-header">
										<h3 class="card-title">Edit profile</h3>
									</div>
									<?php $this->load->view('users/profile_edit')?>
								</div>
							</div>
							<?php endif;?>
						</div>
					</div>

					<div class="col-md-4">
						<div class="card card-widget widget-user-2">
							<!-- Add the bg color to the header using any of the bg-* classes -->
							<div class="widget-user-header bg-info">
								<div class="widget-user-image">
									<img class="img-circle elevation-2"
										src="<?php echo base_url('assets/media/avatars/'.$this->session->userdata('userPic'));?>" alt="User Avatar">
								</div>
								
								<h3 class="widget-user-username">
									<?php echo $this->session->userdata('name'); ?></h3>
								<h5 class="widget-user-desc"><?php echo $this->session->userdata('roleName'); ?></h5>
							</div>

							<div class="card-footer p-0">
								<ul class="nav flex-column">

								<?php if($_SESSION['roleID'] != 1) : ?>
									<li class="nav-item">
										<a href="<?php echo base_url('project');?>" class="nav-link">
											Projects <span class="float-right badge bg-primary"><?php echo $projectCount->total;?></span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url('project');?>" class="nav-link">
											Tasks <span class="float-right badge bg-info"><?php echo $projectCount->onhold;?></span>
										</a>
									</li>

									<?php if ($projectCount->complited > 0) :?>
									<li class="nav-item">
										<a href="<?php echo base_url('project');?>" class="nav-link">
										Complited Projects <span class="float-right badge bg-success"><?php echo $projectCount->complited;?></span>
										</a>
									</li>
									<?php endif;?>
									<?php if ($projectCount->cancelled > 0) :?>
									<li class="nav-item">
										<a href="<?php echo base_url('project');?>" class="nav-link">
										Cancelled Projects <span class="float-right badge bg-danger"><?php echo $projectCount->cancelled;?></span>
										</a>
									</li>
									<?php endif;?>
								<?php else : ?>
									<li class="nav-item">
										<a href="<?php echo base_url('project');?>" class="nav-link">
											Email <span class="float-right badge bg-primary"><?php echo $_SESSION['email'];?></span>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url('project');?>" class="nav-link">
											Role <span class="float-right badge bg-info">Administrator</span>
										</a>
									</li>
								<?php endif;?>	
								</ul>
							</div>
							
						</div>
					</div>
				</div>
			</div>


			<div class="modal fade" id="modal-lg">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Edit profile</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?php $this->load->view('users/profile_edit')?>
						</div>
<!--						<div class="modal-footer justify-content-between">-->
<!--							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--							<button type="button" class="btn btn-primary">Save changes</button>-->
<!--						</div>-->
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>

		</section>
	</div>


	<?php $this->load->view('/shared/footer'); ?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>
</body>
</html>



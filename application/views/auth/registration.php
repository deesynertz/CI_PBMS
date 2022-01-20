<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if (!empty($title_active) && isset($all)) {
			echo $all['title'].' | '.$title_active;
		} ?></title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
	<div class="register-logo">
		<a href="<?php echo base_url(); ?>auth/"><b>PBMS</b></a>
	</div>

	<div class="card">
		<div class="card-body register-card-body">
			<p class="login-box-msg">Register a new membership</p>

			<form action="<?php echo base_url('auth/'); ?>registration" method="post" autocomplete="off">

				<div class="form-group">
					<?php $this->load->view('shared/session_msg');?>
				</div>

				<div class="form-group">
					<div class="input-group mb-1">
						<input type="text" class="form-control" name="fullName" placeholder="Full name"
							   value="<?php echo set_value('fullName'); ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<span class="text text-danger text-sm"><?php echo form_error('fullName'); ?></span>
				</div>

				<div class="form-group">
					<div class="input-group mb-1">
						<input type="text" class="form-control" name="email" placeholder="Email"
							   value="<?php echo set_value('email'); ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<span class="text text-danger text-sm"><?php echo form_error('email'); ?></span>
				</div>

				<div class="form-group">
					<div class="input-group mb-1">
						<input type="password" class="form-control" name="password" placeholder="Password"
							   value="<?php echo set_value('password'); ?>">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<span class="text text-danger text-sm"><?php echo form_error('password'); ?></span>
				</div>

				<div class="form-group">
					<div class="input-group mb-1">
						<input type="password" class="form-control" name="confirm_password"
							   placeholder="Retype password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<span class="text text-danger text-sm"><?php echo form_error('confirm_password'); ?></span>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-12 mb-2">
							<button type="submit" class="btn btn-primary btn-block">Register</button>
						</div>
						<!-- /.col -->
					</div>
				</div>

			</form>


			<p class="mb-0">I already have a membership
				<a href="<?php echo base_url('login'); ?>" class="text-center">login</a>
			</p>
		</div>
		<!-- /.form-box -->
	</div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.min.js"></script>
</body>
</html>


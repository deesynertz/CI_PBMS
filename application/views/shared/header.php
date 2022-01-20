<?php

?>


<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
	</ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="<?php echo base_url('dashboard');?>" class="brand-link">
		<img src="<?php echo base_url('assets/'); ?>media/brand/logo_128x128.png" alt="Logo"
			 class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">PBMS</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
				role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
					 with font-awesome or any other icon font library -->

				<?php if ($this->session->userdata('roleID') == 1) : ?>
				<li class="nav-item">
					<a href="<?php echo base_url('dashboard'); ?>"
					   class="nav-link <?php if (!empty($title_active) && $title_active == 'Dashboard' &&
							isset($all)) {echo $all['active_class'];}?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<?php endif; ?>

				<li class="nav-item">
					<a href="<?php echo base_url('profile'); ?>"
					   class="nav-link <?php if (!empty($title_active) && $title_active == 'Profile' &&
							   isset($all)) {echo $all['active_class'];}?>">
						<i class="far fa-user nav-icon"></i>
						<p>Profile</p>
					</a>
				</li>

				<?php if ($this->session->userdata('roleID') != 1) : ?>
				<li class="nav-item">
					<a href="<?php echo base_url('project-add'); ?>"
					   class="nav-link <?php if (!empty($title_active) && $title_active=='Add Project' && isset($all)) {echo $all['active_class'];}?>">
						<i class="nav-icon fas fa-plus"></i>
						<p> Add Project </p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('project'); ?>"
					   class="nav-link <?php echo  (!empty($title_active) && 
					   ($title_active=='Projects'|| $title_active=='Expenditure'|| $title_active=='Project Details' || $title_active=='Project Update'||$title_active=='Project Settings') && isset($all)) ? $all['active_class']:null;?>">
						<i class="nav-icon fas fa-th"></i>
						<p> Projects <?php echo ($this->session->userdata('roleID') != 1 &&  $projectCount->settings > 0)? '<span class="right badge badge-warning">'.$projectCount->settings.'</span>': null; ?>
						</p>
					</a>
				</li>
				<?php endif; ?>
				
				<li class="nav-header">TOOLS</li>

				<!-- <li class="nav-item">
					<a href="<?php // echo base_url(); ?>" class="nav-link">
						<i class="nav-icon far fa-image"></i>
						<p> Reports</p>
					</a>
				</li> -->

				<li class="nav-item">
					<a href="<?php echo base_url('logout'); ?>" class="nav-link">
						<i class="nav-icon fa fa-sign-out-alt"></i>
						<p> Logout </p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>



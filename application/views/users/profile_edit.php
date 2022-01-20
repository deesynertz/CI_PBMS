<?php

?>

<div class="card-body">
	<form class="form-horizontal" method="post" autocomplete="off"
		  action="<?php echo base_url('profile_edit') ?>">
		<div class="form-group row">
			<label for="inputName" class="col-sm-2 col-form-label">Name</label>
			<div class="col-sm-10">
				<input type="text" placeholder="Name" class="form-control <?php if (form_error('inputName')) {
					echo 'is-invalid'; } else { echo 'valid'; } ?>" id="inputName" name="inputName"
					   value="<?php echo $this->session->userdata('name')?>">
				<div class="<?php if (form_error('inputName')) { echo 'invalid-feedback'; } ?>">
					<div><?php echo form_error('inputName'); ?></div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
			<div class="col-sm-10">
				<input type="email" disabled placeholder="mail" class="form-control <?php if (form_error('inputEmail')) {
					echo 'is-invalid'; } else { echo 'valid'; } ?>" id="inputEmail" name="inputEmail"
					   value="<?php echo $this->session->userdata('email') ?>">
				<div class="<?php if (form_error('inputEmail')) {
					echo 'invalid-feedback'; } ?>"><div><?php echo form_error('inputEmail'); ?></div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label for="location" class="col-sm-2 col-form-label">Location</label>
			<div class="col-sm-10">
				<input type="text" placeholder="Location" class="form-control <?php if (form_error('location')) {
					echo 'is-invalid'; } else { echo 'valid'; } ?>" id="location" name="location"
					   value="<?php echo $this->session->userdata('location') ?>">
				<div class="<?php if (form_error('location')) { echo 'invalid-feedback';} ?>">
					<div><?php echo form_error('location'); ?></div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<label for="inputSkills" class="col-sm-2 col-form-label">
				Education / skills
			</label>
			<div class="col-sm-10">
				<div class="row">
					<div class="col-md-6">
						<input type="text" placeholder="Education" class="form-control"
							   id="inputSkills" name="education"
							   value="<?php echo $this->session->userdata('education') ?>">
						<div class="<?php if (form_error('education')) {
							echo 'invalid-feedback';
						} ?>">
							<div><?php echo form_error('education'); ?></div>
						</div>
					</div>
					<div class="col-md-6">
						<input type="text" placeholder="Skills" class="form-control"
							   id="inputSkills" name="skill"
							   value="<?php echo $this->session->userdata('skill') ?>">
						<div class="<?php if (form_error('skill')) {
							echo 'invalid-feedback';
						} ?>">
							<div><?php echo form_error('skill'); ?></div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="form-group row">
			<label for="experience"
				   class="col-sm-2 col-form-label">Experience</label>
			<div class="col-sm-10">
				<textarea placeholder="Experience" class="form-control" id="experience" name="experience"><?php if(!empty($this->session->userdata('experience'))){ echo set_value($this->session->userdata('experience'));};?>
				</textarea>
				<div class="<?php if(form_error('experience')){ echo 'invalid-feedback';}?>">
					<div><?php echo form_error('experience'); ?></div>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<div class="offset-sm-2 col-sm-10">
				<div class="checkbox">
					<label>
						<input type="checkbox"> I agree to the <a href="#">terms and
							conditions</a>
					</label>
				</div>
			</div>
		</div>

		<div class="form-group row">
			<div class="offset-sm-2 col-sm-10">
				<button type="submit" class="btn btn-danger">Submit</button>
			</div>
		</div>
	</form>
</div>

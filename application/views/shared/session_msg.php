<?php if ($this->session->flashdata('success')) :?>
    <div class="alert alert-success text-center">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if($this->session->flashdata('info')):?>
	<div class="alert alert-info text-center">
		<?php echo $this->session->flashdata('info'); ?>
	</div>
<?php endif; ?>
<?php if($this->session->flashdata('warning')):?>
	<div class="alert alert-warning text-center">
    	<?php echo $this->session->flashdata('warning'); ?>
  	</div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')) :?>
  	<div class="alert alert-danger text-center">
    	<?php echo $this->session->flashdata('error'); ?>
  	</div>
<?php endif; ?>

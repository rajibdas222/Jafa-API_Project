<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('head', array('title' => lang('profile_page_name'))); ?>

</head>
<body>

<?php $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-2">
			<?php $this->load->view('account/account_menu', array('current' => 'account_profile')); ?>
        </div>
        <div class="col-md-10">

			<?php if (isset($profile_info))
		{
			?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $profile_info; ?>
            </div>
			<?php } ?>

            <h2>カスタム化チャリン2ポイント</h2>
            <hr>
			<?php echo form_open_multipart(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>
				<div class="form-group row">
					<label for="colFormLabel" class="col-sm-2 col-form-label">Select User</label>
					<div class="col-sm-4">
						<select class="form-control">
							<option value="">Select User</option>
							<?php
							foreach ($all_users as $key => $user) :
								?>
							<option value="<?= $user->id; ?>"><?= $user->fullname?></option>
							<?php
							endforeach;
							?>
						</select>
					</div>
				</div>
				<div class="form-group row">
					<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label">Share Amount</label>
					<div class="input-group col-sm-4">
					  
					  <input type="text" name="share_amount" class="form-control" id="share_amount" value="50" placeholder="">
					  <div class="input-group-prepend">
					    <div class="input-group-text">%</div>
					  </div>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2"></label>
					<div class="col-sm-4">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
				
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>

        </div>
    </div>
</div>

</div> <!-- /container -->

<?php $this->load->view('footer'); ?>

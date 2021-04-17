<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('head', array('title' => lang('sign_up_page_name'))); ?>

</head>
<body>

<?php $this->load->view('header'); ?>

<div class="container">
    <div class="row">

		<?php if (! ($this->config->item("sign_up_enabled"))): ?>
			<div class="span12">
				<h3><?php echo lang('sign_up_heading'); ?></h3>

				<div class="alert">
					<strong><?php echo lang('sign_up_notice'); ?> </strong> <?php echo lang('sign_up_registration_disabled'); ?>
				</div>
			</div>
		<?php endif;?>

		<?php if ($this->config->item("sign_up_enabled")): ?>

			<div class="col-sm-6 mx-auto" style="padding: 0;">

				<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
				<?php echo form_fieldset(); ?>
				<h5><?php echo lang('sign_up_heading'); ?></h5>

				<div class="card">
					<div class="card-body" style="padding: 0;">
						<div style="margin-bottom: 10px" class="from-group <?php echo (form_error('fullname')) ? 'error' : ''; ?>">
							<label class="col-sm-3 control-label" for="fullname">ユーザー名</label>

							<div class="col-md-12">
								<?php echo form_input(array('name' => 'fullname', 'id' => 'fullname', 'class' => 'form-control', 'value' => (!empty($introduce_partner))? $introduce_partner->partner_name: set_value('fullname'), 'maxlength' => '100')); ?>
								<?php if (form_error('fullname')) : ?>
									<span class="field_error">
									<?php echo form_error('fullname'); ?>
									
									</span>
								<?php endif; ?>
							</div>
						</div>
						<div style="margin-bottom: 10px" class="from-group <?php echo (form_error('sign_up_username') || isset($sign_up_username_error)) ? 'error' : ''; ?>">
							<label class="col-sm-4 control-label" for="sign_up_username">契約番号</label>

							<div class="col-sm-12">
								<?php echo form_input(array('name' => 'sign_up_username', 'id' => 'sign_up_username', 'class' => 'form-control', 'value' => (!empty($introduce_partner))? $introduce_partner->partner_contact: set_value('sign_up_username'), 'maxlength' => '24')); ?>
								<?php if (form_error('sign_up_username') || isset($sign_up_username_error)) : ?>
									<span class="help-inline">
									<?php echo form_error('sign_up_username'); ?>
									<?php if (isset($sign_up_username_error)) : ?>
										<span class="field_error"><?php echo $sign_up_username_error; ?></span>
									<?php endif; ?>
									</span>
								<?php endif; ?>
							</div>
						</div>
						<div style="margin-bottom: 10px" class="from-group <?php echo (form_error('sign_up_traking') || isset($sign_up_username_error)) ? 'error' : ''; ?>">
							<label class="col-sm-4 control-label" for="sign_up_traking">会員コード</label>

							<div class="col-sm-12">
								<?php echo form_input(array('name' => 'sign_up_traking', 'id' => 'sign_up_traking', 'placeholder' => '会員コード（10桁限定）', 'class' => 'form-control', 'value' => (!empty($introduce_partner))? $introduce_partner->partner_contact: set_value('sign_up_traking'), 'maxlength' => 10, 'minlength' => 10)); ?>
								<?php if (form_error('sign_up_traking') || isset($sign_up_traking_error)) : ?>
									<span class="help-inline">
									<?php echo form_error('sign_up_traking'); ?>
									<?php if (isset($sign_up_traking_error)) : ?>
										<span class="field_error"><?php echo $sign_up_traking_error; ?></span>
									<?php endif; ?>
									</span>
								<?php endif; ?>
							</div>
						</div>
						<div style="margin-bottom: 10px" class="from-group <?php echo (form_error('sign_up_email') || isset($sign_up_email_error)) ? 'error' : ''; ?>">
							<label class="col-sm-4 control-label" for="sign_up_email"><?php echo lang('sign_up_email'); ?></label>

							<div class="col-sm-12">
								<?php echo form_input(array('type' => 'email', 'name' => 'sign_up_email', 'id' => 'sign_up_email', 'class' => 'form-control', 'value' => (!empty($introduce_partner))? $introduce_partner->partner_email: set_value('sign_up_email'), 'maxlength' => '50')); ?>
								<?php if (form_error('sign_up_email') || isset($sign_up_email_error)) : ?>
									<span class="help-inline">
									<?php echo form_error('sign_up_email'); ?>
									<?php if (isset($sign_up_email_error)) : ?>
										<span class="field_error"><?php echo $sign_up_email_error; ?></span>
									<?php endif; ?>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div style="margin-bottom: 10px" class="form-group <?php echo (form_error('sign_up_password')) ? 'error' : ''; ?>">
							<label class="control-label col-sm-4" for="sign_up_password"><?php echo lang('sign_up_password'); ?></label>

							<div class="col-sm-12">
								<?php echo form_password(array('name' => 'sign_up_password', 'id' => 'sign_up_password', 'class' => 'form-control', 'value' => set_value('sign_up_password'))); ?>
								<?php if (form_error('sign_up_password')) : ?>
									<span class="help-inline">
									<?php echo form_error('sign_up_password'); ?>
									</span>
								<?php endif; ?>
							</div>
						</div>
						<div style="margin-bottom: 10px" class="form-group <?php echo (form_error('passconf')) ? 'error' : ''; ?>">
							<label class="control-label col-sm-4" for="passconf">パスワード再入力</label>

							<div class="col-sm-12">
								<?php echo form_password(array('name' => 'passconf', 'id' => 'passconf', 'class' => 'form-control', 'value' => set_value('passconf'))); ?>
								<?php if (form_error('passconf')) : ?>
									<span class="help-inline">
									<?php echo form_error('passconf'); ?>
									</span>
								<?php endif; ?>
							</div>
						</div>

						
						<?php if (isset($recaptcha)) :
							echo $recaptcha;
							if (isset($sign_up_recaptcha_error)) : ?>
								<span class="field_error"><?php echo $sign_up_recaptcha_error; ?></span>
							<?php endif; ?>
						<?php endif; ?>

						<div class="col-sm-12">
							<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-large pull-right', 'content' => '<i class="icon-pencil"></i> '.lang('sign_up_create_my_account'))); ?>
							<br/>

							<p><?php echo lang('sign_up_already_have_account'); ?> <?php echo anchor('account/sign_in', lang('sign_up_sign_in_now')); ?></p>
						</div>
						
					</div>
					
				</div>

				<?php echo form_fieldset_close(); ?>
				<?php echo form_close(); ?>

			</div>

			
		<?php endif;?>
    </div>
</div>

<?php // $this->load->view('footer'); ?>

</body>
</html>

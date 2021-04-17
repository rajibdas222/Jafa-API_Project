<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('head'); ?>

</head>
<body>

<?php $this->load->view('header'); ?>
<div class="container">

<div class="row">
  <div class="col-md-5 offset-md-4" style="margin-top: 40px; margin-bottom: 40px;">           

     <div class="card" >
            <div class="card-header">
                <?= lang('sign_in_sign_in') ?>
                
            </div>     

            <div style="padding-top:30px" class="card-body" >
               	<?php echo form_open(uri_string().($this->input->get('continue') ? '/?continue='.urlencode($this->input->get('continue')) : ''), 'class="form-horizontal"'); ?>
				<?php echo form_fieldset(); ?>  
				
				<?php if (isset($sign_in_error)) : ?>                	                    
                    <div class="alert alert-danger" role="alert">
              		<a class="close" data-dismiss="alert" href="#">x</a><?php echo $sign_in_error; ?>
            		</div>
				<?php endif; ?>
                
                <?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
                         <p class="text-danger">
                         <?php echo form_error('sign_in_username_email'); ?>
                         <?php if (isset($sign_in_username_email_error)) : ?>
                             <span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
                         <?php endif; ?>
                         </p>
				<?php endif; ?> 
                 
				<div style="margin-bottom: 25px" class="input-group" <?php echo (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) ? 'has-error' : ''; ?>>
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input autofocus id="sign_in_username_email" type="text" class="form-control" name="sign_in_username_email" value="" placeholder="ID">
                              
        </div>
                                    
                <?php 	if (form_error('sign_in_password')) : ?>
						<p class="text-danger"><?php echo form_error('sign_in_password'); ?></p>
				<?php 	endif; ?>
                <div style="margin-bottom: 25px" class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="sign_in_password" type="password" class="form-control" name="sign_in_password" placeholder="<?= lang('sign_in_password') ?>" value="<?=set_value('sign_in_password')?>">
                    
                 	
                    <?php if (isset($recaptcha)) : ?>
							<?php echo $recaptcha; ?>
							<?php if (isset($sign_in_recaptcha_error)) : ?>
								<span class="field_error"><?php echo $sign_in_recaptcha_error; ?></span>
							<?php endif; ?>
					<?php endif; ?>
                    
                       
                </div>


				<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-lg', 'content' => '<i class="icon-lock"></i> '.lang('sign_in_sign_in'))); ?>

            </div><!-- panel-body -->
            
			<div class="card-footer">
        <?php echo anchor('account/forgot_password', lang('sign_in_forgot_your_password'), 'class="btn btn-info btn-sm"'); ?>
            	<?php //echo sprintf(lang('sign_in_dont_have_account'), anchor('account/sign_up', lang('sign_in_sign_up_now'))); ?>
            	
            </div>
            
			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>
   </div>
  </div> <!-- col-md-7 -->
  
  <!-- <div class="col-md-7">
  <?php if ($this->config->item('third_party_auth_providers')) : ?>
            <h3><?php echo sprintf(lang('sign_in_third_party_heading')); ?></h3>
            <ul>
				<?php foreach ($this->config->item('third_party_auth_providers') as $provider) : ?>
                <li class="third_party <?php echo $provider; ?>"><?php echo anchor('account/connect_'.$provider, ' ', array('title' => sprintf(lang('sign_in_with'), lang('connect_'.$provider)))); ?></li>
				<?php endforeach; ?>
            </ul>
			<?php endif; ?>
  </div> -->
</div> <!-- row -->



      
</div> <!-- /container -->

<?php $this->load->view('footer'); ?>
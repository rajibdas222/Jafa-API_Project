<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('head', array('title' => lang('forgot_password_page_name'))); ?>
</head>
<body>

<?php // $this->load->view('header'); ?>

<div class="container">
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-5 col-md-offset-3">

        	<div class="panel panel-info" >
    	       <div class="panel-heading">
    	           <div class="panel-title"><h3><?php echo lang('forgot_password_page_name'); ?></h3></div>
    	       </div>     

    	       <div style="padding-top:30px" class="panel-body" >
   					<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>

   		            <div class="well"><?php echo lang('forgot_password_instructions'); ?></div>

   		            <div class="from-group <?php echo (form_error('forgot_password_username_email') OR isset($forgot_password_username_email_error)) ? 'has-error' : ''; ?>">
   		                <label class="col-md-4 control-label" for="forgot_password_username_email"><?php echo lang('forgot_password_username_email'); ?></label>

   		                <div class="col-md-8">
   							<?php
   							$value = set_value('forgot_password_username_email') ? set_value('forgot_password_username_email') : (isset($account) ? $account->username : '');
   							$value = str_replace(array('\'', '"'), ' ', $value);
   							echo form_input(array(
   							'name' => 'forgot_password_username_email',
   							'id' => 'forgot_password_username_email',
   							'class' => 'form-control',
   							'value' => $value,
   							'maxlength' => '80'
   						)); ?>
   							<?php if (form_error('forgot_password_username_email') || isset($forgot_password_username_email_error))
   						{
   							?>
   		                    <span class="help-inline">
   							<?php
   								echo form_error('forgot_password_username_email');
   								echo isset($forgot_password_username_email_error) ? $forgot_password_username_email_error : '';
   								?>
   							</span>
   							<?php } ?>
   		                </div>
   		            </div>
   		            <?php if (isset($recaptcha)) : ?>
   		            <div class="form-group">
   		            	<label class="control-label">Recaptcha</label>
   		            	<div class="col-md-9">
        					
        					<?php echo $recaptcha; ?>
        					<?php if (isset($forgot_password_recaptcha_error)) : ?>
        		                <span class="field_error"><?php echo $forgot_password_recaptcha_error; ?></span>
        						<?php endif; ?>        					
   		            	</div>
   		            </div>
   		            <?php endif; ?>   					
   		            <br>
   		            <br>
   		            <br>
   		            <div class="form-group">
   		            	<label class="col-md-4"></label>
   		            	<div class="col-md-8">
	            			<?php echo form_button(array(
	            			'type' => 'submit',
	            			'class' => 'btn btn-primary',
	            			'content' => lang('forgot_password_send_instructions')
	            		)); ?>
   		            	</div>
   						
   		            </div>
   		            <div class="clearfix"></div>
   					<?php echo form_close(); ?>
    	       </div>
    	   </div>
        </div>
    </div>
</div>

<?php // $this->load->view('footer'); ?>

</body>
</html>

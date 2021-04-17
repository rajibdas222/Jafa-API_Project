<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('head', array('title' => lang('users_page_name'))); ?>
</head>
<body>

<?php $this->load->view('header'); ?>

<div class="container">
  <div class="row">

    <div class="col-md-2">
      <?php $this->load->view('account/account_menu', array('current' => 'manage_users')); ?>
    </div>

    <div class="col-md-10">

      

      <div class="alert alert-dark">
        <h2><?php echo lang("users_{$action}_page_name"); ?></h2>
      </div>
      <?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
      <div class="form-group row <?php echo (form_error('users_firstname')) ? 'error' : ''; ?>">
          <label class="col-sm-2 col-form-label" for="users_firstname">加盟店名前</label>

          <div class="col-md-4">
          <?php echo form_input(array('name' => 'users_firstname', 'id' => 'users_firstname', 'class'=>'form-control', 'style' => 'ime-mode: active;', 'value' => set_value('users_firstname') ? set_value('users_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
          <?php if (form_error('users_firstname')) : ?>
              <span class="help-block">
                <?php echo form_error('users_firstname'); ?>
                </span>
          <?php endif; ?>
          </div>
      </div>
      <div class="form-group row <?php echo (form_error('users_username') || isset($users_username_error)) ? 'has-error' : ''; ?>">
          <label class="col-sm-2 col-form-label" for="users_username"><?php //echo lang('profile_username'); ?>ユーザー名</label>

          <div class="col-md-4">
            <?php echo form_input(array('name' => 'users_username', 'id' => 'users_username', 'style' => 'ime-mode: inactive;', 'class'=>'form-control', 'value' => set_value('users_username') ? set_value('users_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>

            <?php if (form_error('users_username') || isset($users_username_error)) : ?>
              <span class="help-block">
              <?php
                echo form_error('users_username');
                echo isset($users_username_error) ? $users_username_error : '';
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>
      <div class="form-group row <?php echo (form_error('tracking_id') || isset($tracking_id_error)) ? 'has-error' : ''; ?>">
          <label class="col-sm-2 col-form-label" for="tracking_id"><?php //echo lang('profile_username'); ?>加盟店コード</label>

          <div class="col-md-4">
            <?php echo form_input(array('name' => 'tracking_id', 'id' => 'tracking_id', 'style' => 'ime-mode: inactive;', 'class'=>'form-control', 'value' => set_value('tracking_id') ? set_value('tracking_id') : (isset($update_account->tracking_id) ? $update_account->tracking_id : ''), 'maxlength' => 160)); ?>

            <?php if (form_error('tracking_id') || isset($tracking_id_error)) : ?>
              <span class="help-block">
              <?php
                echo form_error('tracking_id');
                echo isset($tracking_id_error) ? $tracking_id_error : '';
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div>

      <div class="form-group row <?php echo (form_error('users_email') || isset($users_email_error)) ? 'error' : ''; ?>">
          <label class="col-sm-2 col-form-label" for="users_email"><?php echo lang('settings_email'); ?></label>

          <div class="col-md-4">
            <?php echo form_input(array('name' => 'users_email', 'id' => 'users_email', 'style' => 'ime-mode: inactive;', 'class'=>'form-control', 'value' => set_value('users_email') ? set_value('users_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>

            <?php if (form_error('users_email') || isset($users_email_error)) : ?>
              <span class="help-block">
              <?php
                echo form_error('users_email');
                echo isset($users_email_error) ? $users_email_error : '';
              ?>
              </span>
            <?php endif; ?>
          </div>
      </div> 

      

      <div class="form-group row <?php echo (form_error('users_new_password')) ? 'error' : ''; ?>">
        <label class="col-sm-2 col-form-label" for="users_new_password"><?php echo lang('password_new_password'); ?></label>

        <div class="col-md-4">
          <?php echo form_password(array('name' => 'users_new_password', 'id' => 'users_new_password', 'class'=>'form-control', 'value' => set_value('users_new_password'), 'autocomplete' => 'off')); ?>

          <?php if (form_error('users_new_password')) : ?>
            <span class="help-block">
              <?php echo form_error('users_new_password'); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="form-group row <?php echo (form_error('users_retype_new_password')) ? 'error' : ''; ?>">
        <label class="col-sm-2 col-form-label" for="users_retype_new_password"><?php echo lang('password_retype_new_password'); ?></label>

        <div class="col-md-4">
          <?php echo form_password(array('name' => 'users_retype_new_password', 'id' => 'users_retype_new_password', 'class'=>'form-control', 'value' => set_value('users_retype_new_password'), 'autocomplete' => 'off')); ?>
          
          <?php if (form_error('users_retype_new_password')) : ?>
            <span class="help-block">
              <?php echo form_error('users_retype_new_password'); ?>
            </span>
          <?php endif; ?>
        </div>
      </div>

      <div class="form-group row">
          <label class="col-sm-2 col-form-label" for="users_roles"><?php echo lang('users_roles'); ?></label>

          <div class="col-md-4">
              <?php foreach($roles as $role) : ?>

                <?php 
                // if ($role->id<3) {
                  $check_it = FALSE;
                  
                  if( isset($update_account_roles) ) 
                  {
                    foreach($update_account_roles as $acrole) 
                    {
                      if($role->id == $acrole->id)
                      {
                        $check_it = TRUE; break;
                      }
                    }
                  }
                  ?>
                  <div class="checkbox">
                  <label>
                    <?php echo form_checkbox("account_role_{$role->id}", $role->id, $check_it); ?>
                    <?php echo $role->name; ?>
                  </label>
                  </div><?php
                // }
                ?>
              <?php endforeach; ?>
          </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-md-6">
          <?php echo form_submit('manage_user_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
          <?php echo anchor('account/manage_users', lang('website_cancel'), 'class="btn btn-warning"'); ?>
          <?php if( $this->authorization->is_permitted('ban_users') && $action == 'update' ): ?>
            <span><?php echo lang('admin_or');?></span>
            <?php if( isset($update_account->suspendedon) ): ?>
              <?php echo form_submit('manage_user_unban', lang('users_unban'), 'class="btn btn-danger"'); ?>
            <?php else: ?>
              <?php echo form_submit('manage_user_ban', lang('users_ban'), 'class="btn btn-danger"'); ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        
      </div>

      <?php echo form_close(); ?>

	   
    </div>
  </div>
</div>

<?php $this->load->view('footer'); ?>

</body>
</html>
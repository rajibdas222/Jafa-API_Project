<style type="text/css">
  .nav-pills>li{
    min-width: 160px;

  }
  .nav-pills>li>a{
    width: 100%;
  }
</style>
<ul class="nav nav-pills">
  <li class="dropdown-header">Account Info</li>
  <li role="presentation" class="<?php echo ($current == 'account_profile') ? 'active' : ''; ?>"><?php echo anchor('account/account_profile', lang('website_profile'), 'class="btn btn-info" style="margin-bottom:10px;"'); ?></li>
  <br>
  <li role="presentation" class="<?php echo ($current == 'account_settings') ? 'active' : ''; ?>"><?php echo anchor('account/account_settings', lang('website_account'), 'class="btn btn-info" style="widht:100%; margin-bottom:10px; margin-bottom:10px;"'); ?></li>
  <br>
  <?php if ($account->password) : ?>
    <li role="presentation" class="<?php echo ($current == 'account_password') ? 'active' : ''; ?>"><?php echo anchor('account/account_password', lang('website_password'), 'class="btn btn-info" style="widht:100%; margin-bottom:10px;"'); ?></li>
  <?php endif; ?>
  <br>

  <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
    <li role="presentation" class="dropdown-header">Admin Panel</li>
    <br>
    <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
      <li role="presentation" class="<?php echo ($current == 'manage_users') ? 'active' : ''; ?>"><?php echo anchor('account/manage_users', lang('website_manage_users'), 'class="btn btn-info" style="margin-bottom:10px;"'); ?></li>
      <br>
      <li role="presentation" class="<?php echo ($current == 'manage_users') ? 'active' : ''; ?>"><?php echo anchor('account/manage_users/member', "会員", 'class="btn btn-info" style="margin-bottom:10px;"'); ?></li>
      <br>
    <?php endif; ?>

    <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
      <li role="presentation" class="<?php echo ($current == 'manage_roles') ? 'active' : ''; ?>"><?php echo anchor('account/manage_roles', lang('website_manage_roles'), 'class="btn btn-info" style="margin-bottom:10px;"'); ?></li>
      <br>
    <?php endif; ?>
    

    <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
      <li role="presentation" class="<?php echo ($current == 'manage_permissions') ? 'active' : ''; ?>"><?php echo anchor('account/manage_permissions', lang('website_manage_permissions'), 'class="btn btn-info" style="margin-bottom:10px;"'); ?></li>
      <br>
    <?php endif; ?>
  <?php endif; ?>

</ul>
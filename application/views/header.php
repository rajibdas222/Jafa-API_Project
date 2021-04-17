<!-- Fixed navbar -->
<nav class="navbar navbar-dark bg-primary navbar-expand-lg" style="margin-bottom: 20px;">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">ＪＡＦＡ（ダブルポイント）</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="compare" target="_blank">Link</a>
            </li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">        
            
            <li class="nav-item dropdown">                
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if ($this->authentication->is_signed_in()) : ?>
                        <i class="fas fa-user"> </i><?php echo $account->username; ?>
                        <?php else: ?>
                        <i class="fas fa-user"> <?= lang('website_sign_in') ?>
                    <?php endif?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <?php if ($this->authentication->is_signed_in()) : ?>
                        <?php echo anchor('account/account_profile', lang('website_profile'), 'class="dropdown-item"'); ?>
                        <?php echo anchor('account/account_settings', lang('website_account'), 'class="dropdown-item"'); ?>
                        <?php echo anchor('account/account_password', lang('website_password'), 'class="dropdown-item"'); ?>
                        <?php if ($this->authorization->is_permitted( array('retrieve_users', 'retrieve_roles', 'retrieve_permissions') )) : ?>
                            <div class="dropdown-divider"></div>
                            <?php if ($this->authorization->is_permitted('retrieve_users')) : ?>
                            <?php echo anchor('account/manage_users', lang('website_manage_users'), 'class="dropdown-item"'); ?>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('retrieve_roles')) : ?>
                                <?php echo anchor('account/manage_roles', lang('website_manage_roles'), 'class="dropdown-item"'); ?>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
                            <?php echo anchor('account/manage_permissions', lang('website_manage_permissions'), 'class="dropdown-item"'); ?>
                            <?php endif; ?>
                            <?php if ($this->authorization->is_permitted('retrieve_permissions')) : ?>
                            <?php echo anchor('account/share_point', 'カスタム化チャリン2ポイント', 'class="dropdown-item"'); ?>
                            <?php endif; ?>

                        <?php endif?>
                        <div class="dropdown-divider"></div>
                        <?php echo anchor('account/sign_out', lang('website_sign_out'), 'class="dropdown-item"'); ?>
                    <?php else:?>
                        <?php echo anchor('account/sign_in', lang('website_sign_in'), 'class="dropdown-item"');
                        ?>
                <?php endif?>
                </div>
            </li>            
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
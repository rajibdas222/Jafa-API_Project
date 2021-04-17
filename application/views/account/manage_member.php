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

      <h2><?php echo lang('users_page_name'); ?></h2>

      <div class="well">
        <?php echo lang('users_description'); ?>
      </div>

      <?php if( count($all_members) > 0 ) : ?>
        <table class="table table-condensed">
          <thead>
            <tr>
              <th>#</th>
              <th><?php echo lang('users_username'); ?></th>
              <th>メンバー名</th>
              <th>加盟企業</th>
              <th>
                <?php if( $this->authorization->is_permitted('create_users') ): ?>
                  <a href="account/manage_users/member_save" class="btn btn-primary btn-small">新しいメンバーを作成する<a>
                <?php endif; ?>
              </th>
            </tr>
          </thead>
          <tbody>

            <?php foreach( $all_members as $acc ) : ?>
              <tr>
                <td><?php echo $acc->account_id; ?></td>
                <td>
                  <?php echo $acc->username; ?>                  
                </td>
                <td><?php echo $acc->fullname; ?></td>
                <td>
                  <?php 
                  $compnay = $this->db->where('account_id', $acc->parent_id)->get('a3m_account_details')->row();
                  echo $acc->fullname; ?></td>
                <td>
                  <?php if( $this->authorization->is_permitted('update_users') ): ?>
                    <a href="account/manage_users/member_save/<?php echo $acc->account_id; ?>" class="btn btn-warning btn-small"><?php echo lang('website_update'); ?><a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>

          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php $this->load->view('footer'); ?>

</body>
</html>
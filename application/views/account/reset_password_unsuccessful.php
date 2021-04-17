<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('head', array('title' => lang('reset_password_page_name'))); ?>
</head>
<body>
<?php // $this->load->view('header'); ?>
<div class="container">
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-6 col-md-offset-3">
            <h2>パスワード変更</h2>
            <hr>
            <p><?php echo lang('reset_password_unsuccessful'); ?></p>

            <h6 class="text-info text-center"><?php echo lang('reset_password_resend'); ?></h6>
        </div>
    </div>
</div>
<?php // $this->load->view('footer'); ?>
</body>
</html>
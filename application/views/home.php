<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('head'); ?>

</head>
<body>

<?php $this->load->view('header'); ?>

<div class="container">
  <div class="jumbotron">
    <h1 class="display-6">Auth Master - ＪＡＦＡ（ダブルポイント）</h1>
    <p class="lead">
      This is login system for JACOS that we will use our all software
    </p>
    <p>
      In this system we are used Codeigniter 3 plus and Bootstrap 4
    </p>
    <p>
      It has role base access control (RBAC) 
    </p>
    <hr class="my-4">
    <p>

    </p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="account/sign_in" role="button"> ログイン</a>
    </p>
  </div>
</div> <!-- /container -->

<?php $this->load->view('footer'); ?>

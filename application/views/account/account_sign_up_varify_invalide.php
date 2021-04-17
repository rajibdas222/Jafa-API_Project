<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('head', array('title' => lang('password_page_name'))); ?>

</head>
<body>

<?php // $this->load->view('header'); ?>

<div class="container" style="margin-top: 40px;">
    <div class="row">        
        
        <div class="col-md-6 offset-md-3" style="border: 2px #17A2B8 solid; padding: 20px; border-radius: 5px;">

            <h1 class="text-danger">確認リンクが無効です。</h1>

            <a href="<?= base_url() ?>" class="btn btn-warning btn-lg">ホームページに移動</a>
            
			
        </div>
    </div>
    
</div>
<input type="hidden" id="base_url" value="<?= base_url() ?>" name="">
</body>
</html>
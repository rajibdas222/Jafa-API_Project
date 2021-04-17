<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('head', array('title' => lang('password_page_name'))); ?>
    <style type="text/css">
        .happy_shoppig{
                position: fixed;  padding: 0; border:2px solid #3D618C; 
                right: 20px; bottom: 10px; z-index: 1000; width: 500px;
            }
        @media only screen and (max-width: 768px) {            
            .happy_shoppig{
                padding: 5px; margin: 2px;
                right: 0; bottom: 0; z-index: 1000; width: 97% !important;
            }

            .happy_shoppig h3{
                font-size: 20px;
            }
            .happy_shoppig h2{
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

<?php // $this->load->view('header'); ?>

<div class="container" style="margin-top: 40px;">
    <div class="row">        
        
        <div class="col-md-6 offset-md-3" style="border: 2px #17A2B8 solid; padding: 20px; border-radius: 5px;">

            <h3 class="text-success">登録確認</h3>

            <p>お名前：<?= $account->fullname ?></p>
            <p>携帯電話：<?= $account->username ?></p>
            <p>メールアドレス：<?= $account->email ?></p>
            <h5 class="text-info">よろしければ、登録ボタンを押してください。</h5>
            <br>
            <a href="<?= base_url() ?>" class="btn btn-warning btn-lg enjoy_shopping">会員登録</a>
            
			
        </div>
    </div>
    <div class="card d-none bg-white happy_shoppig" id=""  style="">
        <div class="card-body">
            <center>
                <h2 class="text-success">会員登録が完了しました。</h2>
                <h3 class="text-info">お買い物をお楽しみください。</h3>
            </center>
            
        </div>
    </div>
</div>
<input type="hidden" id="base_url" value="<?= base_url() ?>" name="">
<input type="hidden" id="user_id" value="<?= $account->id ?>" name="">
<?php // $this->load->view('footer'); ?>
<script type="text/javascript">
    $(".enjoy_shopping").click(function(event) {
        event.preventDefault();
        var base_url = $("#base_url").val();
        var user_id = $("#user_id").val();
        $.ajax({
            url: base_url+'account/sign_up/registration_completetion',
            type: 'POST',
            data: {id: user_id},
        })
        .done(function(data) {
            // Local Store
            localStorage.setItem("token", <?= $account->id ?>);
            window.location = $("#base_url").val();
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
        // $(".happy_shoppig").removeClass('d-none').addClass('d-block');
        // setInterval(function(){ 
        //     window.location = $("#base_url").val();
        // }, 2000);
        
    });
</script>
</body>
</html>
<!DOCTYPE html>
<html translate="no">
<head>
    <?php
    $this->load->view('admin/components/head');
    ?>
    <style type="text/css">

        .table-bordered td,
        .table-bordered th {
            padding: 5px 4px;
            border: 2px solid #000000 !important;
        }
        .custom-table .table th {
            border: 2px solid #000000 !important;
            font-size: 22px;
            font-weight: normal;
            vertical-align: middle;
        }
        .custom-table .table td {
            text-align: right;
        }

        .com_reg_table > tbody >tr{
            background-color: rgba(0, 0, 0, 0.05) !important;
        }

        .table thead th {
            font-size: 1.5rem;
            border: 3px solid #000000;
        }

        .admin-table tr:nth-child(odd){
            background-color: #70ffaf;
        }

        .admin-table tr:nth-child(even){
            background-color: #70ffaf;
        }


        .jacos-bg {
            background-color: #0be60eb0 !important;
        }

        .comtpbtn button {
            font-size: 16px;
            color: #ff0606;
            background: white;
            border: 3px solid #c82727;
        }
        .comtpbtn a {
            font-size: 15px;
            color: #ff0606;
            background: white;
            border: 3px solid #c82727;
        }
        .introduce_screen{
            position: fixed;
            right: 0px;
            bottom: 0px;
            padding: 4px;
        }
        .modal-backdrop.show{
            opacity: 0.2;
        }
        .modal_linking_com_users{
            max-width: 750px!important;
        }
        .modal { overflow: auto !important; }
    </style>
</head>
<body>
<?php
$this->load->view('admin/components/header');
?>
<div class="container-fluid mt-2">
<input type="hidden" name="allmembers" id="allmembers">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header jacos-bg">
                    <div class="row">

                        <div class="col-4">
                            <h5 class="">
                                <span style="font-size: 32px;">ジャコス管理表(大分類)</span><br>
                                加盟企業ごとに、会員　会計を表示(全体)
                            </h5>
                        </div>
                        <div class="col-2">
                            <div class="tp-login-name">
                                <?php
                                $fullname = "";
                                if ($this->authentication->is_signed_in()) {
                                    $fullname = $account_details->fullname;
                                    ?>
                                    <a href="<?= base_url('account/account_profile') ?>"
                                       style="text-decoration: underline;text-decoration-color: #f9fbff; background: #f9fbff;font-size:1.5rem;"> <?= $fullname ?></a>
                                    <span style="font-size:1.5rem;"> 様</span>
                                    <?php
                                } else {
                                    ?>
                                    <span style="border-bottom: 1px solid #00a0e8; width: 100px;"></span>
                                    <span class="text-right" style="color: #00a0e8"> 様</span>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="btm-login-name">
                                <div class="comtpbtn border-dark">
                                    <a href="" class="btn btn-warning">大</a>
                                    <a href="" class="btn btn-warning">中</a>
                                    <a href="<?= base_url() ?>company_users_history/<?php echo $account->id ;?>" class="btn btn-warning">小</a>
                                    <a href="<?= base_url() ?>admin_all_users_history/<?php echo $account->id ;?>" class="btn btn-warning">履歴</a>
                                </div>
                            </div>

                        </div>

                        <div class="col-4 d-flex">
                            <div class="comtpbtn border-dark">
                                <button class="btn text-center  company_reg_btn" id="company_reg_btn" style="">加盟企業<br>登録</button>
                                <button class="btn text-center " id="member_com_link" style="">加盟企業<br>呼出</button>
<!--                                <button class="btn text-center  admin_com_userlink_btn" id="admin_com_userlink_btn" style=""></button>-->
                                <a class="btn btn-sm" style="line-height: 1.70;" href="<?= base_url() ?>company_member_link">加盟企業と個人別<br>リンク</a>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="row d-flex justify-content-between">
                                <h4 class="details_result mr-2">a＋ｂ－ｃ＝ｄ</h4>
                                <a class="btn btn-danger btn-lg ml-1" style="margin-bottom: 5px; height: 50px;"
                                   href="<?= base_url() ?>">戻る</a>
                            </div>
                        </div>


                    </div>

                </div>
                <div class="card-content">
                    <div class="card-body custom-table">
                        <!-- Table with outer spacing -->
                        <div class="point_aquisition_wrapper">
                            <table class="table table-bordered table-striped admin-table">
                                <thead>
                                <tr class="text-black text-center">
                                    <th style="width: 10%;">月日</th><!--Month-->
                                    <th style="width: 10%;">氏名 </th><!--Members Name-->
                                    <th style="width: 10%;">加盟企業 </th><!--Company Name-->
                                    <th style="width: 10%;">購入額</th><!--Purchase amount-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 10%;">前残<br>a</th><!--A amount-->
                                    <th style="width: 10%;">発生<br>b</th><!--B amount-->
                                    <th style="width: 11%;">使用<br>c</th><!--C amount-->
                                    <th style="width: 11%;">新規残<br>d</th><!--D amount-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 11%;">仮ポイント<br>b1</th><!--D. amount-->
                                    <th style="width: 11%;">合計<br>d+b1</th><!--D+B amount-->

                                </tr>
                                </thead>
                                <tbody id="admin_company_memberlist">
                                    <th class="text-center" colspan="12">
                                        <img src="<?= base_url() ?>resource/img/ajax/ajax-loader.gif">
                                    </th>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="d-none float-right col-md-4 col-sm-12 introduce_screen"
         style="padding: 0; z-index: 100; overflow: auto; background: #e2feff;" id="company_reg_form">
        <div style="position: relative; height: 100%">
            <div class="card-header"
                 style="border-top:3px solid black; border-left: 3px solid black; border-right: 3px solid black; border-bottom: 2px solid #8A0B15;">
                <h4 class="text-center">会社・登録・変更</h4>
            </div>
            <div class="card-body" style="border: 3px solid black; border-top: 0; overflow: auto;">
                <form class="form-horizontal" action="account/sign_up" method="post">
                    <input type="hidden" name="request_url" value="company_margine">
                    <input type="hidden" name="refaral" value="<?= $this->input->get('refaral') ?>">
                    <fieldset>
                        <table class="table table-striped com_reg_table" style="margin-bottom: 0">

                            <tr>
                                <th style="border-color: #dee2e6" width="35%"><label class="control-label"
                                                                                     for="sign_up_fullname">加盟企業 お名前</label></th>
                                <td>
                                    <?php echo form_input(array('name' => 'fullname', 'id' => 'sign_up_fullname', 'required' => 'required', 'style' => 'ime-mode: active;', 'placeholder' => 'お名前', 'class' => 'form-control', 'value' => set_value('fullname') ? set_value('fullname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>

                                    <span id="sign_up_fullname_error" class="help-block text-danger blinking"></span>

                                </td>
                            </tr>
                            <tr>
                                <th style="border-color: #dee2e6">
                                    <label class="control-label" for="ajax_sign_up_username">携帯電話</label>
                                </th>
                                <td>
                                    <?php echo form_input(array('type' => 'tel', 'name' => 'ajax_sign_up_username', 'placeholder' => '携帯電話', 'required' => 'required', 'style' => 'ime-mode: inactive', 'id' => 'ajax_sign_up_username', 'class' => 'form-control', 'value' => set_value('sign_up_username') ? set_value('sign_up_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>
                                    <p class="help-block">固有の携帯電話番号</p>
                                    <span id="username_error" class="help-block text-danger blinking"></span>

                                </td>
                            </tr>
                            <tr>
                                <th style="border-color: #dee2e6">
                                    <label class="control-label" for="sign_up_email">メールアドレス</label>
                                </th>
                                <td>
                                    <?php echo form_input(array('name' => 'sign_up_email', 'id' => 'sign_up_email', 'placeholder' => 'メールアドレス', 'required' => 'required', 'style' => 'ime-mode: inactive', 'class' => 'form-control', 'value' => set_value('sign_up_email') ? set_value('sign_up_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>
                                    <span id="email_error" class="help-block text-danger blinking"></span>
                                </td>
                            </tr>

                            <tr>
                                <th style="border-color: #dee2e6">
                                    <label class="control-label" for="ajax_sign_up_password">パスワード（４桁以上）</label>
                                </th>
                                <td>
                                    <?php echo form_password(array('name' => 'ajax_sign_up_password', 'required' => 'required', 'id' => 'ajax_sign_up_password', 'class' => 'form-control', 'placeholder' => 'パスワード（４桁以上）', 'value' => set_value('sign_up_password'), 'autocomplete' => 'off')); ?>
                                    <?php if (form_error('sign_up_password')) : ?>
                                        <span class="help-block">
							  					              <?php echo form_error('sign_up_password'); ?>
							  					            </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th style="border-color: #dee2e6">
                                    <label class="control-label" for="passconf">パスワード再入力</label>
                                </th>
                                <td>
                                    <?php echo form_password(array('name' => 'passconf', 'required' => 'required', 'placeholder' => 'パスワード再入力', 'id' => 'passconf', 'class' => 'form-control', 'value' => set_value('passconf'), 'autocomplete' => 'off')); ?>
                                    <span id="password_error" class="help-block text-danger blinking"></span>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="2" class="">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-default company_sign_up_btn"
                                                style="background-color: green; color: white; font-size: 22px; width: 100px;">
                                            登録
                                        </button>
                                        <button style="font-size: 22px; width: 100px;" id="crf"
                                                name="close_introduce_screen"
                                                class="btn btn-danger btn-lg new_com_reg_form_close ml-1">戻る
                                        </button>
                                    </div>

                                    <div id="validation_errors"
                                         class="alert d-none alert-warning alert-dismissible fade show" role="alert">

                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </td>

                            </tr>

                        </table>
                    </fieldset>

                </form>


            </div>

        </div>
    </div>

    <div class="card d-none bg-info"  id="company_reg_confirm"  style="position: fixed;  padding: 0; border:2px solid #3D618C;">
        <div class="card-body">

            <p class="" style="padding-top: 40px; color: white;">
                上記のメールアドレス宛に確認メールを送信しました。<br>
                メール内に記載されたURLにアクセスし、会員登録ボタンを押してください。<br><br>

                ※ ドメイン指定受信をされている場合、「@jacos.co.jp」からのメールを受信できるようご設定ください。<br><br>

                ※ お使いのメールソフトによっては、メールが「迷惑メール」フォルダに入る場合がございます。メールが届かない場合は、迷惑フォルダもご確認ください。
            </p>
            <center><button class="btn btn-primary btn-lg activation_email_sent_screen_close" style="background-color: #FFFF99">確認</button></center>
        </div>
    </div>

    <div class="card col-md-5 col-sm-12" id="admin_company_message" style="background-color: #55f893; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 500px;
        right: 10px;
        bottom: 10px;
        padding: 4px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-center" style="font-size: 20px;">
                    ジャコス管理表　
                    </p>
                    <center>
                        <button id="close_case_message" class="btn btn-warning btn-lg">確認</button>
                    </center>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>


    <div class="modal admin_com_userlink_popup" id="admin_com_userlink_popup" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal_linking_com_users">
            <div class="card">
                <div class="modal-content"  style="background: #f2f8ff; min-height: 600px;">
                    <div class="modal-header" style="background-color: #0be60eb0 !important;">
                        <h5 class="modal-title" id="">会社のユーザーリンク</h5>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                            戻る
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="company_users_link" style="background-color: white;">
                            <tr>
                                <th>加盟企業</th>
                                <th>個人別</th>
                            </tr>

                            <tbody id="company_users_member_link">
                                <th class="text-center" colspan="12">
                                    <img src="<?= base_url() ?>resource/img/ajax/ajax-loader.gif">
                                </th>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


<div class="modal test d-none" style="width: 400px;display: block;right: 2%;position: fixed;left: auto;margin-top: 35%;" id="test" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="card" style="background: #CCFFCC; padding: 20px; border:2px solid #3D618C;">

        <div class="card-body">
            <p>加盟企業一覧から加盟企業を選択してください。</p>
        </div>
        <div class="card-footer">
            <button class="btn btn-danger btn-sm" id="link_screen_close">戻る</button>
        </div>
    </div>
</div>


<div class="modal test2" style="width:400px; margin-top: 11%;
    margin-left: 30%;" id="test2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
     aria-hidden="true">

    <div class="card" style="background: #CCFFCC; padding: 10px; border:2px solid #3D618C;">

        <div class="card-body text-center">
            <p style="font-size: 20px;">と個人別一覧をリンクして下さい。</p>
            <span style="text-align: center; font-size: 16px;" class="test22  text-danger"></span>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <button class="btn btn-primary btn-sm" id="com_link_screen_close">はい</button>
        </div>
    </div>
</div>


<div class="modal test3" style="width:400px; margin-left:30%;margin-top: 10%" id="test3" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">

    <div class="card" style="background: #CCFFCC; padding: 20px; border:2px solid #3D618C;">

        <div class="card-body">
            <span style="color: red;" class="test33"></span>と
            <span style="color: blue;" class="test22"></span>
            <p>をリンクしますか？</p>

        </div>
        <div class="card-footer d-flex justify-content-center">
            <button class="btn btn-primary btn-md" id="com_user_link_conf">はい</button>
            <button class="btn btn-danger btn-md" id="com_user_link_conf_close">いいえ</button>
        </div>
    </div>
</div>





<?php
$this->load->view('admin/components/footer');
?>
<script type="text/javascript">


// $(document).on('click', '.admin_com_userlink_btn', function (event) {
//         event.preventDefault();
//         window.open('company_point_history', "_blank");
//         /* Act on the event */
//     });

    $(".admin_com_userlink_btn").click(function(){
        $('#admin_com_userlink_popup').modal('show');
        //$('#test').modal('show');
    });

    $("#link_screen_close").click(function(){
       // $('#test').modal(toggle);
        $('#test').modal('hide');  
    });

    //company reg form//


    $(document).on('click', '.company_sign_up_btn', function (event) {
        event.preventDefault();
        /* Act on the event */
        var sign_up_fullname = $("#sign_up_fullname").val();
        var sign_up_username = $("#ajax_sign_up_username").val();
        var sign_up_email = $("#sign_up_email").val();
        sign_up_email = sign_up_email.toLowerCase();
        var sign_up_password = $("#ajax_sign_up_password").val();
        var sign_up_passconf = $("#passconf").val();
        var parent_id = '<?=$parent_id?>';

        if (sign_up_fullname == "") {
            $("#sign_up_fullname").focus();
            $("#sign_up_fullname_error").text("お名前は必須です");
            return false;
        } else {
            $("#sign_up_fullname_error").text("");
        }
        if (sign_up_username == "") {
            $("#ajax_sign_up_username").focus();
            $("#sign_up_username_error").text("携帯電話は必須です");
            return false;
        }
        if (sign_up_email == "") {
            $("#sign_up_email").focus();
            return false;
        }
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if (!sign_up_email.match(mailformat)) {
            $("#").addClass('d-block').removeClass('d-none');
            $("#sign_up_email").focus();
            $("#email_error").text("メールアドレス形式が不正です");
            return false;
        } else {
            $("#").addClass('d-none').removeClass('d-block');
            $("#email_error").text("");
        }
        if (sign_up_password == "") {
            $("#ajax_sign_up_password").focus();
            return false;
        }
        if (sign_up_passconf == "") {
            $("#passconf").focus();
            return false;
        }
        if (sign_up_passconf !== sign_up_password) {
            $("#").addClass('d-block').removeClass('d-none');
            $("#password_error").text("パスワードが一致しません");
            $("#passconf").focus();
            return false;
        }
        // console.log("Parent id : "+parent_id);

        $.ajax({
            url: 'account/sign_up/ajax_com_sign_up',
            type: 'POST',
            data: {
                fullname: sign_up_fullname,
                sign_up_username: sign_up_username,
                sign_up_email: sign_up_email,
                sign_up_password: sign_up_password,
                passconf: sign_up_passconf,
                parent_id: parent_id
            },


        })
            .done(function () {
                console.log("Company Registration Success");
                $("#company_reg_form").removeClass('d-block').addClass('d-none');
                $("#company_reg_confirm").removeClass('d-none').addClass('d-block');
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
                location.reload();
            });
    });

    $(document).on("click", "#company_reg_btn", function (event) {
        event.preventDefault();
        // Disable all button
        $(".microphone_btn").attr("disabled", true);
        $(".microphone_btn_mobile").attr("disabled", true);
        $(".startButton").attr("disabled", true);
        $(".point_table_btn").attr("disabled", true);
        $("#purchase_history").attr("disabled", true);
        $("#product_keyword3").attr("disabled", true);
        $(".change_password").attr("disabled", true);
        $(".introduce_btn").attr("disabled", true);
        $(".customer_reg_btn").attr("disabled", true);
        $(".user_login_btn").attr("disabled", true);
        $(".customer_logout").addClass('disabled');
        $("#sign_up_fullname_error").text("");
        $("#sign_up_username_error").text("");
        $("#username_error").text("");
        $("#email_error").text("");
        $("#password_error").text("");
        $('form').find("input[type=text], textarea, input[type=password], input[type=email], input[type=tel]").val("");
        window.history.pushState(null, null, window.location.href);
        $("#company_reg_form").removeClass('d-none').addClass('d-block');


    });

    $('.new_com_reg_form_close').click(function (event) {
        event.preventDefault();
        $('#company_reg_form').removeClass('d-block').addClass('d-none');
            // Desable all button
            $(".microphone_btn").attr("disabled", false);
            $(".microphone_btn_mobile").attr("disabled", false);
            $(".startButton").attr("disabled", false);
            $(".point_table_btn").attr("disabled", false);
            $("#purchase_history").attr("disabled", false);
            $("#product_keyword3").attr("disabled", false);
            $(".change_password").attr("disabled", false);
            $(".introduce_btn").attr("disabled", false);
            $(".customer_reg_btn").attr("disabled", false);
            $(".user_login_btn").attr("disabled", false);
            $(".customer_logout").removeClass("disabled");

    });



    $(document).mouseup(function (e){
        var hide_enter_outside = $("#company_reg_form");
        if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
        {
            hide_enter_outside.removeClass('d-block').addClass('d-none');
        }
    });


    $(document).mouseup(function (e){
        var hide_enter_outside = $("#admin_company_message");
        if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
        {
            hide_enter_outside.removeClass('d-block').addClass('d-none');
        }
    });

    $("#close_case_message").click(function(event) {
        event.preventDefault();
        $("#admin_company_message").removeClass('d-block').addClass('d-none');
    });


    function get_all_member_company() {
        var base_url = $("#base_url").val();
        //var user_id = $("#login_user_id").val();
        $.get(base_url + 'Point_Acquisition/get_all_members', function (data) {
            var response = JSON.parse(data);
            console.log(response);
            $('#allmembers').val(JSON.stringify(response.members));
            var tableHtml = '';
            if (response.members.length > 0) {
                //console.log(response.members.length);

                var i;
                for (i = 0; i < response.members.length; i++) {
                    var last_order_date = response.members[i].perm.order_date == null ? 0 : response.members[i].perm.order_date;
                    var perm_order_amount = response.members[i].perm.order_amount == null ? 0 : response.members[i].perm.order_amount;
                    var user_perm_point = (typeof response.members[i].perm.user_point == 'NaN') ||(response.members[i].perm.user_point == null)  ? 0 : response.members[i].perm.user_point;
                    var previousTotalBalance = (response.members[i].point_history.permanent_point == null)  ? 0 : response.members[i].point_history.permanent_point;

                    console.log(previousTotalBalance);
                    //var user_exchange_amount = (typeof response.members[i].excenge_amount == 'NaN' ) || (response.members[i].excenge_amount == null) ? 0 : response.members[i].excenge_amount.amount;
                    var user_exchange_amount = (typeof response.members[i].excenge_amount == 'NaN' ) || (response.members[i].excenge_amount == null) ? 0 : response.members[i].excenge_amount.amount;
                    var user_temporary_point =(typeof response.members[i].point_history.temporary_point == 'NaN') || (response.members[i].point_history.temporary_point == null) ? 0 : response.members[i].point_history.temporary_point;




                    var New_balance_d = parseFloat(previousTotalBalance)+ parseFloat(user_perm_point)-(user_exchange_amount);
                    //console.log(New_balance_d);
                    var TotalDatadb = parseFloat(New_balance_d) + parseFloat(user_temporary_point);

                    //|| (typeof response.members[i].excenge_amount == 'undefined' )
                    // if (response.members[i].company_details && response.members[i].company_details) {
                    // if (response.members[i].company_details.fullname) {
                    tableHtml += '<tr>';
                    tableHtml += '<td class="text-right">' + last_order_date + '</td>';
                    if(response.members[i].fullname==null && Object.keys(response.members[i].company_details).length){
                        tableHtml += '<td></td>';
                        tableHtml += '<td><a style="text-decoration: underline;" href="' + base_url + 'company_point_history/' + response.members[i].company_details.user_id + '">' + response.members[i].company_details.fullname + '</td>';
                    }else{
                        tableHtml += '<td class="border_4px"><a style="text-decoration: underline;" href="' + base_url + 'company_users_history/' + response.members[i].user_id + '">' + response.members[i].fullname + '</a></td>';
                        tableHtml += '<td><a style="text-decoration: underline;" href="' + base_url + 'company_point_history/' + response.members[i].company_details.account_id + '">' + response.members[i].company_details.fullname + '</td>';
                    }

                    tableHtml += '<td>' + perm_order_amount + '</td>';
                    tableHtml += '<td style="border:none !important; background-color: #fff;"</td>';
                    tableHtml += '<td>' + previousTotalBalance + '</td>';//a
                    tableHtml += '<td>' + Math.floor(user_perm_point) + '</td>';//b
                    tableHtml += '<td>' + Math.floor(user_exchange_amount) + '</td>';//c
                    tableHtml += '<td>' + Math.floor(New_balance_d) + '</td>';//d
                    tableHtml += '<td style="border:none !important; background-color: #fff;"</td>';
                    tableHtml += '<td>' + parseFloat(user_temporary_point) + '</td>';//b.
                    tableHtml += '<td>' + Math.floor(TotalDatadb) +'</td>';//d+b.
                    tableHtml += '</tr>';

                }
                $("#admin_company_memberlist").html(tableHtml);


                // if(response.members[i].fullname){
                //     tableHtml += '<td class="border_4px"><a style="text-decoration: underline;" href="' + base_url + 'company_users_history/' + response.members[i].user_id + '">' + response.members[i].fullname + '</a></td>';
                //     if (Object.keys(response.members[i].company_details).length) {
                //         tableHtml += '<td><a style="text-decoration: underline;" href="' + base_url + 'company_point_history/' + response.members[i].company_details.account_id + '">' + response.members[i].company_details.fullname + '</td>';
                //     }else{
                //         tableHtml += '<td></td>';
                //     }
                // }else{
                //     tableHtml += '<td>リンクなし</td>';
                //     if (Object.keys(response.members[i].company_details).length) {
                //         tableHtml += '<td><a style="text-decoration: underline;" href="' + base_url + 'company_point_history/' + response.members[i].company_details.account_id + '">' + response.members[i].company_details.fullname + '</td>';
                //     }else{
                //         tableHtml += '<td></td>';
                //     }
                // }


            }

        });


    }
    get_all_member_company();

    $("#admin_com_userlink_btn").click(function (event) {
        event.preventDefault();
        var base_url = $("#base_url").val();
        var user_id = $("#login_user_id").val();
        var all_member = JSON.parse($('#allmembers').val());
        //console.log(all_member);
        var Alltable = '<tr>';

        if (all_member.length > 0) {
            var i;
            for (i = 0; i < all_member.length; i++) {
                if(all_member[i].fullname==null && Object.keys(all_member[i].company_details).length){
                    Alltable += '<td class="select_company" data-com_id="'+all_member[i].company_details.user_id +'">' + all_member[i].company_details.fullname + '</td>';
                    Alltable += '<td></td>';
                }else{
                    Alltable += '<td class="select_company" data-com_id="'+all_member[i].company_details.account_id +'">' + all_member[i].company_details.fullname + '</td>';
                    if (all_member[i].company_details.account_id==32) {
                        Alltable += '<td class="select_user" data-user_id="'+all_member[i].user_id +'">' + all_member[i].fullname + '</td>'; 
                    }else{
                        Alltable += '<td></td>';
                    }
                    
                }

                Alltable += '</tr>';

            }
            $("#company_users_member_link").html(Alltable);
    }   

    });


    var com_id;
    var user_id;
    var com_name;

    $(document).on("click", "td.select_company", function (event) {
        com_id = $(this).data("com_id");
        console.log(com_id+": company id select");
        $('td.select_company').css("background", '#fff');
        $(this).css("background", 'yellow');
        com_name = $(this).text();
        //alert(com_name);
        //alert(com_id);

        $('#test2').modal('show');
        $('span.test22').text(com_name);
        
    });

    var user_name;
    $(document).on("click", "td.select_user", function (event) {
        if(com_id){
            user_id = $(this).data("user_id");
            console.log(user_id+":user id select");
            $('td.select_user').css("background", '#fff');
            $(this).css("background", 'green');
            user_name = $(this).text();
            //showPopUp
           // alert(user_name)
            $('#test3').modal('show');
            $('span.test22').text(com_name);
            $('span.test33').text(user_name);
            submitUserLinkUp(com_id,user_id);
        }else{
            alert("最初に会社を選択してください");
        }
    });
    // all hide
    $("#com_user_link_conf").click(function(){
        $('#test').modal('hide');
        $('#test2').modal('hide');  
        $('#admin_com_userlink_popup').modal('hide');  
        location.reload();

    });

    $("#com_user_link_conf_close").click(function(){
        $('#test3').modal('hide');
    });

$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
});


    $("#com_link_screen_close").click(function(){
        $('#test2').modal('hide');
    });


    $(document).on("click", "button.user_link_conf", function (event) {
            if(com_id && user_id){
                submitUserLinkUp(com_id,user_id);
            }else{
                alert("何かがうまくいかなかった!");
            }
    });


    function submitUserLinkUp(com_id,user_id){
        var base_url = $("#base_url").val();
        $.ajax({
            url: base_url+'Point_Acquisition/LinkUsersCompanys',
            type: 'POST',
            data: { com_id: com_id, user_id: user_id }
        }).done(function (resp) {
            console.log(resp);
        }).fail(function () {
            console.log("error");
        }).always(function () {
            console.log("completed");
        });
    }

$(document).ready(function(){

    $('').click(function(){
        window.open(this.href);
        return false;
    });

});


</script>
</body>
</html>
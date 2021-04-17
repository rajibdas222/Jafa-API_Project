<!DOCTYPE html>
<html translate="no">
<head>
    <?php
    $this->load->view('admin/components/head');
    ?>
    <style type="text/css">
        .jacos-bg {
            background-color: #0be60eb0 !important;
        }

        .com_name_link {
            color: red;
            font-weight: bold;
        }

        .user_name_link {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
<?php
$this->load->view('admin/components/header');
?>
<div class="container mt-2">


    <div class="row justify-content-center">

        <div class="col-8">
            <div class="card">
                <div class="card-header bg-info">
                    <a class="btn btn-danger btn-md ml-1 float-right" href="<?= base_url() ?>allcompany_list">戻る</a>
                </div>
                <div class="card-content">
                    <div class="card-body custom-table">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped bg-light" id="">
                                    <tr>
                                        <th class="text-danger text-center">加盟企業</th>
                                    </tr>

                                    <tbody id="company_users_member_link">
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <table class="table table-bordered table-striped bg-light" id="sourcetable">
                                    <tr>

                                        <th class="text-info text-center">個人別</th>
                                    </tr>

                                    <tbody id="company_users_link">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="card col-md-5 col-sm-12" id="admin_link_company_message" style="background-color: #55f893; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 370px;
        right: 10px;
        bottom: 10px;
        padding: 4px;">
        <div class="card-body">
            <p class="modalTxt">加盟企業一覧から加盟企業を選択してください。</p>

            <div class="btn_ok_cancel d-flex">
                <div id="okbuttn" class="mr-2"></div>
                <div id="canbuttn"></div>
            </div>

        </div>
    </div>

    <!--  company select popup  -->

</div>


<?php
$this->load->view('admin/components/footer');
?>

<script type="text/javascript">

    function get_all_com_member_link() {
        var base_url = $("#base_url").val();
        $.get(base_url + 'Point_Acquisition/get_all_company_members', function (data) {
            var response = JSON.parse(data);
            console.log(response);
            var Alltable = '<tr>';
            var i;
            for (i = 0; i < response.all_company.length; i++) {
                if (response.all_company[i].fullname != null) {
                    // Alltable += '<td class="select_company" data-com_id="'+response.all_company[i].user_id +'"></td>';
                    Alltable += '<td style="cursor: pointer;box-shadow: 1px 1px 1px #888888;" class="select_company" data-com_id="' + response.all_company[i].user_id + '">' + response.all_company[i].fullname + '</td>';
                }
                Alltable += '</tr>';
            }

            $("#company_users_member_link").html(Alltable);

            var Alltable2 = '';
            if (response.all_users.length > 0) {

                var j;
                //console.log(response.all_users);
                for (j = 0; j < response.all_users.length; j++) {
                    Alltable2 += '<tr>';
                    if (response.all_users[j].fullname == null) {
                        // Alltable2 += '<td class="select_company" data-user_id="'+response.all_users[j].user_id +'"></td>';

                    } else {
                        Alltable2 += '<td style="cursor: pointer" class="select_user" data-user_name="' + response.all_users[j].fullname + '" data-user_id="' + response.all_users[j].user_id + '">' + response.all_users[j].fullname + '</td>';
                        if (response.all_users[j].account_id == 32) {
                            Alltable2 += '<td style="cursor: pointer" class="select_user" data-user_name="' + response.all_users[j].fullname + '" data-user_id="' + response.all_users[j].user_id + '">' + response.all_users[j].fullname + '</td>';
                        } else {

                        }

                    }
                    Alltable2 += '</tr>';
                }

            } else {
                Alltable2 += '<tr >';
                Alltable2 += "<td colspan='2' class='text-center'>ユーザが見つかりませんでした</td>";
                Alltable2 += '</tr>';
            }
            $("#company_users_link").html(Alltable2);
        });


    }
    get_all_com_member_link();

    var com_id;
    var com_name;
    var users = [];

    $(document).on("click", "td.select_company", function (event) {
        console.clear();
        com_id = $(this).data("com_id");
        $('td.select_company').css("background", '');
        $(this).css("background", 'yellow');
        com_name = $(this).text();
        //$("#test2").removeClass('d-none').addClass('d-block');
        //$('.modalTxt').html('<span  class="com_name_link">'+com_name +'</span>'+' と 個人別一覧をリンクして下さい。');
        users = [];
        modalControl(users);
        $('td.select_user').css("background", 'rgba(0, 0, 0, 0)');
    });


    function genrateUsers(user_id, user_name) {
        var flag = 0;
        if (users.length == 0) {
            users.push({user_id: user_id, user_name: user_name});
        } else {
            for (let i = 0; i < users.length; i++) {
                if (user_id == users[i].user_id) {
                    flag = 1;
                    users.splice(i, 1);
                }
            }
            if (flag == 0) {
                users.push({user_id: user_id, user_name: user_name});
            }
        }
    }


    function modalControl(users) {
        var nameList = '';
        for (let i = 0; i < users.length; i++) {
            if (nameList) {
                nameList = nameList + ', ' + users[i].user_name;
            } else {
                nameList = users[i].user_name;
            }
        }
        if (nameList) {
            $('.modalTxt').html('<span  class="com_name_link">' + com_name + '</span>' + ' と ' + '<span  class="user_name_link">' + nameList + '</span>' + 'をリンクしますか？');
            $('div#okbuttn').html(' <button class="okbtn btn btn-primary">はい</button>');
            $('div#canbuttn').html(' <button class="canbtn btn btn-danger">いいえ</button>');
        } else {
            $('.modalTxt').html('<span  class="com_name_link">' + com_name + '</span>' + ' と 個人別一覧をリンクして下さい。');
            $('div#okbuttn').html('');
            $('div#canbuttn').html('');
        }
    }


    $(document).on("click", "td.select_user", function () {
        if (com_id) {
            var user_id = $(this).data("user_id");
            var user_name = $(this).data("user_name");
            genrateUsers(user_id, user_name);
            modalControl(users);
            console.log(users);
            if ($(this).css("background-color") == "rgba(0, 0, 0, 0)") {
                $(this).css("background", 'green');
            } else {
                $(this).css("background", 'rgba(0, 0, 0, 0)');
            }
        } else {
            $('.modalTxt').html('<span class="alert_com_select text-danger">最初に会社を選択してください。</span>');
            //alert("最初に会社を選択してください");

        }
    });

    $(document).on("click", ".okbtn", function () {
        submitUserLinkUp(users, com_id);
    });

    $(document).on("click", ".canbtn", function () {
        $('#admin_link_company_message').hide();
        location.reload();
    });


    // all hide
    $("#com_user_link_conf").click(function () {
        $('#test').modal('hide');
        $('#test2').modal('hide');
        $('#admin_com_userlink_popup').modal('hide');
        location.reload();

    });

    $("#com_user_link_conf_close").click(function () {
        $('#test3').modal('hide');
    });


    // $(document).on("click", "button.user_link_conf", function (event) {
    //     if (users.length > 0) {
    //         submitUserLinkUp(users);
    //     } else {
    //         alert("何かがうまくいかなかった!");
    //     }
    // });


    function submitUserLinkUp(users, com_id) {
        var base_url = $("#base_url").val();
        console.log(users);
        console.log(com_id);
        $.ajax({
            url: base_url + 'Point_Acquisition/LinkUsersCompanys',
            type: 'POST',
            data: {users: users, com_id: com_id}
        }).done(function (resp) {
            //console.log(resp);
            var target_url = 'company_point_history/' + com_id;
            //console.log(target_url);
            window.open(target_url, "_blank");

            window.top.location = window.top.location;
        }).fail(function () {
            console.log("error");
        }).always(function () {
            console.log("completed");
        });
    }


    $(document).ready(function () {
        $('').click(function () {
            window.open(this.href);
            return false;
        });
    });



</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $this->load->view('admin/components/head');
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ＪＡＦＡ（ダブルポイント）</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.png"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . RES_DIR; ?>/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . RES_DIR; ?>/css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . RES_DIR; ?>/css/rajib_point_style.css">

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

        .table-striped > tbody > tr:nth-child(2n+1) > td,
        .table-striped > tbody > tr:nth-child(2n+1) > th {
            background-color: #70ffaf;
        }

        .table thead th {
            font-size: 1.5rem;
            border: 3px solid #000000;
        }

        .jacos-bg {
            background-color: #0be60eb0 !important;
        }
        .comtpbtn button{
            font-size: larger;
            color: #ff0606;
            background: white;
            border: 3px solid #c82727;
        }

    </style>

</head>
<body>
<?php
$this->load->view('admin/components/header');
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header jacos-bg">
                    <div class="row">

                        <div class="col-3">
                            <h3 class="text-center">
                                <span id="">加盟企業別集計表</span><br>
                                <span id="">(中分類)</span>
                            </h3>
                        </div>
                        <div class="col-3 text-center">
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
                        <div class="col-4">
                            <div class="comtpbtn border-dark">
                                <button class="btn">加盟企業 <br>登録</button>
                                <button class="btn">加盟企業<br>呼出</button>
                                <button class="btn">加盟企業<br>リンク</button>
                            </div>

                        </div>
                        <div class="col-2">

                            <div class="row d-flex justify-content-between">
                                <h4 class="details_result mr-2">a＋ｂ－ｃ＝ｄ</h4>
                                <a class="btn btn-danger btn-lg float-right" style="margin-bottom: 5px" href="<?= base_url() ?>">戻る</a>
                            </div>
                        </div>


                        <div class="text-centre">
                        
                        </div>

                    </div>

                </div>
                <div class="card-content">
                    <div class="card-body custom-table">
                        <!-- Table with outer spacing -->
                        <div class="point_aquisition_wrapper">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="text-black text-center">
                                    <th style="width: 10%;">月日</th><!--Month-->
                                    <th style="width: 10%;">氏名</th><!--Company members Name-->
                                    <th style="width: 12%;">加盟企業</th><!--Company  Name-->
                                    <th style="width: 10%;">購入額</th><!--Purchase amount-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 6%;">前残<br>a</th><!--A amount-->
                                    <th style="width: 7%;">発生<br>b</th><!--B amount-->
                                    <th style="width: 8%;">使用<br>c</th><!--C amount-->
                                    <th style="width: 11%;">新規残<br>d</th><!--D amount-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 11%;">仮ポイント<br>b1</th><!--D. amount-->
                                    <th style="width: 11%;">合計<br>d+b1</th><!--D+B amount-->

                                </tr>
                                </thead>
                                <tbody id="company_memberlist_member">
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="card col-md-5 col-sm-12" id="companylist_message" style="background-color: #55f893; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 500px;
right: 10px;
bottom: 10px;
padding: 4px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <p style="font-size: 20px;">　
                    </p>

                    <center>
                        <button id="close_case_message" class="btn btn-warning btn-lg">確認</button>
                    </center>


                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>
<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . RES_DIR; ?>/bootstrap/dist/js/bootstrap.js"></script>

<?php
$this->load->view('admin/components/footer');
?>

<script>

    $(document).mouseup(function (e){
        var hide_enter_outside = $("#companylist_message");
        if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
        {
            hide_enter_outside.removeClass('d-block').addClass('d-none');
        }
    });

    $("#close_case_message").click(function(event) {
        event.preventDefault();
        $("#companylist_message").removeClass('d-block').addClass('d-none');
    });

    function get_category_company() {

        var base_url = $("#base_url").val();
        $.post(base_url + 'Point_Acquisition/get_allcompany_member/', function (data) {
            var response = JSON.parse(data);
            console.log(response, "get_company_member_list");
            var tableHtml = '';
            if (response.members.length > 0) {

                // Temporary
                var total_temp_order_amount = 0;
                var total_per_order_amount = 0;
                var total_point_amount = 0; //a
                //var total_used_point = 0; //like 500 when mature 500+
                //var new_balance = 0;
                //var provisional_point = 0;
                //permanent point members

                for (var i = 0; i < response.members.length; i++) {
                    // Permanent Points
                    var comName = response.company_details.fullname;

                    var last_order_date = response.members[i].perm.order_date == null ? "" : response.members[i].perm.order_date;
                    var user_perm_point = response.members[i].point_history.user_perm_points.user_point == null ? 0 : response.members[i].point_history.user_perm_points.user_point;
                    var perm_order_amount = response.members[i].perm.order_amount == null ? 0 : response.members[i].perm.order_amount;

                    var user_temporary_point = response.members[i].point_history.temporary_point == null ? 0 : response.members[i].point_history.temporary_point;
                    var user_exchange_amount = response.members[i].excenge_amount.amount == null ? 0 : response.members[i].excenge_amount.amount;

                    // Permanent excenge_amount
                    total_temp_order_amount += parseInt(perm_order_amount);
                    //user_perm_point + user_temporary_point;
                    var New_balance_d = parseInt(user_perm_point) - parseInt(user_exchange_amount);
                    var TotalDatadb = parseInt(New_balance_d) + parseInt(user_temporary_point);
                    //console.log("d+b : "+TotalDatadb);

                    //var z = x + y;

                    tableHtml += '<tr class="company_memberlist_member" data-link="' + response.members[i].user_id + '">';
                    tableHtml += '<td>' + last_order_date + '</td>';
                    tableHtml += '<td class="border_4px"><a class=""  style="text-decoration: underline;" href="'+base_url +'company_users_history/'+ response.members[i].user_id +'">' + response.members[i].fullname + '</a></td>';
                    tableHtml +='<td>'+comName +'</td>';
                    tableHtml += '<td class="bg-warning" style="text-align: right;">' + parseInt(perm_order_amount).toLocaleString('en') + '</td>';
                    tableHtml += '<td style="border:none !important; background-color: #fff;"></td>';
                    tableHtml += '<td>' + total_point_amount + '</td>';//a
                    tableHtml += '<td>' + Math.floor(user_perm_point) + '</td>';//b
                    tableHtml += '<td>'+ user_exchange_amount +'</td>';//c
                    tableHtml += '<td>'+ New_balance_d+'</td>';//d
                    tableHtml += '<td style="border:none !important; background-color: #fff;"</td>';
                    tableHtml += '<td>'+Math.floor(user_temporary_point)+'</td>';//b.
                    tableHtml += '<td>'+Math.floor(TotalDatadb)+'</td>';//d+b.

                    tableHtml += '</tr>';

                }


            } else {
                // alert("members not found!!!");
                tableHtml += '<tr >';
                tableHtml += "<td colspan='2' class='text-center'>";
                tableHtml += '<button style="margin-right:10px;" class="btn jafa_btn user_login_btn btn-lg" id="login_point_table">ログイン</button>';
                tableHtml += '<button class="btn btn-primary customer_reg_btn  btn-lg" id="register_point_table">登録</button>';
                tableHtml += "</td>";
                tableHtml += '</tr>';

            }
            $("#company_memberlist_member").html(tableHtml);


        });
    }


    get_category_company();


    $(document).ready(function () {

    });

    function Mycalc() {


    }


</script>


</body>
</html>
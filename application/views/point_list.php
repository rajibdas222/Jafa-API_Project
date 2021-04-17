<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ＪＡＦＡ（ダブルポイント）</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>resources/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css">

    <style type="text/css">
        table th {
            text-align: center;
        }

        .editable_field {
            border: 0;
            text-align: right;
            width: 150px;
        }

        input {
            background-color: transparent;
        }

        .datepicker table tr td span {
            font-size: 14px;
        }

        .report_period_screen {
            right: 10px;
            bottom: 10px;
            z-index: 1000;
            width: 430px;
        }

        .user-fullname {
            font-size: 32px;
        }

        .history-data {
            font-size: 26px;
        }

        #show_dateSetting {
            font-size: 26px;
        }

        @media only screen and (max-width: 768px) {
            .report_period_screen {
                right: 0px;
                bottom: 5px;
                z-index: 1000;
                width: 100%;
            }

            .user-fullname {
                font-size: 22px;
            }

            .history-data {
                font-size: 8px;
            }

            #show_dateSetting {
                font-size: 18px;
            }

        }

        )
        ;
    </style>
</head>
<body
">
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">

        <div class="col-md-6 col-sm-4 user-fullname" style="">
            <?php
            echo "会員名: " . $account_details->fullname;
            ?>
            様
            <span class="float-right">履歴</span>
        </div>
        <div class="col-md-6 col-sm-4">

            <button class="btn btn-danger btn-lg float-right" id="return_point_list" style="margin-right: 10px;"> 戻る
            </button>
            <?php
            if (empty($account->role_id)) {
                ?>
                <a href="<?= base_url() ?>exchange_history/null/null" style="margin-right: 10px;"
                   class="btn btn-info btn-lg float-right">交換履歴</a>
                <?php
            }
            ?>


        </div>
        <div class="col-md-12">
            <div class="float-md-right float-sm-left" style="font-size: 26px; padding-bottom: 10px;">
                <button id="report_period" class="btn btn-warning btn-lg">期間</button>
                :<span id="show_dateSetting"><?= $report_lenght; ?></span>

                <input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;" id="select_month_datepicker">

            </div>
        </div>
        <div class="col-md-12" style="margin-top: 20px;">
            <div class="table-responsive-sm">
                <table class="table table-bordered history-data" style="border: 3px solid blue;">
                    <thead>
                    <tr>
                        <th nowrap="nowrap">サイト名</th>
                        <th nowrap="nowrap">商品売上金額</th>
                        <th nowrap="nowrap">当社ポイント</th>
                        <th nowrap="nowrap">購入日時</th>
                        <th nowrap="nowrap">成果承認日</th>
                    </tr>
                    </thead>
                    <tbody id="">
                    <?php
                    $total_point = 0;
                    if (!empty($member_purchase)) {
                        $total_order_amount = 0;
                        $total_point_amount = 0;
                        foreach ($member_purchase as $key => $purchase) {
                            // print_r($purchase);
                            // exit();
                            $total_order_amount += $purchase->order_amount;
                            $total_point_amount += $purchase->point_amount;
                            $total_point += $purchase->user_point;
                            $shop = "";
                            if ($purchase->shop_id == 1) {
                                $shop = "アマゾン";
                            } elseif ($purchase->shop_id == 2) {
                                $shop = "ヤフー";
                            } elseif ($purchase->shop_id == 3) {
                                $shop = "楽天";
                            } elseif ($purchase->shop_id == 4) {
                                $shop = "ヨーカドー";
                            }
                            ?>
                            <tr>
                                <td><?= $shop ?></td>
                                <!-- <td><?= $purchase->tracking_id ?></td> -->
                                <td class="text-right"><?= number_format($purchase->order_amount) ?></td>
                                <td class="text-right"><?= number_format(floor($purchase->user_point)) ?></td>
                                <td><?= $purchase->order_date ?></td>
                                <td><?= $purchase->perm_processing_date ?></td>
                                <!-- <td><?= $purchase->amazon_per_date ?></td> -->
                                <!-- <td class="text-center"><?= $purchase->user_percentage ?>%</td>
									<td class="text-right"><?= floor($purchase->user_point) ?></td> -->
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <th class="text-center" colspan="5" class="text-right">データが見つかりません。</th>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <?php
                    if (!empty($member_purchase)) {
                        ?>
                        <tfoot>
                        <tr style="background-color: yellow;">
                            <th class="text-right">合計</th>
                            <th class="text-right"><?= number_format($total_order_amount) ?></th>
                            <th class="text-right"><?= number_format(floor($total_point)) ?></th>
                            <th class="text-center">-</th>
                            <th class="text-center">-</th>
                            <!-- <th class="text-center"></th>
								<th class="text-right"><?= number_format($total_point) ?></th> -->
                        </tr>
                        </tfoot>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- Card Stared -->
<div class="card report_period_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
    <div class="card-header">
        <div class="">
            <h3>期間設定
                <button class="btn btn-danger btn-lg float-right" id="close_report_period_screen">戻る</button>
            </h3>

        </div>


    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="col-md-12">
                        <label class="form-check-label" for="exampleRadios1" style="font-size: 20px; width: 90px;">
                            <input style="height: 20px; width: 20px;" class="form-check-input" type="radio"
                                   name="sorting" id="exampleRadios1" value="all">
                            すべて
                        </label>

                        <label class="form-check-label" for="exampleRadios2" style="font-size: 20px; width: 90px;">
                            <input style="height: 20px; width: 20px;" class="form-check-input" type="radio"
                                   name="sorting" id="exampleRadios2" value="month_wise" checked>
                            月別
                        </label>

                        <label class="form-check-label" for="date_wise" style="font-size: 20px; width: 90px;">
                            <input style="height: 20px; width: 20px;" class="form-check-input" id="date_wise"
                                   type="radio" name="sorting" value="date_range">
                            日別
                        </label>

                    </div>
                </div>
                <div class="row">

                    <input id="month_wise" readonly="readonly" type="text" class="form-control d-block"
                           value="<?= date('Y年m月') ?>" placeholder="Month">

                    <div class="input-group mb-3 input-daterange date_range d-none">
                        <input id="start_date" readonly autocomplete="off" type="text" class="form-control"
                               placeholder="開始">
                        <div class="input-group-prepend">
                            <span class="input-group-text">～</span>
                        </div>
                        <input type="text" readonly id="end_date" autocomplete="off" class="form-control"
                               placeholder="終了">
                    </div>


                </div>
                <input type="hidden" id="selected_type" value="" name="">
                <input type="hidden" id="selected_year" value="" name="">
                <input type="hidden" id="selected_month" value="" name="">
                <input type="hidden" id="selected_start_date" value="" name="">
                <input type="hidden" id="selected_end_date" value="" name="">
                <div class="form-group text-center" style="margin-top: 10px;">

                    <button type="submit" id="submit_sorting" class="btn btn-primary btn-lg">完了</button>
                </div>

            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
    jQuery(document).ready(function ($) {
        $.fn.datepicker.dates['en'] = {
            days: ["日", "月", "火", "水", "木", "金", "土"],
            daysShort: ["日", "月", "火", "水", "木", "金", "土"],
            daysMin: ["日", "月", "火", "水", "木", "金", "土"],
            months: ["１月", "２月", "３月", "４月", "５月", "６月", "７月", "８月", "９月", "１０月", "１１月  ", "１２月"],
            monthsShort: ["１月", "２月", "３月", "４月", "５月", "６月", "７月", "８月", "９月", "１０月", "１１月 ", "１２月"],
            today: "Today",
            clear: "Clear",
            format: "mm/dd/yyyy",
            titleFormat: "MM yyyy年", /* Leverages same syntax as 'format' */
            weekStart: 0
        };

        $('.input-daterange input').each(function () {

            $(this).datepicker({
                format: 'yyyy年mm月dd日',
                autoclose: true,
                todayHighlight: false,
                orientation: "auto",
            });
        });

        $('input#month_wise').datepicker({
            format: 'yyyy年mm月',
            viewMode: "months",
            minViewMode: "months",
            autoclose: true,
            todayHighlight: false,
            orientation: "auto",
        })
        $('input:radio[name="sorting"]').click(function (event) {
            var sorting = $("input:checked").val();
            if (sorting == 'all') {
                $("#month_wise").removeClass('d-block').addClass('d-none');
                $(".date_range").removeClass('d-block').addClass('d-none');
            } else if (sorting == 'month_wise') {
                // alert("Okay")
                $("#month_wise").removeClass('d-none').addClass('d-block');
                $(".date_range").removeClass('d-block').addClass('d-none');
            } else if (sorting == 'date_range') {
                $("#month_wise").removeClass('d-block').addClass('d-none');
                $(".date_range").removeClass('d-none');
            }
        });

        $("#submit_sorting").click(function (event) {
            event.preventDefault();
            var base_url = $("#base_url").val();
            var sorting = $("input:checked").val();
            var user_id = "<?php echo $user_id ?>";
            if (sorting == 'all') {
                window.location = base_url + "purchase_list/" + user_id + "/all/null";
            } else if (sorting == 'month_wise') {
                var month_wise = $("#month_wise").val();
                var exploadYear = String(month_wise).split("年");
                var exploadMonth = String(exploadYear[1]).split("月");
                window.location = base_url + "purchase_list/" + user_id + "/" + exploadYear[0] + '-' + exploadMonth[0] + "/null";
            } else if (sorting == 'date_range') {
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();
                if (end_date == "") {
                    end_date = start_date;
                    $("#end_date").val(end_date);
                }

                if (start_date != "") {
                    var start_year = String(start_date).split("年");
                    var start_month = String(start_year[1]).split("月");
                    var dateOnly = String(start_month[1]).split("日");

                    var end_year = String(end_date).split("年");
                    var end_month = String(end_year[1]).split("月");
                    var end_dateOnly = String(end_month[1]).split("日");

                    window.location = base_url + "purchase_list/" + user_id + "/" + start_year[0] + '-' + start_month[0] + '-' + dateOnly[0] + "/" + end_year[0] + '-' + end_month[0] + '-' + end_dateOnly[0];

                } else {
                    $("#start_date").focus();
                    return false;
                }

            }

        });

        $(document).on('change', '#start_date', function (event) {
            event.preventDefault();
            var d = new Date();
            // var month = (d.getMonth() + 1);
            var month = ("0" + (d.getMonth() + 1)).slice(-2)
            // var day = d.getDate();
            var day = ("0" + d.getDate()).slice(-2);

            var year = d.getFullYear();
            // 2020年01月1日
            var end_date = year + "年" + month + "月" + day + "日"
            // console.log(year)
            // console.log(month)
            // console.log(day)
            $("#end_date").val(end_date);
        });

        $("#report_period").click(function (event) {
            // Desable all button
            $("#report_period").attr("disabled", true);
            $("#return_point_list").attr("disabled", true);

            $(".report_period_screen").removeClass('d-none').addClass('d-block');
        });

        $("#close_report_period_screen").click(function (event) {
            // Anable all button
            $("#report_period").attr("disabled", false);
            $("#return_point_list").attr("disabled", false);
            $(".report_period_screen").removeClass('d-block').addClass('d-none');
        });

        $(document).on('click', '#return_point_list', function (event) {
            window.history.back(-1);
            var base_url = $("#base_url").val();
            if (!window.close()) {
                window.location = base_url + 'admin_company_point';
            }
        });
    });
</script>
</body>
</html>
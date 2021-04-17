<!DOCTYPE html>
<html translate="no">
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
                <div class="card-header jacos-bg text-center">
                    <div class="row">
                        <div class="col-2">
                            <span style="color: red; font-size: 30px;line-height: 60px;">小</span>
                        </div>
                        <div class="col-4">
                            <div style="margin-top: 14px" class="row">
                                <h3 class="text-danger">
                                    <span style="background:#f9fcfc;">会員別</span>
                                </h3>
                                <div class="ml-3 d-flex">
                                    <h5 style="color: #050303; background-color: white;"><?php echo $user_info->fullname ?></h5>
                                    <h5 style="">様</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="comtpbtn border-dark float-right">
                                <button class="btn btn-sm">加盟企業<br>登録</button>
                                <button class="btn btn-sm">加盟企業<br>呼出</button>
                            </div>

                        </div>
                        <div class="col-3">
                            <div class="row d-flex justify-content-between">
                                <h4 class="details_result mr-2">a＋ｂ－ｃ＝ｄ</h4>
                                <a class="btn btn-danger btn-lg" style="margin-bottom: 5px" href="<?= base_url() ?>allcompany_list">戻る</a>
                            </div>

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
                                    <th style="width: 10%;">月日<!--Date--></th>
                                    <th style="width: 10%;">氏名<!--companys member name--></th>
                                    <th style="width: 10%">加盟企業</th><!--company-->
                                    <th style="width: 10%;">購入額</th>
                                    <th style="width: 10%;">前残<br>a</th>
                                    <th style="width: 10%;">発生<br>b</th>
                                    <th style="width: 10%;">使用<br>c</th>
                                    <th style="width: 10%;">新規残高<br>d</th>
                                    <th style="width: 10%; border:3px solid #439207 !important;">仮ポイント <br> b1</th>
                                    <th style="width: 10%;">合計</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                $row_count = 1;
                                $finalPointBalance = 0;
                                $previousTotalBalance = 0;
                                $useableBalance = 0;
                                $ussedAmount = 0;
                                $oneMonthBalance = 0;
                                $TotalBalance = 0;
                                //print_r($converted_point);exit;
                                $total_used_point = $converted_point->converted_point;//$user_used_point[0]->total_used_point;
                                $data = array_merge($user_temp_points, $user_perm_points);//$user_temp_points+$user_perm_points;
                                $aPoint = 0;
                                foreach ($data as $key => $points_details) {
//                                    echo "<pre>";
//                                    print_r($points_details);
//                                    echo "</pre>";
//                                    exit();
                                    $is_new_entry = 0;
                                    $userorderDate = strtotime(date('Y-m-d', strtotime($points_details->order_date))); //given that the 3 variables are holding the user date elements.
                                    $now = time();
                                    $delta = strtotime(date('Y-m-d', strtotime("-1 month")));
//                                    if($userorderDate>$delta){
//                                        $is_new_entry = 1;
//                                    }
                                    if (is_null($points_details->perm_processing_date) || $points_details->perm_processing_date >= date('Y-m-d H:i:s')) {
                                        $is_new_entry = 1;
                                    }

                                    if ($is_new_entry == 0) {
                                        $useableBalance += $points_details->jafa_point;
                                        if ($useableBalance > 500 && $total_used_point >= 500) {
                                            $ussedAmount = 500;
                                            $total_used_point = $total_used_point - 500;
                                            $useableBalance = $useableBalance - $ussedAmount;
                                        } else {
                                            $ussedAmount = 0;
                                        }

                                    } else {
                                        $oneMonthBalance += $points_details->jafa_point;
                                    }
                                    $TotalBalance = $useableBalance + $oneMonthBalance;

                                    ?>
                                    <tr>
                                        <td><?php echo $points_details->order_date ?></td>
                                        <td><?php echo $user_info->fullname ?></td>

                                        <td><?php echo isset($user_perm_points[0]->company_name) ? $user_perm_points[0]->company_name : '' ?></td>
                                        <td><?php echo $points_details->order_amount ?></td>
                                        <td><?= $previousTotalBalance ?></td>
                                        <td><?php echo $points_details->jafa_point ?></td>
                                        <td><?= $ussedAmount ?></td>
                                        <td><?= floor($useableBalance) ?></td>
                                        <td style="border: 3px solid #000000 !important;"><?= floor($oneMonthBalance) ?></td>
                                        <td><?= round($TotalBalance) ?></td>

                                    </tr>

                                    <?php $row_count++;
                                    $previousTotalBalance = $TotalBalance;

                                } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

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
    $(document).on('click', '#return_point_list', function (event) {
        window.history.back(-1);
        var base_url = $("#base_url").val();
        if (!window.close()) {
            window.location = base_url + 'admin_company_point';
        }
    });

    function update(i, id) {
        let base_url = $("#base_url").val();
        let a = $('#point_leftover' + i).text();
        let b = $('#occurrence' + i).text();
        let c = $('#use_point' + i).text();
        let d = parseFloat(a) + parseFloat(b) - parseFloat(c);
        $('#new_balance' + i).text(d);

        let url = base_url + 'Point_Acquisition_Details/updatePointDetails';
        $.ajax({
            url: url,
            type: 'post',
            data: {a: a, id: id},
            success: function (result) {
                console.log(result);
            }
        });


    }


    $(document).ready(function () {

    });


</script>


</body>
</html>
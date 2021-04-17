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
            text-align: center;
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

        .point-heading-big {
            font-size: 2rem;
            font-weight: 500;
        }
        .custom-table .table td {
            text-align: right;
        }


    </style>

</head>
<body>
<?php
    $this->load->view('admin/components/header');
?>



<div class="container-fluid">
    <!-- Basic Tables start -->
    <div class="row">

        <div class="col-12">
            <div class="card mt-2">
                <div class="card-header jacos-bg">
                    <h4 style="margin: 0;" class="text-center point-heading-big">ポイント習得と配分表</h4>
                </div>
                <div class="card-content">
                    <div class="card-body custom-table">
                        <!-- Table with outer spacing -->
                        <div class="point_aquisition_wrapper">
                            <table class="table table-bordered table-striped point_aquisition_tbl">
                                <thead>
                                <tr class="text-black">
                                    <th style="width: 80px;">番号</th>
                                    <th style="width: 110px;">氏名</th>
                                    <th style="width: 150px;">残高 <br>取得ポイント</th>
                                    <th style="width: 100px;">ジャコス</th>
                                    <th style="width: 120px;">残高 <br>会員企業</th>
                                    <th style="width: 80px;">合計</th>
                                    <th style="width: 60px;">売上</th>
                                    <th style="">備考</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <a href="point-details">田原屋</a>
                                    </td>
                                    <td>50%</td>
                                    <td>25％</td>
                                    <td>25％</td>
                                    <td>100％</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td id="">田原屋 さん</td>
                                    <td>50%</td>
                                    <td>50％</td>
                                    <td>なし<span><i class="fas fa-times text-danger"></i></span></td>
                                    <td>100%</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>た</td>
                                    <td>50%</td>
                                    <td>50％</td>
                                    <td>なし<span><i class="fas fa-times text-danger"></i></span></td>
                                    <td>100%</td>
                                    <td></td>
                                    <td></td>

                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>な</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>ま</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->

    <!-- Card Stared -->
    <div class="card" id="acquistion_message_message" style="background-color: #DAEEF3; border: 2px solid #486994; border-radius: 10px; position: fixed;
right: 10px;
bottom: 10px;
padding: 4px;">
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="pop_up_body">
                    <p class="text-center" style="font-size: 20px;">各項目を押すと 詳細が表示されます</p>
                </div>
            </div>
            <div class="pop_up_footer text-center">
                <button id="acquistion_message_btn" class="btn btn-warning acquistion_message btn-lg">確認</button>
            </div>

        </div>
    </div>
    <!-- Card Ended  -->


</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . RES_DIR; ?>/bootstrap/dist/js/bootstrap.js"></script>

<?php
$this->load->view('admin/components/footer');
?>

<script>
    $('#acquistion_message_btn').click(function () {
        $('#acquistion_message_message').hide();
    });




</script>


</body>
</html>
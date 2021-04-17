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
                            <h5 class="">
                                <span id="">ポイント計算 <br> 加盟企業別</span><br>
                            </h5>
                        </div>
                        <div class="col-2">
                            <?php
                            $fullname = "";
                            if ($this->authentication->is_signed_in()) {
                                $fullname = $account_details->fullname;
                                ?>
                                <a href="<?= base_url('account/account_profile') ?>" style="text-decoration: underline;text-decoration-color: #f9fbff; background: #f9fbff;font-size:1.5rem;"> <?= $fullname ?></a><span style="font-size:1.5rem;"> 様</span>
                                <?php
                            }else{
                                ?>
                                <span style="border-bottom: 1px solid #00a0e8; width: 100px;" ></span>
                                <span class="text-right" style="color: #00a0e8"> 様</span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-7">

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
                                    <th style="width: 10%;">氏名</th><!--Company Name-->
                                    <th style="width: 10%;">購入額 Purchase amount</th><!--Purchase amount-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 10%;">前残<br>a point amount</th><!--A amount-->
                                    <th style="width: 10%;">発生<br>b</th><!--B amount-->
                                    <th style="width: 11%;">使用<br>c</th><!--C amount-->
                                    <th style="width: 11%;">新規残<br>d</th><!--D amount-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 11%;">仮ポイント<br>b.</th><!--D. amount-->
                                    <th style="width: 11%;">合計<br>d+b</th><!--D+B amount-->

                                </tr>
                                </thead>
                                <tbody id="company_list_member">
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

    function get_category_company() {

        var base_url = $("#base_url").val();
        $.get(base_url+'main_controller/getall_company_history/', function(data) {
            var response = JSON.parse(data);
            console.log(response,"get_company_list");
            var tableHtml = '';
            if (response.company_summary.length>0) {


                for (var i = 0; i < response.company_summary.length; i++) {

                    if (response.company_summary[i].major_company == 0) {

                        var total_order_amount = 0;
                        var total_per_point_amount = 0;
                        var order_amount = parseInt(response.company_summary[i].temp_order_amount)+parseInt(response.company_summary[i].per_order_amount);
                        total_order_amount += order_amount;

                        total_per_point_amount += parseInt(response.company_summary[i].per_point_amount);

                        tableHtml += '<tr class="company_list_member" data-link="'+response.company_summary[i].user_id+'">';
                        tableHtml +='<td></td>';
                        tableHtml += '<td class="border_4px"><a class=""  style="text-decoration: underline;" href="#">'+response.company_summary[i].company_name+'</a></td>';
                        tableHtml += '<td>'+total_order_amount+'</td>';
                        tableHtml += '<td style="border:none !important; background-color: #fff;"></td>';
                        tableHtml += '<td>'+total_per_point_amount+'</td>';



                        tableHtml += '</tr>';
                    }else{

                    }
                }


                $( "#company_list_member" ).html( tableHtml );
            }

        });
    }


    get_category_company();

    $(document).ready(function () {

    });


</script>


</body>
</html>
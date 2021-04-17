<!DOCTYPE html>
<html lang="en">
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
<div class="container-fluid mt-2">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header jacos-bg">
                    <div class="row">

                        <div class="col-4">
                            <h5 class="">
                                <span id="">ジャコス管理表(大分類)</span><br>
                                加盟企業ごとに、会員　会計を表示(全体)
                            </h5>
                        </div>
                        <div class="col-2">
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
                        <div class="col-6">
                            <button type="button" class="btn btn-warning">加盟企業 <br>登録</button>
                            <button type="button" class="btn btn-warning">加盟企業 <br>呼出</button>
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
                                    <th style="width: 10%;">月日 </th><!--Month-->
                                    <th style="width: 10%;">氏名</th><!--Members Name-->
                                    <th style="width: 10%;">加盟企業</th><!--Company Name-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 10%;">前残<br>a</th><!--A amount-->
                                    <th style="width: 10%;">発生<br>b</th><!--B amount-->
                                    <th style="width: 11%;">使用<br>c</th><!--C amount-->
                                    <th style="width: 11%;">新規残<br>d</th><!--D amount-->
                                    <th style="width: 1%;"></th><!--empty-->
                                    <th style="width: 11%;">仮ポイント<br>b.</th><!--D. amount-->
                                    <th style="width: 11%;">合計<br>d+b.</th><!--D+B amount-->

                                </tr>
                                </thead>
                                <tbody id="admin_company_memberlist">
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


</div>



<?php
$this->load->view('admin/components/footer');
?>
<script type="text/javascript">
    function get_all_member_company() {
        var base_url = $("#base_url").val();
        $.get(base_url+'main_controller/get_company_summary', function(data) {
            var response = JSON.parse(data);
             console.log(response);
            // return fal
            var tableHtml = '';
            if (response.all_company.length>0) {
                var total_sales_amount = 0;
                var item_sales_amount = 0;
                var total_charin = 0;
                var com_total = 0;
                var member_total = 0;
                var com_member = 0;
                var chalin_two = 0;
                var service_total = 0;
                for (var i = 0; i < response.all_company.length; i++) {
                    // console.log();
                    // return false;
                    // console.log(response.all_company[i].major_company);
                    item_sales_amount = response.all_company[i].item_sales_amount;
                    chalin_two = response.all_company[i].chalin_two;
                    if (item_sales_amount==null) {
                        item_sales_amount = 0;
                    }
                    if (chalin_two ==null) {
                        chalin_two = 0;
                    }
                    var com_mar = 75;
                    var member_mar = 0;
                    if (response.all_company[i].com_mar > 0) {
                        com_mar = response.all_company[i].com_mar;
                        member_mar = response.all_company[i].member_mar;
                    }

                    var service_amount = ((chalin_two*25)/100);
                    service_total += service_amount;
                    if (response.all_company[i].major_company == 0) {

                        total_sales_amount += parseInt(item_sales_amount);
                        total_charin += parseInt(chalin_two);
                        com_total += ((parseInt(chalin_two)*com_mar)/100);
                        member_total += ((parseInt(chalin_two)*member_mar)/100);
                        com_member += ((parseInt(chalin_two)*(parseInt(com_mar)+parseInt(member_mar)))/100);
                        tableHtml += '<tr>';

                        tableHtml += '<th class="text-right"></th>';
                        tableHtml += '<th class="text-right"></th>';
                        tableHtml += '<td><a class="company_member_list"  style="text-decoration: underline;" href="'+response.all_company[i].user_id+'">'+response.all_company[i].company_name+'</a></td>';

                        tableHtml += '</tr>';
                    }else{

                    }
                }


                // tableHtml += '<tr style="background-color: yellow;"><th>計</th><th class="text-right">'+total_sales_amount.toLocaleString('en')+'</th>	<th style="border-right: 6px double black" class="text-right" id="all_purch_total">'+Math.floor(total_charin).toLocaleString('en')+'</th>';
                // tableHtml += '<th>&nbsp</th>';
                // tableHtml += '<th class="text-right">'+Math.floor(com_total).toLocaleString('en')+'</th>';
                // tableHtml += '<th>&nbsp</th>';
                // tableHtml += '<th class="text-right">'+Math.floor(member_total).toLocaleString('en')+'</th>';
                // tableHtml += '<th>&nbsp</th>';
                //
                //
                // tableHtml += '<th style="border-right: 6px double black" class="text-right">'+Math.floor(com_member).toLocaleString('en')+'</th>';
                //
                // tableHtml += '<th></th>';
                // tableHtml += '<th class="text-right">'+Math.floor(service_total).toLocaleString('en')+'</th>';
                // tableHtml += '</tr>';

                $( "#admin_company_memberlist" ).html( tableHtml );
            }

        });
    }


    get_all_member_company();



</script>
</body>
</html>
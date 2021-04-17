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
                        <div class="col-4"></div>
                        <div class="col-4"> <h2 class="modal-title ml-2"><span id="Point_details_header">個人別 ポイント明細</span></h2></div>
                        <div class="col-4"><h4 class="details_result mr-2">a＋ｂ－ｃ＝ｄ(在庫管理と同一)</h4></div>

                    </div>

                </div>
                <div class="card-content">
                    <div class="card-body custom-table">
                        <!-- Table with outer spacing -->
                        <div class="point_aquisition_wrapper">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr class="text-black text-center">
                                    <th style="width: 220px;">商品名</th>
                                    <th style="width: 130px;">トラッキングID</th>
                                    <th style="width: 90px;">価格</th>
                                    <th style="width: 100px;">ポイント 量</th>
                                    <th style="width: 110px;">ユーザーポイント</th>
                                    <th style="width: 90px;">ジャファーポイント</th>
                                    <th style="width: 100px;">ユーザー <br> パーセンテージ</th>
                                    <th style="width: 100px;">注文日</th>
                                    <th style="width: 100px;">ASIN(Remarks)</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $points_details) { ?>
                                    <tr>
                                        <td><?php echo $points_details->product_name ?></td>
                                        <td><a href="<?php echo base_url('point_details/'.$points_details->user_id)?>"><?php echo $points_details->tracking_id; ?></td>
                                        <td><?php echo $points_details->order_amount; ?></td>
                                        <td><?php echo $points_details->point_amount; ?></td>
                                        <td><?php echo $points_details->user_point; ?></td>
                                        <td><?php echo $points_details->jafa_point; ?></td>
                                        <td><?php echo $points_details->user_percentage; ?></td>
                                        <td><?php echo $points_details->order_date; ?></td>
                                        <td><?php echo $points_details->remarks; ?></td>

                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="card col-md-5 col-sm-12" id="point_case_message"
         style="background-color: #DAEEF3; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 500px;
right: 10px;
bottom: 10px;
padding: 4px;">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p style="font-size: 24px;">トラッキングIDを押してください。</p>
                    <button id="point_navi_btn" class="btn btn-warning btn-lg close_point_message">確認</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>




</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() . RES_DIR; ?>/bootstrap/dist/js/bootstrap.js"></script>

<?php
$this->load->view('admin/components/footer');
?>

<script>

    window.pressed = function(){
        var a = document.getElementById('aa');
        if(a.value == "")
        {
            fileLabel.innerHTML = "Choose csv file";
        }
        else
        {
            var theSplit = a.value.split('\\');
            fileLabel.innerHTML = theSplit[theSplit.length-1];
        }
    };

    $(document).ready(function () {
        $('#point_leftover').blur(function () {
            let a = $('#point_leftover').val();
            let b = $('#point_order').val();
            let c = $('#use_point').val();
            let d = parseFloat(a)+parseFloat(b)-parseFloat(c);
            $('#new_balance').text(d);
        });


        $('#use_point').blur(function () {
            let a = $('#point_leftover').val();
            let b = $('#point_order').val();
            let c = $('#use_point').val();
            let d = parseFloat(a)+parseFloat(b)-parseFloat(c);
            console.log(d);
            $('#new_balance').text(d);

        });


        //point details navi.
        $(".close_point_message").click(function(event) {
            event.preventDefault();
            $("#point_case_message").removeClass('d-block').addClass('d-none');
        });


        for (let i = 0; i < 5; i++) {
            console.log(i)
        }
        console.log('end for loop');


        // var i = 0;
        // while(i <=10){
        //     console.log('while loop',i);
        //     i++;
        // }

        //array

        var fruits = ["Apple", "Banana", "Cherry","Mango", "Papaya", "Cherry"];
        for (let j = 0; j < fruits.length; j++) {
            console.log(fruits[j]);
        }


        //pass value by reference
        var m =10;
        function addOne(value) {
            value = value+1
        }
        addOne(m);
        console.log(m);

        var person = {
            name:'Rajib',
            age:26,
        };

        function addPerson(obj) {
            obj.age = obj.age+1;
        }
        addPerson(person);
        console.log(person);




    });



</script>


</body>
</html>
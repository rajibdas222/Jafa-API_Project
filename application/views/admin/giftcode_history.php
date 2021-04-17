<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>resources/bootstrap/dist/css/bootstrap.css">
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css">

	<style type="text/css">
		table th{
			text-align: center;
		}
		.editable_field{
			border: 0;
			text-align: right;
			width: 150px;
		}
		input{
			background-color: transparent;
		}
		.datepicker table tr td span{
			font-size: 14px;
		}

		.report_period_screen {
			right: 10px; bottom: 10px;
			z-index: 1000;
			width: 430px;
		}

		@media only screen and (max-width: 768px) {
			.report_period_screen {
				right: 0px; bottom: 5px;
				z-index: 1000;
				width: 100%;
			}
		});
	</style>
</head>
<body">
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">
			<!-- <div class="col-sm-2"> -->
				<?php
				// $fullname = "";
				// if ($this->authentication->is_signed_in()) {
				// 	$fullname = $account_details->fullname;
				// }
				?>
				<!-- <a href="<?= base_url('account/account_profile') ?>" style=" font-size: 26px; text-decoration: underline; color: #000;"> <?= $fullname ?></a><span style="font-size: 26px"> 様</span> -->
			<!-- </div> -->
			<div class="col-md-6" style="font-size: 32px;">
				<?php
					echo "会員名: ".$account_details->fullname;
				?>
			</div>
			<div class="col-md-6" style="font-size: 28px;">
				
				<button class="btn btn-danger btn-lg float-right" onclick="window.close();" id="" style="margin-right: 10px;"><i class="fa fa-user-plus"></i> 戻る</button>
				
			</div>
			<div class="col-md-12">
				<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
					
					<!-- <button  onclick="$('input#select_month_datepicker').focus()" style="background-color: #FFC000; border: 2px solid green;" class="btn btn-default btn-sm">期間</button> -->
					<button id="report_period" class="btn btn-warning btn-lg">期間</button>
					: <span id="show_dateSetting">
						<?= $report_lenght; ?>
						<!-- <?php echo date('m月'). date('1日').'～'.date('m月末日'); ?> -->
					</span>

					<input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker">

				</div>
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				<table class="table table-bordered" style="font-size: 26px; border: 3px solid blue;">
					<thead>
						<tr>
                            <th>#</th>
							<!-- <th nowrap="nowrap">メールアドレス</th> -->
							<th nowrap="nowrap">amazonギフトID</th>
                            <th nowrap="nowrap">交換ポイント数</th>
                            
                            <th>交換日</th>
                            <th>有効期限</th>
                            <th>交換伝票No</th>
						</tr>						
					</thead>
					<tbody id="">
						<?php
						$i = 0;
						$total_amount = 0;
                        if (!empty($giftcodes)) {
	                       
							foreach ($giftcodes as $key => $giftcode) { 
	                            $i++;
	                            $total_amount += $giftcode->price_amount;
								?>
								<tr>
	                                <td><?= $i; ?></td>
									<!-- <td><?= $giftcode->email;  ?></td>    -->
									<td><?= $giftcode->gift_code; ?></td>
									<td class="text-right"><?= number_format($giftcode->price_amount) ?></td>
	                                
	                                <td><?= $giftcode->use_date;  ?></td>
	                                <td><?= $giftcode->expire_date ?></td>
	                                <td><?= $giftcode->sl_number ?></td>
								</tr>
								<?php
							}
                        }else{
                        
						?>
						<tr>
							<th colspan="6" class="text-center">
								データが見つかりません。
							</th>
						</tr>
						<?php
						}
						?>

					</tbody>
					<?php
					if (!empty($giftcodes)) {
						?>
						<tfoot>
	                        <tr style="background-color: yellow;">
	                            <th colspan="2">合計</th>
	                            <th><?= number_format($total_amount) ?></th>
	                            <th colspan="3"></th>
	                        </tr>
	                    </tfoot>
						<?php
					}
					?>
					
				</table>  
			</div>		   	
		</div>

		
	</div>
	<!-- Card Stared -->
	<div class="card report_period_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-12">
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="sorting" id="exampleRadios1" value="all">
					  <label class="form-check-label" for="exampleRadios1">
					   	すべてのレポート
					  </label>
					</div>
					<div class="form-check row">
						<div class="col-sm-12">
							<input class="form-check-input" type="radio" name="sorting" id="exampleRadios2" value="month_wise" checked>
							<label class="form-check-label" for="exampleRadios2">
							  月別レポート
							</label>
						<!-- </div>
						<div class="col-sm-9"> -->
							<input id="month_wise" type="text" class="form-control d-block" value="<?= date('Y年m月') ?>" placeholder="Month">
						</div>
					  
					  
					</div>
					<div class="form-check">
						<input class="form-check-input" id="date_wise" type="radio" name="sorting" value="date_range">
						<label class="form-check-label" for="date_wise">
						  日付範囲に関するレポート
						</label>
						<div class="input-group mb-3 input-daterange date_range d-none">
							<input id="start_date" autocomplete="off" type="text" class="form-control" placeholder="Start Date">
						  <div class="input-group-prepend">
						    <span class="input-group-text">～</span>
						  </div>
						  <input type="text" id="end_date" autocomplete="off" class="form-control" placeholder="End Date">
						</div>
					</div>
					<input type="hidden" id="selected_type" value="" name="">
					<input type="hidden" id="selected_year" value="" name="">
					<input type="hidden" id="selected_month" value="" name="">
					<input type="hidden" id="selected_start_date" value="" name="">
					<input type="hidden" id="selected_end_date" value="" name="">
					<div class="form-group text-center" style="margin-top: 10px;">
						<button class="btn btn-danger btn-lg" id="close_report_period_screen">戻る</button>
						<button type="submit" id="submit_sorting" class="btn btn-primary btn-lg">提出する</button>
					</div>

				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script>
		jQuery(document).ready(function($) {
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

			$('.input-daterange input').each(function() {

			    $(this).datepicker({
					format: 'yyyy年mm月d日',
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
			$('input:radio[name="sorting"]').click(function(event) {
				var sorting = $("input:checked").val();
				if (sorting=='all') {
					$("#month_wise").removeClass('d-block').addClass('d-none');
					$(".date_range").removeClass('d-block').addClass('d-none');
				}else if(sorting=='month_wise'){
					// alert("Okay")
					$("#month_wise").removeClass('d-none').addClass('d-block');
					$(".date_range").removeClass('d-block').addClass('d-none');
				}else if(sorting=='date_range'){
					$("#month_wise").removeClass('d-block').addClass('d-none');
					$(".date_range").removeClass('d-none');
				}
			});

			$("#submit_sorting").click(function(event) {
				event.preventDefault();
				var base_url = $("#base_url").val();
				var sorting = $("input:checked").val();
				var user_id = "<?php echo $user_id ?>"; 
				if (sorting == 'all') {
					window.location = base_url+"purchase_list/"+user_id+"/all/null";
				}else if(sorting=='month_wise'){
					var month_wise = $("#month_wise").val();
					var exploadYear = String(month_wise).split("年");
					var exploadMonth = String(exploadYear[1]).split("月");
					window.location = base_url+"purchase_list/"+user_id+"/"+exploadYear[0]+'-'+exploadMonth[0]+"/null";
				}else if(sorting=='date_range'){
					var start_date = $("#start_date").val();
					var end_date = $("#end_date").val();
					if (end_date == "") {
						end_date = start_date;
						$("#end_date").val(end_date);
					}

					if (start_date !="") {
						var start_year = String(start_date).split("年");
						var start_month = String(start_year[1]).split("月");
						var dateOnly = String(start_month[1]).split("日");

						var end_year = String(end_date).split("年");
						var end_month = String(end_year[1]).split("月");
						var end_dateOnly = String(end_month[1]).split("日");

						window.location = base_url+"purchase_list/"+user_id+"/"+start_year[0]+'-'+start_month[0]+'-'+dateOnly[0]+"/"+end_year[0]+'-'+end_month[0]+'-'+end_dateOnly[0];
						
					}
					$("#start_date").focus();				
				}				
				
			});

			$("#report_period").click(function(event) {
				$(".report_period_screen").removeClass('d-none').addClass('d-block');
			});

			$("#close_report_period_screen").click(function(event) {
				$(".report_period_screen").removeClass('d-block').addClass('d-none');
			});
		});
	</script>
</body>
</html>
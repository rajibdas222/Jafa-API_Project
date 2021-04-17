<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
	</style>
</head>
<body>
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row" style="width: 100%">
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
				履歴
			</div>
			<div class="col-md-6" style="font-size: 28px;">
				
				<button class="btn btn-danger btn-lg float-right" onclick="window.close();" id="" style="margin-right: 10px;"><i class="fa fa-user-plus"></i> 戻る</button>
				
			</div>
			<div class="col-md-12">
				<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
					
					<button  onclick="$('input#select_month_datepicker').focus()" style="background-color: #FFC000; border: 2px solid green;" class="btn btn-default btn-sm">期間</button>
					: <span id="show_dateSetting">
						<?php echo date('m月'). date('1日').'～'.date('m月末日'); ?>
					</span>

					<input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker">

				</div>
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				<table class="table table-bordered" style="font-size: 26px; border: 3px solid blue;">
					<thead>
						<tr>
							<th nowrap="nowrap">日付</th>
							<th nowrap="nowrap">ショップ</th>
							<th nowrap="nowrap">商品名</th>
							<th nowrap="nowrap">金額</th>
							<th nowrap="nowrap">ポイント</th>
							
						</tr>						
					</thead>
					<tbody id="">
						<?php
						foreach ($member_purchase as $key => $purchase) { 
							// print_r($purchase);
							$shop = "";
							if ($purchase->shop_id==1) {
								$shop = "アマゾン";
							}elseif ($purchase->shop_id==2) {
								$shop = "ヤフー";
							}elseif ($purchase->shop_id==3) {
								$shop = "楽天";
							}elseif ($purchase->shop_id==4) {
								$shop = "ヨーカドー";
							}
							?>
							<tr>
								<td><?= date('Y/m/d', strtotime($purchase->entry_date)) ?></td>
								<td><?= $shop  ?></td>
								<td><?= $purchase->product_name ?></td>
								<td align="right"><?= $purchase->item_sales_amount ?></td>
								<td align="right"><?= $purchase->shop_point ?></td>
								
							</tr>

							<?php
						}
						?>

					</tbody>
					
				</table>  
			</div>		   	
		</div>

		
	</div>
	<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$("#barcode").click(function(event) {
				$("#barcode").val('');
			});
			
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
			$('input#select_month_datepicker').datepicker({
				format: 'yyyy年mm月',
				viewMode: "months",
				minViewMode: "months",
				autoclose: true,
				todayHighlight: false,
				orientation: "auto",
			});


		});
	</script>
</body>
</html>
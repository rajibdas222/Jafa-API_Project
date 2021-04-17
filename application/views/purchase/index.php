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
				加盟店判別情報の作成
			</div>
			<div class="col-md-6" style="font-size: 28px;">
				
				<a href="points" class="btn btn-danger btn-lg float-right" id="" style="margin-right: 10px;"><i class="fa fa-user-plus"></i> 戻る</a>
				
			</div>
			<div class="col-md-12">
				<div class="float-left">
					<h4>Fee-Earnings reports from <span id="show_dateSetting">
						<?php echo date('1-m-Y') .' to '.date('m月末日'); ?>
					</span></h4>
				</div>
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
							<th nowrap="nowrap">ストア</th>
							<th width="25%">商品名</th>
							<th>ASIN (アマゾン) / Item Code (楽天) / Code (ヤフー)</th>
							<th nowrap="nowrap">トラッキングＩＤ</th>
							<th nowrap="nowrap">発送日</th>
							<th nowrap="nowrap">単価</th>
							<th nowrap="nowrap">数量</th>
							<th nowrap="nowrap">金額</th>
							<!-- <th nowrap="nowrap">紹介料率</th> -->
							<!-- <th nowrap="nowrap">日付・時間</th> -->
							<th nowrap="nowrap">紹介料率</th>
							<th nowrap="nowrap">紹介料</th>
						</tr>						
					</thead>
					<tbody id="">
						<?php
						// print_r($members);
						$i = 0;
						foreach ($member_purchase as $key => $purchase) {
							// print_r($purchase);
							// exit(); 
							$shop = "";
							if ($purchase->shop_id==1) {
								$shop = "アマゾン";
							}elseif ($purchase->shop_id==2) {
								$shop = "ヤフー";
							}elseif ($purchase->shop_id==3) {
								$shop = "楽天";
							}elseif ($purchase->shop_id==4) {
								$shop = "ヨーカドー";
							}else{
								$shop = "";
							}
							$user_id = $purchase->user_id;
							if ($user_id == '0') {
								$user_id = 32;
							}
							$tracking_code = $purchase->tracking_no.'-22';
							// $tracking_no_len = strlen($purchase->tracking_no);
							// if ($tracking_no_len<15) {
							// 	$this->db->where('id', $purchase->company_id);
							// 	$parent_info = $this->db->get('a3m_account')->row();

							// 	$customer_code = sprintf('%010d', $customer_info->id);
							// 	$parent_code = $parent_info->tracking_id;

							// 	if (empty($parent_info->tracking_id)) {
							// 		$parent_code = sprintf('%05d', $customer_info->parent_id);
							// 	}
								
							// 	$tracking_code = $parent_code.$customer_code;
							// }else{
								
							// }
							
							// if (empty($customer_info->parent_id)) {
							// 	$parent_code = sprintf('%05d', 32);
								
							// }
							// if (empty($customer_info->tracking_id)) {
							// 	$customer_code = $customer_info->tracking_id;
							// }
							$i++;
							$affiliate_rate = empty($purchase->affiliate_rate)? 0:$purchase->affiliate_rate;
							?>
							<tr>
								<td><?= $shop ?></td>
								<td>
									<?= $purchase->product_name?>
								</td>
								<td><?= $purchase->asin_no?></td>
								<td>

									<?= ($purchase->shop_id==1 && !empty($purchase->tracking_no))? $tracking_code:''; ?>
								</td>
								<td><?= date("Y-m-d", strtotime($purchase->entry_date)) ?></td>
								<td><?= $purchase->item_sales_amount ?></td>
								<td class="text-center"><?= (empty($purchase->qty))? 1: $purchase->qty; ?></td>
								<td><?= $purchase->item_sales_amount ?></td>
								<td class="text-center"><?= $affiliate_rate.'%' ?></td>
								<td><?= ($purchase->item_sales_amount*$affiliate_rate)/100 ?></td>
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
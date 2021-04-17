<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="web-fonts-with-css/css/fontawesome.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
	</style>
</head>
<body">
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">
			<div class="col-md-6" style="font-size: 32px;">
				ショップ別マージン計算書　一覧表
			</div>
			<div class="col-md-6" style="font-size: 28px;">
				<a href="compare" class="btn btn-warning btn-lg float-right">戻る</a>
				<a href="member_margine" class="btn btn-primary btn-lg float-right" style="margin-right: 10px;">会員別</a>
				<a href="shop_margine" class="btn btn-success btn-lg float-right" style="margin-right: 10px;">ショップ別</a>
				
			</div>
			<div class="col-md-12">
				<div class="float-right" style="font-size: 26px;">
					期間：<?php echo date('y年').date('m月'). date('1日').'～'.date('y年').date('m月'). date('d日'); ?>
				</div>
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				<table class="table table-bordered table-striped" style="font-size: 26px; border: 3px solid blue;">
					<thead>
						<tr>
							<th>ショップ</th>
							<th>金額</th>
							<th width="12%">ショップＰ</th>
							<th width="12%">チャリン<sup>２</sup></th>
							<th>合計</th>
							<th width="25%">備考</th>
						</tr>						
					</thead>
					<tbody>
						<tr>
							<td>Ａ ショップ</td>
							<td class="text-right">20,000</td>
							<td class="text-right"><input type="number" id="a_shop" name="a_shop" class="editable_field" value="500"></td>
							<td class="text-right"><input type="number" id="a_purcheger" name="a_purcheger" class="editable_field" value="600"></td>
							<td class="text-right" id="a_total_margin">1,100</td>
							<td></td>
						</tr>
						<tr>
							<td>Ｂ ショップ</td>
							<td class="text-right">10,000</td>
							<td class="text-right"><input type="number" id="b_shop" name="b_shop" class="editable_field" value="200"></td>
							<td class="text-right"><input type="number" id="b_purcheger" name="b_purcheger" class="editable_field" value="200"></td>
							<td class="text-right" id="b_total_margin">400</td>
							<td ></td>
						</tr>
						<tr>
							<td>Ｃ ショップ</td>
							<td class="text-right">10,000</td>
							<td class="text-right"><input type="number" id="c_shop" name="c_shop" class="editable_field" value="300"></td>
							<td class="text-right"><input type="number" id="c_purcheger" name="c_purcheger" class="editable_field" value="300"></td>
							<td class="text-right" id="c_total_margin">600</td>
							<td ></td>
						</tr>
					</tbody>
					<tfoot>
						<tr style="background-color: yellow;">
							<th>計</th>
							<th class="text-right">40,000</th>
							<th class="text-right" id="all_shop_total">1,000</th>
							<th class="text-right" id="all_purch_total">1,100</th>
							<th class="text-right" id="grand_total">2,100</th>
							
							<th></th>
						</tr>
					</tfoot>
				</table>  
			</div>		   	
		</div>		
	</div>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		jQuery(document).ready(function($) {
			$("#barcode").click(function(event) {
				$("#barcode").val('');
			});

			$(".editable_field").change(function(event) {
				event.preventDefault();
				var a_shop = $('#a_shop').val();
				var a_purcheger = $("#a_purcheger").val();
				var b_shop = $('#b_shop').val();
				var b_purcheger = $("#b_purcheger").val();
				var c_shop = $('#c_shop').val();
				var c_purcheger = $("#c_purcheger").val();

				var a_total_margin = parseInt(a_shop) +parseInt(a_purcheger);
				var b_total_margin = parseInt(b_shop) +parseInt(b_purcheger);
				var c_total_margin = parseInt(c_shop) +parseInt(c_purcheger);
				$("#a_total_margin").text(a_total_margin);
				$("#b_total_margin").text(b_total_margin);
				$("#c_total_margin").text(c_total_margin);
				$("#grand_total").text(a_total_margin+b_total_margin+c_total_margin);
				$("#all_shop_total").text(parseInt(a_shop)+parseInt(b_shop)+parseInt(c_shop));
				$("#all_purch_total").text(parseInt(a_purcheger)+parseInt(b_purcheger)+parseInt(c_purcheger));
			});
		});
	</script>
</body>
</html>
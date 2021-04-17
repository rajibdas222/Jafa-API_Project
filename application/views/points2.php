<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/dist/css/bootstrap.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css">
	<style type="text/css">
		table th{
			text-align: center;
		}
		.editable_field{
			border: 0;
			width: 100%;
		}
		input{
			background-color: transparent;
		}
		.table-condensed{
			width: 215px;
		}
		.table th, .table td {
		    padding: 2px 5px; 
		}
		.table-striped tbody tr:nth-of-type(odd) {
		    background-color: #CCFFFF;
		}
		.modal-backdrop {
		   background-color: transparent;
		}
		@media (min-width: 992px){
			.modal-lg {
			    max-width: 1000px;
			    /*position: fixed;*/
			    bottom: 0px;

			}
		}
		
	</style>
</head>
<body">
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">
			<div class="col-md-5" style="font-size: 32px;">
				<h2>総括表（ジャコス集計）</h2>
			</div>
			<div class="col-md-2">
				<h1>メイン画面</h1>
			</div>
			<div class="col-md-5" style="font-size: 28px;">
				<a href="compare" class="btn btn-warning btn-lg float-right">戻る</a>
				<a href="member_margine" class="btn btn-success btn-lg float-right" style="margin-right: 10px;">加盟企業別</a>
				<a href="shop_margine" class="btn btn-danger btn-lg float-right" style="margin-right: 10px;">ショップ別</a>
				<a href="shop_margine" class="btn btn-primary btn-lg float-right" style="margin-right: 10px;">会員別</a>
				
			</div>
			<!-- <div class="col-md-6">
				<h4>ポイント計算書　一覧表</h4>
				
			</div>
			<div class="col-md-3">
				<a href="#" class="btn btn-link" style="font-size: 24px;">→支払</a>
			</div>
			<div class="col-md-3">
				<div class="float-right" style="font-size: 26px;">
					
					<button  onclick="$('input#select_month_datepicker').focus()" style="background-color: #FFC000; border: 2px solid green;" class="btn btn-default btn-sm">期間</button>
					: <span id="show_dateSetting">
						<?php echo date('m月'). date('1日').'～'.date('m月末日'); ?>
					</span>

					<input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker">

				</div>
			</div> -->
			<div class="col-md-12" style="margin-top: 20px;">
				<table class="table table-bordered table-striped" style="font-size: 26px; border: 3px solid blue;">
					<thead class="thead-default">
						<tr>
							<th colspan="3">
								<h4 style="text-align: left;">ポイント計算書　一覧表</h4>
							</th>
							<th colspan="2" style="text-align: left;border-left: 6px double black; border-right: 0;">
								<a href="#" class="btn btn-link" style="font-size: 24px; text-align: left;">→支払</a>
							</th>
							<th colspan="2" style="border-left: 0;padding-top: 0">
								<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
									
									<button  onclick="$('input#select_month_datepicker').focus()" style="background-color: #FFC000; border: 2px solid green;" class="btn btn-default btn-sm">期間</button>
									: <span id="show_dateSetting">
										<?php echo date('m月'). date('1日').'～'.date('m月末日'); ?>
									</span>

									<input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker">

								</div>
							</th>
						</tr>
						<tr>
							<th width="20%">加盟企業</th>
							<!-- <th>金額</th> -->
							<th width="15%">商品売上金額	</th>
							<!-- <th>ショップＰ （a）</th> -->
							<th width="15%" style="border-right: 6px double black">チャリン<sup>２</sup></th>
							<!-- <th>合計 (a+b)</th> -->
							<th>加盟企業 (25%)</th>
							<th>会員計 (50%)</th>
							<th style="border-right: 6px double black" >支払計 (75%)</th>
							<th>当社粗利 (25%)</th>
						</tr>						
					</thead>
					<tbody id="">
						<?php

						if (!empty($member_companies)) :
						$total_member = count($member_companies);
						$i = 0;
						foreach ($member_companies as $key => $member_company):
						$i++;
						?>
						<tr>
							<td>
								<input width="25%" style="border:0; width: 100%; text-align: left;" type="text" id="a_purcheger" name="a_purcheger" class="editable_field member_name_<?= $member_company->member_com_id ?>" data-attr-member-field_name="member_name" data-attr-member-id="<?= $member_company->member_com_id ?>" value="<?= $member_company->member_name ?>"></td>
							
							<td class="text-right"><input type="number" id="a_purcheger" data-attr-member-id="<?= $member_company->member_com_id ?>" data-attr-member-field_name="item_sales_amount" name="a_purcheger" class="text-right editable_field member_total_amount_<?= $member_company->member_com_id ?>" value="<?= $member_company->item_sales_amount ?>"></td>
							<td style="border-right: 6px double black" class="text-right"><input type="number" data-attr-member-id="<?= $member_company->member_com_id ?>" data-attr-member-field_name="chalin_two" id="a_purcheger" name="a_purcheger" class="text-right editable_field member_chalin_two_<?= $member_company->member_com_id ?>" value="<?= $member_company->chalin_two ?>"></td>
							<td class="text-right"><?= ($member_company->chalin_two*25)/100 ?> </td>
							<td class="text-right"><?= ($member_company->chalin_two*50)/100 ?></td>
							<td style="border-right: 6px double black" class="text-right"><?= ($member_company->chalin_two*75)/100 ?></td>
							<td class="text-right"><?= ($member_company->chalin_two*25)/100 ?></td>
						</tr>						
						
						<?php
						endforeach;
						$alst_row = 4-$i;
						if ($alst_row>0):
							for ($x=0; $x <= $alst_row; $x++) :
								?>
								<tr>
									<td><input width="25%" style="border:0;" type="text" id="a_purcheger" name="a_purcheger" class="text-left editable_field member_name_" value=""></td>
									<td style="" class="text-right"><input type="number" id="a_purcheger" name="a_purcheger" class="text-right editable_field member_total_amount_" value=""></td>
									<td style="border-right: 6px double black" class="text-right"><input type="number" id="a_purcheger" name="a_purcheger" class="text-right editable_field member_chalin_two_" value=""></td>

									<td class="text-right"></td>
									<td class="text-right"></td>
									<td style="border-right: 6px double black" class="text-right"></td>
									<td class="text-right"></td>
								</tr>
								<?php
							endfor;
						endif;
						?>

						<tr>
							<td>&nbsp </td>
							<td class="text-right"></td>
							<td style="border-right: 6px double black" class="text-right" id="c_total_margin"></td>
							<td class="text-right text-primary">0%</td>
							<td class="text-right text-primary">50%</td>
							<td style="border-right: 6px double black" class="text-right"></td>
							<td class="text-right text-primary">50%</td>
						</tr>
						<tr>
							<td class=" text-primary">ジャコス</td>
							<td class="text-right text-primary">10,000</td>
							<!-- <td class="text-right text-primary">300</td> -->
							<td style="border-right: 6px double black" class="text-right text-primary">500</td>
							<!-- <td class="text-right text-primary">700</td> -->
							<td class="text-right text-primary">0</td>
							<td class="text-right text-primary">250</td>
							<td style="border-right: 6px double black" class="text-right">250</td>
							<td class="text-right text-primary">250000</td>
						</tr>
						<?php
						else:;	
							for ($xx=0; $xx <10 ; $xx++) :?>
								<tr>
									<td><input width="25%" style="border:0;" type="text" id="a_purcheger" name="a_purcheger" class="text-left editable_field member_name_" value=""></td>
									<td style="" class="text-right"><input type="number" id="a_purcheger" name="a_purcheger" class="text-right editable_field member_total_amount_" value=""></td>
									<td style="border-right: 6px double black" class="text-right"><input type="number" id="a_purcheger" name="a_purcheger" class="text-right editable_field member_chalin_two_" value=""></td>

									<td class="text-right"></td>
									<td class="text-right"></td>
									<td style="border-right: 6px double black" class="text-right"></td>
									<td class="text-right"></td>
								</tr>
								<?php
							endfor;
						?>						
						
						
						<tr>
							<td>&nbsp</td>
							<td class="text-right"></td>
							<td style="border-right: 6px double black" class="text-right" id="c_total_margin"></td>
							<td class="text-right text-primary">0%</td>
							<td class="text-right text-primary">50%</td>
							<td style="border-right: 6px double black" class="text-right"></td>
							<td class="text-right text-primary">50%</td>
						</tr>
						<tr>
							<td class=" text-primary">ジャコス</td>
							<td class="text-right text-primary">10,000</td>
							<!-- <td class="text-right text-primary">300</td> -->
							<td style="border-right: 6px double black" class="text-right text-primary">500</td>
							<!-- <td class="text-right text-primary">700</td> -->
							<td class="text-right text-primary">0</td>
							<td class="text-right text-primary">250</td>
							<td style="border-right: 6px double black" class="text-right">250</td>
							<td class="text-right text-primary">250</td>
						</tr>
						<?php
						endif;
						?>
					</tbody>
				</table>  
			</div>		   	
		</div>

		<!-- Card Stared -->
		<div class="card col-md-5 col-sm-12" id="product_case_message" style="background-color: #DAEEF3; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 500px;
right: 10px;
bottom: 10px;
padding: 4px;">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<p style="font-size: 20px;">１、全体の売上と支払いの計算をしています。　
						</p>
						<p style="font-size: 20px;">
						２、「期間」を押すと、期間設定ができます。　
						</p>
						<p style="font-size: 20px;">
						３、加盟企業を押すと、明細が見られます。　
						</p>	
						<button id="close_case_message" style="margin: 0px 200px; background-color: #FFFF99; border: 2px solid green" id="coo" class="btn btn-default btn-lg">確認</button>

					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Card Ended  -->
		
	</div>
	<input type="hidden" id="base_url" value="<?= base_url() ?>" name="">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script>

		
		jQuery(document).ready(function($) {
			$("#barcode").click(function(event) {
				$("#barcode").val('');
			});
			function addCommas(nStr)
			{
			    nStr += '';
			    x = nStr.split('.');
			    x1 = x[0];
			    x2 = x.length > 1 ? '.' + x[1] : '';
			    var rgx = /(\d+)(\d{3})/;
			    while (rgx.test(x1)) {
			        x1 = x1.replace(rgx, '$1' + ',' + '$2');
			    }
			    return x1 + x2;
			}

			// comma input
			$(document).on("keyup","input.comma", function(){
			  // skip for arrow keys
			  if(event.which >= 37 && event.which <= 40) return;
			  // format number
			  $(this).val(function(index, value) {
				return value
				.replace(/\D/g, "")
				.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
				;
			  });
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

			$("#select_month_datepicker").change(function(event) {
				var fuldate = $(this).val();
				var yearRes = fuldate.split("年");
				var monthRes = yearRes[1].split("月");
				$("#show_dateSetting").text(monthRes[0]+'月1日～'+monthRes[0]+'月末日');
				
			});

			$(document).delegate('.editable_field', 'change', function(event) {
				event.preventDefault();
				var base_url = $("#base_url").val();
				var member_com_id = $(this).attr('data-attr-member-id');
				
				if (member_com_id !=='') {
					
					// var member_name_field = $(this).attr('data-attr-member-field_name');
					var member_name = $(".member_name_"+member_com_id).val();
					var item_sales_amount = $(".member_total_amount_"+member_com_id).val().replace(/,/g , "");
					var chalin_two = $(".member_chalin_two_"+member_com_id).val().replace(/,/g , "");
					if (member_com_id!="" && item_sales_amount !="" && chalin_two !="") {
						$.ajax({
							url: base_url+'main_controller/save_points',
							type: 'POST',
							data: {member_com_id:member_com_id, item_sales_amount:item_sales_amount, chalin_two: chalin_two},
						})
						.done(function(data) {
							// console.log(data);
							get_all_member_company()
							console.log("success");
						})
						.fail(function() {
							console.log("error");
						})
						.always(function() {
							console.log("complete");
						});
					}
				}else{
					var member_name = $(".member_name_").val();
					var item_sales_amount = $(".member_total_amount_").val().replace(/,/g , "");
					var chalin_two = $(".member_chalin_two_").val().replace(/,/g , "");
					if (member_name!="" && item_sales_amount !="" && chalin_two !="") {
						$.ajax({
							url: base_url+'main_controller/save_points',
							type: 'POST',
							data: {member_name: member_name, item_sales_amount:item_sales_amount, chalin_two: chalin_two},
						})
						.done(function(data) {

							get_all_member_company()
							console.log("success");
						})
						.fail(function() {
							console.log("error");
						})
						.always(function() {
							console.log("complete");
						});
					}
				}
			});

			function get_all_member_company() {
				var base_url = $("#base_url").val();
				$.get(base_url+'main_controller/get_company', function(data) {
					var response = JSON.parse(data);
					console.log(response);
					return false;
					var tableHtml = '';
					if (response.length>0) {
						var total_sales_amount = 0;
						var total_charin = 0;
						var total_25 = 0;
						var total_50 = 0;
						var total_75 = 0;

						for (var i = 0; i < response.length; i++) {
							
							if (response[i].member_com_id!=4) {
								total_sales_amount +=parseInt(response[i].item_sales_amount);
								total_charin += parseInt(response[i].chalin_two);
								total_25 += ((parseInt(response[i].chalin_two)*25)/100);
								total_50 += (response[i].chalin_two*50)/100;
								total_75 += (response[i].chalin_two*75)/100;
								tableHtml += '<tr>';
								
								tableHtml += '<td><a data-toggle="modal" data-target=".member_accounts_detail" style="text-decoration: underline;" href="#">'+response[i].member_name+'</a></td>';

								tableHtml += '<td class="text-right"><input type="text" id="a_purcheger" data-attr-member-id="'+response[i].member_com_id+'" data-attr-member-field_name="item_sales_amount" name="a_purcheger" class="text-right editable_field comma member_total_amount_'+response[i].member_com_id+'" value="'+addCommas(response[i].item_sales_amount)+'"></td>';

								tableHtml += '<td style="border-right: 6px double black" class="text-right"><input type="text" data-attr-member-id="'+response[i].member_com_id+'" data-attr-member-field_name="chalin_two" id="a_purcheger" name="a_purcheger" class="text-right editable_field comma member_chalin_two_'+response[i].member_com_id+'" value="'+addCommas(response[i].chalin_two)+'"></td>';

								tableHtml += '<td class="text-right">'+((response[i].chalin_two*25)/100).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+((response[i].chalin_two*50)/100).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+((response[i].chalin_two*75)/100).toLocaleString('en')+'</td>';
								tableHtml += '<td style="border-left: 6px double black" class="text-right">'+((response[i].chalin_two*25)/100).toLocaleString('en')+'</td>';
								tableHtml += '</tr>';
							}							
						}
						tableHtml += '<tr>';
						// console.log(response[i].member_com_id);
						tableHtml += '<td><input width="25%" style="border:0; width: 100%; text-align: left;" type="text" id="a_purcheger" name="a_purcheger" class=" member_name_" data-attr-member-field_name="member_name" data-attr-member-id="" value=""></td>';

						tableHtml += '<td class="text-right"><input type="text" id="a_purcheger" data-attr-member-id="" data-attr-member-field_name="item_sales_amount" name="a_purcheger" class="text-right comma editable_field member_total_amount_" value=""></td>';

						tableHtml += '<td style="border-right: 6px double black" class="text-right"><input type="number" data-attr-member-id="" data-attr-member-field_name="chalin_two" id="a_purcheger" name="a_purcheger" class="text-right editable_field comma member_chalin_two_" value=""></td>';

						tableHtml += '<td class="text-right"></td>';
						tableHtml += '<td class="text-right"></td>';
						tableHtml += '<td class="text-right"></td>';
						tableHtml += '<td style="border-left: 6px double black" class="text-right"></td>';
						tableHtml += '</tr>';

						tableHtml += '<tr>';
							tableHtml += '<td>&nbsp</td>';
							tableHtml += '<td class="text-right"></td>';
							tableHtml += '<td style="border-right: 6px double black" class="text-right" id="c_total_margin"></td>';
							tableHtml += '<td class="text-right text-primary">0%</td>';
							tableHtml += '<td class="text-right text-primary">50%</td>';
							tableHtml += '<td style="border-right: 6px double black" class="text-right"></td>';
							tableHtml += '<td class="text-right text-primary">50%</td>';
						tableHtml += '</tr>';
						total_sales_amount += parseInt(response[3].item_sales_amount);
						total_charin += parseInt(response[3].chalin_two);
						var jacos_count = ((response[3].chalin_two*50)/100);
						total_50 += jacos_count;
						total_75 += jacos_count;

						var total_25_jacos50 = (total_25+jacos_count);
						tableHtml += '<tr>';
							tableHtml +='<td class=" text-primary">'+response[3].member_name+'</td>';
							tableHtml += '<td class="text-right"><input type="text" id="a_purcheger" data-attr-member-id="'+response[3].member_com_id+'" data-attr-member-field_name="item_sales_amount" name="a_purcheger" class="text-right editable_field comma member_total_amount_'+response[3].member_com_id+'" value="'+addCommas(response[3].item_sales_amount)+'"></td>';
							tableHtml += '<td style="border-right: 6px double black" class="text-right"><input type="text" data-attr-member-id="'+response[3].member_com_id+'" data-attr-member-field_name="chalin_two" id="a_purcheger" name="a_purcheger" class="text-right editable_field comma editable_field member_chalin_two_'+response[3].member_com_id+'" value="'+addCommas(response[3].chalin_two)+'"></td>';
							tableHtml +='<td class="text-right text-primary">0</td>';
							tableHtml += '<td class="text-right text-primary">'+((response[3].chalin_two*50)/100).toLocaleString('en')+'</td>';
							tableHtml +='<td style="border-right: 6px double black" class="text-right text-primary">'+((response[3].chalin_two*50)/100).toLocaleString('en')+'</td>';
							tableHtml += '<td class="text-right text-primary">'+((response[3].chalin_two*50)/100).toLocaleString('en')+'</td>';
						tableHtml += '</tr>';
						tableHtml += '<tr style="background-color: yellow;"><th>計</th><th class="text-right">'+total_sales_amount.toLocaleString('en')+'</th>	<th style="border-right: 6px double black" class="text-right" id="all_purch_total">'+total_charin.toLocaleString('en')+'</th><th class="text-right">'+total_25.toLocaleString('en')+'</th><th class="text-right">'+total_50.toLocaleString('en')+'</th><th style="border-right: 6px double black" class="text-right">'+total_75.toLocaleString('en')+'</th><th class="text-right">'+total_25_jacos50.toLocaleString('en')+'</th>						</tr>';
						
						$( "#member_company_list" ).html( tableHtml );
					}
					
				});
			}

			
			get_all_member_company()

			$(document).mouseup(function (e){
				var hide_enter_outside = $("#product_case_message");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');
				}
			});

			$("#close_case_message").click(function(event) {
				event.preventDefault();
				$("#product_case_message").removeClass('d-block').addClass('d-none'); 
			});
		});
	</script>

	<div class="modal fade member_accounts_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content"  style="background: #FFFF99; min-height: 600px; ">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">明細画面。。。</h5>
				<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
				戻る
				</button>
			</div>
			<div class="modal-body">
				明細画面。。。
			</div>
	    </div>
	  </div>
	</div>
</body>
</html>
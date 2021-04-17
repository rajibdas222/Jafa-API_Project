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
			padding: 3px;
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
		.member_accounts_detail {
		  	position: fixed;
		  	/*left: auto; */
		  	right: 0px !important;
		 	bottom: 0;
		  	top: auto;
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
			<div class="col-md-4" style="font-size: 32px;">
				<h3>総括表（ジャコス集計）メイン画面</h3>
			</div>
			<div class="col-md-8" style="font-size: 28px;">
				<a href="<?= base_url() ?>" class="btn btn-warning btn-lg float-right">戻る</a>
				
				<button type="button" class="btn btn-primary btn-lg float-right" data-toggle="modal" data-target="#size_unit" style="margin-right: 10px;">単位</button>
				<a href="setting_point_sharing" class="btn btn-secondary btn-lg float-right" style="margin-right: 10px;"><i class="fa fa-cog"></i> 設定点</a>
				<a href="kamitein_list" class="btn btn-info btn-lg float-right" style="margin-right: 10px;">加盟店REFARAL</a>
				<a href="admin_company_point" class="btn btn-info btn-lg float-right" style="margin-right: 10px;">加盟機関による</a>
				<a href="upload_referal_fee" class="btn btn-info btn-lg float-right" style="margin-right: 10px; ">紹介料をアップロード</a>
				
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
					
					<thead>
						<tr>
							<th colspan="5">
								<h4 style="text-align: left;">ポイント計算書　一覧表</h4>
							</th>
							<th style="text-align: left;border-left: 6px double black; border-right: 0;">
								<a href="#" class="btn btn-link" style="font-size: 24px; text-align: left;">→支払</a>
							</th>
							<th colspan="7" style="border-left: 0;padding-top: 0">
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
							<th width="10%" style="vertical-align: middle;" rowspan="2">加盟企業</th>
							<th colspan="2" style="vertical-align: middle;">商品売上金額</th>
							<th colspan="2" style="border-right: 6px double black; vertical-align: middle;">チャリン<sup>２</sup></th>
							<th colspan="2">加盟企業 - 手数料</th>
							<th colspan="2">会員計</th>
							<th colspan="2" style="border-right: 6px double black;">支払計</th>
							<th colspan="2">当社粗利</th>							
						</tr>
						<tr>
							<th class="text-warning"> Temp</th>
							<th class="text-success"> Per</th>
							<th class="text-warning"> Temp</th>
							<th class="text-success" style="border-right: 6px double black; vertical-align: middle;"> Per</th>
							<th class="text-warning" > Temp</th>
							<th class="text-success"> Per</th>
							<th class="text-warning"> Temp</th>
							<th class="text-success"> Per</th>
							<th class="text-warning"> Temp</th>
							<th class="text-success" style="border-right: 6px double black; vertical-align: middle;"> Per</th>
							<th class="text-warning"> Temp</th>
							<th class="text-success"> Per</th>
						</tr>
												
					</thead>
					<tbody id="">
						<th colspan="13">
							<img src="<?= base_url() ?>resource/img/ajax/ajax-loader.gif">
						</th>
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
		<div class="modal fade member_accounts_detail" id="member_accounts_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content"  style="background: #FFFF99; min-height: 600px; width: 1250px;">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">明細画面。。。</h5>
					<button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">
					戻る
					</button>
				</div>
				<div class="modal-body">
					<!-- 明細画面。。。 -->
					<div class="table-responsive" style="max-height: 500px !important; overflow: auto;">
					  <table class="table table-bordered" id="company_member_details" style="background-color: white;">
					  	<tr>
					  		<th colspan="6">
					  			<img src="<?= base_url() ?>resource/img/ajax/ajax-loader.gif">
					  		</th>
					  	</tr>
					  </table>
					</div>
					
				</div>
		    </div>
		  </div>
		</div>
		<!-- Modal -->

		<!-- Modal -->
		<div class="modal fade" id="size_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 60px;">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <!-- <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">戻る</span>
		        </button>
		      </div> -->
		      <div class="modal-body">
				<div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">単位一覧</a>
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">追加</a>
					
				</div>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" style="max-height: 300px; overflow: auto; ">
						<table class="table table-bordered">
							<thead>
								<tr class="bg-primary">
									<th>#</th>
									<td>単位</td>
								</tr>
							</thead>
							<tbody id="product_size_list" style="">
								
							</tbody>
						</table>
					</div>
					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
						<form class="form-horizontal">
							<fieldset>
								<!-- Text input-->
								<div class="form-group" style="padding: 0;">
									<label class="control-label" for="textinput">単位</label>  
									<!-- <div class="col-md-9"> -->
										<input id="unit_name" name="unit_name" type="text" placeholder="" class="form-control input-md">
										<span class="help-block"></span>  
									<!-- </div> -->
								</div>
								<button type="button" class="btn btn-primary" id="save_unit">保存</button>

							</fieldset>
						</form>
					</div>
					
				</div>
				
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
		        
		      </div>
		    </div>
		  </div>
		</div>
    </div>
	<input type="hidden" id="base_url" value="<?= base_url() ?>" name="">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	

	
	<script>

		
		jQuery(document).ready(function($) {
			$("#barcode").click(function(event) {
				$("#barcode").val('');
			});

			$("#save_unit").click(function(event) {
				event.preventDefault();

				var base_url = $("#base_url").val();
				var unit_name = $("#unit_name").val();
				$.ajax({
					url: base_url+'main_controller/save_product_size_unit',
					type: 'POST',
					data: {unit_name: unit_name}
				})
				.done(function(response) {
					var resData = JSON.parse(response);
					if (resData.success == 1) {
						get_product_unit_size()
						$("#unit_name").val('');
						console.log("success");
						console.log(resData);
					} else {
						$("#unit_name").val('');
						console.log("success");
						console.log(resData);
					}
					
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
			get_product_unit_size()
			function get_product_unit_size() {
				var base_url = $("#base_url").val();
				$.get(base_url+'main_controller/get_product_size', function(data) {
					var resData = JSON.parse(data);
					var htmlData = "";
					for (var i = 0; i < resData.length; i++) {
						htmlData += "<tr>";
							htmlData += "<td>"+(i+1)+"</td>";
							htmlData += "<td>"+resData[i].unit_name+"</td>";
						htmlData += "<tr>";
					}
					$("#product_size_list").html(htmlData);					
				});
				
			}


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

			function get_all_member_company() {
				var base_url = $("#base_url").val();
				$.get(base_url+'main_controller/new_get_company_summary', function(data) {
					
					var response = JSON.parse(data);
					console.log(response)
					// return false;
					var tableHtml = '';
					if (response.company_summary.length>0) {
						// Temporary
						var total_temp_order_amount = 0;
						var total_temp_point_amount = 0;
						var total_temp_company = 0;
						var total_temp_member = 0;
						var total_temp_jafa = 0;
						// Permanent
						var total_per_order_amount = 0;
						var total_per_point_amount = 0;
						var total_per_company = 0;
						var total_per_member = 0;
						var total_per_jafa = 0;
						for (var i = 0; i < response.company_summary.length; i++) {
							// Temporary Total
							total_temp_order_amount += parseInt(response.company_summary[i].temp_order_amount);
							total_temp_point_amount += parseInt(response.company_summary[i].temp_point_amount);
							total_temp_company += parseInt(response.company_summary[i].temp_company_point);
							total_temp_member += parseInt(response.company_summary[i].temp_user_point);
							total_temp_jafa += parseInt(response.company_summary[i].temp_jafa_point);
							// Permanent Total
							total_per_order_amount += parseInt(response.company_summary[i].per_order_amount);
							total_per_point_amount += parseInt(response.company_summary[i].per_point_amount);
							total_per_company += parseInt(response.company_summary[i].per_company_point);
							total_per_member += parseInt(response.company_summary[i].per_user_point);
							total_per_jafa += parseInt(response.company_summary[i].per_jafa_point);
							
							// var total_company = (parseInt(response[i].company_point)+parseInt(response[i].user_point));
							if (response.company_summary[i].major_company == 0) {
								

								tableHtml += '<tr>';
								
								tableHtml += '<td><a class="company_member_list"  style="text-decoration: underline;" href="'+response.company_summary[i].user_id+'">'+response.company_summary[i].company_name+'</a></td>';

								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].temp_order_amount))+'</td>'
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].per_order_amount))+'</td>'
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].temp_point_amount))+'</td>'
								tableHtml += '<td  style="border-right: 6px double black"  class="text-right">'+addCommas(parseInt(response.company_summary[i].per_point_amount))+'</td>'
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].temp_company_point))+'</td>';
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].per_company_point))+'</td>';
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].temp_user_point))+'</td>';
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].per_user_point))+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor((parseInt(response.company_summary[i].temp_company_point)+parseInt(response.company_summary[i].temp_user_point))).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor((parseInt(response.company_summary[i].per_company_point)+parseInt(response.company_summary[i].per_user_point))).toLocaleString('en')+'</td>';
								tableHtml += '<td style="border-left: 6px double black"  class="text-right">'+Math.floor(parseInt(response.company_summary[i].temp_jafa_point)).toLocaleString('en')+'</td>';
								
								tableHtml += '<td class="text-right">'+Math.floor(parseInt(response.company_summary[i].per_jafa_point))+'</td>';
								tableHtml += '</tr>';
							}else{								

								tableHtml += '<tr class="bg-primary text-light">';
								
								tableHtml += '<td><a class="company_member_list"  style="text-decoration: underline; color: white;" href="'+response.company_summary[i].user_id+'">'+response.company_summary[i].company_name+'</a></td>';
								
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].temp_order_amount))+'</td>'
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].per_order_amount))+'</td>'
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].temp_point_amount))+'</td>';
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].per_point_amount))+'</td>';
								tableHtml += '<td style="border-left: 6px double black"  class="text-right">'+Math.floor(parseInt(response.company_summary[i].temp_company_point)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor(parseInt(response.company_summary[i].per_company_point)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor(parseInt(response.company_summary[i].temp_user_point)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor(parseInt(response.company_summary[i].per_user_point)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor((parseInt(response.company_summary[i].temp_company_point)+parseInt(response.company_summary[i].temp_user_point))).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor((parseInt(response.company_summary[i].per_company_point)+parseInt(response.company_summary[i].per_user_point))).toLocaleString('en')+'</td>';
								tableHtml += '<td style="border-left: 6px double black"  class="text-right">'+Math.floor(parseInt(response.company_summary[i].temp_jafa_point))+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor(parseInt(response.company_summary[i].per_jafa_point))+'</td>';
								tableHtml += '</tr>';
							}						
						}

						// for Unknown Tracking ID
						if (response.unknown_per.company_point != null || response.unknown_per.unknown_temp != null) {

							var un_temp_order_amount = response.unknown_temp.order_amount == null? 0:parseInt(response.unknown_temp.order_amount);
							var un_perm_order_amount = response.unknown_per.order_amount == null? 0:parseInt(response.unknown_per.order_amount);
							var un_temp_point_amount = response.unknown_temp.point_amount == null? 0:parseInt(response.unknown_temp.point_amount);
							var un_perm_point_amount = response.unknown_per.point_amount == null? 0:parseInt(response.unknown_per.point_amount);
							var un_temp_company_point = response.unknown_temp.company_point == null? 0:parseInt(response.unknown_temp.company_point);
							var un_perm_company_point = response.unknown_per.company_point == null? 0:parseInt(response.unknown_per.company_point);
							var un_temp_user_point = response.unknown_temp.user_point == null? 0:parseInt(response.unknown_temp.user_point);
							var un_perm_user_point = response.unknown_per.user_point == null? 0:parseInt(response.unknown_per.user_point);

							var un_temp_jafa_point = response.unknown_temp.jafa_point == null? 0:parseInt(response.unknown_temp.jafa_point);
							var un_perm_jafa_point = response.unknown_per.jafa_point == null? 0:parseInt(response.unknown_per.jafa_point);

							// Temporary Total
							total_temp_order_amount += un_temp_order_amount;
							total_temp_point_amount += un_temp_point_amount;
							total_temp_company += un_temp_company_point;
							total_temp_member += un_temp_user_point;
							total_temp_jafa += un_temp_jafa_point;
							// Permanent Total
							total_per_order_amount += un_perm_order_amount;
							total_per_point_amount += un_perm_point_amount;
							total_per_company += un_perm_company_point;
							total_per_member += un_perm_user_point;
							total_per_jafa += un_perm_jafa_point;


							tableHtml += '<tr>';
							
							tableHtml += '<td><a class="member_purchase_list" style="text-decoration: underline;" href="'+base_url+'purchase_list/unknown">道の</a></td>';

							tableHtml += '<td class="text-right">'+addCommas(un_temp_order_amount)+'</td>'
							tableHtml += '<td class="text-right">'+addCommas(un_perm_order_amount)+'</td>'
							tableHtml += '<td class="text-right">'+addCommas(un_temp_point_amount)+'</td>'
							tableHtml += '<td  style="border-right: 6px double black"  class="text-right">'+addCommas(un_perm_point_amount)+'</td>'
							tableHtml += '<td class="text-right">'+addCommas(un_temp_company_point)+'</td>';
							tableHtml += '<td class="text-right">'+addCommas(un_perm_company_point)+'</td>';
							tableHtml += '<td class="text-right">'+addCommas(un_temp_user_point)+'</td>';
							tableHtml += '<td class="text-right">'+addCommas(un_perm_user_point)+'</td>';
							tableHtml += '<td class="text-right">'+Math.floor((un_temp_company_point+un_temp_user_point).toLocaleString('en'))+'</td>';
							tableHtml += '<td class="text-right">'+Math.floor((un_perm_user_point+un_perm_company_point))+'</td>';
							tableHtml += '<td style="border-left: 6px double black"  class="text-right">'+un_temp_jafa_point.toLocaleString('en')+'</td>';
							
							tableHtml += '<td class="text-right">'+un_perm_jafa_point.toLocaleString('en')+'</td>';
							tableHtml += '</tr>';
						}
						
						// for Unknown Tracking ID
						
						tableHtml += '<tr style="background-color: yellow;"><th>計</th><th class="text-right">'+total_temp_order_amount.toLocaleString('en')+'</th>	<th  class="text-right" id="all_purch_total">'+total_per_order_amount.toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_point_amount).toLocaleString('en')+'</th>';
						tableHtml += '<th style="border-right: 6px double black" class="text-right">'+Math.floor(total_per_point_amount).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_company).toLocaleString('en')+'</th>';					
						tableHtml += '<th class="text-right">'+Math.floor(total_per_company).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_member).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+Math.floor(total_per_member).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_member+total_temp_company).toLocaleString('en')+'</th>';	
						tableHtml += '<th style="border-right: 6px double black" class="text-right">'+Math.floor(total_per_member+total_per_company).toLocaleString('en')+'</th>';	
						
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_jafa).toLocaleString('en')+'</th>';
						
						tableHtml += '<th class="text-right">'+Math.floor(total_per_jafa).toLocaleString('en')+'</th>';
						tableHtml += '</tr>';
						
						$( "#" ).html( tableHtml );
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

			$(document).on("click",".company_member_list",function(event) {
				event.preventDefault()
				var user_id = $(this).attr('href');
				var company_name = $(this).text();

				var base_url = $("#base_url").val();
				$('#member_accounts_detail').modal();
				$.ajax({
					url: base_url+'main_controller/get_company_member',
					type: 'POST',
					data: {user_id: user_id},
				})
				.done(function(data) {
					// console.log(data);
					// return false;
					var response = JSON.parse(data);
					console.log(response);	

					var htmlData = "";
					if (response.members.length>0) {
						htmlData += '<thead>';
						htmlData += '<tr>';
							htmlData += '<th width="5%">加盟企業</th>';
							htmlData += '<th>会員</th>';
							htmlData += '<th colspan="2">商品売上金額</th>';
							htmlData += '<th colspan="2" style="border-right: 6px double black">チャリン<sup>２</sup></th>';
							htmlData += '<th colspan="2">加盟企業</th>';
							htmlData += '<th colspan="2">会員計</th>';
							htmlData += '<th colspan="2" style="border-right: 6px double black">支払計</th>';
							htmlData += '<th colspan="2">当社粗利</th>';
						htmlData += '</tr>';
						htmlData += '</thead>';
						htmlData += '<tbody>';
						htmlData += '<tr>'
							htmlData += '<td style="vertical-align: middle; text-align: center;" width="10%" rowspan="'+(response.members.length+1)+'">'+response.company_details.fullname+'</td>'
						htmlData += '</tr>'
						// Temporary
						var total_temp_order_amount = 0;
						var total_temp_point_amount = 0;
						var total_temp_company = 0;
						var total_temp_member = 0;
						var total_temp_jafa = 0;
						// Permanent
						var total_per_order_amount = 0;
						var total_per_point_amount = 0;
						var total_per_company = 0;
						var total_per_member = 0;
						var total_per_jafa = 0;

						for (var i = 0; i< response.members.length; i++) {
							// Temporary Points
							var temp_order_amount = response.members[i].temp.order_amount == null? 0:response.members[i].temp.order_amount;
							var temp_point_amount = response.members[i].temp.point_amount== null? 0:response.members[i].temp.point_amount;
							var temp_company_point = response.members[i].temp.company_point== null? 0: Math.floor(response.members[i].temp.company_point);
							var temp_member_point = response.members[i].temp.user_point== null? 0: Math.floor(response.members[i].temp.user_point);
							var temp_jafa_point = response.members[i].temp.jafa_point== null? 0:Math.floor(response.members[i].temp.jafa_point);

							// Permanent Points
							var perm_order_amount = response.members[i].perm.order_amount == null? 0:response.members[i].perm.order_amount;
							var perm_point_amount = response.members[i].perm.point_amount == null? 0:response.members[i].perm.point_amount;
							var perm_company_point = response.members[i].perm.company_point == null? 0:Math.floor(response.members[i].perm.company_point);
							var perm_member_point = response.members[i].perm.user_point == null? 0:Math.floor( response.members[i].perm.user_point);
							var perm_jafa_point = response.members[i].perm.jafa_point == null? 0: Math.floor( response.members[i].perm.jafa_point);


							
							var temp_com_total = parseInt(temp_company_point)+parseInt(temp_member_point);
							var perm_com_total = parseInt(perm_company_point)+parseInt(perm_member_point);

							// Temporary
							total_temp_order_amount += parseInt(temp_order_amount);
							total_temp_point_amount += parseInt(temp_point_amount);
							total_temp_company += parseInt(temp_company_point);
							total_temp_member += parseInt(temp_member_point);
							total_temp_jafa += parseInt(temp_jafa_point);
							// Permanent
							total_per_order_amount += parseInt(perm_order_amount);
							total_per_point_amount += parseInt(perm_point_amount);
							total_per_company += parseInt(perm_company_point);
							total_per_member += parseInt(perm_member_point);
							total_per_jafa += parseInt(perm_jafa_point);


							htmlData += '<tr>';
								htmlData += '<td><a class="member_purchase_list" href="'+base_url+'purchase_list/'+response.members[i].user_id+'">'+response.members[i].fullname+'</a></td>';
								htmlData += '<td class="bg-warning" style="text-align: right;">'+parseInt(temp_order_amount).toLocaleString('en')+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right;">'+parseInt(perm_order_amount).toLocaleString('en')+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right; text-align:right;">'+temp_point_amount+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right; border-right: 6px double black; text-align:right;">'+perm_point_amount+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_company_point+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right">'+perm_company_point+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_member_point+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right">'+perm_member_point+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_com_total+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right; border-right: 6px double black">'+perm_com_total+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_jafa_point+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right">'+perm_jafa_point+'</td>';
							htmlData += '</tr>';
						}
						htmlData += '<tr style="background-color: yellow;"><th>計</th>';
						htmlData +='<th class="text-right"></th>';
						htmlData +='<th class="text-right">'+total_temp_order_amount.toLocaleString('en')+'</th>';
						htmlData +='<th class="text-right">'+total_per_order_amount.toLocaleString('en')+'</th>';
						htmlData +='<th class="text-right">'+total_temp_point_amount.toLocaleString('en')+'</th>';
						htmlData += '<th style="border-right: 6px double black" class="text-right" id="">'+total_per_point_amount.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_temp_company.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_per_company.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_temp_member.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_per_member.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+(total_temp_company+total_temp_member).toFixed(2)+'</th>';
						htmlData += '<th style="border-right: 6px double black" class="text-right">'+(total_per_company+total_per_member).toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_temp_jafa.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_per_jafa.toFixed(2)+'</th>';
						htmlData += '</tr>';
					}else{
						htmlData += '<tr>';
							htmlData += '<td><center><h3>会員は利用できません。</h3><center></td>';
						htmlData += '</tr>';
					}
					
					htmlData += '</tbody>'
					
					$("#company_member_details").html(htmlData)
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
			$(document).on("click",".member_purchase_list",function(event) {
				event.preventDefault()
				var url = $(this).attr('href');
				window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width=1300,height=700");
			});
			
		});
	</script>
</body>
</html>
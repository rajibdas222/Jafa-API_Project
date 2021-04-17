<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		$this->load->view('admin/components/head');
	?>
	<style type="text/css">
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

		
		/*.datepicker-dropdown {
		  top: 124px !important;
		  left: 1208px !important;
		}*/
		table th{
			text-align: center;
		}
		.table-bordered th, .table-bordered td{
			border: 1px solid black;
		}
		.table thead th{
			border: 2px solid black;
		}
		.table-bordered .border_4px{
			border-right: 3px solid black;
		}
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
	<?php
		$this->load->view('admin/components/header');
	?>
	<div class="container-fluid">
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12">
				<div class="float-right">
					<button  type="button" class="btn btn-success btn-lg purchase_gift_code">購入</button>
					<!-- <button  type="button" class="btn btn-primary btn-lg">加盟店</button>
					<button  type="button" class="btn btn-info btn-lg">会員</button> -->
					<a class="btn btn-danger btn-lg"  href="<?= base_url() ?>">戻る</a>
				</div>
				
			</div>
			<div class="col-md-6">
				<h4 style="text-align: left;">ジャコス　粗利・ポイント管理 総括表</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="margin-top: 20px;">
				<div class="table-responsive-sm">
					<table class="table table-bordered table-hover" style="font-size: 26px; border: 3px solid blue;">
						
						<thead>
							<tr>
								<th colspan="16">
									<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
										<button id="report_period" style="background-color: #FFC000;" class="btn btn-default btn-lg">期間</button>
										: <span id="show_dateSetting">
											<?php echo date('Y年の').date('m月'). date('1日').'～'.date('m月末日'); ?>
										</span>
					
									</div>
								</th>
							</tr>
							<tr>
								<!-- <th rowspan="2" style="vertical-align: middle;" class="text-center border_4px">名</th> -->
								<!-- <th class="text-center border_4px" width="10%" style="vertical-align: middle;" rowspan="2">月日</th> -->
								<th colspan="2" class="text-center border_4px" rowspan="2" style="vertical-align: middle;">商品売上</th>
								<th class="text-center border_4px" colspan="3" style="vertical-align: middle;">ポイント</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">粗利率</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">会員</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">加盟店</th>
								<th class="text-center border_4px" style="vertical-align: middle;" rowspan="2">ジャコス</th>
								<th class="text-center border_4px" colspan="5" style="vertical-align: middle;">ギフト <span class="text-danger">a+b-c=d</span></th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">備考</th>

							</tr>
							<tr>
								<th class="text-center"> 計</th>
								<th class="text-center"> 未確定</th>
								<th class="text-center">確定</th>	
								<th class="text-center"> 前残 <span class="text-danger">a</span></th>
								<th class="text-center"> 購入 <span class="text-danger">b</span></th>
								<th class="text-center">使用 <span class="text-danger">c</span></th>						
								<th class="text-center">新規残高 <span class="text-danger">d</span></th>
                                <th class="text-center border_4px">仮ポイント <span class="text-danger">b1</span></th>
							</tr>
						</thead>
						<tbody id="member_company_list">
							<th colspan="14">
								<img src="<?= base_url() ?>resource/img/ajax/ajax-loader.gif">
							</th>
						</tbody>
					</table>  
				</div>
				
			</div>		   	
		</div>
    </div>

		<!-- Card Stared -->
		<div class="card col-md-5 col-sm-12 product_case_message" id="" style="background-color: #DAEEF3; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 500px;
right: 10px;
bottom: 10px;
padding: 4px;">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<center><p style="font-size: 24px;">行のどこを押しても詳細を表示</p>	</center>
						<center>
							<button id="coo" class="btn btn-warning btn-lg close_case_message">確認</button>
						</center>

					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Card Ended  -->

		<!-- Card Stared -->
		<div class="card col-md-5 col-sm-12 d-none" id="purchase_gift_code_screen" style="background-color: #DAEEF3; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 500px;
right: 10px;
bottom: 10px;
padding: 4px;">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 " style="margin-bottom: 20px;">
						<div class="float-right">
							<button class="btn btn-danger btn-lg close_case_message">戻る</button>
						</div>
					</div>
					<div class="col-sm-12">
						<center><p style="font-size: 24px;">アマゾンギフト券を追加購入しますか？</p>	</center>
						<center>
							<button id="show_gift_code_link_screen" class="btn btn-danger btn-lg close_case_message">はい</button>
							<button class="btn btn-info btn-lg close_case_message">いいえ</button>
						</center>

					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<!-- Card Stared -->
		<div class="card col-md-5 col-sm-12 d-none" id="purchase_gift_code_link_screen" style="background-color: #DAEEF3; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 500px;
right: 10px;
bottom: 10px;
padding: 4px;">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 " style="margin-bottom: 20px;">
						<div class="float-right">
							<button class="btn btn-danger btn-lg close_case_message">戻る</button>
						</div>
					</div>
					<div class="col-sm-12">
						<center><p style="font-size: 24px;">アマゾンサイトで購入</p>	</center>
						<center>
							<a target="_blank" href="https://www.amazon.co.jp/gift-cards-store/b?node=2351652051" class="btn btn-success btn-lg close_case_message">購入</a>
						</center>

					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<!-- Card Stared -->
		<div class="card report_period_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
			<div class="card-header">
				<div class="">
					<h3>期間設定
						<button class="btn btn-danger btn-lg float-right" id="close_report_period_screen">戻る</button>
					</h3>
					
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<div class="col-md-12"> 
							<label class="form-check-label" for="exampleRadios1" style="font-size: 20px; width: 90px;">
								<input style="height: 20px; width: 20px;" class="form-check-input" type="radio" name="sorting" id="exampleRadios1" value="all">
							 	すべて
							</label> 

							<label class="form-check-label" for="exampleRadios2"style="font-size: 20px; width: 90px;">
								<input style="height: 20px; width: 20px;" class="form-check-input" type="radio" name="sorting" id="exampleRadios2" value="month_wise" checked>
							  月別
							</label>

							</div>
							</div>
							<div class="row">
								
							<input id="month_wise" readonly="readonly" type="text" class="form-control d-block" value="<?= date('Y年m月') ?>" placeholder="Month">

							<div class="input-group mb-3 input-daterange date_range d-none">
								<input id="start_date" readonly autocomplete="off" type="text" class="form-control" placeholder="開始">
							  <div class="input-group-prepend">
							    <span class="input-group-text">～</span>
							  </div>
							  <input type="text" readonly id="end_date" autocomplete="off" class="form-control" placeholder="終了">
							</div>


						</div>
						<input type="hidden" id="selected_type" value="" name="">
						<input type="hidden" id="selected_year" value="" name="">
						<input type="hidden" id="selected_month" value="" name="">
						<input type="hidden" id="selected_start_date" value="" name="">
						<input type="hidden" id="selected_end_date" value="" name="">
						<div class="form-group text-center" style="margin-top: 10px;">
							
							<button type="submit" id="submit_sorting" class="btn btn-primary btn-lg">完了</button>
						</div>

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
					<h5 class="modal-title">加盟企業名：<span id="company_name"></span></h5>
					<a id="csv_download" class="btn btn-secondary float-right btn-lg" href=""><i class="fa fa-download"></i>  ダウンロード</a>
					<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">
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
								<button type="button" class="btn btn-primary btn-lg" id="save_unit">保存</button>

							</fieldset>
						</form>
					</div>
					
				</div>
				
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">戻る</button>
		        
		      </div>
		    </div>
		  </div>
		</div>
	<?php
		$this->load->view('admin/components/footer');
	?>
	<script type="text/javascript">
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

		$("#select_month_datepicker").change(function(event) {
			var fuldate = $(this).val();
			var yearRes = fuldate.split("年");
			var monthRes = yearRes[1].split("月");
			$("#show_dateSetting").text(monthRes[0]+'月1日～'+monthRes[0]+'月末日');
			
		});
		$('input#select_month_datepicker').datepicker({
			format: 'yyyy年mm月',
			viewMode: "months",
			minViewMode: "months",
			autoclose: true,
			todayHighlight: false,
			orientation: "auto",
		}).on("changeMonth", function (date) {  
				var currMonth = new Date(date.date).getMonth() + 1; 
				
				// var currYear = String(date.date).split(" ")[3];
				// get_all_member_company(currYear+'-'+currMonth);

	    });
	    
		function get_category_company(period = null, end_date = null) {
				
			// $("#show_dateSetting").text("Life time data");
				if (period != null) {					
					// console.log(month);
					if (period.length == 7) {
						var res = period.split("-");
						if (res[1].length<2) {
							var mon = '0'+res[1]
							period = res[0]+'-'+mon
						}
					}					
				}

				var base_url = $("#base_url").val();
				$.get(base_url+'admin/company_category/get_company_category/'+period+'/'+end_date, function(data) {
					
					var response = JSON.parse(data);
					console.log(response);
					// return false;
					var tableHtml = '';
					if (response.company_summary.company_category.length>0) {
						// Temporary
						var sub_total_order_amount = 0;
						var sub_total_temp_point = 0;
						var sub_total_per_point = 0;
						var sub_total_point_amount = 0;

						// distrubution
						var sub_total_member = 0;
						var sub_total_company = 0;
						var sub_total_jacos = 0;
						var sub_total_exchange = 0;
						var remaining = 0;
						var remaining2 = 0;

						var final_remaining = 0;
						for (var i = 0; i < response.company_summary.company_category.length; i++) {

							// console.log(response.company_summary);
							// return false;
							// Temporary Total
							var temp_order_amount = response.company_summary.company_category[i].company_temp_total.order_amount == null ? 0 : parseInt(response.company_summary.company_category[i].company_temp_total.order_amount);
							// console.log(temp_order_amount);
							var per_order_amount = response.company_summary.company_category[i].company_per_total.order_amount == null ? 0 : parseInt(response.company_summary.company_category[i].company_per_total.order_amount);
							sub_total_order_amount += parseInt(temp_order_amount+per_order_amount);
							
							var temp_point_amount = response.company_summary.company_category[i].company_temp_total.point_amount == null ? 0 : parseInt(response.company_summary.company_category[i].company_temp_total.point_amount);
							var per_point_amount = response.company_summary.company_category[i].company_per_total.point_amount == null ? 0 : parseInt(response.company_summary.company_category[i].company_per_total.point_amount);
							var total_point_amount = parseInt(per_point_amount+temp_point_amount);

							sub_total_temp_point += parseInt(temp_point_amount);
							sub_total_per_point += parseInt(per_point_amount);
							sub_total_point_amount += parseInt(total_point_amount);

							

							// Distribution 
							var jacos_temp_point = response.company_summary.company_category[i].company_temp_total.jafa_point == null ? 0 : parseInt(response.company_summary.company_category[i].company_temp_total.jafa_point);
							var jacos_per_point = response.company_summary.company_category[i].company_per_total.jafa_point == null ? 0 : parseInt(response.company_summary.company_category[i].company_per_total.jafa_point);
							var total_jacos_point = parseInt(jacos_temp_point+jacos_per_point);
							
							var company_temp_point = response.company_summary.company_category[i].company_temp_total.company_point == null ? 0 : parseInt(response.company_summary.company_category[i].company_temp_total.company_point);
							var company_per_point = response.company_summary.company_category[i].company_per_total.company_point == null ? 0 : parseInt(response.company_summary.company_category[i].company_per_total.company_point);
							var total_company_point = parseInt(company_temp_point+company_per_point);
							sub_total_company += total_company_point;

							var member_temp_point = response.company_summary.company_category[i].company_temp_total.user_point == null ? 0 : parseInt(response.company_summary.company_category[i].company_temp_total.user_point);
							var member_per_point = response.company_summary.company_category[i].company_per_total.user_point == null ? 0 : parseInt(response.company_summary.company_category[i].company_per_total.user_point);
							var total_member_point = parseInt(company_temp_point+member_per_point);
							sub_total_member += total_member_point;
							// sub_total_jacos += parseInt(sub_total_point_amount-(total_member_point+total_company_point));
							sub_total_jacos += parseInt(total_point_amount-(total_member_point+total_company_point));

							var jacos_margine = 25;
							if (response.company_summary.company_category[i].category == "B") {
								jacos_margine = 50;
							}else if (response.company_summary.company_category[i].category == "C") {
								jacos_margine = 100;
							}

							// Gift Code
							
							var previous_gift_amount = response.company_summary.previous_gift_amount == null ? 0 : parseInt(response.company_summary.previous_gift_amount);
							var previous_used_gift_amount = response.company_summary.previous_used_gift_amount == null ? 0 : parseInt(response.company_summary.previous_used_gift_amount);
							var total_remaining_balace = 0;
							if (previous_gift_amount>0) {
								 total_remaining_balace = (previous_gift_amount-previous_used_gift_amount);
							}
							

							// console.log(total_remaining_balace);
							// return false;

							var entry_giftcod_amount = response.company_summary.entry_giftcod_amount == null ? 0 : parseInt(response.company_summary.entry_giftcod_amount);
							
							var company_exchange_amount = response.company_summary.company_category[i].company_exchange_amount == null ? 0 : parseInt(response.company_summary.company_category[i].company_exchange_amount);
							var total_excnange_amount = response.company_summary.total_excnange_amount == null ? 0 : parseInt(response.company_summary.total_excnange_amount);
							var excnange_amount = response.company_summary.total_excnange_amount == null ? 0 : parseInt(response.company_summary.excnange_amount);

                           var karipoint = response.company_summary.temporary_point == null ? 0:response.company_summary.temporary_point;


							// var total_gift_amount = response.company_summary[i].total_gift_amount == null ? 0 : parseInt(response.company_summary[i].total_gift_amount);
							// var total_excnange = response.company_summary[i].total_excnange == null ? 0 : parseInt(response.company_summary[i].total_excnange);
							sub_total_exchange += company_exchange_amount;

							// if (response.company_summary[i].major_company == 0) {
							
							tableHtml += '<tr attr-data-category="'+response.company_summary.company_category[i].category+'" attr-data-period="'+response.company_summary.company_category[i].period+'" attr-data-end_date="'+response.company_summary.company_category[i].end_date+'" class="category_company">';
								// tableHtml += '<td class="border_4px">'+response.company_summary[i].category+'</td>';
								// tableHtml += '<td class="text-right border_4px">-</td>'
								tableHtml += '<td colspan="2" class="text-right border_4px">'+parseInt(temp_order_amount+per_order_amount).toLocaleString('en')+'</td>'
								
								tableHtml += '<td class="text-right ">'+parseInt(total_point_amount).toLocaleString('en')+'</td>'
								tableHtml += '<td class="text-right ">'+parseInt(temp_point_amount).toLocaleString('en')+'</td>'
								tableHtml += '<td class="text-right border_4px">'+parseInt(per_point_amount).toLocaleString('en')+'</td>'

								tableHtml += '<td class="text-right">'+jacos_margine+'%</td>';
								
								tableHtml += '<td class="text-right">'+parseInt(total_member_point).toLocaleString('en')+'</td>';

								tableHtml += '<td class="text-right">'+parseInt(total_company_point).toLocaleString('en')+'</td>';
								
								tableHtml += '<td class="text-right border_4px">'+parseInt(total_point_amount-(total_member_point+total_company_point)).toLocaleString('en')+'</td>';

								// Gift Code
								if (i==0) {
									tableHtml += '<td rowspan="3" class="text-right" style="vertical-align:middle;">'+parseInt(total_remaining_balace).toLocaleString('en')+'</td>';
								}								
								
								if (i==0) {
									tableHtml += '<td rowspan="3" class="text-right" style="vertical-align:middle;">'+parseInt(entry_giftcod_amount).toLocaleString('en')+'</td>';
								}
								tableHtml += '<td class="text-right">'+parseInt(company_exchange_amount).toLocaleString('en')+'</td>';
								// var total_gift_amount = previous_gift_amount+entry_giftcod_amount;
								// remaining = total_gift_amount;
								// var remaining_balance = ((total_remaining_balace+entry_giftcod_amount)-sub_total_exchange);
								
								if (i==0) {
									tableHtml += '<td  rowspan="3" onclick="return false" class="text-right border_4px" style="vertical-align:middle;">'+parseInt(total_remaining_balace+entry_giftcod_amount-excnange_amount).toLocaleString('en')+'</td>';
								}

								tableHtml += '<td class="text-center "></td>';
                                tableHtml += '<td class="text-center ">-</td>';

							tableHtml += '</tr>';					
						}

						// for Unknown Tracking ID
						
						tableHtml += '<tr style="background-color: yellow;">';
						tableHtml += '<th  class="text-right">計</th>';
						tableHtml += '<th  class="text-right border_4px" id="all_purch_total">'+sub_total_order_amount.toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right">'+sub_total_point_amount.toLocaleString('en')+'</th>';
						
						tableHtml += '<th class="text-right">'+Math.floor(sub_total_temp_point).toLocaleString('en')+'</th>';		
						tableHtml += '<th class="text-right border_4px">'+Math.floor(sub_total_per_point).toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-center">-</th>';
						tableHtml += '<th class="text-right">'+sub_total_member.toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+parseInt(sub_total_company).toLocaleString('en')+'</th>';
						
						tableHtml += '<th class="text-right border_4px">'+parseInt(sub_total_jacos).toLocaleString('en')+'</th>';
						// gift code
						tableHtml += '<th class="text-right">'+parseInt(total_remaining_balace).toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right">'+parseInt(entry_giftcod_amount).toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right ">'+parseInt(sub_total_exchange).toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right border_4px">'+parseInt(total_remaining_balace+entry_giftcod_amount-excnange_amount).toLocaleString('en')+'</th>';
                        tableHtml += '<th class="text-right border_4px">'+ Math.floor(karipoint) +'</th>';
						tableHtml += '<th>-</th>';
						tableHtml += '</tr>';
						
						$( "#member_company_list" ).html( tableHtml );
					}
					
				});
			}

			get_category_company();
			// get_all_member_company()

			$(document).mouseup(function (e){
				var hide_enter_outside = $(".product_case_message");
				var purchase_gift_code_screen = $("#purchase_gift_code_screen");
				var purchase_gift_code_link_screen = $("#purchase_gift_code_link_screen");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');
				}
				if (!purchase_gift_code_screen.is(e.target) && purchase_gift_code_screen.has(e.target).length === 0)
				{
				    purchase_gift_code_screen.removeClass('d-block').addClass('d-none');
				}
				if (!purchase_gift_code_link_screen.is(e.target) && purchase_gift_code_link_screen.has(e.target).length === 0)
				{
				    purchase_gift_code_link_screen.removeClass('d-block').addClass('d-none');
				}
			});

			$(".close_case_message").click(function(event) {
				$(".product_case_message").removeClass('d-block').addClass('d-none'); 
				$("#purchase_gift_code_screen").removeClass('d-block').addClass('d-none'); 
				$("#purchase_gift_code_link_screen").removeClass('d-block').addClass('d-none'); 
			});

			$(document).on("click",".category_company",function(event) {
				event.preventDefault()
				var category = $(this).attr('attr-data-category');
				var selected_month = $(this).attr('attr-data-period');
				var end_date = $(this).attr('attr-data-end_date');

				var base_url = $("#base_url").val();
				// width="+screen.availWidth+",height="+screen.availHeight
				window.open(base_url+'admin/company/index/'+category+'?period='+selected_month+'&end_date='+end_date, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width="+screen.availWidth+",height=700");
				
			});
			
			$(document).on("click",".member_purchase_list",function(event) {
				event.preventDefault()
				var url = $(this).attr('href');
				window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width=1300,height=700");
			});

			$(document).on("click",".giftcode_history",function(event) {
				event.preventDefault()
				var url = $(this).attr('href');
				window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width=1300,height=700");
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

			$('.input-daterange input').each(function() {

			    $(this).datepicker({
					format: 'yyyy年mm月dd日',
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
				var month = "";
			    $("#submit_sorting").click(function(event) {
			    	event.preventDefault();
			    	$(".report_period_screen").removeClass('d-block').addClass('d-none');
			    	var month_wise = $("#month_wise").val();
			    	var exploadYear = String(month_wise).split("年");
			    	var exploadMonth = String(exploadYear[1]).split("月");
			    	var sorting = $("input:checked").val();
			    	$("#selected_type").val(sorting);
			    	if (sorting == 'month_wise' && month_wise !="") {
			    		$("#show_dateSetting").text(exploadYear[0]+'年の'+exploadMonth[0]+'月1日～'+exploadMonth[0]+'月末日');
			    		get_category_company(exploadYear[0]+'-'+exploadMonth[0]);
			    		// $("#selected_type").val('month_wise');
			    		$("#selected_month").val(exploadYear[0]+'-'+exploadMonth[0]);
			    	}else if (sorting == 'date_range') {
			    		// $("#selected_type").val('month_wise');
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

			    			$("#selected_type").val('date_range');
			    			$("#selected_start_date").val(start_year[0]+'-'+start_month[0]+'-'+dateOnly[0]);
			    			$("#selected_end_date").val(end_year[0]+'-'+end_month[0]+'-'+end_dateOnly[0]);

			    			if (start_year[0]==end_year[0]) {
			    				$("#show_dateSetting").text(start_year[0]+'年の'+start_month[0]+'月'+dateOnly[0]+'日～'+end_month[0]+'月'+end_dateOnly[0]+'日');
			    			}else{
			    				$("#show_dateSetting").text(start_year[0]+'年の'+start_month[0]+'月'+dateOnly[0]+'日～'+end_year[0]+'年の'+end_month[0]+'月'+end_dateOnly[0]+'日');
			    			}
			    			get_category_company(start_year[0]+'-'+start_month[0]+'-'+dateOnly[0], end_year[0]+'-'+end_month[0]+'-'+end_dateOnly[0]);
			    		}
			    	}else if (sorting == 'all'){
			    		$("#show_dateSetting").text("すべてのレポート");
			    		get_category_company('all');
			    	}else{
			    		// $("#show_dateSetting").text("すべてのレポート");
			    		get_category_company();
			    	}
			    	
			    });

			    $("#report_period").click(function(event) {
			    	$(".report_period_screen").removeClass('d-none').addClass('d-block');
			    });

			    $("#close_report_period_screen").click(function(event) {
			    	$(".report_period_screen").removeClass('d-block').addClass('d-none');
			    });

			    $(".purchase_gift_code").click(function(event) {
			    	event.preventDefault()
			    	$("#purchase_gift_code_screen").removeClass('d-none').addClass('d-block');
			    });

			    $("#show_gift_code_link_screen").click(function(event) {
			    	$("#purchase_gift_code_screen").removeClass('d-none').addClass('d-block');
			    	$("#purchase_gift_code_link_screen").removeClass('d-none').addClass('d-block');
			    });
	</script>
</body>
</html>
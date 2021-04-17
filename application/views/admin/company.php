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
		// $this->load->view('admin/components/header');
	?>
	<div class="container-fluid">
		<div class="row" style="margin-top: 10px;">
			<div class="col-md-12">
				<div class="float-right">
					<!-- <button  type="button" class="btn btn-success btn-lg">購入</button> -->
					<!-- <button  type="button" class="btn btn-primary btn-lg">加盟店</button>
					<button  type="button" class="btn btn-info btn-lg">会員</button> -->
					<button class="btn btn-danger btn-lg" onclick="javascript: window.close()">戻る</button>
				</div>
				
			</div>
			<div class="col-md-6">
				<h4 style="text-align: left;">ジャコス　粗利・ポイント管理 総括表</h4>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" style="margin-top: 20px;">
				<div class="table-responsive-sm">
					<table class="table table-bordered" style="font-size: 26px; border: 3px solid blue;">
						
						<thead>
							<tr>
								<th colspan="9">
									<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
										
										<!-- <button id="report_periodddd" class="btn btn-warning btn-lg">期間</button>
										: --> <span id="show_dateSetting">
											<?= $report_lenght; ?>
										</span>
					
									</div>
								</th>
							</tr>
							<tr>
								<th rowspan="2" style="vertical-align: middle;" class="text-center border_4px">名</th>
								<!-- <th class="text-center border_4px" width="10%" style="vertical-align: middle;" rowspan="2">月日</th> -->
								<th class="text-center border_4px" rowspan="2" style="vertical-align: middle;">商品売上</th>
								<th class="text-center border_4px" colspan="3" style="vertical-align: middle;">ポイント</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">粗利率</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">会員</th>
								<th class="text-center" style="vertical-align: middle;" rowspan="2">加盟店</th>
								<th class="text-center" style="vertical-align: middle;border-right: 3px solid blue" rowspan="2">ジャコス</th>
														
							</tr>
							<tr>
								<th class="text-center"> 計</th>
								<th class="text-center"> 未確定</th>
								<th class="text-center">確定</th>							
							</tr>
													
						</thead>
						<tbody id="member_company_list">
							<?php
								// print_r($company_list);
								foreach ($company_list as $company) {
									// print_r($company);
									// exit();
									?>
									<tr>
										<td class="border_4px">
											<a class="company_member_list" attr-data-period="<?= $period ?>" attr-data-end_date="<?= $end_date ?>" style="text-decoration: underline;" href="<?= $company['user_id'] ?>">
											<?= $company['company_name'] ?>
											</a>
										</td>
										<td class="border_4px text-right"><?= number_format($company['temp_order_amount']+$company['per_order_amount']) ?></td>
										<td class="text-right"><?= number_format($company['temp_point_amount']+$company['per_point_amount']) ?></td>
										<td class="text-right"><?= number_format($company['temp_point_amount']) ?></td>
										<td class="border_4px text-right"><?= number_format($company['per_point_amount']) ?></td>
										<td class="text-right"><?= 100-($company['com_mar']+$company['member_mar']) ?>%</td>
										<td class="text-right"><?= number_format(floor($company['temp_user_point'])+floor($company['per_user_point'])) ?></td>
										<td class="text-right"><?= number_format($company['temp_company_point']+$company['per_company_point']) ?></td>
										<td class="text-right"><?= number_format(($company['temp_point_amount']+$company['per_point_amount'])-(floor($company['temp_user_point'])+floor($company['per_user_point']))) ?></td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>  
				</div>
				
			</div>		   	
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
						<center>
							<button id="close_case_message" id="coo" class="btn btn-warning close_case_message btn-lg">確認</button>
						</center>	
						

					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Card Ended  -->

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
								<input id="start_date" type="text" class="form-control" placeholder="Start Date">
							  <div class="input-group-prepend">
							    <span class="input-group-text">～</span>
							  </div>
							  <input type="text" id="end_date" class="form-control" placeholder="End Date">
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
		<!-- Card Ended  -->
		<div class="modal fade member_accounts_detail" id="member_accounts_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content"  style="background: #FFFF99; min-height: 600px; width: 1250px;">
				<div class="modal-header">
					<h5 class="modal-title">加盟企業名：<span id="company_name"></span></h5>
					<a id="csv_download" class="btn btn-secondary float-right btn-lg" href=""><i class="fa fa-download"></i> ダウンロード</a>
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
				$.get(base_url+'main_controller/get_company_category/'+period+'/'+end_date, function(data) {
					// console.log(data);
					// return false;
					var response = JSON.parse(data);
					console.log(response);
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

						// Excange
						var total_excange = 0;
						var tatal_balance = 0;

						// Permanent
						var total_order_amount = 0;
						var total_point_amount = 0;
						var total_company = 0;
						var total_member = 0;
						var total_jafa = 0;

						for (var i = 0; i < response.company_summary.length; i++) {
							// Temporary Total
							total_temp_order_amount += parseInt(response.company_summary[i].temp_order_amount);
							total_temp_point_amount += parseInt(response.company_summary[i].temp_point_amount);
							
							// Permanent Total
							total_per_order_amount += parseInt(response.company_summary[i].per_order_amount);
							total_per_point_amount += parseInt(response.company_summary[i].per_point_amount);
							
							
							// Total Balance
							total_excange += parseInt(response.company_summary[i].user_point_exange);
							

							//
							var order_amount = parseInt(response.company_summary[i].temp_order_amount+response.company_summary[i].per_order_amount);
							total_order_amount += order_amount;

							var total_member_point = parseInt(response.company_summary[i].per_user_point+response.company_summary[i].temp_user_point);
							total_member += total_member_point;
							var total_company_point = parseInt(response.company_summary[i].temp_company_point)+parseInt(response.company_summary[i].per_company_point);
							total_company += total_company_point;
							var total_point = parseInt(response.company_summary[i].temp_point_amount+response.company_summary[i].per_point_amount);
							total_point_amount += total_point;
							var giving_percentage = parseInt(response.company_summary[i].member_mar)+parseInt(response.company_summary[i].com_mar);
							var jafa_percentige = 100-giving_percentage;
							if (response.company_summary[i].major_company == 0) {

							tableHtml += '<tr>';								
								tableHtml += '<td class="border_4px"><a class="company_member_list"  style="text-decoration: underline;" href="'+response.company_summary[i].user_id+'">'+response.company_summary[i].company_name+'</a></td>';
								tableHtml += '<td class="text-right border_4px">-</td>'
								tableHtml += '<td class="text-right border_4px">'+addCommas(order_amount)+'</td>'
								
								tableHtml += '<td class="text-right ">'+addCommas(total_point)+'</td>'
								tableHtml += '<td class="text-right ">'+addCommas(parseInt(response.company_summary[i].temp_point_amount))+'</td>'
								tableHtml += '<td class="text-right border_4px">'+addCommas(parseInt(response.company_summary[i].per_point_amount))+'</td>'

								tableHtml += '<td class="text-right">'+jafa_percentige+'%</td>';
								
								tableHtml += '<td class="text-right">'+parseInt(total_member_point).toLocaleString('en')+'</td>';

								tableHtml += '<td class="text-right">'+parseInt(total_company_point).toLocaleString('en')+'</td>';
								
								tableHtml += '<td class="text-right">'+parseInt(parseInt(total_point- (total_member_point +total_company_point))).toLocaleString('en')+'</td>';
								tableHtml += '</tr>';
							}else{								

								tableHtml += '<tr class="bg-primary text-light">';
								
								tableHtml += '<td class="border_4px"><a class="company_member_list"  style="text-decoration: underline; color: white;" href="'+response.company_summary[i].user_id+'">'+response.company_summary[i].company_name+'</a></td>';
								
								tableHtml += '<td class="text-right border_4px">-</td>'
								tableHtml += '<td class="text-right border_4px">'+addCommas(parseInt(response.company_summary[i].temp_order_amount+response.company_summary[i].per_order_amount))+'</td>'
								
								tableHtml += '<td class="text-right ">'+addCommas(total_point)+'</td>'
								tableHtml += '<td class="text-right ">'+addCommas(parseInt(response.company_summary[i].temp_point_amount))+'</td>'
								tableHtml += '<td class="text-right border_4px">'+addCommas(parseInt(response.company_summary[i].per_point_amount))+'</td>'

								tableHtml += '<td class="text-right">'+jafa_percentige+'%</td>';
																
								tableHtml += '<td class="text-right">'+parseInt(total_member_point).toLocaleString('en')+'</td>';

								tableHtml += '<td class="text-right">'+parseInt(total_company_point).toLocaleString('en')+'</td>';
								
								tableHtml += '<td class="text-right">'+parseInt(parseInt(total_point- (total_member_point +total_company_point))).toLocaleString('en')+'</td>';
								tableHtml += '</tr>';
							}						
						}

						// for Unknown Tracking ID
						
						tableHtml += '<tr style="background-color: yellow;">';
						tableHtml += '<th  colspan="2" class="border_4px text-right">計</th>';
						tableHtml += '<th  class="text-right border_4px" id="all_purch_total">'+total_order_amount.toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right">'+total_point_amount.toLocaleString('en')+'</th>';
						
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_point_amount).toLocaleString('en')+'</th>';		
						tableHtml += '<th class="text-right border_4px">'+Math.floor(total_per_point_amount).toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-center">-</th>';
						tableHtml += '<th class="text-right">'+total_member.toLocaleString('en')+'</th>';	
						tableHtml += '<th style="border-right: 6px double black" class="text-right">'+parseInt(total_company).toLocaleString('en')+'</th>';
						
						tableHtml += '<th class="text-right">'+parseInt(total_point_amount-(total_member+total_company)).toLocaleString('en')+'</th>';
						tableHtml += '</tr>';
						
						$( "#member_company_list" ).html( tableHtml );
					}
					
				});
			}

			// get_category_company();
			// get_all_member_company()

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
				var end_date = $(this).attr('attr-data-end_date');
				var period = $(this).attr('attr-data-period');
				// alert(period);
				console.log(period);
				// return false;
				var base_url = $("#base_url").val();
				
				var selected_type = $("#selected_type").val();
				var selected_month = $("#selected_month").val();
				if (selected_month == "") {
					// selected_month = null;
					selected_month = period == ""? null: period;
				}
				var end_date = null;
				
				if (selected_type == 'date_range') {
					selected_month = $("#selected_start_date").val();
					end_date = $("#selected_end_date").val()
				}
				if (selected_type == 'all') {
					selected_month = 'all';
					end_date = null
				}

				$("#csv_download").attr('href', base_url+'main_controller/download_member_point/'+user_id+'/'+selected_month+'/'+end_date);
				
				$('#member_accounts_detail').modal();
				$.ajax({
					url: base_url+'main_controller/get_company_member',
					type: 'POST',
					data: {user_id: user_id, month: selected_month, end_date: end_date},
				})
				.done(function(data) {
					// console.log(data);
					// return false;
					var response = JSON.parse(data);
					console.log(response);
					// return false;
					$("#company_name").text(response.company_details.fullname);
					var htmlData = "";
					if (response.members.length>0) {
						htmlData += '<thead>';
						htmlData += '<tr>';
							// htmlData += '<th width="5%">加盟企業</th>';
							htmlData += '<th rowspan="2">会員</th>';
							htmlData += '<th colspan="2">商品売上金額</th>';
							htmlData += '<th colspan="2" style="border-right: 6px double black">チャリン<sup>２</sup></th>';
							htmlData += '<th colspan="2">加盟企業</th>';
							htmlData += '<th colspan="3" class="text-center">会員計</th>';
							htmlData += '<th colspan="2" style="border-right: 6px double black">支払計</th>';
							htmlData += '<th colspan="2">当社粗利</th>';
						htmlData += '</tr>';
						htmlData += '<tr>';
							// htmlData += '<th width="5%">加盟企業</th>';
							
							htmlData += '<th>未確定</th>';
							htmlData += '<th>確定</th>';
							htmlData += '<th>未確定</th>';
							htmlData += '<th style="border-right: 6px double black">確定</th>';
							htmlData += '<th>未確定</th>';
							htmlData += '<th>確定</th>';
							htmlData += '<th class="text-center">未確定</th>';
							htmlData += '<th class="text-center">確定</th>';
							htmlData += '<th class="text-center">交換</th>';
							// htmlData += '<th class="text-center">バランス</th>';
							htmlData += '<th style="">未確定</th>';
							htmlData += '<th style="border-right: 6px double black">確定</th>';
							htmlData += '<th>T</th>';
							htmlData += '<th>P</th>';
						htmlData += '</tr>';
						htmlData += '</thead>';
						htmlData += '<tbody>';
						htmlData += '<tr>'
							// htmlData += '<td style="vertical-align: middle; text-align: center;" width="10%" rowspan="'+(response.members.length+1)+'">'+response.company_details.fullname+'</td>'
						// htmlData += '</tr>'
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

						// Total Excenge
						var total_excenge = 0;

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

							// Total Exchange
							
							var exchange_amount = response.members[i].excenge_amount.amount == null? 0: response.members[i].excenge_amount.amount;
							total_excenge += parseInt(exchange_amount);

							htmlData += '<tr>';
								htmlData += '<td><a class="member_purchase_list" href="'+base_url+'purchase_list/'+response.members[i].user_id+'/'+selected_month+'/'+end_date+'">'+response.members[i].fullname+'</a></td>';
								htmlData += '<td class="bg-warning" style="text-align: right;">'+parseInt(temp_order_amount).toLocaleString('en')+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right;">'+parseInt(perm_order_amount).toLocaleString('en')+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right; text-align:right;">'+temp_point_amount+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right; border-right: 6px double black; text-align:right;">'+perm_point_amount+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_company_point+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right">'+perm_company_point+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_member_point+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right">'+perm_member_point+'</td>';
								htmlData += '<td class="bg-info text-white" style="text-align: right"><a class="giftcode_history text-white" style="font-size:22px;" href="'+base_url+'giftcode_history/'+response.members[i].user_id+'/'+selected_month+'/'+end_date+'">'+exchange_amount.toLocaleString('en')+'</a></td>';

								// htmlData += '<td class="bg-info text-white" style="text-align: right">'+exchange_amount.toLocaleString('en')+'</td>';
								// htmlData += '<td class="bg-primary text-white" style="text-align: right">'+parseInt(perm_member_point-exchange_amount).toLocaleString('en')+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_com_total+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right; border-right: 6px double black">'+perm_com_total+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+parseInt(temp_jafa_point).toLocaleString('en')+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right">'+parseInt(perm_point_amount-perm_com_total).toLocaleString('en')+'</td>';
							htmlData += '</tr>';
						}
						htmlData += '<tr style="background-color: yellow;">';
						htmlData +='<th class="text-right">計</th>';
						htmlData +='<th class="text-right">'+total_temp_order_amount.toLocaleString('en')+'</th>';
						htmlData +='<th class="text-right">'+total_per_order_amount.toLocaleString('en')+'</th>';
						htmlData +='<th class="text-right">'+total_temp_point_amount.toLocaleString('en')+'</th>';
						htmlData += '<th style="border-right: 6px double black" class="text-right" id="">'+total_per_point_amount.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_temp_company.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_per_company.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_temp_member.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_per_member.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_excenge.toLocaleString('en')+'</th>';
						// htmlData += '<th class="text-right">'+parseInt(total_per_member-total_excenge).toLocaleString('en')+'</th>';
						
						htmlData += '<th class="text-right">'+(total_temp_company+total_temp_member).toLocaleString('en')+'</th>';
						htmlData += '<th style="border-right: 6px double black" class="text-right">'+(total_per_company+total_per_member).toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_temp_jafa.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+(total_per_point_amount-(total_per_company+total_per_member)).toLocaleString('en')+'</th>';
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
	</script>
</body>
</html>
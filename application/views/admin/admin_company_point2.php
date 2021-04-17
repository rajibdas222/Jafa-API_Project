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
		
		<div class="row">
			<div class="col-md-12" style="margin-top: 20px;">
				<div class="table-responsive-sm">
					<table class="table table-bordered table-striped" style="font-size: 26px; border: 3px solid blue;">
						
						<thead>
							<tr>
								<th colspan="5">
									<h4 style="text-align: left;">ポイント計算書　一覧表</h4>
								</th>
								<th style="text-align: left;border-left: 6px double black; border-right: 0;">
									<a href="#" class="btn btn-link" style="font-size: 24px; text-align: left;">→支払</a>
								</th>
								<th colspan="9" style="border-left: 0;padding-top: 0">
									<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
										
										<button id="report_period" style="background-color: #FFC000; border: 2px solid green;" class="btn btn-default btn-sm">期間</button>
										: <span id="show_dateSetting">
											<?php echo date('Y年の').date('m月'). date('1日').'～'.date('m月末日'); ?>
										</span>
					
										<!-- <input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker"> -->
					
									</div>
								</th>
							</tr>
							<tr>
								<th width="10%" style="vertical-align: middle;" rowspan="2">加盟企業</th>
								<th colspan="2" style="vertical-align: middle;">商品売上金額</th>
								<th colspan="2" style="border-right: 6px double black; vertical-align: middle;">チャリン<sup>２</sup></th>
								<th colspan="2">加盟企業 - 手数料</th>
								<th class="text-center" colspan="4">会員計</th>
								<th colspan="2" style="border-right: 6px double black;">支払計</th>
								<th colspan="2">当社粗利</th>							
							</tr>
							<tr>
								<th class="text-warning text-center"> 未確定</th>
								<th class="text-success text-center"> 確定</th>
								<th class="text-warning text-center"> 未確定</th>
								<th class="text-success text-center" style="border-right: 6px double black; vertical-align: middle;"> 確定</th>
								<th class="text-warning text-center" > 未確定</th>
								<th class="text-success text-center"> 確定</th>
								<th class="text-warning text-center"> 未確定</th>
								<th class="text-success text-center"> 確定</th>
								<th class="text-info text-center">交換</th>
								<th class="text-primary text-center">バランス</th>
								<th class="text-warning"> 未確定</th>
								<th class="text-success" style="border-right: 6px double black; vertical-align: middle;"> 確定</th>
								<th class="text-warning"> 未確定</th>
								<th class="text-success"> 確定</th>
							</tr>
													
						</thead>
						<tbody id="member_company_list">
							<th colspan="15">
								<img src="<?= base_url() ?>resource/img/ajax/ajax-loader.gif">
							</th>
						</tbody>
					</table>  
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
						`
						</p>	
						<button id="close_case_message" style="margin: 0px 200px; background-color: #FFFF99; border: 2px solid green" id="coo" class="btn btn-default btn-lg">確認</button>

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
							<button class="btn btn-warning" id="close_report_period_screen">戻る</button>
							<button type="submit" id="submit_sorting" class="btn btn-primary">提出する</button>
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
					<a id="csv_download" class="btn btn-secondary float-right" href=""><i class="fa fa-download"></i> Download</a>
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
	    
		function get_all_member_company(period = null, end_date = null) {
				
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
				$.get(base_url+'main_controller/new_get_company_summary/'+period+'/'+end_date, function(data) {
					// console.log(data);
					// return false;
					var response = JSON.parse(data);
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
							
							// Total Balance
							total_excange += parseInt(response.company_summary[i].user_point_exange);
							// tatal_balance += parseInt(response.company_summary[i].per_user_point-response.company_summary[i].user_point_exange);
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
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].user_point_exange))+'</td>';
								tableHtml += '<td class="text-right">'+parseInt(response.company_summary[i].per_user_point-response.company_summary[i].user_point_exange).toLocaleString('en')+'</td>';
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
								tableHtml += '<td class="text-right">'+addCommas(parseInt(response.company_summary[i].user_point_exange))+'</td>';
								tableHtml += '<td class="text-right">'+parseInt(response.company_summary[i].per_user_point-response.company_summary[i].user_point_exange).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor((parseInt(response.company_summary[i].temp_company_point)+parseInt(response.company_summary[i].temp_user_point))).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor((parseInt(response.company_summary[i].per_company_point)+parseInt(response.company_summary[i].per_user_point))).toLocaleString('en')+'</td>';
								tableHtml += '<td style="border-left: 6px double black"  class="text-right">'+Math.floor(parseInt(response.company_summary[i].temp_jafa_point))+'</td>';
								tableHtml += '<td class="text-right">'+Math.floor(parseInt(response.company_summary[i].per_jafa_point))+'</td>';
								tableHtml += '</tr>';
							}						
						}

						// for Unknown Tracking ID
						
						tableHtml += '<tr style="background-color: yellow;"><th>計</th><th class="text-right">'+total_temp_order_amount.toLocaleString('en')+'</th>	<th  class="text-right" id="all_purch_total">'+total_per_order_amount.toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_point_amount).toLocaleString('en')+'</th>';
						tableHtml += '<th style="border-right: 6px double black" class="text-right">'+Math.floor(total_per_point_amount).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_company).toLocaleString('en')+'</th>';					
						tableHtml += '<th class="text-right">'+Math.floor(total_per_company).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_member).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+Math.floor(total_per_member).toLocaleString('en')+'</th>';	
						tableHtml += '<th class="text-right">'+total_excange.toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right">'+parseInt(total_per_member-total_excange).toLocaleString('en')+'</th>';
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_member+total_temp_company).toLocaleString('en')+'</th>';	
						tableHtml += '<th style="border-right: 6px double black" class="text-right">'+Math.floor(total_per_member+total_per_company).toLocaleString('en')+'</th>';	
						
						tableHtml += '<th class="text-right">'+Math.floor(total_temp_jafa).toLocaleString('en')+'</th>';
						
						tableHtml += '<th class="text-right">'+Math.floor(total_per_jafa).toLocaleString('en')+'</th>';
						tableHtml += '</tr>';
						
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

			$(document).on("click",".company_member_list",function(event) {
				event.preventDefault()
				var user_id = $(this).attr('href');
				var company_name = $(this).text();
				var base_url = $("#base_url").val();
				
				var selected_type = $("#selected_type").val();
				var selected_month = $("#selected_month").val();
				if (selected_month == "") {
					selected_month = null;
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
				// alert(selected_month);
				// alert(selected_type);
				// return false;

				$("#csv_download").attr('href', base_url+'main_controller/download_member_point/'+user_id+'/'+selected_month+'/'+end_date);
				
				$('#member_accounts_detail').modal();
				$.ajax({
					url: base_url+'main_controller/get_company_member',
					type: 'POST',
					data: {user_id: user_id, month: selected_month, end_date: end_date},
				})
				.done(function(data) {
					
					var response = JSON.parse(data);
					// console.log(response);
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
							htmlData += '<th colspan="4" class="text-center">会員計</th>';
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
							htmlData += '<th class="text-center">バランス</th>';
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
								htmlData += '<td class="bg-primary text-white" style="text-align: right">'+parseInt(perm_member_point-exchange_amount).toLocaleString('en')+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_com_total+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right; border-right: 6px double black">'+perm_com_total+'</td>';
								htmlData += '<td class="bg-warning" style="text-align: right">'+temp_jafa_point+'</td>';
								htmlData += '<td class="bg-success text-white" style="text-align: right">'+perm_jafa_point+'</td>';
							htmlData += '</tr>';
						}
						htmlData += '<tr style="background-color: yellow;">';
						htmlData +='<th class="text-right">計</th>';
						htmlData +='<th class="text-right">'+total_temp_order_amount.toLocaleString('en')+'</th>';
						htmlData +='<th class="text-right">'+total_per_order_amount.toLocaleString('en')+'</th>';
						htmlData +='<th class="text-right">'+total_temp_point_amount.toLocaleString('en')+'</th>';
						htmlData += '<th style="border-right: 6px double black" class="text-right" id="">'+total_per_point_amount.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+total_temp_company.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_per_company.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_temp_member.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_per_member.toFixed(2)+'</th>';
						htmlData += '<th class="text-right">'+total_excenge.toLocaleString('en')+'</th>';
						htmlData += '<th class="text-right">'+parseInt(total_per_member-total_excenge).toLocaleString('en')+'</th>';
						
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
			    		get_all_member_company(exploadYear[0]+'-'+exploadMonth[0]);
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
			    			get_all_member_company(start_year[0]+'-'+start_month[0]+'-'+dateOnly[0], end_year[0]+'-'+end_month[0]+'-'+end_dateOnly[0]);
			    		}
			    	}else if (sorting == 'all'){
			    		$("#show_dateSetting").text("すべてのレポート");
			    		get_all_member_company('all');
			    	}else{
			    		// $("#show_dateSetting").text("すべてのレポート");
			    		get_all_member_company();
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
    </div>
</html>
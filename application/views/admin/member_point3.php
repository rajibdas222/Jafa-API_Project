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
			<div class="col-sm-2">
				<?php
				$fullname = "";
				if ($this->authentication->is_signed_in()) {
					$fullname = $account_details->fullname;
				}
				?>
				<a href="<?= base_url('account/account_profile') ?>" style=" font-size: 26px; text-decoration: underline; color: #000;"> <?= $fullname ?></a><span style="font-size: 26px"> 様</span>
			</div>
			<div class="col-md-4" style="font-size: 32px;">
				会員別ポイント計算書　一覧表
			</div>
			<div class="col-md-6" style="font-size: 28px;">
				<a href="compare" class="btn btn-warning btn-lg float-right">戻る</a>
				<a href="company_margine" class="btn btn-info btn-lg float-right" style="margin-right: 10px;">加盟企業別</a>
				<a href="shop_margine" class="btn btn-success btn-lg float-right" style="margin-right: 10px;">ショップ別</a>
				<!-- <button class="btn btn-danger btn-lg float-right" id="new_member_reg_btn" style="margin-right: 10px;"><i class="fa fa-user-plus"></i> 登録編</button> -->
				<button class="btn btn-danger btn-lg float-right" id="new_member_reg_btn" style="margin-right: 10px;"><i class="fa fa-user-plus"></i> 新規登録</button>
				<a href="company_point" class="btn btn-secondary btn-lg float-right" style="margin-right: 10px;">My Point</a>
				
			</div>
			
			<div class="col-md-12">
				<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
					<a class="btn btn-secondary" id="csv_download" href="<?= base_url() ?>main_controller/download_member_point/<?= $account->id ?>"><i class="fa fa-download"></i> Download</a>
					<button id="report_period" style="background-color: #FFC000; border: 2px solid green;" class="btn btn-default btn-sm">期間</button>
						<span id="show_dateSetting">
							<?php echo date('Y年の').date('m月'). date('1日').'～'.date('m月末日'); ?>
						</span>
					</span>

					<input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker">

				</div>
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				<table id="company_member_list" class="table table-bordered" style="font-size: 26px; border: 3px solid blue;">
					<thead>
						<tr>
							<th>会員</th>
							<th>トラッキングID</th>
							<th>金額</th>
							<th width="8%">ショップＰ</th>
							<th width="8%">チャリン<sup>２</sup></th>
							<th>合計</th>
							<th width="25%">備考</th>
						</tr>						
					</thead>
					<tbody id="">
						<tr>
							<th colspan="7">
								<img src="<?= base_url() ?>resource/img/ajax/ajax-loader.gif">
							</th>
						</tr>

					</tbody>
					
				</table>  
			</div>		   	
		</div>
		<div class="card d-block screen_message" style="position: fixed; right: 30px; bottom: 10px; padding: 4px; background: #FFCCFF;">
		  	<div class="card-body">
		    	<p style="font-size: 22px;">
		    		会員名を押すと、明細が表示されます。
		    	</p>
		    	<center><button class="btn btn-info" id="close_scerren_message">確認</button></center>
		  	</div>
		</div>	
		<div class="card d-none col-lg-3 col-md-4 col-sm-12 new_member_registration_screen" id="member_reg_form" style="position: fixed; right: 30px; bottom: 10px; background: #f0ffcc; padding: 0">
			<div class="card-header">
				<!-- <center><h4>加盟店登録</h4></center>  -->
				<center><h4>新規登録</h4></center> 
			</div>
		  	<div class="card-body">
		    	<form class="form-horizontal" action="account/manage_users/compay_save" method="post">
		    		<input type="hidden" name="request_url" value="company_margine">
				  	<fieldset>
				  		<table class="table table-striped" style="margin-bottom: 0">
				  			<tr>
				  				<th style="border-color: #dee2e6" width="30%"><label class="control-label" for="owner_name">加盟店名</label></th>
				  				<td>
				  					<?php echo form_input(array('name' => 'users_firstname', 'id' => 'users_firstname', 'style' => 'ime-mode: active;', 'class'=>'form-control', 'value' => set_value('users_firstname') ? set_value('users_firstname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
				  					          <?php if (form_error('users_firstname')) : ?>
				  					              <span class="help-block">
				  					                <?php echo form_error('users_firstname'); ?>
				  					                </span>
				  					          <?php endif; ?>
				  				</td>
				  			</tr>
				  			<tr>
				  				<th style="border-color: #dee2e6">
				  					<label class="control-label" for="owner_phone">加盟店コード</label> 
				  				</th>
				  				<td>
				  					<?php echo form_input(array( 'type' => 'tel', 'name' => 'users_username', 'style' => 'ime-mode: inactive', 'id' => 'users_username', 'class'=>'form-control', 'value' => set_value('users_username') ? set_value('users_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>

				  					<?php if (form_error('users_username') || isset($users_username_error)) : ?>
				  					  <span class="help-block">
				  					  <?php
				  					    echo form_error('users_username');
				  					    echo isset($users_username_error) ? $users_username_error : '';
				  					  ?>
				  					  </span>
				  					<?php endif; ?>
				  					
				  				</td>
				  			</tr>
				  			<tr>
				  				<th style="border-color: #dee2e6">
				  					<label class="control-label" for="owner_phone">メールアドレス</label> 
				  				</th>
				  				<td>
				  					<?php echo form_input(array('name' => 'users_email', 'id' => 'users_email', 'type' =>'tel', 'style' => 'ime-mode: inactive', 'class'=>'form-control', 'value' => set_value('users_email') ? set_value('users_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>

				  					            <?php if (form_error('users_email') || isset($users_email_error)) : ?>
				  					              <span class="help-block">
				  					              <?php
				  					                echo form_error('users_email');
				  					                echo isset($users_email_error) ? $users_email_error : '';
				  					              ?>
				  					              </span>
				  					            <?php endif; ?>
				  					
				  				</td>
				  			</tr>
				  			<tr>
				  				<th style="border-color: #dee2e6">
				  					<label class="control-label" for="introduce_name">新パスワード</label>
				  				</th>
				  				<td>
				  					<?php echo form_password(array('name' => 'users_new_password', 'id' => 'users_new_password', 'class'=>'form-control', 'value' => set_value('users_new_password'), 'autocomplete' => 'off')); ?>

				  					          <?php if (form_error('users_new_password')) : ?>
				  					            <span class="help-block">
				  					              <?php echo form_error('users_new_password'); ?>
				  					            </span>
				  					          <?php endif; ?>
				  				</td>
				  			</tr>
				  			<tr>
				  				<th style="border-color: #dee2e6">
				  					<label class="control-label" for="introduce_phone">パスワード再入力してください</label> 
				  				</th>
				  				<td>
				  					<?php echo form_password(array('name' => 'users_retype_new_password', 'id' => 'users_retype_new_password', 'class'=>'form-control', 'value' => set_value('users_retype_new_password'), 'autocomplete' => 'off')); ?>
				  					          
				  					          <?php if (form_error('users_retype_new_password')) : ?>
				  					            <span class="help-block">
				  					              <?php echo form_error('users_retype_new_password'); ?>
				  					            </span>
				  					          <?php endif; ?>
				  				</td>
				  			</tr>
				  			
				  			<tr>
				  				<td colspan="2">
				  					<center>
				  						<button type="submit" class="btn btn-default" style="background-color: green; color: white; font-size: 22px; width: 100px;">登録</button>
				  						<button style="font-size: 22px; width: 100px;" id="" name="close_introduce_screen" class="btn btn-warning new_member_reg_form_close">戻る</button>
				  					</center>
				  					
				  				</td>
				  				
				  			</tr>
				  		</table>
				  	</fieldset>
				  	</form>
		  	</div>
		</div>

		<div class="card d-none member_item col-md-10" style="position: fixed; right: 100px; bottom: 10px; padding: 4px; background: #FFFF99; min-height: 600px;">
		  	<div class="card-body">
		  		<div class="col-md-12">
		  			<button class="btn btn-info float-right" id="close_member_item">戻る</button>
		  			<br>
		  		</div>
		  		<div class="col-md-12">
		  			<p style="font-size: 22px;" class="float-left">
		  				明細画面。。。
		  			</p>
		  		</div>
		    	<div class="clearfix"></div>
		  	</div>
		</div>	

		<!-- Card Stared -->
		<div class="card report_period_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-check row">
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
			$(document).mouseup(function (e){
				var new_member_registration_screen = $(".new_member_registration_screen");
				var hide_enter_outside = $(".screen_message");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');            
				}
				if (!new_member_registration_screen.is(e.target) && new_member_registration_screen.has(e.target).length === 0)
				{
				    new_member_registration_screen.removeClass('d-block').addClass('d-none');            
				}
				var hide_enter_outside = $(".member_item");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');            
				}
			});

			$("#close_scerren_message").click(function(event) {
				event.preventDefault();
				$(".screen_message").removeClass('d-block').addClass('d-none');
			});

			$(".member_name").click(function(event) {
				event.preventDefault();
				$(".member_item").removeClass('d-none').addClass('d-block');
			});

			$("#close_member_item").click(function(event) {
				event.preventDefault();
				$(".member_item").removeClass('d-block').addClass('d-none');
			});

			// $(".month").click(function(event) {
			// 	event.preventDefault();
			// 	alert("Okay");
			// });

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
			}).on("changeMonth", function (date) {  
				var currMonth = new Date(date.date).getMonth() + 1; 
				var currYear = String(date.date).split(" ")[3];
				// alert(currYear);
				// alert(currMonth);        
	            // var fuldate = date.getDate();
	            // alert(date.date);
	            get_company_member_list(currYear+'-'+currMonth);
				// var yearRes = fuldate.split("年");
				// var monthRes = yearRes[1].split("月");
	        });

			$("#select_month_datepicker").change(function(event) {
				var fuldate = $(this).val();
				var yearRes = fuldate.split("年");
				var monthRes = yearRes[1].split("月");
				$("#show_dateSetting").text(monthRes[0]+'月1日～'+monthRes[0]+'月末日');
				
			});

			$('input#month_wise').datepicker({
				format: 'yyyy年mm月',
				viewMode: "months",
				minViewMode: "months",
				autoclose: true,
				todayHighlight: false,
				orientation: "auto",
			})

			$('.input-daterange input').each(function() {

			    $(this).datepicker({
					format: 'yyyy年mm月d日',
					autoclose: true,
					todayHighlight: false,
					orientation: "auto",
				});
			});

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
				$(".report_period_screen").removeClass('d-block').addClass('d-none');
				var month_wise = $("#month_wise").val();
				var exploadYear = String(month_wise).split("年");
				var exploadMonth = String(exploadYear[1]).split("月");
				var sorting = $("input:checked").val();
				var base_url = $("#base_url").val();

				if (sorting == 'month_wise' && month_wise !="") {
					$("#csv_download").attr('href', base_url+'main_controller/download_member_point/null/'+exploadYear[0]+'-'+exploadMonth[0]);

					$("#show_dateSetting").text(exploadYear[0]+'年の'+exploadMonth[0]+'月1日～'+exploadMonth[0]+'月末日');
					get_company_member_list(exploadYear[0]+'-'+exploadMonth[0]);
				}else if (sorting == 'date_range') {
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
						if (start_year[0]==end_year[0]) {
							$("#show_dateSetting").text(start_year[0]+'年の'+start_month[0]+'月'+dateOnly[0]+'日～'+end_month[0]+'月'+end_dateOnly[0]+'日');
						}else{
							$("#show_dateSetting").text(start_year[0]+'年の'+start_month[0]+'月'+dateOnly[0]+'日～'+end_year[0]+'年の'+end_month[0]+'月'+end_dateOnly[0]+'日');
						}
						get_company_member_list(start_year[0]+'-'+start_month[0]+'-'+dateOnly[0], end_year[0]+'-'+end_month[0]+'-'+end_dateOnly[0]);

					}
				}else{
					$("#csv_download").attr('href', base_url+'main_controller/download_member_point/null/all');
					$("#show_dateSetting").text("すべてのレポート");
					get_company_member_list('all');
				}

				
			});
			get_company_member_list()
			function get_company_member_list(month = null, end_date = null) {
				
				var base_url = $("#base_url").val();
				if (month != null && month !='all') {
					// console.log(month);
					var res = month.split("-");
					if (res[1].length<2) {
						var mon = '0'+res[1]
						month = res[0]+'-'+mon
					}
				}

				$.ajax({
					url: base_url+'main_controller/get_company_member',
					type: 'post',
					data: {month: month, end_date: end_date}
				})
				.done(function(data) {
					// console.log(data);
					// return false;
					var response = JSON.parse(data);
					var htmlData = "";
					if (response.members.length>0) {
						htmlData += '<thead>';
						htmlData += '<tr>';
							htmlData += '<th width="5%">加盟企業</th>';
							htmlData += '<th>会員</th>';
							htmlData += '<th colspan="2">商品売上金額</th>';
							htmlData += '<th colspan="2" style="border-right: 6px double black">チャリン<sup>２</sup></th>';
							htmlData += '<th colspan="2">加盟企業 </th>';
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
							var temp_member_point = response.members[i].temp.user_point== null? 0:Math.floor(response.members[i].temp.user_point);
							var temp_jafa_point = response.members[i].temp.jafa_point== null? 0:Math.floor(response.members[i].temp.jafa_point);

							// Permanent Points
							var perm_order_amount = response.members[i].perm.order_amount == null? 0:response.members[i].perm.order_amount;
							var perm_point_amount = response.members[i].perm.point_amount == null? 0:response.members[i].perm.point_amount;
							var perm_company_point = response.members[i].perm.company_point == null? 0:Math.floor(response.members[i].perm.company_point);
							var perm_member_point = response.members[i].perm.user_point == null? 0:Math.floor(response.members[i].perm.user_point);
							var perm_jafa_point = response.members[i].perm.jafa_point == null? 0:Math.floor(response.members[i].perm.jafa_point);


							
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
								htmlData += '<td><a class="member_purchase_list" href="'+base_url+'purchase_list/'+response.members[i].user_id+'/'+month+'/'+end_date+'">'+response.members[i].fullname+'</a></td>';
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
					$("#company_member_list").html(htmlData);
					console.log(response);
					console.log("success");
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			}
			// $("#member_reg_form").ajaxSubmit({url: $("#base_url").val()+'main_controller/add_new_member', type: 'post'})

			$("#new_member_reg_btn").click(function(event) {
				$('.new_member_registration_screen').removeClass('d-none').addClass('d-block');
			});

			$('.new_member_reg_form_close').click(function(event) {
				event.preventDefault();
				$('.new_member_registration_screen').removeClass('d-block').addClass('d-none');
			});

			$(document).on("click",".member_purchase_list",function(event) {
				event.preventDefault()
				var url = $(this).attr('href');
				window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width=1200,height=700");
			});

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
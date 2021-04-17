<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/dist/css/bootstrap.css">
		
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css"> -->

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
					
					<button  onclick="$('input#select_month_datepicker').focus()" style="background-color: #FFC000; border: 2px solid green;" class="btn btn-default btn-sm">期間</button>
					: <span id="show_dateSetting">
						<?php echo date('m月'). date('1日').'～'.date('m月末日'); ?>
					</span>
					<input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker">
				</div>
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				<h4 class="float-right">
					[Temporary Balance: <span id="temp_balance"></span>]
					[Permanent Balance: <span id="perma_balance"></span>]
				</h4>
				<table class="table table-bordered" style="font-size: 26px; border: 3px solid blue;">
					<thead>
						<tr>
							<th>会員 (Member)</th>
							<th>トラッキングID (TrackingID)</th>
							<th>Point Type</th>
							<th>金額 (Order Amount)</th>
							<!-- <th>Point Amount (チャリン<sup>２</sup>)</th> -->
							<th width="12%">Company Point</th>
							<th width="14%"> Member Point</th>
							<th>合計 Sub Total</th>
							<!-- <th>Balance</th> -->
							<th width="25%">備考 (Remarks)</th>
							<th>Updated at</th>

						</tr>						
					</thead>
					<tbody id="company_member_list">
						<tr>
							<th colspan="10">
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
	</div>
	<input type="hidden" id="base_url" name="base_url" value="<?= base_url() ?>">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/bootstrap/dist/js/bootstrap.js"></script>
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
			});
			$(document).mouseup(function (e){
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

			$(".editable_field").change(function(event) {
				event.preventDefault();
				var a_shop = $('#a_shop').val();
				var a_purcheger = $("#a_purcheger").val();
				var b_shop = $('#b_shop').val();
				var b_purcheger = $("#b_purcheger").val();
				var c_shop = $('#c_shop').val();
				var c_purcheger = $("#c_purcheger").val();
				var d_shop = $('#d_shop').val();
				var d_purcheger = $("#d_purcheger").val();

				var a_total_margin = parseInt(a_shop) +parseInt(a_purcheger);
				var b_total_margin = parseInt(b_shop) +parseInt(b_purcheger);
				var c_total_margin = parseInt(c_shop) +parseInt(c_purcheger);
				var d_total_margin = parseInt(d_shop) +parseInt(d_purcheger);
				$("#a_total_margin").text(a_total_margin);
				$("#b_total_margin").text(b_total_margin);
				$("#c_total_margin").text(c_total_margin);
				$("#d_total_margin").text(d_total_margin);
				$("#grand_total").text(a_total_margin+b_total_margin+c_total_margin+d_total_margin);
				$("#all_shop_total").text(parseInt(a_shop)+parseInt(b_shop)+parseInt(c_shop)+parseInt(d_shop));
				$("#all_purch_total").text(parseInt(a_purcheger)+parseInt(b_purcheger)+parseInt(c_purcheger)+parseInt(d_purcheger));
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
			get_company_member_list()
			function get_company_member_list() {
				var base_url = $("#base_url").val();
				$.ajax({
					url: base_url+'main_controller/get_company_point',
					type: 'GET'
				})
				.done(function(data) {
					var response = JSON.parse(data);
					console.log(response);
					// return false;
					var tblHtml = "";
					var total_amount = 0;
					var total_shop_point = 0;
					var total_member_point = 0;
					var total_temp_bal = 0;
					var total_perma_bal = 0;
					for (var i = 0; i < response.length; i++) {
						var point_amount = parseInt(response[i].company_point);
						// alert(point_amount);
						var member_point = parseInt(response[i].user_point);

						total_amount += parseInt(response[i].order_amount);
						total_shop_point += point_amount;
						total_member_point += member_point;						
						var balace = 0;
						
						if (response[i].is_temporary == 2) {
							balace = (parseInt(response[i].permanent_balance)*75)/100;
							total_per_bal =balace;
						}else{
							balace = (parseInt(response[i].temporary_balance)*75)/100;
							total_tem_bal =balace;
						}
						var point_type = "Temporary";
						
						if (response[i].is_temporary == 2) {
							point_type = "Permanent";
							total_perma_bal += point_amount;
						}else if (response[i].is_temporary) {
							total_temp_bal += point_amount;
						}
						tblHtml += '<tr>';
							tblHtml += '<td>'+response[i].fullname+'</td>'
							tblHtml += '<td>'+response[i].tracking_id+'</td>'
							tblHtml += '<td>'+point_type+'</td>'
							tblHtml += '<td class="text-right">'+parseInt(response[i].order_amount).toLocaleString('en')+'</td>';							
							tblHtml += '<td class="text-right">'+point_amount.toLocaleString('en')+'</td>'
							tblHtml += '<td class="text-right">'+member_point.toLocaleString('en')+'</td>'
							tblHtml += '<td class="text-right">'+(point_amount+member_point).toLocaleString('en')+'</td>';
							// tblHtml += '<td class="text-right">'+balace+'</td>';
							tblHtml += '<td class="text-right"></td>';
							tblHtml += '<td class="text-right">'+response[i].updated_at+'</td>';
						tblHtml += '<tr>';
					}
					// alert(total_perma_bal);
					$("#perma_balance").html(total_perma_bal);
					$("#temp_balance").html(total_temp_bal);
					tblHtml += '<tr style="background-color: yellow;">';
					tblHtml += '<th class="text-right" colspan="3">計</th>';
					tblHtml += '<th class="text-right">'+total_amount.toLocaleString('en')+'</th>';
					tblHtml += '<th class="text-right">'+total_shop_point.toLocaleString('en')+'</th>';
					tblHtml += '<th class="text-right">'+total_member_point.toLocaleString('en')+'</th>';
					tblHtml += '<th class="text-right">'+(total_member_point+total_shop_point).toLocaleString('en')+'</th>';
					// tblHtml += '<th class="text-right">'+total_tem_bal+'/'+total_per_bal+'</th>';
					tblHtml += '<th class="text-right"></th>';
					tblHtml += '<th class="text-right"></th>';
					tblHtml += '</tr>';
					$("#company_member_list").html(tblHtml);
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
	</script>
</body>
</html>
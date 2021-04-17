<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/dist/css/bootstrap.css">
		
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
				<!-- 会員別ポイント計算書　一覧表 -->
				履歴
			</div>
			<div class="col-md-6" style="font-size: 28px;">
				<button class="btn btn-danger btn-lg float-right" onclick="window.close();" id="" style="margin-right: 10px;"><i class="fa fa-user-plus"></i> 戻る</button>
				<!-- <a href="member_point" class="btn btn-secondary btn-lg float-right" style="margin-right: 10px;">Your Point</a> -->
				
			</div>
			<div class="col-md-12">
				<div class="float-right" style="font-size: 26px; padding-bottom: 10px;">
					
					<button id="report_period" class="btn btn-warning btn-lg">期間</button>
					: <span id="show_dateSetting">
						<?= $report_lenght; ?>
						<!-- <?php echo date('m月'). date('1日').'～'.date('m月末日'); ?> -->
					</span>

					<input style="margin-top: 20px; position: fixed; border:none; width: 1px; height: 1px;"  id="select_month_datepicker">
				</div>
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				<table class="table table-bordered" style="font-size: 26px; border: 3px solid blue;">
					<thead>
						<tr>
							<th nowrap="nowrap">サイト名</th>
							<!-- <th nowrap="nowrap">トラッキングＩＤ</th> -->
							<!-- <th nowrap="nowrap">単価</th> -->
							<th nowrap="nowrap">商品売上金額</th>
							<th nowrap="nowrap">チャリン<sup>2</sup></th>
							<th nowrap="nowrap">購入日時</th>
							<th nowrap="nowrap">成果承認日</th>
							<!-- <th nowrap="nowrap">紹介料率</th>
							<th nowrap="nowrap">紹介料</th> -->
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
								<td><?= $shop  ?></td>
								<!-- <td><?= $purchase->tracking_id ?></td> -->
								<td><?= $purchase->order_amount ?></td>
								<td><?= $purchase->point_amount ?></td>
								<td><?= $purchase->order_date ?></td>
								<td><?= $purchase->perm_processing_date ?></td>
								<!-- <td><?= $purchase->user_percentage ?>%</td>
								<td><?= floor($purchase->user_point) ?></td> -->
							</tr>

							<?php
						}
						?>

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
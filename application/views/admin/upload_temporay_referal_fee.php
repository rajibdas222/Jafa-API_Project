<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		$this->load->view('admin/components/head');
	?>
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
	<?php
		$this->load->view('admin/components/header');
	?>
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">

			<div class="col-md-12">
				<a class="btn btn-danger btn-lg float-right" style="margin-bottom: 5px" href="<?= base_url() ?>admin/company_category">戻る</a>
			</div>
			<div class="col-md-4 offset-md-4" style="margin-top: 20px;">
				<?php
				if ($this->session->flashdata('log_data')) :	
				$upload_logs = $this->session->flashdata('log_data');
				$head = "Success";
				if ($upload_logs['error'] == 1) {
					$head = "Waring";
				}
				// print_r($upload_logs['message'])
				?>
				<div class="alert alert-<?= ($upload_logs['error'] == 1)? 'warning':'success' ?> alert-dismissible fade show" role="alert">
					<h3><?= $head ?></h3>
				  <strong>Logs!</strong> <?= $upload_logs['message'] ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<?php
			endif;
				?>

				<form class="form-horizontal" action="<?= base_url() ?>main_controller/save_referal_fee" method="post" name="upload_excel" enctype="multipart/form-data">
				  
			  	  <div class="form-group">
			  	    <label for="type">サイト名</label>
			  	    <select required name="shop_id" class="browser-default custom-select mb-4" id="select">
			              <option value="" disabled="" selected="">サイトを選択</option>
			              <option value="1">アマゾン</option>
			              <option value="2">ヤフー</option>
			              <option value="3">楽天</option>
			          </select>
			  	  </div>
				  <div class="form-group">
				    <label for="file">紹介料ファイルのアップロード</label>
				    <input required="required" type="file" name="file" id="file" class="input-large">
				  </div>			  
				  
				  <button type="submit" name="Import" class="btn btn-primary btn-lg">送信</button>
				  <br>
				  <a style="margin-top: 10px; width: 400px; text-align: center;" href="<?= base_url() ?>uploads/amazon-1563415500070-Fee-Earnings-5a487626-fe30-41ff-b66f-780a545a5398-XLSX - Fee-Earnings.csv" download class="btn btn-info btn-lg"><i class="fa fa-download"></i> アマゾンのサンプルファイルをダウンロードする</a>
				  <br>
				  <a style="margin-top: 10px; width: 400px; text-align: center;" href="<?= base_url() ?>uploads/YahooSample20200210.csv" download class="btn btn-info btn-lg"><i class="fa fa-download"></i> ヤフーのサンプルファイルをダウンロードする</a>
				  <br>
				  <a style="margin-top: 10px; width: 400px; text-align: center;" href="<?= base_url() ?>uploads/report-payment-result-20200813133323.csv" download class="btn btn-info btn-lg"><i class="fa fa-download"></i> 楽天のサンプルファイルをダウンロードする</a>
				</form>
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
						<center><p style="font-size: 24px;">サイトを選択し、ファイルを選択して<br>「送信」を押してください。</p>	</center>
						<center>
							<button id="coo" class="btn btn-warning btn-lg close_case_message">確認</button>
						</center>

					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Card Ended  -->
		
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

			$(document).delegate('.editable_field', 'change', function(event) {
				event.preventDefault();
				var base_url = $("#base_url").val();
				var member_com_id = $(this).attr('data-attr-member-id');
				var field_name = $(this).attr('data-attr-member-field_name');
				var percentage = $(this).val();
				var total_val = 75;
				var member_parcentage = 0;
				var com_parcentage = 0;
				if (field_name == 'com_mar') {
					com_parcentage = percentage;
					member_parcentage = (total_val - percentage);
				}else{
					member_parcentage = percentage
					com_parcentage = (total_val - percentage);;
				}
				// alert(com_parcentage);
				// alert(member_parcentage);
				// console.log(member_com_id);
				// console.log(field_name);
				// return false;
				if (member_com_id !=='') {
					
					if (member_com_id!="") {
						$.ajax({
							url: base_url+'main_controller/save_percentage',
							type: 'POST',
							data: {company_id: member_com_id, com_mar_percentage:com_parcentage, member_mar_percentage:member_parcentage},
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
				$.get(base_url+'main_controller/get_company_summary', function(data) {
					var response = JSON.parse(data);
					
					var tableHtml = '';
					if (response.all_company.length>0) {
						var total_sales_amount = 0;
						var item_sales_amount = 0;
						var total_charin = 0;
						var com_total = 0;
						var member_total = 0;
						var com_member = 0;
						var chalin_two = 0;
						var service_total = 0;
						for (var i = 0; i < response.all_company.length; i++) {
							// console.log();
							// return false;
							// console.log(response.all_company[i].major_company);
							item_sales_amount = response.all_company[i].item_sales_amount;
							chalin_two = response.all_company[i].chalin_two;
							if (item_sales_amount==null) {
								item_sales_amount = 0;
							}
							if (chalin_two ==null) {
								chalin_two = 0;
							}
							var com_mar = 75;
							var member_mar = 0;
							if (response.all_company[i].com_mar > 0) {
								com_mar = response.all_company[i].com_mar;
								member_mar = response.all_company[i].member_mar;
							}
							// if (response.all_company[i].com_mar > 0 && response.all_company[i].member_mar == 0) {
							// 	member_mar = (75-com_mar);
							// }

							// member_mar = 75-com_mar;

							var service_amount = ((chalin_two*25)/100);
							service_total += service_amount;
							if (response.all_company[i].major_company == 0) {
								
								total_sales_amount += parseInt(item_sales_amount);
								total_charin += parseInt(chalin_two);
								com_total += ((parseInt(chalin_two)*com_mar)/100);
								member_total += ((parseInt(chalin_two)*member_mar)/100);
								com_member += ((parseInt(chalin_two)*(parseInt(com_mar)+parseInt(member_mar)))/100);
								tableHtml += '<tr>';
								
								tableHtml += '<td><a class="company_member_list"  style="text-decoration: underline;" href="'+response.all_company[i].user_id+'">'+response.all_company[i].company_name+'</a></td>';

								tableHtml += '<td class="text-right">'+addCommas(item_sales_amount)+'</td>'
								tableHtml += '<td style="border-right: 6px double black" class="text-right">'+addCommas(chalin_two)+'</td>'
								tableHtml += '<td class="text-right"><div style="width:100px; padding:0;" class="col-sm-11 float-left"><input type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="com_mar" id="a_purcheger" maxlength="3" name="a_purcheger" class="text-right editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+com_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								tableHtml += '<td class="text-right">'+Math.floor(((chalin_two*com_mar)/100)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right"><div style="width:100px; padding:0;" class="col-sm-11 float-left"><input type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="member_mar" id="a_purcheger" maxlength="3" name="a_purcheger" class="text-right editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+member_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								tableHtml += '<td class="text-right">'+Math.floor(((chalin_two*member_mar)/100)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+(parseInt(com_mar)+parseInt(member_mar))+'%</td>';
								tableHtml += '<td class="text-right">'+Math.floor(((chalin_two*((parseInt(com_mar)+parseInt(member_mar))))/100)).toLocaleString('en')+'</td>';
								tableHtml += '<td style="border-left: 6px double black" class="text-right">'+(25)+'%</td>';
								tableHtml += '<td class="text-right">'+Math.floor(service_amount)+'</td>';
								tableHtml += '</tr>';
							}else{
								total_sales_amount += parseInt(response.all_company[i].item_sales_amount);
								total_charin += parseInt(response.all_company[i].chalin_two);
								var jacos_count = ((response.all_company[i].chalin_two*50)/100);
								
								com_total += jacos_count;
								com_member += jacos_count;
								// console.log(total_25);
								// total_25 += ((response.jacos.chalin_two*25)/100);;

								var total_25_jacos50 = (com_total+jacos_count);
								tableHtml += '<tr class="bg-primary text-light">';

								tableHtml += '<td><a class="text-light company_member_list"  style="text-decoration: underline;" href="'+response.all_company[i].user_id+'">'+response.all_company[i].company_name+'</a></td>';

								tableHtml += '<td class="text-right">'+addCommas(item_sales_amount)+'</td>'
								tableHtml += '<td style="border-right: 6px double black" class="text-right">'+addCommas(chalin_two)+'</td>'
								tableHtml += '<td class="text-right"><div style="width:100px; padding:0;" class="col-sm-11 float-left"><input type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="com_mar" id="a_purcheger" maxlength="3" name="a_purcheger" class="text-right text-light editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+com_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								tableHtml += '<td class="text-right">'+Math.floor(((chalin_two*com_mar)/100)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right"><div style="width:100px; padding:0;" class="col-sm-11 float-left"><input type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="member_mar" id="a_purcheger" maxlength="3" name="a_purcheger" class="text-right text-light editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+member_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								tableHtml += '<td class="text-right">'+Math.floor(((chalin_two*member_mar)/100)).toLocaleString('en')+'</td>';
								tableHtml += '<td class="text-right">'+(parseInt(com_mar)+parseInt(member_mar))+'%</td>';
								tableHtml += '<td class="text-right">'+Math.floor(((chalin_two*((parseInt(com_mar)+parseInt(member_mar))))/100)).toLocaleString('en')+'</td>';
								tableHtml += '<td style="border-left: 6px double black" class="text-right">'+(100-(parseInt(com_mar)+parseInt(member_mar)))+'%</td>';
								tableHtml += '<td class="text-right">'+Math.floor(service_amount)+'</td>';
								tableHtml += '</tr>';
							}						
						}

						
						tableHtml += '<tr style="background-color: yellow;"><th>計</th><th class="text-right">'+total_sales_amount.toLocaleString('en')+'</th>	<th style="border-right: 6px double black" class="text-right" id="all_purch_total">'+Math.floor(total_charin).toLocaleString('en')+'</th>';
						tableHtml += '<th>&nbsp</th>';
						tableHtml += '<th class="text-right">'+Math.floor(com_total).toLocaleString('en')+'</th>';
						tableHtml += '<th>&nbsp</th>';
						tableHtml += '<th class="text-right">'+Math.floor(member_total).toLocaleString('en')+'</th>';
						tableHtml += '<th>&nbsp</th>';
						
						
						tableHtml += '<th style="border-right: 6px double black" class="text-right">'+Math.floor(com_member).toLocaleString('en')+'</th>';
						
						tableHtml += '<th></th>';
						tableHtml += '<th class="text-right">'+Math.floor(service_total).toLocaleString('en')+'</th>';
						tableHtml += '</tr>';
						
						$( "#member_company_list" ).html( tableHtml );
					}
					
				});
			}

			
			get_all_member_company()

			$(document).mouseup(function (e){
				var hide_enter_outside = $(".product_case_message");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');
				}
			});

			$(".close_case_message").click(function(event) {
				event.preventDefault();
				$(".product_case_message").removeClass('d-block').addClass('d-none'); 
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
					var response = JSON.parse(data);
					console.log(response.company_details);	
					var com_mar = parseInt(response.company_details.com_mar);
					var member_mar = parseInt(response.company_details.member_mar);
					var total_commition = com_mar+member_mar;
					var service_charge = 100-total_commition;

					var htmlData = "";
					if (response.members.length>0) {
						htmlData += '<thead>';
						htmlData += '<tr>';
							htmlData += '<th width="5%">加盟企業</th>';
							htmlData += '<th>会員</th>';
							htmlData += '<th>商品売上金額</th>';
							htmlData += '<th style="border-right: 6px double black">チャリン<sup>２</sup></th>';
							htmlData += '<th>加盟企業 ('+com_mar+'%)</th>';
							htmlData += '<th>会員計 ('+member_mar+'%)</th>';
							htmlData += '<th style="border-right: 6px double black">支払計 ('+(total_commition)+'%)</th>';
							htmlData += '<th>当社粗利 ('+service_charge+'%)</th>';
						htmlData += '</tr>';
						htmlData += '</thead>';
						htmlData += '<tbody>'
						htmlData += '<tr>'
							htmlData += '<td style="vertical-align: middle; text-align: center;" width="30%" rowspan="'+(response.members.length+1)+'">'+response.company_details.fullname+'</td>'
						htmlData += '</tr>'
						var total_charin = 0;
						var total_amount = 0;
						var total_25 = 0;
						var total_50 = 0;
						var total_75 = 0;
						var total_service_charge = 0;
						for (var i = 0; i< response.members.length; i++) {
							// console.log(response[i].total_salse_amount);
							var item_sales_amount = response.members[i].total_salse_amount;
							if (item_sales_amount==null) {
								item_sales_amount = 0;
							}
							var chalin_two = response.members[i].chalin_two;
							if (chalin_two==null) {
								chalin_two = 0;
							}
							total_25 += ((chalin_two*com_mar)/100);
							total_50 += ((chalin_two*member_mar)/100);
							total_75 += (chalin_two*total_commition)/100;
							total_charin += parseInt(chalin_two);
							total_amount += parseInt(item_sales_amount);
							total_service_charge += (chalin_two*service_charge)/100;
							htmlData += '<tr>';
								htmlData += '<td><a class="member_purchase_list" href="'+base_url+'purchase_list/'+response.members[i].user_id+'">'+response.members[i].fullname+'</a></td>';
								htmlData += '<td style="text-align: right;">'+parseInt(item_sales_amount).toLocaleString('en')+'</td>';
								htmlData += '<td style="text-align: right; border-right: 6px double black; text-align:right;">'+chalin_two+'</td>';
								htmlData += '<td style="text-align: right">'+((chalin_two*com_mar)/100)+'</td>';
								htmlData += '<td style="text-align: right">'+((chalin_two*member_mar)/100)+'</td>';
								htmlData += '<td style="text-align: right; border-right: 6px double black">'+((chalin_two*total_commition)/100)+'</td>';
								htmlData += '<td style="text-align: right">'+((chalin_two*service_charge)/100)+'</td>';
							htmlData += '</tr>';
						}
						htmlData += '<tr style="background-color: yellow;"><th>計</th><th class="text-right"></th><th class="text-right">'+total_amount.toLocaleString('en')+'</th>	<th style="border-right: 6px double black" class="text-right" id="">'+total_charin+'</th><th class="text-right">'+total_25.toFixed(2)+'</th><th class="text-right">'+total_50.toFixed(2)+'</th><th style="border-right: 6px double black" class="text-right">'+total_75.toFixed(2)+'</th><th class="text-right">'+total_service_charge.toFixed(2)+'</th>						</tr>';
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
				window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=20,width=1200,height=700");
			});
			
		});
	</script>
</body>
</html>
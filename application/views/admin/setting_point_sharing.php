<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
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
				<a class="btn btn-danger btn-sm float-right" style="margin-bottom: 5px" href="<?= base_url() ?>admin/company_category">戻る</a>
			</div>

			<div class="col-md-12" style="margin-top: 20px;">
                <div class="card-header text-center" style="font-size: 1.5rem;">
                    全体のポイント計算
                </div>
				<table class="table table-bordered table-striped" style="font-size: 26px; border: 3px solid blue;">
					
					<thead>
						<tr>
							<th colspan="5">
								<h4 style="text-align: left;">手数料率</h4>
							</th>
							
						</tr>
						<tr>
							<th style="vertical-align: middle;">加盟企業名</th>							
							<th>加盟企業 (%)</th>
							<th>会員(%)</th>
							<th style="border-right: 6px double black;">支払計</th>
							<th>当社粗利</th>
							
						</tr>						
					</thead>
					<tbody id="member_company_list">
						<th colspan="11">
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
						<p><center style="font-size: 24px;">加盟企業の手数料率の設定ができます</center>　
						</p>

						<center>
							<button id="close_case_message" id="coo" class="btn btn-warning btn-lg">確認</button>
						</center>

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
					<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">
					戻る
					</button>
				</div>
				<div class="modal-body">
					<!-- 明細画面。。。 -->
					<table class="table table-striped" id="company_member_details" style="background-color: white">
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

	<?php
		$this->load->view('admin/components/footer');
	?>
	

	
	<script>

		
		jQuery(document).ready(function($) {
			
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
							get_all_member_company();
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
				$.get(base_url+'main_controller/get_setting_point_sharing', function(data) {
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
							
							var com_mar = 75;
							var member_mar = 0;
							if (response.all_company[i].com_mar !="") {
								com_mar = response.all_company[i].com_mar;
								member_mar = response.all_company[i].member_mar;
							}
							var readonly = "";
							var title = "";
							if (response.all_company[i].major_company == 0) {
								
								total_sales_amount += parseInt(item_sales_amount);
								total_charin += parseInt(chalin_two);
								com_total += ((parseInt(chalin_two)*com_mar)/100);
								member_total += ((parseInt(chalin_two)*member_mar)/100);
								com_member += ((parseInt(chalin_two)*(parseInt(com_mar)+parseInt(member_mar)))/100);

								

								if(response.all_company[i].user_id==107){
									readonly = "readonly";
									title = "変わりません";
								}
								tableHtml += '<tr>';
								
								// tableHtml += '<td><a class="company_member_list"  style="text-decoration: underline;" href="'+response.all_company[i].user_id+'">'+response.all_company[i].company_name+'</a></td>';
								tableHtml += '<td>'+response.all_company[i].company_name+'</td>';

								
								tableHtml += '<td class="text-right"><div style="width:200px; padding:0;" class="col-sm-11 float-left"><input '+readonly+' title="'+title+'" type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="com_mar" id="" maxlength="3" name="" class="text-right editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+com_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								
								tableHtml += '<td class="text-right"><div style="width:200px; padding:0;" class="col-sm-11 float-left"><input '+readonly+' title="'+title+'" type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="member_mar" id="" maxlength="3" name="" class="text-right editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+member_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								
								tableHtml += '<td class="text-right">'+(parseInt(com_mar)+parseInt(member_mar))+'%</td>';
								
								tableHtml += '<td style="border-left: 6px double black" class="text-right">'+(100-(parseInt(com_mar)+parseInt(member_mar)))+'%</td>';
								
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

								// tableHtml += '<td><a class="text-light company_member_list"  style="text-decoration: underline;" href="'+response.all_company[i].user_id+'">'+response.all_company[i].company_name+'</a></td>';
								// if(response.all_company[i].user_id==32){
									readonly = "readonly";
									title = "変わりません";
								// }
								tableHtml += '<td>'+response.all_company[i].company_name+'</td>';
								
								tableHtml += '<td class="text-right"><div style="width:200px; padding:0;" class="col-sm-11 float-left"><input '+readonly+' title="'+title+'" type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="com_mar" id="" maxlength="3" name="" class="text-right text-light editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+com_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								
								tableHtml += '<td class="text-right"><div style="width:200px; padding:0;" class="col-sm-11 float-left"><input '+readonly+' title="'+title+'" type="text" data-attr-member-id="'+response.all_company[i].user_id+'" data-attr-member-field_name="member_mar" id="" maxlength="3" name="" class="text-right text-light editable_field member_chalin_two_'+response.all_company[i].user_id+'" value="'+member_mar+'"></div><div class="col-sm-1 float-left text-left" style="padding-left:0;padding-top:3px;">%</div></td>';
								
								tableHtml += '<td class="text-right">'+(parseInt(com_mar)+parseInt(member_mar))+'%</td>';
								
								tableHtml += '<td style="border-left: 6px double black" class="text-right">'+(100-(parseInt(com_mar)+parseInt(member_mar)))+'%</td>';
								
								tableHtml += '</tr>';
							}						
						}
						
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
</body>
</html>
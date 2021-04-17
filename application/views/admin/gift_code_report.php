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
				<a class="btn btn-danger btn-lg float-right" style="margin-bottom: 5px" href="<?= base_url() ?>admin/company_category">戻る</a>
			</div>
			<div class="col-md-4 offset-md-4 p-2">
				<h4 class="float-left" style="text-align: left;">アマゾンギフトコードリポート</h4>
				
			</div>

			<!-- Start Search Form -->
			<div class="col-md-4 offset-md-4 p-2">

				<form method="GET">
					<div class="form-group row">
						<label for="username" class="form-control-label col-md-3">ユーザー名</label>
						<div class="col-md-9">
							<input type="text" value="<?= $username ?>" class="form-control" name="username">
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" name="search" class="btn btn-primary btn-lg">検索</button>
						</div>
					</div>
					
				</form>
			</div>

			<!-- End Report sarch form -->
			<?php
			if ($this->input->get('username')) {
			
			?>
			<div class="col-md-12" style="margin-top: 20px;">
				<table class="table table-bordered table-striped" style="font-size: 26px; border: 3px solid blue;">					
					<thead>
						<tr>
							<th>#</th>
							<th>年月日</th>
							<th>ユーザー名</th>							
							<th>ギフト券番号</th>
							<th>金額</th>
						</tr>					
					</thead>
					<tbody id="member_gift_list">
						<?php
						$i = 0;
						if (!empty($gift_codes)) {
						foreach ($gift_codes as $key => $code) {
							$i++;
							?>
							<tr>
								<!-- <td><?= $code->fullname ?></td> -->
								<td class="text-center"><?= $i ?></td>
								<td class="text-center"><?= $code->use_date ?></td>
								<td class="text-center"><?= $code->fullname.' ('.$code->username.')' ?></td>
								<td class="text-center"><?= $code->gift_code ?></td>
								<td class="text-right"><?= number_format($code->price_amount) ?></td>
							</tr>
							<?php
						}
					}else{
						?>
						<tr>
							<th colspan="5" class="text-center">
								データが見つかりませんでした
							</th>
						</tr>
						<?php
					}

					?>
						
					</tbody>
				</table>  
			</div>	
			<?php
		}
			?>	   	
		</div>

		<!-- Card Stared -->
		<div class="card col-md-5 col-sm-12" id="product_case_message" style="background-color: #DAEEF3; border: 2px solid #486994; border-radius: 10px; position: fixed; max-width: 450px;
right: 10px;
bottom: 10px;
padding: 4px;">
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12">
						
						<p><center style="font-size: 24px;">
							<?php
							if ($this->input->get('username')) {
								echo "ギフト券の使用状況です";								
							}else{
								echo "ユーザー毎の状況を検索できます。";
							}
							?>
						</center></p>
						<center>
							<button id="close_case_message" style="margin: 0px; background-color: #FFFF99; border: 2px solid green" id="coo" class="btn btn-default btn-lg">確認</button>
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

		    $("#datepicker").datepicker({
		    	format: 'yyyy年mm月d日',
		    	autoclose: true,
		    	todayHighlight: false,
		    	orientation: "auto",
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
						//console.log("success");
						console.log(resData);
					} else {
						$("#unit_name").val('');
						//console.log("success");
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
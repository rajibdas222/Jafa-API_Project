<!DOCTYPE html>
<html lang="en">
<head>
	<?php
		$this->load->view('admin/components/head');
	?>
</head>
<body">
	<?php
		$this->load->view('admin/components/header');
	?>
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<a class="btn btn-primary btn-lg" href="<?= base_url() ?>admin/balance_sheet/add">新しい入金金額</a>
					<a class="btn btn-danger btn-lg" style="margin-bottom: 5px" href="<?= base_url() ?>admin/company_category">戻る</a>
				</div>
				
			</div>
			<div class="col-sm-12">
				<h3 class="float-left">サイト入金金額</h3>
				
				<?php
				if ($this->session->flashdata('success')) {
					?>
					<br>
					<br>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>
					  	<?php echo $this->session->flashdata('success'); ?>
					  </strong>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<?php
				}
				?>
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th class="text-center">サイト名</th>
								<th class="text-center">入金予定</th>
								<th class="text-center">入金済</th>
								<th class="text-center">入金残</th>
								<th class="text-center">入金日</th>
								<!-- <th class="text-center">交換合計</th>
								<th class="text-center">バランス</th> -->
								<th class="text-center">履歴</th>
							</tr>							
						</thead>
						<tbody>
							<tr>
								<?php
									$this->db->select('jafa_balance_sheet.payment_date');
									$this->db->where('shop_id', 1);
									$this->db->order_by('bal_id', 'desc');
									$last_trn = $this->db->get('jafa_balance_sheet')->row();
								?>
								<td>アマゾン</td>
								<td class="text-right">
								<?php
										$this->db->select_sum('point_amount');
										$this->db->where('shop_id', 1);
										// $this->db->where("amazon_per_date <=", date('Y-m-d' strtotime($last_trn->payment_date)));
										$this->db->where('amazon_per_date <=', $last_trn->payment_date);
										$total_receivable = $this->db->get('point')->row();
										// echo $this->db->last_query();
										echo number_format($total_receivable->point_amount);
									?>
								</td>
								<td class="text-right">
									<?php
									$amazon_balance = $this->balance_model->get_balance_by_shop_id(1);
									echo number_format($amazon_balance->amount);
									?>
								</td>
								<td class="text-right">
									<?= number_format($total_receivable->point_amount-$amazon_balance->amount) ?>
								</td>
								<td class="text-center">
								<?php								
								echo $last_trn->payment_date?></td>
								<!-- <td class="text-right">
									<?php
									// $amazon_excenge = $this->balance_model->get_total_gift_amount();
									// echo number_format($amazon_excenge->price_amount);
									?>
								</td> -->
								<!-- <td class="text-right"><?= number_format($amazon_balance->amount - $amazon_excenge->price_amount) ?></td> -->
								<td>
									<a href="<?= base_url() ?>admin/balance_sheet/history/1" class="btn btn-secondary btn-lg"> <i class="fa fa-database"></i> 詳細</a>
								</td>
							</tr>
							<tr>
								<td>ヤフー</td>
								<td class="text-right">0</td>
								<td class="text-right"><?php
									$yahoo_balance = $this->balance_model->get_balance_by_shop_id(2);
									echo number_format($yahoo_balance->amount);
									?></td>
								<td class="text-right">0</td>
								<td class="text-center">-</td>
								<!-- <td class="text-right">0</td>
								<td class="text-right">0</td> -->
								<td>
									<a href="<?= base_url() ?>admin/balance_sheet/history/2" class="btn btn-secondary btn-lg"> <i class="fa fa-database"></i> 詳細</a>
								</td>
							</tr>
							<tr>
								<td>楽天</td>
								<td class="text-right">0</td>
								<td class="text-right">
									<?php
									$rakuten_balance = $this->balance_model->get_balance_by_shop_id(3);
									echo number_format($rakuten_balance->amount);
									?>
								</td>
								<td class="text-right">0</td>
								<td class="text-center">-</td>
								<!-- <td class="text-right">0</td>
								<td class="text-right">0</td> -->
								<td>
									<a href="<?= base_url() ?>admin/balance_sheet/history/3" class="btn btn-secondary btn-lg"> <i class="fa fa-database"></i> 詳細</a>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr style="background-color: yellow;">
								<th class="text-right">合計</th>
								<th class="text-right"><?= number_format($total_receivable->point_amount); ?></th>								
								<th class="text-right"><?= number_format($amazon_balance->amount+$yahoo_balance->amount+$rakuten_balance->amount) ?></th>
								<th class="text-right">
								<?= number_format($total_receivable->point_amount-$amazon_balance->amount) ?>
								</th>
								<th class="text-right">-</th>
								<!-- <th class="text-right"><?= number_format($amazon_excenge->price_amount); ?></th>
								<th class="text-right"><?= number_format($amazon_balance->amount - $amazon_excenge->price_amount) ?></th> -->
								<th>-</th>
							</tr>
						</tfoot>
					</table>
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
						<center><p style="font-size: 24px;">サイト毎の入金額です。<br>「新しい入金金額」を押して、入力してください。</p>	</center>
						<center>
							<button class="btn btn-warning btn-lg close_case_message">確認</button>
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

			$(".close_case_message").click(function(event) {
				$(".product_case_message").removeClass('d-block').addClass('d-none');  
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



						
		});
	</script>
</body>
</html>
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
		table th, table td{
			font-size: 18px;
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
				<div class="float-right">
					<a class="btn btn-primary btn-lg" href="<?= base_url() ?>admin/gift_code/add">ギフト券追加</a>
					<a class="btn btn-danger btn-lg" style="margin-bottom: 5px" href="<?= base_url() ?>admin/company_category">戻る</a>
					
				</div>
				
			</div>
			<div class="col-md-12">
				<h4 class="float-left" style="text-align: left;">アマゾンギフトコード</h4>
				
			</div>
			<div class="col-md-12" style="margin-top: 20px;">
				

				<?php
				if ($this->session->flashdata('success_delete')) {
					?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
					  <strong>Success!</strong> 
					  <?php
					  	echo $this->session->flashdata('success_delete')
					  ?>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<?php
				}
				?>

				<table class="table table-striped table-bordered" style="border: 3px solid red;">
					<?php
					$this->db->select_sum('price_amount');
					$total_amount = $this->db->get('jafa_gift_code')->row(); 
					$this->db->select_sum('price_amount');
					$uesed_amount = $this->db->where('status', 1)->get('jafa_gift_code')->row();   
					
					?>
					<tr>
						<thead>
							<tr>
								<th colspan="6"><h3>サマリー</h3></th>
							</tr>
						</thead>
					</tr>
					<tr>
						<th class="text-right">ギフト券合計金額</th>
						<th class="text-left"><?= number_format($total_amount->price_amount); ?></th>
						<th class="text-right">ギフト券使用金額</th>
						<th class="text-left"><?= number_format($uesed_amount->price_amount); ?></th>
						<th class="text-right">残りのギフト券合計</th>
						<th class="text-left"><?= number_format($total_amount->price_amount-$uesed_amount->price_amount) ?></th>
					</tr>
				</table>

				<table class="table table-bordered table-striped" style="font-size: 26px; border: 3px solid blue;">					
					<thead>
						<tr>
							<th>#</th>
							<th style="vertical-align: middle;">メールアドレス</th>
							
							<th>ギフトコード№</th>
							<th>金額</th>							
							<th>有効期限</th>
							<th>シリアル№</th>
							<th>使用日</th>
							<th>使用状況</th>
							<!-- <th>-</th> -->
						</tr>					
					</thead>
					<tbody id="member_gift_list">
						<?php
						$i = 0;
						foreach ($gift_codes as $key => $code) {
							$i++;
							?>
							<tr>
								<td><?= $i ?></td>
								<td class="text-center"><?= $code->email ?></td>
								<td class="text-center"><?= $code->gift_code ?></td>
								<td class="text-right"><?= number_format($code->price_amount) ?></td>
								<!-- <td class="text-right"><?= number_format($code->converted_point) ?></td>								 -->
								<td class="text-center"><?= $code->expire_date ?></td>
								<td class="text-center"><?= $code->sl_number ?></td>
								<td class="text-center"><?= $code->use_date ?></td>
								<td class="text-center bg-<?= $code->status==0? "success":"danger" ?> text-white"><?= $code->status == 0? "未使用":"使用済" ?></td>
								<!-- <td>
									<?php
									if ($code->status != NULL) {
										?>
										<a href="<?= base_url() ?>admin/gift_code/delete_gift_code/<?= $code->gift_id ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> 削除する</a>
										<?php
									}
									?>
									
								</td> -->
							</tr>
							<?php
						}
						?>
						
					</tbody>
				</table>  
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
						<center><p style="font-size: 24px;">アマゾンギフトの使用状況です。<br>
追加する場合は「ギフト券追加」<br>
を押してください。</p>	</center>
						<center>
							<button id="coo" class="btn btn-warning btn-lg close_case_message">確認</button>
						</center>

					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- Card Ended  -->
		
		<!-- Card Ended  -->
		<div class="modal fade member_accounts_detail" id="member_accounts_detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg">
		    <div class="modal-content"  style="background: #FFFF99; min-height: 600px; width: 1250px;">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">明細画面。。。</h5>
					<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
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

			
			
		});
	</script>
</body>
</html>
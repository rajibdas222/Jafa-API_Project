<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>resources/bootstrap/dist/css/bootstrap.css">
		
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
			<!-- <div class="col-sm-2"> -->
				<?php
				// $fullname = "";
				// if ($this->authentication->is_signed_in()) {
				// 	$fullname = $account_details->fullname;
				// }
				?>
				<!-- <a href="<?= base_url('account/account_profile') ?>" style=" font-size: 26px; text-decoration: underline; color: #000;"> <?= $fullname ?></a><span style="font-size: 26px"> 様</span> -->
			<!-- </div> -->
			<div class="col-md-6" style="font-size: 32px;">
				加盟店REFARAL
			</div>
			<div class="col-md-6" style="font-size: 28px;">
				
				<a href="admin_company_point" class="btn btn-danger btn-lg float-right" id="" style="margin-right: 10px;"><i class="fa fa-user-plus"></i> 戻る</a>
				
			</div>
			
			<div class="col-md-12" style="margin-top: 20px;">
				<table class="table table-bordered" style="font-size: 26px; border: 3px solid blue;">
					<thead>
						<tr>
							<th>加盟店名</th>
							<th>加盟店コード</th>
							<th nowrap="nowrap">リンクURL</th>
						</tr>						
					</thead>
					<tbody id="">
						<?php
						// print_r($members);
						$i = 0;
						foreach ($company_list as $key => $company) {
							$refferal_link = 'https://jafa.testing.dev.jacos.jp/?refaral='.$company->tracking_id
							?>
							<tr>
								<td><?= $company->company_name ?></td>
								<td>
									<?= $company->tracking_id?>
								</td>
								<td><?= $refferal_link?></td>
								
								
							</tr>

							<?php
						}
						?>

					</tbody>
					
				</table>  
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


		});
	</script>
</body>
</html>
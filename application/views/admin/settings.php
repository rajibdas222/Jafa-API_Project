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
					
					<!-- <a class="btn btn-primary btn-lg" href="<?= base_url() ?>admin/gift_code">ギフト券一覧</a> -->
					<a class="btn btn-danger btn-lg" style="margin-bottom: 5px" href="<?= base_url() ?>admin/company_category">戻る</a>
				</div>
				
			</div>
			<div class="col-md-6 offset-md-3">
				<h3>アマゾンのAPIを使用した商品検索設定とテスト</h3>
				<p>
					<a href="https://webservices.amazon.com/paapi5/documentation/search-items.html" target="_blank">アマゾンのドキュメントリンク</a>
				</p>
				
			</div>

		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3 p-2">
			<hr>
				<form method="get" action="<?= base_url() ?>admin/settings#search_result">
					
					<!-- <div class="form-group row">
						<label class="form-control-label col-md-3">アプリケーションID</label>
						<div class="col-md-9">
							  <input type="text" name="appid" required="required" value="dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-" readonly class="form-control" >
						</div>
					</div> -->
					<div class="form-group row">
						<label class="form-control-label col-md-3">商品キーワード</label>
						<div class="col-md-9">
							<input type="text" name="query" placeholder="商品名入力（バーコードが無い場合）" required="required" value="<?= (!empty($query))? $query: "コーラ" ?>" class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">商品状態の指定 (Condition Parameter)</label>
						<div class="col-md-9">
							<div class="radio">
							    <label for="condition-0">
							      <input type="radio" <?= (!empty($condition) && $condition=='Any')? 'checked': "checked" ?>  name="condition" id="condition-0" value="Any" >
							      Any
							    </label>
							</div>
							<div class="radio">
							    <label for="condition-1">
							      <input type="radio" <?= (!empty($condition) && $condition=='New')? 'checked': "" ?> name="condition" id="condition-1" value="New">
							     	New
							    </label>
							</div>
							<div class="radio">
							    <label for="condition-2">
							      <input type="radio" <?= (!empty($condition) && $condition=="Used")? 'checked': "" ?> name="condition" id="condition-2" value="Used" >
							      Used
							    </label>
							</div>
							<div class="radio">
							    <label for="condition-3">
							      <input type="radio" <?= (!empty($condition) && $condition=='Collectible')? 'checked': "" ?> name="condition" id="condition-3" value="Collectible">
							     	Collectible
							    </label>
							</div>
							<div class="radio">
							    <label for="condition-4">
							      <input type="radio" <?= (!empty($condition) && $condition=='Refurbished')? 'checked': "" ?> name="condition" id="condition-4" value="Refurbished">
							     	Refurbished
							    </label>
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="form-control-label col-md-3">並び順を指定 (SortBy)</label>
						<div class="col-md-9">
							<div class="radio">
							    <label for="sort-5">
							      <input type="radio" <?= (!empty($sort) && $sort=='Relevance')? 'checked': "checked" ?> name="sort" id="sort-5" value="Relevance">
							     	Relevance
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-0">
							      <input type="radio" <?= (!empty($sort) && $sort=='AvgCustomerReviews')? 'checked': "" ?>  name="sort" id="sort-0" value="AvgCustomerReviews" >
							      AvgCustomerReviews
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-1">
							      <input type="radio" <?= (!empty($sort) && $sort=='Featured')? 'checked': "" ?> name="sort" id="sort-1" value="Featured">
							     	Featured
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-2">
							      <input type="radio" <?= (!empty($sort) && $sort=='NewestArrivals')? 'checked': "" ?> name="sort" id="sort-2" value="NewestArrivals" >
							      NewestArrivals
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-3">
							      <input type="radio" <?= (!empty($sort) && $sort=='Price:HighToLow')? 'checked': "" ?> name="sort" id="sort-3" value="Price:HighToLow">
							     	Price:HighToLow
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-4">
							      <input type="radio" <?= (!empty($sort) && $sort=='Price:LowToHigh')? 'checked': "" ?> name="sort" id="sort-4" value="Price:LowToHigh">
							     	Price:LowToHigh
							    </label>
							</div>
							
						</div>

					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" name="save" value="save" class="btn btn-primary btn-lg">保存する</button>
							<button type="submit" name="save" value="test" class="btn btn-warning btn-lg">チェック</button>
							<a class="btn btn-info btn-lg" href="<?= base_url() ?>admin/settings">リセット</a>
						</div>
					</div>

				</form>
			</div>	   	
		</div>
		<?php
		if (!empty($yahoo_res)) :
		?>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered" id="search_result">
					<thead>
						<tr>
							<th colspan="2">
								<h3>検索結果</h3>
							</th>
						</tr>
						<tr>
							<th>SL</th>
							<th>商品名</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 0;
						foreach ($yahoo_res as $key => $res) {
						$i++;
						?>
						<tr>
							<td><?= $i; ?></td>
							<td>
								<a target="_blank" href="<?= $res->url?>"><?= $res->name; ?></a>
								<?php
								if ($res->janCode =="" && $res->isbn=="") {
									echo 'JANコードまたはISBNコードなし。';
								}else{
								?>
									<i class="fa fa-check text-success">displayed</i>
								<?php
								}
								?>
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
		endif;
		?>
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

			$(".close_case_message").click(function(event) {
				$(".product_case_message").removeClass('d-block').addClass('d-none'); 
			});

			var hide_enter_outside = $(".product_case_message");
			if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
			{
			    hide_enter_outside.removeClass('d-block').addClass('d-none');
			}

						
		});
	</script>
</body>
</html>
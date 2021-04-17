<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.css">
	<style type="text/css">
		.navbar-nav .nav-link{
			color: #fff !important;
			font-size: 20px;
			padding-top: 0px !important;
			padding-bottom: 0px !important;			
		}
		.navbar-nav .nav-item{
			border-right: 2px solid white;

			padding-right: .8rem !important;
	      padding-left: .8rem !important;
		}
		
	</style>
</head>
<body">
	<div class="container-fluid" style="margin-top: 20px;">
		<div class="row">
			
			<div class="col-md-6 offset-md-3">
				<h3>ヤフーのAPIを使用した商品検索設定とテスト</h3>
				<p>
					<a href="https://developer.yahoo.co.jp/webapi/shopping/shopping/v3/itemsearch.html" target="_blank">ヤフードキュメントリンク</a>
				</p>
				
			</div>

		</div>
		<div class="row">
			<div class="col-md-6 offset-md-3 p-2">
			<hr>
				<form method="get" action="test_search#search_result">
					
					<div class="form-group row">
						<label class="form-control-label col-md-3">アプリケーションID</label>
						<div class="col-md-9">
							  <input type="text" name="appid" required="required" value="dj0zaiZpPWJFTGtrNW82azBIYSZzPWNvbnN1bWVyc2VjcmV0Jng9NTk-" readonly class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">商品キーワード</label>
						<div class="col-md-9">
							<input type="text" name="query" placeholder="商品名入力（バーコードが無い場合）" required="required" value="<?= (!empty($query))? $query: "" ?>" class="form-control" >
						</div>
					</div>
					<!-- <div class="form-group row">
						<label class="form-control-label col-md-3">affiliate_type (optional)</label>
						<div class="col-md-9">
							<input type="text" name="affiliate_type" placeholder="" value="<?= (!empty($affiliate_type))? $affiliate_type: "vc" ?>" readonly class="form-control" >
						</div>
					</div> -->
					<!-- <div class="form-group row">
						<label class="form-control-label col-md-3">affiliate_id (optional)</label>
						<div class="col-md-9">
							<input type="text" name="affiliate_id" placeholder="" value="http%3A%2F%2Fck.jp.ap.valuecommerce.com%2Fservlet%2Freferral%3Fsid%3D3100635%26pid%3D882354153%26vc_url%3D" readonly class="form-control" >
						</div>
					</div> -->
					<!-- <div class="form-group row">
						<label class="form-control-label col-md-3">jan_code (optional)</label>
						<div class="col-md-9">
							<input type="text" name="jan_code" placeholder="JANコード" value="" class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">isbn (optional)</label>
						<div class="col-md-9">
							<input type="text" name="isbn" placeholder="ISBNコード" value="" class="form-control" >
						</div>
					</div>
					
					
					<div class="form-group row">
						<label class="form-control-label col-md-3">price_from (optional)</label>
						<div class="col-md-9">
							<input type="text" name="price_from" placeholder="" value="" class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">price_to (optional)</label>
						<div class="col-md-9">
							<input type="text" name="price_to" placeholder="" value="" class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">affiliate_rate_from (optional)</label>
						<div class="col-md-9">
							<input type="text" name="affiliate_rate_from" placeholder="" value="" class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">affiliate_rate_to (optional)</label>
						<div class="col-md-9">
							<input type="text" name="affiliate_rate_to" placeholder="" required="required" value="" class="form-control" >
						</div>
					</div> -->
					<div class="form-group row">
						<label class="form-control-label col-md-3">商品状態の指定 - Condition (optional)</label>
						<div class="col-md-9">
							<div class="radio">
							    <label for="radios-0">
							      <input type="radio" <?= (!empty($condition) && $condition=='new')? 'checked': "" ?> name="condition" id="radios-0" value="new" >
							      新品
							    </label>
							</div>
						 	<div class="radio">
							    <label for="radios-1">
							      <input type="radio" <?= (!empty($condition) && $condition=='used')? 'checked': "" ?> name="condition" id="radios-1" value="used">
							     	中古
							    </label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">並び順を指定 (optional)</label>
						<div class="col-md-9">
							<div class="radio">
							    <label for="sort-0">
							      <input type="radio" <?= (!empty($sort) && $sort=='-score')? 'checked': "" ?>  name="sort" id="sort-0" value="-score" >
							      -score：おすすめ順
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-1">
							      <input type="radio" <?= (!empty($sort) && $sort=='+price')? 'checked': "" ?> name="sort" id="sort-1" value="+price">
							     	+price：価格の安い順
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-2">
							      <input type="radio" <?= (!empty($sort) && $sort=='-price')? 'checked': "" ?> name="sort" id="sort-2" value="-price" >
							      -price：価格の高い順
							    </label>
							</div>
							<div class="radio">
							    <label for="sort-3">
							      <input type="radio" <?= (!empty($sort) && $sort=='-review_count')? 'checked': "" ?> name="sort" id="sort-3" value="-review_count">
							     	-review_count：商品レビュー数の多い順
							    </label>
							</div>
						</div>

					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">スタート - start (optional)</label>
						<div class="col-md-9">
							<input type="text" name="start" placeholder="" value="<?= (!empty($start))? $start: "1" ?>" class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3">結果の数 - results (optional)</label>
						<div class="col-md-9">
							<input type="text" name="results" placeholder="" required="required" value="<?= (!empty($results))? $results: "20" ?>" class="form-control" >
						</div>
					</div>
					<div class="form-group row">
						<label class="form-control-label col-md-3"></label>
						<div class="col-md-9">
							<button type="submit" name="save" value="save" class="btn btn-primary btn-lg">保存する</button>
							<button type="submit" name="save" value="test" class="btn btn-warning btn-lg">チェック</button>
							<a class="btn btn-info btn-lg" href="test_search">リセット</a>
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
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	
</body>
</html>
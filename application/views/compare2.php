<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/css/style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> -->
	<!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<script type="text/javascript">
		function trygoogle() {
		// launch pic2shop and tell it to open Google Products with scan result
			// window.location="pic2shop://scan?callback=http%3A//www.google.com/m/products%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts";
			// if ([[UIApplication sharedApplication] canOpenURL:[NSURL URLWithString:@"pic2shop:"]]) {
				var main_uri = encodeURI('https://jafa.dev.jacos.jp/compare');
				window.location="pic2shop://scan?callback="+main_uri+"%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts";
			// }else{
			// 	window.location= 'https://play.google.com/store/apps/details?id=com.visionsmarts.pic2shop';
			// }
		}
	</script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PNLHDGG');</script>
	<!-- End Google Tag Manager -->


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146142225-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-146142225-1');
	</script>

	<style type="text/css">
		.android_screen{
			/*background-image: url("resource/img/install3.gif");*/
			background-repeat: no-repeat;
			/*background-size: 100% 100%;*/
			width: 97%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}
		.android_open_screen{
			/*background-image: url("resource/img/open.jpeg");*/
			background-repeat: no-repeat;
			width: 97%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}
		.android_camera_screen{
			/*background-image: url("resource/img/camera.jpeg");*/
			background-repeat: no-repeat;
			background-size: 100% 100%;
			width: 97%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}

		/*iPhone Screen*/
		.iphone_browsing_screen{
			/*background-image: url("resource/img/IMG-9229.JPG");
			background-repeat: no-repeat;*/
			background-size: 100% 100%;
			width: 99%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}

		.iphone_install_screen{
			/*background-image: url("resource/img/IMG-9230.JPG");
			background-repeat: no-repeat;*/
			background-size: 100% 100%;
			width: 99%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}
		.iphone_open_screen{
			/*background-image: url("resource/img/IMG-9231.JPG");
			background-repeat: no-repeat;*/
			background-size: 100% 100%;
			width: 99%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}
		.iphone_camera_screen{
			/*background-image: url("resource/img/IMG-9232.JPG");
			background-repeat: no-repeat;*/
			background-size: 100% 100%;
			width: 99%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}
		.iphone_jafa_screen{
			/*background-image: url("resource/img/IMG-9234.JPG");
			background-repeat: no-repeat;*/
			background-size: 100% 100%;
			width: 99%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}
		.iphone_last_screen{
			/*background-image: url("resource/img/IMG-9235.JPG");
			background-repeat: no-repeat;*/
			background-size:99% 100%;
			width: 99%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #f9def9;
		}

		.introduce_screen{
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
		}

		/*the container must be positioned relative:*/
		.autocomplete {
		  position: relative;
		  display: inline-block;
		}

		.autocomplete-items {
		  position: absolute;
		  border: 1px solid #d4d4d4;
		  border-bottom: none;
		  border-top: none;
		  z-index: 99;
		  top: 100%;
		  left: 0;
		  right: 0;
		}

		.autocomplete-items div {
		  padding: 10px;
		  cursor: pointer;
		  background-color: #fff; 
		  border-bottom: 1px solid #d4d4d4; 
		}

		/*when hovering an item:*/
		.autocomplete-items div:hover {
		  background-color: #e9e9e9; 
		}

		/*when navigating through the items using the arrow keys:*/
		.autocomplete-active {
		  background-color: DodgerBlue !important; 
		  color: #ffffff; 
		}
		.barcode_reading_navi{
			/*background-image: url("resource/img/IMG-9229.JPG");
			background-repeat: no-repeat;*/
			background-size: 100% 100%;
			width: 99%;
			height: 100%;
			position: fixed;
			right: 0px;
			bottom: 0px;
			padding: 4px;
			border: 2px solid green;
			background-color: #FFFF99;
		}
		
		.introduce_screen .form-group{
			margin-bottom: .5rem;
		}

		.jafa_btn{
			background-color: #F7C3C7;
			color: black;
		}
		.voice_product_select{
			cursor: pointer;
		}
		.voice_product_select:hover{
			background-color: #FFF0E4;
			/*font-weight: bold;*/
		}
	</style>
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PNLHDGG"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
		$search_barcode = "";
		if (isset($_GET['ean'])) {
			$search_barcode = $_GET['ean'];
			// echo "Barcode is: ".$search_barcode;
		}elseif (isset($_GET['q'])) {
			$search_barcode = $_GET['q'];
		}
	?>
	<div style="width: 0; height: 0; overflow: hidden;">
	  <iframe id="launch_frame" name="launch_frame"></iframe>
	</div>
	<?php
	$role_id = NULL;
	if (!empty($account_role)) {
		$role_id = $account_role->role_id;
	}
	?>
	<input type="hidden" id="get_janCode" value="<?= $search_barcode ?>" name="get_janCode">
	<input type="hidden" id="tracking_id" value="<?= $tracking_id ?>" name="tracking_id">
	<input type="hidden" id="charin_pint" value="<?= $charin_pint ?>" name="">
	<input type="hidden" id="role_id" value="<?= $role_id ?>" name="">
	<div class="container-fluid">
		<div class="main_border">
			<div class="row">
				<div id="scanner-container" style="position: fixed; left: 0; top: 0; padding: 5px; z-index: 100;">
					
				</div>
				<input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>">
				<div class="col-md-2 account_profile">
					<?php
					$fullname = "";
					if ($this->authentication->is_signed_in()) {
						$fullname = $account_details->fullname;
						?>
						<a href="<?= base_url('account/account_profile') ?>" style="  text-decoration: underline;text-decoration-color: #FFF0E4; color: #000;"> <?= $fullname ?></a><span> 様</span>
						<?php
					}else{
					?>
					<span style="border-bottom: 1px solid #FFF0E4; width: 100px;" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
					<span class="text-right"> 様</span>
					<?php
					}
					?>
					
				</div>
				<div class="col-md-8">
					<p class="app-title">ダブルポイント案内</p>
					<button class="btn btn-default btn_link btn-lg" style="font-size: 26px; margin-bottom: 10px;">チャリン<sup>２</sup></button>
					<div class="row">
						<div class="col-md-6">
							<!-- <img src="resources/img/logo.png"> -->
							
							<p class="heading2-box" style="padding: 5px; border:1px red solid;">

								このサイトで購入すると、<br>① ショップポイントに加え、当社ポイント、<span style="color: #ff8507; font-weight: bold;">チャリン<sup>2</sup></span> が付きますので、<br>&nbsp&nbsp&nbsp 一層お得です。 <br>
								② 配送料の関係もあり、一つのサイトで連続して <br>&nbsp&nbsp&nbsp&nbsp購入できます。それらには全てダブルポイントが付きます。
							</p>
						</div>
						<div class="col-md-6">
							<!-- <p class="pl-1">
								このサイトで購入すると、<br>① ショップポイントに加え <br>
								②当社ポイント、<span style="color: #ff8507; font-weight: bold;">チャリン<sup>2</sup></span> が付きますので、一層お得です。
							</p>
							<hr style="border-color:red;"> -->
							<p class="heading2-box" style=" border:1px red solid; padding: 5px;">
								<span class="" style="color: #ff8507; font-weight: bold;">ショールーミング</span> <br>
								家電やドラッグ・・・・などの店で、スマホ撮影して <br>
								価格比較できます。
							</p>
							
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-2">
					
					
					<?php
					if (!$this->authentication->is_signed_in()) {?>
						<button class="btn btn-default btn-lg float-right text-center customer_reg_btn jafa_btn" id="customer_reg_btn" style="font-size: 24px; width: 226px; margin-bottom: 10px;">新規登録</button>
					<span class="clearfix"></span>

					<button class="btn btn-default btn-lg float-right text-center user_login_btn jafa_btn" id="user_login_btn" style="width: 226px;font-size: 24px;margin-bottom: 10px;">ログイン</button>
						<span class="clearfix"></span>

						

						<?php
					}else{
						// if ($account_role->role_id == 3 || $account_role->role_id == "") {?>

							<!-- <a href="member_point">My Point</a> -->
							<?php
						// }
						?>

						
							<a href="<?= base_url() ?>account/sign_out" class="btn btn-default btn-lg float-right text-center jafa_btn" id="" style="width: 226px;font-size: 24px;margin-bottom: 10px;">ログアウト</a>
						<span class="clearfix"></span>
							<button class="btn btn-default btn-lg float-right text-center change_password jafa_btn" id="change_password" style="width: 226px;font-size: 24px;margin-bottom: 10px;">パスワード変更</button>
						<span class="clearfix"></span>
						<?php
					}
					?>
					<button class="btn btn-default btn-lg float-right text-center jafa_btn" id="introduce_btn" style="width: 226px;font-size: 24px;margin-bottom: 10px;">紹介・問い合わせ</button>
				</div>   
			</div>
			
			<div class="row second-box" id="second-box">
				<div class="col-md-9 pdding-zero">
					<!-- <form class="form-inline" action="false"> -->
						<legend class=""><strong style="font-size: 30px;">価格比較</strong></legend>
						<div class="form-group col-sm-12" style="margin-bottom: 5px; padding: 0;">
							
							<label class="float-left" for="barcode" style="font-size: 22px; margin-right: 10px;">商品検索<br>最安値 </label>
							<button id="barcode_reading_btn" style="background: #CCFF99; color: red; border: 1px solid green;" type="button" class="btn btn-default btn-sm float-right mobile_show">バーコードリーダーを<br> 
							インストールします。
							</button>
							<!-- <button class="btn-default btn_link btn-lg play_scaner" type="button" data-toggle="modal" data-target="#livestream_scanner" style="">スマホでバーコードを撮影</button> -->
							<button id="barcode_scanning" class="btn-default btn_link btn-lg play_scaner mobile_show col-sm-12" type="button" style="">スマホでバーコードを撮影<br><img style="padding: 5px; width: 140px; height: 70px; margin-left: 5px;" src="resources/img/barcode.png"></button>
							<button id="start-record-btn" style="margin: 5px 0; font-size: 26px;" class="btn btn-default jafa_btn btn-lg microphone microphone_btn_mobile col-sm" type="button"><i id="microphone" class="fa fa-microphone"></i> 音声検索 <span class="second_countdown">2:00</span> </button>

							<div  style="padding: 0" class="input-group col-sm-6 barcod_input_right float-left">
								<!-- <input type="text" style="" class="form-control-lg barcod_input_right" id="product_keyword3" value="<?= $search_barcode ?>" placeholder="商品名か？バーコード入力か？" name=""> -->
							  <input type="text" id="product_keyword3" class="form-control" placeholder="商品名か？バーコード入力か？" aria-label="Recipient's username" value="<?= $search_barcode ?>" aria-describedby="basic-addon2">
							  <div class="input-group-append">

							    <span class="input-group-text" id="clean_product_name" style="padding: 2px;"><i class="fa fa-window-close fa-3x"></i></span>
							  </div>
							</div>			
							<button id="start-record-btn" style="margin-left: 5px; font-size: 26px;" class="btn btn-default jafa_btn btn-lg microphone microphone_btn" type="button" style=""><i id="microphone" class="fa fa-microphone"></i> 音声検索 <span class="second_countdown">2:00</span> </button>
							<button style="margin-left: 5px; font-size: 26px;" class="btn btn-default btn-lg jafa_btn" id="point_table_btn">ポイント残高</button>
							<?php
							if (!empty($account_role) && $account_role->role_id == 1) {
								?>
								<button style="margin-left: 5px; font-size: 26px;" id="purchase_history" class="btn btn-default btn_link btn-lg jafa_btn">履歴</button>
								<?php
							}elseif (!empty($account_role) && $account_role->role_id == 2) {
								?>
								<button style="margin-left: 5px; font-size: 26px;" id="purchase_history" class="btn btn-default btn_link btn-lg jafa_btn">履歴</button>
								<?php
							}else{
							?>
							<button style="margin-left: 5px; font-size: 26px;" id="purchase_history" class="btn btn-default btn_link btn-lg jafa_btn">履歴</button>
							<?php
							}
							?>

						</div>

						<!-- <div class="form-group col-sm-12 col-md-2" style="margin-bottom: 0; padding: 0">
							<center><label for="inputBarcodeQR" onclick="barcodeScanning()" id="inputBarcodeQR"><img style="padding: 5px; width: 140px; height: 70px; margin-left: 5px;" src="resources/img/barcode.png"> </label></center>
							

						</div> -->
					<!-- </form> -->
						<div class="form-group input_fields col-sm-12" style="padding: 0">	
							<!-- <input type="text" class="form-control-lg barcod_input_left" id="product_bardcode" placeholder="ジャンル" name="">	 -->				
							
							<!-- <div class="autocomplete"> -->
								<!-- <input type="text" class="form-control-lg barcod_input_middle" autocomplete="off" id="search_product_name" placeholder="商品名" name="search_product_name"> -->
							    <!-- <input id="myInput" type="text" name="myCountry" placeholder="Country"> -->
							<!-- </div>
												 -->
							
							<?php
							// if ( $this->authentication->is_signed_in()):
							
							?>
							<!-- <button type="button" class="btn btn-default btn-lg" id="management_tbl_btn" style="background-color: #007E12; color: white; margin-left: 5px; font-size: 26px;">管理画面</button> -->
							<?php
							// endif;
							?>
						</div>
				</div>
				<div class="col-md-3 text-center product_image_parent d-none">
					<h5 class="search_result"></h5>
					<div class="product_image" id="product_image">
							
					</div>
								
				</div>				
				
				<div class="col-md-12 affiliate_list table-responsive" id="affiliate_list" style="">					
					
					<table class="table compare_table" style="background: white; font-size: 22px;">
						<thead>
							<tr>
								<th colspan="5" style="padding: 0; border:1px solid white;">
									<table class="table product_name_table" style="margin: 0; border: 1px solid black; 
									border-collapse: separate;
									border-spacing: 10px;
								border-top-left-radius: 10px;
								border-top-right-radius: 10px;">
										<tbody style="margin: 0; padding: 0;">
											<tr>
												<td style="border: 1px solid white;" id="jan_product_name">
													&nbsp
												</td>
											</tr>
										</tbody>
										
									</table>
								</th>
							</tr>

						</thead>
						<tbody id="comparing_table">
							<tr>
								<th class="align-middle text-center" nowrap>順位</th>
								<th class="align-middle text-center" nowrap>ショップ名</th>
								<th class="align-middle text-center" style="background-color: #FFF0E4" nowrap>実質<br>価格</th>
								<th class="align-middle text-center" nowrap>価格</th>
								<th nowrap class="align-middle text-center" nowrap>ショップ<br>ポイント</th>
								<th nowrap class="align-middle text-center"  style="background-color: #FFF0E4" nowrap>チャリン<sup>2</sup><br>ポイント</th>
								
								<th style="border-top-right-radius: 10px;" class="align-middle text-center" nowrap>サイト</th>
							</tr>
							<?php
							for ($i=0; $i < 3; $i++) { ?>
								<tr>
									<td class="text-center" style="vertical-align: middle;"><?= $i+1; ?>位</td>
									<td>&nbsp <!-- <button class="profite_tabel_btn btn btn-default btn_link btn-lg">アマゾン</button> --> </td>
									<td class="text-center" style="background-color: #FFF0E4" id="amazon_realPrice">&nbsp</td>
									
									<td class="text-center point_details">&nbsp</td>
									<td class="text-center">&nbsp</td>
									<td class="text-center" style="background-color: #FFF0E4">&nbsp</td>
									
									<td class="text-center"><button class="btn btn-default btn_link btn-lg jafa_btn">サイトへ</button></td>
								</tr>
								<?php
							}
							?>
							
							<!-- <tr>
								<td class="text-center" style="vertical-align: middle;">2位</td>
								<td style="">&nbsp</td>
								<td class="text-center" style="background-color: #FFF0E4" id="rakuten_realprice"> &nbsp</td>
								
								<td class="text-center point_details">&nbsp</td>
								<td class="text-center"><span id="rakuten_pointRate">&nbsp</span></td>
								<td class="text-center"  style="background-color: #FFF0E4"><span id="rakuten_chalinPoint">&nbsp</span> </td>
								
								<td class="text-center"><button class="btn btn-default btn_link btn-lg" style="background-color: red; color: white;">サイトへ</button></td>
							</tr>
							<tr>
								<td class="text-center" style="vertical-align: middle;">3位</td>
								<td style="">&nbsp</td>
								<td class="text-center" id="yahoo_realPrice" style="background-color: #FFF0E4">&nbsp</td>
								
								<td class="text-center"><span id="yahoo_reviewCount">&nbsp</span></td>
								<td class="text-center" id="yahoo_shopPoint">&nbsp</td>
								<td class="text-center" id="yahoo_chalinPoint" style="background-color: #FFF0E4">&nbsp</td>
								
								<td class="text-center"><button class="btn btn-default btn_link btn-lg" style="background-color: red; color: white;">サイトへ</button></td>
							</tr>
							<tr>
								<td class="text-center" style="vertical-align: middle;">4位</td>
								<td style="">&nbsp</td>
								<td class="text-center" id="yahoo_realPrice" style="background-color: #FFF0E4">&nbsp</td>
								
								<td class="text-center"><span id="yahoo_reviewCount">&nbsp</span></td>
								<td class="text-center" id="yahoo_shopPoint">&nbsp</td>
								<td class="text-center" id="yahoo_chalinPoint" style="background-color: #FFF0E4">&nbsp</td>
								
								<td class="text-center"><button class="btn btn-default btn_link btn-lg" style="background-color: red; color: white;">サイトへ</button></td>
							</tr> -->
							<tr>
								<th colspan="2" class="text-right" style="border-bottom-left-radius: 10px;">全体</th>
								<td class="text-center" style="background-color: #FFF0E4">ー</td>
								<td class="text-center">ー</td>
								<td class="text-center">&nbsp</td>
								<td class="text-center"  style="background-color: #FFF0E4">ー</td>
								
								<td class="text-center">ー</td>
							</tr>
						</tbody>
					</table>
				</div>
								
			</div>
			<div class="container compare_table_padding clearfix">
				<div class="row">
				       
				    <div class="table-responsive" style="padding: 0px; border: 2px solid red;">
				        <table class="table table-bordered compare_table_mobile" style="margin-bottom: 0px;">
				        
				        
				        <thead>
				            <tr>
				                <th colspan="2"><span id="jan_product_name2"></span></th>
				            </tr>

				        </thead>
				        <tbody class="mobile_compare_table d-block" id="mobile_compare_table" style="">
				        	<tr>
				        		<th nowrap class="align-middle text-center" style="border-left: 0; border-top:0; background-color: #FFEFFF; border-top-left-radius:20px;">ショップ</th>
				        		<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0; background-color: #CCFFCC;">実質価格</th>
				        		<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0;background-color: #FFEFFF; ">価格</th>
				        		<th style="background-color: #FFEFFF; " nowrap class="align-middle text-center">ショップP</th>
				        		<th style=" background-color: #CCFFCC; " nowrap class="align-middle text-center">チャリン<sup>2</sup>P</th>
				        		<th style="background-color: #FFEFFF; border-top-right-radius:20px; " nowrap class="align-middle text-center">サイト</th>
				        	</tr>
				        	<?php
				        	for ($i=1; $i <4 ; $i++) { 
				        		
				        	?>
				        	<tr>
				        		<td style="border-left: 0; border-bottom: <?= ($i==10)?'0;':'' ?>"><?= $i; ?> 位</td>
				        		<td style=" background-color: #CCFFCC;"></td>
				        		<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
				        		<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
				        		<td style="border-bottom: <?= ($i==10)?'0;':'' ?>; background-color: #CCFFCC;"></td>
				        		<td style="border-right: 0; border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
				        		<?php
				        		if ($i==1) {?>

				        		<?php
				        		}
				        		?>
				        		
				        	</tr>
				        	<?php
				        	}
				        	?>
				            
				        </tbody>
				    </table>
				            
				</div>
			</div>
			<!------ </.row-------->
			</div><!------ </.container-------->
			<div class="row second-box d-none" style="padding: 0;">
				<!-- <div class="card " > -->
					<div class="table-responsive" style="padding: 0px; border: 2px solid red;">
						<table class="table" style="margin-bottom: 0; ">
								<style type="text/css">
									#lowest_ten_table td, #lowest_ten_table th{
										border: 1px solid black;
									}
									/*table { border-collapse: separate; }*/
									/*td { border: solid 1px #000; }
									tr:first-child td:first-child { border-top-left-radius: 10px; }
									tr:first-child td:last-child { border-top-right-radius: 10px; }
									tr:last-child td:first-child { border-bottom-left-radius: 10px; }
									tr:last-child td:last-child { border-bottom-right-radius: 10px; }*/
								</style>
							<thead class="lowest_ten_head">
								<tr class="">
									<th nowrap class="align-middle text-center" style="border-left: 0; border-top:0; background-color: #FFEFFF; border-top-left-radius:20px;">ショップ</th>
									<!-- <th nowrap colspan="2" class="align-middle text-center">販売店（ショップ名)</th> -->
									
									<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0; background-color: #CCFFCC;">実質価格</th>
									<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0;background-color: #FFEFFF; ">価格</th>
									<th style="background-color: #FFEFFF; " nowrap class="align-middle text-center">ショップP</th>
									<th style=" background-color: #CCFFCC; " nowrap class="align-middle text-center">チャリン<sup>2</sup>P</th>
									<th style="background-color: #FFEFFF; border-top-right-radius:20px; " nowrap class="align-middle text-center">サイト</th>
									
								</tr>
							</thead>
							<tbody id="lowest_ten_table">
								
								<?php
								for ($i=1; $i <11 ; $i++) { 
									
								?>
								<tr>
									<td style="border-left: 0; border-bottom: <?= ($i==10)?'0;':'' ?>"><?= $i; ?> 位</td>
									<!-- <td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td> -->
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>; background-color: #CCFFCC;"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>; background-color: #CCFFCC;"></td>
									<td style="border-right: 0; border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<?php
									if ($i==1) {?>
										<!-- <td  style="border-right: 0;" width="25%" rowspan="10" class="align-middle text-center"></td> -->
									<?php
									}
									?>
									
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
				<!-- </div> -->
				
			</div>

			<div class="card d-none product_infor_card" style="position: fixed; right: 30px; bottom: 10px; padding: 4px; background: #DBEEF4;">
			  	<div class="card-body">
			    	<p style="font-size: 22px;">商品名　：スコッティ　カシミヤ　440枚（220組）WHITE １個 900円</p>
			    	<button class="btn btn-default btn_link btn-lg float-right btn-close" style="margin: 10px;">完了（確定）</button>
			    	<a href="member_margine" class="btn btn-default btn_link btn-lg float-right" style="margin: 10px;">購入</a>
			    	
			  	</div>
			</div>
			<!-- <div class="card d-block screen_message" style="">
			  	<div class="card-body">
			    	<p style="">			    		
			    		１、価格比較する場合は、バーコード撮影を押してください。
			    		<br>
			    		２、価格の比較しない場合は、ショップ名を押してください。
			    	</p>
			  	</div>
			</div> -->
			
			<div class="card d-none point_details_table col-md-10" style="position: fixed; right: 100px; bottom: 10px; padding: 4px; min-height: 600px;">
			  	<div class="card-body">
			  		<div class="col-md-12">
			  			<h3 class="float-left">アマゾン</h3>
			  			<button class="btn btn-warning float-right btn-lg" id="close_point_detail">戻る</button>
			  			<br>
			  		</div>
			  		<div class="col-md-12">
			  			<table class="table table-bordered table-striped table-hover">
			  				<thead>
			  					<tr>
			  						<th>氏名</th>
			  						<th class="text-center">評価</th>
			  						<th colspan="2">内容</th>
			  					</tr>
			  				</thead>
			  				<tbody>
			  					<tr>
			  						<td>Aさん</td>
			  						<td class="text-center">1</td>
			  						<td>かけた瞬間人工的な甘い香りがして徐々に消　　</td>
			  						<td><a href="#">続きを読む</a>	</td>
			  					</tr>
			  					<tr>
			  						<td>Bさん　</td>
			  						<td class="text-center">2</td>
			  						<td>かけた直後はいいが、ちょっと時間が経つと</td>
			  						<td><a href="#">続きを読む</a>	</td>
			  					</tr>
			  					<tr>
			  						<td>Cさん</td>
			  						<td class="text-center">2</td>
			  						<td>１０分程度、香りが残り鼻にきます。</td>
			  						<td><a href="#">続きを読む</a>	</td>
			  					</tr>
			  					<tr>
			  						<td>Dさん</td>
			  						<td class="text-center">2</td>
			  						<td>コロンコロンとコケるから気を使う。何着も</td>
			  						<td><a href="#">続きを読む</a>	</td>
			  					</tr>
			  					<tr>
			  						<td>Eさん</td>
			  						<td class="text-center">3</td>
			  						<td>。。。。。。。。。。。。。。。。。。。。。。。。。。。。</td>
			  						<td><a href="#">続きを読む</a></td>
			  					</tr>
			  					<tr>
			  						<td>Fさん</td>
			  						<td class="text-center">4</td>
			  						<td>。。。。。。。。。。。。。。。。。。。。。。。。。。。。</td>
			  						<td><a href="#">続きを読む</a>	</td>
			  					</tr>
			  					<tr>
			  						<td>Gさん</td>
			  						<td class="text-center">5</td>
			  						<td>。。。。。。。。。。。。。。。。。。。。。。。。。。。。　　</td>
			  						<td><a href="#">続きを読む</a>	</td>
			  					</tr>
			  					<tr>
			  						<td>Hさん</td>
			  						<td class="text-center">5</td>
			  						<td>。。。。。。。。。。。。。。。。。。。。。。。。。。。。　　</td>
			  						<td><a href="#">続きを読む</a>	</td>
			  					</tr>
			  				</tbody>
			  			</table>
			  			<!-- <p>頭の２０文字を表示　→　「続きを読む」を押すと、全文を表示する</p> -->
			  		</div>
			    	<div class="clearfix"></div>
			  	</div>
			</div>
			
			<div class="card user_login_option d-none" style="background: #CCFFCC;position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C;">
				<div class="card-body">					
					<button class="btn btn-danger float-right btn-sm close_loged_user_infor" id="login_option_close">戻る</button>
					<center><h4 style="padding-top: 40px; padding-bottom: 20px">選択してください。</h4></center>
					<center>
						<button class="btn btn-default user_login_btn222" attr-user-role="2" style="background-color: #FFFF99; padding: 5px 20px; width: 120px; border:2px solid #3D618C;">加盟企業</button>
						<button class="btn btn-default user_login_btn" attr-user-role="3" style="background-color:#FFCCFF; padding: 5px 20px; width: 120px;border:2px solid #3D618C;">会員</button>
						<button class="btn btn-default user_login_btn" id="management_login_btn" attr-user-role="1" style="background-color:#008000; color: white;padding: 5px 20px; width: 120px;border:2px solid #3D618C;">管理画面</button>
					</center>
				</div>
			</div>
			<div class="card point_table_aria d-none" style="background: #eee;position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C;">
				<div class="card-header">
					<div class="row">
						<div class="col-sm-8">
							<h2>ポイント残高</h2>
						</div>	
						<div class="col-sm-4">
							<button class="btn btn-danger float-right btn-lg close_loged_user_infor" id="point_table_aria_close">戻る</button>
						</div>
					</div>
				</div>
				<div class="card-body bg-white">					
					<div class="row">
						<div class="col-sm">
							<table class="table table-striped">
								<tbody id="point_table_dynamic_data">
									
								</tbody>
								
							</table>	
						</div>
						
					</div>
					<center>

						<button class="btn btn-default btn-lg jafa_btn" id="amazon_gift_pint_btn" style="font-size: 24px; width: 100%; margin-bottom: 10px;">ポイント交換</button>
						
					</center>
				</div>
			</div>

			<div class="card d-none" id="amazon_gift_pint_aria" style="background: #eee;position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C;">
				<div class="card-header">
					<div class="row">
						<div class="col-sm">
							<button class="btn btn-danger float-right btn-lg close_loged_user_infor float-right" id="amazon_gift_pint_aria_close">戻る</button>
						</div>
					</div>
				</div>
				<div class="card-body bg-white">	
					
					<div class="row">
						<div class="col-sm">
							<ul style="padding: 0">
								<ol style="padding: 0">１．メールでアマゾンギフトコードを送信します。</ol>
								<ol style="padding: 0">２．Amazonサイトで、コード番号を入力します。</ol>
								<ol style="padding: 0">３．ポイントを使って買い物ができます。</ol>
							</ul>
							<p>
								（割引きになります）
							</p>
							<div class="checkbox">
							    <label for="checkboxes-0">
							      <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1" checked>
							      <strong>アマゾンギフト券</strong> 
							    </label>
							</div>
							<!-- １．メールでアマゾンギフトコードを送信します。

							２．Amazonサイトで、コード番号を入力します。

							３．ポイントを使って買い物ができます。
							　　（割引きになります） -->
						</div>
						
					</div>
					<center>

						<button class="btn btn-default btn-lg jafa_btn" id="amazon_gift_pint_purchase_btn" style="font-size: 24px; width: 100%; margin-bottom: 10px;">決定</button>
						
					</center>
				</div>
			</div>

			<div class="card d-none" id="amazon_gift_pint_purchase_aria" style="background: #eee;position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C;">
				<div class="card-header">
					<div class="row">
						<div class="col-sm">
							<button class="btn btn-danger float-right btn-lg close_loged_user_infor float-right" id="amazon_gift_pint_purchase_aria_close">戻る</button>
						</div>
					</div>
				</div>
				<div class="card-body bg-white">	
					
					<div class="row">
						<div class="col-sm">
							
							<p>
								チャリン２ポイントを交換します

							</p>
							
						</div>
						
					</div>
					<center>

						<button class="btn btn-default btn-lg jafa_btn" id="amazon_gift_pint_purchase_finish_btn" style="font-size: 24px; width: 100%; margin-bottom: 10px;">送信</button>
						
					</center>
				</div>
			</div>

			<!-- <div class="card d-none" id="cornvert_point_condition_less_aria" style="background: #eee;position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C;">
				<div class="card-header">
					<div class="row">
						<div class="col-sm">
							<button class="btn btn-danger float-right btn-lg close_loged_user_infor float-right" id="cornvert_point_condition_less_aria_close">戻る</button>
						</div>
					</div>
				</div>
				<div class="card-body bg-white">	
					
					<div class="row">
						<div class="col-sm">
							
							<p>
								チャリン２確定ポイントが <br>
								<strong class="parmanet_exc_point"></strong> ポイントです。 <br>
								１５ポイント以上から <br>
								アマゾンギフトに交換できます。

							</p>
							
						</div>
						
					</div>
				</div>
			</div> -->
			<div class="card d-none" id="cornvert_point_condition_getter_aria" style="background: #eee;position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C;">
				<div class="card-header">
					<div class="row">
						<div class="col-sm">
							<button class="btn btn-danger float-right btn-lg close_loged_user_infor float-right" id="cornvert_point_condition_getter_aria_close">戻る</button>
						</div>
					</div>
				</div>
				<div class="card-body bg-white">					
					<div class="row">
						<div class="col-sm">							
							<p>
								チャリン２確定ポイント <strong class="parmanet_exc_point"></strong> <br>
								Amazonギフトに交換します。
							</p>							
						</div>						
					</div>
					<center>

						<button class="btn btn-default btn-lg jafa_btn" id="amazon_gift_pint_purchase_finish_btn" style="font-size: 24px; width: 100%; margin-bottom: 10px;">送信</button>
						
					</center>
				</div>
			</div>
			<div class="card customer_login_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
				<div class="card-header info">
	                <p class=""><span id="role_name"></span><?= lang('sign_in_sign_in') ?> <button class="btn btn-warning float-right" id="customer_login_screen_close">戻る</button></p>
	                               
	            </div>
			  	<div class="card-body" style="padding-bottom: 0;">
			  		<p class="text-danger" id="login_message"></p>
	               	<?php echo form_open(base_url('account/sign_in'), 'class="form-horizontal"'); ?>
					<?php echo form_fieldset(); ?>  
						<input type="hidden" id="customer_purchase_histry_open" value="0" name="">
						<div class="form-group row">
							<label class="col-md-3 control-label" for="sign_in_username_email">携帯番号</label>  
							<div class="col-md-9">
								<input id="sign_in_username_email" name="sign_in_username_email" type="text" placeholder="携帯番号" class="form-control input-md" required="">

							</div>
						</div>

						<!-- Password input-->
						<div class="form-group row">
							<label class="col-md-3 control-label" for="sign_in_password">パスワード</label>
							<div class="col-md-9">
								<input id="sign_in_password" name="sign_in_password" type="password" placeholder="パスワード" class="form-control input-md" required="">

							</div>
						</div>
						<div class="form-group row">
						    <div class="col-md-3"></div>
						  <div class="col-md-9">                    
						        <label>
						          <?php echo form_checkbox(array('name' => 'sign_in_remember', 'id' => 'sign_in_remember', 'value' => 'sign_in_remember', 'checked' => '')); ?>
						    <?php echo lang('sign_in_remember_me'); ?>
						        </label>                      
						    </div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
								<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-success customer_login_btn', 'style'=> 'background-color: #469C46; color: white', 'content' => '<i class="fa fa-sign-in-alt"></i> '.lang('sign_in_sign_in'))); ?>
								<?php //echo form_button(array('type' => 'button', 'class' => 'btn btn-default', 'id'=> 'customer_reg_btn', 'content' => '<i class="fa fa-user-plus"></i> 新規登録')); ?> 
                        
								<?php // echo form_button(array('type' => 'button', 'class' => 'btn btn-danger jafa_btn change_password', 'style'=> ' border-width:2px; ', 'content' => '<i class="fa fa-lock"></i> パスワード変更')); ?>
								<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-danger forgot_password', 'style'=> 'background: blue; color: white; border-width:2px; border: 1px solid blue; border-radius: 5px; ', 'content' => '<i class="fa fa-lock"></i> パスワードを忘れた方')); ?>

							</div>
						</div>
					<?php echo form_fieldset_close(); ?>
					<?php echo form_close(); ?>
			  	</div>
			</div>
			<!-- // Start Forgot Password -->
			
			<div class="card forgot_password_screen d-none" style="position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C; min-width: 500px;">
				<div class="card-header info">
	                <p class=""><span id="role_name"></span> パスワードを忘れた方 <button class="btn btn-warning float-right" id="forgot_password_screen_close">戻る</button></p>
	                               
	            </div>
			  	<div class="card-body" style="padding-bottom: 0;">
			  		<p class="text-danger" id="forgot_password_error"></p>
	               	<?php echo form_open(base_url('account/forgot_password'), 'class="form-horizontal"'); ?>
					<?php echo form_fieldset(); ?>  
						<div class="form-group row">
							<label class="col-md-4 control-label" for="sign_in_username_email">携帯番号/メール</label>  
							<div class="col-md-8">
								<input id="forgot_username_email" name="forgot_username_email" type="text" placeholder="携帯番号/メール" class="form-control input-md" required="">

							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<center>
									<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-success sent_password_reset_link', 'style'=> 'background-color: #469C46; color: white', 'content' => '<i class="fa fa-paper-plane"></i> パスワードリセットリンクを送信')); ?>
								</center>
								
								

							</div>
						</div>
					<?php echo form_fieldset_close(); ?>
					<?php echo form_close(); ?>
			  	</div>
			</div>
			<!-- // End Forgot Password -->
			<div class="card d-none" id="logedin_user_information"  style="position: fixed; right: 30px; bottom: 10px; padding: 0; background: #FDEADA">
				<div class="card-body">
					
					<button class="btn btn-danger float-right btn-sm close_loged_user_infor" id="loged_infor_close">戻る</button>
					<p class="loged_in_username" style="padding-top: 40px;">Loading...</p>
					<center><button class="btn btn-default close_loged_user_infor" style="background-color: #FFFF99">はい</button></center>
				</div>
			</div>
			<div class="card bg-info d-none" id="sent_password_reset_link_sent_screen"  style="position: fixed; right: 30px; bottom: 10px; padding: 0;">
				<div class="card-body">
					
					<button class="btn btn-danger float-right btn-sm sent_password_reset_link_sent_screen_close" id="">戻る</button>
					<p class="sent_password_reset_message" style="padding-top: 40px; color: white;"></p>
					<center><button class="btn btn-default sent_password_reset_link_sent_screen_close" style="background-color: #FFFF99">はい</button></center>
				</div>
			</div>


			<!-- // Start Change Password -->
			<div class="card change_password_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
				<div class="card-header info">
	                <p class=""><span id="role_name"></span> パスワード変更 <button class="btn btn-warning float-right" id="change_password_screen_close">戻る</button></p>
	                               
	            </div>
			  	<div class="card-body" style="padding-bottom: 0;">
			  		<p class="text-danger text-center" id="change_password_error"></p>
	               	<?php echo form_open(base_url('account/forgot_password'), 'class="form-horizontal"'); ?>
					<?php echo form_fieldset(); ?>  
						<div class="form-group row">
							<label class="col-md-4 control-label" for="password_new_password">新パスワード（４桁以上）</label>  
							<div class="col-md-8">
								<input id="password_new_password" name="password_new_password" type="text" placeholder="新パスワード（４桁以上）" class="form-control input-md" required="">

							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 control-label" for="password_retype_new_password">パスワード再入力してください</label>  
							<div class="col-md-8">
								<input id="password_retype_new_password" name="password_retype_new_password" type="text" placeholder="パスワード再入力してください" class="form-control input-md" required="">

							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<center>
									<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-success save_change_password', 'style'=> 'background-color: #469C46; color: white', 'content' => '<i class="fa fa-unlock-alt"></i>  パスワード変更')); ?>
								</center>
								
								

							</div>
						</div>
					<?php echo form_fieldset_close(); ?>
					<?php echo form_close(); ?>
			  	</div>
			</div>
			<!-- <div class="card <?= isset($account)? "d-block":"d-none" ?> col-md-4 customer_point_table col-sm-12" style="">
				<div class="card-body">					
					<?php
					$user_id = 0;
						if ( $this->authentication->is_signed_in()){
					$user_id = $account->id;
					?>
					
					<center><h3>あなたの現在のポイント残高</h3></center>
					<table class="table table-bordered point_table table-striped" style="background: white;">
						<thead>
							<tr>
								<th>ショップ名</th>
								<th class="text-center">ショップ</th>
								<th class="text-center">チャリン<sup>2</sup></th>
								<th class="text-center">計</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>アマゾン</td>
								<td class="text-right">300</td>
								<td class="text-right">400</td>
								<td class="text-right">700</td>
							</tr>
							<tr>
								<td>楽天</td>
								<td class="text-right">150</td>
								<td class="text-right">200</td>
								<td class="text-right">350</td>
							</tr>
							<tr>
								<td>ヤフー</td>
								<td class="text-right">80</td>
								<td class="text-right">55</td>
								<td class="text-right">135</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<th>全体</th>
								<th class="text-right">530</th>
								<th class="text-right">655</th>
								<th class="text-right">1,185</th>
							</tr>
						</tfoot>
					</table>
					<?php
					}else{
					?>
					<p class="text-info" style="font-size: 26px;">現在残高を押すと「ログイン」画面</p>
					<?php
					}
					?>
					<input type="hidden" id="login_user_id" value="<?= $user_id; ?>" name="">
				</div>
			</div> -->
			<input type="hidden" id="login_user_id" value="<?= $user_id; ?>" name="">
			<div class="card col-md-4 col-sm-12 d-none" id="product_case_message" style="background-color: #FFFF99; border: 2px solid green; border-radius: 10px; position: fixed; max-width: 400px;
    right: 10px;
    bottom: 10px;
    padding: 4px;">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12" style="padding: 10px;">
							<!-- <button class="btn btn-primary float-right btn-lg" id="close_case_message">戻る</button> -->
							<p style="font-size: 18px;">まとめ買い（複数）の価格を表示しますか？</p>
							<!-- <p style="font-size: 20px;">どちらか選んでください。</p>	 -->
							<button style="background-color: #DBEEF4; color: black; width: 145px;" class="btn btn-info float-left btn-lg" id="see_case_product" id="">はい</button>
							<button style="background-color: #F2DCDB; width: 145px;" class="btn btn-warning float-right btn-lg" id="see_single_product">いいえ</button>

						</div>
					</div>					
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="card android_screen d-none" id="android_screen">
			<div style="position: relative; height: 100%;">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							<div class="float-left" style="width: 50%">
								<button class="btn btn-default btn-lg" style="background-color: #CCFF99;"><strong style="color: red;">初回のみ</strong> </button>
							</div>
							<div class="float-right" style="width: 50%">
								<button class="btn btn-danger float-right btn-lg" id="close_android_screen">戻る</button>
							</div>
							
							<!-- <center><h4>初回の方のみの操作方法</h4></center> -->
							<div style='margin-top: 60px !important;'>
								<center>
									<p style="font-size: 22px;">バーコード撮影用の
										アプリを<strong style="color: red;">「インストール」</strong>
										します。</p>
									<!-- <p>インストールします</p>	 -->
								</center>
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="android_open_screen_btn">次へ</button></center>	
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/install3.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>				
				
			</div>
		</div>
		<div class="card android_open_screen d-none" id="android_open_screen">
			<div style="position: relative; height: 100%">
				<div style="position: relative; height: 100%; ">

					<div class="card-body">
						<div class="row">						
							<div class="col-sm-12 " style="">
								
								<div class="float-right" >
									<button class="btn btn-danger float-right btn-lg" id="close_android_open_screen">戻る</button>
								</div>
								
								<!-- <center><h4>初回の方のみの操作方法</h4></center> -->
								<div style='margin-top: 60px !important;'>
									<center>

										<p style="font-size: 22px;">インストール後
										<strong style="color: red;">「開く」</strong>を押します。</p>
										<!-- <p>インストールします</p>	 -->
									</center>
									
								</div>

																		
								<div class="col-sm-12">
									<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="android_camera_screen_btn">次へ</button></center>	
								</div>

								<div class="clearfix"></div>
							</div>
							
							<div class="clearfix"></div>
						</div>
						<div class="row" style="margin-top: 70px;">
							<div class="col-sm-12" style="padding: 0">
								<img src="resource/img/open3.gif" width="100%">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>			
					
				</div>
			</div>
			
		</div>
		<div class="card android_camera_screen d-none" id="android_camera_screen">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_android_camera_screen">戻る</button>
							</div>
							
							<!-- <center><h4>初回の方のみの操作方法</h4></center> -->
							<div style='margin-top: 60px !important;'>
								<center>

									<p style="font-size: 22px;">
										<strong style="color: red;">「許可」</strong>を押します。
										確認を押すと
										インストールします。</p>
									<!-- <p>インストールします</p>	 -->
								</center>
								
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="inistall_android_apps_btn">確認</button></center>	
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/camera3.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				
			</div>
			
		</div>

		<!-- iPhone Installion Screen -->
		<div class="card iphone_browsing_screen d-none" id="iphone_browsing_screen">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							<div class="float-left" style="width: 50%">
								<button class="btn btn-default btn-lg" style="background-color: #CCFF99;"><strong style="color: red;">初回のみ</strong> </button>
							</div>
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_iphone_browsing">戻る</button>
							</div>
							
							<!-- <center><h4>初回の方のみの操作方法</h4></center> -->
							<div style='margin-top: 60px !important;'>
								<center>
									<p style="font-size: 22px;">
										<strong style="color: red;">「開く」</strong>を押します。</p>
									<!-- <p>インストールします</p>	 -->
								</center>
								
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="open_iphone_install_btn">次へ</button>	</center>		
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/IMG-9229.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>				
			</div>
			
		</div>
		<div class="card iphone_install_screen d-none" id="iphone_install_screen">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_iphone_install_screen">戻る</button>
							</div>
							
							<!-- <center><h4>初回の方のみの操作方法</h4></center> -->
							<div style='margin-top: 60px !important;'>
								<center>
									<p style="font-size: 22px;">
										この<strong style="color: red;">マーク</strong>を押します。</p>
									<!-- <p>インストールします</p>	 -->
								</center>
								
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="open_app_open_btn">次へ</button>	</center>		
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/IMG-9230.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>				
			</div>
			
			
		</div>
		<div class="card iphone_open_screen d-none" id="iphone_open_screen">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_iphone_open_screen">戻る</button>
							</div>
							
							<!-- <center><h4>初回の方のみの操作方法</h4></center> -->
							<div style='margin-top: 60px !important;'>
								<center>
									<p style="font-size: 22px;">
										インストール後<strong style="color: red;">「開く」</strong>を押します。</p>
									<!-- <p>インストールします</p>	 -->
								</center>
								
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="open_iphone_camra_btn">次へ</button>	</center>		
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/IMG-9231.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>				
			</div>
		</div>
		<div class="card iphone_camera_screen d-none" id="iphone_camera_screen">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_iphone_camera_screen">戻る</button>
							</div>
							<div style='margin-top: 60px !important;'>
								<center>
									<p style="font-size: 22px;"><strong style="color: red;">「許可しない」</strong>を押します。</p>
								</center>
								
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="open_iphone_jafa_btn">次へ</button>	</center>		
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/IMG-9232.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>				
			</div>
			
		</div>

		<div class="card iphone_jafa_screen d-none" id="iphone_jafa_screen">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_iphone_jafa_screen">戻る</button>
							</div>
							<div style='margin-top: 60px !important;'>
								<center>
									<p style="font-size: 22px;"><strong style="color: red;">「スマホでバーコード撮影」</strong>を押します。</p>
								</center>
								
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="open_iphone_last_screen">次へ</button>	</center>		
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/IMG-9233.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>				
			</div>

			
		</div>

		<div class="card iphone_last_screen d-none" id="iphone_last_screen">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="">
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_iphone_last_screen">戻る</button>
							</div>
							<div style='margin-top: 60px !important;'>
								<center>
									<p style="font-size: 22px;"><strong style="color: red;">「ＯＫ」</strong>を押します。</p>
									<h5>確認を押すとインストールします</h5>
								</center>
								
							</div>

																	
							<div class="col-sm-12">
								<center><button style="background-color: #FFFF99" class="btn btn-default btn-lg" id="go_itune_btn">確認</button>	</center>		
							</div>

							<div class="clearfix"></div>
						</div>
						
						<div class="clearfix"></div>
					</div>
					<div class="row" style="margin-top: 70px;">
						<div class="col-sm-12" style="padding: 0">
							<img src="resource/img/IMG-9235.gif" width="100%">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>				
			</div>
			
		</div>
		<div class="card barcode_scan_option bg-primary d-none" style=";position: fixed; right: 10px; bottom: 10px; padding: 0; border:2px solid #3D618C;">
			<div class="card-body">					
				<button class="btn btn-danger float-right btn-sm close_loged_user_infor" id="barcode_scan_option_close">戻る</button>
				<br><br>
				<h6 style="color: white;">スキャンオプションを選択してください</h6>
				<center>
					<button class="btn btn-default pic2shop_app_option btn-lg" attr-user-role="2" style="background-color: #FFFF99; padding: 5px 20px; width: 155px; border:2px solid #3D618C;">アプリ</button>
					<button class="btn btn-default webCam_option btn-lg" attr-user-role="3" style="background-color:#FFCCFF; padding: 5px 20px; width: 155px;border:2px solid #3D618C;">ウェブカメラ</button>
					
				</center>
			</div>
		</div>


		<div class="d-none card float-right col-md-3 col-sm-12 introduce_screen" style="padding: 0; z-index: 100; overflow: auto;" id="introduce_screen">
			<div style="position: relative; height: 100%">
				<div class="card-header bg-white" style="border-top:3px solid black; border-left: 3px solid black; border-right: 3px solid black; border-bottom: 2px solid #8A0B15;">
					<h5>ポイント案内</h5>
				</div>
				<div class="card-body" style="border: 3px solid black; border-top: 0; overflow: auto;">
					
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

					  	<form class="form-horizontal" id="introduce_form" return false;>
					  	<fieldset>
					  		<!-- Individual Introducer-->
					  		<div class="form-group form-row">
					  		  	<label class="col-md-4 control-label" for="introduce_name0">紹介相手</label>  
					  		  	<div class="col-md-8">
					  		  		<input id="introduce_name0" style="ime-mode: active;" name="introduce_name[]" type="text" placeholder="お名前" class="form-control input-md">					  		  
					  		  	</div>
					  		</div>
					  		<div class="form-group form-row" style="border-bottom: 2px dotted black; padding-bottom: 10px;">
					  		  	<label class="col-md-4 control-label" for="introduce_phone0">Eメール</label>  
					  		  	<div class="col-md-8">
					  		  		<input id="introduce_phone0" style="ime-mode: inactive;" name="introduce_phone[]" type="text" placeholder="メール" class="form-control input-md">					  		  
					  		  	</div>
					  		</div>
					  		<!-- Individual Introducer-->
					  		<div class="form-group form-row">
					  		  	<label class="col-md-4 control-label" for="introduce_name1">紹介相手</label>  
					  		  	<div class="col-md-8">
					  		  		<input id="introduce_name1" style="ime-mode: active;" name="introduce_name[]" type="text" placeholder="お名前" class="form-control input-md">					  		  
					  		  	</div>
					  		</div>
					  		<div class="form-group form-row" style="border-bottom: 2px dotted black; padding-bottom: 10px;">
					  		  	<label class="col-md-4 control-label" for="introduce_phone1">Eメール</label>  
					  		  	<div class="col-md-8">
					  		  		<input id="introduce_phone1" style="ime-mode: inactive;" name="introduce_phone[]" type="text" placeholder="メール" class="form-control input-md">					  		  
					  		  	</div>
					  		</div>
					  		<!-- Individual Introducer-->
					  		<div class="form-group form-row">
					  		  	<label class="col-md-4 control-label" for="introduce_name2">紹介相手</label>  
					  		  	<div class="col-md-8">
					  		  		<input id="introduce_name2" style="ime-mode: active;" name="introduce_name[]" type="text" placeholder="お名前" class="form-control input-md">					  		  
					  		  	</div>
					  		</div>
					  		<div class="form-group form-row" style="border-bottom: 2px dotted black; padding-bottom: 10px;">
					  		  	<label class="col-md-4 control-label" for="introduce_phone2">Eメール</label>  
					  		  	<div class="col-md-8">
					  		  		<input id="introduce_phone2" style="ime-mode: inactive;" name="introduce_phone[]" type="text" placeholder="メール" class="form-control input-md">					  		  
					  		  	</div>
					  		</div>
					  		<div class="form-row text-center">
					  				<button id="save_introduce" name="save_introduce" class="btn btn-default btn-warning btn-lg float-left" style="width: 150px; margin-right: 10px;">送信</button>
					  				<button id="close_introduce_screen" name="close_introduce_screen" style="width: 150px;" class="btn btn-danger btn-lg float-right">戻る</button>
					  		</div>
					  		
					  	</fieldset>
					  	</form>
					  </div>
					  
					</div>
					
				</div>
				
			</div>
		</div>

		<div class="card d-none float-right col-md-3 col-sm-12 partner_contact_success_aria" id="partner_contact_success_aria" style="position: fixed; right: 20px; bottom: 10px; padding: 0">
			<div style="position: relative;">
				<div class="card-header bg-white" style="border-top:3px solid black; border-left: 3px solid black; border-right: 3px solid black; border-bottom: 2px solid #8A0B15;">
					<h5>ポイント案内 </h5>
				</div>
				<div class="card-body"style="border: 3px solid black; border-top: 0; overflow: auto;">
					<div id="email_sending_message">
						<center><img src="<?= base_url() ?>resource/img/ajax/loading.gif"></center> 
					</div>

					<center><button style="font-size: 22px; width: 100px;" class="btn btn-danger partner_contact_success_aria_close btn-lg">戻る</button></center>
				</div>

			</div>
		</div>

		<div class="d-none card float-right col-md-3 col-sm-12 introduce_screen" style="padding: 0; z-index: 100; overflow: auto; background: #f0ffcc" id="member_reg_form">
			<div style="position: relative; height: 100%">
				<div class="card-header" style="border-top:3px solid black; border-left: 3px solid black; border-right: 3px solid black; border-bottom: 2px solid #8A0B15;">
					<center><h4>新規登録</h4></center> 
				</div>
				<div class="card-body" style="border: 3px solid black; border-top: 0; overflow: auto;">
					    	<form class="form-horizontal" action="account/sign_up" method="post">
					    		<input type="hidden" name="request_url" value="company_margine">
					    		<input type="hidden" name="refaral" value="<?= $this->input->get('refaral') ?>">
							  	<fieldset>
							  		<table class="table table-striped" style="margin-bottom: 0">
							  			<tr>
							  				<th style="border-color: #dee2e6" width="30%"><label class="control-label" for="fullname">お名前</label></th>
							  				<td>
							  					<?php echo form_input(array('name' => 'fullname', 'id' => 'fullname', 'required' => 'required', 'style' => 'ime-mode: active;', 'placeholder' => 'お名前', 'class'=>'form-control', 'value' => set_value('fullname') ? set_value('fullname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>
							  					          <?php if (form_error('fullname')) : ?>
							  					              <span class="help-block">
							  					                <?php echo form_error('fullname'); ?>
							  					                </span>
							  					          <?php endif; ?>
							  				</td>
							  			</tr>
							  			<tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="sign_up_username">携帯電話</label> 
							  				</th>
							  				<td>
							  					<?php echo form_input(array( 'type' => 'tel', 'name' => 'sign_up_username', 'placeholder' => '携帯電話', 'required' => 'required', 'style' => 'ime-mode: inactive', 'id' => 'sign_up_username', 'class'=>'form-control', 'value' => set_value('sign_up_username') ? set_value('sign_up_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>

							  					<?php if (form_error('sign_up_username') || isset($users_username_error)) : ?>
							  					  <span class="help-block">
							  					  <?php
							  					    echo form_error('sign_up_username');
							  					    echo isset($users_username_error) ? $users_username_error : '';
							  					  ?>
							  					  </span>
							  					<?php endif; ?>
							  					
							  				</td>
							  			</tr>
							  			<!-- <tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="sign_up_traking">会員コード</label> 
							  				</th>
							  				<td>
							  					<?php echo form_input(array( 'type' => 'tel', 'name' => 'sign_up_traking', 'placeholder' => '会員コード（10桁限定）', 'required' => 'required', 'style' => 'ime-mode: inactive', 'id' => 'sign_up_traking', 'class'=>'form-control', 'value' => set_value('sign_up_traking') ? set_value('sign_up_traking') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 10, 'minlength' => 10)); ?>

							  					<?php if (form_error('sign_up_traking') || isset($sign_up_traking_error)) : ?>
							  					  <span class="help-block">
							  					  <?php
							  					    echo form_error('sign_up_traking');
							  					    echo isset($sign_up_traking_error) ? $sign_up_traking_error : '';
							  					  ?>
							  					  </span>
							  					<?php endif; ?>
							  					
							  				</td>
							  			</tr> -->
							  			<tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="sign_up_email">メールアドレス</label> 
							  				</th>
							  				<td>
							  					<?php echo form_input(array('name' => 'sign_up_email', 'id' => 'sign_up_email', 'placeholder' => 'メールアドレス', 'required' => 'required', 'style' => 'ime-mode: inactive', 'class'=>'form-control', 'value' => set_value('sign_up_email') ? set_value('sign_up_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>

							  					            <?php if (form_error('sign_up_email') || isset($users_email_error)) : ?>
							  					              <span class="help-block">
							  					              <?php
							  					                echo form_error('sign_up_email');
							  					                echo isset($users_email_error) ? $users_email_error : '';
							  					              ?>
							  					              </span>
							  					            <?php endif; ?>
							  					
							  				</td>
							  			</tr>
							  			<tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="sign_up_password">パスワード（４桁以上）</label>
							  				</th>
							  				<td>
							  					<?php echo form_password(array('name' => 'sign_up_password', 'required' => 'required', 'id' => 'sign_up_password', 'class'=>'form-control', 'placeholder'=> 'パスワード（４桁以上）', 'value' => set_value('sign_up_password'), 'autocomplete' => 'off')); ?>

							  					          <?php if (form_error('sign_up_password')) : ?>
							  					            <span class="help-block">
							  					              <?php echo form_error('sign_up_password'); ?>
							  					            </span>
							  					          <?php endif; ?>
							  				</td>
							  			</tr>
							  			<tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="passconf">パスワード再入力</label> 
							  				</th>
							  				<td>
							  					<?php echo form_password(array('name' => 'passconf', 'required' => 'required', 'placeholder'=> 'パスワード再入力', 'id' => 'passconf', 'class'=>'form-control', 'value' => set_value('passconf'), 'autocomplete' => 'off')); ?>
							  					          
							  					          <?php if (form_error('passconf')) : ?>
							  					            <span class="help-block">
							  					              <?php echo form_error('passconf'); ?>
							  					            </span>
							  					          <?php endif; ?>
							  				</td>
							  			</tr>
							  			
							  			<tr>
							  				<td colspan="2">
							  					<center>
							  						<button type="submit" class="btn btn-default" style="background-color: green; color: white; font-size: 22px; width: 100px;">登録</button>
							  						<button style="font-size: 22px; width: 100px;" id="nnn" name="close_introduce_screen" class="btn btn-warning new_member_reg_form_close">戻る</button>
							  					</center>
							  					
							  				</td>
							  				
							  			</tr>
							  		</table>
							  	</fieldset>
							  	</form>
					
				</div>
				
			</div>
		</div>

		<div class="card barcode_reading_navi d-none" id="barcode_reading_navi">
			<div style="position: relative; height: 100%">
				<div class="card-body">
					<div class="row">						
						<div class="col-sm-12 " style="padding: 0">
							<div class="float-left" style="width: 70%">
								<strong style="color: red;">検索方法は２つあります。</strong>
							</div>
							<div class="float-right" >
								<button class="btn btn-danger float-right btn-lg" id="close_barcode_reading">戻る</button>
							</div>
							
							<!-- <center><h4>初回の方のみの操作方法</h4></center> -->
							<div style='margin-top: 60px !important;'>
								<p>１、<input type="text" class="" style="background: white; padding: 5px; width: 80%" readonly="readonly" value="商品名か？　バーコード入力か？" name="">より <br>	<span style="padding-left: 20px;">&nbsp&nbsp 対象商品を検索できます。</span></p>
								<p>２、バーコードの読み取りには、 
									<br>&nbsp &nbsp &nbsp&nbsp こちらのアプリをお勧めします。
									<br>&nbsp &nbsp &nbsp&nbsp ㈱ジャコスで検証済みなので安全です。<br>

									　　　
								</p>						　　
								<p>
									<center>
										<a style="text-decoration: underline;" href="http://jacos.jp" target="_blank">㈱ジャコス　会社案内</a>
									</center>
								</p>								
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="float-left" style="width: 35%; float: left;">
							<a href="#" id="pic2shop_download" style="">
								<img src="<?= base_url() ?>resource/img/pic2shop_logo.png">
							</a>
							
						</div>
						<div class="float-right" style="width: 65%; float: right;">
							※、iPhone/android は、自動的に	認識してダウンロード画面に移動します。
						</div>
					</div>
				</div>				
			</div>
			
		</div>
	<div class="card col-sm-5 col-md-4 col-lg-3 voice_suggestion_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
		<div class="card-header info">
            <p class="">検索結果 <button class="btn btn-warning float-right" id="voice_suggestion_screen_close">戻る</button></p>
                           
        </div>
        <div class="card-body recording-instructions">
        	
        </div>
    </div>
	<div class="modal" id="livestream_scanner">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">バーコードを撮影</h4>
				</div>
				<div class="modal-body" style="position: static">
					<div id="interactive" class="viewport"></div>
					<div class="error"></div>
				</div>
				<div class="modal-footer">
					<label class="btn btn-warning pull-left">
						<i class="fa fa-camera"></i> 
						<input type="file" accept="image/*;capture=camera" capture="camera" class="hide" style="display: none;" />
					</label>
					<button type="button" class="btn btn-primary" data-dismiss="modal">戻る</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div class="modal" id="barcode_scanner">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">バーコードを撮影</h4>
				</div>
				<div class="modal-body" style="position: static">
					<div id="scanner-container"></div>
					<!-- <canvas id="webcodecam-canvas"></canvas> -->
				</div>
				<div class="modal-footer">
					<!-- <label class="btn btn-warning pull-left">
						<i class="fa fa-camera"></i> 
						<input type="file" accept="image/*;capture=camera" capture="camera" class="hide" style="display: none;" />
					</label> -->
					<select class="form-control" id="camera-select"></select>
					<button type="button" class="btn btn-primary" data-dismiss="modal" id="barcode_scanner_close">戻る</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<input type="hidden" class="point_table_view" id="point_table_view" value="0" name="">
	<!-- <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/jquery.js"></script> -->
	<input type="hidden" id="can_product_search" value="1">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/qrcodelib.js"></script>
	<!-- <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/webcodecamjquery.js"></script> -->
	
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/xml2json.js"></script>
	
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>

    
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script> -->
    <style>
    	#interactive.viewport {position: relative; width: 100%; height: auto; overflow: hidden; text-align: center;}
    	#interactive.viewport > canvas, #interactive.viewport > video {max-width: 100%;width: 100%;}
    	canvas.drawing, canvas.drawingBuffer {position: absolute; left: 0; top: 0;}
    </style>
    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
      <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/affiliate.js"></script>
      <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/voice.js"></script>
      <!-- <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
      <script src="<?php echo base_url().RES_DIR; ?>/js/app.js"></script> -->
      <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/amazon_commission_rate.json"></script>
	
</body>
</html>
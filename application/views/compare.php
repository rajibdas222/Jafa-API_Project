<!DOCTYPE html>
<html translate="no">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- iPhone PWA icon and style -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#FFFFFF">
    <!-- <meta name="apple-mobile-web-app-capable" content="yes"> -->
    <meta name="apple-mobile-web-app-title" content="激安.com">
	<!-- <meta name="theme-color" content="#EE6E73"> -->
	<title>激安.com</title>
	<link rel="shortcut icon" href="<?= base_url()?>favicon.png" />
	<!-- Launcher Icon for Android and iPhone -->
	<link rel="apple-touch-icon" size="152x152" href="<?php echo base_url().RES_DIR; ?>/pwa/charin2_152.png">
  	<link rel="icon" type="image/png" size="152x152" href="<?php echo base_url().RES_DIR; ?>/pwa/charin2_152.png">
  	<!-- Launcher Icon for Android and iPhone -->

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/css/style_v2.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> -->
	<!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<!-- CODELAB: Add link rel manifest -->
	<!-- <link rel="manifest" id="manifest" href="<?php echo base_url().RES_DIR; ?>/pwa/manifest.json"> -->
	<!-- <link rel="manifest" id="manifest" href="#"> -->
	<input type="hidden" name="base_url" id="base_url" value="<?= base_url(); ?>">
	<script type="text/javascript">
		
		function trygoogle() {
		// launch pic2shop and tell it to open Google Products with scan result
			// window.location="pic2shop://scan?callback=http%3A//www.google.com/m/products%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts";
			// if ([[UIApplication sharedApplication] canOpenURL:[NSURL URLWithString:@"pic2shop:"]]) {
				var main_uri = encodeURI('https://jafa.dev.jacos.jp');
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
		.btn:not(:disabled):not(.disabled):active, .btn:not(:disabled):not(.disabled).active{
			background-image: green;
		}
		.vedio_line{
			border: 2px red solid; 
			/*margin-top: 67%; */
			margin-top: 30%; 
			width: 320px; position: absolute; z-index: 2000;

			/*animation: blink-animation 0.5s steps(5, start) infinite;*/
			  /*-webkit-animation: blink-animation 0.5s steps(5, start) infinite;*/
		}
		
		@keyframes blink-animation {
		  to {
		    visibility: hidden;
		  }
		}
		@-webkit-keyframes blink-animation {
		  to {
		    visibility: hidden;
		  }
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

		
		.voice_product_list{
			color: red;
			padding: 5px;
			border-bottom: 1px dotted gray;
			cursor: pointer;
		}
		.voice_product_list:hover{
			background-color: #CBEBF6;
			/*font-weight: bold;*/
		}
		.ui-menu-item{
			cursor: pointer; !important;
		}
		.ui-menu-item{
			width: 100%;
			padding: 5px;
			background: none;
		}
		.ui-menu-item:hover{
			background: #007bff;
		}
		.ui-menu-item a:hover{
			background: transparent;
			color: white;
			border: none;
		}
		.search_scroll_btn:hover{
			color: white !important;
		}
		.search_scroll_btn:focus {
			outline:none !important;
			border: 0 !important;
		}
		.search_scroll_btn:hover {
			outline:none !important;
			border: 0 !important;
		}
		.search_scroll_btn:active {
			outline:none !important;
			border: 0 !important;
		}
		.btn:focus{
			outline:0 !important;
			border: 0 !important;
		}
		.blinking{
		    animation:blinkingText 0.8s infinite;
		}
		@keyframes blinkingText{
		    /*0%{     color: red;    }*/
		    /*49%{    color: transparent; }*/
		    50%{    color: transparent; }
		    /*80%{    color:red;  }
		    90%{    color:red;  }
		    99%{    color:red;  }*/
		    100%{   color: red;    }
		}

		.product-main-list td,
		.product-main-list th {
			vertical-align: middle;
		}
		.product-main-list {
			font-size: 13px; vertical-align: middle;
		}
		.product-main-list td, .product-main-list th{
			border: 1px solid black;
		}
		.border-bottom-warning{
			border-bottom: 2px solid #ffc107 !important; 
			padding-bottom: 2px !important;
		}
		.border-bottom-none{
			border-bottom: 2px solid white !important; 
			padding-bottom: 2px !important;
		}
		.padding-top-2{
			padding-top: 2px !important;
		}
		@media only screen and (max-width: 768px) 
		{
			.product-main-list {
				font-size: 11px;
			}
			.product-main-list td, .product-main-list th{
				padding: 0.40rem;
				line-height: 16px;
			}

			.dashed-border{
				border-bottom: 2px dashed black !important; 
			}

			.compare_table_mobile td, .compare_table_mobile th{
				font-size: 60%;
			}
			.compare_table_mobile thead td{
				padding: 2px;
			}
			
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
	<input type="hidden" id="referal" value="<?= $referal ?>" name="referal">
	<input type="hidden" id="registration_completetion" value="<?= $this->session->flashdata('registration_completetion'); ?>" name="registration_completetion">
	<input type="hidden" id="parent_id" value="<?= $parent_id ?>" name="parent_id">
	<input type="hidden" id="charin_pint" value="<?= $charin_pint ?>" name="">
	<input type="hidden" id="role_id" value="<?= $role_id ?>" name="">
	<input type="hidden" id="onchange_event" value="1" name="">
	<?php
	$user_id = NULL;
		if ( $this->authentication->is_signed_in()){
		$user_id = $account->id;
	}
	?>
	<input type="hidden" id="login_user_id" value="<?= $user_id; ?>" name="">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 desktop_show" style="padding: 10px;">
				
					<?php
					$fullname = "";
					if ($this->authentication->is_signed_in()) {
						$fullname = $account_details->fullname;
						?>
						<h4 class="float-left" style="background-color: white; padding: 10px; border-radius: 6px; max-width: 50%">
						<span style="color: blue; text-decoration: underline;text-decoration-color: blue;"> <?= $fullname ?></span><span style="color: blue"> 様</span>
						</h4>
						<?php

					}
					?>
					
				
				<!-- <div class="float-right mobile_show" style="width: <?= $this->authentication->is_signed_in()? '50%':'75%'; ?>; margin-right: 10px">
					<img class="float-right" width="100%" height="100%" src="<?php echo base_url().RES_DIR; ?>/img/jafa-logo2.png">
					<br>
					<p style="margin: 0; font-size: 12px;" class="text-right"><a href = "mailto: info_jafa@jacos.co.jp">メール：info_jafa@jacos.co.jp</a></p>
				</div> -->
				<!-- <a class="mobile_show" href="<?= base_url() ?>">
					<img class="float-right" height="40" src="<?php echo base_url().RES_DIR; ?>/img/jacos_logo-final.png">
				</a> -->
				
			</div>

			<div class="col-sm-8 desktop_show ">
				<ul class="nav float-right">
				  
				  <?php
				  if (!$this->authentication->is_signed_in()) {?>
				  	<!-- <button class="btn btn-default btn-lg text-center home_page_button customer_reg_btn" id="customer_reg_btn" style="">新規登録</button> -->
				  	<li class="nav-item">
				   		<button class="btn text-center home_page_button customer_reg_btn" id="customer_reg_btn" style="">登録・変更</button>
				  	</li>
				  	<li class="nav-item">
				  		<button class="btn btn-default btn-lg text-center user_login_btn home_page_button" id="user_login_btn">ログイン</button>
					</li>
				  	<?php
				  }else{
				  	?>
				  	<li class="nav-item">
				  		<a href="<?= base_url() ?>account/sign_out" class="btn btn-default btn-lg text-center home_page_button customer_logout" >ログアウト</a>
				  	</li>
				  	<li class="nav-item">
				  		<button class="btn btn-default btn-lg text-center change_password home_page_button" id="change_password">パスワード変更</button>
				  	</li>
				  	
				  	<?php
				  }
				  ?>
				  
				  <li class="nav-item">
				  	<!-- <button class="btn btn-default btn-lg text-center home_page_button introduce_btn" >紹介問い合わせ </button> -->
				  	<button class="btn btn-default btn-lg text-center home_page_button introduce_btn" >ご紹介</button>
				  </li>
				</ul>
				
				<!-- <button class="btn btn-default btn-lg text-center home_page_button" id="introduce_btn" style="margin-right: 0;">紹介問い合わせ</button> -->
			</div>
		</div>
		<div class="main_border">
			<div class="row">
				
				<!-- <div class="col-md-2 account_profile">
					<?php
					$fullname = "";
					if ($this->authentication->is_signed_in()) {
						$fullname = $account_details->fullname;
						?>
						<a href="<?= base_url('account/account_profile') ?>" style="  text-decoration: underline;text-decoration-color: blue;"> <?= $fullname ?></a><span> 様</span>
						<?php
					}else{
					?>
					<span style="border-bottom: 1px solid #00a0e8; width: 100px;" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp </span>
					<span class="text-right" style="color: #00a0e8"> 様</span>
					<?php
					}
					?>
					
				</div> -->
				<div class="col-md-12">
					<div class="row desktop_show">
						<div class="col-sm-6 offset-3 app-title" style="background-color: #7DCFF7; margin-bottom: 10px; padding: 10px; border: 2px solid blue; border-radius: 4px;">
							
							<button class="btn btn-primary btn-lg font-weight-bold" style="font-size: 36px; background-color: #0000FF;">
								<!-- 比較＆最安値 -->
								激 安.com
							</button>
							<button class="btn btn-lg font-weight-bold btn-primary search_scroll_btn float-right" style="">
								<!-- <p style="font-size:24px; margin-right: 55px; margin-top: -10px; padding: 10px 10px; text-align: left; color: white;" class="btn"> -->
								価格比較できていますか？
							<!-- </p> -->
							</button>
							
						</div>
					</div>
					<div class="row mobile_show">
						<div class="col-sm-12">
							<p class="app-title btn btn-primary text-center col-sm" style="margin-top: 0;"><strong>激 安.com</strong> </p>
						</div>

						<!-- <div class="col-sm-12">
							<a href="#" class="btn btn-lg search_scroll_btn btn-primary text-center">価格比較できていますか？</a>
						</div> -->
					</div>
					
					<div class="row">
						<div class="col-md-8 col-sm-12 offset-md-2">
							<div class="table-responsive d-md-none">
								<h6 style="font-size: 1.5rem" class="text-danger"><center>都内スーパーとネット通販の価格比較</center></h6>
									   
								<table class="table table-bordered bg-white product-main-list ">
									<thead class="text-center" style="font-size: 14px; height: 100px;">
										<tr>
											<td style="vertical-align: middle; border-bottom: 2px solid red;">
												商<br>品<br>名
											</td>
											<td style="vertical-align:top;padding-right: 0;; border-right: 2px solid white; border-bottom: 2px solid red;">
												味<br>の<br>素<br>ほ<br>ん<br>だ<br>し<br>4<br>5<br>0<br>g
											</td>
											<td style="vertical-align:bottom;padding-left: 2px; border-bottom: 2px solid red;">
												4<br>9<br>0<br>1<br>0<br>0<br>1<br>2<br>5<br>7<br>9<br>8<br>0
											</td>
											<td style="vertical-align:top; padding-right: 0;; border-right: 2px solid white; border-bottom: 2px solid red;">
												日<br>清<br>キ<br>ャ<br>ノ<br>ラ<br>ー<br>油<br>1<br>3<br>0<br>0<br>g
											</td>
											<td style="vertical-align:bottom; padding-left: 2px; border-bottom: 2px solid red;">
												4<br>9<br>0<br>2<br>3<br>8<br>0<br>1<br>9<br>4<br>3<br>2<br>3
											</td>
											<td style="vertical-align:top; padding-right: 0;; border-right: 2px solid white; border-bottom: 2px solid red;">
												ネ<br>ス<br>カ<br>フ<br>ェ<br>プ<br>レ<br>ジ<br>デ<br>ン<br>ト<br>瓶
											</td>
											<td style="vertical-align:middle; padding-left: 0; padding-right: 0;; border-right: 2px solid white;  border-bottom: 2px solid red;">
												 6<br>5<br>g
											</td>
											<td style="vertical-align:bottom; padding-left: 2px; border-bottom: 2px solid red;">
												4<br>9<br>0<br>2<br>2<br>0<br>1<br>4<br>2<br>1<br>7<br>2<br>0
											</td>
											<td style="vertical-align:top; padding-right: 0;; border-right: 2px solid white; border-bottom: 2px solid red;">
												カ<br>ン<br>ト<br>リ<br>ー<br>マ<br>ア<br>ム 
											</td>
											<td style="vertical-align:middle; padding-right: 0;padding-left: 0; border-right: 2px solid white; border-bottom: 2px solid red;"> 
												バ<br>ニ<br>ラ<br>&<br>コ<br>コ<br>ア<br>2<br>0<br>枚
											</td>
											<td style="vertical-align:bottom; padding-left: 2px; border-bottom: 2px solid red;">
												4<br>9<br>0<br>2<br>5<br>5<br>5<br>1<br>7<br>0<br>7<br>4<br>9
											</td>
											<td style="vertical-align:top; padding-right: 0;; border-right: 2px solid white; border-bottom: 2px solid red;">
												い<br>い<br>ち<br>こ<br>2<br>5<br>度<br>9<br>0<br>0<br>m<br>l
											</td>
											<td style="vertical-align:bottom;padding-left: 2px; border-bottom: 2px solid red;">
												4<br>9<br>0<br>6<br>6<br>6<br>6<br>1<br>1<br>1<br>3<br> 8
											</td>
										</tr>
									</thead>
									<tbody>
										<tr class="text-center" style="border: 2px solid red;">
											<td nowrap class="bg-success text-white"><span class="">都内 A<br>スーパー</span></td>
											<td class="bg-success text-white" colspan="2">927円</td>
											<td class="bg-success text-white" colspan="2">430円</td>
											<td class="bg-success text-white" colspan="3">1186円</td>
											<td class="bg-success text-white" colspan="3">322円</td>
											<td class="bg-success text-white" colspan="2">963円</td>
										</tr>
										<tr class="text-center">
											<td nowrap rowspan="3">アマゾン</td>
											<td class="dashed-border bg-warning" colspan="2">785円</td>
											<td class="dashed-border" colspan="2">365円</td>
											<td class="dashed-border" colspan="3">1082円</td>
											<td class="dashed-border bg-warning" colspan="3">216円</td>
											<td class="dashed-border" colspan="2">837円</td>
										</tr>
										<tr class="text-left" style="">
											<td nowrap class="border-bottom-warning bg-warning" colspan="2">▲169円</td>
											<td nowrap class="border-bottom-none" colspan="2">▲65円</td>
											<td nowrap class="border-bottom-none" colspan="3">▲104円</td>
											<td nowrap class="border-bottom-warning bg-warning" colspan="3">▲106円</td>
											<td nowrap class="border-bottom-none" colspan="2">▲126円</td>
										</tr>
										<tr class="text-left">
											
											<td class="padding-top-2 bg-warning" colspan="2">▲18%</td>
											<td class="padding-top-2" colspan="2">▲15%</td>
											<td class="padding-top-2" colspan="3">▲9%</td>
											<td class="padding-top-2 bg-warning" colspan="3">▲33%</td>
											<td class="padding-top-2" colspan="2">▲13%</td>
										</tr>
										<tr class="text-center">
											<td nowrap rowspan="3">楽天</td>
											<td class="dashed-border" colspan="2">906円</td>
											<td class="dashed-border" colspan="2">410円</td>
											<td class="dashed-border" colspan="3">841円</td>
											<td class="dashed-border" colspan="3">286円</td>
											<td class="dashed-border" colspan="2">805円</td>
										</tr>
										<tr class="text-left" style="">
											<td nowrap class="border-bottom-none" colspan="2">▲21円</td>
											<td nowrap class="border-bottom-none" colspan="2">▲20円</td>
											<td nowrap class="border-bottom-none" colspan="3">▲345円</td>
											<td nowrap class="border-bottom-none" colspan="3">▲36円</td>
											<td nowrap class="border-bottom-none" colspan="2">▲158円</td>
										</tr>
										<tr class="text-left">
											<td class="padding-top-2" colspan="2">▲18%</td>
											<td class="padding-top-2" colspan="2">▲15%</td>
											<td class="padding-top-2" colspan="3">▲29%</td>
											<td class="padding-top-2" colspan="3">▲11%</td>
											<td class="padding-top-2" colspan="2">▲16%</td>
										</tr>
										<tr class="text-center">
											<td nowrap rowspan="3">ヤフー</td>
											<td class="dashed-border" colspan="2">798円</td>
											<td class="dashed-border bg-warning" colspan="2">364円</td>
											<td class="dashed-border bg-warning" colspan="3">828円</td>
											<td class="dashed-border" colspan="3">285円</td>
											<td class="dashed-border bg-warning" colspan="2">785円</td>
										</tr>
										<tr class="text-left" style="">
											<td nowrap class="border-bottom-none" colspan="2">▲129円</td>
											<td nowrap class="border-bottom-warning bg-warning" colspan="2">▲66円</td>
											<td nowrap class="border-bottom-warning bg-warning" colspan="3">▲358円</td>
											<td nowrap class="border-bottom-none" colspan="3">▲37円</td>
											<td nowrap class="border-bottom-warning bg-warning" colspan="2">▲178円</td>
										</tr>
										<tr class="text-left">
											
											<td class="padding-top-2" colspan="2">▲14%</td>
											<td class="padding-top-2 bg-warning" colspan="2">▲15%</td>
											<td class="padding-top-2 bg-warning" colspan="3">▲30%</td>
											<td class="padding-top-2" colspan="3">▲12%</td>
											<td class="padding-top-2 bg-warning" colspan="2">▲18%</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="13">
												<ul style="padding: 10px; margin-bottom: 0; font-size: 11.7px;">
													<li>上記の表に、更にショップポイントと当社ポイントが付加されるので、一層お得です。</li>
													<li>当社ポイントはアマゾンギフトに交換できます。</li>
												</ul>
												<p>
													<span style="font-size: 20px;" class="text-danger">なぜ、ネット通販は、安いのか？</span> <br>
													<span style="font-size: 11.2px;">
														<span style="">①</span>スーパーの店舗は、一等地だが、ネット通販は店舗不要です。 <br>

														<span style="">②</span>ネット通販では、レジが不要だから、人件費が安い。<br>



													</span>
													
												</p>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
							
							<div class="table-responsive d-none d-md-block">

								<table class="table table-bordered bg-white product-main-list " style="width: 100%; float: left;  clear: left; ">
									<thead class="text-center">
										<tr>
											<th colspan="9" class="text-left">
												<h4 class="text-danger">都内スーパーとネット通販の価格比較</h4>

											</th>
										</tr>
										<tr class="product-tbl-head">
											<th nowrap style="vertical-align: middle;">品名</th>
											<th nowrap style="vertical-align: middle;">都内<br>Aスーパー</th>
											<th nowrap style="vertical-align: middle;" colspan="2">アマゾン</th>
											<th nowrap style="vertical-align: middle;" colspan="2">楽天</th>
											<th nowrap style="vertical-align: middle;" colspan="2">ヤフー</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td  nowrap class="p-1">味の素ほんだし <strong>450g</strong></td>
											<td nowrap rowspan="2">927円</td>
											<td rowspan="2"><span class="btn btn-outline-danger">758円</span></td>
											<td nowrap class="p-1">▲169円</td> 
											<td nowrap rowspan="2">906円</td>
											<td class="p-1">▲21円</td>
											<td rowspan="2">798円</td>
											<td class="p-1">▲129円</td>
										</tr>
										<tr>
											<td class="p-1">4901001257980</td>
											<td nowrap class="p-1">▲18%</td>
											<td nowrap class="p-1">▲2%</td>
											<td nowrap class="p-1">▲14%</td>
										</tr>
										<tr>
											<td nowrap class="p-1">日清キャノラー油 <strong>1300g</strong></td>
											<td nowrap rowspan="2">430円</td>
											<td rowspan="2">365円</td>
											<td class="p-1">▲65円</td>
											<td rowspan="2">420円</td>
											<td class="p-1">▲20円</td>
											<td rowspan="2"><span class="btn btn-outline-danger">364円</span></td>
											<td class="p-1">▲66円</td>
										</tr>
										<tr>
											<td class="p-1">4902380194323</td>
											<td nowrap class="p-1">▲15%</td>
											<td nowrap class="p-1">▲5%</td>
											<td nowrap class="p-1">▲15%</td>
										</tr>
										<tr>
											<td class="p-1">ネスカフェプレジデント瓶 <strong>65g</strong></td>
											<td nowrap rowspan="2">1186円</td>
											<td rowspan="2">1082円</td>
											<td class="p-1">▲104円</td>
											<td rowspan="2">841円</td>
											<td nowrap class="p-1">▲345円</td>
											<td rowspan="2"><span class="btn btn-outline-danger">480円</span></td>
											<td nowrap class="p-1">▲706円</td>
										</tr>
										<tr>
											<td class="p-1">4902201421720</td>
											<td nowrap class="p-1">▲9%</td>
											<td nowrap class="p-1">▲29%</td>
											<td nowrap class="p-1">▲60%</td>
										</tr>
										<tr>
											<td nowrap class="p-1">カントリーマアムバニラ&ココア <strong>20枚</strong></td>
											<td rowspan="2">322円</td>
											<td rowspan="2"><span class="btn btn-outline-danger">216円</span></td>
											<td class="p-1">▲106円</td>
											<td rowspan="2">286円</td>
											<td class="p-1">▲36円</td>
											<td rowspan="2">285円</td>
											<td class="p-1">▲37円</td>
										</tr>
										<tr>
											<td class="p-1">4902555170749</td>
											<td nowrap class="p-1">▲33%</td>
											<td nowrap class="p-1">▲11%</td>
											<td nowrap class="p-1">▲12%</td>
										</tr>
										<tr>
											<td class="p-1">いいちこ25度 <strong>900ml</strong></td>
											<td rowspan="2">963円</td>
											<td rowspan="2">837円</td>
											<td class="p-1">▲126円</td>
											<td rowspan="2">805円</td>
											<td class="p-1">▲158円</td>
											<td rowspan="2"><span class="btn btn-outline-danger">785円</span></td>
											<td class="p-1">▲178円</td>
										</tr>
										<tr>
											<td class="p-1">4906666111318</td>
											<td nowrap class="p-1">▲13%</td>
											<td nowrap class="p-1">▲16%</td>
											<td nowrap class="p-1">▲18%</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="9">
												<ul style="padding: 10px; margin-bottom: 0;">
													<li>上記の表に、更にショップポイントと当社ポイントが付加されるので、一層お得です。</li>
													<li>当社ポイントはアマゾンギフトに交換できます。</li>
												</ul>
												<p >
													<span style="font-size: 20px;" class="text-danger">なぜ、ネット通販は、安いのか？</span> <br>
													<span style="font-size: 14px;">
														①　スーパーの店舗は、一等地だが、ネット通販は店舗不要です11111。 <br>
														②　ネット通販では、レジが不要だから、人件費が安い22222。<br>
                                                        ③　ネットなので価格比較が容易 加盟店の間で価格競争が激しい。
													</span>
													
												</p>
											</td>
										</tr>
									</tfoot>
								</table>
							</div>
							
							<!-- <div class="heading2-box">
								<div class="float-left" style="width: 4%">
									①
								</div>
								<div class="float-left" style="width: 96%">
									<p class="" style="">
											<span class="text-primary font-weight-bold">「価格比較を  しない人が多い」</span> という調査結果があります。<br>
									</p>
								</div>
								<div class="float-left" style="width: 4%">
									② 
								</div>
								<div class="float-left" style="width: 96%">
									<p class="" style="">
										ショップポイントに加え、当社ポイントを付加しますので、一層お得です。<br><span style="color: white; background-color: #e70c81">ダブルポイント</span> となり、割安で購入できますので、 <span class="text-primary font-weight-bold">消費税は ふっ飛びます。</span> <br>
										ダブルポイント(D.P)は  <span class="text-primary font-weight-bold">アマゾン  ギフト</span> に交換できます。
									</p>
								</div>
								<div class="clearfix"></div>
							</div> -->
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-2">
							
						</div>
						<div class="col-md-7">

							<!-- <p class="pl-1">
								このサイトで購入すると、<br>① ショップポイントに加え <br>
								②当社ポイント、<span style="color: #ff8507; font-weight: bold;">チャリン<sup>2</sup></span> が付きますので、一層お得です。
							</p>
							<hr style="border-color:red;"> -->
<!--							<p class="heading2-box box_message_shadew">-->
<!--								<span class="" style="color: blue; font-weight: bold;">ショールーミング</span>（店舗での価格比較） <br>-->
<!--								スーパーや家電•ドラッグ•化粧品•••などの店で、スマホで撮影して価格比較出来ます。-->
<!--							</p>-->
                            <p class="heading2-box box_message_shadew">
								<span class="" style="color: blue; font-weight: bold;">ダブルポイント</span> <br>
                                店舗ポイントに、当社ポイントが追加 <br>されるので一層お得です。

							</p>
							
						</div>
						<div class="col-md-3 desktop_show" style="padding: 0">
							<div class="row">
								<div class="col-md-1">
									
								</div>
								<div class="col-md-11">
<!--									<div class="col-md-12 float-right" style=" background-color: white; padding: 10px;">-->
<!--                                        <img class="float-right" width="100%" src="--><?php //echo base_url().RES_DIR; ?><!--/img/jafa-logo2.png">-->
<!--                                        <a class="float-right" style="font-size: 16px;" href = "mailto: info_jafa@jacos.co.jp">メール：info_jafa@jacos.co.jp</a>-->
<!--									</div>-->
								</div>
							</div>
							
							<div class="clearfix"></div>
								
								<!-- <div class="row float-right" style="background-color: white;">
									<a href = "mailto: info_jafa@jacos.co.jp">メール：info_jafa@jacos.co.jp</a>
								</div> -->
							<!-- </div> -->
							
						</div>	
				</div>
			</div>
				<div class="col-sm-12 col-md-2 btn_aria_mobile">					
					
					<?php
					if (!$this->authentication->is_signed_in()) {?>
						<button class="btn btn-default btn-lg text-center home_page_button customer_reg_btn" id="customer_reg_btn" style="">登録・変更</button>
					<button class="btn btn-default btn-lg text-center user_login_btn home_page_button" id="user_login_btn">ログイン</button>
						<?php
					}else{
						?>
						<!-- <button class="btn btn-default btn-lg text-center home_page_button customer_reg_btn" id="customer_reg_btn" style="">登録・変更</button> -->
							<a href="<?= base_url() ?>account/sign_out" class="btn btn-default btn-lg text-center home_page_button customer_logout">ログアウト<span class="float-right"></span></a>
						<!-- <span class="clearfix"></span> -->
							<button class="btn btn-default btn-lg text-center change_password home_page_button" id="change_password">パスワード変更</button>
							<!-- <span class="btn-sparate"></span> -->
						<!-- <span class="clearfix"></span> -->
						<?php
					}
					?>
					<button class="btn btn-default btn-lg text-center home_page_button introduce_btn"  style="margin-right: 0;">ご紹介</button>
					<!-- <span class="btn-sparate"></span> -->
				</div>   
			</div>
			
		</div>
			<div class="row second-box" id="second-box" style="background-color: #CBEBF6;">
				<div class="col-md-9 pdding-zero">
					<!-- <form class="form-inline" action="false"> -->
						<div class="row">
							<div class="col-md-2 col-sm-12 desktop_show">
								<legend class=""><strong style="font-size: 30px;">価格比較</strong></legend>
							</div>
							<div class="col-md-4 col-sm-12">
								<button id="startButton" class="btn btn-primary text-center btn-lg play_scaner col-sm-12 startButton" style="">
									<p style="margin: 0; font-size: 28px;" class="text-center">価格比較
										<img style="padding: 5px; width: 130px; height: 50px; margin-left: 5px; margin-top: -8px;" src="resources/img/barcode.png">
									</p>
									<center>ここを押してバーコード撮影</center>
									
									</button>
							</div>
							<span class="float-right qrcode_pc">
								
								<img class="float-left" width="100" style="margin-bottom: 5px;" src="resource/img/qrcode_pc.png">
								<button style="margin-left: 10px;" class="btn btn-primary btn-lg float-left text-center"><i class="fa fa-arrow-left"></i> 紹介QRコード
									<p style="font-size: 16px;">このQRコードを読み取ってください</p>
								</button>
								
								
							</span>
							<div class="clearfix"></div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<button id="start-record-btn" style="" class="btn btn-primary btn-lg microphone microphone_btn_mobile col-sm text-center" type="button">
									<p class="text-center" style="margin-bottom: 0;">
										<span class="microphone_icon"><i class="fa fa-microphone-alt"></i></span>
										<span class="voice_search_text">ＡＩ音声検索</span>
									</p>
									
									<!-- <span class="mobile_hide_countdown d-none" style="font-size: 26px; font-weight: bold;">2.0</span> -->
								<p class="text-center" style="margin:0; margin-top: -10px;">
									<small class="" style="font-size: 16px; text-align: left;">
										<span class="voice_small_text">※ボタンを押して商品名をお話しください</span>
									</small>
								</p>
								</button>
							</div>
							
						</div>
						
						

						<div class="form-group col-sm-12" style="margin-bottom: 5px; padding: 0;">
							
							<label class="float-left desktop_show" for="barcode" style="font-size: 22px; margin-right: 10px;">商品検索<br>最安値 </label>
							
							
							
							<!-- <button class="btn-default btn_link btn-lg play_scaner" type="button" data-toggle="modal" data-target="#livestream_scanner" style="">スマホでバーコードを撮影</button> -->
							
							

							<div  style="padding: 0; border: 3px solid blue; border-radius: 4px;" class="input-group col-sm-6 barcod_input_right float-left">
							  <input type="text" id="product_keyword3" class="form-control" placeholder="商品名入力（バーコードが無い場合）" aria-label="Recipient's username" value="<?= $search_barcode ?>" aria-describedby="basic-addon2">
							  <div class="input-group-append" style="background-color: white;">

							    <span class="input-group-text" id="clean_product_name" style="padding: 2px; color: #00A0E8; background-color: white; border-left: 2px solid white;"><i class="fa fa-window-close fa-3x"></i></span>
							  </div>

							</div>
							<div class="mobile_show row" style="margin-bottom: 5px;">
								<div class="clearfix"></div>
								<div class="col-sm-12">
									<button class="btn btn-primary" style="width: 100%">
										<span class="float-left" style="text-align: left; font-size: 23px; font-weight: normal; vertical-align: middle; margin-top: 25px;">
											紹介用ＱＲコード 
											<p style="font-size: 11px; font-weight: normal;">このQRコードを読み取ってください</p>
										</span>
											<img class="float-right" style="width: 110px;" src="resource/img/qrcode_pc.png">	
									</button>
								</div>						
							</div>
							<button id="start-record-btn" style="margin-left: 5px; margin-bottom: 5px; font-size: 26px;" class="btn btn-primary btn-lg microphone microphone_btn float-left text-center" type="button" style="">
									
									<p class="text-center" style="margin: 0;">
										<span class="microphone_icon">
										<i  class="fa fa-microphone-alt"></i>
										</span> 
										<span class="voice_search_text clearfix">ＡＩ音声検索</span>
									</p>
									
									<!-- <p style="margin-top: -10px"> -->
										<small class="" style="font-size: 10px;margin-top: -10px; text-align: left;">
										<span class="voice_small_text">※ボタンを押して商品名をお話しください</span>
										</small>
									<!-- </p>							 -->
							</button>
							
							<button style="margin-left: 5px; font-size: 26px;" class="btn btn-primary btn-lg float-left point_table_btn" id="">ポイント残高</button>
							<?php
							if (!empty($account_role) && $account_role->role_id == 1) {
								?>
								<button style="margin-left: 5px; font-size: 26px;" id="purchase_history" class="btn btn-primary btn-lg float-left">履歴</button>
								<?php
							}elseif (!empty($account_role) && $account_role->role_id == 2) {
								?>
								<button style="margin-left: 5px; font-size: 26px;" id="purchase_history" class="btn btn-primary btn-lg float-left">履歴</button>
								<?php
							}else{
							?>
							<button style="margin-left: 5px; font-size: 26px;" id="purchase_history" class="btn btn-primary btn-lg float-left">履歴</button>
							<?php
							}
							?>

						</div>
				</div>
				<div class="col-md-3 text-center product_image_parent d-none">
					<h5 class="search_result"></h5>
					<div class="product_image" id="product_image">
							
					</div>
								
				</div>				
				
				<div class="col-md-12 affiliate_list table-responsive" id="affiliate_list" style="position: relative;">					
					
					<table class="table compare_table" style="background: white; font-size: 22px;">
						<thead>
							<tr>
								<th colspan="5" style="padding: 0;">
									<table class="table product_name_table" style="margin: 0; border: 1px solid #CBEBF6;">
										<tbody style="margin: 0; padding: 0;">
											<tr>
												<td id="jan_product_name">
													&nbsp
												</td>
											</tr>
										</tbody>
										
									</table>
								</th>
								<th colspan="3" style="background-color: #CBEBF6; border-bottom: 1px solid #00A0E8; border-top: none; border-right: none; ">
								</th>
							</tr>

						</thead>
						<tbody id="comparing_table">
							<tr>
								<th style="width: 3%" class="align-middle text-center" nowrap>順位</th>
								<th colspan="2" class="align-middle text-center" nowrap>ショップ名</th>
								<th class="align-middle text-center" style="background-color: #CBEBF6; width: 3%;" nowrap>実質<br>価格</th>
								<th style="width: 3%" class="align-middle text-center" nowrap>価格<br>(税込)</th>
								<th class="align-middle text-center" style="width: 5%" nowrap>ショップ<br>ポイント</th>
								<th nowrap class="align-middle text-center"  style="background-color: #CBEBF6; width: 5%;" nowrap>当社ポイント<br>（D.P）</th>
								
								<th nowrap style="width: 5%" class="align-middle text-center" nowrap>サイト</th>
							</tr>
							<?php
							for ($i=0; $i < 3; $i++) { ?>
								<tr>
									<td class="text-center" style="vertical-align: middle;"><?= $i+1; ?>位</td>
									<td style="width: 10%">&nbsp</td>
									<td>&nbsp</td>
									<td class="text-center" style="background-color: #CBEBF6" id="amazon_realPrice">&nbsp</td>
									
									<td class="text-center point_details">&nbsp</td>
									<td class="text-center">&nbsp</td>
									<td class="text-center" style="background-color: #CBEBF6">&nbsp</td>
									
									<td class="text-center">
										<!-- <button class="btn btn-warning btn-lg">購入へ</button> -->
									</td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<div class="product_loading_image text-center" style="position: absolute;bottom:5px; width: 80%;">
						<!-- <img style=" margin-top: -500px;" align="center" src="resource/img/ajax/loading.gif"> -->
					</div>

				</div>
				<div class="col-sm-12 text-center desktop_show">
					<button class="btn btn-link btn-lg text-primary trams_condition"  style="text-decoration: underline;" data-toggle="modal" data-target="#trams_condition_modal">利用規約</button>
					<button class="btn btn-link btn-lg text-primary privacy_policy" style="text-decoration: underline;" data-toggle="modal" data-target="#privacy_policy">個人情報保護方針</button>
				</div>
								
			</div>
			<!-- End Second Box -->
			<div class="container compare_table_padding">

				<div class="row">
				       
				    <div class="table-responsive" style="padding: 0px; border: 2px solid #00A0E8;">
				       	<table class="table table-bordered compare_table_mobile" style="margin-bottom: 0;">
				       		<thead>
				       			<tr>
				       			    <th colspan="6"><span id="jan_product_name2"></span></th>
				       			</tr>
				       			
				       		</thead>
				       		<tbody class="mobile_compare_table" id="mobile_compare_table" >
				       			<tr>
				       				<td nowrap class="align-middle text-center" style="">ショップ</td>
				       	    		<td nowrap class="align-middle text-center" style="border-right: 0; border-top: 0; background-color: #CBEBF6;">実質価格</td>
				       	    		<td nowrap class="align-middle text-center" style="background-color: white ">価格</td>
				       	    		<td style="background-color: white " nowrap class="align-middle text-center">ショップP</td>
				       	    		<td style=" background-color: #CBEBF6; " nowrap class="align-middle text-center">当社<br>ポイント</td>
				       	    		<td style="background-color: white" nowrap class="align-middle text-center">サイト</td>
				       			</tr>
				       			<?php
				       	    	for ($i=1; $i <4 ; $i++) { 
				       	    		
				       	    	?>
				       	    	<tr>
				       	    		<td style=""><?= $i; ?> 位</td>
				       	    		<td style=" background-color: #CBEBF6;"></td>
				       	    		<td style=""></td>
				       	    		<td style=""></td>
				       	    		<td style="background-color: #CBEBF6;"></td>
				       	    		<td style=""></td>
				       	    	</tr>
				       	    	<?php
				       	    	}
				       	    	?>
				       		</tbody>
				       	</table>
				     	<div class="product_loading_image_mobile text-center" style="position: absolute;bottom:5px; width: 80%;">
						</div>   
						<div class="col-sm-12 text-center mobile_show">
							<button class="btn btn-link btn-lg text-primary trams_condition" style="text-decoration: underline;" data-toggle="modal" data-target="#trams_condition_modal">利用規約</button>
							<button class="btn btn-link btn-lg text-primary privacy_policy" style="text-decoration: underline;"  data-toggle="modal" data-target="#privacy_policy">個人情報保護方針</button>
						</div>
				</div>

				<div class="container" style="padding: 10px;">
							<?php
							$fullname = "";
							if ($this->authentication->is_signed_in()) {
								$fullname = $account_details->fullname;
								?>
								<h6 class="float-left" style="background-color: white; padding: 10px; border-radius: 6px; max-width: 50%">
								<span style="  text-decoration: underline;text-decoration-color: blue; color: blue;"> <?= $fullname ?></span>
								<span style="color: blue"> 様</span>
								</h6>
								<?php
							}
							?>
								
							
						<div class="float-right mobile_show" style="width: <?= $this->authentication->is_signed_in()? '50%':'75%'; ?>; margin-right: 10px">


<!--							<img class="float-right" width="100%" height="100%" src="--><?php //echo base_url().RES_DIR; ?><!--/img/jafa-logo2.png">-->
<!--							<br>-->
							<p style="margin: 6px 0; font-size: 16px;" class="text-right"></p>
<!--							<p style="margin: 0; font-size: 12px;" class="text-right"><a href = "mailto: info_jafa@jacos.co.jp">メール：info_jafa@jacos.co.jp</a></p>-->
						</div>
				</div>
			</div>
			<!------ </.row-------->
			</div>
			<!------ </.container-------->
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
									<th nowrap class="align-middle text-center" style="border-left: 0; border-top:0; background-color: white border-top-left-radius:20px;">ショップ</th>
									<!-- <th nowrap colspan="2" class="align-middle text-center">販売店（ショップ名)</th> -->
									
									<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0; background-color: #CBEBF6;">実質価格</th>
									<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0;background-color: white ">価格</th>
									<th style="background-color: white " nowrap class="align-middle text-center">ショップP</th>
									<th style=" background-color: #CBEBF6; " nowrap class="align-middle text-center">当社<br>ポイント</th>
									<th style="background-color: white border-top-right-radius:20px; " nowrap class="align-middle text-center">サイト</th>
									
								</tr>
							</thead>
							<tbody id="lowest_ten_table">
								
								<?php
								for ($i=1; $i <11 ; $i++) { 
									
								?>
								<tr>
									<td style="border-left: 0; border-bottom: <?= ($i==10)?'0;':'' ?>"><?= $i; ?> 位</td>
									<!-- <td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td> -->
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>; background-color: #CBEBF6;"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>; background-color: #CBEBF6;"></td>
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
			  			<button class="btn btn-danger float-right btn-lg" id="close_point_detail">戻る</button>
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
					<button class="btn btn-danger float-right btn-lg close_loged_user_infor" id="login_option_close">戻る</button>
					<center><h4 style="padding-top: 40px; padding-bottom: 20px">選択してください。</h4></center>
					<center>
						<button class="btn btn-default user_login_btn222" attr-user-role="2" style="background-color: #FFFF99; padding: 5px 20px; width: 120px; border:2px solid #3D618C;">加盟企業</button>
						<button class="btn btn-default user_login_btn" attr-user-role="3" style="background-color:#FFCCFF; padding: 5px 20px; width: 120px;border:2px solid #3D618C;">会員</button>
						<button class="btn btn-default user_login_btn" id="management_login_btn" attr-user-role="1" style="background-color:#008000; color: white;padding: 5px 20px; width: 120px;border:2px solid #3D618C;">管理画面</button>
					</center>
				</div>
			</div>
			<!-- <div class="card point_table_aria d-none" style="background: #eee;position: fixed; right: 30px; bottom: 10px; padding: 0; border:2px solid #3D618C;"> -->
			<div class="card point_table_aria d-none" style="background: #eee;position: fixed; right: 10px; bottom: 5px; padding: 0; border:2px solid #3D618C;">
				<div class="card-header">
					<p class=""><span style="font-size: 26px">ポイント残高</span> <button class="btn btn-lg btn-danger float-right close_loged_user_infor" id="point_table_aria_close">戻る</button></p>
					
				</div>

				<div class="card-body bg-white">					
					<div class="row">
						<div class="card d-none cornvert_point_condition_less_aria"  style="background: #eee;position: fixed; right: 40px; bottom: 100px; padding: 0; border:2px solid #3D618C; z-index: 1000">
							<div class="card-header">
								<div class="row">
									<div class="col-sm">
										<button class="btn btn-danger float-right btn-lg cornvert_point_condition_less_aria_close float-right" >戻る</button>
									</div>
								</div>
							</div>
							<div class="card-body bg-white">	
								
								<div class="row">
									<div class="col-sm">
										
										<p id="condition_less_content_aria">
											<!-- チャリン２確定ポイントが
											<strong class="parmanet_exc_point"></strong><br> -->
											500ポイント未満なので、交換できません

										</p>
										
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-sm" style="padding: 0">
							<div class="alert alert-info" style="padding: 5px;" role="alert">
							  	<p style="margin-bottom: 0; font-size: 20px;">
							  		購入後３０日間で、アマゾンギフトに交換できます。<br>
							  		ただし、５００ポイント単位です。
							  	</p>
							</div>
							
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

			<div class="card d-none" id="amazon_gift_pint_aria" style="background: #eee;position: fixed; right: 10px; bottom: 5px; padding: 0; border:2px solid #3D618C;">
				<div class="card-header">
					<div class="row">
						<div class="col-sm">
							<button class="btn btn-danger float-right btn-lg close_loged_user_infor float-right" id="amazon_gift_pint_aria_close">戻る</button>
						</div>
					</div>
				</div>
				<div class="card-body bg-white">						
					<div class="row">
						<div class="card d-none cornvert_point_condition_less_aria"  style="background: #eee;position: fixed; right: 40px; bottom: 100px; padding: 0; border:2px solid #3D618C; z-index: 1000">
							<div class="card-header">
								<div class="row">
									<div class="col-sm">
										<button class="btn btn-danger float-right btn-lg cornvert_point_condition_less_aria_close float-right" >戻る</button>
									</div>
								</div>
							</div>
							<div class="card-body bg-white">	
								
								<div class="row">
									<div class="col-sm">
										<p class="condition_less_content_aria" >
											500ポイント未満なので、交換できません。
										</p>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-sm">
							<ul style="padding: 0">
								<ol style="padding: 0">１．メールでアマゾンギフトコードを送信します。</ol>
								<ol style="padding: 0">２．Amazonサイトで、コード番号を入力します。</ol>
								<ol style="padding: 0">３．ポイントを使って買い物ができます。</ol>
							</ul>
							<p>
								（割引きになります）
							</p>
							<div class="alert alert-primary" role="alert">
								<div class="d-none text_point_aria mobile_show" style="width: 100px; font-size: 18px; background: #eee;position: fixed; right: 10px; bottom: 8px; padding: 0; border:2px solid #3D618C;">
									<ul style="padding: 0; margin: 0;">
										<!-- <li class="text_point_aria_close" style="list-style: none; padding: 10px; border-bottom: 1px solid #3D618C; text-align: center;">
											<button class="btn btn-lg btn-danger"> 戻る </button>
										</li> -->
										<?php
										for($i=1; $i<11; $i++){
										   ?>
										   <li class="point_convert_list" style="list-style: none; padding: 9px; border-bottom: 1px solid #3D618C; text-align: center;"><?= (500*$i) ?></li>
										   <?php
										}
										?>
										
									</ul>
								</div>
								<form>
								  
								  <div class="form-group row">
								      <label style="width: 60%; padding-left: 15px;" for="staticEmail" class=" col-form-label">交換依頼ポイント数</label>
								      <div class="" style="width: 40%; padding-right: 15px;">
								      	<input type="text" class="form-control mobile_show" id="point_convert_amount_text" readonly="readonly" value="500" name="">
								      	<select class="form-control point_convert_amount desktop_show" >
								      		<option value="500">500</option>
								      		<option value="1000">1000</option>
								      		<option value="1500">1500</option>
								      		<option value="2000">2000</option>
								      		<option value="2500">2500</option>
								      		<option value="3000">3000</option>
								      		<option value="3500">3500</option>
								      		<option value="4000">4000</option>
								      		<option value="4500">4500</option>
								      		<option value="5000">5000</option>
								      	</select>
								        <!-- <input  type="text" class="" id="staticEmail" value="500"> -->
								      </div>
								    </div>
								  
								  <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
								</form>
								<!-- <p><input class="form-control float-right" style="width: 75px;" type="number" name=""></p> -->
								交換ポイント単位は	
								500ポイント単位となります。
							</div>
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

						<button class="btn btn-default btn-lg jafa_btn" id="amazon_gift_pint_purchase_btn" style="font-size: 24px; width: 100%; margin-bottom: 10px;">ポイント交換依頼</button>
						
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

			
			<div class="card d-none" id="cornvert_point_condition_getter_aria" style="background: #eee;position: fixed; right: 10px; bottom: 5px; padding: 0; border:2px solid #3D618C;">
				
				<div class="card-body bg-white">					
					<div class="row">
						<div class="col-sm">							
							<p>
								<strong class="converted_point" id="converted_point"></strong> ポイントの交換を受け付けました。<br>
								次回の買い物から使用できます。<br>
								確定ポイントの残りは <strong class="parmanet_exc_point"></strong>ポイント です。<br>
								交換内容を登録されたメールアドレスに送りました。<br>
								チャリン２確定ポイントをAmazonギフトに交換します。
							</p>							
						</div>						
					</div>
					<center>

						<button class="btn btn-primary btn-lg jafa_btn" id="cornvert_point_condition_getter_aria_close" style="font-size: 24px; width: 100%; margin-bottom: 10px;">確認</button>
						
					</center>
				</div>
			</div>
			<div class="card customer_login_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
				<div class="card-header info">
	                <p class=""><span id="role_name"></span><?= lang('sign_in_sign_in') ?> <button class="btn btn-danger float-right btn-lg" id="customer_login_screen_close">戻る</button></p>
	                               
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
						    	次回から自動でログイン
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
			<!-- <div class="card customer_login_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;"> -->
			<div class="card registration_alert d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">				
				<div class="card-header text-right">
					<button class="btn btn-danger btn-lg back_button" id="registration_alert_close">戻る</button>
	                               
	            </div>
			  	<div class="card-body" style="padding-bottom: 0;">
			  		<center><h4>会員登録をしてください。</h4></center>
			  		<div class="col-md-12" style="margin-bottom: 10px;">
			  			<center>
			  				<button class="btn btn-primary btn-lg reg_alert_reg">登録</button>
			  			</center>
			  		</div>
			  		<div class="clearfix"></div>
			  	</div>
			</div>
			<!-- // Start Forgot Password -->

			<div class="card forgot_password_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
				<div class="card-header info">
	                <p class=""><span id="role_name"></span> パスワードを忘れた方 <button class="btn btn-danger float-right btn-lg" id="forgot_password_screen_close">戻る</button></p>
	                               
	            </div>
			  	<div class="card-body" style="padding-bottom: 0;">
			  		<p class="text-danger" id="forgot_password_error"></p>
	               	<?php echo form_open(base_url('account/forgot_password'), 'class="form-horizontal"'); ?>
					<?php echo form_fieldset(); ?>  
						<div class="form-group row">
							<label class="col-md-4 control-label" for="sign_in_username_email">携帯番号</label>  
							<div class="col-md-8">
								<input id="forgot_username_email" name="forgot_username_email" type="text" placeholder="携帯番号（１１桁以上）" class="form-control input-md" required="">

							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-12">
								<center>
									<?php echo form_button(array('type' => 'button', 'class' => 'btn btn-success sent_password_reset_link', 'style'=> 'background-color: #469C46; color: white', 'content' => '<i class="fa fa-paper-plane"></i> パスワードの変更を送信')); ?>
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
					
					<button class="btn btn-danger float-right btn-lg close_loged_user_infor" id="loged_infor_close">戻る</button>
					<p class="loged_in_username" style="padding-top: 40px;">Loading...</p>
					<center><button class="btn btn-primary btn-lg close_loged_user_infor" style="background-color: #FFFF99">確認</button></center>
				</div>
			</div>
			<div class="card bg-info d-none sent_password_reset_link_sent_screen" id="sent_password_reset_link_sent_screen"  style="position: fixed;  padding: 0; border:2px solid #3D618C;">
				<div class="card-body">
					
					<p class="sent_password_reset_message" style="padding-top: 40px; color: white;"></p>
					<center><button class="btn btn-primary btn-lg sent_password_reset_link_sent_screen_close" style="background-color: #FFFF99">確認</button></center>
				</div>
			</div>


			<!-- // Start Change Password -->
			<div class="card change_password_screen d-none" style="position: fixed;  padding: 0; border:2px solid #3D618C;">
				<div class="card-header info">
	                <p class=""><span id="role_name"></span> パスワード変更 <button class="btn btn-danger float-right btn-lg" id="change_password_screen_close">戻る</button></p>
	                               
	            </div>
			  	<div class="card-body" style="padding-bottom: 0; padding-top: 0px;">
			  		<p class="text-danger text-center" id="change_password_error"></p>
	               	<?php echo form_open(base_url('account/forgot_password'), 'class="form-horizontal"'); ?>
					<?php echo form_fieldset(); ?>  
						<div class="form-group row">
							<label class="col-md-4 control-label" for="current_password">現在のパスワード</label>  
							<div class="col-md-8">
								<input id="current_password" name="current_password" type="text" placeholder="現在のパスワード" class="form-control input-md" required="">

							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 control-label" for="password_new_password">新パスワード（４桁以上）</label>  
							<div class="col-md-8">
								<input id="password_new_password" name="password_new_password" type="text" placeholder="新パスワード（４桁以上）" class="form-control input-md" required="">

							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-4 control-label" for="password_retype_new_password">再入力</label>  
							<div class="col-md-8">
								<input id="password_retype_new_password" name="password_retype_new_password" type="text" placeholder="再入力" class="form-control input-md" required="">

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
							<button style="background-color: #DBEEF4; color: black; width: 145px;" class="btn btn-info float-left btn-lg" id="see_case_product" >はい</button>
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
								<center><button style="background-color: #FFFF99" class="btn btn-primary btn-lg" id="inistall_android_apps_btn">確認</button></center>	
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
								<center><button style="background-color: #FFFF99" class="btn btn-primary btn-lg" id="go_itune_btn">確認</button>	</center>		
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
				<button class="btn btn-danger float-right btn-lg close_loged_user_infor" id="barcode_scan_option_close">戻る</button>
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
					<!-- <h5>紹介・問い合わせ</h5> -->
					<div class="float-left" style="width: 40%;margin-top: 10px;">
						<span style="font-size: 18px; "> ご紹介者本人 </span>
					</div>
					<div class="float-left" style="width: 60%">
						<span><small>貴方様は登録済みですので入力は不要です</small></span>
					</div>
					<div class="clearfix"></div>
					
				</div>
				<div class="card-body" style="border: 3px solid black; border-top: 0; overflow: auto;">
					
					<div class="tab-content" id="pills-tabContent">
					  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

					  	<form class="form-horizontal" id="introduce_form" return false;>
					  	<fieldset>
					  		<!-- Individual Introducer-->
					  		<label class="col-md-12 control-label row" for="introduce_name0">紹介相手 ①</label>  
					  		<div class="form-group form-row">
					  		  		<input id="introduce_name0" style="ime-mode: active;" name="introduce_name[]" type="text" placeholder="お名前" class="form-control input-md">	
					  		</div>
					  		<div class="form-group form-row">
					  		  		<input id="introduce_phone0" style="ime-mode: inactive;" name="introduce_phone0[]" type="text" placeholder="携帯番号
" class="form-control input-md">
					  		</div>

					  		<div class="form-group form-row" style="border-bottom: 2px dotted black; padding-bottom: 10px;">
					  		  	<!-- <label class="col-md-4 control-label" for="introduce_phone0">Eメール</label>   -->
					  		  	<!-- <div class="col-md-8"> -->
					  		  		<input id="introduce_email0" style="ime-mode: inactive;" name="introduce_email[]" type="text" placeholder="メール" class="form-control input-md">					  		  
					  		  	<!-- </div> -->
					  		</div>
					  		<!-- Individual Introducer-->
					  		<label class="col-md-12 control-label row" for="introduce_name1">紹介相手 ②</label>  
					  		<div class="form-group form-row">
					  		  	
					  		  	<!-- <div class="col-md-8"> -->
					  		  		<input id="introduce_name1" style="ime-mode: active;" name="introduce_name[]" type="text" placeholder="お名前" class="form-control input-md">					  		  
					  		  	<!-- </div> -->
					  		</div>
					  		<div class="form-group form-row">
					  		  	<!-- <label class="col-md-4 control-label" for="introduce_phone0">Eメール</label>   -->
					  		  	<!-- <div class="col-md-8"> -->
					  		  		<input id="introduce_phone1" style="ime-mode: inactive;" name="introduce_phone[]" type="text" placeholder="携帯番号
" class="form-control input-md">					  		  
					  		  	<!-- </div> -->
					  		</div>
					  		<div class="form-group form-row" style="border-bottom: 2px dotted black; padding-bottom: 10px;">
					  		  		<input id="introduce_email1" style="ime-mode: inactive;" name="introduce_email[]" type="text" placeholder="メール" class="form-control input-md">	
					  		</div>
					  		<!-- Individual Introducer-->
					  		<label class="col-md-12 control-label row" for="introduce_name1">紹介相手 ③</label>  
					  		<div class="form-group form-row">
					  		  		<input id="introduce_name2" style="ime-mode: active;" name="introduce_name[]" type="text" placeholder="お名前" class="form-control input-md">	
					  		</div>
					  		<div class="form-group form-row">
					  		  		<input id="introduce_phone2" style="ime-mode: inactive;" name="introduce_email[]" type="text" placeholder="携帯番号
" class="form-control input-md">
					  		</div>
					  		<div class="form-group form-row" style="border-bottom: 2px dotted black; padding-bottom: 10px;">
					  		  	
					  		  		<input id="introduce_email2" style="ime-mode: inactive;" name="introduce_email[]" type="text" placeholder="メール" class="form-control input-md">		
					  		</div>
					  		<div class="form-row text-center">
				  				<button id="save_introduce" name="save_introduce" class="btn btn-default btn-warning btn-lg float-left" style="width: 150px; margin-right: 10px;">送信</button>
				  				<button id="close_introduce_screen" name="close_introduce_screen" style="width: 150px;" class="btn btn-danger btn-lg float-right back_button">戻る</button>
					  		</div>
					  						  		
					  	</fieldset>
					  	</form>
					  </div>
					  
					</div>
					
				</div>
				
			</div>
		</div>

		<div class="d-none card float-right col-md-3 col-sm-12 partner_contact_success_aria" id="partner_contact_success_aria" style="position: fixed; right: 3px; bottom: 10px; padding: 0">
			<div style="position: relative;">
				<div class="card-header bg-white" style="border-top:3px solid black; border-left: 3px solid black; border-right: 3px solid black; border-bottom: 2px solid #8A0B15;">
					<h5>ご紹介</h5>
				</div>
				<div class="card-body"style="border: 3px solid black; border-top: 0; overflow: auto;">
					<div id="email_sending_message">
						<center><img src="<?= base_url() ?>resource/img/ajax/loading.gif"></center> 
					</div>

					<center><button style="font-size: 22px; width: 100px;" class="btn btn-danger partner_contact_success_aria_close btn-lg">戻る</button></center>
				</div>

			</div>
		</div>

		<div class="d-none float-right col-md-4 col-sm-12 introduce_screen" style="padding: 0; z-index: 100; overflow: auto; background: #f0ffcc" id="member_reg_form">
			<div style="position: relative; height: 100%">
				<div class="card-header" style="border-top:3px solid black; border-left: 3px solid black; border-right: 3px solid black; border-bottom: 2px solid #8A0B15;">
					<center><h4>登録・変更</h4></center>
				</div>
				<div class="card-body" style="border: 3px solid black; border-top: 0; overflow: auto;">
					    	<form class="form-horizontal" action="account/sign_up" method="post">
					    		<input type="hidden" name="request_url" value="company_margine">
					    		<input type="hidden" name="refaral" value="<?= $this->input->get('refaral') ?>">
							  	<fieldset>
							  		<table class="table table-striped" style="margin-bottom: 0">
							  			<tr>
							  				<th style="border-color: #dee2e6" width="35%"><label class="control-label" for="sign_up_fullname">お名前</label></th>
							  				<td>
							  					<?php echo form_input(array('name' => 'fullname', 'id' => 'sign_up_fullname', 'required' => 'required', 'style' => 'ime-mode: active;', 'placeholder' => 'お名前', 'class'=>'form-control', 'value' => set_value('fullname') ? set_value('fullname') : (isset($update_account_details->firstname) ? $update_account_details->firstname : ''), 'maxlength' => 80)); ?>

							  						<span id="sign_up_fullname_error" class="help-block text-danger blinking"></span>
							  					          
							  				</td>
							  			</tr>
							  			<tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="ajax_sign_up_username">携帯電話</label> 
							  				</th>
							  				<td>
							  					<?php echo form_input(array( 'type' => 'tel', 'name' => 'ajax_sign_up_username', 'placeholder' => '携帯電話', 'required' => 'required', 'style' => 'ime-mode: inactive', 'id' => 'ajax_sign_up_username', 'class'=>'form-control', 'value' => set_value('sign_up_username') ? set_value('sign_up_username') : (isset($update_account->username) ? $update_account->username : ''), 'maxlength' => 160)); ?>

							  					<span id="username_error" class="help-block text-danger blinking"></span>
							  					
							  				</td>
							  			</tr>
							  			<tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="sign_up_email">メールアドレス</label> 
							  				</th>
							  				<td>
							  					<?php echo form_input(array('name' => 'sign_up_email', 'id' => 'sign_up_email', 'placeholder' => 'メールアドレス', 'required' => 'required', 'style' => 'ime-mode: inactive', 'class'=>'form-control', 'value' => set_value('sign_up_email') ? set_value('sign_up_email') : (isset($update_account->email) ? $update_account->email : ''), 'maxlength' => 160)); ?>

							  					            
							  					    
							  					<span id="email_error" class="help-block text-danger blinking"></span>
							  				</td>
							  			</tr>
							  			<!-- <tr>
							  				<td colspan="2">
							  					<small  class="text-danger">携帯キャリア（DoCoMo、au、SoftBank等）のメールアドレスをご登録のお客様は、弊社のメールアドレス（no-reply@jacos.co.jp）を受信許可リストに加えた上でご登録下さい。</small>
							  				</td>
							  			</tr> -->
							  			<tr>
							  				<th style="border-color: #dee2e6">
							  					<label class="control-label" for="ajax_sign_up_password">パスワード（４桁以上）</label>
							  				</th>
							  				<td>
							  					<?php echo form_password(array('name' => 'ajax_sign_up_password', 'required' => 'required', 'id' => 'ajax_sign_up_password', 'class'=>'form-control', 'placeholder'=> 'パスワード（４桁以上）', 'value' => set_value('sign_up_password'), 'autocomplete' => 'off')); ?>

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
							  					<span id="password_error" class="help-block text-danger blinking"></span>

							  				</td>
							  			</tr>
							  			
							  			<tr>
							  				<td colspan="2">
							  					<center>
							  						<button type="submit" class="btn btn-default customer_sign_up_btn" style="background-color: green; color: white; font-size: 22px; width: 100px;">登録</button>
							  						<button style="font-size: 22px; width: 100px;" id="nnn" name="close_introduce_screen" class="btn btn-danger btn-lg new_member_reg_form_close">戻る</button>
							  						<?php 
							  						// echo form_button(array('type' => 'button', 'class' => 'btn btn-default forgot_password', 'style'=> 'background: blue; color: white; margin-top:5px;', 'content' => '<i class="fa fa-lock"></i> パスワードを忘れた方')); ?>

							  					</center>
							  					<div id="validation_errors" class="alert d-none alert-warning alert-dismissible fade show" role="alert">
							  					  
							  					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  					    <span aria-hidden="true">&times;</span>
							  					  </button>
							  					</div>
							  				</td>
							  				
							  			</tr>
							  			<!-- <tr>
							  				<th colspan="2">
							  					<center>
							  						
							  					</center>
							  				</th>
							  			</tr> -->
							  		</table>
							  	</fieldset>
						  		  	<div class="row">
						  		  		<div class="col-sm-12">
						  		  			<center>
						  		  				<button class="btn btn-link btn-lg privacy_policy text-primary" style="text-decoration: underline;" data-toggle="modal" data-target="#privacy_policy">個人情報保護方針</button>
						  		  			</center>
						  		  		</div>
						  		  		
						  	  			
						  	  		</div>
							  	</form>

					
				</div>
				
			</div>
		</div>
		<div class="card d-none bg-info sent_password_reset_link_sent_screen" id="activation_email_sent_screen"  style="position: fixed;  padding: 0; border:2px solid #3D618C;">
			<div class="card-body">
				
				<p class="" style="padding-top: 40px; color: white;">
					上記のメールアドレス宛に確認メールを送信しました。<br>
					メール内に記載されたURLにアクセスし、会員登録ボタンを押してください。<br><br>

					※ ドメイン指定受信をされている場合、「@jacos.co.jp」からのメールを受信できるようご設定ください。<br><br>

					※ お使いのメールソフトによっては、メールが「迷惑メール」フォルダに入る場合がございます。メールが届かない場合は、迷惑フォルダもご確認ください。
				</p>
				<center><button class="btn btn-primary btn-lg activation_email_sent_screen_close" style="background-color: #FFFF99">確認</button></center>
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
		<!-- <div class="card-header info">
            <p class="">検索結果 <button class="btn btn-warning float-right" id="voice_suggestion_screen_close">戻る</button></p>
                           
        </div> -->
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
					<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">戻る</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div class="modal" id="barcode_scanner">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">バーコードを撮影</h4>
					<button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" id="resetButton">戻る</button>
				</div>
				<div class="modal-body" style="position: static">
					<div class="col-sm-12" style="padding: 0;">
						<div class="vidio_aria">
							<!-- <hr class="vedio_line"> -->
							<div class="scanning_video_box" style="opacity: 1 !important">
								
							</div>
							<video id="video" style=""></video>

						</div>						
					</div>

					<div id="sourceSelectPanel" style="display:none">
					<label for="sourceSelect">Change video source:</label>
					<select class="form-control" id="sourceSelect" style="max-width:400px">
					</select>
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade bd-example-modal-sm exit_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
					<div class="row" style="margin:20px;">
						<div class="col-md-12">
							<center>
								<button style="width: 180px;" type="button" id="continue_site" class="btn btn-lg btn-primary">続けますか？</button>
							</center>
						</div>
					</div>
					<div class="row" style="margin-bottom:20px;">
						<div class="col-md-12">
							<center>
								<button type="button" style="width: 180px;" id="exit_new_site" class="btn btn-lg btn-warning">終了しますか？</button>
							</center>
						</div>
					</div>
			</div>
		</div>
	</div>
	<div class="modal iphoneSpecial" id="itemsSearchModal" >
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- <div class="modal-header">
					<h4 class="modal-title">バーコードを撮影</h4>
				</div> -->
				<div class="modal-body" style="position: static; padding: 0;">
					<div  style="padding: 0; border: 3px solid blue; border-radius: 4px; margin: 0;" class="input-group col-sm-6 barcod_input_right float-left">
					  <input type="text" id="" class="form-control product_keyword3" placeholder="商品名入力（バーコードが無い場合）" aria-label="Recipient's username" value="<?= $search_barcode ?>" aria-describedby="basic-addon2">
					  <div class="input-group-append" style="background-color: white;">

					    <span class="input-group-text clean_product_name" style="padding: 2px; color: #00A0E8; background-color: white; border-left: 2px solid white;"><i class="fa fa-window-close fa-3x"></i></span>
					  </div>

					</div>
					<div class="card voice_suggestion_screen2">
						
				        <div class="card-body recording-instructions">
				        	
				        </div>
				    </div>
					<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">戻る</button> -->
				</div>
				
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<!-- Modal -->
	<div class="modal fade" id="trams_condition_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-scrollable " role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalScrollableTitle">チャリン２利用規約</h5>
	        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">
	          戻る
	        </button>
	      </div>
	      <div class="modal-body" style="max-height: 500px; overflow: auto;">
	      	<p>
	      		本利用規約（以下、「本規約」とします）は、株式会社ジャコス（以下、「当社」とします）が提供するチャリン２（以下、「本サービス」とします）を利用する方と当社との間で、本サービスの利用に関する権利義務関係を定めるものです。本サービスの利用に際しては、本規約の全文をお読み頂いたうえで、本規約に同意頂く必要があります。
	      	</p>
	        
	      	<p>
	      		第１条（総則）<br>
	      		１．利用者は、本サービスを利用することにより、本規約の内容に同意したものとみなされます。<br>
	      		２．利用者は、本規約のほか、当社が定める各種規定（以下、「個別規定」とします）に同意し、本サービスを利用するものとします。なお、個別規定は本規約の一部を構成し、本規約と個別規定が異なる場合には、個別規定の定めが優先するものとします。<br>
	      		３．当社は、必要と判断した場合、利用者への事前通知なく、本サービス上に掲載することにより合理的な範囲で、本規約を改定できるものとします。変更後の規約は、過去の規約に優先して適用されるものとし、本サービス上に掲載した時点をもって効力を生じるものとします。利用者が、本規約の変更後に本サービスを利用する場合、利用者は変更後の本規約に同意したものとみなされます。<br>
	      		<br>
	      		第２条（用語の定義）<br>
	      		１．「利用者」とは、本サービスを利用する者をいいます。<br>
	      		「チャリン２アカウント」とは、本サービス及び、当社が別途提供するクラウドサービス内で利用者を識別するための情報をいいます。<br>
	      		<br>
	      		第３条（本サービスの内容）<br>
	      		利用者に対して次の各号のサービスを提供します。<br>
	      		１．利用者が、弊社サイトから検索して各ショッピングサイトから商品名、価格等の情報を表示します。<br>
	      		２．チャリン２アカウントと、当社ポイントの紐づけを行い情報を保持します。<br>
	      		<br>
	      		第４条（本サービスの利用条件について）<br>
	      		１．本サービスの利用を希望する者は、自らの意思及び責任をもって、本規約の内容に同意したうえで、本サービスを利用するものとします。<br>
	      		２．本サービスの利用を希望する者は、当社指定のチャリン２アカウント作成手続きを行うものとします。ただし、当社は、利用者が過去に本規約に違反した者である場合、本規約に違反する恐れがあると当社が判断する場合、その他当社が不適切と判断した場合については、チャリン２アカウント登録を承諾しないことがあります。<br>
	      		３．利用者が本サービスの利用にあたり、登録情報その他の情報を提供する場合は、自身の情報として真実かつ正確な最新の情報を提供するものとします。また、利用者は登録情報について、自己の責任のもと、任意に変更、追加、その他の管理をするものとします。当社は、本項の規定違反により生じた、損害又は費用（精神的苦痛又は逸失利益その他の金銭的損失を含む不利益、合理的な弁護士費用を含み、以下、「損害」とします）について責任を負わないものとします。<br>
	      		<br>
	      		第５条（本サービスの変更について）<br>
	      		当社は、必要と判断した場合、利用者への事前通知なく、合理的な範囲で、本サービスの全部又は一部を変更することができます。 <br>
	      		当社は、本サービスの変更等により利用者に生じた損害について責任を負わないものとします。<br>
	      		<br>
	      		第６条（チャリン２アカウントについて）<br>
	      		１．利用者は、チャリン２アカウント作成手続きにおいて、自己の管理に属する使用可能なメールアドレスを登録するものとします。 <br>
	      		２．利用者は、容易に第三者に推測されないパスワードを設定すること、第三者にパスワードを公開しないこと、複数人が使用するコンピュータ又は携帯電話上で本サービスを利用する際にはログアウトすることなどを遵守し、ログインID、パスワード及び登録したメールアドレスの管理についての責任を負うものとします。 <br>
	      		３．利用者は、ログインID、パスワード及び登録したメールアドレスを第三者に譲渡又は使用させることは出来ません。 <br>
	      		４．当社は、ログインID、パスワード及び登録したメールアドレスによって本サービスが利用された場合、当該ログインID、パスワード及び登録したメールアドレスを登録した利用者が本サービスを利用したものと扱うことができ、当該利用によって生じた結果及びそれに伴う責任については、当該利用者に帰属するものとします。 <br>
	      		５．当社は、当社の故意又は重過失による場合を除き、ログインID、パスワード及び登録したメールアドレスが第三者に利用されたことによって生じた損害について責任を負わないものとします。 <br>
	      		<br>
	      		第７条（チャリン２アカウント削除について） <br>
	      		利用者は、チャリン２アカウント削除を希望する場合、当社指定のチャリン２アカウント削除手続きを行うものとします。当社は、削除したチャリン２アカウントについて、継続して保有する義務を負わないものとします。 <br>
	      		<br>
	      		第８条（情報の取扱）<br>

	      		１．当社は、利用者が本サービスを利用するにあたり、利用者の個人情報（個人情報の保護に関する法律に規定される「個人情報」をいうものとします。）を取得することがありますが、当社は、かかる情報を、当社個人情報保護基本方針に従い、適切に取り扱います。利用者は、当該方針に基づく情報の取扱に同意するものとします。 <br>
	      		２．当社は、利用者の個人情報を、以下の目的のために使用します。 <br>
	      		（１）利用者に合った、コンテンツやサービスを提供するため <br>
	      		（２）本サービスの提供、維持、保護及び改善のため <br>
	      		（３）本サービスに関するご案内、お問合せ等への対応のため <br>
	      		（４）本規約に違反する行為に対する調査及び対応のため <br>
	      		３．当社は、利用者の個人情報を、前項の目的のために必要な範囲で、開示することができるものとします。 <br>
	      		４．当社は、利用者の個人情報及び利用者の本サービスの利用履歴等から、特定の個人を識別できないように加工、集計及び分析した統計データ等を作成し、当該統計データを何らの制限なく、閲覧、利用（第三者に閲覧、利用させること、マーケティング資料としての提供、本サービスの新機能開発、市場の調査を含みますが、これに限られません）する事ができるものとし、利用者はこれを予め承諾します。 <br>
	      		<br>
	      		第９条 （利用者の禁止行為） <br>
	      		１．利用者は、次の各号に該当する又は各号に該当する恐れがあると当社が判断する行為を行ってはならないものとします。 <br>
	      		（１）本規約に違反する行為 <br>
	      		（２）法令又は公序良俗に違反する行為 <br>
	      		（３）違法行為・犯罪行為・反社会的行為を暗示・誘発・助長・推奨等する行為 <br>
	      		（４）当社又は第三者の著作権、商標権等の知的財産権を侵害する行為 <br>
	      		（５）当社又は第三者の財産・信用・名誉・プライバシーを侵害する行為 <br>
	      		（６）他の利用者若しくは事業者に対する嫌がらせや誹謗中傷を目的とする行為 <br>
	      		（７）アダルトサイト、ワンクリック詐欺サイト、ウィルス等の有害なコンピュータプログラム等を流布させることを目的とするサイト等、当社が不適切と判断するウェブサイトに誘導する行為 <br>
	      		（８）ねずみ講、チェーンメール、MLM（マルチレベルマーケティング）、リードメール等の第三者を勧誘するコンテンツを送信する行為 <br>
	      		（９）本サービスの全部又は一部を商業目的で利用する行為（ただし、当社の同意がある場合を　除く） <br>
	      		（10）政治活動又は宗教活動行為 <br>
	      		（11）当社又は第三者になりすます行為 <br>
	      		（12）通常利用の範囲を超えてサーバに負担をかける行為、それを助長する行為、その他本サービスの運営に支障を与える行為 <br>
	      		（13）コンピュータウィルス等の有害なコンピュータプログラム等を送信する行為 <br>
	      		（14）当社の定める注意事項、その他規約等に違反する行為 <br>
	      		（15）他人のパスワードその他認証情報を入力する行為 <br>
	      		（16）本サービスの運営を妨げること、又は当社の信用を毀損すること
	      		（17）その他当社が不適切と判断する行為 <br>
	      		２．当社は、暴力団、暴力団員、暴力団員でなくなった時から５年を経過しない者、暴力団準構成員、暴力団関係企業、総会屋、社会運動等標ぼうゴロ又は特殊知能暴力集団、その他これらに準ずる者（以下、総称して「反社会的勢力等」とします）による本サービスの利用を禁止します。利用者が反社会的勢力等に該当すると判断した場合、チャリン２アカウントが反社会的勢力等によって使用された場合又はそのおそれがあると当社が判断した場合、第１０条第１項の規定によるものとします。 <br>
	      		<br>
	      		第１０条（違反行為への対応）<br>
	      		１．利用者が本規約に違反したと当社が判断する場合、当社は当該利用者に対し以下の措置を講ずることがあります。ただし、当社はその義務を負うものではありません。 <br>
	      		（１）違反の是正を請求すること又は当社自ら是正すること <br>
	      		（２）本サービスの全部又は一部の提供を中断又は停止すること <br>
	      		（３）利用者登録を抹消すること <br>
	      		２．前項の措置により、利用者に損害が発生した場合においても、当社は責任を負いません。また、本条の定めに従い当社が講じた措置に関し、質問及び苦情は受け付けません。 <br>
	      		<br>
	      		第１１条（免責） <br>
	      		１．当社は利用者との間に生じたトラブルについて責任を負わないものとします。万一、当社と利用者で紛争等が発生し、当社がこれにやむを得ず対応した場合、利用者は当社に発生した損害を賠償するものとします。 <br>
	      		２．利用者は、①利用者が本サービスを利用したこと、又は利用できなかったこと、②不正アクセスや不正な改変がなされたこと、③本サービスにおける他の利用者による行為、④第三者によるなりすまし行為、⑤その他本サービスに関連する事項に起因又は関連して生じた損害に関して、当社が損害賠償責任を負わないことに同意します。ただし、当社に故意又は重大な過失がある場合はこの限りではないものとします。 <br>
	      		３．当社は、当社、又は利用者が提供する情報、助言の真実性、最新性、確実性、有用性等について保証しません。当社は、当社が提供する情報、助言に関連して利用者に発生した損害について責任を負わないものとします。 <br>
	      		４．当社は本サービスに瑕疵がないことを保証しません。当社は万一本サービスに瑕疵があることが判明した場合、その修正に努めますが本サービスの瑕疵に起因して利用者に発生した損害について責任を負わないものとします。 <br>
	      		５．当社が損害賠償責任を負う場合についても、当社に故意又は重大な過失がある場合を除いて、当社は、当該利用者が直接かつ現実に被った損害、かつ損害に関連する料金を上限として損害賠償責任を負うものとし、特別な事情から生じた損害（損害発生につき予見し、又は予見し得た場合を含む）については責任を負わないものとします。 <br>
	      		<br>
	      		第１２条（本サービスの中断、停止） <br>
	      		１．当社は次の各号に該当する場合、利用者への事前の通知や承諾なしに、本サービスの一時的な運営の停止を行うことがあり利用者はこれを承諾します。 <br>
	      		（１）本サービスのシステム保守、点検又は修補等を行う場合 <br>
	      		（２）天災地変その他非常事態が発生若しくは発生する恐れがあり、又は法令等の改正・成立により本サービスの運営が困難又は不可能になった場合 <br>
	      		（３）その他当社がやむを得ない事由により本サービスの運営上一時的な停止が必要と判断した場合 <br>
	      		２．前項に定める本サービスの一時的な運営の停止により、利用者が本サービスを利用できない場合であっても、当社は、何らの責任を負わないものとします。 <br>
	      		<br>
	      		第１３条（権利義務等の譲渡） <br>
	      		１．利用者は、本規約上の地位に基づく権利義務を、当社の事前の書面による承諾なく、第三者に譲渡若しくは貸与し、又は担保に供してはならないものとします。 <br>
	      		２．当社は、本サービスに関する事業を合弁、事業譲渡その他の事由により第三者に承継させる場合には、当該事業の承継に伴い、本規約上の地位、本規約に基づく権利、義務及び利用者の登録情報を当該事業の承継人に譲渡することができるものとし、利用者は、かかる譲渡について本項において予め同意したものとします。 <br>
	      		<br>
	      		第１４条（知的財産権等） <br>
	      		本サービスに含まれる知的財産権は、当社又は当社にその利用を許諾した権利者に帰属しています。利用者は、これらの情報を当社の事前の書面による許諾なく利用することはできないものとします。 <br>
	      		<br>
	      		第１５条（分離可能性） <br>
	      		１．本規約の規定の一部が法令に基づいて無効と判断されても、本規約のその他の規定は有効とします。  <br>
	      		２．本規約の規定の一部がある利用者との関係で無効とされ、又は取り消された場合でも、本規約はその他の利用者との関係では有効とします。 <br>
	      		<br>
	      		第１６条（基準時） <br>
	      		本サービスに関連して基準となる時刻は、全て日本時間によるものとします。<br>
	      		<br>
	      		第１７条（通知・連絡）<br>
	      		利用者は、当社に連絡をする場合、当社が指定する電子メールにて連絡を行うものとします。本サービス掲載上の連絡先以外からの通知に関しては受け付けないものとします。当社からの利用者に対する連絡は、本サービス上での提示又は利用者への電子メールなどにより行うものとします。ただし、利用者から正確な連絡先の提供がなされていない場合の不利益・損害に関しては、当社は責任を負わないものとします。<br>
	      		<br>
	      		第１８条（準拠法と裁判管轄）<br>
	      		本規約は、日本法を準拠とし、解釈されるものとします。また、本規約に関連し当社と利用者との間に訴訟が生じた場合、東京地方裁判所を第一審の専属管轄裁判所とします。<br>
	      		<br>
	      		<br>
	      		令和１年１２月１日　制定

	      	</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">確認</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="privacy_policy" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	  <div class="modal-dialog modal-lg modal-dialog-scrollable " role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalScrollableTitle">個人情報保護方針</h5>
	        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal" aria-label="Close">
	          戻る
	        </button>
	      </div>
	      <div class="modal-body" style="max-height: 500px; overflow: auto;">
	      	<p>
	      		第1条　総則<br>
	      		株式会社ジャコス（以下、当社という）は、個人情報保護を企業における重要な社会的使命・責務と認識し、当社が保有するお客様の個人情報を適切に管理運用するために遵守するべき基本事項として本保護方針を定めます。 <br><br>

	      		第2条　個人情報とは<br>
	      		当社において、個人情報とは、個人の識別に係る以下の情報をいいます。<br><br>

	      		・住所・氏名・電話番号・電子メールアドレス、クレジットカード情報、ログインID、パスワード、ニックネーム、IPアドレス等において、特定の個人を識別できる情報（他の情報と照合することができ、それにより特定の個人を識別することができることとなるものを含む。）<br>
	      		・当社の運営・提供するインターネットサービスサイト「チャリン２」その他の当社のサービス（以下総称して「当社サービス」といいます。）において、お客様が、当社でご利用になったサービスの内容、ご利用日時、ご利用回数などのご利用内容及びご利用履歴に関する情報<br><br>
	      		第3条　個人情報の取得・収集について<br>
	      		当社は、以下の方法により、個人情報を取得させていただきます。<br><br>

	      		・当社のインターネットサイト等を通じて取得・収集させていただく方法
	      		当社上で、自ら入力された個人情報を、当社は取得・収集させていただきます。<br>
	      		・電子メール、郵便、書面、電話等の手段により取得・収集させていただく方法
	      		当社に対し、電子メール、郵便、書面、電話等の手段によって、ご提供いただいた個人情報を、当社は取得・収集させていただきます。<br>
	      		・当社等へアクセスされた際に情報を収集させていただく方法
	      		当社サービスをご利用された履歴等を収集させていただきます。これらの情報には、利用されるURL、ブラウザや携帯電話の種類、IPアドレスなどの情報を含みます。<br><br>

	      		第4条　個人情報の取得・利用目的<br>
	      		当社において、当社は以下の目的のため、個人情報を適法かつ公正な手段で取得・利用させていただきます。当社は、お客様本人の同意がある場合を除き、以下の目的達成に必要な範囲を超えて、取得した個人情報を利用しません。<br><br>

	      		１．当社サービスを提供するため<br>
	      		２．当社サービスを安心・安全にご利用いただける環境整備のため<br>
	      		３．当社サービスの運営・管理のため<br>
	      		４．当社サービスに関するご案内、お問い合せ等への対応のため<br>
	      		５．当社、その他当社サービスについての調査・データ集積、改善、研究開発のため<br>
	      		６．当社がおすすめする商品・サービスなどのご案内を送信・送付するため<br>
	      		７．当社とお客様の間での必要な連絡を行うため<br>
	      		８．当社のIR情報の発信等を行うため<br>
	      		９．当社サービスに関する当社の規約、ポリシー等（以下「規約等」といいます。）に違反する行為に対する対応のため<br>
	      		10．当社サービスに関する規約等の変更などを通知するため<br>
	      		11．その他当社とお客様との間で同意した目的のため<br>
	      		12．上記 1 から 11 に附随する目的のため<br> <br>
	      		第5条　個人情報の共同利用<br>
	      		当社において、お客様の個人情報は、当社が取り扱う商品・サービス、アンケートのご案内・ご提供及びお仕事のご紹介、新商品の開発、利便性向上のために当社グループ会社と共同利用致します。 　当社グループ会社においては、当社グループ会社の個人情報保護管理者が責任をもってお客様の情報の管理をおこないます。また、共同利用する情報は、以下の方法によって取得したものを指します。<br><br>

	      		１．お電話でお客様からの口頭からの取得<br>
	      		２．電話帳データベース販売会社からの取得<br>
	      		３．web上の資料請求画面からの取得<br>
	      		４．当社グループ会社への会員登録や案件履歴からの取得<br>
	      		５．当社へ資料をご請求いただいた方からの取得<br>
	      		６．アンケートにご回答いただいた方からの取得<br>
	      		７．お客様等からのご紹介による取得<br><br>
	      		第6条　個人情報の管理<br>
	      		当社は、個人情報の滅失、き損、漏洩及び不正利用等を防止し、その安全管理を行うために必要な措置を講じ、個人情報の取扱責任者を設置し、個人情報を安全に管理します。また、当社は個人情報を利用目的の範囲内において、正確かつ最新の状態で管理するように努めます。<br><br>

	      		第7条　個人情報の第三者への提供・開示<br>
	      		当社は、以下のいずれかに該当する場合に限り、法令の範囲内で、個人情報を第三者に提供する場合があります。<br><br>

	      		・お客様本人の同意がある場合。<br>
	      		・公的機関等又はそれらの委託を受けた者より、開示請求を受領した場合。<br>
	      		・生命や財産に危機が生じ、緊急に開示する必要があり、当該お客様の同意を得るのが困難な場合。<br>
	      		・第三者に対し、当社の運営に必要な業務の一部もしくは一切を委託する場合又はビジネスの移管を行う場合。<br>
	      		・その他、個人情報の保護に関する法律（以下「個人情報保護法」といいます。）その他の法令で認められる場合。<br><br>
	      		第8条　個人情報の開示・訂正・利用停止<br>
	      		当社は、お客様から個人情報の開示、内容の訂正・追加・削除及び利用停止を求められた場合には適切にこれに対応します。但し、個人情報保護法その他の法令により、当社がこれらの義務を負わない場合は、この限りではありません。<br><br>

	      		第9条　クッキー（Cookie）<br>
	      		当社は、当社サービスを通じてクッキーをお客様のコンピュータに送信することがあります。クッキーとは、ウェブサイトの利用履歴や入力内容等をお客様のコンピュータにファイルとして保存しておく仕組みであり、お客様がブラウザの設定でクッキーの送受信を許可している場合、当社はお客様のコンピュータに保存されたクッキーを取得し、収集した行動履歴と個人情報を紐付ける場合があります。当社は、お客様へのサービス利便性の向上、統計データの取得・分析等の目的でクッキーを利用します。<br><br>
	      		第10条　苦情処理<br>
	      		当社は個人情報に関する苦情に対しては、誠実に対応致します。<br>
	      		ご意見、ご質問、苦情のお申し出その他個人情報の取扱いに関するお問い合わせは、下記の窓口までお願いいたします。<br><br>

	      		〒150-6006<br>
	      		東京都渋谷区恵比寿四丁目20番3号　恵比寿ガーデンプレイスタワー18階<br>
	      		株式会社ジャコス<br>
	      		電子メールアドレス：info@jacos.co.jp<br><br>

	      		第11条　継続的改善<br>
	      		当社は、個人情報保護に関する取扱い、管理及び管理体制について継続的改善を行います。<br><br>

	      		第12条　改訂<br>
	      		本保護方針は、当社の判断によりお客様の同意なしに全部又は一部の改訂を行うことができるものとし、本保護方針改訂後にお客様が当社サービスを利用した場合には、当該改訂に同意したものとみなします。 ただし、本保護方針の内容を大幅に改訂する場合については当社上においてお知らせいたします。<br><br>

	      		(以下余白)<br><br>

	      		令和1年12月1日制定

	      	</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary btn-lg" data-dismiss="modal">確認</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="happy_shopping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      
	      <div class="modal-body">
	        <center>
	            <h3 class="text-success">会員登録が完了しました。</h3>
	            <h4 class="text-info">お買い物をお楽しみください。</h4>
	            <hr>
	            <button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">この表示を消す</button>
	        </center>
	      </div>
	     	
	    </div>
	  </div>
	</div>

	<input type="hidden" class="point_table_view" id="point_table_view" value="0" name="">
	<!-- <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/jquery.js"></script> -->
	<input type="hidden" id="can_product_search" value="1">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript">
    	var base_url = $("#base_url").val();
		var userAgent = navigator.userAgent.toLowerCase();
		if (userAgent.search(/iphone|ipad|ipod/) == -1) {
			$('head').append('<link rel="manifest" href="'+base_url+'resource/pwa/manifest.json">');
			
		}

    </script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/bootstrap/dist/js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/qrcodelib.js"></script>
	<!-- <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/webcodecamjquery.js"></script> -->
	
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/xml2json.js"></script>
	
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>

    <style>
    	#interactive.viewport {position: relative; width: 100%; height: auto; overflow: hidden; text-align: center;}
    	#interactive.viewport > canvas, #interactive.viewport > video {max-width: 100%;width: 100%;}
    	canvas.drawing, canvas.drawingBuffer {position: absolute; left: 0; top: 0;}
    </style>
    
      <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/affiliate_v5.js?id=<?php echo rand(0,10000)?>"></script>
      <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/rajib-custom.js?id=<?php echo rand(0,10000)?>"></script>
      <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/voice_v2.js?id=<?php echo rand(0,10000)?>"></script>
	  <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/pwa/app.js"></script>
	  <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/pwa/closePWA.js"></script>
      
      <!-- <script src="https://cdn.rawgit.com/mattdiamond/Recorderjs/08e7abd9/dist/recorder.js"></script>
      <script src="<?php echo base_url().RES_DIR; ?>/js/app.js"></script> -->
      <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/amazon_commission_rate.json"></script>
      <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

      
	
</body>
</html>
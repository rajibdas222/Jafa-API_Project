<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().RES_DIR; ?>/css/style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

</head>
<body>
	
	<div class="container-fluid">	
		
		<!-- <iframe src="https://www.amazon.jp/reviews/iframe?akid=AKIAJBOMU3LLPXXYHAUQ&amp;alinkCode=xm2&amp;asin=B00YOBEVHE&amp;atag=jouene0f-22&amp;exp=2018-07-13T10%3A03%3A39Z&amp;v=2&amp;sig=aE3oetw79bfXC14CDNZGmiBQH1XXugwP6BsVz6Fgk24%253D"></iframe>	 -->
		<div class="main_border">
			<div class="row">
				<div id="scanner-container" style="position: fixed; left: 0; top: 0; padding: 5px; z-index: 100;"></div>
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
				<div class="col-md-4 app-title">
					<!-- <img src="resources/img/logo.png"> -->
					<p>ダブルポイント案内</p>
					<button class="btn btn-default btn_link btn-lg" style="font-size: 26px; margin-bottom: 10px;">チャリン<sup>２</sup></button>
				</div>
				<div class="col-md-5 heading2-box" style="">
					<p class="pl-1">
						このサイトで購入すると、<br>① ショップポイントに加え <br>
						②当社ポイント、<span style="color: #ff8507; font-weight: bold;">チャリン<sup>2</sup></span> が付きますので、一層お得です。
					</p>
					<hr style="border-color:red;">
					<p class="pl-1">
						<span class="" style="color: #ff8507; font-weight: bold;">ショールーミング</span> <br>
						家電やドラッグ・・・・などの店で、スマホ撮影して <br>
						価格比較できます。
					</p>
					
				</div>
				<div class="col-sm-12 col-md-1">
					<button class="btn btn-default btn_link btn-lg" style="font-size: 34px;">紹介</button>
				</div>   
			</div>
			<div class="row second-box">
				<div class="col-md-10 pdding-zero">
					<form class="form-inline" action="false">
						<legend class=""><strong style="font-size: 30px;">価格比較</strong></legend>
						<div class="form-group" >
							
							<label for="barcode" style="font-size: 22px; margin-right: 10px;">商品検索<br>最安値 </label>
							<button class="btn-default btn_link btn-lg play_scaner" type="button" data-toggle="modal" data-target="#livestream_scanner" style="">スマホでバーコードを撮影</button>
							<!-- <input type="file" onclick="decodeLocalImage()" accept="image/*;capture=camera"> -->
						</div>
						<div class="form-group">
							<canvas class="hidden" style="display: none;"></canvas>
							<!-- <canvas with="320" height="240"></canvas> -->
							<label for="inputBarcodeQR" id="inputBarcodeQR"><img style="padding: 5px; width: 140px; height: 70px; margin-left: 5px;" src="resources/img/barcode.png"> <!-- <img style="padding: 5px; height: 70px" src="resources/img/QR_code.png"> --> </label>
							<button class="btn btn-default btn-lg" id="magagement_sheet" style="background-color: #007E12; color: white;">管理画面</button>
						</div>
					</form>
						<div class="form-group input_fields" style="">	
							<input type="text" class="form-control-lg barcod_input_left" id="product_bardcode" placeholder="ジャンル" name="">					
							<input type="text" class="form-control-lg barcod_input_middle" id="product_bardcode2" placeholder="商品名" name="">					
							<input type="text" style="" class="form-control-lg barcod_input_right" id="product_keyword3" placeholder="バーコード入力" name="">					
							<button style="margin-left: 5px; font-size: 26px;" class="btn btn-default btn_link btn-lg" id="point_table_btn">現在残高</button>
							<button style="margin-left: 5px; font-size: 26px;" class="btn btn-default btn_link btn-lg">履歴</button>
							
						</div>
				</div>
				<div class="col-md-2 text-center">
						<img height="220" style="max-width: 200px;" class="" id="product_image" src="http://thumbnail.image.rakuten.co.jp/@0_mall/bigbossshibazaki/cabinet/syokuhin/img58589395.jpg">				
				</div>				
				
				<div class="col-md-12 affiliate_list table-responsive" id="affiliate_list" style="">					
					
					<table class="table compare_table" style="background: white; font-size: 22px;">
						<thead>
							<tr>
								<th colspan="6" style="padding: 0; border:1px solid white;">
									<table class="table product_name_table" style="margin: 0; border: 1px solid black; 
									border-collapse: separate;
									border-spacing: 10px;
								border-top-left-radius: 10px;
								border-top-right-radius: 10px;">
										<tbody style="margin: 0; padding: 0;">
											<tr>
												<td style="border: 1px solid white;" id="jan_product_name">
													ブルドック ウスターソース 500ml
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
								<th class="align-middle text-center" nowrap>価格</th>
								<th class="align-middle text-center" style="background-color: #FFF0E4" nowrap>実質<br>価格</th>
								<th class="align-middle text-center" nowrap>評価<br>件数</th>
								<th  nowrap class="align-middle text-center" nowrap>評価<br>平均</th>
								<th nowrap class="align-middle text-center" nowrap>ショップ<br>ポイント</th>
								<th nowrap class="align-middle text-center"  style="background-color: #FFF0E4" nowrap>チャリン<sup>2</sup><br>ポイント</th>
								
								<th style="border-top-right-radius: 10px;" class="align-middle text-center" nowrap>配送料</th>
							</tr>
							<tr>
								<td class="text-center" style="vertical-align: middle;">1位</td>
								<td> <button class="profite_tabel_btn btn btn-default btn_link btn-lg">アマゾン</button> </td>
								
								<td class="text-right">¥<span id="amazon_itemPrice">900</span> </td>
								<td class="text-center" style="background-color: #FFF0E4" id="amazon_realPrice">896</td>
								<td class="text-center">43件</td>
								<td class="text-center point_details">4.3点</td>
								<td class="text-center">0</td>
								<td class="text-center" style="background-color: #FFF0E4">4</td>
								
								<td class="text-center"><a href="#" target="_blank" class="btn btn-default btn_link btn-lg" id='amazon_itemUrl'>購入</a></td>
							</tr>
							<tr>
								<td class="text-center" style="vertical-align: middle;">2位</td>
								<td style=""><button class="profite_tabel_btn btn btn-default btn_link btn-lg">楽天</button></td>
								
								<td class="text-right">¥<span id="rakuten_itemPrice">950</span></td>
								<td class="text-center" style="background-color: #FFF0E4" id="rakuten_realprice"> 937</td>
								<td class="text-center"><span id="rakuten_reviewCount">21</span>件</td>
								<td class="text-center point_details"><span id="rakuten_reviewAverage">4.1</span>点</td>
								<td class="text-center"><span id="rakuten_pointRate">9</span></td>
								<td class="text-center"  style="background-color: #FFF0E4"><span id="rakuten_chalinPoint">4</span> </td>
								
								<td class="text-center"><a href="#" target="_blank" class="btn btn-default btn_link btn-lg" id='rakuten_itemUrl'>購入</a></td>
							</tr>
							<tr>
								<td class="text-center" style="vertical-align: middle;">3位</td>
								<td style=""><button class="profite_tabel_btn btn btn-default btn_link btn-lg">ヤフー</button></td>
								
								<td class="text-right">¥<span id="yahoo_itemPrice">980</span> </td>
								<td class="text-center" id="yahoo_realPrice" style="background-color: #FFF0E4">967</td>
								<td class="text-center"><span id="yahoo_reviewCount">12</span>件</td>
								<td class="text-center"><span id="yahoo_reviewRate">3.8</span>点</td>
								<td class="text-center" id="yahoo_shopPoint">9</td>
								<td class="text-center" id="yahoo_chalinPoint" style="background-color: #FFF0E4">4</td>
								
								<td class="text-center"><a href="#" target="_blank" class="btn btn-default btn_link btn-lg" id='yahoo_itemUrl'>購入</a></td>
							</tr>
							<tr>
								<th colspan="2" class="text-right" style="border-bottom-left-radius: 10px;">全体</th>
								<td class="text-center">ー</td>
								<td class="text-center" style="background-color: #FFF0E4">ー</td>
								<td class="text-center">76件</td>

								<td class="text-center ">4.1点</td>
								<td class="text-center">ー</td>
								<td class="text-center"  style="background-color: #FFF0E4">ー</td>
								
								<td class="text-center">ー</td>
							</tr>
						</tbody>
					</table>
				</div>
								
			</div>
			<!-- <div class="container compare_table_padding clearfix">
				<div class="row">
				       
				    <div class="">
				        <table align="center" class="table table-bordered compare_table_mobile">
				        
				        
				        <thead>
				            <tr>
				                <th colspan="6"><span id="jan_product_name2">ブルドック ウスターソース 500ml</span></th>
				            </tr>

				        </thead>
				        <tbody class="mobile_compare_table" id="mobile_compare_table" style="">
				            <tr style="background-color: #FFF0E4">
				                <th class="text-center" style="vertical-align: middle;">ショップ名</th>
				                <th class="text-center" style="vertical-align: middle;">価格 </th>
				                <th style="background-color:#FFF0E4" class="col-bg-01 text-center">実質価格</th>
				                <th class="text-center">評価件数</th>
				                <th class="text-center">評価平均</th>
				                <th class="text-center" style="vertical-align: middle;">チャリン</th>
				            </tr>
				            <tr>
				                <td style="text-align: center; padding: 10px;" rowspan="3"><div style="background-color: #FFF0E4;"><span>ア<br><br>マ<br><br>ゾ<br><br>ン</span></div></td>
				                <td style="vertical-align: middle" rowspan="3"><span>¥900</span></td>
				                <td style="vertical-align: middle; background-color:  #FFF0E4" class="col-bg-01" rowspan="3">896</td>
				                <td style="text-align: right">43件</td>
				                <td style="text-align: right">4.3点</td>
				                <td rowspan="3" style="vertical-align: middle; "><a href="#" style="border:solid red 2px;" class="btn btn-default btn_link btn-sm tb_button">購入</a></td>
				            </tr>
				            <tr>
				                <td class="text-center" style="background-color: #FFF0E4">ショップポイント</td>
				                <td class="text-center" style="background-color: #FFF0E4">チャリン<sup>2</sup>ポイント</td>
				            </tr>
				            <tr>
				                <td style="text-align: right">0</td>
				                <td style="text-align: right">4</td>
				            </tr>


				            <tr style="background-color: #FFF0E4">
				                <th class="text-center">ショップ名</th>
				                <th class="text-center" >価格 </th>
				                <th style="background-color:  #FFF0E4" class="col-bg-01 text-center">実質価格</th>
				                <th class="text-center">評価件数</th>
				                <th class="text-center">評価平均</th>
				                <th class="text-center">チャリン</th>

				            </tr>

				            <tr>
				                <td style="text-align: center; padding: 10px; vertical-align: middle;" rowspan="3"><div class="col-bg-02" style="background-color: #FFF0E4;"><span>楽<br>天</span></div></td>
				                <td style="vertical-align: middle" rowspan="3">¥950</td>
				                <td style="vertical-align: middle; background-color:  #FFF0E4" class="col-bg-01" rowspan="3">937</td>
				                <td style="text-align: right">21件</td>
				                <td style="text-align: right">4.1点</td>
				                <td rowspan="3" style="vertical-align: middle;"><a href="#" style="border:solid red 2px;" class="btn btn-default btn_link btn-sm tb_button">購入</a></td>
				            </tr>
				            <tr>
				                <td class="text-center" style="background-color: #FFF0E4">ショップポイント</td>
				                <td class="text-center" style="background-color: #FFF0E4">チャリン<sup>2</sup>ポイント</td>
				            </tr>
				            <tr>
				                <td style="text-align: right">9</td>
				                <td style="text-align: right">4</td>
				            </tr>



				            <tr style="background-color: #FFF0E4">
				                <th>ショップ名</th>
				                <th >価格 </th>
				                <th style=" background-color: #FFF0E4" class="col-bg-01">実質価格</th>
				                <th>評価件数</th>
				                <th>評価平均</th>
				                <th>チャリン</th>

				            </tr>
				            
				            <tr>
				            	<td style="text-align: center; padding: 10px; vertical-align: middle;" rowspan="3"><div class="col-bg-02" style="background-color: #FFF0E4;">
				            		<span>ヤ<br>フ<br>ー<span></span>
				            	</div></td>
				                <td style="vertical-align: middle" rowspan="3">¥980</td>
				                <td style="vertical-align: middle; background-color: #FFF0E4" class="col-bg-01" rowspan="3">967</td>
				                <td style="text-align: right">12件</td>
				                <td style="text-align: right">3.8点</td>
				                <td rowspan="3" style="vertical-align: middle;"><a href="#" style="border:solid red 2px; " class="btn btn-default btn_link btn-sm tb_button">購入</a></td>
				                
				              

				            </tr>
				               
				               
				            <tr>
				                <td class="text-center" style="background-color: #FFF0E4">ショップ<br>ポイント</td>
				                <td class="text-center" style="background-color: #FFF0E4">チャリン<sup>2</sup><br>ポイント</td>
				                
				            </tr>
				               
				            <tr>
				                <td style="text-align: right">9</td>
				                <td style="text-align: right">4</td>
				                
				                
				            </tr>
				            
				            




				        </tbody>
				    </table>
				            
				</div>
			</div> -->
			<!------ </.row-------->
			</div><!------ </.container-------->
			<div class="row second-box" style="padding: 0;">
				<!-- <div class="card " > -->
					<div class="table-responsive" style="padding: 0px;">
						<table class="table" style="margin-bottom: 0;">
								<style type="text/css">
									td, th{
										border: 1px solid black;
									}
									/*table { border-collapse: separate; }*/
									/*td { border: solid 1px #000; }
									tr:first-child td:first-child { border-top-left-radius: 10px; }
									tr:first-child td:last-child { border-top-right-radius: 10px; }
									tr:last-child td:first-child { border-bottom-left-radius: 10px; }
									tr:last-child td:last-child { border-bottom-right-radius: 10px; }*/
								</style>
							<thead>
								<tr>
									<th nowrap class="align-middle text-center" style="border-left: 0; border-top:0">順位</th>
									<th nowrap colspan="2" class="align-middle text-center">販売店（ショップ名</th>
									<th nowrap class="align-middle text-center">商品価格</th>
									<th nowrap class="align-middle text-center">ショップ<br>ポイント</th>
									<th nowrap class="align-middle text-center">チャリン<sup>2</sup><br>ポイント</th>
									<th nowrap class="align-middle text-center" style="border-right: 0; border-top: 0;">実質価格</th>
								</tr>
							</thead>
							<tbody id="lowest_ten_table">
								
								<?php
								for ($i=1; $i <11 ; $i++) { 
									
								?>
								<tr>
									<td style="border-left: 0; border-bottom: <?= ($i==10)?'0;':'' ?>"><?= $i; ?> 位</td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
									<td style="border-bottom: <?= ($i==10)?'0;':'' ?>"></td>
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
			<div class="card d-block screen_message" style="">
			  	<div class="card-body">
			    	<p style="">			    		
			    		１、価格比較する場合は、バーコード撮影を押してください。
			    		<br>
			    		２、価格の比較しない場合は、ショップ名を押してください。
			    	</p>
			  	</div>
			</div>
			
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
			<div class="card d-none login_screen" style="position: fixed; right: 30px; bottom: 10px;">
				<div class="card-header info">
	                <h3 class=""><?= lang('sign_in_sign_in') ?> <button class="btn btn-warning float-right btn-lg" id="login_screen_close">戻る</button></h3>
	                               
	            </div>
			  	<div class="card-body">
	               	<?php echo form_open(base_url('account/sign_in'), 'class="form-horizontal"'); ?>
					<?php echo form_fieldset(); ?>  
					
					<?php if (isset($sign_in_error)) : ?>                	                    
	                    <div class="alert alert-danger" role="alert">
	              		<a class="close" data-dismiss="alert" href="#">x</a><?php echo $sign_in_error; ?>
	            		</div>
					<?php endif; ?>
	                
	                <?php if (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) :?>
	                         <p class="text-danger">
	                         <?php echo form_error('sign_in_username_email'); ?>
	                         <?php if (isset($sign_in_username_email_error)) : ?>
	                             <span class="field_error"><?php echo $sign_in_username_email_error; ?></span>
	                         <?php endif; ?>
	                         </p>
					<?php endif; ?> 
	                 
					<div style="margin-bottom: 25px" class="input-group" <?php echo (form_error('sign_in_username_email') || isset($sign_in_username_email_error)) ? 'has-error' : ''; ?>>
	            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
	            <input autofocus id="sign_in_username_email" type="text" class="form-control" style="font-size: 22px" name="sign_in_username_email" value="" placeholder="ID">
	                              
	        	</div>
	                                    
	                <?php 	if (form_error('sign_in_password')) : ?>
							<p class="text-danger"><?php echo form_error('sign_in_password'); ?></p>
					<?php 	endif; ?>
	                <div style="margin-bottom: 25px" class="input-group">
	                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	                    <input id="sign_in_password" style="font-size: 22px" type="password" class="form-control" name="sign_in_password" placeholder="<?= lang('sign_in_password') ?>" value="<?=set_value('sign_in_password')?>">
	                    
	                 	
	                    <?php if (isset($recaptcha)) : ?>
								<?php echo $recaptcha; ?>
								<?php if (isset($sign_in_recaptcha_error)) : ?>
									<span class="field_error"><?php echo $sign_in_recaptcha_error; ?></span>
								<?php endif; ?>
						<?php endif; ?>
	                    
	                       
	                </div>
					<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary btn-lg', 'content' => '<i class="icon-lock"></i> '.lang('sign_in_sign_in'))); ?>

	            </div><!-- panel-body -->
				<?php echo form_fieldset_close(); ?>
				<?php echo form_close(); ?>
			  	</div>
			</div>
			<div class="card <?= isset($account)? "d-block":"d-none" ?> col-md-4 customer_point_table col-sm-12" style="">
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
			</div>
			<div class="card col-md-4 col-sm-12 d-none" id="product_case_message" style="background-color: #FFFF99; border: 2px solid green; border-radius: 10px; position: fixed; max-width: 400px;
    right: 10px;
    bottom: 10px;
    padding: 4px;">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<button class="btn btn-primary float-right btn-lg" id="close_case_message">戻る</button>
							<p style="font-size: 20px;">複数と単品があります。</p>
							<p style="font-size: 20px;">どちらか選んでください。</p>	
							<button style="background-color: #DBEEF4; color: black; width: 145px;" class="btn btn-info float-left btn-lg" id="">単品<br>
							（1個）</button>
							<button style="background-color: #F2DCDB; width: 145px;" class="btn btn-warning float-right btn-lg" id="">複数 <br>
							（2個以上）</button>

						</div>
						<!-- <div class="col-sm-4" style="padding: 0">
							
							
						</div> -->
					</div>
					
					<!-- <div class="col-sm" style="font-size: 24px;">
						
											　
					</div>
					<div class="col-sm" style="padding: 10px 50px;">
						
					</div> -->
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<!-- <input type="button" id="upload" value="upload" onclick="decodeLocalImage();"> -->

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
	<!-- <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/jquery.js"></script> -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/bootstrap/dist/js/bootstrap.js"></script>
	
	
	<script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/xml2json.js"></script>
	
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/affiliate.js"></script>
    <script type="text/javascript" src="<?php echo base_url().RES_DIR; ?>/js/amazon_commission_rate.json"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <style>
    	#interactive.viewport {position: relative; width: 100%; height: auto; overflow: hidden; text-align: center;}
    	#interactive.viewport > canvas, #interactive.viewport > video {max-width: 100%;width: 100%;}
    	canvas.drawing, canvas.drawingBuffer {position: absolute; left: 0; top: 0;}
    </style>
    <script type="text/javascript">
    $(function() {
    	// Create the QuaggaJS config object for the live stream
    	var liveStreamConfig = {
    			inputStream: {
    				type : "LiveStream",
    				constraints: {
    					width: {min: 640},
    					height: {min: 480},
    					aspectRatio: {min: 1, max: 100},
    					facingMode: "environment" // or "user" for the front camera
    				}
    			},
    			locator: {
    				patchSize: "medium",
    				halfSample: true
    			},
    			numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
    			decoder: {
    				"readers":[
    					{"format":"ean_reader","config":{}}
    				]
    			},
    			locate: true
    		};
    	// The fallback to the file API requires a different inputStream option. 
    	// The rest is the same 
    	var fileConfig = $.extend(
    			{}, 
    			liveStreamConfig,
    			{
    				inputStream: {
    					size: 800
    				}
    			}
    		);
    	// Start the live stream scanner when the modal opens
    	$('#livestream_scanner').on('shown.bs.modal', function (e) {
    		Quagga.init(
    			liveStreamConfig, 
    			function(err) {
    				if (err) {
    					$('#livestream_scanner .modal-body .error').html('<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i> '+err.name+'</strong>: '+err.message+'</div>');
    					Quagga.stop();
    					return;
    				}
    				Quagga.start();
    			}
    		);
        });
    	
    	// Make sure, QuaggaJS draws frames an lines around possible 
    	// barcodes on the live stream
    	Quagga.onProcessed(function(result) {
    		var drawingCtx = Quagga.canvas.ctx.overlay,
    			drawingCanvas = Quagga.canvas.dom.overlay;     
    		if (result) {
    			if (result.boxes) {
    				drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
    				result.boxes.filter(function (box) {
    					return box !== result.box;
    				}).forEach(function (box) {
    					Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
    				});
    			}
     
    			if (result.box) {
    				Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
    			}
     
    			if (result.codeResult && result.codeResult.code) {
    				Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
    			}
    		}
    	});
    	
    	// Once a barcode had been read successfully, stop quagga and 
    	// close the modal after a second to let the user notice where 
    	// the barcode had actually been found.
    	Quagga.onDetected(function(result) {    		
    		if (result.codeResult.code){
    			$('#product_keyword3').val(result.codeResult.code);
    			document.getElementById("product_keyword3").focus();
    			document.getElementById("product_keyword3").blur();
    			Quagga.stop();	
    			setTimeout(function(){ $('#livestream_scanner').modal('hide'); }, 1000);			
    		}
    	});
        
    	// Stop quagga in any case, when the modal is closed
        $('#livestream_scanner').on('hide.bs.modal', function(){
        	if (Quagga){
        		Quagga.stop();	
        	}
        });
    	
    	// Call Quagga.decodeSingle() for every file selected in the 
    	// file input
    	$("#livestream_scanner input:file").on("change", function(e) {
    		if (e.target.files && e.target.files.length) {
    			Quagga.decodeSingle($.extend({}, fileConfig, {src: URL.createObjectURL(e.target.files[0])}), function(result) {alert(result.codeResult.code);});
    		}
    	});
    });
    </script>
	<script  type="text/javascript">		   

		jQuery(document).ready(function($) {
			var _scannerIsRunning = false;

			function startScanner() {
				// console.log("Ahasan Ullah");
			    Quagga.init({
			        inputStream: {
			            name: "Live",
			            type: "LiveStream",
			            target: document.querySelector('#scanner-container'),
			            constraints: {
			                width: 480,
			                height: 320,
			                facingMode: "environment"
			            },
			        },
			        decoder: {
			            readers: [
			                "code_128_reader",
			                "ean_reader",
			                "ean_8_reader",
			                "code_39_reader",
			                "code_39_vin_reader",
			                "codabar_reader",
			                "upc_reader",
			                "upc_e_reader",
			                "i2of5_reader"
			            ],
			            debug: {
			                showCanvas: true,
			                showPatches: true,
			                showFoundPatches: true,
			                showSkeleton: true,
			                showLabels: true,
			                showPatchLabels: true,
			                showRemainingPatchLabels: true,
			                boxFromPatches: {
			                    showTransformed: true,
			                    showTransformedBox: true,
			                    showBB: true
			                }
			            }
			        },

			    }, function (err) {
			        if (err) {
			            console.log(err);
			            return
			        }

			        console.log("Initialization finished. Ready to start");
			        Quagga.start();

			        // Set flag to is running
			        _scannerIsRunning = true;
			    });

			    Quagga.onProcessed(function (result) {
			        var drawingCtx = Quagga.canvas.ctx.overlay,
			        drawingCanvas = Quagga.canvas.dom.overlay;

			        if (result) {
			            if (result.boxes) {
			                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
			                result.boxes.filter(function (box) {
			                    return box !== result.box;
			                }).forEach(function (box) {
			                    Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
			                });
			            }

			            if (result.box) {
			                Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
			            }

			            if (result.codeResult && result.codeResult.code) {
			                Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
			            }
			        }
			    });


			    Quagga.onDetected(function (result) {
			    	$("#product_keyword3").val(result.codeResult.code);
	    	    	document.getElementById("product_keyword3").focus();
	    	    	document.getElementById("product_keyword3").blur();
			        console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
			        Quagga.stop();
			        _scannerIsRunning = false;
			        $("#scanner-container").hide();
			    });
			}


			// Start/stop scanner
			// $("#play_scaner").click(function(event) {
			//     event.preventDefault();
			//     alert("Okay");
			//     if (_scannerIsRunning) {
			//         _scannerIsRunning = false;
			//         Quagga.stop();
			//         $("#scanner-container").hide();
			//     } else {       
			//         $("#scanner-container").show();
			//         startScanner();
			//     }
			// });


			$("#barcode").click(function(event) {
				$("#barcode").val('');
			});

			$(".profite_tabel_btn").click(function(event) {
				event.preventDefault();
				$(".product_infor_card").removeClass('d-none').addClass('d-block');
			});

			$(".btn-close").click(function(event) {
				$(".product_infor_card").removeClass('d-block').addClass('d-none');
			});	



			$("#jancode_product_name").keyup(function(event) {
				event.preventDefault();
				var janCode = $(this).val();
				if (event.keyCode==13) {
					$('#jancode_product_name').blur();
				}
			});

			$(document).mouseup(function (e){
				var hide_enter_outside = $(".point_details_table");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');            
				}
			});

			$(document).mouseup(function (e){
				var hide_enter_outside = $(".screen_message");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');            
				}
			});

			$(document).mouseup(function (e){
				var hide_enter_outside = $(".login_screen");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');            
				}
			});
			
			$(document).mouseup(function (e){
				var hide_enter_outside = $(".customer_point_table");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');
				}
			});

			$(document).mouseup(function (e){
				var hide_enter_outside = $("#product_case_message");
				if (!hide_enter_outside.is(e.target) && hide_enter_outside.has(e.target).length === 0)
				{
				    hide_enter_outside.removeClass('d-block').addClass('d-none');
				}
			});

			$(".point_details").click(function(event) {
				event.preventDefault();
				$(".point_details_table").removeClass('d-none').addClass('d-block'); 
			});
			$("#close_case_message").click(function(event) {
				event.preventDefault();
				$("#product_case_message").removeClass('d-block').addClass('d-none'); 
			});

			$("#close_point_detail").click(function(event) {
				$(".point_details_table").removeClass('d-block').addClass('d-none');  
			});


			$("#point_table_btn").click(function(event) {
				event.preventDefault();
				var user_id = $("#login_user_id").val();
				if (user_id != 0) {
					$(".customer_point_table").removeClass('d-none').addClass('d-block');
				}else{
					$('.login_screen').removeClass('d-none').addClass('d-block');
				}
				
			});

			$("#login_screen_close").click(function(event) {
				event.preventDefault();
				$(".login_screen").removeClass('d-block').addClass('d-none');
			});
		});
	</script>
	
	
</body>
</html>
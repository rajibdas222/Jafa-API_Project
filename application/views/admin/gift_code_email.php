<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
    <style type="text/css">
    	table, th, td {
    	  border: 1px solid black;
    	}
    	th, td {
    	  padding: 10px 5px;
    	  font-size: 14px;
    	}
    </style>
</head>
<body>
	<p>
		<strong><?= $user_info->fullname; ?>様</strong><br><br>
		お世話になっております。ジャコス事務局でございます。<br>
		以下の通り、Amazonギフト券をお送りさせていただきます。<br><br>
		■Amazonギフト券<br>
		＊Amazonギフト券の再発行は致しかねます。<br>
		このメッセージをプリントアウトすることをお勧めいたします。<br>
	</p>
		<table class="table table-bordered table-striped" cellspacing="0" cellpadding="0" border="0" style="border: 0;">
			<thead>
				<tr>
					<th nowrap>ギフト券番号<br><span style="color: red; font-size: 10px;"><small>(※ハイフンも含みます)</small></span></th>
					<th nowrap>金額</th>
					<th nowrap>有効期限</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($gift_codes as $key => $gift_code) {
					?>
					<tr>						
						<td><?= $gift_code->gift_code ?> </td>
						<td><?= $gift_code->converted_point ?> 円</td>
						<td><?= $gift_code->expire_date ?></td>
					</tr>
					
					<?php
				}
				?>
			</tbody>
		</table>
		<p>
			<strong><?= $user_info->fullname; ?></strong>様の確定ポイント残高は、<strong><?= $remaining_point ?></strong>ポイントです。<br>
			今後とも価格比較サイト（ﾀﾞﾌﾞﾙﾎﾟｲﾝﾄ）をよろしくお願いいたします。

		</p>
		<p>
			--------------------------------------------------------<br>
			■Amazonギフト券のご利用方法<br>
			Amazonギフト券をご利用いただくには、最初にアカウントにギフト券を登録します。<br>
			 1. <?= $giftcode_user_menual_link ?>  にアクセスする。<br>
			 2.サインインする。<br>
			 3.ギフト券番号を入力し、「アカウントに登録する」をクリックする。<br>
			 4.登録されたギフト券の金額が画面右側に表示されます。<br>
			 5.ショッピングをお楽しみください。<br>
			*Amazonギフト券は一度アカウントに登録すると、有効期限内は残高がゼロになるまでご 利用いただけます。<br>
			<br>
			--------------------------------------------------------
		</p>
		<a target="_blank" href="<?= base_url() ?>">
			<img src="<?= base_url() ?>resource/img/jafa-logo2.png">
		</a>
		<p>E-mail:info_jafa@jacos.co.jp</p>
</body>
</html>
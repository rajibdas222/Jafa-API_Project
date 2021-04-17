<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>JAFA（価格比較サイト） 会員登録完了　</title>
</head>
<body>
<p>
	JAFA（価格比較サイト）です。 <br>
	会員登録が完了しました。 <br>
	　携帯電話　 <strong><?= $username ?></strong> <br>
	　パスワード　 <strong><?= $password ?></strong> <br>
	ご登録ありがとうございました。 <br>
	下記にアクセスして、お買い物をお楽しみください。 <br>


</p>
<p><?= $url ?></p>

<a target="_blank" href="<?= base_url() ?>">
	<img src="<?= base_url() ?>resource/img/jafa-logo2.png">
</a>
<p>E-mail: info_jafa@jacos.co.jp</p>
</body>
</html>

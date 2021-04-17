<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
</head>
<body>
    <p style="margin-bottom: 0;">
       <strong><?= $email_to_name ?>　様</strong> <br><br>
        お世話になっております。<br>
ジャコスでございます。<br><br>

<strong><?= $email_from_name ?>  様</strong>より、ご紹介がありました。<br><br>
ここを押してください。
    </p>
    <p style="font-size: 32px; margin: 0;"> ↓　　 ↓</p>
    <p>
    <?php
        echo $reg_link;
    ?> 
    </p>
    <p>今後とも宜しくお願いいたします。</p>
   
<a target="_blank" href="<?= base_url() ?>">
	<img src="<?= base_url() ?>resource/img/jafa-logo2.png">
</a>
<p>E-mail: info_jafa@jacos.co.jp</p>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title></title>
</head>
<body>
    <p>
       <strong><?= $email_rec_name ?>　様</strong> <br><br>
        お世話になっております。<br>
ジャコスでございます。<br><br>
<?php
    for ($i=0; $i < count($introduce_name) ; $i++) {
        if ($introduce_name[$i] !="") {
            ?>
            <strong><?= $introduce_name[$i] ?>
            ,
             </strong>
            <?php
        }
    }
?>
 様をご紹介いただき、ありがとうございます。<br><br>
    </p>

    <p>今後とも宜しくお願いいたします。</p>
   
<a target="_blank" href="<?= base_url() ?>">
	<img src="<?= base_url() ?>resource/img/jafa-logo2.png">
</a>
<p>E-mail: info_jafa@jacos.co.jp</p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>ＪＡＦＡ（ダブルポイント）</title>
	<link rel="stylesheet" type="text/css" href="resources/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="web-fonts-with-css/css/fontawesome.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
	<!-- <div class="container"> -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">ＪＡＦＡ（ダブルポイント）</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" target="_blank" href="compare">Link</a>
		      </li>
		    </ul>
		    
		  </div>
		</nav>
	<!-- </div> -->
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	  $( function() {
	    var availableTags = [
	      "ActionScript",
	      "AppleScript",
	      "Asp",
	      "BASIC",
	      "C",
	      "C++",
	      "Clojure",
	      "COBOL",
	      "ColdFusion",
	      "Erlang",
	      "Fortran",
	      "Groovy",
	      "Haskell",
	      "Java",
	      "JavaScript",
	      "Lisp",
	      "Pepsi",
	      "PHP",
	      "Python",
	      "Ruby",
	      "味の素  コンソメ  顆粒  袋  ６０ｇ",
	      "エースコック  スープはるさめ  担担味  ３３ｇ",
	      "日清  カップヌードルごはん  ９９ｇ",
	      "日清フーズ  青の洞窟  ボロネーゼ  １４０ｇ",
	      "永谷園  おとなのふりかけ本かつお  １２．５ｇ",
	      "キレイキレイ薬用液体ハンドソープポンプ　２５０ｍｌ",
	      "北海道産　生筋子　120ｇ",
	      "熊本産　かながしら　180ｇ",
	      "青森産　ホタルイカ　180ｇ",
	      "千葉産　豚ひき肉　110ｇ",
	      "静岡産　かいわれ　25ｇ",
	      "神奈川産　小松菜　40ｇ",
	      "バンホーテン　ミルクココア　２４０ｇ",
	      "丸美屋  ソフトふりかけ  さけ  ２８ｇ",
	      "キリン世界のキッチンからソルティライチ  ５００ｍｌ",
	      "お菓子の小麦粉　５００ｇ",
	      "ミューズ　ノータッチ本体セットグレープＦ２５０ｍｌ",
	      "ハウス  北海道シチュークリーム  １８０ｇ",
	      "マルコメ  生みそ汁料亭の味わかめ  １２食  ２１６ｇ",
	      "エコノミー　のどにスッキリ　７５ｇf",
	      "カゴメ  野菜一日これ一杯  ホームパック１０００ｍｌ"
	    ];
	    $( "#product-search" ).autocomplete({
	      source: availableTags
	    });
	    
	  } );
	  </script>
</body>
</html>
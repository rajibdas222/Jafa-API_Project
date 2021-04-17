<!DOCTYPE html>
<html>
<head>
	<title>Test Scanner</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</head>
<body>
	<button class="btn-default btn_link btn-lg" onClick="launchApp()" type="button" style="">スマホでバーコードを撮影</button>
	<div style="width: 0; height: 0; overflow: hidden;">
	  <iframe id="launch_frame" name="launch_frame"></iframe>
	</div>

</body>
<script>
// アプリを開く。アプリがインストールされていなければサイトを開く。
function launchApp() {
  var IOS_SCHEME = 'pic2shop://scan?callback=http%3A//www.google.com/m/products%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
  // var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id=308740640&mt=8';
  var IOS_STORE = 'https://itunes.apple.com/app/pic2shop-shop-by-barcode/id308740640?mt=8';
  
  var ANDROID_SCHEME = 'pic2shop://scan?callback=http%3A//www.google.com/m/products%3Fgl%3Dus%26source%3Dmog%26hl%3Den%26source%3Dgp2%26q%3DEAN%26btnProductsHome%3DSearch%2BProducts';
  var ANDROID_PACKAGE = 'com.visionsmarts.pic2shop';
 
  var userAgent = navigator.userAgent.toLowerCase();
  // iPhone端末ならアプリを開くかApp Storeを開く。
  if (userAgent.search(/iphone|ipad|ipod/) > -1) {
      launch_frame.location.href = IOS_SCHEME + '://';
      setTimeout(function() {
          location.href = IOS_STORE;
      }, 500);
  }
  // Android端末ならアプリを開くかGoogle Playを開く。
  else if (userAgent.search(/android/) > -1) {
      document.location = 'intent://#Intent;scheme=' + ANDROID_SCHEME
              + ';package=' + ANDROID_PACKAGE + ';end';
  }
  // その他・不明・PCなどの場合はアラート表示
  else {
      alert('ios/android only');
  }
}
</script>  
</html>
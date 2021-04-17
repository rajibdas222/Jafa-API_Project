const staticCacheName = 'site-static';
const assets = [
      '/',
      'favicon.png',
      'offline.html',
			'resource/pwa/charin2_152.png',
      'resource/img/jafa-logo2.png',
			'resource/img/Recording.flac2.png',
      'resource/img/1st%20button.png',
      'resource/img/qrcode_pc.JPG',
      'resource/img/ber_code_bg.png',
      'resource/img/AI.png',
      'resource/img/QR%20code.png',
			'resource/bootstrap/dist/css/bootstrap.css',
			'resource/css/style_v2.css'
			// 'http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
    ];

self.addEventListener('install', evt => {
    evt.waitUntil(
      caches.open(staticCacheName).then(cache => {
        return cache.addAll(assets);
      })
    );	
})

// Active Service Worker 
self.addEventListener('activate', evt => {
    console.log("service worker activated")
})

// Fetch service
self.addEventListener('fetch', evt => {
    // console.log("Data is fetched", evt);
    // evt.respondWith(
    //   // Try the cache
    //   caches.match(evt.request).then(function(cacheRes) {
    //     // Fall back to network
    //     return cacheRes || fetch(evt.request);
    //   }).catch(function() {
    //     console.log("It is offline");
    //     return caches.match('offline.html');
    //   })
    // )
})
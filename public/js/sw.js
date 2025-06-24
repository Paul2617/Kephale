const CACHE_NAME = 'mon-app-cache-v1';
const urlsToCache = 
[
  '/', 
  'public/index.php', 
  'public/style.css', 
  'public/app.js',
  'public/icon_192x192.png',
  'public/icon_512x512.png',

  'public/asset/home_svg/home_.svg',
   'public/asset/home_svg/home.svg',
    'public/asset/home_svg/loupe.svg',
     'public/asset/home_svg/loupe_.svg',
      'public/asset/home_svg/message.svg',
       'public/asset/home_svg/message_.svg',
        'public/asset/home_svg/panie.svg',
         'public/asset/home_svg/panie_.svg',
          'public/asset/home_svg/parametre.svg',
           'public/asset/home_svg/parametre_.svg',
            'public/asset/home_svg/restaurant.svg',
            'public/asset/home_svg/restaurant_.svg',
            'public/asset/home_svg/user.svg',
            'public/asset/home_svg/user_.svg',
  
];

self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
    );
});

self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // Cache hit - return response
                if (response) {
                    return response;
                }
                
                // Clone the request
                const fetchRequest = event.request.clone();
                
                return fetch(fetchRequest).then(
                    response => {
                        // Check if we received a valid response
                        if(!response || response.status !== 200 || response.type !== 'basic') {
                            return response;
                        }
                        
                        // Clone the response
                        const responseToCache = response.clone();
                        
                        caches.open(CACHE_NAME)
                            .then(cache => {
                                cache.put(event.request, responseToCache);
                            });
                        
                        return response;
                    }
                );
            })
    );
});

self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});


const isIos = () => {
  const userAgent = window.navigator.userAgent.toLowerCase();
  return /iphone|ipad|ipod/.test(userAgent);
};

async function requestNotificationPermission() {
  if (!('Notification' in window)) return false;
  
  if (Notification.permission === 'granted') return true;
  
  const permission = await Notification.requestPermission();
  return permission === 'granted';
}

const isInStandaloneMode = () => ('standalone' in window.navigator) && window.navigator.standalone;

if (isIos() && !isInStandaloneMode()) {
  const iosBanner = document.getElementById('iosInstall');
  if (iosBanner) iosBanner.style.display = 'block';
}

if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/public/js/sw.js')
    .then(reg => console.log('Service Worker enregistré', reg))
    .catch(err => console.error('Erreur SW:', err));
}

async function requestNotificationPermission() {
  if (!('Notification' in window)) {
    console.log('Notifications non supportées');
    return false;
  }
  
  if (Notification.permission === 'granted') {
    return true;
  }
  
  const permission = await Notification.requestPermission();
  return permission === 'granted';
}

async function subscribeToPushNotifications(registration) {
  if (!('PushManager' in window)) {
    console.log('Notifications push non supportées');
    return;
  }
    console.log('Notifications supportées');
   }

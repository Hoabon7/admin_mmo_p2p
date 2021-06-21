// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyAzogiFTp1os0Zhk5pOcw50mXhcGIZaWAs",
    authDomain: "mmo-p2p.firebaseapp.com",
    projectId: "mmo-p2p",
    storageBucket: "mmo-p2p.appspot.com",
    messagingSenderId: "817820171922",
    appId: "1:817820171922:web:5df8a2b040c5dbc7f4f04b",
    measurementId: "G-354YNPWRQX"
});



// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    console.log("Message received.", payload);

    const title = "Hello world is awesome111";
    const options = {
        body: "Your notificaiton message 111.",
        icon: "/firebase-logo.png",
    };

    return self.registration.showNotification(
        title,
        options,
    );
});
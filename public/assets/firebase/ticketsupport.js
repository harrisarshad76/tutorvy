  // Import the functions you need from the SDKs you need
import {
    initializeApp
} from "https://www.gstatic.com/firebasejs/9.5.0/firebase-app.js";
import {
    getAnalytics
} from "https://www.gstatic.com/firebasejs/9.5.0/firebase-analytics.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyCpJjFlBbKKVNtnr8C27Q0JNPbT9Onw2Zo",
    authDomain: "tutorvy-support.firebaseapp.com",
    projectId: "tutorvy-support",
    storageBucket: "tutorvy-support.appspot.com",
    messagingSenderId: "485519028370",
    appId: "1:485519028370:web:1bcf230b47172f25a6764b",
    measurementId: "G-TKK3MPRS8T"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);


function sendMessage(e) {
   e.preventDefault();
   alert('ds')
}

// $("#stdTicketForm").submit(function(e) {
//     e.preventDefault();
//     alert('dsd')
//     var message = document.getElementById("message").value

//     firebase.database().ref("messages").push().set({
//         "ticket":"{{$ticket->id}}",
//         "sender":"{{Auth::id()}}",
//         "message":message
//     })


// })


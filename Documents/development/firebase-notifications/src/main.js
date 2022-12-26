import Vue from 'vue'
import App from './App.vue'
import firebase from "firebase/compat/app";
import { getToken } from "firebase/messaging";
import { getMessaging } from "firebase/messaging/sw";
Vue.config.productionTip = false

const firebaseConfig = {
  apiKey: "AIzaSyAQomwxgLvn-EMnghCJLF8ZQsGug60_caU",
  authDomain: "jobtestsite.firebaseapp.com",
  projectId: "jobtestsite",
  storageBucket: "jobtestsite.appspot.com",
  messagingSenderId: "939114338155",
  appId: "1:939114338155:web:fae292e5dfe04eeaef1e2e"
};

// const firebaseConfig = firebaseConfiguration;
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const messaging = getMessaging();
getToken(messaging, {
    vapidKey:
        "BHhEECbT5wi01g59fSyc8RQaWWQeeRilQzX2Qw7h4AsABW-RQbu_xQqtNBGeFTnaaOmWhawAbguI38hAIs9XrPA"
})
    .then(currentToken => {
        console.log(currentToken);
        
    })
    .catch(err => {
        console.log("An error occurred while retrieving token. ", err);
    });

new Vue({
  render: h => h(App),
}).$mount('#app')

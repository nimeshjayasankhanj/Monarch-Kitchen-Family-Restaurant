import { getMessaging } from "firebase/messaging";
import { initializeApp, getApps } from "firebase/app";

const firebaseConfig = {
  apiKey: "AIzaSyAQomwxgLvn-EMnghCJLF8ZQsGug60_caU",
  authDomain: "jobtestsite.firebaseapp.com",
  projectId: "jobtestsite",
  storageBucket: "jobtestsite.appspot.com",
  messagingSenderId: "939114338155",
  appId: "1:939114338155:web:fae292e5dfe04eeaef1e2e",
};

const apps = getApps();

const app = !apps.length ? initializeApp(firebaseConfig) : apps[0];

export const messaging=getMessaging(app);

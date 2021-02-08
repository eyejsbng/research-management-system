import * as firebase from 'firebase';

let firebaseConfig = {
    apiKey: "AIzaSyCcdGKTz6vunE7v_3LPtxmXBWFMitEkYV0",
    authDomain: "ccerms-ac3c9.firebaseapp.com",
    databaseURL: "https://ccerms-ac3c9.firebaseio.com",
    projectId: "ccerms-ac3c9",
    storageBucket: "ccerms-ac3c9.appspot.com",
    messagingSenderId: "686967580126",
    appId: "1:686967580126:web:2a53320c28dc253540e94f",
    measurementId: "G-E5RLYPX3TV"
  };

  firebase.initializeApp(firebaseConfig);

  export default firebase;

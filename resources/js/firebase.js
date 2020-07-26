import firebase from 'firebase'

var config = {
    apiKey: "AIzaSyBdn2cyNdesYXz91KyjloawaEkYbUkHQ10",
    authDomain: "ilove-5b196.firebaseapp.com",
    databaseURL: "https://ilove-5b196.firebaseio.com",
    projectId: "ilove-5b196",
    storageBucket: "ilove-5b196.appspot.com",
    messagingSenderId: "131818719782",
    appId: "1:131818719782:web:5ac6f8869f7ead322134e7",
    measurementId: "G-4W0L01TVL3"
  }
const firebaseApp = firebase.initializeApp(config)

export const storage = firebaseApp.storage()
export const database = firebaseApp.database()

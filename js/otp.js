// firebase-setup.js

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js";
import { getAuth, signInWithPhoneNumber, RecaptchaVerifier } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-auth.js";

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyDL7TSlh_LLE8dZry0EEV5jrJpbPM0vBr8",
  authDomain: "chillis-febed.firebaseapp.com",
  projectId: "chillis-febed",
  storageBucket: "chillis-febed.appspot.com",
  messagingSenderId: "866434581427",
  appId: "1:866434581427:web:53cb835efdc4d58b9101c6",
  measurementId: "G-9VW66NQ33S"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

// Setup reCAPTCHA verifier
window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
  size: 'invisible',
  callback: (response) => {
    // reCAPTCHA solved, allow signInWithPhoneNumber.
  }
}, auth);

// Send OTP
window.sendOtp = (phoneNumber) => {
  const appVerifier = window.recaptchaVerifier;
  signInWithPhoneNumber(auth, phoneNumber, appVerifier)
    .then((confirmationResult) => {
      // SMS sent. Prompt user to type the code from the message.
      window.confirmationResult = confirmationResult;
      console.log('OTP sent');
    }).catch((error) => {
      console.error('Error during signInWithPhoneNumber', error);
    });
};

// Verify OTP
window.verifyOtp = (otp) => {
  window.confirmationResult.confirm(otp).then((result) => {
    // User signed in successfully.
    const user = result.user;
    console.log('User signed in', user);
  }).catch((error) => {
    console.error('Error while verifying OTP', error);
  });
};

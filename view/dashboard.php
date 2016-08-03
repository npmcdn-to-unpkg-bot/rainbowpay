<!DOCTYPE html>
<html lang="en-us">
      <head>
    <meta charset="UTF-8">
    <title>Rainbow by Amonsoft</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="stylesheets/normalize.css" media="screen">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen">
    <link rel="stylesheet" type="text/css" href="stylesheets/github-light.css" media="screen">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
  </head>
  <body>
      <a href="http://ec2-54-191-230-33.us-west-2.compute.amazonaws.com/rainbow/view/testlogin.html" >Login</a>
      <p>Welcome to your Rainbow Account Dashboard Dear ,<span id="namex"></span></p>
       </body>
          <script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
    <script>
       // Initialize Firebase
  var config = {
    apiKey: "AIzaSyCWiOxfjaIxZpRySZ24HKWrS5j9EqZ1p4M",
    authDomain: "rainbow-512e0.firebaseapp.com",
    databaseURL: "https://rainbow-512e0.firebaseio.com",
    storageBucket: "rainbow-512e0.appspot.com",
  };
  firebase.initializeApp(config);
    
        var user = firebase.auth().currentUser;
    

   firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
       console.log("Loggedin");
      console.log(user.displayName)
      console.log(user.email);
      document.getElementById("namex").innerHTML = user.email;
  } else {
    // No user is signed in.
       console.log("Failed");
  }
});
  //var user = firebase.auth().currentUser;    
 
 /* 

if (user != null) {
  user.providerData.forEach(function (profile) {
    console.log("Sign-in provider: "+profile.providerId);
    console.log("  Provider-specific UID: "+profile.uid);
    console.log("  Name: "+profile.displayName);
    console.log("  Email: "+profile.email);
    console.log("  Photo URL: "+profile.photoURL);
  });
}
      
if (user != null) {
  //window.location.replace("http://ec2-54-191-230-33.us-west-2.compute.amazonaws.com/rainbow/view/");
    console.log("Loggedin");
  if (user.emailVerified) {
    console.log('Email is verified');
  }
  else {
    console.log('Email is not verified');
  }
} else {
 // window.location.replace("http://localhost/cathy/rainbow/view/login.html");
     console.log("Failed");
}*/
        
    </script>
</html>




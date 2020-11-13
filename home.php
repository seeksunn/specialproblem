<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h5 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
  background-image: url('/images/bg.jpg');
  min-height: 100%;
  background-position: center;
  background-size: cover;
}
</style>
<body>
<?php
    session_start();
    if(isset($_SESSION['Online'])){
        if($_SESSION['Online'] == "true") {      
          header('Location:exerciseslist.php');        
     
     }
        
    }    
?>

<div class="bgimg w3-display-container w3-text-white">
  <div class="w3-display-middle w3-jumbo">
    <p><img src="/images/logo.png" alt="logo" style="height:400px"></p>
  </div>
  <div class="w3-display-topleft w3-container w3-xlarge">
    <p><button onclick="document.getElementById('loginmodal').style.display='block'" class="w3-button w3-black">login</button></p>
    <p><button onclick="document.getElementById('regismodal').style.display='block'" class="w3-button w3-black">sign up</button></p>
  </div>
  <div class="w3-display-bottomleft w3-container">
    <p class="w3-xlarge w3-text-white">English Pronunciation Site</p>
    <p class="w3-large w3-text-white">Improve Your Skill Here!</p>
    <p>Special Project of CS KMITL</p>
  </div>
</div>

<!-- Login Modal -->
<div id="loginmodal" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black w3-display-container">
      <span onclick="document.getElementById('loginmodal').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>login</h1>
    </div>
    <div class="w3-container">
      <form action="check_login.php" method="POST">  
        <h5>Username/Email</h5>
        <h5><input class="w3-input" type="text" id="username" name="username"></h5>
        <h5>Passsword</h5>
        <h5><input class="w3-input" type="password" id="password" name="password"></h5>
    </div>
    <div class="w3-container w3-black">
      <h3><button type="submit" class="w3-button w3-block w3-red" value="Submit" style="width:100%">Go! >></button></h3>
    </form>
    </div>   
  </div>
</div>

<!-- Sign Up Modal -->
<div id="regismodal" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black">
      <span onclick="document.getElementById('regismodal').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Register</h1>
    </div>
    <div class="w3-container">
      <p>Glad you'd like to be our member</p>
      <form action="/register.php" method="POST">
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Username" required name="Username"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Password" required name="Password"></p>        
        <p><button class="w3-button" type="submit">Register</button></p>
      </form>
    </div>
  </div>
</div>

</body>
</html>

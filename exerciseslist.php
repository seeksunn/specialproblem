<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body, html {height: 100%}
body,h1,h2,h3,h4,h5,h6,p {font-family: "Raleway", sans-serif}
h1 {font-size: 25px;}
p {font-size: 20px;}
.menu {display: none}
.bgimg {
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url('/images/bg.jpg');
  min-height: 90%;
}
</style>
<body>
<?php include("check_session.php")?>
<!-- Header with image -->
<header class="bgimg w3-display-container w3-grayscale-min" id="home">
  <div class="w3-display-bottomleft w3-padding">
    <a href='logout.php' class="w3-tag w3-xlarge" style="text-decoration: none;">Log out</a>
  </div>
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white w3-hide-small" style="font-size:100px">Improve Your Skill</span>
    <span class="w3-text-white w3-hide-large w3-hide-medium" style="font-size:60px"><b>Improve Your Skill</b></span>
    <p><a href="#menu" class="w3-button w3-xxlarge w3-black">Let get starts</a></p>
  </div>
</header>

<!-- Menu Container -->
<div class="w3-container w3-black w3-padding-64 w3-xxlarge" id="menu">
  <div class="w3-content">
  
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">Exercise</h1>
    <div class="w3-row w3-center w3-border w3-border-dark-grey">
      <a href="javascript:void(0)" onclick="openMenu(event, 'Vowels');" id="myLink">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">Vowels<br>(สระ)</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'Consonants');">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">Consonants<br>(พยัญชนะ)</div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'Random');">
        <div class="w3-col s4 tablink w3-padding-large w3-hover-red">Random Words!<br>(สุ่มคำ)</div>
      </a>
    </div>
    <?php     
      include("connection.php");
      $usermng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
      $userfilter = ['username' => $_SESSION['Username']]; 
      $userquery = new MongoDB\Driver\Query($userfilter);   
      $userrows = $usermng->executeQuery($databaseName.".users", $userquery);
      foreach ($userrows as $row) {  
        $userCompleted=$row->completed;      
      }               
    ?>

    <div id="Vowels" class="w3-container menu w3-padding-32 w3-white">
      <?php 
      include("connection.php");
      $filter = [ 'voc' => 'vowels' ]; 
      $query = new MongoDB\Driver\Query($filter);   
      $rows = $mng->executeQuery($databaseName.".exercises", $query);
      foreach ($rows as $row) {
        $id=$row->_id;        
        echo "<h1><b><a href='exercises.php?ex=$id'>$row->topic</a></b>";       
        
        for($i=0;$i<count($userCompleted);$i++){
          if($id==$userCompleted[$i]){
            echo "<span class='w3-right w3-tag w3-green w3-round'>done</span>";
          }                  
        }       
        echo "</h1><p class='w3-text-grey'>$row->contentTopic</p><hr>";
      }   
      ?>
      
    </div>

    <div id="Consonants" class="w3-container menu w3-padding-32 w3-white">
    <?php
        include("connection.php");
        $filter = [ 'voc' => 'consonants' ]; 
        $query = new MongoDB\Driver\Query($filter);   
        $rows = $mng->executeQuery($databaseName.".exercises", $query);
        foreach ($rows as $row) {
          $id=$row->_id;        
          echo "<h1><b><a href='exercises.php?ex=$id'>$row->topic</a></b>";       
          
          for($i=0;$i<count($userCompleted);$i++){
            if($id==$userCompleted[$i]){
              echo "<span class='w3-right w3-tag w3-green w3-round'>done</span>";
            }                  
          }       
          echo "</h1><p class='w3-text-grey'>$row->contentTopic</p><hr>";
        }     
    ?>
    </div>
    <div id="Random" class="w3-container menu w3-padding-32 w3-white">
      <div class='w3-container w3-padding-64 w3-content w3-center' id='playpart'>
        <div id='word' style='font-size: 40px; color: black;'>
          สุ่มคำจากฐานข้อมูลทั้งหมด<br><br>
          <form action='random_word.php' method='GET'>
            <input type="submit" value='Go!' name='random' class='w3-button w3-black w3-round w3-padding-large w3-large'></input>
          </form>
        </div>                    
      </div>             
    </div>
  </div>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-48 w3-xxlarge">
  <p>Special Project of CS KMITL</p>
</footer>

<script>
// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-red";
}
document.getElementById("myLink").click();
</script>

</body>
</html>

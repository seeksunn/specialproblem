<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="csslayout.css">
  <meta charset="utf-8">
  <title>Check Login</title>
  <script>
    function invalidLogIn(){      
      document.getElementById("invalidLogInPopUp").style.display = "block";
    }    
  </script>
</head>
<body> 
  <div id="invalidLogInPopUp" style="display:none;">    
    <br><p><b>Username หรือ Password ไม่ถูกต้อง</b></p><br>    
    <button onclick="window.history.back();"><b>ตกลง<b></button><br><br>    
  </div>
  <?php
  session_start();  
  if(!empty($_POST['username']) && !empty($_POST['password'])){
    include("connection.php");
    $rows = $mng->executeQuery($databaseName.".users", $query);    
    foreach ($rows as $row) {
      if($row->username==$_POST['username']&&$row->password==$_POST['password']){
        $_SESSION["Username"] = $row->username;             
        $_SESSION["Online"] = "true";
        header('Location:exerciseslist.php');
        session_write_close();
      }else {
        echo "<script>invalidLogIn();</script>";        
      }      
    }
  } else {
    echo "<script>invalidLogIn();</script>";     
  } 
  ?>  
</body>
</html>
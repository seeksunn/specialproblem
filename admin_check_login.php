<?php
session_start();
if(!empty($_POST['password'])){
    include("connection.php");
    $rows = $mng->executeQuery($databaseName.".admin", $query);    
    foreach ($rows as $row) {       
      if($row->password==$_POST['password']){        
        $_SESSION["AdminId"] = $row->_id; 
        $_SESSION["Admin"] = "true";       
        header('Location:admin_manage.php');
        session_write_close();
      }else {
        echo    "invalid password<br>
                <a href='admin_page.php'>OK</a>";        
      }      
    }
  } else {
    echo    "please enter password<br>
            <a href='admin_page.php'>OK</a>";      
  } 

?>
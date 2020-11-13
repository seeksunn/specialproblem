<?php
    session_start();
    if(isset($_SESSION['Online'])){
        if($_SESSION['Online'] == "true") {        
        
        } else {
            header('Location:home.php');
        }
     } else {
        header('Location:home.php');
    }    
?>
<html>
<head>
<style>
.content {
  max-width: 500px;
  margin: auto;
}
</style>
</head>
    <body>   
        <?php
        session_start();
        if(isset($_SESSION['Admin'])){
            if($_SESSION['Admin'] == "true") {        
                echo "Admin ID = ".$_SESSION["AdminId"];
            } else {
                header('Location:admin_page.php'); 
            }
         } else {
            header('Location:admin_page.php'); 
        } 
        ?>
        <div class='content'>     
        <form action="add_word.php" method="POST">            
            <label for="words">Words (เว้นวรรคเพื่อแยกแต่ละคำ):</label><br>
            <textarea rows = "60" cols = "100" id="words" name = "words"></textarea><br><br>                                
            <input type="submit" value="Submit">
        </form>
        </div>
    </body>
</html>
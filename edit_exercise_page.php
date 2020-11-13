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
    <div class='content'>
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
        include("connection.php");
        $id = new MongoDB\BSON\ObjectId($_POST["edit"]);
        $idd = $_POST["edit"];        
        $filter = ['_id' => $id]; 
        
        $query = new MongoDB\Driver\Query($filter);
        $rows = $mng->executeQuery($databaseName.".exercises", $query); 
        
        foreach ($rows as $row) {
            $words=implode(" ",$row->words);
            echo "
            <form action='edit_exercise.php' method='POST'>            
            <label for='topic'>Topic:</label>
            <input type='text' id='topic' name='topic' value='$row->topic'><br><br>
            <label for='objective'>Objective:</label>
            <input type='text' id='objective' name='objective' value='$row->objective'><br><br>
            <label for='contentTopic'>Content Topic:</label>
            <input type='text' id='contentTopic' name='contentTopic' value='$row->contentTopic'><br><br>
            <label for='content'>Content:</label><br>
            <textarea rows = '60' cols = '100' id='content' name = 'content'>$row->content</textarea><br><br>
            <label for='words'>Words (เว้นวรรคเพื่อแยกแต่ละคำ):</label><br>
            <textarea rows = '60' cols = '100' id='words' name = 'words'>$words</textarea><br><br>
            <label for='onlyread'>Only Read:</label><br>
            <input type='radio' id='onlyreadt' name='onlyread' value='true'>
            <label for='true'>True</label><br>
            <input type='radio' id='onlyreadf' name='onlyread' value='false'>
            <label for='false'>False</label><br><br>
            <label for='voc'>Vowels or Consonants:</label><br>
            <input type='radio' id='voc' name='voc' value='vowels'>
            <label for='vowels'>Vowels</label><br>
            <input type='radio' id='voc' name='voc' value='consonants'>
            <label for='consonants'>Consonants</label><br><br> 
            <input type='text' id='id' name='id' value='$id' style='display:none;'>                     
            <input type='submit' name='submit' value='submit'>            
            </form>
            ";
        }
        ?>   
    </div>
    </body>
</html>
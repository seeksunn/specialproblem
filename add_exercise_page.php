<html>
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
        <form action="add_exercise.php" method="POST">
            <label for="topic">Topic:</label>
            <input type="text" id="topic" name="topic"><br><br>
            <label for="objective">Objective:</label>
            <input type="text" id="objective" name="objective"><br><br>
            <label for="contentTopic">Content Topic:</label>
            <input type="text" id="contentTopic" name="contentTopic"><br><br>
            <label for="content">Content:</label><br>
            <textarea rows = "60" cols = "100" id="content" name = "content"></textarea><br><br>
            <label for="words">Words (เว้นวรรคเพื่อแยกแต่ละคำ):</label><br>
            <textarea rows = "60" cols = "100" id="words" name = "words"></textarea><br><br>
            <label for="onlyread">Only Read:</label><br>
            <input type="radio" id="onlyreadt" name="onlyread" value="true">
            <label for="true">True</label><br>
            <input type="radio" id="onlyreadf" name="onlyread" value="false">
            <label for="false">False</label><br><br>
            <label for="voc">Vowels or Consonants:</label><br>
            <input type="radio" id="voc" name="voc" value="vowels">
            <label for="vowels">Vowels</label><br>
            <input type="radio" id="voc" name="voc" value="consonants">
            <label for="consonants">Consonants</label><br><br>                      
            <input type="submit" value="Submit">
        </form>
        </div>
    </body>
</html>
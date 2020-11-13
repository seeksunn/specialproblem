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
        <br>
        <hr>
        <div class='content'>
        <a href='add_exercise_page.php'>เพิ่มแบบฝึกหัด</a>|
        <a href='add_word_page.php'>เพิ่มคำศัพท์</a>|
        <a href='logout.php'>ออกจากระบบ</a>
        </div>
        <hr>
        <?php
        include("connection.php");
        $filter = ['_id' => $_SESSION["AdminId"]]; 
        $query = new MongoDB\Driver\Query($filter);
        $rows = $mng->executeQuery($databaseName.".admin", $query);
        foreach ($rows as $row) {
            $createdArray = $row->created;
        }
        $query = new MongoDB\Driver\Query([]);
        $rows = $mng->executeQuery($databaseName.".exercises", $query);
        echo "
        <table border = '1' align='center' width='50%'>
            <tr>
                <th>ExerciseID</th>
                <th>Topic</th>
                <th>onlyread</th>
                <th>voc</th>
                <th>Creator</th>                
            </tr>";
        foreach ($rows as $row) {                 
            echo "    
                <tr>
                    <td align='center'>".$row->_id."</td>
                    <td align='center'>".$row->topic."</td>
                    <td align='center'>".$row->onlyread."</td>
                    <td align='center'>".$row->voc."</td>
                    <td align='center'>".$row->creator."</td>";
            if(in_array($row->_id ,$createdArray))                       
            echo "
                <td align='center'><form method='POST' action='/delete_exercise.php'><button name='id' value='".$row->_id."'><b>ลบ</b></button></form></td>
                <td align='center'><form method='POST' action='/edit_exercise_page.php'><button name='edit' value='".$row->_id."'><b>แก้ไข</b></button></form></td>
                </tr>";
        }
        echo "</table><br>";

        ?>
        
        <hr>        
    </body>
</html>
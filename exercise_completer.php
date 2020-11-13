<?php
if($_POST['completed']=="Complete"){
    session_start();
    include("connection.php");
    $newCompletedArrays;
    
    $filter = [ 'username' => $_SESSION["Username"] ]; 
        $query = new MongoDB\Driver\Query($filter);   
        $rows = $mng->executeQuery($databaseName.".users", $query);
        foreach ($rows as $row) {
            $newCompletedArrays = $row->completed;
    }
    array_push($newCompletedArrays, $_POST["id"]);
    $bulk = new MongoDB\Driver\BulkWrite;    
    $bulk->update(['username' => $_SESSION["Username"]], ['$set' => ['completed' => $newCompletedArrays]]);
    $mng->executeBulkWrite($databaseName.'.users', $bulk); 
    header("location:exerciseslist.php#menu");    
}
else {
    header("location:exerciseslist.php#menu");
}
?>
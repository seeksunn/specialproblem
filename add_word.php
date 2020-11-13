<?php 
include("connection.php");
$wordsArray = (explode(" ",$_POST['words']));
foreach ($wordsArray as $wordInArr) {     
    $filter = [ 'words' => $wordInArr]; 
    $query = new MongoDB\Driver\Query($filter); 
    $res = $mng->executeQuery($databaseName.".words", $query);
    $words = current($res->toArray());
    
    if (!empty($words)) {
        echo $words->index, ": ", $words->words, PHP_EOL;
    } else {
        echo "No match found\n";
    }
} 

?>
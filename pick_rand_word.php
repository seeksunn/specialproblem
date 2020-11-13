<?php

include("connection.php");
$index = rand(0,107547);
$filter = [ 'index' => $index ]; 
$query = new MongoDB\Driver\Query($filter);   
$rows = $mng->executeQuery($databaseName.".words", $query);
foreach ($rows as $row) {
    echo $row->words;
}
?>

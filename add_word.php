<?php 
include("connection.php");
$query = new MongoDB\Driver\Query([], ['sort' => [ '_id' => -1], 'limit' => 1]); 
$rows = $mng->executeQuery($databaseName.".words", $query);    
foreach ($rows as $row) {
    $lastIndex = $row->index;    
}


$wordsArray = (explode(" ",$_POST['words']));
//$wordsArray = ['apple','banana'];
foreach ($wordsArray as $wordInArr) {     
    $filter = [ 'words' => $wordInArr]; 
    $query = new MongoDB\Driver\Query($filter); 
    $res = $mng->executeQuery($databaseName.".words", $query);
    $words = current($res->toArray());
    
    if (!empty($words)) {
        echo $words->index, ": ", $words->words, PHP_EOL;
        echo "<br>";

    } else {
        if ( !empty($_POST) ){
            $lastIndex++;
            $doc = ['index' => $lastIndex,'words' => $wordInArr];
            $bulk->insert($doc);        
            echo "insert ".$wordInArr."<br>";
        }        
    }
} 
try {     
    $mng->executeBulkWrite($databaseName.'.words', $bulk);        
} catch (MongoDB\Driver\Exception\Exception $e) {    
    echo "มีบางคำเป็นคำที่มีอยู่แล้วในฐานข้อมูล เราจึงเพิ่มแต่คำที่ไม่ซ้ำ <br>";    
}
echo " <a href='admin_manage.php'>ตกลง</a>";




?>
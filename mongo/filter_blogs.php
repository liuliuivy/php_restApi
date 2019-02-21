<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'db.php';

$dbname = 'roytuts';
$collection = 'blogs';

$db = new DbManager();
$conn = $db->getConnection();

//read all records

$filter = [
    'views' => [
        '$gte' => 100,
    ],
];
$option = ['projection' => [
    'title' => 1,
    'article' => 1,
],
/* Return the documents in descending order of views */
'sort' => [
    'views' => -1
],
];
$read = new MongoDB\Driver\Query($filter,$option);

//fetch records
$records = $conn->executeQuery("$dbname.$collection",$read);

echo json_encode(iterator_to_array($records));


?>

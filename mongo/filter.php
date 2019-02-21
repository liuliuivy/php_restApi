<?php
/* Select only documents authord by "bjori" with at least 100 views */
$filter = [
    'author' => 'bjori',
    'views' => [
        '$gte' => 100,
    ],
];

$options = [
    /* Only return the following fields in the matching documents */
    'projection' => [
        'title' => 1,
        'article' => 1,
    ],
    /* Return the documents in descending order of views */
    'sort' => [
        'views' => -1
    ],
];

$query = new MongoDB\Driver\Query($filter, $options);

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$readPreference = new MongoDB\Driver\ReadPreference(MongoDB\Driver\ReadPreference::RP_PRIMARY);
$cursor = $manager->executeQuery('databaseName.collectionName', $query, $readPreference);

foreach($cursor as $document) {
    var_dump($document);
}

?>

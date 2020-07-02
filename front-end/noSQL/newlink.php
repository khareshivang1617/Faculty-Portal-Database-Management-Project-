<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client;
$companydb = $client->companydb;   

foreach ($companydb->listCollections() as $collection)
{
    var_dump($collection);
}

$result2 = $companydb->createCollection('MY_newcollection');

echo '<a href="http://localhost/phpmongodb/demo.php">Go Back</a>';

?>
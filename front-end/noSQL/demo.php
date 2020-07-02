<?php

//require 'vendor/autoload.php';
printf("HELLOW!!!\n"); 

$user_name=$_POST["username"];
$pass_word=$_POST["password"];

if (isset($_POST["username"]) && isset($_POST["password"]))
{
    if (empty($user_name) || empty($pass_word))
    {
        echo "Please entert all the fields";
    }

    else
    {
        echo $user_name;
    }
}

else
{
    echo "Please entert all the fields";
}


/*foreach ($companydb->listCOllections() as $collection)
{
    var_dump($collection);
}*/

//echo '<a href="http://localhost/phpmongodb/newlink.php">NEWPHPLINK</a>';

//$client = new MongoDB\Client;



/*$result3 = $client->dropDatabase('companydb1');

var_dump($result3);
*/

/*
foreach($client->listDatabases() as $db)
{
    var_dump($db);
}
*/

/*
$companydb = $client->companydb;

$result2 = $companydb->createCollection('newcollection');

var_dump($result2);
*/

/*foreach($companydb->listCollections() as $collection)
{
    var_dump($collection);
}*/

/*
$result1 = $companydb->createCollection('mycollection');

var_dump($result1);
*/
?>
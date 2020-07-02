<?php

$user_name=$_POST["username"];

if (!isset($_POST["username"]) || empty($user_name))
{
    echo "Please enter all the fields";
}

require 'vendor/autoload.php';
$client = new MongoDB\Client;
$database = $client->faculty;
$collection = $database->faculty;

$doclist = $collection->find(
    ['Username' => $user_name]
);

foreach($doclist as $doc)
{
    echo "<br>";

    echo "Username : ";
    echo $doc['Username'];
    echo "<br>";

    echo "First Name : ";
    echo $doc['firstname'];
    echo "<br>";
    
    echo "Last Name : ";
    echo $doc['secondname'];
    echo "<br>";


    echo "DOB : ";
    echo $doc['DOB'];
    echo "<br>";

    if (!empty($doc['email']))
    {
        echo "E-mail : ";
        echo $doc['email'];
        echo "<br>";
    }
    
    if (!empty($doc['ph_no']))
    {
        echo "Ph. No. : ";
        echo $doc['ph_no'];
        echo "<br>";
    }

    if (!empty($doc['publications']))
    {
        echo "Publications : ";
        echo $doc['publications'];
        echo "<br>";
    }

    if (!empty($oc['grants']))
    {
        echo "Grants : ";
        echo $doc['grants'];
        echo "<br>";
    }

    if (!empty($doc['biography']))
    {
        echo "Bio : ";
        echo $doc['biography'];
        echo "<br>";
    }
}


echo "If nothings found, please go back and\n";
echo '<a href="http://localhost/phpmongodb/UsersList.php">Re-enter</a>';
echo "<br> Or go to ";
echo '<a href="http://localhost/phpmongodb/Homepage.php">Home</a>';
echo "<br>";


?>
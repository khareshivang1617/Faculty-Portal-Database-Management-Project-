<?php

require 'vendor/autoload.php';
$client = new MongoDB\Client;
$database = $client->faculty;
$collection = $database->faculty;

$doclist = $collection->find([]);

echo "USERNAMES : ";

foreach($doclist as $doc)
{
    echo "<br>";
    echo $doc['Username'];
}

echo "<br>";

?>

<html>
<body>

<form action="GetUserPage.php" method="post">
<b>Username : <b> <input type="text" name="username">
<br>
<input type="submit">
</form>

</body>
</html>
<?php

$user_name=$_POST["username"];
$pass_word=$_POST["password"];

session_start();
$_SESSION["uname"]=$user_name;
$_SESSION["pass"]=$pass_word;

if (isset($_POST["username"]) && isset($_POST["password"]))
{
    if (empty($user_name) || empty($pass_word))
    {
        echo "Please entert all the fields<br>";
    }
}

else
{
    echo "Please entert all the fields<br>";
}



require 'vendor/autoload.php';
$client = new MongoDB\Client;
$database = $client->faculty;
$collection = $database->faculty;

$doclist = $collection->findOne(
    ['Username' => $user_name, 'Password' => $pass_word]
);

if (empty($doclist))
{
    echo "Username or Password not found!!!<br>";
    echo '<a href="http://localhost/phpmongodb/LoginPortal.php">Re-Login</a>';
}

else
{
    echo "WELCOME ";
    echo $doclist['Username'];
    echo"!!!<br>";

    //echo "What you wish to do now?\n";

    echo "<br>Your personal info is as follows : <br>";
    echo "Name : ";
    echo $doclist["firstname"];
    echo " ";
    echo $doclist["secondname"];
    echo "<br>DOb : ";
    echo $doclist["DOB"];

    echo "<br><br>";

    
    if (!empty($doclist["email"]))
    {
        echo "E-mail : ";
        echo $doclist["email"];
        echo "<br>";
    }
    
    if (!empty($doclist["ph_no"]))
    {
        echo "Ph. No. : ";
        echo $doclist["ph_no"];
        echo "<br>";
    }

    if (!empty($doclist["publications"]))
    {
        echo "Publications : ";
        echo $doclist["publications"];
        echo "<br>";
    }

    if (!empty($doclist["grants"]))
    {
        echo "Grants : ";
        echo $doclist["grants"];
        echo "<br>";
    }

    if (!empty($doclist["biography"]))
    {
        echo "Bio : ";
        echo $doclist["biography"];
        echo "<br>";
    }

    echo "<br>";
    echo '<a href="http://localhost/phpmongodb/UsersList.php">See Other Users info</a>';
    echo "<br>";
    echo '<a href="http://localhost/phpmongodb/UpdatePortal.php">Update your info</a>';
    echo "<br>";

}

?>
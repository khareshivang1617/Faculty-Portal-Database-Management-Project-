<html>
<body>

<h1>Create New Account</h1>
<form action="CreateAccount.php" method="post">
<b>First Name : <b> <input type="text" name="firstname"><br>
<b>Second Name : <b> <input type="text" name="secondname"><br>
<b>DOB(DD/MM/YY) : <b> <input type="text" name="dob"><br>
<b>Username : <b> <input type="text" name="username"><br>
<b>Password : <b> <input type="password" name="password"><br>
<br>
<input type="submit" name="Submit"><br>
</form>

</body>
</html>

<?php

if (isset($_POST["firstname"]))
    $first_name=$_POST["firstname"];

if(isset($_POST["secondname"]))
    $second_name=$_POST["secondname"];

if (isset($_POST["dob"]))
    $DOB=$_POST["dob"];

if (isset($_POST["username"]))
    $user_name=$_POST["username"];

if (isset($_POST["password"]))
    $pass_word=$_POST["password"];

require 'vendor/autoload.php';
$client = new MongoDB\Client;
$database = $client->faculty;
$collection = $database->faculty;


if (empty($first_name) || empty($user_name) || empty($pass_word) || empty($DOB))
{
    echo "NOTE : All fields except Second Name are mandatory!!! <br>";
    echo '<a href="http://localhost/phpmongodb/CreateAccount.php">Re-try</a>';
    echo "<br>";
    echo '<a href="http://localhost/phpmongodb/Homepage.php">Home</a>';
}

else 
{
    $doclist = $collection->findOne(
        ['Username' => $user_name]
    );

    if (empty($doclist))
    {
        session_start();
        $_SESSION["uname"]=$user_name;
        $_SESSION["pass"]=$pass_word;    

        $insertAcc = $collection->insertOne([
        'firstname' => $first_name,
        'secondname' => $second_name,
        'DOB' => $DOB,
        'Username' => $user_name,
        'Password' => $pass_word
        ]);

        echo "Account created successfully!!!<br>";
        echo '<a href="http://localhost/phpmongodb/GetNewAccDetailsPage1.php">Click</a>'; 
        echo " here to enter the rest of your details!!!<br>";
        echo "<br>";
        echo '<a href="http://localhost/phpmongodb/LoginPortal.php">Re-Login</a>'; 
        echo "<br>";
        echo '<a href="http://localhost/phpmongodb/Homepage.php">Home</a>';
        echo "<br>";
        }

        
    else
    {
        echo "Username already exists!!! <br>";
        echo '<a href="http://localhost/phpmongodb/CreateAccount.php">Re-try</a>';
        echo "<br>";
    }
}


?>
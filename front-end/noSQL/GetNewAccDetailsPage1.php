<html>
<body>

<h1>Enter Your Details</h1>
<form action="GetNewAccDetailsPage1.php" method="post">
<b>E-mail : <b> <input type="text" name="email"><br>
<b>Ph. No. : <b> <input type="text" name="ph_no"><br>
<b>Publications : <b> <input type="text" name="pub"><br>
<b>Grants : <b> <input type="text" name="grants"><br>
<b>Biography : <b> <input type="text" name="bio"><br>
<br>
<input type="submit" name="submit">
</form>

</body>
</html>


<?php

if (isset($_POST["email"]))
    $email=$_POST["email"];

if (isset($_POST["ph_no"]))
    $ph_no=$_POST["ph_no"];

if (isset($_POST["pub"]))
    $pub=$_POST["pub"];

if (isset($_POST["grants"]))
    $grants=$_POST["grants"];

if (isset($_POST["bio"]))
    $bio=$_POST["bio"];

session_start();

if (isset($_SESSION["uname"]) && isset($_SESSION["pass"]))
{
    $user_name=$_SESSION["uname"];
    $pass_word=$_SESSION["pass"];
}

else
{
    echo "<br>Session Expired!! <br>";
}

require 'vendor/autoload.php';
$client = new MongoDB\Client;
$database = $client->faculty;
$collection = $database->faculty;

if (!empty($email))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['email' => $email]]
    );
}

if (!empty($ph_no))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['ph_no' => $ph_no]]
    );
}

if (!empty($pub))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['publications' => $pub]]
    );
}

if (!empty($grants))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['grants' => $grants]]
    );
}

if (!empty($bio))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['biography' => $bio]]
    );
}

echo "Account Details Updated Successfully!!! <br>";
echo '<a href="http://localhost/phpmongodb/Homepage.php">Home</a>';

///session_destroy();

?>
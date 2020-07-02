<?php

session_start();

if (isset($_SESSION["uname"]) && isset($_SESSION["pass"]))
{
    $user_name=$_SESSION["uname"];
    $pass_word=$_SESSION["pass"];
}

else
{
    echo "ERROR!!!<br>";
    echo '<a href="http://localhost/phpmongodb/LoginPortal.php">Re-Login</a>';
}

require 'vendor/autoload.php';
$client = new MongoDB\Client;
$database = $client->faculty;
$collection = $database->faculty;

$doclist = $collection->findOne(
    ['Username' => $user_name, 'Password' => $pass_word]
);

if (isset($_POST['new_username']))
        $new_user_name=$_POST["new_username"];

if (isset($_POST['new_password']))
    $new_pass_word=$_POST["new_password"];

if (isset($_POST['new_firstname']))
    $new_first_name=$_POST["new_firstname"];
    
if (isset($_POST['new_secondname']))
    $new_second_name=$_POST["new_secondname"];
    
if (isset($_POST['new_dob']))
    $new_dob=$_POST["new_dob"];

if (!empty($new_user_name))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['Username' => $new_user_name]]
    );

    echo "Username Updated SUccessfully!!! <br>";
}

if (!empty($new_pass_word))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['Password' => $new_pass_word]]
    );

    echo "Password Updated SUccessfully!!! <br>";
}

if (!empty($new_first_name))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['firstname' => $new_first_name]]
      );

    echo "First Name Updated SUccessfully!!! <br>";
}

if (!empty($new_second_name))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['secondname' => $new_second_name]]
    );

    echo "Second Name Updated SUccessfully!!! <br>";
}

if (!empty($new_dob))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['DOB' => $new_dob]]
    );

    echo "DOB Updated SUccessfully!!! <br>";
}

if (isset($_POST["new_email"]))
    $email=$_POST["new_email"];

if (isset($_POST["new_ph_no"]))
    $ph_no=$_POST["new_ph_no"];

if (isset($_POST["new_pub"]))
    $pub=$_POST["new_pub"];

if (isset($_POST["new_grants"]))
    $grants=$_POST["new_grants"];

if (isset($_POST["new_bio"]))
    $bio=$_POST["new_bio"];

if (!empty($email))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['email' => $email]]
    );

    echo "Email updated successfully!!! <br>";
}

if (!empty($ph_no))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['ph_no' => $ph_no]]
    );

    echo "Ph. No. updated successfully!!! <br>";
}

if (!empty($pub))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['publications' => $pub]]
    );

    echo "Publications updated successfully!!! <br>";
}

if (!empty($grants))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['grants' => $grants]]
    );

    echo "Grants updated successfully!!! <br>";
}

if (!empty($bio))
{   
    $update_res=$collection->updateOne(
        ['Username' => $user_name, 'Password' => $pass_word],
        ['$set' => ['biography' => $bio]]
    );

    echo "Bio updated successfully!!! <br>";
}

session_destroy();

echo '<a href="http://localhost/phpmongodb/HomePage.php">Home</a>'


?>
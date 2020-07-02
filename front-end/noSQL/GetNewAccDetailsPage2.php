<html>
<body>

<h1>Create New Account</h1>
<form action="GetNewAccDetailsPage2.php" method="post">
<b>First Name : <b> <input type="text" name="firstname"><br>
<b>Second Name : <b> <input type="text" name="secondname"><br>
<b>DOB(DD/MM/YY) : <b> <input type="text" name="dob"><br>
<b>Username : <b> <input type="text" name="username"><br>
<b>Password : <b> <input type="password" name="password"><br>
<br>
<input type="submit">
</form>

</body>
</html>

<?

session_start();
$_SESSION["uname"]=$user_name;
$_SESSION["pass"]=$pass_word;

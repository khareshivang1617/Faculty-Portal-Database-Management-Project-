<?php

session_start();
$fac_id=$_SESSION["fac_id"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql="SELECT l.application_id, f1.first_name, f1.last_name,l.sender_id, l.comments FROM leave_pending AS l, faculty AS f1, faculty AS f2 WHERE 	l.sender_id = f1.id and l.current_holder_id = f2.id and l.current_holder_id = '$fac_id' ;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "Leaves pending at your level : <br> ";

while ($row)
{
    echo "Name : ";
    echo $row['first_name'];
    echo " ";
    echo $row['last_name'];
    echo " ; SenderId : ";
    echo $row['sender_id'];
    echo " ; Comments so far : ".$row["comments"];
    echo "<br>";
    $row=pg_fetch_array($res);
}

?>

<html>
<body>

<h1>Enter a faculty ID to take action on</h1>
<form action="TakeActionOnLeave.php" method="post">
<b>Sender ID : <b> <input type="integer" name="sender_id">
<b>Comments (if required) : <b> <input type="text" name="comments">
<br>
<input type="submit" value="submit">
</form>

</body>
</html>

<?php

echo"<br>";

echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>';
echo "<button><a href ='logout.php'>Logout</a></button><br>"; 

?>
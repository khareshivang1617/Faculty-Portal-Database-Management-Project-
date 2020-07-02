<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

//show depts;

$sql="SELECT * FROM department;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

while ($row)
{
    echo "Department Name : ";
    echo $row['department_name'];
    echo "<br>"; 
    $row=pg_fetch_array($res);
}

echo "<br><br>";

?>

<html>
<body>

<h1>Select from the above departments</h1>
<form action="FacIdForChangeHOD.php" method="post">
<b>Department Name : <b> <input type="text" name="department">
<br>
<input type="submit">
</form>

</body>
</html>
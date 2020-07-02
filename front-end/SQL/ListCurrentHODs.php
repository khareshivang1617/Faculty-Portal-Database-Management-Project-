<html>
<head>
<style>
table

{
border-style:solid;
border-width:2px;
border-color:white;
}

</style>
</head>
<body bgcolor="#EEFDEF">

<?php

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql="SELECT f.id, f.first_name, f.last_name, d.department_name FROM faculty AS f, department AS d WHERE f.id = d.hod_id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "Current HODs : <br>";

echo "<table border='1'>


<tr>
<th> ID </th>
<th>Name</th>
<th>Department</th>
</tr>";


while ($row)
{

    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] ." ".   $row['last_name'] ."</td>";
    echo "<td>" . $row['department_name'] . "</td>";
    echo "</tr>";

    $row=pg_fetch_array($res);
}

echo "<br><br>";
echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>';
?>

</body>
</html>
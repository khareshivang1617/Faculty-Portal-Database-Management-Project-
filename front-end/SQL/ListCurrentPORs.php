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

$sql="SELECT f.id, f.first_name, f.last_name, c.designation, c.remaining_leaves FROM faculty AS f, cross_cutting_faculty_details AS c WHERE f.id = c.faculty_id AND c.designation IS NOT NULL;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "Current PORs : <br>";

echo "<table border='1'>

<tr>
<th> ID </th>
<th>Name</th>
<th>Designation</th>
</tr>";

while ($row)
{
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] ." ".   $row['last_name'] ."</td>";
    echo "<td>" . $row['designation'] . "</td>";
    echo "</tr>";

    $row=pg_fetch_array($res);
}

echo "<br><br>";
echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>';

?>

</body>
</html>
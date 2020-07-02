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

$sql="SELECT DISTINCT f.id, f.first_name, f.last_name, d.department_name, hp.start_date, hp.end_date FROM faculty AS f, department AS d, hod_appointments AS hp WHERE f.id = d.hod_id AND d.hod_id = hp.faculty_id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "HOD Logs : <br>";

echo "<table border='1'>

<tr>
<th> ID </th>
<th>Name</th>
<th>Department</th>
<th>From-To</th>

</tr>";

while ($row)
{

    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] ." ".   $row['last_name'] ."</td>";
    echo "<td>" . $row['department_name'] . "</td>";

    if ($row['end_date'])
        echo "<td>" . $row['start_date'] . " - ".$row['end_date'] . "</td>";   

    else
        echo "<td>" . $row['start_date'] . " - CURRENT" . "</td>";   


    $row=pg_fetch_array($res);
}
echo "<br><br>";
echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>';

?>

</body>
</html>
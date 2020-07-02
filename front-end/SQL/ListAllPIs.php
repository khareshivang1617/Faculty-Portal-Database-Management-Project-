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

echo "<table border='1'>

<tr>
<th>Project ID </th>
<th>Project Name</th>
<th>Starting Date</th>
<th>Ending Date</th>
<th>Main PI's ID</th>
<th>Name</th>
<th>Gender</th>

</tr>";

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql="SELECT * FROM project AS p, faculty AS f WHERE p.main_pi_id=f.id";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

while ($row)
{
    echo "<tr>";
    echo "<td>" . $row['project_id'] . "</td>";
    echo "<td>" . $row['project_name'] . "</td>";
    echo "<td>" . $row['starting_date'] . "</td>";

    if ($row['ending_date'])
        echo "<td>" . $row['ending_date'] . "</td>";

    else
    echo "<td>" . "CURRENT" . "</td>";

    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";

    $row=pg_fetch_array($res);

    echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a></button> ';
}


?>


</body>
</html>
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

$sql="select pt.application_id, pt.date_of_leave1,pt.date_of_leave2, pt.action_taker_id, f.first_name, f.last_name, pt.action_taker_designation,pt.action, pt.comments, pt.date_of_action from paper_trail as pt, faculty as f where pt.action_taker_id = f.id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "<table border='1'>

<tr>
<th>Application ID</th>
<th>From Date</th>
<th>To Date</th>
<th>Faculty ID </th>
<th>Name</th>
<th>Designation</th>
<th>Action</th>
<th>Comments</th>
<th>Date of Action</th>
</tr>";

while ($row)
{
    echo "<tr>";
    echo "<td>" . $row['application_id'] . "</td>";
    echo "<td>" . $row['date_of_leave1'] . "</td>";
    echo "<td>" . $row['date_of_leave2'] . "</td>";
    echo "<td>" . $row['action_taker_id'] . "</td>";
    echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
    echo "<td>" . $row['action_taker_designation']. "</td>";
    echo "<td>" . $row['action'] . "</td>";
    echo "<td>" . $row['comments'] . "</td>";
    echo "<td>" . $row['date_of_action'] . "</td>";

    $row=pg_fetch_array($res);   
}

echo '<button><a href="http://localhost/LeavePortal/AdminsPage.php">Go Back</a>';

?>


</body>
</html>
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

$sql="SELECT p.project_id, p.project_name, b.budget_type, b.budget_amount FROM budget AS b, project AS p WHERE p.project_id = b.project_id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "<table border='1'>

<tr>
<th>Project ID </th>
<th>Project Name</th>
<th>Budget Type</th>
<th>Amount</th>

</tr>";

echo "<br><br><b> Details Regarding Budgets : </b><br>"; 

while($row)
{
    echo "<tr>";
    echo "<td>" . $row['project_id'] . "</td>";
    echo "<td>" . $row['project_name'] . "</td>";
    echo "<td>" . $row['budget_type'] . "</td>";
    echo "<td>" . $row['budget_amount'] . "</td>";
    //echo "Project ID : ".$row["project_id"]." ; Project Name : ".$row["project_name"]." ; Budget Type : ".$row["budget_type"]." ; Budget Amount : ".$row["budget_amount"]."<br>";
    $row=pg_fetch_array($res);
}

echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a></button> ';
//echo "<br><br>";

?>


</body>
</html>
<html>
<body>

<h1>Type the project name</h1>
<form action="CreateNewProject.php" method="post">
<b>Type a Project Name : <b> <input type="text" name="project_name">
<br>
<input type="submit" value="submit">
</form>

</body>
</html>

<?php

if (isset($_POST["project_name"]))
{
    session_start();
    $fac_id=$_SESSION["fac_id"];

    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    $project_name=$_POST["project_name"];

    $sql_insert="SELECT start_project('$fac_id','$project_name');";
    $res_insert=pg_query($db_connection,$sql_insert);

    echo "Project Created Successfully!!! <br>";
}

echo '<button><a href="http://localhost/LeavePortal/GetLoginDetails.php">Go Back</a>'; 
?>
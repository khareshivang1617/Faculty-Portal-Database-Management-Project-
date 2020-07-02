<html>
<body>

<h1>Type the project name</h1>
<form action="AllotPIToProject.php" method="post">
<b> Project Id : <b> <input type="integer" name="project_id">
<b> Faculty Id : <b> <input type ="integer" name="allot_fac_id"> 
<br>
<input type="submit" value="submit">
</form>

</body>
</html>

<?php


if (isset($_POST["project_id"]) && isset($_POST["allot_fac_id"]))
{

    session_start();
    $fac_id=$_SESSION["fac_id"];

    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    $project_id=$_POST["project_id"];
    $allot_fac_id=$_POST["allot_fac_id"];

    $sql="SELECT * FROM project WHERE project_id='$project_id';";
    $res=pg_query($db_connection,$sql);
    $row=pg_fetch_array($res);

    $sql_check_no="SELECT count(*) AS c FROM normal_pi WHERE project_id=$project_id";
    $res_check_no=pg_query($db_connection,$sql_check_no);
    $row_check_no=pg_fetch_array($res_check_no);

    if ($row['main_pi_id']===$fac_id && $row_check_no['c']<=2)
    {
        $sql_allotPI="SELECT make_normal_pi('$allot_fac_id','$project_id');";
        $res=pg_query($db_connection,$sql_allotPI);
        echo "Process Done!!! <br>";
    }

    else if ($row_check_no['c']>2)
    {
        echo "You can't make more PIs!! <br>";
    }

    else
    {
        echo "You don't have this privilage!!! <br>";
    }

    echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a>';
                
}
?>

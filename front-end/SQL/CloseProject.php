<?php
    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    session_start();
    $proj_id=$_SESSION["project_id"];
    $fac_id=$_SESSION["fac_id"];

    $sql_main="SELECT * FROM project WHERE project_id='$proj_id';";
    $res_main=pg_query($db_connection,$sql_main);
    $row_main=pg_fetch_array($res_main);

    if ($row_main['main_pi_id']===$fac_id)
    {
        $sql_close="SELECT close_project('$proj_id');";
        $res_close=pg_query($db_connection,$sql_close);
        
        if ($res_close)
            echo "Project Closed Successfully!!! <br>";
    }


    
echo '<button><a href="http://localhost/LeavePortal/ListAllYourApprovedExp.php">Go Back</a>';
?>
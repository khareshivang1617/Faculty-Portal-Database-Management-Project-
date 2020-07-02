<html>
<body>

<h1>Type in the </h1>
<form action="AllotBudgetHead.php" method="post">
<b> Project Id : <b> <input type="integer" name="project_id">
<b> Budget Type : <b> <input type="text" name="budget_type">
<b> Faculty Id (of new head) : <b> <input type ="integer" name="budget_head_id"> 
<br>
<input type="submit" value="submit">
</form>

</body>
</html>

<?php

if (isset($_POST["project_id"]) && isset($_POST["budget_head_id"]) && isset($_POST["budget_type"]))
{

    session_start();
    $fac_id=$_SESSION["fac_id"];

    $project_id=$_POST["project_id"];
    $budget_type=$_POST["budget_type"];
    $budget_head_id=$_POST["budget_head_id"];

    
    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    $sql_check_project="SELECT * FROM project WHERE project_id='$project_id';";
    $res_check_project=pg_query($db_connection,$sql_check_project);
    $row_check_project=pg_fetch_array($res_check_project);

    if ($row_check_project['main_pi_id']!=$fac_id)
    {
        echo "You don't have this privilage!!! <br>";
    }

    else
    {
        $sql_assign="SELECT make_budget_head('$project_id','$budget_type',$budget_head_id);";
        $res_assign=pg_query($db_connection,$sql_assign);
        echo "Budget Head Assigned Successfully!!! <br>";
    }

}

echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a>';
?>
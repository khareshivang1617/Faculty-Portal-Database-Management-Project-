<html>
<body>

<h1>Allot Budget </h1>
<form action="AllotBudgetToProject.php" method="post">
<b> Project Id : <b> <input type="integer" name="project_id">
<b> Budget Type : <b> <input type="text" name="budget_type">
<b> Amount : <b> <input type ="integer" name="amount"> 
<br>
<input type="submit" value="submit">
</form>

</body>
</html>


<?php

if (isset($_POST["amount"]) && isset($_POST["budget_type"]) && isset($_POST["amount"]))
{
    $project_id=$_POST["project_id"];

    $budget_type=$_POST["budget_type"];

    $amount=$_POST["amount"];

session_start();
$fac_id=$_SESSION["fac_id"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

$sql_check_tuple="SELECT * FROM  budget WHERE budget_type='$budget_type' AND project_id=$project_id;";
$res_check_tuple=pg_query($db_connection,$sql_check_tuple);
$row_check_tuple=pg_fetch_array($res_check_tuple);


//check if the tuple exists on the given budget_type, if not : a link to create budget type and head
//also check if the project on which he's trying to allot budget belongs to him only!!!
$sql_check_project="SELECT * FROM project WHERE project_id='$project_id';";
$res_check_project=pg_query($db_connection,$sql_check_project);
$row_check_project=pg_fetch_array($res_check_project);
//$sql_check="SELECT * FROM ";

if ($row_check_project['main_pi_id']!=$fac_id)
{
    echo "You don't have this privilage!!! <br>";
}

else if (empty($row_check_tuple))
{
    echo "first make a budget head!!! <br>";
    echo '<button><a href="http://localhost/LeavePortal/AllotBudgetHead.php">Allot Budget Head</a>';
               
    ///page to allot budget head
}

else
{   
    echo $row_check_tuple['project_id']." : ".$row_check_tuple['budget_type']." : ".$row_check_tuple['budget_amount']."<br>";
    $sql_add_budget="SELECT allot_budget('$project_id','$budget_type','$amount');";
    $res_add_budget=pg_query($db_connection,$sql_add_budget);
    echo "Budget addeded successfullty!!! <br>";
}
}

echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a>';
               

?>


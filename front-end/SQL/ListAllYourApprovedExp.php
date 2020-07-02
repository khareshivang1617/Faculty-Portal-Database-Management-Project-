<?php
////show all project of fac pi or main-pi

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

session_start();
$fac_id=$_SESSION["fac_id"];
$designation=$_SESSION["designation"];

//A query to display your current projects in which you are involved

$sql="SELECT project_id, project_name, starting_date FROM project WHERE main_pi_id = $fac_id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "Projects Which you are a PI of : <br>";

while ($row)
{
    ?>
    <tr>
        <td><?php echo $row['project_id']; ?></td> 
        <td><?php echo $row['project_name']; ?></td>
        <td><?php echo $row['starting_date']; ?></td>   
    </tr>
    <?php
    echo"<br>"; 
    $row=pg_fetch_array($res);    
}

$sql="SELECT p.project_id, p.project_name, p.starting_date FROM project AS p, normal_pi AS n WHERE p.project_id = n.project_id AND n.pi_id = $fac_id;";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "Projects Which you are a co-PI of : <br>";

while ($row)
{
    ?>
    <tr>
        <td><?php echo $row['project_id']; ?></td> 
        <td><?php echo $row['project_name']; ?></td>
        <td><?php echo $row['starting_date']; ?></td>   
    </tr>
    <?php
    echo"<br>"; 
    $row=pg_fetch_array($res);    
}

$sql="( SELECT DISTINCT p.project_id, p.project_name, p.starting_date, p.ending_date FROM project AS p, normal_pi AS n WHERE n.project_id = p.project_id AND p.ending_date IS NOT NULL AND n.pi_id = $fac_id )  UNION (SELECT project_id, project_name, starting_date, ending_date FROM project WHERE ending_date IS NOT NULL AND main_pi_id = $fac_id);";
$res=pg_query($db_connection,$sql);
$row=pg_fetch_array($res);

echo "<br><br> The Projects that you have completed : <br>";

while ($row)
{
    echo "Project Id : ".$row["project_id"]." ; Name : ".$row["project_name"]." ; (".$row["starting_date"].$row["ending_date"].")<br>";
    $row=pg_fetch_array($res);
}
?>

<html>
<body>

<h1>Type in the Request ID to take action</h1>
<form action="ListAllYourApprovedExp.php" method="post">
<b> Project ID : <b> <input type="integer" name="project_id">
<br>
<input type="submit" value="submit">
</form>

</body>
</html>
<?php

if (isset($_POST["project_id"]))
{
    echo "<br>";
    $db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

    
    $proj_id=$_POST["project_id"];


    $sql_main="SELECT * FROM project WHERE project_id='$proj_id';";
    $res_main=pg_query($db_connection,$sql_main);
    $row_main=pg_fetch_array($res_main);

    if ($row_main['main_pi_id']===$fac_id)
    {
 
        $sql_exp="SELECT request_id, expenditure_type, cost_per_unit, num_of_units FROM expenditure WHERE project_id = '$proj_id'; ";
        $res_exp=pg_query($db_connection,$sql_exp);
        $row_exp=pg_fetch_array($res_exp);
        
        echo "<br><br>Expenditure Details : <br>";

        while ($row_exp)
        {
            echo "Req ID : ".$row_exp["request_id"]." ; Expenditure Type : ".$row_exp["expenditure_type"]." ; CPU : ".$row_exp["cost_per_unit"]." ; No. of Units : ".$row_exp["num_of_units"]."<br>";
            $row_exp=pg_fetch_array($res_exp);
        }

        $sql_budget="SELECT b.budget_type, b.budget_amount, f.first_name, f.last_name FROM budget AS b, faculty AS f WHERE f.id = b.budget_head_id AND b.project_id = '$proj_id';";
        $res_budget=pg_query($db_connection,$sql_budget);
        $row_budget=pg_fetch_array($res_budget);

        echo "<br><br>Budget Details : <br>"; 

        while ($row_budget)
        {
            echo "Budget Type : ".$row_budget["budget_type"]." ; Amount : \t".$row_budget["budget_amount"]." ; Budget Head : ".$row_budget["first_name"]."\t".$row_budget["last_name"]."<br>";
            $row_budget=pg_fetch_array($res_budget);
        }

        $sql_pis="SELECT f.id,f.first_name, f.last_name FROM faculty AS f, normal_pi AS n WHERE n.pi_id = f.id AND n.project_id = '$proj_id';";
        $res_pis=pg_query($db_connection,$sql_pis);
        $row_pis=pg_fetch_array($res_pis);

        echo "<br><br> Co-PIs of the respective projects are : <br>";
        while($row_pis)
        {
            echo $row_pis["id"]." : ".$row_pis["first_name"]." ".$row_pis["last_name"]."<br>";
            $row_pis=pg_fetch_array($res_pis);
        }

        $_SESSION["project_id"]=$proj_id;
        echo '<a href="http://localhost/LeavePortal/CloseProject.php">Close this project</a>';
    }

    else 
        echo "You're not the main PI of this project!!! <br>";
}

else 
    echo "Enter Project ID!!! <br>";
?>
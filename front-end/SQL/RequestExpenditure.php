<html>
<body>

<h1>Request Expenditure</h1>
<form action="RequestExpenditure.php" method="post">
<b> Project Id : <b> <input type="integer" name="project_id">
<b> Expenditure Type : <b> <input type="text" name="exp_type">
<b> Cost per unit : <b> <input type="integer" name="cost_per_unit">
<b> Number of units : <b> <input type="integer" name="num_of_units">
<b> Comments : <b> <input type="text" name="comments">
<br>
<input type="submit" value="submit">
</form>

</body>
</html>

<?php

echo '<button><a href="http://localhost/LeavePortal/ProjectPage.php">Go Back</a></button>';
echo "<br>";


session_start();
$fac_id=$_SESSION["fac_id"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");


if (isset($_POST["project_id"]) && isset($_POST["exp_type"]) && isset($_POST["cost_per_unit"]) && isset($_POST["num_of_units"]) && isset($_POST["comments"]))
{

    $project_id=$_POST["project_id"];
    $exp_type=$_POST["exp_type"];
    $cost_per_unit=$_POST["cost_per_unit"];
    $num_of_units=$_POST["num_of_units"];
    $comments=$_POST["comments"];


    $sql_main="SELECT * FROM project WHERE project_id='$project_id';";
    $res_main=pg_query($db_connection,$sql_main);
    $row_main=pg_fetch_array($res_main);

    $sql_co="SELECT * FROM normal_pi WHERE project_id='$project_id';";
    $res_co=pg_query($db_connection,$sql_co);
    $row_co=pg_fetch_array($res_co);

    if ($row_main['main_pi_id']===$fac_id || $row_co['pi_id']===$fac_id)
    {
        $sql_req_exp="SELECT request_expenditure('$project_id','$fac_id','$exp_type',$cost_per_unit,$num_of_units,'$comments');";
        $res_req_exp=pg_query($db_connection,$sql_req_exp);
        echo"Done!!! <br>";
    }
    else
    {
        echo "That's not your project ID!!! <br>";
    }

}
//////////////////////////////////////////////////////////////////////////////////////

$sql1="SELECT project_id, project_name, starting_date, ending_date FROM project WHERE main_pi_id = $fac_id;";
$sql2="SELECT p.project_id, p.project_name, p.starting_date FROM project AS p, normal_pi AS n WHERE p.project_id = n.project_id AND n.pi_id = $fac_id;";

$res1=pg_query($db_connection,$sql1);
$row1=pg_fetch_array($res1);


echo "<table border='1'>

<tr>
<th>Project ID </th>
<th>Project Name</th>
<th>Starting Date</th>
<th>Ending Date</th>
<th>Main PI</th>
<th>Co-PI(1)</th>
<th>Co-PI(2)</th>
<th>Co-PI(3)</th>

</tr>";

echo "<br><br><b>Projects Which you are a Main-PI of : </b>";
while ($row1)
{

    echo "<tr>";
    echo "<td>" . $row1['project_id'] . "</td>";
    echo "<td>" . $row1['project_name'] . "</td>";
    echo "<td>" . $row1['starting_date'] . "</td>";

    if ($row1['ending_date'])
        echo "<td>" . $row1['ending_date'] . "</td>";

    else
    echo "<td>" . "CURRENT" . "</td>";

    $project_id=$row1['project_id'];
    
    $sql_co_pi="select n.pi_id, f.first_name, f.last_name FROM normal_pi AS n, faculty AS f WHERE n.pi_id = f.id AND n.project_id = $project_id;";
    $res_co_pi=pg_query($db_connection,$sql_co_pi);
    $row_co_pi=pg_fetch_array($res_co_pi);

    $sql_main_pi="select p.main_pi_id, f.first_name, f.last_name FROM project AS p, faculty as f WHERE f.id = p.main_pi_id and p.project_id = $project_id;";
    $res_main_pi=pg_query($db_connection,$sql_main_pi);
    $row_main_pi=pg_fetch_array($res_main_pi);

    //echo "<br>Main PI : ".$row_main_pi["main_pi_id"]." : ".$row_main_pi["first_name"]." ".$row_main_pi["last_name"]."<br>";
    
    echo "<td>" . $row_main_pi['main_pi_id'] . "</td>";


    while ($row_co_pi)
    {  
        echo "<td>(".$row_co_pi["pi_id"].") ".$row_co_pi["first_name"]." ".$row_co_pi["last_name"]."</td>";
        $row_co_pi=pg_fetch_array($res_co_pi);
    }




    echo"<br><br>"; 
    $row1=pg_fetch_array($res1);    
}

$sql2="SELECT p.project_id, p.project_name, p.starting_date,p.ending_date FROM project AS p, normal_pi AS n WHERE p.project_id = n.project_id AND n.pi_id = $fac_id;";
$res2=pg_query($db_connection,$sql2);
$row2=pg_fetch_array($res2);


echo "<table border='1'>

<tr>
<th>Project ID </th>
<th>Project Name</th>
<th>Starting Date</th>
<th>Ending Date</th>
<th>Main PI</th>
<th>Co-PI(1)</th>
<th>Co-PI(2)</th>
<th>Co-PI(3)</th>

</tr>";

echo "<br><br><b>Projects Which you are a co-PI of : </b>";

while ($row2)
{   
    echo "<tr>";
    echo "<td>" . $row2['project_id'] . "</td>";
    echo "<td>" . $row2['project_name'] . "</td>";
    echo "<td>" . $row2['starting_date'] . "</td>";

    if ($row2['ending_date'])
        echo "<td>" . $row2['ending_date'] . "</td>";

    else
    echo "<td>" . "CURRENT" . "</td>";
    $project_id=$row2['project_id'];
   
    $sql_co_pi="SELECT n.pi_id, f.first_name, f.last_name FROM normal_pi AS n, faculty AS f WHERE n.pi_id = f.id AND n.project_id = $project_id;";
    $res_co_pi=pg_query($db_connection,$sql_co_pi);
    $row_co_pi=pg_fetch_array($res_co_pi);

    $sql_main_pi="select p.main_pi_id, f.first_name, f.last_name FROM project AS p, faculty as f WHERE f.id = p.main_pi_id and p.project_id = $project_id;";
    $res_main_pi=pg_query($db_connection,$sql_main_pi);
    $row_main_pi=pg_fetch_array($res_main_pi);

    //echo "Main PI : ".$row_main_pi["main_pi_id"]." : ".$row_main_pi["first_name"]." ".$row_main_pi["last_name"]."<br>";
    echo "<td>" . $row_main_pi['main_pi_id'] . "</td>";
    
    while ($row_co_pi)
    {
        echo "<td>(".$row_co_pi["pi_id"].") ".$row_co_pi["first_name"]." ".$row_co_pi["last_name"]."</td>";
        $row_co_pi=pg_fetch_array($res_co_pi);
    }

    //echo"<br><br>"; 
    $row2=pg_fetch_array($res2);    

}


?>
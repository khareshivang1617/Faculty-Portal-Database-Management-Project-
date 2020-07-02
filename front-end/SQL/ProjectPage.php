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

echo '<button><a href="http://localhost/LeavePortal/ListAllProjects.php">All Projects</a></button> <br>';


$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

session_start();
$fac_id=$_SESSION["fac_id"];
$designation=$_SESSION["designation"];

$sql_details="SELECT * FROM faculty WHERE id=$fac_id;";
$res_details=pg_query($db_connection,$sql_details);
$row_details=pg_fetch_array($res_details);

echo "<br><b>Personal Info : </b><br>";
echo "<br>Faculty ID : ".$row_details['id']."<br>Name : ".$row_details['first_name']." ".$row_details['last_name']."<br>Designation : ".$designation."<br><br>";

//A query to display your current projects in which you are involved

$sql1="SELECT project_id, project_name, starting_date, ending_date FROM project WHERE main_pi_id = $fac_id;";
$sql2="SELECT p.project_id, p.project_name, p.starting_date FROM project AS p, normal_pi AS n WHERE p.project_id = n.project_id AND n.pi_id = $fac_id;";

$res11=pg_query($db_connection,$sql1);
$res22=pg_query($db_connection,$sql2);
$row2=pg_fetch_array($res22);
$row1=pg_fetch_array($res11);

if ($row1 || $row2)
{
    echo '<button><a href="http://localhost/LeavePortal/AllotBudgetToProject.php">Allot Budget</a></button> ';
    echo '<button><a href="http://localhost/LeavePortal/AllotPIToProject.php">Allot PI</a></button> ';
    echo '<button><a href="http://localhost/LeavePortal/AllotBudgetHead.php">Allot/Change Budget Head</a></button> ';
    echo '<button><a href="http://localhost/LeavePortal/RequestExpenditure.php">Request Expenditure</a></button> ';
    echo '<button><a href="http://localhost/LeavePortal/ListAllYourApprovedExp.php">To see more details of project OR Close it</a></button>';
}

echo "<br><br>";
echo '<button><a href="http://localhost/LeavePortal/CreateNewProject.php">Create New Project</a></button> ';
echo '<button><a href="http://localhost/LeavePortal/ExpReqAtLevel.php">Reuqests Pending at your level</a></button> ';
echo '<button><a href="http://localhost/LeavePortal/ShowReqStatus.php">To see status of Requests</a></button> ';  
echo '<button><a href="http://localhost/LeavePortal/ListCurrentFaculties.php">Current Faculty Details</a></button>';      


    $res1=pg_query($db_connection,$sql1);
    $row1=pg_fetch_array($res1);



echo "<br><br>";
echo '<a href="http://localhost/LeavePortal/ListAllPIs.php">List All Main-PIs</a>';
echo "<br>";
echo '<a href="http://localhost/LeavePortal/ListAllCoPIs.php">List All CO-PIs</a>';
echo "<br>";
echo '<a href="http://localhost/LeavePortal/AllBudgetDetails.php">All Budget Details</a>';
echo "<br>";
echo '<a href="http://localhost/LeavePortal/AllExpDetails.php">All Expenditure Details</a>';

echo "<br><br>";
echo "<button><a href ='logout.php'>Logout</a></button><br> "; 

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
    
    echo "<td>" . "(". $row_main_pi['main_pi_id'] .") " . $row_main_pi['first_name']." " .$row_main_pi['last_name']. "</td>";



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
    echo "<td>" . "(". $row_main_pi['main_pi_id'] .") " . $row_main_pi['first_name']." " .$row_main_pi['last_name']. "</td>";

    while ($row_co_pi)
    {
        echo "<td>(".$row_co_pi["pi_id"].") ".$row_co_pi["first_name"]." ".$row_co_pi["last_name"]."</td>";
        $row_co_pi=pg_fetch_array($res_co_pi);
    }

    //echo"<br><br>"; 
    $row2=pg_fetch_array($res2);    

}





//echo "<br><br>";







//echo


?>

</body>
</html>
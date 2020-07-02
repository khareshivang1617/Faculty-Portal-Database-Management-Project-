<?php

$first_name=$_POST["first_name"];
$last_name=$_POST["last_name"];
$gender=$_POST["gender"];
$desig=$_POST["designation"];
$user_name=$_POST["username"];
$pass_word=$_POST["password"];

$db_connection = pg_connect("host=localhost dbname=leave_db user=postgres password=1109");

date_default_timezone_set('Asia/Kolkata');
$date = date('d/m/Y', time());

$sql_check1="SELECT * FROM normal_faculty_details WHERE login_name='$user_name'";
$res_check1=pg_query($db_connection,$sql_check1);
$check1=pg_fetch_array($res_check1);

$sql_check2="SELECT * FROM cross_cutting_faculty_details WHERE login_name='$user_name'";
$res_check2=pg_query($db_connection,$sql_check2);
$check2=pg_fetch_array($res_check2);

if (!empty($check1) || !empty($check2))
{
    echo "Username already exists, try a different username!!! <br>";
    echo '<a href="http://localhost/LeavePortal/RegisterCrossCuttingFaculty.php">Try Again</a>';
}
else
{
    $sql_insert="SELECT add_faculty_cross_cutting('$first_name','$last_name','$gender','$desig','$user_name','$pass_word')";//functional query
    $res=pg_query($db_connection,$sql_insert);
    echo "Account Created Successfully!!! <br> Now Login Again <br>";
    echo '<a href="http://localhost/LeavePortal/Home.php">Home</a>';

}  

/*$sql_insert="INSERT INTO faculty(first_name,last_name,gender,joining_date) VALUES('$first_name','$last_name','$gender','$date');";
$res=pg_query($db_connection,$sql_insert);

$sql_currID="SELECT id FROM faculty WHERE id >= all(SELECT id FROM faculty)";
$res=pg_query($db_connection,$sql_currID);
$fac_id=pg_fetch_array($res);
$id=$fac_id['id'];
echo $id;

$sql_insert="INSERT INTO cross_cutting_faculty_details(faculty_id,designation,login_name,password_hash,remaining_leaves) VALUES('$id','$designation','$user_name','$pass_word',0);";
$res=pg_query($db_connection,$sql_insert);
*/

/*
Notes : 
1) unable to create a department without an hod
2) Since pending leaves cant be null, I defined it as 0 initially, we can also pass a variable from admin's sie to insert into (define a global variable)...
3) Leaving date is NULL here
*/

?>
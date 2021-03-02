<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Library";

// create connection
$con = mysqli_connect($servername, $username, $password,$dbname);

$resultset=mysqli_query($con,"SELECT * FROM books");
$json_array=array();



while($row=mysqli_fetch_assoc($resultset))
{
    $json_array[]=$row;
}
 echo json_encode($json_array);

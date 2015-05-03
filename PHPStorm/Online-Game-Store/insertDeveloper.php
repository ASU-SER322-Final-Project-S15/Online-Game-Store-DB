<?php
/**
 * Created by PhpStorm.
 * User: Derek 
 * Date: 4/21/2015
 * Time: 4:50 PM
 */


/* GET URL PARAMETERS */
$Name = $_GET["name"];


$servername = "85.10.205.173:3306";
$username = "sergaming";
$password = "sergaming123"; //CHANGE BEFORE COMMITTING AND POSTING TO GITHUB (ITS PUBLIC)
$database = "sergamedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO Developer (name)
VALUES ('" . $Name . "')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>
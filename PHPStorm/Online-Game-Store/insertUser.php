<?php
/**
 * Created by PhpStorm.
 * User: Kole
 * Date: 4/21/2015
 * Time: 4:50 PM
 */


/* GET URL PARAMETERS */
$displayName = $_GET["dName"];
$addr = $_GET["addr"];
$em = $_GET["em"];
$dob = $_GET["dob"];
$name = $_GET["name"];



$servername = "85.10.205.173:3306";
$username = "sergaming";
$password = ""; //CHANGE BEFORE COMMITTING AND POSTING TO GITHUB (ITS PUBLIC)
$database = "sergamedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO User (DisplayName, Address, Email, DOB, Name)
VALUES ('" . $displayName . "','" . $addr . "','" . $em . "','" . $dob . "','" . $name . "')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>
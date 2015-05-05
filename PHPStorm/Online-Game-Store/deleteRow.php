<?php
/**
 * Created by PhpStorm.
 * User: Kole
 * Date: 4/21/2015
 * Time: 4:57 PM
 */

/* GET URL PARAMETERS */
$selectedTable = $_GET["type"]; //type of table i.e. Game or User ..
$id = $_GET["id"];


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

// sql to delete a record
$sql = "null"; // = "DELETE FROM" . $selectedTable .  " WHERE id=" . $id;

if ($selectedTable == 'User') {
    $sql = "DELETE FROM User WHERE id=" . $id;

} else if ($selectedTable == 'Game') {

    $sql = "DELETE FROM Game WHERE Title='" . (string)$id . "'";

} else if ($selectedTable == 'Dev') {

    $sql = "DELETE FROM Developer WHERE name='" . $id . "'";

} else if ($selectedTable == 'UserTH') {
    $sql = "DELETE FROM Transaction WHERE id=" . $id;

}





if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error . "   " . $sql . " | " . $sql;
}

$conn->close();

?>



<?php

/**
 * Created by PhpStorm.
 * User: Kole
 * Date: 4/21/2015
 * Time: 1:57 PM
 */


/* GET URL PARAMETERS */
$selectedTable = $_GET["type"]; //type of table i.e. Game or User
$userId = $_GET["userId"];

/* MYSQL Server Connection Info */
$servername = "db4free.net:3306";
$username = "sergaming";
$password = "ASK KOLE"; //CHANGE BEFORE COMMITTING AND POSTING TO GITHUB (ITS PUBLIC)
$database = "sergamedb";



// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

/* DONE WITH CONNECTING - TIME TO QUERY */


$sql;



/* CHANGE SELECTION QUERY BASED ON TABLE WANTED */

if($selectedTable == "Users")
    $sql = "select * from User";
else if ($selectedTable == "Games")
    $sql = "select * from Game";
else if ($selectedTable == "Devs")
    $sql = "select * from Developer";
else if ($selectedTable == "UserTH")
    $sql = "select * from User where userId=" . $userId;


//query using the connection, store result
$result = $conn->query($sql);

//if there's rows returned, go through them
if ($result->num_rows > 0) {
    // output data of each row

    $htmlTable = "<table align='center'>";

    //get the HEADERS row of the table
    $htmlTable = getHeaders($htmlTable, $selectedTable);

    while($row = $result->fetch_assoc()) {
        $htmlTable = $htmlTable . "<tr>";

        //Get the row (changes depending on which table is wanted to be returned)
        $htmlTable = getRow($htmlTable, $row, $selectedTable, $userId);


        $htmlTable = $htmlTable . "</tr>";

        //echo "id: " . $row["id"]. " - Title: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }

    $htmlTable = $htmlTable . "</table>";

    echo $htmlTable;

} else {
    echo "0 results";
}
$conn->close();



function getRow($htmlTable, $row, $selectedTable, $userId){


    if($selectedTable == "Users") {
        $sql = "select * from User";
    }
    else if ($selectedTable == "Games") {
        $htmlTable = $htmlTable . "<td>" . $row["id"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Title"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["UPC"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Developer"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Publisher"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Metascore"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["PublisherId"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["ESRB"] . "</td>";
    }
    else if ($selectedTable == "Devs") {
        $sql = "select * from Developer";
    }
    else if ($selectedTable == "UserTH") {
        $sql = "select * from User where userId=" . $userId;
    }


//return "dlkfjdfjdf";
    return $htmlTable;
}

function getHeaders($htmlTable, $selectedTable){

    if($selectedTable == "Users") {
        $sql = "select * from User";
    }
    else if ($selectedTable == "Games") {
        $htmlTable = $htmlTable . "<th>id</th><th>Title</th><th>UPC</th><th>Developer</th><th>Publisher</th><th>Metascore</th><th>Publisher Id</th><th>ESRB</th>";

    }
    else if ($selectedTable == "Devs") {
        $sql = "select * from Developer";
    }
    else if ($selectedTable == "UserTH") {
        $sql = "select * from User where userId=" . $userId;
    }


    return $htmlTable;

}


?>
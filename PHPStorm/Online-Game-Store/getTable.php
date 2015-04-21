
<?php

$selectedTable = $_GET["type"];
$userId = $_GET["userId"];

$servername = "db4free.net:3306";
$username = "sergaming";
$password = "ASK KOLE";
$database = "sergamedb";



// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$sql;


/*
echo '<script language="javascript">';
echo 'alert("' . $selectedTable .   '")';
echo '</script>'; */


if($selectedTable == "Users")
    $sql = "select * from User";
else if ($selectedTable == "Games")
    $sql = "select * from Game";
else if ($selectedTable == "Devs")
    $sql = "select * from Developer";
else if ($selectedTable == "UserTH")
    $sql = "select * from User where userId=" . $userId;



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    $htmlTable = "<table align='center'>";

    $htmlTable = getHeaders($htmlTable, $selectedTable);

    while($row = $result->fetch_assoc()) {
        $htmlTable = $htmlTable . "<tr>";

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
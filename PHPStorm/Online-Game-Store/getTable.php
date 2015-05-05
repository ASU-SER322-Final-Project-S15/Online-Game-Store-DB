<?php

/**
 * Created by PhpStorm.
 * User: Kole
 * Date: 4/21/2015
 * Time: 1:57 PM
 */

/* GET URL PARAMETERS */
$selectedTable = $_GET["type"]; //type of table i.e. Game or User ..

/* MYSQL Server Connection Info */
//$servername = "http://www.db4free.net:3306";
$servername = "85.10.205.173:3306";
$username = "sergaming";
$password = "sergaming123"; //CHANGE BEFORE COMMITTING AND POSTING TO GITHUB (ITS PUBLIC)
$database = "sergamedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

/* DONE WITH CONNECTING - TIME TO QUERY */
$sql;

/* CHANGE SELECTION QUERY BASED ON TABLE WANTED */
if ($selectedTable == "User")
    $sql = "select * from User";
else if ($selectedTable == "Game")
    $sql = "select g.Title,g.UPC,g.Metascore,g.ESRB,d.name from Game g, Developer d, Develops s where s.UPC = g.UPC and s.DevID = d.id";
else if ($selectedTable == "Dev")
    $sql = "select * from Developer";
else if ($selectedTable == "Inventory")
    $sql = "select g.Title, i.SKU, i.Price, i.Used, i.Sold from Inventory i, Game g where i.UPC = g.UPC";
else if ($selectedTable == "UserTH")
    $sql = "select * from Transaction";

//query using the connection, store result
$result = $conn->query($sql);

//if there's rows returned, go through them
if ($result->num_rows > 0) 
{
    // output data of each row
    $htmlTable = "<table align='center' cellpadding='10'>";

    //get the HEADERS row of the table
    $htmlTable = getHeaders($htmlTable, $selectedTable);

    while ($row = $result->fetch_assoc()) 
	{
        $htmlTable = $htmlTable . "<tr>";

        //Get the row (changes depending on which table is wanted to be returned)
        $htmlTable = getRow($htmlTable, $row, $selectedTable, $userId);

        $htmlTable = $htmlTable . "</tr>";

        //echo "id: " . $row["id"]. " - Title: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }

    $htmlTable = $htmlTable . "</table>";

    echo $htmlTable;
} 
else 
{
    echo "0 results";
}
$conn->close();


//Depending on table, get HTML row (different per table)
function getRow($htmlTable, $row, $selectedTable, $userId)
{
    if ($selectedTable == "User") 
	{
        $htmlTable = $htmlTable . "<td>" . $row["id"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["DisplayName"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Address"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Email"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["DOB"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Name"] . "</td>";
        $htmlTable = $htmlTable . "<td style=' text-align: center;color:red;'><button style='color:red;' onclick='confirmDel(\"User\"," . $row["id"] . ")'>X</button></td>";
    } 
	else if ($selectedTable == "Game") 
	{
        $htmlTable = $htmlTable . "<td>" . $row["Title"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["UPC"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Metascore"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["ESRB"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["name"] . "</td>";
        $htmlTable = $htmlTable . "<td style=' text-align: center;color:red;'><button style='color:red;' onclick='confirmDel(\"Game\",\"" . $row["Title"] . "\")'>X</button></td>";
    } 
	else if ($selectedTable == "Dev") 
	{
        $htmlTable = $htmlTable . "<td>" . $row["name"] . "</td>";
        $htmlTable = $htmlTable . "<td style=' text-align: center;color:red;'><button style='color:red;' onclick='confirmDel(\"Dev\",\"" . $row["name"] . "\")'>X</button></td>";
    } 
	else if ($selectedTable == "Inventory")
	{
        $htmlTable = $htmlTable . "<td>" . $row["Title"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["SKU"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Price"] . "</td>";
        $U = "No";
        if($row["Used"] == "0"){
            $U = "Yes";
        }
        $S = "No";
        if($row["Sold"] == "1")
		{
            $S = "Yes";
        }
        $htmlTable = $htmlTable . "<td>" . $U . "</td>";
        $htmlTable = $htmlTable . "<td>" . $S . "</td>";
        $htmlTable = $htmlTable . "<td style=' text-align: center;color:red;'><button style='color:red;' onclick='confirmDel(\"Inventory\",\"" . $row["Title"] . "\")'>X</button></td>";
    }
	else if ($selectedTable == "UserTH") 
	{
        $htmlTable = $htmlTable . "<td>" . $row["id"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["Date"] . "</td>";
        $htmlTable = $htmlTable . "<td>" . $row["UsedID"] . "</td>";
        $htmlTable = $htmlTable . "<td style=' text-align: center;color:red;'><button style='color:red;' onclick='confirmDel(\"UserTH\",\"" . $row["id"] . "\")'>X</button></td>";
    }


    return $htmlTable;
}

//Depending on table, get HTML Header row (different per table)
function getHeaders($htmlTable, $selectedTable)
{

    if ($selectedTable == "User") 
	{
        $htmlTable = $htmlTable . "<th>userId</th>
									<th>DisplayName</th>
									<th>Address</th>
									<th>Email</th>
									<th>DOB</th>
									<th>Name</th>
									<th>Delete</th>";
    } 
	else if ($selectedTable == "Game") 
	{
        $htmlTable = $htmlTable . "<th>Title</th>
									<th>UPC</th>
									<th>Metascore</th>
									<th>ESRB</th>
									<th>Developer</th>
									<th>Delete</th>";
    } 
	else if ($selectedTable == "Dev") 
	{
        $htmlTable = $htmlTable . "<th>Name</th><th>Delete</th>";
    } 
	else if ($selectedTable == "Inventory") 
	{
        $htmlTable = $htmlTable . "<th>Title</th>
									<th>SKU</th>
									<th>Price</th>
									<th>Used?</th>
									<th>Sold?</th><th>Delete</th>";
    }
	else if ($selectedTable == "UserTH") 
	{
        $htmlTable = $htmlTable . "<th>TransactionID</th>
									<th>Date</th>
									<th>UsedID</th><th>Delete</th>";
    }

    return $htmlTable;
}

?>
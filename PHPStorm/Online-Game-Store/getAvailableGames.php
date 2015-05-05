<?php
    //querry the information from the devloper table
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
    $sql = "SELECT DISTINCT G1.Title
			FROM Inventory I1, Game G1
			WHERE I1.Sold = 0
			AND G1.UPC = I1.UPC";
     
    if ($result = mysqli_query($conn, $sql))
    {
        $resultArray = array();
        $tempArray = array();

        // Loop through each row in the result set
        while($row = $result->fetch_object())
        {
          // Add each row into our results array
			$tempArray = $row;
            array_push($resultArray, $tempArray);
        }

        // Finally, encode the array to JSON and output the results
        echo json_encode($resultArray);
    }
    
    $conn->close();
?>
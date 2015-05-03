<?php
    //querry the information from the devloper table
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

    $sql = "SELECT Title FROM Game";
    // If so, then create a results array and a temporary one
     // to hold the data
     
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
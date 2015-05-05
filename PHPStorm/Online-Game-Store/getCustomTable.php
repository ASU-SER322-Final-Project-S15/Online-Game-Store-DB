<?php
/**
 * Created by PhpStorm.
 * User: Kole
 * Date: 5/4/2015
 * Time: 10:16 PM
 */

/* GET URL PARAMETERS */
$selectedTable = $_GET["type"]; //type of table i.e. Game or User ..
$query = $_GET["query"]; //type of table i.e. Game or User ..

/* MYSQL Server Connection Info */
//$servername = "http://www.db4free.net:3306";
$servername = "85.10.205.173:3306";
$username = "sergaming";
$password = "sergaming123"; //CHANGE BEFORE COMMITTING AND POSTING TO GITHUB (ITS PUBLIC)
$database = "sergamedb";





?>
<?php
// Include base.php to access the updateDatabase function
include 'baza.class.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $baza=new Baza();
    $baza->spojiDB();

    // Get the parameters from the AJAX request
    $param1 = $_POST["param1"];
    $param2 = $_POST["param2"];

    $sql = "UPDATE Natjecaj SET Kandidati = '$param1' WHERE Natjecaj_ID = $param2";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($sql);
    }
?>

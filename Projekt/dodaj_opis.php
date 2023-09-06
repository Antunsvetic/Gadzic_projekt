<?php
// Include base.php to access the updateDatabase function
include 'baza.class.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $baza=new Baza();
    $baza->spojiDB();

    // Get the parameters from the AJAX request
    $zadatak_id = $_POST["zadatak_id"];
    $opis = $_POST["opis"];

    $updateNatjecaji = "UPDATE Zadatak SET Opis = '$opis', Status_zadatka = 0 WHERE Zadatak_ID = $zadatak_id";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($updateNatjecaji);

    }
?>

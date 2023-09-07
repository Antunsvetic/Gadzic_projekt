<?php
// Include base.php to access the updateDatabase function
include 'baza.class.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $baza=new Baza();
    $baza->spojiDB();

    // Get the parameters from the AJAX request
    $natjecaj_id = $_POST["natjecaj_id"];
    $naziv = $_POST["naziv"];
    $opis = $_POST["opis"];
    $kandidati = $_POST["kandidati"];
    $status = $_POST["status"];

    $updateNatjecaji = "UPDATE natjecaj SET Naziv_natjecaja = '$naziv', Opis_natjecaja = '$opis', Kandidati = '$kandidati', Status = '$status' WHERE Natjecaj_ID = $natjecaj_id";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($updateNatjecaji);

    }
?>

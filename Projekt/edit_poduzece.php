<?php
// Include base.php to access the updateDatabase function
include 'baza.class.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $baza=new Baza();
    $baza->spojiDB();

    // Get the parameters from the AJAX request
    $id = $_POST["id"];
    $naziv = $_POST["naziv"];
    $opis = $_POST["opis"];
    $radno_vrijeme = $_POST["radno_vrijeme"];
    $broj_zaposlenih = $_POST["broj_zaposlenih"];
    $moderatori = $_POST["moderatori"];

    $updatePoduzeca = "UPDATE poduzece SET Naziv = '$naziv', Opis = '$opis', Radno_vrijeme = '$radno_vrijeme', Zaposlenih = '$broj_zaposlenih', Moderatori = '$moderatori' WHERE Poduzece_ID = $id";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($updatePoduzeca);

    }
?>

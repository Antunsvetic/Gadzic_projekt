<?php
// Include base.php to access the updateDatabase function
include 'baza.class.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $baza=new Baza();
    $baza->spojiDB();

    // Get the parameters from the AJAX request
    $naziv = $_POST["naziv"];
    $opis = $_POST["opis"];
    $radno_vrijeme = $_POST["radno_vrijeme"];
    $broj_zaposlenih = $_POST["broj_zaposlenih"];
    $moderatori = $_POST["moderatori"];

    $updatePoduzeca = "INSERT INTO `Poduzece` (`Naziv`, `Opis`, `Radno_vrijeme`, `Zaposlenih`, `Moderatori`) VALUES ('{$naziv}','{$opis}','{$radno_vrijeme}','{$broj_zaposlenih}', '{$moderatori}')";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($updatePoduzeca);

    }
?>

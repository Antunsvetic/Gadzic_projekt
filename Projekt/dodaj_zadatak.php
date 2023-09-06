<?php
// Include base.php to access the updateDatabase function
include 'baza.class.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $baza=new Baza();
    $baza->spojiDB();

    // Get the parameters from the AJAX request
    $naziv = $_POST["naziv"];
    $opis = $_POST["opis"];
    $kandidati = $_POST["kandidati"];
    $datum = $_POST["datum"];

    $updateNatjecaji = "INSERT INTO `Zadatak` (`Naziv`, `Opis`, `Datum`, `Zaduzen_korisnik`, `Ocjena`) VALUES ('{$naziv}','{$opis}','{$datum}','{$kandidati}', 1)";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($updateNatjecaji);

    }
?>

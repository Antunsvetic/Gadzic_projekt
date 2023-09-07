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
    $pocetak = $_POST["pocetak"];
    $kraj = $_POST["kraj"];
    $status = $_POST["status"];

    $updateNatjecaj = "INSERT INTO `Natjecaj` (`Naziv_natjecaja`, `Opis_natjecaja`, `Kandidati`, `Pocetak_natjecaja`, `Kraj_natjecaja`, `Status`) VALUES ('{$naziv}','{$opis}','{$kandidati}','{$pocetak}','{$kraj}','{$status}')";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($updateNatjecaj);
    echo $rezultat;

    }
?>

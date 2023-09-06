<?php
// Include base.php to access the updateDatabase function
include 'baza.class.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $baza=new Baza();
    $baza->spojiDB();

    // Get the parameters from the AJAX request
    $param1 = $_POST["user_id"];
    $param2 = $_POST["natjecaj_id"];
    $param3 = $_POST["kandidati"];
    $param4 = $_POST["username"];
    $kandidati = $param3 . ",$param4";

    $updateNatjecaji = "UPDATE Natjecaj SET Kandidati = '$kandidati' WHERE Natjecaj_ID = $param2";
    $updateUserNatjecaji = "UPDATE Korisnik SET Prijavljen_natjecaj = '$param2' WHERE Korisnik_ID = $param1";

    // Call the updateDatabase function with the parameters
    $rezultat = $baza->updateDB($updateNatjecaji);
    $rez2 = $baza->updateDB($updateUserNatjecaji);
    }
?>

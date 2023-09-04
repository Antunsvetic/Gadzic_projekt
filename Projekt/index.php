<?php

include "baza.class.php";
include "sesija.class.php";

const server = "127.0.0.1";
const korisnik = "root";
const lozinka = "s6K8yzPb";
const baza = "webdip2022x007";

if(isset($_GET['prijavi'])){
    
    $greska_krivi_unos="";

    $greska_polje="";
    $poruka_prijava = "";
    $korime=$_GET['korisnicko_ime'];
    $lozinka=$_GET['lozinka'];

    foreach ($_GET as $key => $value) {
        if (empty($value)) {
            $poruka_prijava .= "Nije upisano " . $key . "<br>";
            $greska_polje.="Nije prazno";
        }
    }

    $upit="SELECT * FROM `korisnik` WHERE Korisnicko_ime='{$korime}'";
    $rezultat=$baza->selectDB($upit);

  

    if(mysqli_num_rows($rezultat)>0){
        
        while($red=mysqli_fetch_assoc($rezultat)){
            $korisnicko_ime=$red['Korisnicko_ime'];
            $sifra=$red['Lozinka'];
            $uloga=$red['Uloga'];
        }
    }
    else{
        $greska_polje.="Nije prazno";
        $greska_krivi_unos.="Podaci za prijavu nisu ispravni";
    }

    if(empty($greska_polje)){
        Sesija::kreirajSesiju();
        Sesija::kreirajKorisnika($korisnicko_ime,$uloga);
        echo $_SESSION['korisnik'];
        echo $_SESSION['uloga'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/igadzic.css">
    <title>Moj posao</title>
</head>
<body style="background-image: url('Materijali/naslovna.jpeg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="o_autoru.html">Autor</a></li>
            <li><a href="dokumentacija.html">Dokumentacija</a></li>
            <li><a href="privatno.html">Privatno</a></li>

        </ul>
    </nav>

    <div class="container">
        <div class="buttons">
            <button class="login-button" onclick="openLoginForm()">Prijavi se</button>
            <button class="register-button" onclick="openRegistrationForm()">Registriaj se</button>
            <button class="guest-button">Gost</button>
        </div>
    </div>

    <div id="loginForm" class="popup-form">
    <?php
        if (isset($poruka_prijava)) {
            echo "$poruka_prijava";
            echo "<br>";
        }

        if (isset($greska_krivi_unos)) {
            echo "$greska_krivi_unos";
            echo "<br>";
        }
        ?>
        <div class="form-container">
            <span class="close" onclick="closeLoginForm()">&times;</span>
            <h2>Prijava</h2>
            <form>
                <label for="username">Korisničko ime:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Šifra:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" id="prijavi" class="login-button">Prijavi se</button>
            </form>
        </div>
    </div>

    <div id="registrationForm" class="popup-form">
        <div class="form-container">
            <span class="close" onclick="closeRegistrationForm()">&times;</span>
            <h2>Registracija</h2>
            <form>
                <label for="firstName">Ime:</label>
                <input type="text" id="firstName" name="firstName" required>
                <label for="lastName">Prezime:</label>
                <input type="text" id="lastName" name="lastName" required>
                <label for="dateOfBirth">Datum rođenja:</label>
                <input type="date" id="dateOfBirth" name="dateOfBirth" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="newUsername">Korisničko ime:</label>
                <input type="text" id="newUsername" name="newUsername" required>
                <label for="newPassword">Šifra:</label>
                <input type="password" id="newPassword" name="newPassword" required>
                <label for="repPassword">Ponovi šifru:</label>
                <input type="password" id="repPassword" name="repPassword" required>
                <button type="submit" class="register-button">Registracija</button>
            </form>
        </div>
    </div>

    <script src="igadzic.js"></script>
</body>
</html>
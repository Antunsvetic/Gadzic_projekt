<?php

include "baza.class.php";
include "sesija.class.php";

const server = "127.0.0.1";
const korisnik = "root";
const lozinka = "s6K8yzPb";
const baza = "webdip2022x007";

$baza=new Baza();
$baza->spojiDB();

//prijava
if(isset($_GET['login-button'])){
    
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
//registracija 
if (isset($_POST['registriraj'])) {

    $greska_polje="";
    $poruka = "";
    $email_greska = "";
    $lozinka_greska = "";
    $potvrda_lozinka_greska="";
    $email_postoji_greska="";

    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $email = $_POST['email'];
    $korime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];
    $potvrda_lozinka = $_POST['potvrda_lozinke'];

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $poruka .= "Nije upisano " . $key . "<br>";
            $greska_polje.="Nije prazno";
        } elseif ($key == "email") {

            $upit="SELECT * FROM `Korisnik` WHERE Email='{$email}'";

            $rezultat=$baza->selectDB($upit);

            if(mysqli_num_rows($rezultat)>0){
                $email_postoji_greska="Email već postoji";
                $greska_polje.="Nije prazno";
            }
            $regex = "/^[A-Za-z0-9._]{1,64}@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)*\.(info|hr|com)$/";

            if (!preg_match($regex, $email)) {
                $email_greska = "Neispravan format emaila";
                $greska_polje.="Nije prazno";
            }
        } elseif ($key == "lozinka") {

            function pregled_lozinke($lozinka)
            {
                $mala_slova = false;
                $velika_slova = false;
                $brojevi = false;
                $razmak=true;
                $duljina_lozinke=false;
               
                if(strlen($lozinka)>=15 && strlen($lozinka)<=25){
                    $duljina_lozinke=true;
                }
                for ($i = 0; $i < strlen($lozinka); $i++) {
                    $znak = $lozinka[$i];
                    if (ctype_lower($znak)) {
                        $mala_slova = true;
                    } elseif (ctype_upper($znak)) {
                        $velika_slova = true;
                    } elseif (ctype_digit($znak)) {
                        $brojevi = true;
                    }
                    elseif(strpos($lozinka,' ')==true){
                        $razmak=false;
                    }   
                }
                return $mala_slova && $velika_slova && $brojevi && $razmak && $duljina_lozinke;
            }
            if (!pregled_lozinke($lozinka)) {
                $lozinka_greska = "Lozinka nije u dobrom formatu";
                $greska_polje.="Nije prazno";
            }
        }
        elseif($key=="potvrda_lozinke"){
            if($lozinka!=$potvrda_lozinka){
                $potvrda_lozinka_greska="Lozinke nisu iste";
                $greska_polje.="Nije prazno";
            }
        }
    }

    if(empty($greska_polje)){
        $sol="sha256kript";
        $kriptirano=$lozinka.$sol;
        $nova_lozinka=sha1($kriptirano);

        $upit="INSERT INTO `korisnik`(`Korisnik_ID`, `Ime`, `Prezime`, `Slika_Korisnika`, `Email`, `Korisnicko_ime`, 
        `Lozinka`, `Potvrda_lozinkeSH`, `Uloga`) VALUES ('','{$ime_prezime}','{$datum_rodenja}','{$email}',
        '{$korime}','{$lozinka}','{$nova_lozinka}',3)";
        $rezultat=$baza->updateDB($upit);
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
                <button type="submit" class="login-button">Prijavi se</button>
            </form>
        </div>
    </div>

    <div id="registrationForm" class="popup-form">
    <?php
        if (isset($poruka)) {
            echo "$poruka";
            echo "<br>";
        }
        if (isset($email_greska)) {
            echo "$email_greska";
            echo "<br>";
        }
        if (isset($lozinka_greska)) {
            echo "$lozinka_greska";
        }
        echo "<br>";
        if (isset($potvrda_lozinka_greska)) {
            echo "$potvrda_lozinka_greska";
        }
        echo "<br>";
        if (isset($email_postoji_greska)) {
            echo "$email_postoji_greska";
        }
        echo "<br>";
    ?>
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
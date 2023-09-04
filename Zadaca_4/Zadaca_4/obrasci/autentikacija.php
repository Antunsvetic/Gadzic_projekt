<?php
 
include "../baza.class.php";
include "../sesija.class.php";

$baza=new Baza();
$baza->spojiDB();


if (isset($_POST['registriraj'])) {

    $greska_polje="";
    $poruka = "";
    $email_greska = "";
    $lozinka_greska = "";
    $potvrda_lozinka_greska="";
    $email_postoji_greska="";

    $ime_prezime = $_POST['ime_prezime'];
    $datum_rodenja = $_POST['godina_rodenja'];
    $email = $_POST['email'];
    $korime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];
    $potvrda_lozinka = $_POST['potvrda_lozinke'];

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $poruka .= "Nije upisano " . $key . "<br>";
            $greska_polje.="Nije prazno";
        } elseif ($key == "email") {

            $upit="SELECT * FROM `registirani korisnik.dz4__` WHERE Email='{$email}'";

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

        $upit="INSERT INTO `registirani korisnik.dz4__`(`ID_Korisnika`, `Ime_i_prezime`, `Godina_rodenja`, `Email`, `Korisnicko_ime`, 
        `Lozinka`, `Potvrda_lozinkeSH`, `Uloga`) VALUES ('','{$ime_prezime}','{$datum_rodenja}','{$email}',
        '{$korime}','{$lozinka}','{$nova_lozinka}',3)";

        $rezultat=$baza->updateDB($upit);

    }
}


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

    $upit="SELECT * FROM `registirani korisnik.dz4__` WHERE Korisnicko_ime='{$korime}'";
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
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ivan Gadžić">
    <meta name="keywords" content="FOI">
    <meta name="description" content="17.03.2023.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/igadzic.css">
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <title>Autentikacija</title>
</head>

<body>
    <header>
        <div class="navbar">
            <a href="../index.php"><img class="opcenito-ikona" src="../materijali/logoelektricni.png" alt="logoelektricni.png"></a>
            <div class="dropdown">
                <button class="dropbtn">Izbornik
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="../index.php">Početna</a>
                    <a href="../autor.php">O Autoru</a>
                    <a href="../ostalo/popis.php">Popis</a>
                    <a href="../obrasci/obrazac.php">Obrazac</a>
                    <a href="../ostalo/multimedija.php">Multimedija</a>
                    <a href="../era.php">ERA Model</a>
                    <a href="../navigacijski.php">Navigacijski dijagram</a>
                </div>
            </div>
        </div>
        <?php
            if(isset($_SESSION['korisnik'])){ echo "<a href='../odjava.php'<button>Odjava</button></a>";}
            ?>
    </header>

    <section class="sekcija-prijava">
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
        <form novalidate id="prijava" name="prijava" method="get">
            <div class="prijava-forma">
                <label for="korisnicko_ime">Korisničko ime: </label><br>
                <input type="text" name="korisnicko_ime" id="korisnicko_ime" maxlength="30" placeholder="Unesite korisničko ime..." autofocus required><br>
                <label for="lozinka">Lozinka:</label><br>
                <input type="password" name="lozinka" id="lozinka" maxlength="30" placeholder="Unesite lozinku..." required><br>
                <label for="da_ne">Zapamti ime: </label><br>
                <input type="radio" name="zapamti_ime" id="da_ne" value="da"> Da
                <input type="radio" name="zapamti_ime" id="ne_ne" value="ne" checked>Ne
            </div>
        </form>
        <div class="prijava-gumbi">
            <button name="prijavi" id="prijavi" form="prijava" type="submit" value="prijavi">Prijavite se</button>
            <button name="inicijaliziraj" id="inicijaliziraj" form="prijava" type="reset">Inicijalizirajte</button>
        </div>
        <p id="prijava-zaboravljena-lozinka"><a href="../index.php">Zaboravljena lozinka</a></p>
    </section>



    <section class="registracija-section">
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
        <form novalidate class="registracija-forma" id="registracija" name="registracija" method="post">
            <div class="registracija-unos">
                <label for="ime_prezime">Ime i prezime: </label>
                <input type="text" name="ime_prezime" id="ime_prezime" autofocus="autofocus" placeholder="Unesite ime i prezime...">
            </div>
            <div class="registracija-unos">
                <label for="godina_rodenja">Godina rođenja: </label>
                <input type="date" name="godina_rodenja" id="godina_rodenja">
            </div>
            <div class="registracija-unos">
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" placeholder="ldap@foi.hr">
                <button type="button" id="check-email-btn">Provjeri Email</button>
            </div>
            <div class="registracija-unos">
                <label for="korisnicko_ime">Korisničko ime:</label>
                <input type="text" name="korisnicko_ime" id="korisnicko_ime" maxlength="25" placeholder="Unesite korisničko ime...">
            </div>
            <div class="registracija-unos">
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka" id="lozinka" minlength="15" maxlength="25" placeholder="Unesite lozinku...">
            </div>
            <div class="registracija-unos">
                <label for="potvrda_lozinke">Potvrda lozinke:</label>
                <input type="password" name="potvrda_lozinke" id="potvrda_lozinke" placeholder="Potvrdite lozinku...">
            </div>
        </form>
        <div class="registracija-gumbi">
            <button name="registriraj" id="registriraj" form="registracija" type="submit" value="registriraj">Registrirajte se</button>
            <button name="inicijaliziraj" id="inicijaliziraj" form="registracija" type="reset" value="inicijaliziraj">Inicijalizirajte</button>
        </div>
    </section>

    <footer class="podnozje">
        <p>copyright &copy; <a href="mailto:igadzic@student.foi.hr" target="_blank" rel="noopener noreferrer">Ivan Gadžić</a>, 2023.</p>
        <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2022/zadaca_01/igadzic/index.php" target="_blank"><img class="ikonaHTML" src="../materijali/HTML5.png" alt="Validacija.png"></a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2022/zadaca_01/igadzic/css/igadzic.css" target="_blank"><img class="ikonaCSS" src="../materijali/CSS3.png" alt="CSS3Validacija.png"></a>
    </footer>

</body>

</html>
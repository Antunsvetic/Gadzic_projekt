
<?php

include "../sesija.class.php";

?>


<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="Ivan Gadžić">
    <meta name="keywords" content="FOI">
    <meta name="description" content="17.03.2023.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="../css/igadzic.css">
    <title>Obrazac</title>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
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
                <a href="../ostalo/multimedija.php">Multimedija</a>
                <a href="../obrasci/autentikacija.php">Autentikacija</a>
                <a href="../era.php">ERA Model</a>
                <a href="../navigacijski.php">Navigacijski dijagram</a>
              </div>
            </div>
          </div>
    </header>
    <h1>Obrazac</h1>
    <section class="obrazac-section">
        <form novalidate class="obrazac-forma-za-upload" method="post" name="obrazac" id="obrazac" action="http://barka.foi.hr/WebDiP/2021/materijali/zadace/ispis_forme.php">
            <fieldset class="obrazac-grupa-unosa">
                <legend>Obrazac slanja</legend>
                <div class="obrazac-unos">
                    <label for="title">Title:</label>
                    <input type="text" id="title">
                </div>
                <div class="obrazac-unos">
                    <label for="email">E-mail: </label>
                    <input type="email" name="email" id="email2" placeholder="ldap@foi.hr">
                </div>
                <div class="obrazac-unos">
                    <label for="kategorija">Kategorija</label>
                    <select name="kategorija" id="kategorija"  multiple required>
                        <option value="default" selected>Odaberite opciju ili više opcija</option>
                        <option value="zero">Poslana</option>
                        <option value="first" >Nacrt</option>
                        <option value="second">Smeće</option>
                        <option value="third">Neželjena</option>
                        <option value="forth">Važno</option>
                    </select>
                </div>
                <div class="obrazac-unos">
                    <label for="opis">Opis</label>
                    <textarea name="opis" id="opis" placeholder="Unesite sadržaj..." required></textarea>
                </div>
                <div class="obrazac-unos">
                    <label for="vrijeme_datum_kreiranja">Vrijeme i datum</label>
                    <input type="datetime-local" name="vrijeme_datum_kreiranja" id="vrijeme_datum_kreiranja" required>
                </div>
                <div class="obrazac-unos"> 
                    <label for="telefon">Broj telefona</label>
                    <input type="tel" name="telefon" id="telefon" required>
                </div>
                <div class="obrazac-unos">
                    <label for="poveznica">URL</label>
                    <input type="url" name="poveznica" id="poveznica" required>
                </div>
            </fieldset >
        </section>
        <button id="next">Dalje</button>
        <button id="obrazac-gumb-za-predaju" type="submit" form="obrazac" value="submit">Upload</button>

    <footer class="podnozje">
        <p>copyright &copy; <a href="mailto:igadzic@student.foi.hr" target="_blank" rel="noopener noreferrer">Ivan Gadžić</a>, 2023.</p>
        <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2022/zadaca_01/igadzic/index.php" target="_blank"><img class="ikonaHTML" src="../materijali/HTML5.png" alt="Validacija.png"></a>
        <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2022/zadaca_01/igadzic/css/igadzic.css" target="_blank"><img class="ikonaCSS" src="../materijali/CSS3.png" alt="CSS3Validacija.png"></a>
    </footer>

</body>
</html>
<?php
    include "../baza.class.php";
    include "../sesija.class.php";

    $baza = new Baza();
    $baza->spojiDB();
    $res = $baza->selectDB("SELECT * FROM Natjecaj");
    $resZadatak = $baza->selectDB("SELECT * FROM Zadatak");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/igadzic.css">
    <title>Moj posao</title>
</head>
<body style="background-image: url('../Materijali/naslovna.jpeg'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">

    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="o_autoru.html">Autor</a></li>
            <li><a href="dokumentacija.html">Dokumentacija</a></li>
            <li><a href="privatno.html">Privatno</a></li>
            <li>
                <form id="logoutForm" action="../odjava.php" method="post">
                    <button type="submit">Odjavi me</button>
                </form>
            </li>
        </ul>
    </nav>

    <div id="zadatak-modal" class="popup-form">
    <?php
        if (isset($poruka_prijava)) {
            echo "$poruka_prijava";
            echo "<br>";
        }

        if (isset($greska_polje)) {
            echo "$greska_polje";
            echo "<br>";
        }
        ?>
        <div class="form-container">
            <span class="close" onclick="closeZadatakModal()">&times;</span>
            <h2>Kreiraj zadatak</h2>
            <form id="zadatak-form" action="" method="post">
                <label for="naziv">Naziv zadatka</label>
                <input type="text" id="naziv" name="naziv">
                <label for="opis">Opis zadatka:</label>
                <input type="text" id="opis" name="opis">
                <label for="datum">Datum:</label>
                <input type="date" id="datum" name="datum">
                <label for="kandidati">Kandidat:</label>
                <input type="text" id="kandidati" name="kandidati">
                <button type="submit" class="login-button" name="login-button">Kreiraj zadatak</button>
            </form>
        </div>
    </div>

    <div id="natjecaj-modal" class="popup-form">
    <?php
        if (isset($poruka_prijava)) {
            echo "$poruka_prijava";
            echo "<br>";
        }

        if (isset($greska_polje)) {
            echo "$greska_polje";
            echo "<br>";
        }
        ?>
        <div class="form-container">
            <span class="close" onclick="closeEditNatjecaj()">&times;</span>
            <h2>Uredi natječaj</h2>
            <form id="natjecaj-form" action="" method="post">
                <label for="naziv">Naziv natječaja</label>
                <input type="text" id="naziv" name="naziv">
                <label for="opis">Opis:</label>
                <input type="text" id="opis" name="opis">
                <label for="kandidati">Kandidati:</label>
                <input type="text" id="kandidati" name="kandidati">
                <label for="status">Status:</label>
                <select name="status">
                    <option value="1">Otvoren</option>
                    <option value="0">Zatvoren</option>
                </select>
                <button type="submit" class="login-button" name="login-button">Uredi natječaj</button>
            </form>
        </div>
    </div>

    <div class="container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Pocetak</th>
                    <th>Kraj</th>
                    <th>Kandidati</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $natjecaj_id = $row["Natjecaj_ID"];
                        $status = $row["Status"];
                        if($status == 1) {
                            $poruka = "Otvoren";
                        } else {
                            $poruka = "Zatvoren";
                        }
                        echo "<tr>";
                        echo "<td>" . $row["Natjecaj_ID"] . "</td>";
                        echo "<td>" . $row["Naziv_natjecaja"] . "</td>";
                        echo "<td>" . $row["Opis_natjecaja"] . "</td>";
                        echo "<td>" . $row["Pocetak_natjecaja"] . "</td>";
                        echo "<td>" . $row["Kraj_natjecaja"] . "</td>";
                        echo "<td>" . $row["Kandidati"] . "</td>";
                        echo "<td>" . $poruka . "</td>";
                        echo "<td><button onclick='editNatjecaj($natjecaj_id)'>Uredi natjecaj</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nema aktivnih natjecaja!</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Zaduzen korisnik</th>
                    <th>Opis</th>
                    <th>Datum</th>
                    <th>Ocjena</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res->num_rows > 0) {
                    while ($row = $resZadatak->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Zadatak_ID"] . "</td>";
                        echo "<td>" . $row["Naziv"] . "</td>";
                        echo "<td>" . $row["Zaduzen_korisnik"] . "</td>";
                        echo "<td>" . $row["Opis"] . "</td>";
                        echo "<td>" . $row["Datum"] . "</td>";
                        echo "<td>" . $row["Ocjena"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nema aktivnih natjecaja!</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="buttons">
         <button class="edit-button" onclick="kreirajZadatak()">Kreiraj zadatak</button>
        </div>
    </div>

    <script src="../igadzic.js"></script>
</body>
</html>


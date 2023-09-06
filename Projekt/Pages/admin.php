<?php
    include "../baza.class.php";
    include "../sesija.class.php";

    $baza = new Baza();
    $baza->spojiDB();
    $res = $baza->selectDB("SELECT * FROM Poduzece");
    $resModeratori = $baza->selectDB("SELECT * FROM Korisnik WHERE Korisnicka_uloga = 'moderator'");

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

    <div>
         <button onclick="dodajPoduzece()">Kreiraj poduzece</button>
    </div>


    <div id="poduzece-modal" class="popup-form">
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
            <span class="close" onclick="closeDodajPoduzece()">&times;</span>
            <h2>Dodaj poduzece</h2>
            <form id="poduzece-form" action="" method="post">
                <label for="naziv">Naziv</label>
                <input type="text" id="naziv" name="naziv">
                <label for="opis">Opis:</label>
                <input type="text" id="opis" name="opis">
                <label for="radno_vrijeme">Radno_vrijeme:</label>
                <input type="text" id="radno_vrijeme" name="radno_vrijeme">
                <label for="broj_zaposlenih">Broj zaposlenih:</label>
                <input type="text" id="broj_zaposlenih" name="broj_zaposlenih">
                <label for="moderatori">Moderatori:</label>
                <input type="text" id="moderatori" name="moderatori">
                <button type="submit" class="login-button" name="login-button">Kreiraj</button>
            </form>
        </div>
    </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Naziv</th>
                    <th>Opis</th>
                    <th>Radno_vrijeme</th>
                    <th>Broj zaposlenih</th>
                    <th>Moderatori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $poduzece_id = $row["Poduzece_ID"];
                        echo "<tr>";
                        echo "<td>" . $row["Poduzece_ID"] . "</td>";
                        echo "<td>" . $row["Naziv"] . "</td>";
                        echo "<td>" . $row["Opis"] . "</td>";
                        echo "<td>" . $row["Radno_vrijeme"] . "</td>";
                        echo "<td>" . $row["Zaposlenih"] . "</td>";
                        echo "<td>" . $row["Moderatori"] . "</td>";
                        echo "<td><button onclick='editPoduzece($poduzece_id)'>Uredi</button></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nema aktivnih poduzeća!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../igadzic.js"></script>
</body>
</html>


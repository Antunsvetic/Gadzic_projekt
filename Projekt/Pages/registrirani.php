<?php
    include "../baza.class.php";
    include "../sesija.class.php";

    $baza = new Baza();
    $baza->spojiDB();
    $res = $baza->selectDB("SELECT * FROM Natjecaj");
    Sesija::dajKorisnika();
    echo $_SESSION['id'];
    $korisnicko_ime = $_SESSION["korisnik"];
    $user_id = $_SESSION['id'];
    $user_natjecaj_id = $_SESSION['natjecaj_id'];
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
            <li><button onclick="">Odjavi me</button></li>
        </ul>
    </nav>

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
                </tr>
            </thead>
            <tbody>
                <?php
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $natjecaj_id = $row["Natjecaj_ID"];
                        $kandidati = $row["Kandidati"];
                        $econdedKandidati = json_encode($kandidati);
                        $encodedUsername = json_encode($korisnicko_ime);
                        $kandidatNaPopisu = (str_contains($kandidati, $korisnicko_ime) ? true : false);

                        if($kandidatNaPopisu) {
                            $poruka = "<td>Prijavljen</td>";
                        } elseif (!$kandidatNaPopisu && $user_natjecaj_id) {
                            $poruka = "<td>Kandidat je vec prijavljen na drugi natjecaj.</td>";
                        } else {
                            $poruka = "<td><button onclick='triggerUpdate($user_id, $natjecaj_id, $econdedKandidati, $encodedUsername)'>PRIJAVI SE</button></td>";
                        };

                        echo "<tr>";
                        echo "<td>" . $row["Natjecaj_ID"] . "</td>";
                        echo "<td>" . $row["Naziv_natjecaja"] . "</td>";
                        echo "<td>" . $row["Opis_natjecaja"] . "</td>";
                        echo "<td>" . $row["Pocetak_natjecaja"] . "</td>";
                        echo "<td>" . $row["Kraj_natjecaja"] . "</td>";
                        echo "<td>" . $row["Kandidati"] . "</td>";
                        echo "$poruka";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Nema aktivnih natjecaja!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../igadzic.js"></script>
</body>
</html>


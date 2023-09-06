<?php
    include "../baza.class.php";
    include "../sesija.class.php";

    $baza=new Baza();
    $baza->spojiDB();
    $res = $baza->selectDB("SELECT * FROM Natjecaj");
    Sesija::dajKorisnika();
    echo $_SESSION['id'];
    $user_id = $_SESSION['id'];

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
                    <!-- Add more table headers for your columns -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the retrieved data and display it in the table
                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $natjecaj_id = $row["Natjecaj_ID"];
                        echo "<tr>";
                        echo "<td>" . $row["Natjecaj_ID"] . "</td>";
                        echo "<td>" . $row["Naziv_natjecaja"] . "</td>";
                        echo "<td>" . $row["Opis_natjecaja"] . "</td>";
                        echo "<td>" . $row["Pocetak_natjecaja"] . "</td>";
                        echo "<td>" . $row["Kraj_natjecaja"] . "</td>";
                        echo "<td>" . $row["Kandidati"] . "</td>";
                        echo "<td><button onclick='triggerUpdate($user_id, $natjecaj_id)'>PRIJAVI SE</button></td>";
                        // Add more table cells for additional columns as needed
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../igadzic.js"></script>
</body>
</html>


<?php

/*
  + Neregistrirani korisnik može pristupiti stranicama: prijava.php, registracija.php, index.php
  + Registrirani korisnik može pristupiti svemu kao i neregistrirani korisnik plus: popis.php
  + Voditelj može pristupiti svemu kao i registrirani korisnik plus:multimedija.php
  + Administrator može pristupiti svim stranicama.
 */

echo "<nav class=\"stupac_1\"><ul>
        <li><a href=\"$putanja/index.php\">Početna stranica</a></li>    
        <li><a href=\"$putanja/obrasci/autentikacija.php\">Autentikacija</a></li>
    ";
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 4) {
    echo "<li><a href=\"$putanja/ostalo/popis.php\">Popis</a></li>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] < 3) {
    echo "<li><a href=\"$putanja/ostalo/multimedija.php\">Multimedija</a></li>";
}
if (isset($_SESSION["uloga"]) && $_SESSION["uloga"] === "1") {
    echo "<li><a href=\"$putanja/obrasci/obrazac.php\">Obrazac</a></li>";
}
echo "</ul></nav>";

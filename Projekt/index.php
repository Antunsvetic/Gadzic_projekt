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
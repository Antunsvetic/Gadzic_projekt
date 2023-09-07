//Prijava 

function openLoginForm() {
    var loginForm = document.getElementById("loginForm");
    loginForm.style.display = "block";
}

function closeLoginForm() {
    var loginForm = document.getElementById("loginForm");
    loginForm.style.display = "none";
}

// Close the form if the user clicks outside of it
window.onclick = function(event) {
    var loginForm = document.getElementById("loginForm");
    if (event.target == loginForm) {
        loginForm.style.display = "none";
    }
}

//Registracija 

// Function to open the registration form
function openRegistrationForm() {
    var registrationForm = document.getElementById("registrationForm");
    registrationForm.style.display = "block";
}

// Function to close the registration form
function closeRegistrationForm() {
    var registrationForm = document.getElementById("registrationForm");
    registrationForm.style.display = "none";
}

function relocateGuest() {
    document.location.href = "Pages/neregistrirani.php";
}


function triggerUpdate(param1, param2, param3, param4) {
    // Send an AJAX request to call the updateDatabase function
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../prijava_natjecaja.php", true); // Create call_function.php to call the function
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from call_function.php if needed
            console.log(xhr.responseText);
        }
    };

    // Construct the data to send
    const data = "user_id=" + encodeURIComponent(param1) + "&natjecaj_id=" + encodeURIComponent(param2) + "&kandidati=" + encodeURIComponent(param3) + "&username=" + encodeURIComponent(param4);
    xhr.send(data);
}

function editNatjecaj(natjecaj_id) {
    openEditNatjecaj(natjecaj_id);
}

function dodajNatjecaj() {
    console.log("Bla")
    var natjecajModal = document.getElementById("natjecaj-modal");
    natjecajModal.style.display = "block";

    const natjecajForm = document.getElementById("natjecaj-form");
    natjecajForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const values = e.target;
        const naziv = values.elements['naziv'].value;
        const opis = values.elements['opis'].value;
        const kandidati = values.elements['kandidati'].value;
        const pocetak = values.elements['pocetak'].value;
        const kraj = values.elements['kraj'].value;
        const status = values.elements['status'].value;

        //Send data and trigger query
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../dodaj_natjecaj.php", true); // Create call_function.php to call the function
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from call_function.php if needed
                console.log(xhr.responseText);
            }
        };
    
        // Construct the data to send
        const data = "&naziv=" + encodeURIComponent(naziv) + "&opis=" + encodeURIComponent(opis) + "&kandidati=" + encodeURIComponent(kandidati)
            + "&status=" + encodeURIComponent(status) + "&pocetak=" + encodeURIComponent(pocetak) + "&kraj=" + encodeURIComponent(kraj);
        xhr.send(data);

        closeEditNatjecaj();
    });
}

function openEditNatjecaj(natjecaj_id) {
    var natjecajModal = document.getElementById("natjecaj-modal");
    natjecajModal.style.display = "block";

    const natjecajForm = document.getElementById("natjecaj-form");
    natjecajForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const values = e.target;
        const naziv = values.elements['naziv'].value;
        const opis = values.elements['opis'].value;
        const kandidati = values.elements['kandidati'].value;
        const status = values.elements['status'].value;

        //Send data and trigger query
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../edit_natjecaja.php", true); // Create call_function.php to call the function
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from call_function.php if needed
                console.log(xhr.responseText);
            }
        };
    
        // Construct the data to send
        const data = "natjecaj_id=" + encodeURIComponent(natjecaj_id) + "&naziv=" + encodeURIComponent(naziv) + "&opis=" + encodeURIComponent(opis) + "&kandidati=" + encodeURIComponent(kandidati)
            + "&status=" + encodeURIComponent(status);
        xhr.send(data);

        closeEditNatjecaj();
    });
}

function closeEditNatjecaj() {
    var natjecajModal = document.getElementById("natjecaj-modal");
    natjecajModal.style.display = "none";
}

function closeZadatakModal() {
    var natjecajModal = document.getElementById("zadatak-modal");
    natjecajModal.style.display = "none";
}

function kreirajZadatak() {
    var zadatakModal = document.getElementById("zadatak-modal");
    zadatakModal.style.display = "block";


    const zadatakForm = document.getElementById("zadatak-form");
    zadatakForm.addEventListener("submit", function(e){
        e.preventDefault();

        const values = e.target;
        const naziv = values.elements['naziv'].value;
        const opis = values.elements['opis'].value;
        const kandidati = values.elements['kandidati'].value;
        const datum = values.elements['datum'].value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../dodaj_zadatak.php", true); // Create call_function.php to call the function
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from call_function.php if needed
                console.log(xhr.responseText);
            }
        };
    
        // Construct the data to send
        const data = "&naziv=" + encodeURIComponent(naziv) + "&opis=" + encodeURIComponent(opis) + "&kandidati=" + encodeURIComponent(kandidati) + "&datum=" + encodeURIComponent(datum);
        xhr.send(data);

        closeZadatakModal();
    });
}

function dodajOpisUZadatak(zadatak_id) {
    var zadatakModal = document.getElementById("zadatak-opis-modal");
    zadatakModal.style.display = "block";


    const zadatakForm = document.getElementById("zadatak-opis-form");
    zadatakForm.addEventListener("submit", function(e){
        e.preventDefault();
        const values = e.target;
        const opis = values.elements['opis'].value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../dodaj_opis.php", true); // Create call_function.php to call the function
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from call_function.php if needed
                console.log(xhr.responseText);
            }
        };
    
        // Construct the data to send
        const data = "&zadatak_id=" + encodeURIComponent(zadatak_id) + "&opis=" + encodeURIComponent(opis);
        xhr.send(data);

        closeOpisModal();
    });
}

function closeOpisModal() {
    var natjecajModal = document.getElementById("zadatak-opis-modal");
    natjecajModal.style.display = "none";
}

function closeDodajPoduzece() {
    var natjecajModal = document.getElementById("poduzece-modal");
    natjecajModal.style.display = "none";
}

function dodajPoduzece() {
    var zadatakModal = document.getElementById("poduzece-modal");
    zadatakModal.style.display = "block";

    const zadatakForm = document.getElementById("poduzece-form");
    zadatakForm.addEventListener("submit", function(e){
        e.preventDefault();
        const values = e.target;
        const naziv = values.elements['naziv'].value;
        const opis = values.elements['opis'].value;
        const radno_vrijeme = values.elements['radno_vrijeme'].value;
        const broj_zaposlenih = values.elements['broj_zaposlenih'].value;
        const moderatori = values.elements['moderatori'].value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../dodaj_poduzece.php", true); // Create call_function.php to call the function
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from call_function.php if needed
                console.log(xhr.responseText);
            }
        };
    
        // Construct the data to send
        const data = "&naziv=" + encodeURIComponent(naziv) + "&opis=" + encodeURIComponent(opis) + "&radno_vrijeme=" + encodeURIComponent(radno_vrijeme)
         + "&broj_zaposlenih=" + encodeURIComponent(broj_zaposlenih) + "&moderatori=" + encodeURIComponent(moderatori);
        xhr.send(data);

        closeDodajPoduzece();
    });
}

function editPoduzece(poduzece_id) {
    var zadatakModal = document.getElementById("poduzece-modal");
    zadatakModal.style.display = "block";

    const zadatakForm = document.getElementById("poduzece-form");
    zadatakForm.addEventListener("submit", function(e){
        e.preventDefault();
        const values = e.target;
        const naziv = values.elements['naziv'].value;
        const opis = values.elements['opis'].value;
        const radno_vrijeme = values.elements['radno_vrijeme'].value;
        const broj_zaposlenih = values.elements['broj_zaposlenih'].value;
        const moderatori = values.elements['moderatori'].value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../edit_poduzece.php", true); // Create call_function.php to call the function
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from call_function.php if needed
                console.log(xhr.responseText);
            }
        };
    
        // Construct the data to send
        const data = "&id=" + encodeURIComponent(poduzece_id) + "&naziv=" + encodeURIComponent(naziv) + "&opis=" + encodeURIComponent(opis) + "&radno_vrijeme=" + encodeURIComponent(radno_vrijeme)
         + "&broj_zaposlenih=" + encodeURIComponent(broj_zaposlenih) + "&moderatori=" + encodeURIComponent(moderatori);
        xhr.send(data);

        closeDodajPoduzece();
    });
}

function odjaviMe() {
    // Make an HTTP request to session.php to trigger obrisiSesiju()
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../session.class.php?logout=true", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            // Redirect to another page after logout if needed
            window.location.href = "../index.php";
        }
    };
    xhr.send();
}

function editKorisnik(id) {
    console.log("ID", id)
    var zadatakModal = document.getElementById("edit-korisnik-modal");
    zadatakModal.style.display = "block";

    const korisnikForm = document.getElementById("edit-korisnik-form");
    korisnikForm.addEventListener("submit", function(e){
        e.preventDefault();
        const values = e.target;
        const ime = values.elements['ime'].value;
        const prezime = values.elements['prezime'].value;
        const email = values.elements['email'].value;
        const username = values.elements['username'].value;
        const uloga = values.elements['uloga'].value;
        const blokiran = values.elements['blokiran'].value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../edit_korisnik.php", true); // Create call_function.php to call the function
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Handle the response from call_function.php if needed
                console.log(xhr.responseText);
            }
        };
    
        // Construct the data to send
        const data = "&id=" + encodeURIComponent(id) + "&ime=" + encodeURIComponent(ime) + "&prezime=" + encodeURIComponent(prezime) + "&email=" + encodeURIComponent(email)
         + "&username=" + encodeURIComponent(username) + "&uloga=" + encodeURIComponent(uloga) + "&blokiran=" + encodeURIComponent(blokiran);
        xhr.send(data);

        closeEditKorisnik();
    });
}

function closeEditKorisnik() {
    var natjecajModal = document.getElementById("edit-korisnik-modal");
    natjecajModal.style.display = "none";
}

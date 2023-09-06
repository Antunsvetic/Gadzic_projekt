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
    document.location.href = "/Pages/neregistrirani.php";
}


function triggerUpdate(param1, param2, param3, param4) {

    console.log("PARAMETRI", param1, param2, param3, param4);
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
    console.log("IM HERE", natjecaj_id)
    openEditNatjecaj(natjecaj_id);
}

function openEditNatjecaj(natjecaj_id) {
    var natjecajModal = document.getElementById("natjecaj-modal");
    natjecajModal.style.display = "block";

    const natjecajForm = document.getElementById("natjecaj-form");
    natjecajForm.addEventListener("submit", function(e) {
        e.preventDefault();
        const values = e.target;
        console.log("NATJECAJ ID", natjecaj_id)
        const naziv = values.elements['naziv'].value;
        const opis = values.elements['opis'].value;
        const kandidati = values.elements['kandidati'].value;

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
        const data = "natjecaj_id=" + encodeURIComponent(natjecaj_id) + "&naziv=" + encodeURIComponent(naziv) + "&opis=" + encodeURIComponent(opis) + "&kandidati=" + encodeURIComponent(kandidati);
        xhr.send(data);

        closeEditNatjecaj();
    });
}

function closeEditNatjecaj() {
    var natjecajModal = document.getElementById("natjecaj-modal");
    natjecajModal.style.display = "none";
}
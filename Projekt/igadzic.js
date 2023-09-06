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


function triggerUpdate(param1, param2) {

    console.log(param1, param2)

    // Send an AJAX request to call the updateDatabase function
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../call_function.php", true); // Create call_function.php to call the function
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from call_function.php if needed
            console.log(xhr.responseText);
        }
    };

    // Construct the data to send
    const data = "param1=" + encodeURIComponent(param1) + "&param2=" + encodeURIComponent(param2);
    xhr.send(data);
}
    
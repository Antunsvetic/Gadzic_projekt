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

// Function to handle the form submission
function handleRegistrationForm(event) {
    event.preventDefault(); // Prevent the form from submitting and page reloading

    // Add your registration logic here (e.g., send data to a server for processing)

    // Simulate a successful registration (you should replace this with your actual registration logic)
    var registrationSuccess = true; // Change this based on your registration result

    if (registrationSuccess) {
        // Close the registration form
        closeRegistrationForm();

        // Display a popup message for successful registration
        alert("Registration was successful!");
    }
}

// Add an event listener to the registration form
var registrationForm = document.getElementById("registrationForm");
if (registrationForm) {
    registrationForm.addEventListener("submit", handleRegistrationForm);
}
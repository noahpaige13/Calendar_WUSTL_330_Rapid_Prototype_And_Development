// code based off of cse330 wiki page
// ajax.js

function loginAjax(event) {
    const username = document.getElementById("username").value; // Get the username from the form
    const password = document.getElementById("password").value; // Get the password from the form

    // Make a URL-encoded string for passing POST data:
    const data = { 'username': username, 'password': password };

    fetch("login_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(response => response.json())
        .then(data => console.log(data.success ? "You've been logged in!" : `You were not logged in ${data.message}`))
        .catch(error => console.error('Error:', error))
}

function newUserAjax(event) {
    var user = document.getElementById("new_username").value; // Get the username from the form
    var pass = document.getElementById("new_password").value; // Get the password from the form
    console.log(user + pass);
    // Make a URL-encoded string for passing POST data:
    const data = {'username': user,'password': pass};

    fetch("newuser_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(function(response){
            return response.json();
        })
        // .then(response => console.log('Success:', JSON.stringify(response)))
        // .catch(error => console.error('Error:', error))
}

//button event listeners
document.getElementById("login_btn").addEventListener("click", loginAjax, false); // Bind the AJAX call to button click
document.getElementById("newuser_btn").addEventListener("click", newUserAjax, false); // Bind the AJAX call to button click
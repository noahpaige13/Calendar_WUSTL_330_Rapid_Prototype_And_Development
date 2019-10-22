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
        .then(res => res.text())
        // .then(text => console.log(text))
        .then(res => getEvents())
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
        .then(res => res.text())
        .then(text => console.log(text))
        .catch(error => console.error('Error:', error))
}

function addEventAjax(event) {
    var user = document.getElementById("new_username").value; // Get the username from the form
    var pass = document.getElementById("new_password").value; // Get the password from the form
    console.log(user + pass);
    // Make a URL-encoded string for passing POST data:
    const data = {'username': user,'password': pass};

    fetch("addevent_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(res => res.text())
        // .then(text => console.log(text))
        .catch(error => console.error('Error:', error))
}

//button event listeners
document.getElementById("login_btn").addEventListener("click", loginAjax, false); // Bind the AJAX call to button click
document.getElementById("newuser_btn").addEventListener("click", newUserAjax, false); // Bind the AJAX call to button click
document.getElementById("addevent_btn").addEventListener("click", addEventAjax, false); // Bind the AJAX call to button click

function getEvents(){
    fetch("getEvents_ajax.php")
    // .then(response => response.text())
    .then(function(r) {
        var user_events = [];
        for (var i in r){
            user_events.push(i,r[i]);
        }
        document.getElementById("add").innerHTML = user_events;
        // console.log(Array.from(r));
        // r => JSON.stringify(r);

        // var data = JSON.parse(r);
        // console.log('Success:', r);
        // var data = JSON.parse(text);
        
})
    .catch(error => console.error('Error:', error))

}
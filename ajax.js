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
        .then(res => login())
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
    // document.getElementById('popup').style.display = "block";
    var name = document.getElementById("event_name").value; // Get the username from the form
    var date = document.getElementById("event_date").value; // Get the password from the form
    var time = document.getElementById("event_time").value; // Get the password from the form

    // Make a URL-encoded string for passing POST data:
    const data = {'name': name,'date': date, 'time':time};

    fetch("addevent_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(res => getEvents())
        .then(modal.style.display = "none")
        .catch(error => console.error('Error:', error))
}

//code based from W3 Schools
// EDIT MODAL
var modal1 = document.getElementById("editModal");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close1")[0];

function openModal1(event) {
    console.log("hi");
    modal1.style.display = "block";
}

function closeModal1(event) {
    modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal1) {
    modal1.style.display = "none";
  }
}

// ADD MODAL
// Get the modal
var modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
function openModal(event) {
    modal.style.display = "block";
}

function closeModal(event) {
    modal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
  }
}

//separate functions
function getEvents(){

    fetch("getEvents_ajax.php")
    .then(response => response.text())
    .then((text) => {
        var json_data = JSON.parse(text);
        console.log(json_data);

        for (var i = 0 ; i < json_data.length; i++){
            let name = json_data[i].name;
            let date = json_data[i].date;
            let time = json_data[i].time;
            let id = json_data[i].event_id;
            showEvents(name, date, time, id);
        }

    })
    .catch(error => console.error('Error:', error))

}

function showEvents(name, date, time, id){
	var weeks = currentMonth.getWeeks();
    var table = document.getElementById('calendar_body');

    for(var w in weeks){
		var days = weeks[w].getDates();
        
		for(var d in days){

            var y = days[d].getFullYear();
            var m = days[d].getMonth() + 1;
            if (m <10) {
                m = '0'+ m;
            }
            var dy = days[d].getDate();
            if (dy <10) {
                dy = '0'+ dy;
            }

            var cellday = y+"-"+m+"-"+dy;
            if (date == cellday) {
                var button = document.createElement('input');
                button.setAttribute('type','button');
                var txt = 'event_editbtn' + id;
                console.log(txt);

                button.setAttribute('id', 'txt');
                button.setAttribute('value', name + ' Time: '+ time);
                table.rows[w].cells[d].appendChild(button);
                document.getElementById('txt').addEventListener('click', openModal1, false);
            }
        }
    }
}


function login(){
    document.getElementById("logout").style.display = "block";
    document.getElementById("login").style.display = "none";
    document.getElementById("newuser").style.display = "none";
}

function logout(){
    document.getElementById("logout").style.display = "none";
    document.getElementById("login").style.display = "block";
    document.getElementById("newuser").style.display = "block";
    document.getElementById("username").value = '';
    document.getElementById("password").value = '';

    fetch("logout.php")
    .then(res => updateCalendar())
    .catch(error => console.error('Error:', error))

}





//button event listeners
document.getElementById("login_btn").addEventListener("click", loginAjax, false); // Bind the AJAX call to button click
document.getElementById("newuser_btn").addEventListener("click", newUserAjax, false); // Bind the AJAX call to button click
document.getElementById("logout_btn").addEventListener("click", logout, false);
document.getElementById("addevent_btn").addEventListener("click", openModal, false); // Bind the AJAX call to button click
document.getElementById("cancel_btn").addEventListener("click", closeModal, false);
document.getElementById("cancel_btn1").addEventListener("click", closeModal1, false);
document.getElementById("create_event").addEventListener("click", addEventAjax, false);



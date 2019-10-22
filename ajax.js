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
    document.getElementById('popup').style.display = "block";
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
    .then(response => response.text())
    .then((text) => {
        var json_data = JSON.parse(text);
        console.log(json_data);

        for (var i = 0 ; i < json_data.length; i++){
            let name = json_data[i].name;
            let date = json_data[i].date;
            let time = json_data[i].time;
            showEvents(name, date, time);
        }

    })
    .catch(error => console.error('Error:', error))

}

function showEvents(name, date, time){
	var weeks = currentMonth.getWeeks();
    var table = document.getElementById('calendar_body');

    for(var w in weeks){
		var days = weeks[w].getDates();
        
		for(var d in days){

            var y = days[d].getFullYear();
            var m = days[d].getMonth() + 1;
            var dy = days[d].getDate();
            if (dy <10) {
                dy = '0'+ dy;
            }

            var cellday = y+"-"+m+"-"+dy;
            console.log(cellday + "  "+ date);
            if (date == cellday) {
                var eventText = document.createTextNode( name + "Time: " + time);
                console.log(table.rows[w].cells[d].appendChild(eventText));
            }
        }
    }


}
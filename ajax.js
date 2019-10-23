// code based off of cse330 wiki page
// ajax.js
let token = '';

function checkSession(event) {
    // const username = document.getElementById("username").value; // Get the username from the form
    // const password = document.getElementById("password").value; // Get the password from the form

    // Make a URL-encoded string for passing POST data:
    const data = {'token': token};

    fetch("checkSession.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(res => res.json())
        .then(res => {
            if (res.success){
                token = res.token
                
                getEvents()
                login(res.username)
            }
            else{
                console.log("refresh not li")
                
            }
        })
        .catch(error => console.error('Error:', error))
}

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
        .then(res => res.json())
        .then(res => {
            token = res.token
            if (res.success){
                getEvents()
                login(username)
            }
            else{
                alert("Incorrect Username or Password");
            }
        })
        .catch(error => console.error('Error:', error))
    document.getElementById("username").value = '';
    document.getElementById("password").value = '';

}

function newUserAjax(event) {
    updateCalendar();
    let user = document.getElementById("new_username").value; // Get the username from the form
    let pass = document.getElementById("new_password").value; // Get the password from the form

    if (user == '' || pass == ''){
        alert("Username or password blank!");
    }
    else{
        // Make a URL-encoded string for passing POST data:
        const data = {'username': user,'password': pass};

        fetch("newuser_ajax.php", {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'content-type': 'application/json' }
            })
            .then(res => res.json())
            .then(res => {
                token = res.token
                if (res.success){
                    login(user)
                }
                else{
                    alert("Username already taken!");
                }
            })
            .catch(error => console.error('Error:', error))
    }
    document.getElementById("new_username").value = '';
    document.getElementById("new_password").value = '';
}

function addEventAjax(event) {
    let name = document.getElementById("event_name").value; // Get the username from the form
    let date = document.getElementById("event_date").value; // Get the password from the form
    let time = document.getElementById("event_time").value; // Get the password from the form
    let priority = document.getElementById("priority").value;
    // Make a URL-encoded string for passing POST data:
    const data = {'name': name,'date': date, 'time':time+':00', 'priority':priority, 'token': token};
    fetch("addevent_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(res => getEvents())
        .then(modal.style.display = "none")
        .catch(error => console.error('Error:', error))
}

function shareEvent(event) {
    let name = document.getElementById("change_name").value; // Get the username from the form
    let date = document.getElementById("change_date").value; // Get the password from the form
    let time = document.getElementById("change_time").value; // Get the password from the form
    let u = document.getElementById("share_user").value;
    let users = u.replace(" ","").split(",")
    // Make a URL-encoded string for passing POST data:
    let i;
    for (i = 0; i < users.length; i++) {
        const data = {'name': name,'date': date, 'time':time, 'users':users[i], 'token': token};
        console.log(data);
    
        fetch("shareEvent_ajax.php", {
                method: 'POST',
                body: JSON.stringify(data),
                headers: { 'content-type': 'application/json' }
            })
            .then(modal1.style.display = "none")
            .catch(error => console.error('Error:', error))
    }
}

function editEventAjax(event) {
    let name = document.getElementById("change_name").value; // Get the username from the form
    let date = document.getElementById("change_date").value; // Get the password from the form
    let time = document.getElementById("change_time").value; // Get the password from the form
    let priority = document.getElementById("priority1").value;

    // Make a URL-encoded string for passing POST data:
    const data = {'name': name,'date': date, 'time':time, 'id': locate, 'priority':priority, 'token': token};
    console.log(priority)
    fetch("editevent_ajax.php", {
            method: 'POST',
            body: JSON.stringify(data),
            headers: { 'content-type': 'application/json' }
        })
        .then(res => getEvents())
        .then(modal1.style.display = "none")
        .catch(error => console.error('Error:', error))
}

function delEventAjax(event) {
    // Make a URL-encoded string for passing POST data:
    const data = {'id': locate, 'token': token};

    fetch("delevent_ajax.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
        })
        .then(res => getEvents())
        .then(modal1.style.display = "none")
        .catch(error => console.error('Error:', error))
}

function delAccountAjax(event) {
    // Make a URL-encoded string for passing POST data:
    const data = {'token': token};
    console.log(data);
    fetch("deleteAccount.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
        })
        .then(res => logout())
        .catch(error => console.error('Error:', error))
}

//code based from W3 Schools
// EDIT MODAL
let modal1 = document.getElementById("editModal");
let locate = '';
// Get the <span> element that closes the modal
let span1 = document.getElementsByClassName("close1")[0];

function openModal1(event) {
    modal1.style.display = "block";
    locate = this.id;
    info = document.getElementById(this.id).getAttribute('class');
    let s = info.split("/");
    let ename = s[0];
    let edate = s[1];
    let etime = s[2];
    document.getElementById("change_name").value = ename;
    document.getElementById("change_date").value = edate;
    document.getElementById("change_time").value = etime;
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
let modal = document.getElementById("myModal");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

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
    const data = {'token': token};

    fetch("getEvents_ajax.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    })
    .then(response => response.text())
    .then((text) => {
        let json_data = JSON.parse(text);

        let weeks = currentMonth.getWeeks();
        let table = document.getElementById('calendar_body');
        for(let w in weeks){
		    let days = weeks[w].getDates();
        
		    for(let d in days){
                let child = table.rows[w].cells[d];
                while (child.childNodes.length > 1){
                    table.rows[w].cells[d].removeChild(child.childNodes[1]);
                }
            }
        }

        for (let i = 0 ; i < json_data.length; i++){
            let name = json_data[i].name;
            let date = json_data[i].date;
            let time = json_data[i].time;
            let id = json_data[i].event_id;
            showEvents(name, date, time, id);
        }

    })
    .catch(error => console.error('Error:', error))

}

function getImpEvents(){
    const data = {'token': token};

    fetch("getEvents_ajax.php", {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'content-type': 'application/json' }
    })
    .then(response => response.text())
    .then((text) => {
        let json_data = JSON.parse(text);

        let weeks = currentMonth.getWeeks();
        let table = document.getElementById('calendar_body');
        for(let w in weeks){
		    let days = weeks[w].getDates();
        
		    for(let d in days){
                let child = table.rows[w].cells[d];
                while (child.childNodes.length > 1){
                    table.rows[w].cells[d].removeChild(child.childNodes[1]);
                }
            }
        }

        for (let i = 0 ; i < json_data.length; i++){
            let name = json_data[i].name;
            let date = json_data[i].date;
            let time = json_data[i].time;
            let id = json_data[i].event_id;
            let imp = json_data[i].important;
            console.log(imp)
            if ( imp == 1){
                showEvents(name, date, time, id);
            }
            
        }

    })
    .catch(error => console.error('Error:', error))

}

function showEvents(name, date, time, id){
	let weeks = currentMonth.getWeeks();
    let table = document.getElementById('calendar_body');


    for(let w in weeks){
		let days = weeks[w].getDates();
        
		for(let d in days){

            let y = days[d].getFullYear();
            let m = days[d].getMonth() + 1;
            if (m <10) {
                m = '0'+ m;
            }
            let dy = days[d].getDate();
            if (dy <10) {
                dy = '0'+ dy;
            }

            let cellday = y+"-"+m+"-"+dy;
            if (date == cellday) {
                let button = document.createElement('input');
                button.setAttribute('type','button');
                button.setAttribute('id', id);
                button.setAttribute('value', name + ' Time: '+ time);
                button.setAttribute('class', name + '/' + date + '/' + time);
                button.style.borderColor = "#233567";
                button.style.textAlign = "center";
                // button.style.backgroundColor = "#233567";

                table.rows[w].cells[d].appendChild(button);
                document.getElementById(id).addEventListener('click', openModal1, false);
            }
        }
    }
}

function login(user){
    console.log("askjnd")
    document.getElementById("logout").style.display = "block";
    document.getElementById("login").style.display = "none";
    document.getElementById("newuser").style.display = "none";
    document.getElementById("add_event").style.display = "block";
    document.getElementById("deleteaccount").style.display = "block";
    document.getElementById("user").innerHTML = user;
}

function logout(){
    document.getElementById("logout").style.display = "none";
    document.getElementById("login").style.display = "block";
    document.getElementById("newuser").style.display = "block";
    document.getElementById("add_event").style.display = "none";
    document.getElementById("deleteaccount").style.display = "none";
    document.getElementById("username").value = '';
    document.getElementById("password").value = '';
    document.getElementById("new_username").value = '';
    document.getElementById("new_password").value = '';

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
document.getElementById("edit_event").addEventListener("click", editEventAjax, false); // Bind the AJAX call to button click
document.getElementById("del_event").addEventListener("click", delEventAjax, false); // Bind the AJAX call to button click
document.getElementById("delete_btn").addEventListener("click", delAccountAjax, false); // Bind the AJAX call to button click
document.getElementById('share_btn').addEventListener("click", shareEvent, false);
let checkbox = document.querySelectorAll("input[name='checkbox']");
document.getElementById('toggle').addEventListener("click", function() {
    if ((this.checked) == 1)  {
        console.log ('checked');
        getImpEvents();
    } else {
        console.log ('not checked');
        getEvents();
    }
});




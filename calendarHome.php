<!DOCTYPE html>
<html lang="en">
<head><title>Calendar</title>
<link rel="stylesheet" type="text/css" href="calendarHome.css" />
</head>
<body>
    <h1>Welcome!</h1>
<br>

<div id="options">
    <div style="display:none;" id="logout">

        <!-- Log Out button -->
        <h3>Logged in as: </h3><div id="user"></div><br>
        <button style="margin: 0px 8px;width:90%" id="logout_btn">Log Out</button>

    </div>
    <div style="display:none;" id="deleteaccount">

        <!-- Delete Account button -->
        <button style="margin: 0px 8px;width:90%" id="delete_btn">Delete Account</button>

    </div>
    <div id="login">

        <!-- Log In button -->
        <h3>Log In?</h3>
        Username: <br><input style ="margin: 8px 0;width:90%" type="text" id="username" placeholder="Username" /><br>
        Password: <br><input style ="margin: 8px 0;width:90%" type="password" id="password" placeholder="Password" />
        <button style="margin: 0px 8px;width:90%" id="login_btn">Log In</button>

    </div><br><br>
    <div id="newuser">

        <!-- Change Username button -->
        <h3>New User? Register Here!</h3>
        Username: <br><input style ="margin: 8px 0;width:90%" type="text" id="new_username" placeholder="Username" /><br>
        Password: <br><input style ="margin: 8px 0;width:90%" type="password" id="new_password" placeholder="Password" />
        <button style="margin: 0px 8px;width:90%" id="newuser_btn">Create Account</button>

    </div>
</div>
<div id="calendar">
    <!-- Trigger/Open The Modal -->
    <div style="display:none" id="add_event"><button style="margin: 0px 8px; width:13%; float: right" id="addevent_btn" >Add Event</button></div>
    <div style="display:none" id = 'tog'> 
        <input name = "checkbox" type ='checkbox' id = 'toggle' >
        Click To Show Important Priority Events Only!

    </div>
    <br>
    <!-- The Modal -->
    <div id="myModal" style="display:none" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="container">
                <label for="event_name"><b>Event Name: </b></label>
                <input style="width: 90%;" id = "event_name" type="text" placeholder="Enter Event Name" name="event_name" required>
                <br><br>
                <label for="event_date"><b>Event Date: </b></label>
                <input type="date" id = "event_date" name="event_date" required>
                
                <label for="event_time"><b>Event Time: </b></label>
                <input type="time" id = "event_time" name="event_time" required>

                <h3>Priority</h3>
                <select style="border-color: #fbc1bc; height: 30px;" id = "priority" name="priority">
                    <option value="Imp">Important</option>
                    <option value="Not">Normal</option>
                </select>
            </div>

            <div class="container" style="background-color:#f1f1f1">
            <button id="cancel_btn" >Cancel</button>
            <button style="float:right" id="create_event">Add</button>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" style="display:none" class="modal1">
        <!-- Modal content -->
        <div class="modal-content">
            <h3 style= "text-align: center">Event Options</h3>
            <div class="container">
                <label for="event_name"><b>Change Event Name: </b></label>
                <input style="width: 90%;" id ="change_name" type="text" placeholder="Change Event Name" name="change_name">
                <br><br>
                <label for="change_date"><b>Change Event Date: </b></label>
                <input id = "change_date" type="date" name="change_date">
                <label for="change_time"><b>Change Event Time: </b></label>
                <input id = "change_time" type="time" name="change_time">
                <h3>Priority</h3>
                <select style="border-color: #fbc1bc; height: 30px;" id="priority1" name="priority1">
                    <option value="Imp1">Important</option>
                    <option value="Not1">Normal</option>
                </select>
            </div>
            <div class="container">
                <button id="cancel_btn1" >Cancel</button>
                <button style="float:right" id="edit_event">Edit Event</button>
                <button style="float:right" id = 'del_event'> Delete Event </button>
            </div><div class="container" style="background-color:#f1f1f1"><br><br></div>
            <div class="container">
                <label for="share_user"><b>Share Event With:</b></label>
                <input style="width:80%" id = "share_user" type="text" placeholder="Username" name="share_user">
                <button id="share_btn" >Share</button>
            </div>
        </div>
    </div>

    <div id="c">
        <h2 id="monthAndYear"></h2>
        <table id="calendar_heading">
            <thead >
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
            </thead>
            <tbody id="calendar_body"></tbody>
        </table>
    </div>
    <br>
    <div style="text-align: center;">
        <button style="margin: 0px 8px;width:40%" id="previous_month" >Previous</button>
        <button style="margin: 0px 8px;width:40%" id="next_month" >Next</button>
    </div>
    <br/>
    <script type="text/javascript" src="ajax.js"></script> <!-- load the JavaScript file -->

</div>

<script>
    // getEvents();
let timer = true;
// "Calendar Math" Functions
(function(){Date.prototype.deltaDays=function(c){return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c)};Date.prototype.getSunday=function(){return this.deltaDays(-1*this.getDay())}})();
function Week(c){this.sunday=c.getSunday();this.nextWeek=function(){return new Week(this.sunday.deltaDays(7))};this.prevWeek=function(){return new Week(this.sunday.deltaDays(-7))};this.contains=function(b){return this.sunday.valueOf()===b.getSunday().valueOf()};this.getDates=function(){for(var b=[],a=0;7>a;a++)b.push(this.sunday.deltaDays(a));return b}}
function Month(c,b){this.year=c;this.month=b;this.nextMonth=function(){return new Month(c+Math.floor((b+1)/12),(b+1)%12)};this.prevMonth=function(){return new Month(c+Math.floor((b-1)/12),(b+11)%12)};this.getDateObject=function(a){return new Date(this.year,this.month,a)};this.getWeeks=function(){var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);for(c.push(a);!a.contains(b);)a=a.nextWeek(),c.push(a);return c}};

// Start at a Month
let currentMonth = new Month(2019, 9);

// Next Month Event Listener
document.getElementById('next_month').addEventListener('click',function(event){
    if (timer) {
        currentMonth = currentMonth.nextMonth(); // Previous month would be currentMonth.prevMonth()
        updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML    
        getEvents();
        timer = false;
        setTimeout(() => {
            timer = true;
        }, 1000);
    }
}, false);

// Previous Month Event Listener
document.getElementById('previous_month').addEventListener('click',function(event){
    if (timer) {
        currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
        updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML    
        getEvents();
        timer = false;
        setTimeout(() => {
            timer = true;
        }, 1000);
    }

}, false);

function updateCalendar(){
	let weeks = currentMonth.getWeeks();
    let table = document.getElementById('calendar_body');
    while (table.hasChildNodes()){
        table.removeChild(table.firstChild);
    }

    for(let w in weeks){
		let days = weeks[w].getDates();
        // days contains normal JavaScript Date objects.
        
        let row = document.createElement("tr"); 

		for(let d in days){
			// You can see console.log() output in your JavaScript debugging tool, like Firebug,
            // WebWit Inspector, or Dragonfly.
            let cell = row.insertCell(d);
            let cellText = document.createTextNode(days[d].getDate());
            let h = document.createElement("H4")
            h.appendChild(cellText);  
            h.style.marginTop = "0px";
            h.style.marginRight = "2px";
            cell.appendChild(h);
            row.appendChild(cell);
        }
        table.appendChild(row);
    }
    document.getElementById('calendar_heading').appendChild(table);
    while (document.getElementById('monthAndYear').hasChildNodes()){
        document.getElementById('monthAndYear').removeChild(document.getElementById('monthAndYear').firstChild);
    }
    const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    let name = document.createTextNode(monthNames[currentMonth.month] + ' ' + (currentMonth.year));
    document.getElementById('monthAndYear').appendChild(name);
}

// Update Calendar as soon as Page Initially Loads
document.addEventListener("DOMContentLoaded", updateCalendar, false);
document.addEventListener("DOMContentLoaded", checkSession, false);

</script>

</body>
</html>
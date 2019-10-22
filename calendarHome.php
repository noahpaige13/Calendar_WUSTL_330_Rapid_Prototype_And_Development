<!DOCTYPE html>

<head><title>Calendar</title>
<link rel="stylesheet" type="text/css" href="calendarHome.css" />
</head>
<body>
    <h1>Welcome!</h1>

<br><br>
<div id="options">
    <div id="login">

        <!-- Log In button -->
        <h3>Log In?</h3>
        Username: <br><input style ="margin: 8px 0;width:90%" type="text" id="username" placeholder="Username" /><br>
        Password: <br><input style ="margin: 8px 0;width:90%" type="password" id="password" placeholder="Password" />
        <button style="margin: 0px 8px;width:90%" id="login_btn">Log In</button>

    </div>
    <br>
    <br>
    <div id="newuser">

        <!-- Change Username button -->
        <h3>New User? Register Here!</h3>
        Username: <br><input style ="margin: 8px 0;width:90%" type="text" id="new_username" placeholder="Username" /><br>
        Password: <br><input style ="margin: 8px 0;width:90%" type="password" id="new_password" placeholder="Password" />
        <button style="margin: 0px 8px;width:90%" id="newuser_btn">Create Account</button>

    </div>
    <script type="text/javascript" src="ajax.js"></script> <!-- load the JavaScript file -->

</div>
<div id="calendar">
    <div id="add_event"><button style="margin: 0px 8px;width:20%" id="add_event_btn" >Add Event</button></div>
    <div id="add">
        Log In or Register to edit your calendar!
    </div>
    <div id="c">
        <h3 id="monthAndYear"></h3>
        <table align="center" width="700" id="calendar_heading">
            <thead >
            <tr>
                <th width="14.2857%">Sun</th>
                <th width="14.2857%">Mon</th>
                <th width="14.2857%">Tue</th>
                <th width="14.2857%">Wed</th>
                <th width="14.2857%">Thu</th>
                <th width="14.2857%">Fri</th>
                <th width="14.2857%">Sat</th>
            </tr>
            </thead>
            <tbody id="calendar_body"></tbody>
        </table>
    </div>
    <br>
    <div style="margin-left: 10px;">
        <button style="margin: 0px 8px;width:40%" id="previous_month" >Previous</button>
        <button style="margin: 0px 8px;width:40%" id="next_month" >Next</button>
    </div>
    <br/>
    
</div>

<script>
// "Calendar Math" Functions
(function(){Date.prototype.deltaDays=function(c){return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c)};Date.prototype.getSunday=function(){return this.deltaDays(-1*this.getDay())}})();
function Week(c){this.sunday=c.getSunday();this.nextWeek=function(){return new Week(this.sunday.deltaDays(7))};this.prevWeek=function(){return new Week(this.sunday.deltaDays(-7))};this.contains=function(b){return this.sunday.valueOf()===b.getSunday().valueOf()};this.getDates=function(){for(var b=[],a=0;7>a;a++)b.push(this.sunday.deltaDays(a));return b}}
function Month(c,b){this.year=c;this.month=b;this.nextMonth=function(){return new Month(c+Math.floor((b+1)/12),(b+1)%12)};this.prevMonth=function(){return new Month(c+Math.floor((b-1)/12),(b+11)%12)};this.getDateObject=function(a){return new Date(this.year,this.month,a)};this.getWeeks=function(){var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);for(c.push(a);!a.contains(b);)a=a.nextWeek(),c.push(a);return c}};

// Start at a Month
var currentMonth = new Month(2019, 9);

// Next Month Event Listener
document.getElementById('next_month').addEventListener('click',function(event){
	currentMonth = currentMonth.nextMonth(); 
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
}, false);

// Previous Month Event Listener
document.getElementById('previous_month').addEventListener('click',function(event){
	currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML    
}, false);


function updateCalendar(){
	var weeks = currentMonth.getWeeks();
    var table = document.getElementById('calendar_body');
    while (table.hasChildNodes()){
        table.removeChild(table.firstChild);
    }

    for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects.
		
        var row = document.createElement("tr"); 

		for(var d in days){
			// You can see console.log() output in your JavaScript debugging tool, like Firebug,
            // WebWit Inspector, or Dragonfly.
            
            console.log(days[d].toISOString());
            var cell = row.insertCell(d);
            var cellText = document.createTextNode(days[d].getDate());
            cell.appendChild(cellText);
            row.appendChild(cell);
        }
        table.appendChild(row);
    }
    document.getElementById('calendar_heading').appendChild(table);
    while (document.getElementById('monthAndYear').hasChildNodes()){
        document.getElementById('monthAndYear').removeChild(document.getElementById('monthAndYear').firstChild);
    }
    var name = document.createTextNode("Date: " + (currentMonth.month + 1) + ' / ' + (currentMonth.year));
    document.getElementById('monthAndYear').appendChild(name);
}

// Update Calendar as soon as Page Initially Loads
document.addEventListener("DOMContentLoaded", updateCalendar, false);
</script>
</body>
</html>
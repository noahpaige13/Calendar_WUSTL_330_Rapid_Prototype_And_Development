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
    <div id="add">
        Log In or Register to edit your calendar!
    </div>
    <div id="c">
        <h3 id="monthAndYear"></h3>
        <table id="calendar_heading">
            <thead>
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
                <!-- <tr id = 'week1'>
                </tr>
                <tr id = 'week2'>
                </tr>
                <tr id = 'week3'>
                </tr>
                <tr id = 'week4'>
                </tr>
                <tr id = 'week5'>
                </tr> -->

        </table>
        <div>
            <button style="margin: 0px 8px;width:40%" id="previous_month" >Previous</button>
            <button style="margin: 0px 8px;width:40%" id="next_month" >Next</button>
        </div>
        <br/>
    </div>
    
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
    alert("The new month is "+currentMonth.month+" "+currentMonth.year);
    document.getElementById('monthAndYear').innerHTML = (currentMonth.month + 1) + ' / ' + currentMonth.year;
    // document.getElementById('calendar_heading').innerHTML = (currentMonth.month + 1) + ' / ' + currentMonth.year;
}, false);

    // Previous Month Event Listener
document.getElementById('previous_month').addEventListener('click',function(event){
	currentMonth = currentMonth.prevMonth(); // Previous month would be currentMonth.prevMonth()
	updateCalendar(); // Whenever the month is updated, we'll need to re-render the calendar in HTML
    alert("The new month is "+currentMonth.month+" "+currentMonth.year);
    document.getElementById('monthAndYear').innerHTML = (currentMonth.month + 1) + ' / ' + currentMonth.year;
}, false);


function updateCalendar(){

	var weeks = currentMonth.getWeeks();
    var table = document.getElementById('calendar_body');
    var Parent = document.getElementById('calendar_heading');
    while (Parent.hasChildNodes()){
        Parent.removeChild(Parent.firstChild);
    }

    // var week_count = 0
	for(var w in weeks){
		var days = weeks[w].getDates();
		// days contains normal JavaScript Date objects.
		
		alert("Week starting on "+days[0]);
        var row = table.insertRow(w);
        // week_count = week_count + 1;
        // var day_count = 0;    

		for(var d in days){
			// You can see console.log() output in your JavaScript debugging tool, like Firebug,
			// WebWit Inspector, or Dragonfly.
            console.log(days[d].toISOString());
            var cell = row.insertCell(d);
            cell.innerHTML = days[d].getDate();
            
		}
	}
}

// Update Calendar as soon as Page Initially Loads
document.addEventListener("DOMContentLoaded", updateCalendar, false);
</script>
</body>
</html>
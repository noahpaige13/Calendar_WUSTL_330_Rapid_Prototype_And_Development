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
        </table>
        <div>
            <button style="margin: 0px 8px;width:40%" id="previous_month" >Previous</button>
            <button style="margin: 0px 8px;width:40%" id="next_month" >Next</button>
        </div>
        <br/>
    </div>
    
</div>

</body>
</html>
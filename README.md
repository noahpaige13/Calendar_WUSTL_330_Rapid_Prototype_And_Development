# CSE330
455539 | 458011

Worked with Jennifer Lu

Link to Calendar: http://ec2-18-221-130-56.us-east-2.compute.amazonaws.com/~jenniferlu/module5/calendarHome.php

Customizable Calendar Site where events can be added, modified, and deleted. Users can log into the site, and they cannot view or manipulate events associated with other users. Events have a title, date, and time. All actions are performed over AJAX, without ever needing to reload the page. Other feautres include:

1. Delete User: Once a user is logged in, they can delete their account. The server side first deletes all the events associated with the user and then removes the user from the users database.

2. Priority Events: Once a user is logged in, they can click the checkbox to show all the events on thier calendar or just the ones marked as important. You can choose/edit the importance of each event with the add and edit event buttons

3. Share events between users: When editing an event (by clicking an event), you have the option to share it when one or more users. Multiple users must be split by a comma. The chosen event will then be added to the respective users' calendars.

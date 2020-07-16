# Eventer

## 1. Objective

Website for registering students for a technical event organized at your institute using PHP. Design form for students to register user event. Admin should be able to add, update and delete event details. Students can view register for events. Admin should be able to see analysis about students registered based on their branch, college of students. For analysis, you need to show output in the form of graphs.

This project is done as an assignment for LAMP (Linux Apache MySQL PHP) elective.

## 2. Introduction

This system has 2 actors:

1. Student
2. Admin

The student is able to log in, register, apply for a new password, register for an
event, change the password and logout. The admin is able to log in, add a new
event, delete an event, update the event, analyze the event by the graph
showing the number of students registered for the event branch wise and logout.

## 3. Student

### 3.1 Register

__First Name and Last Name:__ They should have only 1 capital letter and other
lowercase letters and no spaces or any other characters.

__Birthdate:__ The age of the student must be greater than or equal to 18 years.

__Roll Number:__ It must be of the regular expression
\[0-9\]\{2\}\[B\]\(IT|CE|CL|ME|EC|EE|IC|CI\)\[0-9\]\{2\}\[1-9\]

__Email id:__ Should be a proper email address and that email address should not
have been used.

__Username:__ Username does not have space and only have the following things -
“A-Z”, “a-z”, “0-9”, “.” and ”_”.

__Password:__ Password must have a minimum length of 8 and should have at least
1 uppercase letter, 1 lowercase letter, 1 numerical and 1 special character.
Passwords must match to register. Passwords stored in database are encrypted by MD5 format.

### 3.2 Login

Username and password should match the registered details. After logging in,
the Cookies are set saving the username of the user.

### 3.3 Forgot Password

Enter the registered username for a password reset. You will get a mail of new random password.

### 3.4 Register for Event

Agree to the terms for registration. It is a required field.

### 3.5 Profile

You can change password with original constraints.

## 4. Admin

### 4.1 Login

Only 2 admins:

1. admin - password
2. admin2 - password2

### 4.2 Add Event

__Event Name:__ Event Name should not be present in the database. Also, it should
not contain special characters.

__Description:__ The description of the event is required and should be less than 100
characters.

__Event Date:__ Date should be greater than today’s date.

__Event Time:__ Time should be valid.

### 4.3 Remove Event

__Event Name:__ Event Name should be present in the database.

### 4.4 Update Event

The changes should not violate the Add Event rules. This page also has a graph for analysis.

## 5. Gallary
![Login Page](/images/img1.png "Login Page")

![Register Page](/images/img2.png "Register Page")

![Forgot Password Page](/images/img3.png "Forgot Password Page")

![Home Page For Student](/images/img4.png "Home Page For Student")

![Event Register Page](/images/img5.png "Event Register Page")

![Event3 Is Now Registered](/images/img6.png "Event3 Is Now Registered")

![Student Profile Page](/images/img7.png "Student Profile Page")

![Home Page For Admin](/images/img8.png "Home Page For Admin")

![Add Event Page](/images/img9.png "Add Event Page")

![Remove Event Page](/images/img10.png "Remove Event Page")

![Update Event And Analysis Page](/images/img11.png "Update Event And Analysis Page")

![Showing The Data As Pop Up In Graph](/images/img12.png "Showing The Data As Pop Up In Graph")

![New Event Added By Admin](/images/img13.png "New Event Added By Admin")

![Showing New Event To Student](/images/img14.png "Showing New Event To Student")

![Removing Event3](/images/img16.png "Removing Event3")

![Event3 Removed From Admin Page](/images/img17.png "Event3 Removed From Admin Page")

![Event3 Removed From Student Home Page](/images/img18.png "Event3 Removed From Student Home Page")
## 6. Run

To run the site on localhost, install [XAMPP](https://www.apachefriends.org/index.html) and start the server. Then go to [phpmyadmin](http://localhost/phpmyadmin/) page and import the Sessional.sql file to your database. Copy the file to htdocs folder in the XAMPP(windows)/lampp(linux) folder and open the site [login.php](http://localhost/login.php) on your browser If you have kept the files in the folder do add the folder name before login.php. 

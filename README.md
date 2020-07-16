# Eventer

## 1. Objective

Website for registering students for technical event organized at your institute using PHP. Design form for students to register user event. Admin should be able to add, update and delete event details. Students can view register for events. Admin should be able to see analysis about students registered based on their branch, college of students. For analysis you need to show output in the form of graphs.

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


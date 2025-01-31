# Event Management System

## Core Functionalities:

1. *Secure User Login and Registration with Password Hashing*: 
   - Users can securely log in and register with encrypted passwords.
   
2. *Role-Based Access Control*: 
   - Two roles: *ADMIN* and *NON-ADMIN*. Different access levels for each role.

3. *Admin User Management*: 
   - Admins can view the list of users.

4. *Event Management*:
   - Admins can create, update, view, and delete events with details such as:
     - Event Name
     - Event Date
     - Event Time
     - Event Ticket Price
     - Total Event Tickets

5. *Online Event Registration*:
   - Attendees can register for events through an online form.

6. *Capacity Limit*:
   - Prevents registration beyond the maximum capacity for each event.

7. *Event Display*:
   - Events are displayed using pagination, with sortable, and make filterable(by category).

8. *Download Attendee List*:
   - Admins can download the attendee list for specific events in CSV format.

9. *Search Functionality*:
   - Implemented search functionality for users, events, and attendee registration pages.

---

## Installation Instructions

### Prerequisites:

- Web Server (e.g., Apache, MySQL)
- PHP 8.2
- MySQL Server

### 1. Create a Database:

   - Create a new database in MySQL.
   - Import the provided SQL file into your database.

### 2. Configure Database Credentials:

   - Update the database connection credentials in the config.php file to match your database settings.

### 3. Login Credentials (for testing):

   - *Admin*:
     - Username: admin
     - Password: admin123
   - *NON-ADMIN*:
     - Username: b
     - Password: b
   - *NON-ADMIN*:
     - Username: c
     - Password: c

---
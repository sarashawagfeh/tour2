# Tour Booking Platform

A full-stack **Tour Booking Platform** developed as part of my E-Business course.

The project simulates a real-world travel e-commerce system where users can browse travel services and packages, add bookings to a cart, and complete the booking process through a simulated PayPal sandbox payment.

## Overview

The platform provides two main roles: **Admin** and **User**.

Users can explore available travel services and packages, manage their bookings, and complete the booking workflow. Administrators have access to a dashboard where they can manage users, services, and packages, as well as monitor booking and revenue data through interactive charts.

## Key Features

* Complete booking workflow:

  * Package selection
  * Add to cart
  * Payment
  * Booking confirmation
* User and Admin role-based access control
* Admin dashboard
* User management
* Travel services management
* Travel packages management
* Booking and revenue analytics
* Interactive data visualization using Chart.js
* Simulated PayPal Sandbox payment integration
* Relational database for storing users, services, packages, bookings, and payment information

## Technologies Used

### Backend

* PHP
* MySQL

### Frontend

* HTML
* CSS
* Bootstrap
* JavaScript

### Data Visualization

* Chart.js

### Development Environment

* XAMPP
* Apache
* MySQL

### Payment

* PayPal Sandbox

## System Workflow

```text
Browse Travel Packages
        ↓
Select Package
        ↓
Add to Cart
        ↓
Review Booking
        ↓
PayPal Sandbox Payment
        ↓
Booking Confirmation
```

## Admin Dashboard

The admin dashboard provides tools for managing the main components of the platform, including:

* Users
* Travel services
* Travel packages
* Bookings
* Revenue data
* Booking statistics

The dashboard also uses interactive charts to visualize business data and provide insights into bookings and revenue.

## Database

The system uses **MySQL** as its relational database.

The database stores and manages information related to:

* Users
* Roles
* Travel services
* Travel packages
* Bookings
* Cart items
* Payments

The relational database structure helps maintain organized data and relationships between the different components of the system.

## Project Structure

```text
Tour/
│
├── admin/              # Admin dashboard and management pages
├── user/               # User-related pages
├── assets/             # CSS, JavaScript, images, and other assets
├── config/             # Database/configuration files
├── includes/           # Shared PHP components
├── cart/               # Shopping cart functionality
├── payment/            # Payment-related functionality
├── booking/            # Booking workflow
└── index.php           # Main entry point
```

> The exact folder structure may vary depending on the final project version.

## How to Run the Project

### 1. Install XAMPP

Download and install [XAMPP](https://www.apachefriends.org/) on your computer.

### 2. Clone the Repository

```bash
git clone https://github.com/your-username/your-repository-name.git
```

### 3. Move the Project

Copy the project folder into:

```text
C:\xampp\htdocs\
```

### 4. Start XAMPP

Open XAMPP Control Panel and start:

* Apache
* MySQL

### 5. Set Up the Database

1. Open phpMyAdmin.
2. Create a new database.
3. Import the provided `.sql` database file.
4. Update the database configuration in the project if necessary.

### 6. Run the Application

Open your browser and go to:

```text
http://localhost/Tour/
```

## Learning Outcomes

Through this project, I applied practical concepts related to:

* E-Business system design
* Full-stack web development
* Relational database modeling
* CRUD operations
* Role-based access control
* E-commerce workflows
* Payment integration
* Data flow modeling
* Business intelligence
* Data visualization

## Future Improvements

Possible future improvements include:

* Real payment gateway integration
* Online booking availability
* Email booking confirmations
* Advanced search and filtering
* Customer reviews and ratings
* Improved security and authentication
* Cloud deployment

## Author

**Sara Shawagfeh**

Developed as part of the **E-Business Course**.

---

### Tags

`PHP` `MySQL` `HTML` `CSS` `Bootstrap` `JavaScript` `Chart.js` `E-Commerce` `Web Development` `E-Business`

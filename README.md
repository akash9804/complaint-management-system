# Complaint Management System (Laravel + React)

A full-stack complaint management system built with **Laravel 10 (backend)** and **React.js (frontend)** using **JWT-based authentication**.

---

## Project Overview

- Users can register, login, and submit complaints.
- Admins can view and update the status of complaints.
- Authenticated and role-based access.
- RESTful APIs with secure JWT token usage.
- MySQL as the database.

---

## Tech Stack

- **Frontend**: React.js, Axios, Bootstrap 4
- **Backend**: Laravel 10, tymon/jwt-auth, MySQL
- **Auth**: JWT Token (stored in localStorage)
- **API**: RESTful, role-based

---

## Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/akash9804/complaint-management-system.git
cd complaint-management-system

# Backend Setup (/backend)
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan serve

# Configure .env with your database credentials and JWT secret.
Frontend Setup (/frontend)
cd ../frontend
npm install
cp .env.example .env

# Set the API base URL in .env:

VITE_API_URL=http://localhost:8000/api

# Then run:

npm run dev

# Login Credentials
Admin Email: admin@example.com
User Email: user@example.com
Password: password


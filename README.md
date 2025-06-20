<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>



---

# 🧠 Laravel HRM System

A Human Resource Management System built with **Laravel** and **Blade**, featuring user role management with **Spatie**, staff attendance, leave management, and much more.

---

## 🚀 Features

- 👥 Employee Management (Create, Edit, View)
- 🏢 Department Management
- 🏷️ Designation Management
- 🧑‍⚖️ Role & Permission System (Spatie)
- 🔒 Multiple Login Systems based on Role (Admin, Staff, etc.)
- 🛫 Leave Management System (Apply, Approve/Reject)
- 🕒 Staff Attendance System (Clock In/Out with Time Tracking)
- 📊 Dashboard with Overview
- ✅ Simple and User-Friendly Interface

---

## 🛠️ Tech Stack

- Laravel (Blade Templating)
- Spatie Laravel Permission Package
- Bootstrap (UI)
- MySQL / MariaDB

---

## 📦 Installation

```bash
git clone https://github.com/laraib15/hrm-laravel.git
cd your-repo-name
composer install
cp .env.example .env
php artisan key:generate

## 🔐 Admin Login

After Configure .env file and seeding the database, the default admin credentials are:

```txt
Email: admin@example.com
Password: password

You can change these in the `UserSeeder` or from the UI after login.

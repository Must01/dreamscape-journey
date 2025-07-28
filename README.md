# DreamScape Journey

A modern travel booking platform built with Laravel, allowing users to discover and book unique travel experiences.

<img width="1868" height="955" alt="image" src="https://github.com/user-attachments/assets/4ef098f3-8fe4-41b1-9fb4-d85b50a30e38" />


## Features

- **User Authentication**
  - User registration and login
  - Admin and regular user roles
  - Profile management with avatar support

- **Destination Management**
  - Browse travel destinations
  - Detailed destination views with photos
  - Admin can create, edit, and delete destinations
  - Support for multiple photos per destination

- **Booking System**
  - Simple booking process
  - View booking history
  - Booking status tracking
  - Price calculation based on travelers

## Tech Stack

- Laravel 10
- PHP 8.2
- MySQL
- HTML/CSS
- JavaScript

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/dreamscape-journey.git
cd dreamscape-journey
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure database in `.env`:

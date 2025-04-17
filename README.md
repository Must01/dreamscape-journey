# DreamScape Journey

A modern travel booking platform built with Laravel, allowing users to discover and book unique travel experiences.

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

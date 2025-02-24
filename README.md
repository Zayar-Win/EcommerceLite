# Laravel + Vue.js (Inertia.js) Setup

## Introduction

This project is a full-stack web application using **Laravel** as the backend framework and **Vue.js** as the frontend, connected via **Inertia.js**. This setup allows Vue to function as the templating engine for Laravel while maintaining a single-page application (SPA) experience.

## Prerequisites

Ensure you have the following installed on your system:

- PHP 8.x
- Composer
- Node.js & npm
- Laravel CLI
- PostgreSQL or MySQL (or SQLite)

## Installation

### 1. Get the GitHub repository URL and clone the repository

````sh
#### How to get the GitHub repository URL
1. Navigate to your repository on GitHub.
2. Click the green "Code" button.
3. Copy the HTTPS

```sh
git clone https://github.com/your-repo/your-project.git
cd your-project
````

### 2. Install PHP dependencies

```sh
composer install
```

### 3. Install JavaScript dependencies

```sh
npm install
```

### 4. Set up environment file

```sh
cp .env.example .env
```

Update your `.env` file with database credentials and other necessary configurations.

#### MySQL Setup in `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 5. Generate application key

```sh
php artisan key:generate
```

### 6. Run migrations and seeders (if any)

```sh
php artisan migrate --seed
```

### 7. Build frontend assets and start the Laravel server

```sh
npm run dev  # For development
php artisan serve  # Start Laravel server
```

## Now, visit `http://localhost:8000` in your browser.

## Support

For issues or improvements, feel free to create an issue or pull request!


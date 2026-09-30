<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# QuickPost

QuickPost is a Laravel web application for writing content once and scheduling it
everywhere. This repository is built as part of a Web Framework course assignment,
covering the fundamentals of Laravel routing and Blade templating.

# Tech Stack

- PHP ^8.3
- Laravel ^13.17
- Tailwind CSS v4
- Vite

# How to run

1. Install PHP dependencies:

   ```sh
   composer install
   ```

2. Create the environment file and generate the application key:

   ```sh
   copy .env.example .env
   php artisan key:generate
   ```

3. Install JavaScript dependencies:

   ```sh
   npm install
   ```

4. Start the Vite development server (keep it running in a separate terminal):

   ```sh
   npm run dev
   ```

5. Start the Laravel development server:

   ```sh
   php artisan serve
   ```

6. Open the application in your browser at `http://localhost:8000`.

# Who's Build

This project was built by:

- **Agil Razzan Murtadha** — NIM 2410120002
- **Belvito Raditya** — NIM 2410120006

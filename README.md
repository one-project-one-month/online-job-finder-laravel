# Laravel Project Setup Guide

## Cloning the Repository

1. Open a terminal or command prompt.
2. Navigate to the directory where you want to clone the project.
   ```sh
   cd /path/to/your/directory
   ```
3. Clone the repository using Git:
   ```sh
   git clone https://github.com/one-project-one-month/online-job-finder-laravel.git
   ```
4. Move into the project directory:
   ```sh
   cd project_name
   ```

## Installing Dependencies

1. Install PHP dependencies using Composer:
   ```sh
   composer install
   ```
2. Install JavaScript dependencies using npm:
   ```sh
   npm install
   npm run build
   ```

## Environment Configuration

1. Copy the `.env.example` file to create a new `.env` file:
   ```sh
   cp .env.example .env
   ```
2. Generate an application key:
   ```sh
   php artisan key:generate
   ```

## Database Setup

1. Update the `.env` file with your database credentials:
   ```sh
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_user
   DB_PASSWORD=your_database_password
   ```
2. Run database migrations:
   ```sh
   php artisan migrate
   ```
3. (Optional) Seed the database with sample data:
   ```sh
   php artisan db:seed
   ```

## Running the Application

Start the development server:
   ```sh
   php artisan serve --port 8000
   ```

Your Laravel project should now be up and running! <br/>
Access it via `http://127.0.0.1:8000` in your browser. <br/>
APIs will be served on `http://127.0.0.1:8000/api/v1`

## Documentation

### Postman Collection
```
project_folder/postman_collection/online_job_finder.postman_collection.json
```

### ER Diagram
https://dbdiagram.io/d/online-job-finder-67aca9cf263d6cf9a0ea2d37

### API Documentation (Swagger)
http://127.0.0.1:8000/swagger

## User Credentials

   ```
   # Admin
   admin@jobfinder.com
   Admin123!@#

   # Recruiter
   recruiter@jobfinder.com
   Recruiter123!@#

   # Applicant
   applicant@jobfinder.com
   Applicant123!@#
   ```






Happy coding!


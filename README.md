Content Scheduling System - Laravel 12
Project Overview
A robust content management system that allows users to schedule and publish posts across multiple platforms with full CRUD functionality.

#Key Features

_Full authentication system (Login/Register)
_Complete post management (Create, Read, Update, Delete)
_Platform management
_Post scheduling functionality
_Post-platform association
_Responsive Bootstrap 5 interface

#Technology Stack

_Backend: Laravel 12
_Frontend: Bootstrap 5, JavaScript
_Database: MySQL
_Authentication: Laravel Sanctum (API) / Session (Web)


#Installation Guide Prerequisites
_PHP 8.2+
_Composer 2.5+
_MySQL 8.0+


Setup Instructions
Clone the repository:
bash

git clone https://github.com/ReemMohamed110/content-scheduling.git
cd content-scheduler

Install dependencies:

bash

composer install
npm install

Configure environment:

bash
cp .env.example .env
php artisan key:generate

Database setup:
Create MySQL database
Update .env with database credentials

env
DB_DATABASE=mysql
DB_USERNAME=root
DB_PASSWORD=

Run migrations and seeders:

bash
php artisan migrate --seed

Build assets:

bash
npm run build

Start development server:

bash
php artisan serve
Access the application at: http://localhost:8000

#API 
i attach the api folder at this github repo named:
content_scheduling.postman_collection.json
# API Documentation

## Authentication
`POST /api/login` - User login
`POST /api/register` - User register
`POST /api/update profile` - update profile
`POST /api/logout` - User logout


## Posts Endpoints
- `GET /api/posts` - List all posts
- `POST /api/posts` - Create new post
- `GET /api/posts/{id}` - Get single post
- `PUT /api/posts/{id}` - Update post
- `DELETE /api/posts/{id}` - Delete post

## Platforms Endpoints
- `GET /api/platforms` - List all platforms
- `POST /api/platforms` - Create new platforms

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

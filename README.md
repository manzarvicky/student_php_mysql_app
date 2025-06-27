# Student Management System

## Overview
A simple student management system built with PHP, MySQL, HTML, and CSS. The application allows you to add and view student information.

## Features
- Add new students with name, email, phone, and address
- View list of all students
- Responsive design
- Containerized with Docker

## Prerequisites
- Docker
- Docker Compose

## Quick Start
1. Clone the repository
2. Navigate to the project directory
3. Start the application using Docker Compose:
   ```bash
   docker-compose up -d
   ```
4. Access the application at http://localhost:8000

## Docker Configuration
- PHP Application: Runs on port 8000
- MySQL Database: Runs on port 3306
- Database credentials are configured in docker-compose.yml

## Project Structure
```
├── Dockerfile           # PHP application container configuration
├── docker-compose.yml   # Multi-container Docker configuration
├── config.php          # Database connection configuration
├── database.sql        # Database schema
├── demo_data.sql       # Sample student records
├── index.html          # Main application interface
├── save_student.php    # Handle student data submission
├── get_students.php    # Fetch student records
└── style.css           # Application styling
```

## Development
To make changes to the application:
1. Modify the source files as needed
2. The changes will be reflected immediately due to volume mounting

## Stopping the Application
To stop the application:
```bash
docker-compose down
```

To stop and remove all data (including database):
```bash
docker-compose down -v
```
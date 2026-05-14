# MVC System in PHP (PHP 8.4 + HTML5UP)

A PHP web application built with the MVC architectural pattern, designed for managing online publications and content sharing. The project integrates responsive templates from HTML5 UP to provide a modern and clean user interface while maintaining a structured and scalable backend architecture.
The system features two complete CRUD modules responsible for handling publication management and user-related content, allowing full creation, visualization, updating, and deletion of records. It also includes a secure file upload system for managing images and media associated with publications.

## Technologies Used
PHP 8.4.0
HTML5 / CSS3 / JavaScript
HTML5UP Template
MySQL
XAMPP (development environment)

## Pre-requisites

Before running the project, you need to have the following installed:

PHP 8.4.0
XAMPP (or another local server)
Web browser
MySQL

## PHP 8.4.0 Installation

Windows (manual):
Access the official website:

https://www.php.net/downloads
Download PHP 8.4 Thread Safe (zip)

Extract to a folder, for example:

C:\php
Add to the system PATH:
Search for "Environment Variables"
Edit the Path

Add:

C:\php

Test in the terminal:

php -v

## XAMPP Installation

Download the XAMPP:

https://www.apachefriends.org/index.html
Install normally
Open the XAMPP Control Panel
Start:
Apache
MySQL

## Project Configuration

Clone or download this repository:

git clone https://github.com/your-username/your-project.git

Place the folder inside:

C:\xampp\htdocs\

Access in your browser:

http://localhost/your-project/public

## Features

Clear separation of layers (MVC)
Layout reuse
Scalable organization

## Security (basic)

Use of htmlspecialchars to prevent XSS
Data validation on the backend
PHP session login

## Contribution

Feel free to contribute:

Fork the project
Create a branch
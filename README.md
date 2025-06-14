# Schauwiediebaeumelaufen

A custom PHP MVC blog application for displaying artwork, nature photos, and creative content.

## Overview

This project is a small CRUD blog application that allows for posting images with formatted text. It features user authentication and a clean, responsive design. The application is built using:

- Custom PHP MVC framework
- MariaDB for database storage
- Bootstrap 4 for responsive layouts
- jQuery for DOM manipulation
- Font Awesome for icons
- Google Fonts (including Caveat font)

## Features

- **User Authentication**: Login functionality with session management
- **Blog Posts Management**: Create, read, update, and delete posts
- **Image Upload**: Upload and display images with posts
- **Responsive Design**: Mobile-friendly interface
- **Error Handling**: Custom 404 and 403 error pages
- **Security**: Password hashing, input sanitization

## Project Structure

```
├── .htaccess
├── app/
│   ├── bootstrap.php
│   ├── config/
│   ├── controllers/
│   │   ├── Pages.php
│   │   ├── Posts.php
│   │   └── Users.php
│   ├── helpers/
│   │   ├── image_helper.php
│   │   ├── session_helper.php
│   │   └── url_helper.php
│   ├── libraries/
│   │   ├── controller.php
│   │   ├── core.php
│   │   └── database.php
│   ├── models/
│   │   ├── Post.php
│   │   └── User.php
│   └── views/
│       ├── inc/
│       │   ├── header.php
│       │   └── footer.php
│       ├── pages/
│       ├── posts/
│       └── users/
├── public/
│   ├── css/
│   │   └── style.css
│   ├── images/
│   │   ├── img/
│   │   └── storage/
│   ├── js/
│   │   └── main.js
│   └── index.php
└── [error pages]
    ├── forbidden403.html
    └── notfound404.html
```

## Installation

1. Clone the repository
2. Set up a virtual host pointing to the project directory
3. Create a MariaDB database
4. Configure database connection in config.php:

```php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'your_database_name');

// App Root
define('APPROOT', dirname(dirname(__FILE__)));
// URL Root
define('URLROOT', 'http://your-domain.com');
// Site Name
define('SITENAME', 'Schau wie die Bäume laufen');
// App Version
define('APPVERSION', '1.0.0');
```

5. Navigate to the URL of your virtual host

## Usage

### User Authentication

- Login through `/users/login`
- User registration is disabled in the current version (commented out)

### Blog Management

- View all posts at `/posts`
- Create new posts at `/posts/add`
- Edit posts at `/posts/edit/{id}`
- Delete posts through the post detail page
- View single post at `/posts/show/{id}`

## Technology Stack

- **Backend**: Custom PHP MVC framework
- **Database**: MariaDB with PDO
- **Frontend**: 
  - Bootstrap 4
  - jQuery
  - Font Awesome
  - Google Fonts
- **Content Editing**: Image upload and text formatting
- **Session Management**: PHP sessions

// ...existing code...
## Credits

Developed by Karsten Tauchert for Aline Tauchert's artwork blog.

Special thanks to Brad Traversy of Traversy Media for inspiration and educational content that helped shape this project.
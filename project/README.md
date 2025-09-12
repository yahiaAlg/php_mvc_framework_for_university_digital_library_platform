# Digital Library - PHP MVC Framework

A comprehensive PHP MVC framework for managing university graduation projects and theses, organized by academic specializations.

## Features

- **MVC Architecture**: Clean separation of concerns with Model-View-Controller pattern
- **User Authentication**: Secure registration and login system with role-based access
- **Project Management**: Upload, edit, delete, and browse graduation projects
- **Advanced Search**: Search by keywords, specialization, author, or title
- **File Management**: Secure file upload and download system
- **Responsive Design**: Mobile-friendly interface using Bootstrap 5
- **Admin Panel**: Administrative dashboard for managing users and specializations

## Project Structure

```
project-root/
├── config/              # Configuration files
│   ├── database.php     # Database configuration
│   ├── app.php         # Application settings
│   └── routes.php      # Route definitions
├── core/               # Framework core classes
│   ├── Application.php # Main application bootstrap
│   ├── Controller.php  # Base controller class
│   ├── Model.php       # Base model class
│   ├── View.php        # Template rendering engine
│   ├── Router.php      # URL routing system
│   ├── Database.php    # Database connection and queries
│   ├── Session.php     # Session management
│   └── Validator.php   # Form validation and sanitization
├── controllers/        # Application controllers
├── models/            # Data models
├── views/             # View templates
├── public/            # Public web files
└── schema/            # Database schema
```

## Requirements

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- PDO MySQL extension

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd digital-library
   ```

2. **Set up the database**
   - Create a MySQL database named `digital_library`
   - Import the schema from `schema/database.sql`
   ```bash
   mysql -u root -p digital_library < schema/database.sql
   ```

3. **Configure the application**
   - Copy environment variables or modify `config/database.php`
   - Set database credentials and other settings

4. **Set up file permissions**
   ```bash
   chmod 755 public/uploads/
   chmod 644 public/uploads/*
   ```

5. **Configure web server**
   - Point document root to the `public/` directory
   - Enable URL rewriting (mod_rewrite for Apache)

## Configuration

### Database Configuration

Edit `config/database.php`:

```php
return [
    'host' => 'localhost',
    'dbname' => 'digital_library',
    'username' => 'your_username',
    'password' => 'your_password',
    'charset' => 'utf8mb4',
];
```

### Application Settings

Edit `config/app.php`:

```php
return [
    'name' => 'University Digital Library',
    'url' => 'http://your-domain.com',
    'upload_path' => 'public/uploads/',
    'allowed_file_types' => ['pdf', 'doc', 'docx'],
    'max_file_size' => 10485760, // 10MB
];
```

## Usage

### Default Accounts

After running the database schema, you can log in with:

- **Admin Account**
  - Email: `admin@university.edu`
  - Password: `admin123`

- **Student Account**
  - Email: `john.doe@student.university.edu`
  - Password: `password123`

### Adding Routes

Add new routes in `config/routes.php`:

```php
'/your-route' => ['YourController', 'yourMethod'],
'/your-route/(\d+)' => ['YourController', 'yourMethodWithParam'],
```

### Creating Controllers

Extend the base Controller class:

```php
class YourController extends Controller
{
    public function yourMethod(): void
    {
        $this->render('your-view', [
            'title' => 'Your Page Title',
            'data' => $your_data
        ]);
    }
}
```

### Creating Models

Extend the base Model class:

```php
class YourModel extends Model
{
    protected string $table = 'your_table';
    protected array $fillable = ['column1', 'column2'];
}
```

## Security Features

- **Password Hashing**: Uses PHP's `password_hash()` and `password_verify()`
- **SQL Injection Prevention**: Prepared statements with parameter binding
- **XSS Protection**: Input sanitization and output escaping
- **CSRF Protection**: Form validation and session management
- **File Upload Security**: File type validation and secure storage
- **Role-based Access**: User roles and permission checking

## File Upload

The system supports secure file uploads with:

- **Allowed Types**: PDF, DOC, DOCX
- **Size Limit**: 10MB (configurable)
- **Security**: File type validation and virus scanning
- **Storage**: Organized file structure with unique naming

## Database Schema

The system includes the following main tables:

- **users**: User accounts and authentication
- **specializations**: Academic specializations
- **projects**: Graduation projects and theses
- **categories**: Project categorization
- **project_categories**: Many-to-many relationship

## API Endpoints

The system uses server-side rendering with the following routes:

- `GET /` - Home page
- `GET /projects` - Browse projects
- `GET /projects/{id}` - Project details
- `POST /projects/upload` - Upload project
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Registration form
- `POST /register` - Process registration

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source and available under the [MIT License](LICENSE).

## Support

For support or questions, please contact the development team or create an issue in the repository.
# Every27 - Payroll Management Platform

Every27 is a Nigerian payroll management platform built with CodeIgniter 4. It enables companies to manage employee salaries, process payroll, handle salary advances, and facilitate seamless fund transfers.

## Features

- **Multi-tenant System**: Separate dashboards for Admin, Companies, and Employees
- **Company Management**: Register, verify, and manage companies
- **Employee Management**: Add employees, manage salaries, track attendance
- **Payroll Processing**: Run monthly payroll with automatic deductions
- **Salary Advances**: Employees can request advances (up to 50% of salary)
- **Wallet System**: Digital wallets for companies and employees
- **Fund Transfers**: Bank transfer integration for withdrawals
- **Email Notifications**: Automated emails for all transactions

## Requirements

- PHP 8.1 or higher
- MySQL 5.7+ or MariaDB 10.3+
- Composer
- Apache with mod_rewrite enabled (or use PHP built-in server)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/gsoftinteractive/every27.git
cd every27
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Configure Environment

Copy the environment file and configure it:

```bash
cp env .env
```

Edit `.env` and update the following:

```ini
# App Settings
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost/every27/public/'

# Database Settings
database.default.hostname = localhost
database.default.database = every27
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix = e27_
database.default.port = 3306
```

### 4. Create Database

Create a MySQL database named `every27`:

```sql
CREATE DATABASE every27 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 5. Run Migrations

```bash
php spark migrate
```

### 6. Seed Default Data

```bash
php spark db:seed AdminSeeder
php spark db:seed SettingsSeeder
```

### 7. Set Directory Permissions

Ensure the `writable` directory is writable:

```bash
chmod -R 777 writable/
```

On Windows (XAMPP), this is usually not needed.

## Running the Application

### Option 1: Using XAMPP/Apache

1. Place the project in your `htdocs` folder
2. Access via: `http://localhost/every27/public/`

### Option 2: Using PHP Built-in Server

```bash
php spark serve
```

Access via: `http://localhost:8080`

## Default Login Credentials

### Admin Panel
- **URL**: `/admin/login`
- **Email**: `admin@every27.com`
- **Password**: `admin123`

### Company Portal
- **URL**: `/company/login`
- Companies are created via admin panel or access request form

### Employee Portal
- **URL**: `/employee/login`
- Employees are added by their company

## Project Structure

```
every27/
├── app/
│   ├── Config/          # Configuration files
│   ├── Controllers/     # Application controllers
│   │   ├── Admin/       # Admin dashboard controllers
│   │   ├── Company/     # Company portal controllers
│   │   └── Employee/    # Employee portal controllers
│   ├── Database/
│   │   ├── Migrations/  # Database migrations
│   │   └── Seeds/       # Database seeders
│   ├── Filters/         # Request filters (auth middleware)
│   ├── Models/          # Database models
│   ├── Services/        # Business logic services
│   └── Views/           # View templates
│       ├── admin/       # Admin views
│       ├── company/     # Company views
│       ├── employee/    # Employee views
│       └── layouts/     # Layout templates
├── public/              # Public web root
│   ├── assets/          # CSS, JS, images
│   ├── index.php        # CI4 entry point
│   └── home.php         # Landing page
├── writable/            # Writable directory (logs, cache, uploads)
└── tests/               # Unit tests
```

## Key URLs

| Portal | Login URL | Dashboard URL |
|--------|-----------|---------------|
| Admin | `/admin/login` | `/admin/dashboard` |
| Company | `/company/login` | `/company/dashboard` |
| Employee | `/employee/login` | `/employee/dashboard` |

## API Endpoints

The platform includes REST-like endpoints for:

- Companies: `/admin/companies`
- Employees: `/admin/employees`
- Payroll: `/admin/payroll`
- Transactions: `/admin/transactions`
- Access Requests: `/admin/access-requests`

## Database Tables

- `e27_admin_users` - Admin accounts
- `e27_companies` - Registered companies
- `e27_employees` - Company employees
- `e27_wallets` - Digital wallets
- `e27_transactions` - All financial transactions
- `e27_payroll_runs` - Payroll processing records
- `e27_payroll_items` - Individual payroll line items
- `e27_salary_advances` - Advance requests
- `e27_withdrawal_requests` - Bank withdrawal requests
- `e27_funding_requests` - Company funding requests
- `e27_access_requests` - Company registration requests
- `e27_settings` - Platform settings

## Email Configuration

Configure SMTP in `.env` for email notifications:

```ini
email.protocol = smtp
email.SMTPHost = smtp.example.com
email.SMTPUser = your-email@example.com
email.SMTPPass = your-password
email.SMTPPort = 587
email.SMTPCrypto = tls
```

## Troubleshooting

### "Class not found" errors
Run `composer dump-autoload`

### Database connection issues
Verify your `.env` database settings match your MySQL configuration

### 404 errors on routes
Ensure mod_rewrite is enabled and `.htaccess` files are being read

### Permission denied errors
Check that `writable/` directory has proper permissions

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## License

This project is proprietary software. All rights reserved.

## Support

For support, email: business@every27.com

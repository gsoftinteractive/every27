# Every27 - Project Context for Claude

> **Quick Start**: Read this file first when resuming work on Every27.

## Project Overview

**Every27** is a payroll management platform for Nigerian companies that automates salary payments on the 27th of every month.

- **Production URL**: https://every27.com
- **GitHub Repo**: https://github.com/gsoftinteractive/every27.git
- **Local Dev**: XAMPP (c:\Users\HP\Documents\xampp\htdocs\every27)

## Business Model

1. **Invite-only registration** - Companies request access, submit CAC documents for verification
2. **Monthly access fee**: ₦1,500 per employee
3. **Auto-payment**: Salaries processed automatically on the 27th
4. **Company wallets**: Funded via XpressPayments or bank transfer
5. **Employee wallets**: Receive salaries, can withdraw anytime
6. **Salary advance**: Employees can request up to 75% of salary (7% transaction fee)

## Brand

- **Primary Color**: #0E84F1 (blue)
- **Secondary Color**: #DFEBF7 (light blue)
- **Logo**: public/assets/images/every27.svg

## Tech Stack

| Component | Technology |
|-----------|------------|
| Frontend | Plain PHP 8+ |
| Backend | CodeIgniter 4 (planned) |
| Server | Apache with .htaccess |
| Database | MySQL (not yet set up) |
| Email | PHP mail() (working on production) |
| Payments | XpressPayments API (planned) |

## Current Status

### Completed (Frontend)
- 13 public PHP pages with responsive design
- Clean URLs (no .php extension visible)
- Request access form with email notifications
- Documentation (handbook, partnership agreement)
- .htaccess URL rewriting

### Not Started (Backend)
- CodeIgniter 4 setup
- Database schema
- User authentication (company/employee/admin)
- Dashboard interfaces
- Wallet system
- Payment integration
- Transactional emails (Gmail SMTP)

## Project Structure

```
every27/
├── .gitignore
├── CLAUDE_CONTEXT.md          <-- You are here
├── includes/
│   ├── header.php             # Main navigation
│   └── footer.php             # Footer with links
└── public/
    ├── .htaccess              # URL rewriting rules
    ├── index.php              # Homepage
    ├── about.php
    ├── features.php
    ├── pricing.php
    ├── faq.php
    ├── contact.php
    ├── help.php
    ├── login.php              # Login form (no backend yet)
    ├── request-access.php     # Company registration form
    ├── process-request.php    # Form handler with email
    ├── terms.php
    ├── privacy.php
    ├── cookies.php
    ├── security.php
    ├── assets/
    │   ├── css/style.css
    │   ├── js/main.js
    │   └── images/every27.svg
    └── docs/
        ├── Every27_Handbook.html
        ├── Every27_Handbook.md
        └── Every27_Partnership_Agreement.md
```

## Key Technical Details

### URL Rewriting (.htaccess)
```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.php [L]
```

### Navigation Links (no .php extension)
- Home: `href="/"`
- Other pages: `href="about"`, `href="features"`, etc.

### Email Configuration
- Request access emails go to: business@every27.com
- PHP mail() is working on production
- Gmail SMTP planned for transactional emails

## Next Steps for Backend

1. Install CodeIgniter 4
2. Set up MySQL database with tables:
   - companies (with verification status)
   - employees
   - wallets (company and employee)
   - transactions
   - salary_advances
   - payroll_runs
3. Build authentication system
4. Create dashboards (admin, company, employee)
5. Integrate XpressPayments API
6. Set up automated payroll job for the 27th

## Important Notes

- .claude/ folder is in .gitignore (keep Claude usage private)
- All internal links have .php extension removed
- Handbook logo uses relative path: `../assets/images/every27.svg`
- Production emails working via PHP mail()

---

*Last updated: January 2026*
*This file helps Claude understand project context quickly.*

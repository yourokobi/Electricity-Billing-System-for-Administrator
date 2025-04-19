ELECTRICITY BILLING SYSTEM – ADMIN 
=========================================

DESCRIPTION
-----------
This project is a web-based electricity billing system built for administrator use. 
It allows admins to manage customer accounts, generate and track bills, handle support 
tickets, perform system maintenance, and view analytics reports. Developed using PHP, 
MySQL, and custom CSS for an intuitive, user-friendly interface.

FEATURES
--------
- Admin login/logout with session management
- Add, edit, and delete customer/user accounts
- Bill generation and payment notification modules
- View analytics and generate billing reports
- Support ticket dashboard for customer service
- System maintenance and configuration controls
- Clean, responsive UI with themed backgrounds

HOW TO RUN
----------
1. Install a local server (XAMPP/MAMP) with PHP and MySQL
2. Place all project files in the `htdocs` folder
3. Configure database connection in `config.php` or `db_connection.php`
4. Start Apache and MySQL from your control panel
5. Access the system at `http://localhost/login.php`

REQUIREMENTS
------------
- PHP 7.x or higher
- MySQL database
- Apache Web Server
- Background images (`.png`) for UI styling
- CSS file (`styles.css`) for interface design

KEY FILES
---------
- `login.php`, `signup.php`, `logout.php`         : Authentication system
- `admin_dashboard.php`, `user_management.php`    : Admin overview and user control
- `add_user.php`, `edit_user.php`, `delete_user.php` : User CRUD operations
- `generate_report.php`, `reports_analytics.php`  : Billing and analytics
- `payment_notifications.php`                     : Payment tracking
- `support_tickets.php`, `customer_service.php`   : Support handling
- `system_maintenance.php`                        : Admin configuration
- `styles.css`                                    : UI design

CREDITS
-------
Developed as a backend system for administrative control over electricity billing services.

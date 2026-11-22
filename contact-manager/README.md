# Contact Manager (Custom PHP MVC, no frameworks)

Small contact manager with full CRUD and a single admin login.
Anyone can view contacts; only the logged-in admin can add, edit or delete.

## Setup
1. Requires PHP 8+ and MySQL.
2. Import the schema: `mysql -u root -p < sql/schema.sql`
3. Copy `config/config.example.php` to `config/config.php` and set your DB credentials.
4. Create the admin user: `php scripts/create_admin.php`
5. Run: `php -S localhost:8000` from the project folder, then open http://localhost:8000

## Structure
```
index.php        front controller + route whitelist
config/          PDO connection, credentials (config.php is git-ignored)
core/helpers.php escaping, CSRF, auth helpers, render()
models/          Contact.php, User.php (all SQL lives here)
controllers/     ContactController.php, AuthController.php
views/           layout + contacts/ + auth/ templates
sql/schema.sql   tables
scripts/         create_admin.php (hashes the password)
```

## Security list
| Measure | Where |
|---|---|
| PDO prepared statements, emulation off, no user input concatenated into SQL | models/ |
| Output escaping with `htmlspecialchars` (helper `e()`) against XSS | views/ |
| Passwords hashed with `password_hash` / checked with `password_verify` | User.php, AuthController |
| No default or plain-text password in the repo | scripts/create_admin.php |
| Server-side validation (required, length, `FILTER_VALIDATE_EMAIL`, phone regex) | ContactController |
| CSRF tokens on every POST form, checked with `hash_equals` | helpers.php |
| Add/edit/delete are POST-only; GET routes cannot change data | index.php route table |
| Authorization checked in controllers (`require_login()`), not just hidden in views | ContactController |
| `session_regenerate_id(true)` on login (session fixation); HttpOnly + SameSite cookie | AuthController, index.php |
| Generic login error message (no user enumeration) | AuthController |
| Route whitelist; unknown routes return 404 | index.php |
| DB errors logged, not shown to users; DB config git-ignored | database.php, .gitignore |

Known limitations: no login rate limiting; no HTTPS enforcement (use HTTPS in production).

## Progress log
- (1/11/2026): Created the project structure.
- (3/11/2026): Created the MySQL database and tables.
- (8/11/2026): Implemented contact CRUD operations.
- (15/11/2026): Added login and security features.
- (21/11/2026): Tested the system and completed the project.

## Integrity statement
I, [Abdulaziz Altamimi, 202206021], declare that this submission is my own work except where stated below.

**Sources used:** [lecture notes topics, php.net PDO docs]

## AI assistance
I used Claude to generate the initial project code. I read, tested, understood and modified the system
Signed: Abdulaziz Altamimi  Date: 22/11/2026

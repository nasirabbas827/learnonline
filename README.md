# LearnOnline_final

A lightweight web‑based learning platform built with PHP. It provides administrators with tools to manage users, lessons, and exercises, while learners can register, take quizzes, and track their progress.

---

## Overview

LearnOnline_final is a simple e‑learning system designed for small‑to‑medium educational sites. Administrators can create and edit lessons, add exercises, and view results. Learners can register, update their profiles, take quizzes, and view lesson content. The project is organized into a clear folder structure with reusable components (navbar, CSS, configuration) to make future extensions straightforward.

---

## Features

| Admin | Learner |
|-------|---------|
| Secure admin login/logout | User registration & login |
| Add / edit / delete users | Update personal profile |
| Create, edit, delete lessons | View lesson content |
| Add, edit, delete exercises | Take quizzes (multiple‑choice) |
| View quiz results per user | Submit quiz answers |
| Centralized navigation bar | Contact support page |
| Exportable database schema (`learn_db.sql`) | Responsive UI (CSS) |

---

## Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | PHP 7.4+ |
| Database | MySQL (schema in `Database/learn_db.sql`) |
| Front‑end | HTML5, CSS3 |
| Server | Apache / Nginx (LAMP stack) |
| Version control | Git |

---

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/yourusername/LearnOnline_final.git
   cd LearnOnline_final
   ```

2. **Set up the database**

   - Create a new MySQL database (e.g., `learn_online`).
   - Import the schema:

     ```bash
     mysql -u your_user -p learn_online < Database/learn_db.sql
     ```

3. **Configure the application**

   - Copy `config.sample.php` to `config.php` (if a sample exists) or edit `config.php` directly.
   - Update the following constants with your environment values:

     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'learn_online');
     define('DB_USER', 'YOUR_DB_USERNAME');
     define('DB_PASS', 'YOUR_DB_PASSWORD');
     define('API_KEY', 'YOUR_OWN_API_KEY'); // replace if any external API is used
     ```

4. **Set up the web server**

   - Place the project inside your web root (e.g., `/var/www/html/learnonline`).
   - Ensure the `admin/` directory is not publicly browsable (use `.htaccess` or server config).
   - Restart Apache/Nginx.

5. **Install dependencies (optional)**

   The project does not rely on Composer packages, but you may add them later.

---

## Usage

### Administrator

1. Navigate to `admin/admin_login.php`.
2. Log in with the admin credentials created during the database import.
3. Use the admin navigation bar to:
   - Add / edit users (`add_user.php`, `edit_user.php`).
   - Manage lessons (`add_lesson.php`, `view_lessons.php`).
   - Manage exercises (`add_exercise.php`, `view_exercises.php`).
   - View results (`view_results.php`).

### Learner

1. Open `index.php` and click **Register** or **Login**.
2. After authentication, you can:
   - Update your profile (`update_profile.php`).
   - Browse lessons (`view_lesson.php`).
   - Take quizzes (`take_quiz.php`) and submit answers (`submit_quiz.php`).
   - Contact support (`contact_support.php`) if needed.

### Common Commands

- **Logout** – `logout.php` (admin) or `logout.php` (user) ends the session.
- **Reset password** – Implemented via `
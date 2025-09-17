 # Career Gate – Job Portal (PHP/MySQL)

A simple job portal with three user roles: **Admin**, **Employer**, and **Job Seeker**.  
The system provides job posting, user management, applications, and resume upload features.

---

## Features
- User authentication (Employers / Job Seekers) with session management.
- **Admin panel** to manage users and job postings.
- **Employer panel** to create and manage jobs, and view applicants.
- **Job seeker panel** to browse jobs, apply, and upload resumes.
- File upload support (`uploads/` with subfolder `uploads/resumes/`).
- Basic front pages: home, job details, registration.

---

## Tech Stack
- PHP 7.4+ (compatible with 8.x)
- MySQL / MariaDB
- Web server (Apache/Nginx or PHP built-in server)
- HTML / CSS / JavaScript

---

## Project Structure
  CAREER_GATE_WEBSITE/
├─ .vscode/
│ └─ launch.json
├─ admin_panel/
│ ├─ admin_dashboard.php
│ ├─ change_user_type.php
│ ├─ delete_job.php
│ ├─ delete_user.php
│ ├─ login.php
│ ├─ logo.png
│ ├─ manage_jobs.php
│ └─ manage_users.php
├─ css/
│ ├─ add_job.css
│ ├─ admin_dashboard.css
│ ├─ browes_jobs.css
│ ├─ edit_job.css
│ ├─ employer_dashboard.css
│ ├─ header.css
│ ├─ home.css
│ ├─ job_details.css
│ ├─ jobSeeker_dashboard.css
│ ├─ manage_job.css
│ ├─ manage_user.css
│ ├─ my_applications.css
│ ├─ styles.css
│ └─ updateAccountStyle.css
├─ database/
│ └─ job_portal_v2.sql
├─ employer_panel/
│ ├─ employer_dashboard.php
│ ├─ loginCompany.php
│ ├─ logo.png
│ ├─ my_jobs.php
│ └─ view_applicants.php
├─ jobseeker_panel/
│ ├─ apply_job.php
│ ├─ browse_jobs.php
│ ├─ job_details.php
│ ├─ jobseeker_dashboard.php
│ ├─ logo.png
│ ├─ my_applications.php
│ ├─ update_account.php
│ └─ upload_cv.php
├─ uploads/
│ ├─ resumes/
│ └─ (uploaded files)
├─ db_connect.php
├─ header.php
├─ home.php
├─ loginSeekerjob.php
├─ logo.png
├─ logout.php
├─ README.md
├─ register.php
└─ showMessage.js



---

## Local Setup

### 1) Database
1. Create a new database (e.g. `career_gate_db`).
2. Import the file: `database/job_portal_v2.sql`.

### 2) Configure Database Connection
Edit `db_connect.php` with your local server details:
```php
<?php
$host = "localhost";
$dbname = "job_portal_v2";
$username = "root";      // change if needed
$password1 = "";          // your MySQL password

$conn = new mysqli( $host , $username,$password1,$dbname ); 
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  

?>
# Open in browser:  http://localhost:8000/career_gate_website/home.php

User Roles and Workflow
Admin

Login: admin_panel/login.php

Manage users: admin_panel/manage_users.php

Manage jobs: admin_panel/manage_jobs.php

Employer

Login: employer_panel/loginCompany.php

Dashboard: employer_panel/employer_dashboard.php

Post/manage jobs: employer_panel/my_jobs.php

View applicants: employer_panel/view_applicants.php

Job Seeker

Register: register.php

Login: loginSeekerjob.php

Browse jobs: jobseeker_panel/browse_jobs.php or home.php

Apply: jobseeker_panel/apply_job.php

Upload CV: jobseeker_panel/upload_cv.php

My applications: jobseeker_panel/my_applications.php

Update profile: jobseeker_panel/update_account.php

Security Notes

Restrict file types and size in upload_cv.php.

Use prepared statements and sanitize inputs.

Protect dashboard pages with session checks ($_SESSION).

Secure the uploads/ directory and consider external storage.

Deployment Tips

Use HTTPS.

Set correct permissions for uploads/.

Disable PHP error display in production (display_errors=Off).

Create a limited MySQL user.

Regular database backups.

Contribution

Create a new branch for each feature.

Submit pull requests with a short description of changes.

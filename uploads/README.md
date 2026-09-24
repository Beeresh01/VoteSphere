# 🗳️ VoteSphere — College Online Voting System

VoteSphere is a web-based **online voting system** designed for conducting secure and organized college elections. It allows students to register as voters, log in, view candidates, cast their votes, and view election results through a simple web interface.

The system is built using **PHP and MySQL** and can be run locally using **XAMPP**.

---

## 📌 Project Overview

Traditional college elections can involve manual registration, paper-based voting, and manual vote counting. VoteSphere provides a digital platform that simplifies the election process by allowing students to participate in elections through a web application.

The system provides separate functionality for voters and election administrators.

---

## ✨ Features

### 👨‍🎓 Voter Module

- Voter registration
- Voter login
- Student/USN-based identification
- Password-protected authentication
- Candidate listing
- Candidate details and photographs
- Online vote casting
- Voting records
- Prevention of duplicate voting
- Election result viewing

### 👨‍💼 Admin Module

- Admin login
- Add candidates
- Manage candidate information
- Manage election positions
- View voting information
- View election results
- Candidate-wise vote counting

### 🗳️ Election Positions

The system supports multiple college election positions, including:

- President
- Vice President
- Sports Secretary
- Cultural Secretary

---

## 🛠️ Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend and server-side logic |
| MySQL | Database |
| HTML5 | Web page structure |
| CSS3 | User interface styling |
| JavaScript | Client-side functionality |
| XAMPP | Local PHP and MySQL server |
| phpMyAdmin | Database management |

---

## 🏗️ System Architecture

```text
                    ┌─────────────────────┐
                    │      Voter/User     │
                    └──────────┬──────────┘
                               │
                               ▼
                    ┌─────────────────────┐
                    │   VoteSphere Web    │
                    │     Application     │
                    └──────────┬──────────┘
                               │
              ┌────────────────┴────────────────┐
              │                                 │
              ▼                                 ▼
     ┌─────────────────┐               ┌─────────────────┐
     │   PHP Backend   │               │  Admin Module   │
     └────────┬────────┘               └────────┬────────┘
              │                                 │
              └────────────────┬────────────────┘
                               ▼
                    ┌─────────────────────┐
                    │     MySQL Database  │
                    └─────────────────────┘
```

---

## 🗄️ Database

The project uses a MySQL database named:

```text
student
```

Major database tables include:

```text
voter
president
president2
president3

vicepresident
vice2
vice3

sports
sports2
sports3

cultural1
cultural2
cultural3
```

The database can be created and managed using **phpMyAdmin**.

---

## 📂 Project Structure

```text
VoteSphere/
│
├── PHP Files
├── CSS Files
├── JavaScript Files
├── Images
├── uploads/
│   └── Candidate images
│
└── README.md
```

---

## ⚙️ Installation & Setup

### 1. Install XAMPP

Install XAMPP with:

- Apache
- MySQL
- phpMyAdmin

### 2. Clone or Download the Project

Place the project inside the XAMPP `htdocs` directory:

```text
C:\xampp\htdocs\VoteSphere
```

### 3. Start XAMPP

Open XAMPP Control Panel and start:

```text
Apache
MySQL
```

### 4. Create the Database

Open:

```text
http://localhost/phpmyadmin
```

Create a database:

```text
student
```

Import the provided SQL/database file if available.

### 5. Configure Database Connection

Update the PHP database connection according to your XAMPP configuration.

Typical local configuration:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "student";
```

### 6. Run the Project

Open your browser and visit:

```text
http://localhost/VoteSphere/
```

---

## 🔐 Voting Workflow

```text
Voter Registration
        ↓
Voter Login
        ↓
View Election
        ↓
View Candidates
        ↓
Select Candidate
        ↓
Cast Vote
        ↓
Vote Recorded
        ↓
Results
```

---

## 📊 Election Result Workflow

Votes are stored in the database and associated with the corresponding candidate and election position.

Administrators can view candidate-wise vote counts through the result pages.

---

## 🔒 Security Considerations

The project includes basic mechanisms for:

- User authentication
- Password-protected login
- Voter identification
- Duplicate-vote prevention
- Database-backed vote records
- Admin-controlled candidate management

> For production deployment, additional security measures such as password hashing, prepared SQL statements, CSRF protection, session hardening, HTTPS, and stronger access control should be implemented.

---

## 🎯 Objectives

- Digitize the college election process
- Reduce manual voting procedures
- Simplify voter registration
- Provide an easy-to-use voting interface
- Reduce manual vote counting
- Provide faster election results
- Maintain organized voting records

---

## 🚀 Future Enhancements

Possible improvements include:

- 🔐 Password hashing with modern algorithms
- 📱 Fully responsive mobile interface
- 🔑 OTP-based voter verification
- 📧 Email notifications
- 📊 Interactive election analytics
- 📈 Real-time result dashboard
- 🛡️ Improved security and audit logging
- 👤 Role-based access control
- 🗳️ Election scheduling
- 📄 Downloadable election reports
- 🌐 Deployment to a production web server

---

## 💻 Running Locally

The easiest way to run VoteSphere during development is using XAMPP.

```text
XAMPP
 ├── Apache → PHP
 └── MySQL → Database

        ↓

   VoteSphere

        ↓

http://localhost/VoteSphere/
```

---

## 📸 Screenshots

Add screenshots of your application here:

```text
screenshots/
├── home.png
├── login.png
├── voter-dashboard.png
├── candidates.png
└── results.png
```

---

## 👨‍💻 Author

**Beeresh Muragannavar**

Computer Science & Engineering Student

---

## 📄 License

This project is developed for **educational and academic purposes**.

---

⭐ If you find this project useful, consider giving the repository a star!
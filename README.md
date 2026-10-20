# Library Management System

A web-based library management system built as a school group project and presented to students and lecturers. The application provides a simple interface for managing a library catalogue, authors, members, and book circulation.

## Project and team

This was a collaborative school project. **I served as the group leader**, coordinating the group’s work and helping guide the project through development and presentation.

## Features

- **Dashboard:** View counts for books, authors, members, and currently issued books.
- **Book catalogue:** Add, view, edit, and delete books; track total and available copies.
- **Author records:** Add, view, edit, and delete authors, with a count of books for each author.
- **Member records:** Add, view, edit, and delete members, including their contact details and active issue count.
- **Book search:** Search titles, categories, and author names.
- **Circulation:** Issue an available book to a member, set a due date, and record returns.
- **Issue status:** View circulation history and identify currently issued and overdue books.
- **Form feedback:** Client-side checks provide immediate feedback; PHP pages also perform server-side validation.
- **Responsive layout:** Shared navigation and styles provide a consistent interface across the application.

## Technology

- PHP 8.2
- MySQL or a compatible MySQL server
- MySQLi for database access
- HTML, CSS, and vanilla JavaScript
- Apache, including the provided PHP 8.2 Apache Docker image

No Composer or JavaScript package installation is required.

## Project structure

```text
.
├── authors/                 Author add, edit, view, and delete pages
├── assets/
│   ├── css/style.css        Application styles
│   └── js/validate.js       Client-side form validation
├── books/                   Book add, edit, view, and delete pages
├── config/
│   ├── db.php               MySQLi connection configuration
│   └── ca.pem               CA certificate used for optional database TLS
├── database/
│   └── library_db.sql       Schema and sample data
├── includes/
│   ├── header.php           Shared page header and navigation
│   └── footer.php           Shared page footer
├── issue_return/            Issue, return, and circulation status pages
├── members/                 Member add, edit, view, and delete pages
├── index.php                Dashboard
├── search.php               Book search
├── test_connection.php      Optional database connection smoke test
└── Dockerfile               PHP 8.2 with Apache and MySQLi
```

## Requirements

For a local installation:

- PHP 8.2 or later with the `mysqli` extension
- MySQL
- Apache or another PHP-capable web server

Alternatively, Docker can run the PHP/Apache application. The provided Docker image **does not include a MySQL server**; the application still needs to connect to a separate MySQL database.

## Setup

### 1. Create and seed the database

Create a database named `library_db` (or choose a different name and set `DB_NAME` below). Then run `database/library_db.sql` against it using a MySQL client or a database management tool such as phpMyAdmin.

> **Warning:** The SQL file drops and recreates the `issued_books`, `books`, `authors`, and `members` tables before adding sample records. Importing it into a database that already contains data will delete that data. Use a fresh project database.

The script creates four tables—`authors`, `books`, `members`, and `issued_books`—and inserts sample records for demonstration.

### 2. Configure the database connection

The connection is configured in `config/db.php` using environment variables:

| Variable | Default | Purpose |
| --- | --- | --- |
| `DB_HOST` | `127.0.0.1` | MySQL server hostname |
| `DB_USER` | `root` | MySQL username |
| `DB_PASS` | empty | MySQL password |
| `DB_NAME` | `library_db` | Database name |
| `DB_PORT` | `3306` | MySQL port |
| `DB_USE_SSL` | `false` | Set to `true` to enable database TLS |

When TLS is enabled, the application looks for the CA certificate at `config/ca.pem`. For a local development database, TLS is off by default. For any shared or deployed environment, configure credentials through environment variables and do not use an empty database password.

### 3. Set the application base URL

The shared navigation and asset paths use `BASE_URL` in `includes/header.php`, which is currently set to the project’s hosted URL. Before running the application at a different location, change it to the correct root URL for your local server or deployment. For example, if the project is served from `http://localhost/Library-management-system/`, set `BASE_URL` to that URL, including the trailing slash.

### 4. Run the application

With Apache and PHP installed, place the project in the web server’s document root, start Apache and MySQL, and open the project’s local URL in a browser.

To build the provided Docker image:

```sh
docker build -t library-management-system .
```

Run it with access to your configured MySQL server. For example, when MySQL is running on the Docker host:

```sh
docker run --rm -p 8080:80 \
  -e DB_HOST=host.docker.internal \
  -e DB_USER=root \
  -e DB_PASS=your_password \
  -e DB_NAME=library_db \
  -e DB_PORT=3306 \
  -e DB_USE_SSL=false \
  library-management-system
```

Open `http://localhost:8080/` after updating `BASE_URL` to match the address used to access the app. The database server must accept connections from the container.

### 5. Check the database connection (optional)

After the database has been imported and the connection configured, `test_connection.php` can be opened in a browser to confirm the app can connect and read the sample books. This is a development smoke test, not an automated test suite. Do not leave this diagnostic page publicly accessible in a production deployment.

## Database relationships and circulation

- An author can be associated with multiple books. If an author is deleted, their books remain and their author reference is cleared.
- A book can have multiple issue records, and a member can have multiple issue records.
- Issuing a book creates an active issue and reduces its available-copy count in a database transaction.
- Returning a book marks the issue as returned, records the return date, and restores one available copy.
- The application prevents deleting a book or member while they have active issues.
- The issue status page marks active issues past their due date as overdue.

## Suggested presentation walkthrough

1. Open the dashboard and explain the summary counts.
2. Browse the book, author, and member lists.
3. Search for a title, author, or category.
4. Issue an available book to a member and show the updated status and copy count.
5. Return the book and demonstrate the updated circulation record.

## Scope and limitations

This project is intended as an educational demonstration. It does not currently provide user accounts, authentication, or role-based access control. Do not use it as-is to manage real library or personal data on a public-facing service.

-- ============================================
-- Library Management System — Database Setup
-- ============================================



-- 2. Drop tables if re-running this script (safe re-run)
DROP TABLE IF EXISTS issued_books;
DROP TABLE IF EXISTS books;
DROP TABLE IF EXISTS authors;
DROP TABLE IF EXISTS members;

-- 3. Authors table
CREATE TABLE authors (
    author_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    bio TEXT
);

-- 4. Books table (foreign key -> authors)
CREATE TABLE books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    author_id INT,
    isbn VARCHAR(20) UNIQUE,
    category VARCHAR(50),
    total_copies INT DEFAULT 1,
    available_copies INT DEFAULT 1,
    FOREIGN KEY (author_id) REFERENCES authors(author_id) ON DELETE SET NULL
);

-- 5. Members table
CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20)
);

-- 6. Issued books table (foreign keys -> books, members)
CREATE TABLE issued_books (
    issue_id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    member_id INT NOT NULL,
    issue_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE NULL,
    status ENUM('issued','returned') DEFAULT 'issued',
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE,
    FOREIGN KEY (member_id) REFERENCES members(member_id) ON DELETE CASCADE
);

-- ============================================
-- Seed Data — sample rows so every team has
-- real data to test against immediately
-- ============================================

INSERT INTO authors (first_name, last_name, bio) VALUES
('Chinua', 'Achebe', 'Nigerian novelist, poet, and critic, best known for Things Fall Apart.'),
('J.K.', 'Rowling', 'British author best known for the Harry Potter series.'),
('James', 'Clear', 'Author known for writing on habits and personal improvement.');

INSERT INTO books (title, author_id, isbn, category, total_copies, available_copies) VALUES
('Things Fall Apart', 1, '978-0435905255', 'Fiction', 4, 4),
('No Longer at Ease', 1, '978-0385474542', 'Fiction', 2, 2),
('Harry Potter and the Philosopher''s Stone', 2, '978-0747532699', 'Fantasy', 5, 5),
('Harry Potter and the Chamber of Secrets', 2, '978-0747538486', 'Fantasy', 3, 3),
('Atomic Habits', 3, '978-0735211292', 'Self-Help', 6, 6);

INSERT INTO members (full_name, email, phone) VALUES
('Enoch Adeyemi', 'enoch.adeyemi@example.com', '08012345678'),
('Blessing Okafor', 'blessing.okafor@example.com', '08023456789'),
('Ibrahim Musa', 'ibrahim.musa@example.com', '08034567890');

-- Sample issue records (one currently issued, one already returned)
INSERT INTO issued_books (book_id, member_id, issue_date, due_date, return_date, status) VALUES
(1, 1, '2026-07-20', '2026-08-03', NULL, 'issued'),
(3, 2, '2026-07-15', '2026-07-29', '2026-07-27', 'returned');

-- Reflect the currently issued book in available_copies
UPDATE books SET available_copies = available_copies - 1 WHERE book_id = 1;
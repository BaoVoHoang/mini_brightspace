USE mini_brightspace;

-- Clean existing data
DELETE FROM submissions;
DELETE FROM assignments;
DELETE FROM enrollments;
DELETE FROM courses;
DELETE FROM teachers;
DELETE FROM users;

-- 1 Admin
INSERT INTO users (name, email, password, role)
VALUES ('Admin User', 'admin@brightspace.com', 'admin123', 'admin');

-- 10 Teachers
INSERT INTO users (name, email, password, role) VALUES
('Dr. Emily Carter', 'emily.carter@brightspace.com', 'teacher123', 'teacher'),
('Prof. David Kim', 'david.kim@brightspace.com', 'teacher123', 'teacher'),
('Dr. Olivia Zhang', 'olivia.zhang@brightspace.com', 'teacher123', 'teacher'),
('Dr. Liam Patel', 'liam.patel@brightspace.com', 'teacher123', 'teacher'),
('Prof. Sophia Martinez', 'sophia.martinez@brightspace.com', 'teacher123', 'teacher'),
('Dr. Ethan Thompson', 'ethan.thompson@brightspace.com', 'teacher123', 'teacher'),
('Dr. Ava Robinson', 'ava.robinson@brightspace.com', 'teacher123', 'teacher'),
('Prof. Noah Nguyen', 'noah.nguyen@brightspace.com', 'teacher123', 'teacher'),
('Dr. Mia Johnson', 'mia.johnson@brightspace.com', 'teacher123', 'teacher'),
('Prof. Lucas Garcia', 'lucas.garcia@brightspace.com', 'teacher123', 'teacher');

-- Teacher details
INSERT INTO teachers (user_id, department, office_hours)
SELECT user_id,
       CASE 
         WHEN name LIKE '%Carter%' THEN 'Mathematics'
         WHEN name LIKE '%Kim%' THEN 'Computer Science'
         WHEN name LIKE '%Zhang%' THEN 'Physics'
         WHEN name LIKE '%Patel%' THEN 'Finance'
         WHEN name LIKE '%Martinez%' THEN 'Psychology'
         WHEN name LIKE '%Thompson%' THEN 'History'
         WHEN name LIKE '%Robinson%' THEN 'English Literature'
         WHEN name LIKE '%Nguyen%' THEN 'Business Administration'
         WHEN name LIKE '%Johnson%' THEN 'Biology'
         WHEN name LIKE '%Garcia%' THEN 'Fine Arts'
       END,
       'Mon–Fri 2 PM–4 PM'
FROM users WHERE role='teacher';

-- 100 Students
INSERT INTO users (name, email, password, role)
SELECT CONCAT('Student ', n),
       CONCAT('student', n, '@brightspace.com'),
       'student123',
       'student'
FROM (
  SELECT @row := @row + 1 AS n
  FROM information_schema.columns, (SELECT @row := 0) AS r
  LIMIT 100
) AS x;

-- 10 Real Courses (one per teacher)
INSERT INTO courses (course_name, description, teacher_id)
SELECT 'Introduction to Calculus','Fundamental concepts of limits, derivatives, and integrals.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Dr. Emily Carter'
UNION ALL
SELECT 'Web Development Fundamentals','Learn HTML, CSS, and JavaScript to build interactive websites.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Prof. David Kim'
UNION ALL
SELECT 'Modern Physics','Covers quantum mechanics and relativity principles.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Dr. Olivia Zhang'
UNION ALL
SELECT 'Corporate Finance','Principles of valuation, risk, and return in corporate settings.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Dr. Liam Patel'
UNION ALL
SELECT 'Introduction to Psychology','Explore human behavior, cognition, and emotion.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Prof. Sophia Martinez'
UNION ALL
SELECT 'World History 101','A study of key global events shaping civilizations.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Dr. Ethan Thompson'
UNION ALL
SELECT 'Shakespearean Literature','Analyzing major works by William Shakespeare.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Dr. Ava Robinson'
UNION ALL
SELECT 'Principles of Marketing','Overview of consumer behavior, branding, and promotion.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Prof. Noah Nguyen'
UNION ALL
SELECT 'Cell Biology','Detailed study of cell structures and functions.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Dr. Mia Johnson'
UNION ALL
SELECT 'Introduction to Painting','Practical exploration of painting techniques and art theory.',t.teacher_id
  FROM teachers t JOIN users u ON t.user_id=u.user_id WHERE u.name='Prof. Lucas Garcia';

-- Enrollments: each student 2–6 random courses
INSERT INTO enrollments (student_id, course_id)
SELECT u.user_id, c.course_id
FROM users u
JOIN courses c
WHERE u.role='student'
AND (RAND() < (0.25 + RAND()*0.25));  -- each student joins ~20–60% of courses (≈2–6 per student)
-- Ensures randomized multi-course distribution

-- 1 Assignment per course
INSERT INTO assignments (course_id, title, description, due_date)
SELECT course_id,
       CONCAT('Assignment 1 – ', course_name),
       CONCAT('Complete the first project/report for ', course_name, '.'),
       '2025-12-20 23:59:00'
FROM courses;

-- Submissions only from enrolled students
INSERT INTO submissions (assignment_id, student_id, file_path, grade)
SELECT a.assignment_id, e.student_id,
       CONCAT('/uploads/submission_', e.student_id, '_', a.assignment_id, '.zip'),
       ROUND(RAND() * 40 + 60, 2)
FROM assignments a
JOIN enrollments e ON e.course_id = a.course_id
WHERE RAND() < 0.6;  -- roughly 60% of enrolled students submit their assignments

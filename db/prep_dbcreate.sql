CREATE TABLE course 
(
    id SERIAL PRIMARY KEY,
    code VARCHAR(25) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL
);


CREATE TABLE note 
(
    id SERIAL PRIMARY KEY,
    course_id INT NOT NULL REFERENCES course(id),
    content text NOT NULL
);

INSERT INTO course(code, name) VALUES ('CS 313', 'Web Engineering II');
INSERT INTO course(code, name) VALUES 
('CS 415', 'Machine Learning and Data Mining'),
('CS 246', 'Software Design and Development');

INSERT INTO note (course_id, content) VALUES (1, 'Today we are learning about dbs');
INSERT INTO note (course_id, content) VALUES (1, 'Inner joins are interesting');
INSERT INTO note (course_id, content) VALUES (2, 'I like nural networks');

SELECT * FROM note n 
JOIN course c ON n.course_id = c.id 
WHERE c.code = 'CS 313';

SELECT c.name, n.content FROM note n 
JOIN course c ON n.course_id = c.id 
WHERE c.code = 'CS 313';

SELECT c.code, c.name, n.content FROM note n 
JOIN course c ON n.course_id = c.id 
WHERE c.id = 1;
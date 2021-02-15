CREATE TABLE topic (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

INSERT INTO topic (name)
VALUES ('Faith');

INSERT INTO topic (name)
VALUES ('Sacrifice');

INSERT INTO topic (name)
VALUES ('Charity');

CREATE TABLE scripture_topic (
    id SERIAL PRIMARY KEY,
    scriptures_id INT REFERENCES scriptures(id),
    topic_id INT REFERENCES topic(id)
);

SELECT s.id, t.id, book, chapter, verse, content, name FROM scriptures s
INNER JOIN topic t ON s.id = t.id;  


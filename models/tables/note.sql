CREATE TABLE note_tbl (
    note_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    description TEXT,
    type VARCHAR(50),
    status INT(1)
);
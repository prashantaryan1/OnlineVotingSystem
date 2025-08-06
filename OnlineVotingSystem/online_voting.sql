CREATE DATABASE IF NOT EXISTS online_voting;
USE online_voting;

CREATE TABLE voter (
    voter_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    gender VARCHAR(10),
    dob DATE,
    status VARCHAR(20)
);

CREATE TABLE candidate (
    candidate_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    party VARCHAR(100),
    symbol VARCHAR(50),
    votes INT DEFAULT 0
);

CREATE TABLE admin (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    password VARCHAR(50)
);

INSERT INTO admin (username, password) VALUES ('admin', 'admin123');

CREATE TABLE vote (
    vote_id INT AUTO_INCREMENT PRIMARY KEY,
    voter_id INT,
    candidate_id INT,
    timestamp DATETIME,
    FOREIGN KEY (voter_id) REFERENCES voter(voter_id),
    FOREIGN KEY (candidate_id) REFERENCES candidate(candidate_id)
);

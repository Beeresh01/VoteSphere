```sql
-- ============================================================
-- VoteSphere - College Online Voting System
-- Database: student
-- ============================================================

CREATE DATABASE IF NOT EXISTS student
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE student;


-- ============================================================
-- VOTER TABLE
-- ============================================================

CREATE TABLE IF NOT EXISTS voter (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usn VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    branch VARCHAR(50) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- ============================================================
-- PRESIDENT CANDIDATES
-- ============================================================

CREATE TABLE IF NOT EXISTS president (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    position VARCHAR(100) NOT NULL,
    photo_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- ============================================================
-- PRESIDENT VOTE COUNTS
-- ============================================================

CREATE TABLE IF NOT EXISTS president2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    total_votes INT NOT NULL DEFAULT 0,

    UNIQUE KEY unique_president_vote (candidate_id, position),

    CONSTRAINT fk_president2_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES president(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- PRESIDENT VOTER RECORD
-- ============================================================

CREATE TABLE IF NOT EXISTS president3 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY unique_president_user_vote (user_id, position),

    CONSTRAINT fk_president3_user
        FOREIGN KEY (user_id)
        REFERENCES voter(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_president3_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES president(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- VICE PRESIDENT CANDIDATES
-- ============================================================

CREATE TABLE IF NOT EXISTS vicepresident (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    position VARCHAR(100) NOT NULL,
    photo_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- ============================================================
-- VICE PRESIDENT VOTE COUNTS
-- ============================================================

CREATE TABLE IF NOT EXISTS vice2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    total_votes INT NOT NULL DEFAULT 0,

    UNIQUE KEY unique_vice_vote (candidate_id, position),

    CONSTRAINT fk_vice2_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES vicepresident(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- VICE PRESIDENT VOTER RECORD
-- ============================================================

CREATE TABLE IF NOT EXISTS vice3 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY unique_vice_user_vote (user_id, position),

    CONSTRAINT fk_vice3_user
        FOREIGN KEY (user_id)
        REFERENCES voter(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_vice3_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES vicepresident(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- SPORTS SECRETARY CANDIDATES
-- ============================================================

CREATE TABLE IF NOT EXISTS sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    position VARCHAR(100) NOT NULL,
    photo_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- ============================================================
-- SPORTS VOTE COUNTS
-- ============================================================

CREATE TABLE IF NOT EXISTS sports2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    total_votes INT NOT NULL DEFAULT 0,

    UNIQUE KEY unique_sports_vote (candidate_id, position),

    CONSTRAINT fk_sports2_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES sports(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- SPORTS VOTER RECORD
-- ============================================================

CREATE TABLE IF NOT EXISTS sports3 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY unique_sports_user_vote (user_id, position),

    CONSTRAINT fk_sports3_user
        FOREIGN KEY (user_id)
        REFERENCES voter(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_sports3_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES sports(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- CULTURAL SECRETARY CANDIDATES
-- ============================================================

CREATE TABLE IF NOT EXISTS cultural1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    position VARCHAR(100) NOT NULL,
    photo_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- ============================================================
-- CULTURAL VOTE COUNTS
-- ============================================================

CREATE TABLE IF NOT EXISTS cultural2 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    total_votes INT NOT NULL DEFAULT 0,

    UNIQUE KEY unique_cultural_vote (candidate_id, position),

    CONSTRAINT fk_cultural2_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES cultural1(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- CULTURAL VOTER RECORD
-- ============================================================

CREATE TABLE IF NOT EXISTS cultural3 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    candidate_id INT NOT NULL,
    position VARCHAR(100) NOT NULL,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    UNIQUE KEY unique_cultural_user_vote (user_id, position),

    CONSTRAINT fk_cultural3_user
        FOREIGN KEY (user_id)
        REFERENCES voter(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_cultural3_candidate
        FOREIGN KEY (candidate_id)
        REFERENCES cultural1(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- ============================================================
-- LEGACY / COMPATIBILITY TABLE
-- ============================================================

CREATE TABLE IF NOT EXISTS vicepresident1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    semester VARCHAR(20) NOT NULL,
    position VARCHAR(100) NOT NULL,
    photo_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- ============================================================
-- DATABASE CREATED
-- ============================================================

SELECT 'VoteSphere database created successfully!' AS Status;
```
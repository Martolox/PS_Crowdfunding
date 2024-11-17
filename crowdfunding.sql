DROP SCHEMA IF EXISTS crowdfunding;
CREATE SCHEMA crowdfunding;
USE crowdfunding;

CREATE TABLE users (
	id_users SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	username VARCHAR(20) UNIQUE NOT NULL,
	password VARCHAR(20) UNIQUE NOT NULL,
	email VARCHAR(40) UNIQUE NOT NULL,
    img_name varchar(100) NOT NULL, /*nombre de imagen del usuario */
	PRIMARY KEY (id_users),
	UNIQUE INDEX(username, password)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE projects (
    id_projects SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_users SMALLINT UNSIGNED NOT NULL,
    name VARCHAR(40) NOT NULL,
    category VARCHAR(30) NOT NULL,
    impact VARCHAR(300) NOT NULL,
    budget DECIMAL(10,2) NOT NULL,
    status ENUM('EN PROCESO', 'CANCELADO', 'FINALIZADO', 'PUBLICADO') NOT NULL DEFAULT 'EN PROCESO', 
    end_date DATE NOT NULL,
    reward_plan varchar(300) NOT NULL,
    img_name varchar(100) NOT NULL, /*nombre de imagen del proyecto */
    PRIMARY KEY (id_projects),
    FOREIGN KEY (id_users) REFERENCES users(id_users)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE updates (
	id_updates SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	version TINYINT UNSIGNED NOT NULL,
	change_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	description VARCHAR(300) NOT NULL DEFAULT '',
	id_projects SMALLINT UNSIGNED UNIQUE NOT NULL,
	PRIMARY KEY (id_updates),
	FOREIGN KEY (id_projects) REFERENCES projects(id_projects)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE investments (
    id_investments SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_projects SMALLINT UNSIGNED NOT NULL,
    id_users SMALLINT UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    status ENUM('active', 'cancelled') NOT NULL DEFAULT 'active',
    investment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_investments),
    FOREIGN KEY (id_projects) REFERENCES projects(id_projects),
    FOREIGN KEY (id_users) REFERENCES users(id_users)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE scores (
    id_score SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_projects SMALLINT UNSIGNED NOT NULL,
    id_users SMALLINT UNSIGNED NOT NULL,
    stars TINYINT UNSIGNED NOT NULL CHECK (stars >= 1 AND stars <= 5),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    score_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_score),
    FOREIGN KEY (id_projects) REFERENCES projects(id_projects),
    FOREIGN KEY (id_users) REFERENCES users(id_users),
    UNIQUE KEY unique_user_project (id_users, id_projects)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comments (
    id_comments SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_projects SMALLINT UNSIGNED NOT NULL,
    id_users SMALLINT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_comments),
    FOREIGN KEY (id_projects) REFERENCES projects(id_projects),
    FOREIGN KEY (id_users) REFERENCES users(id_users)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE notifications (
    id_notifications SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_users SMALLINT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    notification_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_notifications),
    FOREIGN KEY (id_users) REFERENCES users(id_users)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


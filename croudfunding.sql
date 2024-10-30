DROP SCHEMA IF EXISTS crowdfunding;
CREATE SCHEMA crowdfunding;
USE crowdfunding;

CREATE TABLE users (
	id_users SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	username VARCHAR(20) NOT NULL,
	password VARCHAR(20) UNIQUE NOT NULL,
	email VARCHAR(40) UNIQUE NOT NULL,
	PRIMARY KEY (id_users),
	UNIQUE INDEX(username, password)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE budgets (
	id_budgets SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	state ENUM('CREADO','PUBLICADO','CANCELADO','COMPLETADO') NOT NULL,
	amount DECIMAL(8,2) NOT NULL,
	date_start DATE NOT NULL,
	date_end DATE NOT NULL,
	PRIMARY KEY (id_budgets),
	CHECK (amount > 0.0),
	CHECK (date_end > date_start)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE descriptions (
	id_descriptions SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	category VARCHAR(20) NOT NULL,
	impact VARCHAR(300) NOT NULL DEFAULT '',
	rewards VARCHAR(300) NOT NULL DEFAULT '',
	PRIMARY KEY (id_descriptions)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE projects (
	id_projects SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(40) UNIQUE NOT NULL,
	id_budgets SMALLINT UNSIGNED NOT NULL,
	id_descriptions SMALLINT UNSIGNED NOT NULL,
	PRIMARY KEY (id_projects),
	FOREIGN KEY (id_budgets) REFERENCES budgets(id_budgets),
	FOREIGN KEY (id_descriptions) REFERENCES descriptions(id_descriptions)
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
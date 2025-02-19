DROP SCHEMA IF EXISTS crowdfunding;
CREATE SCHEMA crowdfunding;
USE crowdfunding;

CREATE TABLE users (
	id_users SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	username VARCHAR(20) UNIQUE NOT NULL,
	password VARCHAR(20) UNIQUE NOT NULL,
	email VARCHAR(40) UNIQUE NOT NULL,
	img_name varchar(100) NOT NULL DEFAULT 'uploads/profile.png',
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
	img_name varchar(100) NOT NULL,
	PRIMARY KEY (id_projects),
	FOREIGN KEY (id_users) REFERENCES users(id_users)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE updates (
	id_updates SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	version TINYINT UNSIGNED NOT NULL,
	change_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	description VARCHAR(300) NOT NULL DEFAULT '',
	id_projects SMALLINT UNSIGNED  NOT NULL,
	PRIMARY KEY (id_updates),
	FOREIGN KEY (id_projects) REFERENCES projects(id_projects)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE investments (
	id_investments SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_projects SMALLINT UNSIGNED NOT NULL,
	id_users SMALLINT UNSIGNED NOT NULL,
	amount DECIMAL(10,2) NOT NULL,
	status ENUM('active', 'cancelled','finalized') NOT NULL DEFAULT 'active',
	investment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id_investments),
	FOREIGN KEY (id_projects) REFERENCES projects(id_projects),
	FOREIGN KEY (id_users) REFERENCES users(id_users)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE scores (
	id_score SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_projects SMALLINT UNSIGNED NOT NULL,
	id_users SMALLINT UNSIGNED NOT NULL,
	score TINYINT UNSIGNED NOT NULL CHECK (score >= 1 AND score <= 5),
	score_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id_score),
	FOREIGN KEY (id_projects) REFERENCES projects(id_projects),
	FOREIGN KEY (id_users) REFERENCES users(id_users)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE comments (
	id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_projects SMALLINT UNSIGNED NOT NULL,
	id_users SMALLINT UNSIGNED NOT NULL,
	comment TEXT NOT NULL,
	email VARCHAR(40) NOT NULL,
	comment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
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


INSERT INTO users (id_users, username, password, email, img_name) VALUES
(1, 'admin'  ,'admin'    ,'admin@mail.com' ,'uploads/profile.png'),
(2, 'user'   ,'1234'     ,'user@mail.com'  ,'uploads/profile.png'),
(3, 'juan'   ,'juan'     ,'juan@mail.com'  ,'uploads/user-3.jpg' ),
(4, 'Daiana' ,'Daiana'   ,'daiana@mail.com','uploads/user-4.jpg' ),
(5, 'Ruben'  ,'Ruben123' ,'ruben@mail.com' ,'uploads/profile.png'),
(6, 'mateo'  ,'mateo'    ,'mateo@mail.com' ,'uploads/profile.png'),
(7, 'juana'  ,'juana'    ,'juana@mail.com' ,'uploads/user-7.jpg' ),
(10,'Diego'  ,'Diego2'   ,'diegoo@mail.com','uploads/user-10.jpg'),
(11,'Omar'   ,'Omar'     ,'ohms@mail.com'  ,'uploads/profile.png'),
(12,'guille' ,'gullermo' ,'guille@mail.com','uploads/profile.png'),
(13,'david'  ,'david'    ,'david@mail.com' ,'uploads/profile.png');


INSERT INTO projects (id_projects, id_users, name, category, impact, budget, status, end_date, reward_plan, img_name) VALUES
(1, 3, 'Nuevo pub inglés', 'Negocios',
'Crear un pub tradicional inglés en el centro de la ciudad para ofrecer un espacio único para la comunidad, con cervezas artesanales y un ambiente acogedor.',
1650000,'PUBLICADO', '2025-02-12',
'$100: Agradecimiento en redes sociales.
$300: Una pinta gratis + agradecimiento en el sitio web.
$3.500: Taza personalizada y visita VIP al pub.
$40.000: Fiesta privada para 20 personas en el pub.',
'uploads/prod-1.png'),

(2, 3,'Taller de ebanistería', 'Arte y Diseño',
'Crear un taller de ebanistería artesanal donde se ofrezcan cursos y servicios personalizados, desde la fabricación de muebles hasta la restauración de piezas antiguas. El taller será un espacio para enseñar técnicas de carpintería de alta calidad.',
750000, 'PUBLICADO', '2024-11-17',
'$100: Agradecimiento en redes sociales.
$500: Un pequeño artículo de madera hecho a mano.
$1500: Clase de ebanistería para una persona.
$5000: Mobiliario personalizado (mesa o silla).
$10000: Curso completo de ebanistería + mención en el taller.',
'uploads/prod-2.png'),

(3, 3, 'Encuadernación de libro botánico', 'Negocios',
'Rediseñar y unificar los conocimientos botánicos hallados en libros antiguos mediante un proceso de restauración y encuadernación artesanal. El proyecto utilizará la serigrafía para crear ilustraciones botánicas que complementen los textos originales, proporcionando una edición renovada y enriquecida que preserve la impresión tradición.',
40000, 'EN PROCESO', '2024-12-03',
'$30: Ilustración digital botánica exclusiva.
$75: Una edición limitada de un cuaderno botánico.
$200: Libro botánico exclusivo, con ilustraciones y encuadernación personalizada.
$1000: Colección completa de libros botánicos restaurados y serigrafiados, junto con una visita al taller para ver el proceso de restauración y encuadernación.',
'uploads/prod-3.png'),

(4, 3, 'Techo para viajantes y gente de paso', 'Bien Social',
'Construir un techo comunitario que brinde refugio a viajeros y personas de paso, proporcionando un espacio seguro y accesible para descansar, con instalaciones mínimas pero cómodas.',
160000, 'PUBLICADO', '2024-12-02',
'$10: Agradecimiento en redes sociales.
$100: Estancia de una noche en el refugio para dos personas.
$500: Mención en una placa dentro del refugio.
$1000: Experiencia de voluntariado y estadía de 3 noches.',
'uploads/prod-4.png'),

(5, 5, 'Proyecto de agua potable', 'Bien Social',
'Implementar un sistema sostenible de abastecimiento de agua potable en una comunidad que carece de acceso a agua limpia, utilizando tecnologías ecológicas como filtros de agua y sistemas de captación de lluvia.',
232000, 'PUBLICADO', '2025-05-09',
'$15: Agradecimiento en redes sociales.
$50: Reporte fotográfico del progreso del proyecto.
$150: Mención en una placa de agradecimiento en la comunidad.
$500: Adopta una fuente de agua para la comunidad + agradecimiento especial.
$1000: Visita al proyecto y participación en la inauguración de la nueva fuente de agua.',
'uploads/prod-5.png'),

(6, 5, 'Reinauguración de Arcade Retro', 'Entretenimiento',
'Renovar un clásico arcade de los años 80, modernizando sus máquinas y creando un espacio temático para atraer a los fanáticos de los videojuegos retro y a nuevas generaciones. Se ofrecerán eventos y torneos periódicos. ',
1000000, 'CANCELADO', '2025-03-15',
'$50: Agradecimiento en redes sociales y un acceso exclusivo a la aplicación del arcade.'
'$200: T-shirt con el logo del arcade + entrada gratuita por un mes.'
'$1000: Membresía VIP para un año, acceso anticipado a nuevos juegos y un torneo privado.'
'$5000: Fiesta privada para 50 personas en el arcade, con juegos ilimitados y catering.',
'uploads/prod-7.png'),

(7, 6, 'Stickers Ecológicos', 'Arte y Diseño',
'Crear y distribuir stickers ecológicos fabricados con materiales reciclados y tintas biodegradables. Cada sticker tendrá un diseño único y mensaje ambientalista, promoviendo el respeto por el planeta.',
300000, 'PUBLICADO', '2025-01-20',
'$10: Agradecimiento en redes sociales + pack de 5 stickers ecológicos.'
'$50: Pack de 20 stickers con diseños exclusivos y eco-amigables.'
'$200: Caja de colección con 50 stickers + reconocimiento en el sitio web.'
'$500: Diseño personalizado de sticker + colección completa de 100 stickers.',
'uploads/prod-8.png'),

(8, 7, 'Ropa para Gatos', 'Entretenimiento',
'Diseñar una línea de ropa exclusiva para gatos, con materiales suaves, cómodos y resistentes. Incluye desde suéteres hasta disfraces temáticos, asegurando que los gatos luzcan bien y se sientan cómodos.',
250000, 'PUBLICADO', '2025-05-10',
'$25: Agradecimiento en redes sociales + collar de diseño único para gatos.'
'$75: Suéter o camiseta para gatos en talla personalizada.'
'$200: Ropa completa para gatos (suéter, bufanda y botas).'
'$500: Estilo de ropa exclusivo para tu gato + mención en redes sociales.',
'uploads/prod-9.png'),

(9, 7, 'Ayuda para Perros sin Hogar', 'Bien Social',
'Crear un refugio para perros sin hogar y financiar su cuidado, rehabilitación y adopción. El refugio proporcionará atención médica, alimentos y un ambiente seguro hasta que los perros encuentren un hogar.',
500000, 'CANCELADO', '2025-04-05',
'$20: Agradecimiento en redes sociales y una foto del perro que ayudaste.'
'$50: Collar y placa personalizada para un perro rescatado.'
'$200: Visita al refugio y un día con un perro rescatado.'
'$1000: Adopción de un perro rescatado con todos los gastos cubiertos, incluida su atención médica.',
'uploads/prod-10.png'),

(10, 7, 'Recuperación del Circo Ruso', 'Cultura',
'Rehabilitar un circo tradicional ruso, restaurando su infraestructura y manteniendo sus tradiciones. Se organizarán funciones para preservar el arte circense y apoyar a los artistas locales.',
800000, 'PUBLICADO', '2024-11-01',
'$30: Agradecimiento en redes sociales y un programa del circo.'
'$100: Entrada VIP para una función del circo con un recorrido detrás del escenario.'
'$500: Experiencia completa de un día con los artistas, incluyendo una clase de circo.'
'$2000: Cena exclusiva con los artistas del circo + asiento preferencial en el espectáculo.',
'uploads/prod-11.png');


INSERT INTO investments (id_projects, id_users, amount, status, investment_date) VALUES
( 1,  3,    300, 'active', '2024-10-30'),
( 1,  7,   1400, 'active', '2024-11-03'),
( 6,  3,   5000, 'active', '2024-11-02'),
( 7,  3,   2000, 'active', '2024-11-04'),
(10, 10, 400000, 'active', '2024-11-14'),
(10, 10, 400000, 'active', '2024-11-25');


INSERT INTO comments (id_projects, id_users, comment, email, comment_date) VALUES
(1, 3 , 'Senectus et netus et malesuada. Nunc pulvinar sapien et ligula ullamcorper malesuada proin. Neque convallis a cras semper auctor. Libero id faucibus nisl tincidunt eget.', 'juan@mail.com', '2024-11-15'),
(1, 4 , 'Me parece genia la iniciativa. A la espera de novedades en el proyecto.', 'daiana@mail.com', '2024-11-18'),
(1, 5 , 'Comentario corto', 'ruben@mail.com', '2024-11-22'),
(1, 3 , 'Sit amet nulla facilisi morbi tempus. Nulla facilisi cras fermentum odio eu.', 'juan@mail.com', '2024-12-01'),

(2, 10, 'Senectus et netus et malesuada. Nunc pulvinar sapien et ligula ullamcorper malesuada proin. Neque convallis a cras semper auctor. Libero id faucibus nisl tincidunt eget.', 'diegoo@mail.com', '2024-11-15'),
(2, 3 , 'Et malesuada fames ac turpis egestas sed. Sit amet nisl suscipit adipiscing bibendum est ultricies.', 'daiana@mail.com', '2024-11-18'),
(2, 5 , 'Comentario corto', 'ruben@mail.com', '2024-11-22'),
(2, 7 , 'Sit amet nulla facilisi morbi tempus. Nulla facilisi cras fermentum odio eu.', 'juana@mail.com', '2024-12-01'),

(2, 3 , 'Sit amet nisl suscipit adipiscing.', 'juan@mail.com', '2024-11-15'),
(2, 3 , 'Et malesuada fames ac turpis egestas sed. Sit amet nisl suscipit adipiscing bibendum est ultricies.', 'juan@mail.com', '2024-12-01'),
(2, 7 , 'Sit amet nulla facilisi morbi tempus. Nulla facilisi cras fermentum odio eu.', 'juana@mail.com', '2024-12-03');

INSERT INTO scores (id_projects, id_users, score) VALUES
(1, 5, 4),
(1, 6, 5);
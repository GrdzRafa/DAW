DROP DATABASE if exists frases_Grdz_Rafa;
CREATE DATABASE frases_Grdz_Rafa;
USE frases_Grdz_Rafa;

CREATE TABLE tbl_authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    descripcio VARCHAR(255),
    url VARCHAR(255)
);

CREATE TABLE tbl_themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    descripcio VARCHAR(255)
);

CREATE TABLE tbl_phrases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    text TEXT NOT NULL,
    author_id INT,
    theme_id INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES tbl_authors(id),
    FOREIGN KEY (theme_id) REFERENCES tbl_themes(id)
);

INSERT INTO tbl_authors (nom, descripcio, url) VALUES 
('Abécassis, Armand', 'Profesor francés.', '/autores/armand-abecassis'),
('Achard, Marcel', 'Dramaturgo y guionista francés.', '/autores/marcel-achard'),
('Addison, Joseph', 'Político, literato y autor dramático inglés.', '/autores/joseph-addison'),
('Cervantes, Miguel', 'Novelista español, autor de Don Quijote.', '/autores/miguel-cervantes'),
('Poe, Edgar Allan', 'Escritor y poeta estadounidense.', '/autores/edgar-allan-poe'),
('Hemingway, Ernest', 'Novelista y periodista estadounidense.', '/autores/ernest-hemingway'),
('Kafka, Franz', 'Escritor checo de origen judío.', '/autores/franz-kafka'),
('Orwell, George', 'Novelista y periodista británico.', '/autores/george-orwell'),
('Borges, Jorge Luis', 'Escritor argentino, poeta y ensayista.', '/autores/jorge-luis-borges'),
('Dostoyevski, Fiódor', 'Novelista ruso, autor de Crimen y castigo.', '/autores/fiodor-dostoyevski'),
('Paquito, Chocolatero', 'Novelista andaluz, autor de canciones famosas.', '/autores/fiodor-dostoyevski'),
('Illo, Juan', 'Illo', '/autores/fiodor-dostoyevski'),
('Sohaib, Saibary', 'Autor del corán', '/autores/fiodor-dostoyevski'),
('Iker, Díaz', 'Autor del Undertale yellow', '/autores/fiodor-dostoyevski'),
('Eric, López', 'Autor de problemas renales y otras cosas', '/autores/fiodor-dostoyevski'),
('Dostoyevski, Fiódor', 'Novelista ruso, autor de Crimen y castigo.', '/autores/fiodor-dostoyevski'),
('Dostoyevski, Fiódor', 'Novelista ruso, autor de Crimen y castigo.', '/autores/fiodor-dostoyevski'),
('Dostoyevski, Fiódor', 'Novelista ruso, autor de Crimen y castigo.', '/autores/fiodor-dostoyevski'),
('Dostoyevski, Fiódor', 'Novelista ruso, autor de Crimen y castigo.', '/autores/fiodor-dostoyevski'),
('Dostoyevski, Fiódor', 'Novelista ruso, autor de Crimen y castigo.', '/autores/fiodor-dostoyevski');

INSERT INTO tbl_themes (nom, descripcio) VALUES 
('Esperanza', 'Tema relacionado con la esperanza y el optimismo.'),
('Amor', 'Tema que explora el amor en sus diversas formas.'),
('Filosofía', 'Reflexiones sobre la existencia y el conocimiento.'),
('Perdonar', 'El acto de perdonar y sus implicaciones.'),
('Censura', 'El control y la limitación de la libertad de expresión.'),
('Caridad', 'La generosidad y el acto de ayudar a los demás.'),
('Libros', 'La importancia de la literatura y la lectura.'),
('Libertad', 'El concepto de libertad y su significado.'),
('Soledad', 'Reflexiones sobre la soledad y el aislamiento.'),
('Sueños', 'La exploración de los sueños y sus significados.'),
('Sueños', 'La exploración de los sueños y sus significados.'),
('Sueños', 'La exploración de los sueños y sus significados.'),
('Sueños', 'La exploración de los sueños y sus significados.'),
('Sueños', 'La exploración de los sueños y sus significados.');

INSERT INTO tbl_phrases (text, author_id, theme_id) VALUES 
('El ser humano tiene un pie en la tierra y un pie en el más allá, por sus exigencias, su imaginario, en una palabra, por su esperanza.', 1, 1),
('Para ser feliz en el amor uno debe saber, sin cegarse, cómo cerrar los ojos.', 2, 2),
('Nada es más grato al espíritu del hombre que el poder de la dominación.', 3, 3),
('Un débil puede combatir, puede vencer; pero nunca puede perdonar.', 3, 4),
('En un hombre eminente es loca pretensión creer escapar de la censura, y debilidad el ser deprimido por ésta.', 3, 5),
('La caridad es una virtud del corazón y no de las manos.', 3, 6),
('Un buen libro es un regalo precioso que hace el autor a la humanidad.', 3, 7),
('La libertad es el derecho a decirle a la gente lo que no quiere oír.', 8, 8),
('La soledad es la suerte de todos los espíritus grandes.', 9, 9),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10),
('Los sueños son la literatura del sueño.', 10, 10);

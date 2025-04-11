use myweb;
drop table if exists tbl_events;
-- Crear la tabla de eventos
CREATE TABLE tbl_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titol VARCHAR(255) NOT NULL,
    descripcio TEXT NOT NULL,
    fecha_ini DATETIME NOT NULL,
    fecha_fin DATETIME NOT NULL,
    etiquetes VARCHAR(255)  -- Campo para almacenar etiquetas separadas por punto y coma
);

INSERT INTO tbl_events (titol, descripcio, fecha_ini, fecha_fin, etiquetes) VALUES
('Reunión de equipo', 'Reunión mensual para discutir el progreso del proyecto.', '2023-10-15 10:00:00', '2023-10-15 11:00:00', NULL),
('Taller de programación', 'Taller sobre nuevas tecnologías en desarrollo de software.', '2023-10-20 14:00:00', '2023-10-20 17:00:00', 'taller;programación;tecnología'),
('Presentación de resultados', 'Presentación de los resultados del último trimestre.', '2023-10-25 09:00:00', '2023-10-25 10:30:00', 'presentación;resultados;trimestre'),
('Conferencia de marketing', 'Conferencia sobre tendencias en marketing digital.', '2023-11-01 13:00:00', '2023-11-01 15:00:00', NULL),
('Fiesta de fin de año', 'Celebración de fin de año con todo el equipo.', '2023-12-15 18:00:00', '2023-12-15 23:59:59', 'fiesta;celebración;fin de año');
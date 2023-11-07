-- Crear la base de datos "bd_zorritos" si no existe y seleccionarla
CREATE DATABASE IF NOT EXISTS `bd_zorritos`;
USE `bd_zorritos`;

-- Tabla de Alumnos
CREATE TABLE tbl_alumnos (
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    apellidos VARCHAR(255),
    fecha_nacimiento DATE,
    correo_electronico VARCHAR(255)
);

-- Tabla de Notas
CREATE TABLE tbl_notas (
    id_nota INT AUTO_INCREMENT PRIMARY KEY,
    id_alumno INT,
    materia VARCHAR(255),
    nota DECIMAL(5, 2),
    FOREIGN KEY (id_alumno) REFERENCES tbl_alumnos(id_alumno)
);

-- Tabla de Usuarios
CREATE TABLE tbl_usuarios (
  id_usuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(255),
  contrasena VARCHAR(255),
  rol VARCHAR(50)
);

-- Tabla de Correos
CREATE TABLE tbl_correos (
    id_correo INT AUTO_INCREMENT PRIMARY KEY,
    id_destinatario INT, -- El ID del destinatario (alumno o grupo de alumnos)
    asunto VARCHAR(255),
    mensaje TEXT,
    fecha_envio DATETIME,
    FOREIGN KEY (id_destinatario) REFERENCES tbl_alumnos(id_alumno)
);

-- Tabla de Estadísticas de Notas
CREATE TABLE tbl_estadisticas (
    id_estadistica INT AUTO_INCREMENT PRIMARY KEY,
    materia VARCHAR(255),
    nota_promedio DECIMAL(5, 2),
    id_mejor_alumno INT,
    FOREIGN KEY (id_mejor_alumno) REFERENCES tbl_alumnos(id_alumno)
);


-- Inserciones de ejemplo para la tabla de Alumnos
INSERT INTO tbl_alumnos (nombre, apellidos, fecha_nacimiento, correo_electronico) VALUES
('Juan', 'Pérez', '2000-05-10', 'juan@fje.edu'),
('María', 'Gómez', '1999-08-15', 'maria@fje.edu'),
('Carlos', 'López', '2001-02-20', 'carlos@fje.edu'),
('Laura', 'Martínez', '2002-10-05', 'laura@fje.edu'),
('Pedro', 'Rodríguez', '1998-03-25', 'pedro@fje.edu'),
('Sofía', 'Fernández', '2003-04-30', 'sofia@fje.edu'),
('Alejandro', 'García', '2001-09-15', 'alejandro@fje.edu'),
('Carmen', 'Sánchez', '1999-11-08', 'carmen@fje.edu'),
('Javier', 'Luna', '2002-07-12', 'javier@fje.edu'),
('Isabel', 'Torres', '2004-01-25', 'isabel@fje.edu'),
('Miguel', 'Molina', '2000-12-07', 'miguel@fje.edu'),
('Ana', 'Ruiz', '2003-03-18', 'ana@fje.edu'),
('David', 'Jiménez', '2001-06-23', 'david@fje.edu'),
('Elena', 'Hernández', '2002-08-20', 'elena@fje.edu'),
('Luis', 'Díaz', '1998-10-01', 'luis@fje.edu'),
('Paula', 'Ortega', '2004-02-14', 'paula@fje.edu'),
('Antonio', 'González', '2000-07-28', 'antonio@fje.edu'),
('Silvia', 'Santos', '1999-04-03', 'silvia@fje.edu'),
('José', 'Cruz', '2003-11-11', 'jose@fje.edu'),
('Raquel', 'Pardo', '2001-01-09', 'raquel@fje.edu');
-- Inserciones de ejemplo para la tabla de Notas
INSERT INTO tbl_notas (id_alumno, materia, nota) VALUES
(1, 'Matemáticas', 8.5),
(1, 'Historia', 7.0),
(2, 'Matemáticas', 9.5),
(2, 'Historia', 6.0),
(3, 'Matemáticas', 7.0),
(3, 'Historia', 9.0),
(4, 'Matemáticas', 6.5),
(4, 'Historia', 8.0),
(5, 'Matemáticas', 9.0),
(5, 'Historia', 6.5),
(6, 'Matemáticas', 7.5),
(6, 'Historia', 9.5),
(7, 'Matemáticas', 8.0),
(7, 'Historia', 7.5),
(8, 'Matemáticas', 6.0),
(8, 'Historia', 9.0),
(9, 'Matemáticas', 9.5),
(9, 'Historia', 8.5),
(10, 'Matemáticas', 7.0),
(10, 'Historia', 8.0);

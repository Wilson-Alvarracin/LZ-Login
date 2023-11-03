-- Crear la base de datos "bd_zorritos" si no existe y seleccionarla
CREATE DATABASE IF NOT EXISTS `bd_zorritos`;
USE `bd_zorritos`;

-- Tabla de Alumnos
CREATE TABLE tbl_alumnos (
    id_alumno INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    apellidos VARCHAR(255),
    fecha_nacimiento DATE,
    direccion VARCHAR(255),
    correo_electronico VARCHAR(255),
    telefono VARCHAR(20)
);

-- Tabla de Notas
CREATE TABLE tbl_notas (
    id_nota INT AUTO_INCREMENT PRIMARY KEY,
    id_alumno INT,
    materia VARCHAR(255),
    calificacion DECIMAL(5, 2),
    fecha_calificacion DATE,
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
    materia VARCHAR(255),
    calificacion_promedio DECIMAL(5, 2),
    id_mejor_alumno INT,
    FOREIGN KEY (id_mejor_alumno) REFERENCES tbl_alumnos(id_alumno)
);

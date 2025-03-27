DROP DATABASE IF EXISTS TuCasa;
CREATE DATABASE TuCasa;

USE TuCasa;

-- Tabla de usuarios
CREATE TABLE usuarios (
    id_usuarios INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    tipo ENUM('admin', 'cliente', 'agente') NOT NULL
);

-- Tabla de propiedades
CREATE TABLE propiedades (
    id_propiedad INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(255),
    precio DECIMAL(10,2),
    contacto VARCHAR(255) NOT NULL,
    ubicacion VARCHAR(255),
    tipo VARCHAR(50), -- Ejemplo: Casa, Departamento, Terreno
    estado ENUM('Disponible', 'Ocupado', 'Reservado') DEFAULT 'Disponible',
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de casas
CREATE TABLE casas (
    id_casa INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen VARCHAR(255),
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de reseñas
CREATE TABLE resenas (
    id_resena INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    propiedad_id INT,
    imagen VARCHAR(100),
    nombre VARCHAR(100),
    fecha_resena TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    comentario TEXT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id_usuarios) ON DELETE CASCADE,
    FOREIGN KEY (propiedad_id) REFERENCES propiedades(id_propiedad) ON DELETE CASCADE
);

-- Tabla de nosotros
CREATE TABLE nosotros (
    id_nosotros INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(255) NOT NULL
);

-- Tabla de noticias
CREATE TABLE noticias (
    id_noticias INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    fecha_publicacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de servicios
CREATE TABLE servicios (
    idServicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    descripcion VARCHAR(100),
    imagen VARCHAR(100)
);


drop table email;
-- Tabla de email
CREATE TABLE email (
    id_email INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    texto TEXT NOT NULL,
   
);

-- Tabla de imagenes
CREATE TABLE imagenes (
    id_imagen INT AUTO_INCREMENT PRIMARY KEY,
    id_noticias INT,
    id_propiedad INT,
    ruta_imagen VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_noticias) REFERENCES noticias(id_noticias) ON DELETE CASCADE,
    FOREIGN KEY (id_propiedad) REFERENCES propiedades(id_propiedad) ON DELETE CASCADE
);



CREATE DATABASE facturas;

use facturas;

CREATE TABLE alumnos(
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  ApellidoP VARCHAR(255) NOT NULL,
  ApellidoM VARCHAR(255) NOT NULL,
  FechaN date,
  CURP VARCHAR(19) NOT NULL,
  NivelEducativo VARCHAR(19) NOT NULL,
  Grado VARCHAR(19) NOT NULL,
  Matricula VARCHAR(19) NOT NULL,
  FechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE padres(
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  ApellidoP VARCHAR(255) NOT NULL,
  ApellidoM VARCHAR(255) NOT NULL,
  Direccion VARCHAR(255) NOT NULL,
  CP int(10),
  FechaN DATE,
  RFC VARCHAR(19) NOT NULL,
  RegimenFiscal VARCHAR(200) NOT NULL,
  FechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Administrativos(
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  Usuario VARCHAR(255) NOT NULL,
  Contrasenia VARCHAR(255) NOT NULL,
  NombreCompleto VARCHAR(255) NOT NULL,
  Permisos VARCHAR(255) NOT NULL,
  FechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Bitacora(
  id INT(11) PRIMARY KEY AUTO_INCREMENT,
  Usuario VARCHAR(255) NOT NULL,
  Accion VARCHAR(255) NOT NULL,
  Fecha DATE NOT NULL DEFAULT CURRENT_DATE,
  Hora TIME NOT NULL DEFAULT CURRENT_TIME
);

INSERT INTO Administrativos (Usuario, Contrasenia, NombreCompleto, Permisos) 
VALUES 
('Director', 'admin1234', 'Luis Gomez Hernandez', 'admin'),
('Contador', 'user1234', 'Luis Perez Prado', 'usuario');


CREATE TABLE meses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(20) NOT NULL
);

-- Insertar datos de los meses
INSERT INTO meses (nombre) VALUES
('Enero'), ('Febrero'), ('Marzo'), ('Abril'), 
('Mayo'), ('Junio'), ('Julio'), ('Agosto'),
('Septiembre'), ('Octubre'), ('Noviembre'), ('Diciembre');

CREATE TABLE estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    inicial VARCHAR(5) NOT NULL
);

INSERT INTO estados (nombre, inicial) VALUES
('Aguascalientes', 'AS'),
('Baja California', 'BC'),
('Baja California Sur', 'Bs'),
('Campeche', 'CC'),
('Chiapas', 'CS'),
('Chihuahua', 'CH'),
('Ciudad de México', 'DF'),
('Coahuila', 'CL'),
('Colima', 'CM'),
('Durango', 'DG'),
('Estado de México', 'MC'),
('Guanajuato', 'GT'),
('Guerrero', 'GR'),
('Hidalgo', 'HG'),
('Jalisco', 'JC'),
('Michoacán', 'MN'),
('Morelos', 'MS'),
('Nayarit', 'NT'),
('Nuevo León', 'NL'),
('Oaxaca', 'OC'),
('Puebla', 'PL'),
('Querétaro', 'QT'),
('Quintana Roo', 'QR'),
('San Luis Potosí', 'SP'),
('Sinaloa', 'SL'),
('Sonora', 'SR'),
('Tabasco', 'TC'),
('Tamaulipas', 'TS'),
('Tlaxcala', 'TL'),
('Veracruz', 'VZ'),
('Yucatán', 'YN'),
('Zacatecas', 'ZS'),
('Nacido en el extrangero', 'NE');

CREATE TABLE PadreHijo (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    idPadre INT(11) NOT NULL,
    idHijo INT(11) NOT NULL,
    FOREIGN KEY (idPadre) REFERENCES Padres(id),
    FOREIGN KEY (idHijo) REFERENCES Alumnos(id)
);

CREATE TABLE factura (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    idPadre INT(11) NOT NULL,
    idHijo INT(11) NOT NULL,
    FechaRegistro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idPadre) REFERENCES Padres(id),
    FOREIGN KEY (idHijo) REFERENCES Alumnos(id)
);
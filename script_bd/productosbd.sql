DROP DATABASE productosbd;
CREATE DATABASE	 IF NOT EXISTS productosbd;
USE productosbd;
CREATE TABLE productos (
id int auto_increment primary key,
nombre varchar (50),
descripcion varchar (250),
precio float,
imagen BLOB
);
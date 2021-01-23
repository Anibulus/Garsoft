create database garsoft;

create table marcaAuto(
    idMarca int identity null,
    nombre varchar(20) not null,
    CONSTRAINT pkMarcaAuto PRIMARY KEY (idMarca)
);

create table categoriaProducto(
    idCategoria int identity null,
    nombre varchar(50) not null,
    CONSTRAINT pkCategoriaProducto PRIMARY KEY (idCategoria)   
);

create table producto(
    idProducto int identity null,
    nombre varchar(50) not null,
    idCategoria int default 1 /*o not null*/,
    activo TINYINT default 0, --Esta campo muestra si se vende o no por parte de ellos
    CONSTRAINT pkProducto PRIMARY KEY (idProducto),
    CONSTRAINT fkProducto_Categora FOREIGN KEY (idCategoria) references categoriaProducto (idCategoria)
);

create table modeloAuto(
    idModelo int identity null,
    nombre varchar(50) not null,
    idMarca int not null,
    opcion1 int not null,
    CONSTRAINT pkModeloAuto PRIMARY KEY (idModelo),
    CONSTRAINT fkModeloAuto_MarcaAuto FOREIGN KEY (idMarca) REFERENCES marcaAuto (idMarca),
    CONSTRAINT fkModeloAuto_Bateria FOREIGN KEY (opcion1) references producto (idProducto)
);

create table intermediaModeloAuto_Producto(
    idProducto int not null,
    idModelo int not null,
    CONSTRAINT pkIntermediaModeloAutoProducto primary key (idProducto,idModelo),
    CONSTRAINT fkIntermediaModeloAutoProducto_Producto FOREIGN KEY (idProducto) references producto (idProducto),
    CONSTRAINT fkIntermediaModeloAutoProducto_ModeloAuto FOREIGN KEY (idModelo) references modeloAuto (idModelo)
)

/*Seccion producto*/
insert into categoriaProducto (nombre) values (Bateria);
insert into producto (nombre, idCategoria) values ('Bateria 1',1);
/*Seccion Autos*/
insert into marcaAuto (nombre) values
('Primero que no se ve'),--1
('Alfa Romeo'),--2
('Audi'),--3
--Se esta usando id bateria primera opcion 1 para pruebas
insert into modeloAuto (nombre,idMarca,opcion1) values 
('147',2,1),--1
('158',2,1),
('Guileta',2,1),
('Mito',2,1),
('A1',3,1),
('A1 SportBack',3,1),


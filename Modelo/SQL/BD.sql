create database garsoft;
use garsoft;
create table marcaAuto(
    idMarca int AUTO_INCREMENT,
    nombre varchar(20) not null,
    CONSTRAINT pkMarcaAuto PRIMARY KEY (idMarca)
);

create table modeloAuto(
    idModelo int Auto_Increment,
    idMarca int not null,
    nombre varchar(50) not null,
    anio int null,    
    CONSTRAINT pkModeloAuto PRIMARY KEY (idModelo),
    CONSTRAINT fkModeloAuto_MarcaAuto FOREIGN KEY (idMarca) REFERENCES marcaAuto (idMarca)
);
/*Fin de seccion autos*/


create table categoriaProducto(
    idCategoria int Auto_Increment,
    nombre varchar(50) not null,
    CONSTRAINT pkCategoriaProducto PRIMARY KEY (idCategoria)
);

create table marcaProducto(
    idMarca int Auto_Increment,
    nombre varchar(50) not null,
    mesesGarantia int not null,
    CONSTRAINT pkmarcaProducto PRIMARY KEY (idMarca)
);

create table cascos(
    idCasco int Auto_Increment,
    numeroDeCasco int not null,
    precio decimal(10,2),
    CONSTRAINT pkCasco PRIMARY KEY (idCasco)
);
create table tipo(
    idTipo int AUTO_INCREMENT,
    nombre varchar(35),
    idCasco int null,
    CONSTRAINT pkTipo PRIMARY KEY (idTipo),
    CONSTRAINT fkTipo_Casco FOREIGN KEY (idCasco) REFERENCES  cascos (idCasco)
);


create table producto(
    idProducto int Auto_Increment,   
    cantidad int not null,    
    idCategoria int default 1 not null,
    idMarca int not null,    
    idTipo int null,
    activo TINYINT default 0,
    /*descripcion varchar(100) null,*/
    CONSTRAINT pkProducto PRIMARY KEY (idProducto),
    CONSTRAINT fkProducto_Categoria FOREIGN KEY (idCategoria) references categoriaProducto (idCategoria),
    CONSTRAINT fkProducto_Marca FOREIGN KEY (idMarca) REFERENCES  marcaProducto (idMarca),    
    CONSTRAINT fkProducto_Tipo FOREIGN KEY (idTipo) REFERENCES  tipo (idTipo) 
);

create table precios(
    idPrecio int AUTO_INCREMENT,
    idProducto int not null,
    precio decimal(10,2) not null,
    garantia TINYINT default 0,
    fecha datetime, 
    activo TINYINT default 1,
    /*descripcion varchar(50),*/
    constraint pkPrecios PRIMARY KEY (idPrecio),
    constraint fkPrecio_Producto FOREIGN KEY (idProducto) references producto(idProducto)
);

/*create table intermediaPrecioProducto(
    idPrecio int not null,
    idProducto int not null,
    constraint pkintermediPrecioProducto PRIMARY KEY (idPrecio, idProducto),
    constraint fkintermediPrecioProducto_Producto FOREIGN KEY (idProducto) references producto(idProducto) ,
    CONSTRAINT fkintermediPrecioProducto_Precio FOREIGN KEY (idPrecio) REFERENCES  precios (idPrecio)
);*/


create table intermediaModeloAuto_Producto(
    idProducto int not null,
    idModelo int not null,
    CONSTRAINT pkIntermediaModeloAutoProducto primary key (idProducto,idModelo),
    CONSTRAINT fkIntermediaModeloAutoProducto_Producto FOREIGN KEY (idProducto) references producto (idProducto),
    CONSTRAINT fkIntermediaModeloAutoProducto_ModeloAuto FOREIGN KEY (idModelo) references modeloAuto (idModelo)
);

/*Seccion compra*/
create table persona(
    idPersona int Auto_Increment,
    nombre varchar(50) not null,
    apellido1 varchar(50) not null,
    apellido2 varchar(50),
    correo varchar(50),
    telefono varchar(14),
    CONSTRAINT pkPersona PRIMARY KEY (idPersona)
);

create table empresa(
    idEmpresa int Auto_Increment,
    nombre varchar(50),
    telefono varchar(14),
    CONSTRAINT pkEmpresa PRIMARY KEY (idEmpresa)
);

create table provedor(
    idPersona int not null,
    idEmpresa int not null,
    CONSTRAINT fkProvedor_Persona FOREIGN KEY (idPersona) REFERENCES persona (idPersona),
    CONSTRAINT fkProvedor_Empresa FOREIGN KEY (idEmpresa) REFERENCES empresa (idEmpresa),
    CONSTRAINT pkProvedor PRIMARY KEY (idPersona)
);

create table perfil(
    idPerfil int Auto_Increment,
    nombre varchar(20),
    CONSTRAINT pkPerfil PRIMARY KEY (idPerfil)
);

create table usuario(
    idPersona int not null,
    usuario varchar(10),
    contrasena varchar(50),/*TODO usar MD5*/
    ultimoInicio DATETIME,
    idPerfil int not null,
    activo TINYINT DEFAULT 1,
    CONSTRAINT pkUsuario PRIMARY KEY (idPersona),
    CONSTRAINT fkUsuario_Persona FOREIGN KEY (idPersona) REFERENCES persona (idPersona),
    CONSTRAINT fkUsuario_Perfil FOREIGN KEY (idPerfil) REFERENCES perfil (idPerfil)
);

create table compra(
    idCompra int Auto_Increment,
    idProvedor int not null,
    idEmpleado int not null,
    fecha datetime not null,
    CONSTRAINT pkCompra PRIMARY KEY (idCompra),
    CONSTRAINT fkCompra_Provedor FOREIGN KEY (idProvedor) REFERENCES provedor (idPersona),
    CONSTRAINT fkCompra_Empleado FOREIGN key (idEmpleado) REFERENCES persona (idPersona)
);

create table intermediaCompraProducto(
    idCompra int not null,
    idProducto int not null,
    cantidad int not null,
    subtotal decimal(10,2) not null,
    CONSTRAINT pkIntermediaCompraProducto PRIMARY KEY (idCompra, idProducto),
    CONSTRAINT fkIntermediaCompraProducto_Compra FOREIGN KEY (idCompra) REFERENCES compra (idCompra),
    CONSTRAINT fkIntermediaCompraProducto_Producto FOREIGN KEY (idProducto) REFERENCES producto (idProducto)
);

CREATE TABLE cliente (
    idPersona int not null,
    CONSTRAINT pkCliente PRIMARY KEY (idPersona),
    CONSTRAINT fkCliente FOREIGN KEY (idPersona) REFERENCES persona (idPersona)
);

create TABLE formaPago(
    idFormaPago int auto_increment,
    descripcion varchar(35),
    CONSTRAINT pkFormaPago PRIMARY KEY (idFormaPago)
);

create table venta (
    idVenta bigint Auto_Increment, /*Reiniciar al empezar año*/
    anio int not null,
    fecha datetime,
    idModelo int null,
    idEmpleado int not null,
    idCliente int not null,
    idFormaPago int not null default 0, 
    CONSTRAINT pkVenta PRIMARY KEY (idVenta, anio),
    CONSTRAINT fkVenta_Modelo FOREIGN KEY  (idModelo) REFERENCES modeloAuto(idModelo),
    CONSTRAINT fkVenta_Empleado FOREIGN KEY (idEmpleado) REFERENCES persona (idPersona),
    CONSTRAINT fkVenta_Cliente FOREIGN KEY (idCliente) REFERENCES cliente (idPersona),
    constraint fkVenta_FormaPago FOREIGN KEY (idFormaPago) REFERENCES  formaPago (idFormaPago)

);

create table intermediaVentaProducto(
    idVenta BIGINT not null,
    idProducto int not null,
    cantidad int not null,
    costo decimal(15,2) not null,
    CONSTRAINT pkIntermediaVentaProducto PRIMARY KEY (idVenta, idProducto),
    CONSTRAINT fkIntermediaVentaProducto_Venta FOREIGN KEY (idVenta) references venta (idVenta),
    CONSTRAINT fkIntermediaVentaProducto_Producto FOREIGN KEY (idProducto) REFERENCES  producto (idProducto)
);

/*Seccion pendiente*/
/*Seccion menu*/
create table menu(
    idMenu int Auto_Increment,
    nombre varchar (30),
    direccion varchar(100),
    CONSTRAINT pkMenu PRIMARY KEY (idMenu)
);

create table intermediaPerfilMenu(
    idMenu int not null,
    idPerfil int not null,
    CONSTRAINT pkIntermediaPerfilMenu PRIMARY KEY (idMenu, idPerfil),
    CONSTRAINT fkIntermediaPerfilMenu_Menu FOREIGN KEY (idMenu) REFERENCES menu (idMenu),
    CONSTRAINT fkIntermediaPerfilMenu_Perfil FOREIGN KEY (idPerfil) REFERENCES  perfil (idPerfil) 
);

create table factura (
    idVenta int not null,
    CONSTRAINT pkFactura PRIMARY KEY (idVenta),
    CONSTRAINT fkFactura_Venta FOREIGN KEY (idVenta) REFERENCES venta (idVenta)
);

/*Seccion producto*/
insert into categoriaProducto values
(null,'Servicio'),
(null,'Batería Automotriz'),
(null,'Batería AA'),
(null,'Anticongelante');

insert into marcaProducto values
(null,'LTH', 48),
(null,'LTH TAXI', 30),
(null, 'LTH HITEC', 60),
(null, 'LTH SUV', 65),
(null,'CRONOS', 36),
(null,'America', 60),
(null, 'Especial', 18),
(null, 'AGM', 72),
(null, 'Optima', 0),
(null, 'Gallito', 0); /*TODO ver marca gallito*/

insert into cascos values 
(null, 1, 255.20),
(null, 2, 331.76),
(null, 3, 433.84),
(null, 4, 510.40),
(null, 5, 638.00),
(null, 6, 1276.00);

insert into tipo values 
(null,'22F',2),
(null, '24', 3),
(null, '24R', 3),
(null, '26R',2),
(null, '27700',4),
(null, '27F', 4),
(null, '29DC', 5),
(null, '31P-750',5),
(null, '31P-900',5),
(null, '31T-75',5),
(null, '31T-900',5),
(null, '34',3),
(null, '34-78',3),
(null, '35',3),
(null, '4-6VOLT',5),
(null, '4D',6),
(null, '4DLT', 6),
(null, '41',3),
(null, '42',2),
(null, '42-500',2),
(null, '42R',2),
(null, '44B19',1),
(null, '47',3),
(null, '48-91',3),
(null, '49',4),
(null, '51',2),
(null, '51R',2),
(null, '58',2),
(null, '58R',2),
(null, '65',4),
(null, '75', 3),
(null, '75-86',3),
(null, '78', 3),
(null, '8D',6),
(null, '99',1),
(null, '94R',4),
/*Se dejaron de fabricxar y parecen ser grupo 2*/
(null, 'GC2-122-6V', 2),
(null, 'GC8-117-8V',2),
(null, 'NS40',1),
(null, 'NS40Z',1),
(null, 'U1',1);

insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*Va LTH*/
(null,0,2,1,1,1),
(null,0,2,1,2,1),
(null,0,2,1,3,1),
(null,0,2,1,4,1),
(null,0,2,1,5,1),
(null,0,2,1,6,1),
(null,0,2,1,8,1),
(null,0,2,1,9,1),
(null,0,2,1,10,1),
(null,0,2,1,11,1),
(null,0,2,1,12,1),
(null,0,2,1,13,1),
(null,0,2,1,14,1),
(null,0,2,1,15,1),
(null,0,2,1,16,1),
(null,0,2,1,17,1),
(null,0,2,1,18,1),
(null,0,2,1,19,1),
(null,0,2,1,20,1),
(null,0,2,1,21,1),
(null,0,2,1,22,1),
(null,0,2,1,23,1),
(null,0,2,1,24,1),
(null,0,2,1,26,1),
(null,0,2,1,27,1),
(null,0,2,1,28,1),
(null,0,2,1,29,1),
(null,0,2,1,30,1),
(null,0,2,1,31,1),
(null,0,2,1,32,1),
(null,0,2,1,34,1),
(null,0,2,1,35,1),
(null,0,2,1,36,1),
(null,0,2,1,39,1),
(null,0,2,1,40,1);

insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*LTH TAXI*/
(null,0,2,2,1,1),
(null,0,2,2,12,1),
(null,0,2,2,14,1),
(null,0,2,2,23,1),
(null,0,2,2,30,1);

insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*LTH HITEC*/
(null,0,2,3,1,1),
(null,0,2,3,2,1),
(null,0,2,3,3,1),
(null,0,2,3,4,1),
(null,0,2,3,5,1),
(null,0,2,3,6,1),
(null,0,2,3,12,1),
(null,0,2,3,13,1),
(null,0,2,3,14,1),
(null,0,2,3,18,1),
(null,0,2,3,20,1),
(null,0,2,3,23,1),
(null,0,2,3,24,1),
(null,0,2,3,25,1),
(null,0,2,3,28,1),
(null,0,2,3,30,1),
(null,0,2,3,31,1),
(null,0,2,3,32,1),
(null,0,2,3,33,1),
(null,0,2,3,35,1);


insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*LTH SUV*/
(null,0,2,4,12,1),
(null,0,2,4,14,1),
(null,0,2,4,23,1),
(null,0,2,4,30,1);

insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*Primero las de CRONOS*/
(null,0,2,5,1,1),
(null,0,2,5,2,1),
(null,0,2,5,3,1),
(null,0,2,5,8,1),
(null,0,2,5,10,1),
(null,0,2,5,12,1),
(null,0,2,5,14,1),
(null,0,2,5,17,1),
(null,0,2,5,18,1),
(null,0,2,5,19,1),
(null,0,2,5,21,1),
(null,0,2,5,23,1),
(null,0,2,5,28,1),
(null,0,2,5,30,1),
(null,0,2,5,31,1),
(null,0,2,5,32,1),
(null,0,2,5,34,1),
(null,0,2,5,35,1),
(null,0,2,5,39,1);


insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*Va America*/
(null,0,2,6,1,1),
(null,0,2,6,2,1),
(null,0,2,6,3,1),
(null,0,2,6,4,1),
(null,0,2,6,5,1),
(null,0,2,6,6,1),
(null,0,2,6,8,1),
(null,0,2,6,9,1),
(null,0,2,6,10,1),
(null,0,2,6,11,1),
(null,0,2,6,12,1),
(null,0,2,6,13,1),
(null,0,2,6,14,1),
(null,0,2,6,17,1),
(null,0,2,6,18,1),
(null,0,2,6,19,1),
(null,0,2,6,20,1),
(null,0,2,6,21,1),
(null,0,2,6,22,1),
(null,0,2,6,23,1),
(null,0,2,6,24,1),
(null,0,2,6,26,1),
(null,0,2,6,27,1),
(null,0,2,6,28,1),
(null,0,2,6,29,1),
(null,0,2,6,30,1),
(null,0,2,6,31,1),
(null,0,2,6,32,1),
(null,0,2,6,34,1),
(null,0,2,6,35,1),
(null,0,2,6,36,1),
(null,0,2,6,39,1),
(null,0,2,6,40,1);

insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*Especial*/
(null,0,2,7,2,1),
(null,0,2,7,3,1),
(null,0,2,7,6,1),
(null,0,2,7,7,1),
(null,0,2,7,10,1),
(null,0,2,7,16,1),
(null,0,2,7,37,1),
(null,0,2,7,38,1),
(null,0,2,7,41,1);

insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*AGM*/
(null,0,2,8,3,1),
(null,0,2,8,10,1),
(null,0,2,8,12,1),
(null,0,2,8,14,1),
(null,0,2,8,23,1),
(null,0,2,8,24,1),
(null,0,2,8,25,1),
(null,0,2,8,30,1),
(null,0,2,8,36,1);

select p.idProducto, t.nombre, t.idCasco from producto p
join tipo t on p.idTipo = t.idTipo
where idMarca=3;


select p.idProducto, mp.nombre as marca, t.nombre as tipo, t.idCasco as casco
from producto p
join tipo t on p.idTipo = t.idTipo
join marcaProducto mp on p.idMarca = mp.idMarca;

/*Listado de Precios*/ 
insert into precios (idPrecio, idProducto, precio, garantia, fecha, activo) values 
/*Primeor baterias sin garantía*/
(null,1,1600.00,0,curdate(),1),
(null,2,1760.00,0,curdate(),1),
(null,3,1920.00,0,curdate(),1),
(null,4,1600.00,0,curdate(),1),
(null,5,2320.00,0,curdate(),1),
(null,6,2080.00,0,curdate(),1),
(null,7,1960.00,0,curdate(),1),
(null,8,2128.00,0,curdate(),1),
(null,9,1960.00,0,curdate(),1),
(null,10,2128.00,0,curdate(),1),
(null,11,2080.00,0,curdate(),1),
(null,12,2200.00,0,curdate(),1),
(null,13,1920.00,0,curdate(),1),
(null,14,1400.00,0,curdate(),1),
(null,15,3520.00,0,curdate(),1),
(null,16,3016.00,0,curdate(),1),
(null,17,2080.00,0,curdate(),1),
(null,18,1600.00,0,curdate(),1),
(null,19,1840.00,0,curdate(),1),
(null,20,1840.00,0,curdate(),1),
(null,21,1680.00,0,curdate(),1),
(null,22,2040.00,0,curdate(),1),
(null,23,2320.00,0,curdate(),1),
(null,24,1920.00,0,curdate(),1),
(null,25,1920.00,0,curdate(),1),
(null,26,1760.00,0,curdate(),1),
(null,27,2040.00,0,curdate(),1),
(null,28,2160.00,0,curdate(),1),
(null,29,1880.00,0,curdate(),1),
(null,30,2080.00,0,curdate(),1),
(null,31,3760.00,0,curdate(),1),
(null,32,1600.00,0,curdate(),1),
(null,33,2400.00,0,curdate(),1),
(null,34,1680.00,0,curdate(),1),
(null,35,1680.00,0,curdate(),1),
/*LTH TAXI*/
(null,36,1760.00,0,curdate(),1),
(null,37,2360.00,0,curdate(),1),
(null,38,2184.00,0,curdate(),1),
(null,39,2184.00,0,curdate(),1),
(null,40,2440.00,0,curdate(),1),
/*LTH HITEC*/
(null,41,1848.00,0,curdate(),1),
(null,42,2058.00,0,curdate(),1),
(null,43,2226.00,0,curdate(),1),
(null,44,1848.00,0,curdate(),1),
(null,45,2688.00,0,curdate(),1),
(null,46,2436.00,0,curdate(),1),
(null,47,2394.00,0,curdate(),1),
(null,48,2562.00,0,curdate(),1),
(null,49,2226.00,0,curdate(),1),
(null,50,2394.00,0,curdate(),1),
(null,51,2142.00,0,curdate(),1),
(null,52,2352.00,0,curdate(),1),
(null,53,2688.00,0,curdate(),1),
(null,54,2730.00,0,curdate(),1),
(null,55,2016.00,0,curdate(),1),
(null,56,2478.00,0,curdate(),1),
(null,57,2184.00,0,curdate(),1),
(null,58,2436.00,0,curdate(),1),
(null,59,1974.00,0,curdate(),1),
(null,60,1848.00,0,curdate(),1),
/*LTH SUV*/
(null,61,2419.00,0,curdate(),1),
(null,62,2238.60,0,curdate(),1),
(null,63,2238.60,0,curdate(),1),
(null,64,2501.00,0,curdate(),1),
/*Cronos*/
(null,65,1189.00,0,curdate(),1),
(null,66,1271.00,0,curdate(),1),
(null,67,1476.00,0,curdate(),1),
(null,68,1681.00,0,curdate(),1),
(null,69,1681.00,0,curdate(),1),
(null,70,1558.00,0,curdate(),1),
(null,71,1476.00,0,curdate(),1),
(null,72,2681.40,0,curdate(),1),
(null,73,1599.00,0,curdate(),1),
(null,74,1189.00,0,curdate(),1),
(null,75,1271.00,0,curdate(),1),
(null,76,1476.00,0,curdate(),1),
(null,77,1353.00,0,curdate(),1),
(null,78,1681.00,0,curdate(),1),
(null,79,1476.00,0,curdate(),1),
(null,80,1599.00,0,curdate(),1),
(null,81,3280.00,0,curdate(),1),
(null,82,1189.00,0,curdate(),1),
(null,83,1312.00,0,curdate(),1),
/*AMERICANA*/
(null,84,1353.00,0,curdate(),1),
(null,85,1360.00,0,curdate(),1),
(null,86,1600.00,0,curdate(),1),
(null,87,1320.00,0,curdate(),1),
(null,88,1880.00,0,curdate(),1),
(null,89,1760.00,0,curdate(),1),
(null,90,1640.00,0,curdate(),1),
(null,91,1760.00,0,curdate(),1),
(null,92,1640.00,0,curdate(),1),
(null,93,1760.00,0,curdate(),1),
(null,94,1760.00,0,curdate(),1),
(null,95,1880.00,0,curdate(),1),
(null,96,1600.00,0,curdate(),1),
(null,97,2616.00,0,curdate(),1),
(null,98,1760.00,0,curdate(),1),
(null,99,1320.00,0,curdate(),1),
(null,100,1480.00,0,curdate(),1),
(null,101,1480.00,0,curdate(),1),
(null,102,1400.00,0,curdate(),1),
(null,103,1640.00,0,curdate(),1),
(null,104,1880.00,0,curdate(),1),
(null,105,1560.00,0,curdate(),1),
(null,106,1560.00,0,curdate(),1),
(null,107,1440.00,0,curdate(),1),
(null,108,1640.00,0,curdate(),1),
(null,109,1760.00,0,curdate(),1),
(null,110,1600.00,0,curdate(),1),
(null,111,1760.00,0,curdate(),1),
(null,112,3200.00,0,curdate(),1),
(null,113,1320.00,0,curdate(),1),
(null,114,1960.00,0,curdate(),1),
(null,115,1400.00,0,curdate(),1),
(null,116,1400.00,0,curdate(),1),
/*Escpecial*/
(null,117,1681.00,0,curdate(),1),
(null,118,1886.00,0,curdate(),1),
(null,119,2050.00,0,curdate(),1),
(null,120,2829.00,0,curdate(),1),
(null,121,2501.00,0,curdate(),1),
(null,122,4141.00,0,curdate(),1),
(null,123,2665.00,0,curdate(),1),
(null,124,2706.00,0,curdate(),1),
(null,125,1148.00,0,curdate(),1),
/*AGM*/
(null,126,3280.00,0,curdate(),1),
(null,127,4360.00,0,curdate(),1),
(null,128,3520.00,0,curdate(),1),
(null,129,3240.00,0,curdate(),1),
(null,130,3320.00,0,curdate(),1),
(null,131,3840.00,0,curdate(),1),
(null,132,3960.00,0,curdate(),1),
(null,133,3560.00,0,curdate(),1),
(null,134,3880.00,0,curdate(),1);


  

select p.idProducto, mp.nombre as marca, t.nombre as tipo,
(select /*TODO ver top(1)*/
r.precio from precios r
where p.idProducto=r.idProducto and 
r.activo=1 and 
r.garantia=0) as precio,
t.idCasco as casco,
(select r.precio from cascos r
where r.idCasco=t.idCasco) as precioCasco
from producto p
join tipo t on p.idTipo = t.idTipo
join marcaProducto mp on p.idMarca = mp.idMarca;

/*Seccion Autos*/
insert into marcaAuto (nombre) values
('Primero que no se ve'),--1
('Alfa Romeo'),--2
('Audi');--3
--Se esta usando id bateria primera opcion 1 para pruebas
insert into modeloAuto (nombre,idMarca,opcion1) values 
('147',2,1),--1
('158',2,1),
('Guileta',2,1),
('Mito',2,1),
('A1',3,1),
('A1 SportBack',3,1);


/*Empleados*/ /*toDO MODIFICAR*/
insert into persona values 
(null, 'Gaby', 'Garza', null,'','3311215488'),
(null, 'Angel Iván', 'Garza', null,'','3321164306'),
(null, 'Jonathan', 'Quien sabe', null,'',''),
(null, 'Mario', 'Quien Sabe', null,'',''),
(null, 'Cliente', 'Anónimo', null,'','');/*Sera usado para cuando no pidan datos*/

insert into perfil VALUES
(null,'Admnistrador'),
(null,'Empleado'),
(null,'Cliente');

insert into usuario values 
(1,'Gaby','123',CURDATE(),1,1),
(2,'Ivon','123',CURDATE(),1,1),
(3,'Jony','123',CURDATE(),2,1),
(4,'Mario','123',CURDATE(),2,1);

insert into empresa values 
(null, 'LTH',''),
(null, 'CRONOS',''),
(null, 'America',''),
(null, 'Indeseables','');

/*Extras trigger*/
create table TRModificoInventario(
    idModificacion int AUTO_INCREMENT,
    idResponsable int not null,
    idProducto int not null,
    fecha DATETIME not null,
    cantidadAnterior int,
    cantidadCambiado int,
    CONSTRAINT pkModificacoInventario PRIMARY KEY (idModificacion),
    CONSTRAINT fkModificacoInventario_Persona FOREIGN KEY (idResponsable) REFERENCES persona (idPersona),
    CONSTRAINT fkModificacoInventario_Producto FOREIGN KEY  (idProducto) REFERENCES  producto (idProducto)
);

create table TRElevacionPrecio(
    idElevacion int AUTO_INCREMENT,
    idResponsable int not null,
    idProducto int not null,
    fecha DATETIME not null,
    precioAnterior decimal(15,2) not null,
    precioCambiado decimal (15,2) not null,
    CONSTRAINT pkElevacionPrecio PRIMARY KEY (idElevacion),
    CONSTRAINT fkElevacionPrecio_Persona FOREIGN KEY (idResponsable) REFERENCES persona (idPersona),
    CONSTRAINT fkElevacionPrecio_Producto FOREIGN KEY  (idProducto) REFERENCES  producto (idProducto)
);


/*
DELIMITER $$;
CREATE 
    TRIGGER ElevacionPrecio after UPDATE on producto
    insert into TRElevacionPrecio values (null,1,1,CURDATE(),1,new.precioPublico);
END$$
DELIMITER ;


DELIMITER $$;
CREATE 
    TRIGGER ElevacionPrecio after UPDATE on producto
    for each row BEGIN
    if new.idCategoria=2 THEN
        SELECT COUNT(*) INTO param1 FROM t;
    elseif new.idCategoria=1 THEN
        insert into TRElevacionPrecio values (null,1,1,CURDATE(),1,1);
    else new.idCategoria=1 THEN
        insert into TRElevacionPrecio values (null,1,1,CURDATE(),1,1);
    end if;
END$$
DELIMITER ;



CREATE PROCEDURE simpleproc (OUT param1 INT)
SELECT COUNT(*) INTO param1 FROM t;
SELECT @a;
CREATE FUNCTION hello (s CHAR(20)) RETURNS CHAR(50)
RETURN CONCAT('Hello, ',s,'!');
SELECT hello('world');
*/

/*Consultas del programa*/
DELIMITER ||
CREATE Procedure InicioSesion (username VARCHAR(10), password_p VARCHAR(20))
BEGIN
    SELECT u.idPersona, u.idPerfil, p.nombre, p.apellido1 FROM usuario u
    join persona p on u.idPersona = p.idPersona
    WHERE usuario = username AND contrasena = password_p AND u.activo=1;  
END
||
DELIMITER ;
call iniciosesion('gaby','123');



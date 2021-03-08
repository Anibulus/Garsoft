create database garsoft;
use garsoft;
create table marcaAuto(
    idMarca int AUTO_INCREMENT,
    nombre varchar(20) not null,
    CONSTRAINT pkMarcaAuto PRIMARY KEY (idMarca)
) COLLATE utf8mb4_general_ci;

create table tipoAuto(
    idTipoAuto int Auto_Increment,
    nombre varchar(50) not null,
    CONSTRAINT pkTipoAuto PRIMARY KEY (idTipoAuto)
) COLLATE utf8mb4_general_ci;

create table modeloAuto(
    idModelo int Auto_Increment,
    idMarca int not null,
    idTipoAuto int not null,
    nombre varchar(50) not null,
    anioInicio int null,
    anioFin int null,
    CONSTRAINT pkModeloAuto PRIMARY KEY (idModelo),
    CONSTRAINT fkModeloAuto_MarcaAuto FOREIGN KEY (idMarca) REFERENCES marcaAuto (idMarca),
    CONSTRAINT fkModeloAuto_TipoAuto FOREIGN KEY (idTipoAuto) REFERENCES tipoAuto (idTipoAuto)
) COLLATE utf8mb4_general_ci;

create table categoriaProducto(
    idCategoria int Auto_Increment,
    nombre varchar(50) not null,
    CONSTRAINT pkCategoriaProducto PRIMARY KEY (idCategoria)
) COLLATE utf8mb4_general_ci;

create table marcaProducto(
    idMarca int Auto_Increment,
    nombre varchar(50) not null,
    mesesGarantia int not null,
    CONSTRAINT pkmarcaProducto PRIMARY KEY (idMarca)
) COLLATE utf8mb4_general_ci;

create table cascos(
    idCasco int Auto_Increment,
    numeroDeCasco int not null,
    precio decimal(10,2),
    CONSTRAINT pkCasco PRIMARY KEY (idCasco)
) COLLATE utf8mb4_general_ci;

create table tipo(
    idTipo int AUTO_INCREMENT,
    nombre varchar(35),
    idCasco int null,
    CONSTRAINT pkTipo PRIMARY KEY (idTipo),
    CONSTRAINT fkTipo_Casco FOREIGN KEY (idCasco) REFERENCES cascos (idCasco)
)   COLLATE utf8mb4_general_ci;

create table producto(
    idProducto int Auto_Increment,   
    cantidad int not null,    
    idCategoria int default 1 not null,
    idMarca int not null,    
    idTipo int null,
    activo TINYINT default 0,
    CONSTRAINT pkProducto PRIMARY KEY (idProducto),
    CONSTRAINT fkProducto_Categoria FOREIGN KEY (idCategoria) references categoriaProducto (idCategoria),
    CONSTRAINT fkProducto_Marca FOREIGN KEY (idMarca) REFERENCES  marcaProducto (idMarca),    
    CONSTRAINT fkProducto_Tipo FOREIGN KEY (idTipo) REFERENCES  tipo (idTipo) 
)   COLLATE utf8mb4_general_ci;

create table precios(
    idPrecio int AUTO_INCREMENT,
    idProducto int not null,
    precio decimal(10,2) not null,
    garantia TINYINT default 0,
    fecha datetime, 
    activo TINYINT default 1,
    constraint pkPrecios PRIMARY KEY (idPrecio),
    constraint fkPrecio_Producto FOREIGN KEY (idProducto) references producto(idProducto)
)   COLLATE utf8mb4_general_ci;


create table intermediaModeloAuto_Tipo(
    idTipo int not null,
    idModelo int not null,
    CONSTRAINT pkIntermediaModeloAutoProducto primary key (idTipo,idModelo),
    CONSTRAINT fkIntermediaModeloAutoProducto_Tipo FOREIGN KEY (idTipo) references tipo (idTipo),
    CONSTRAINT fkIntermediaModeloAutoProducto_ModeloAuto FOREIGN KEY (idModelo) references modeloAuto (idModelo)
)   COLLATE utf8mb4_general_ci;

create table persona(
    idPersona int Auto_Increment,
    nombre varchar(50) not null,
    apellido1 varchar(50) not null,
    apellido2 varchar(50),
    correo varchar(50),
    telefono varchar(14),
    CONSTRAINT pkPersona PRIMARY KEY (idPersona)
) COLLATE utf8mb4_general_ci;

create table empresa(
    idEmpresa int Auto_Increment,
    nombre varchar(50),
    telefono varchar(14),
    CONSTRAINT pkEmpresa PRIMARY KEY (idEmpresa)
)   COLLATE utf8mb4_general_ci;

create table provedor(
    idPersona int not null,
    idEmpresa int not null,
    CONSTRAINT fkProvedor_Persona FOREIGN KEY (idPersona) REFERENCES persona (idPersona),
    CONSTRAINT fkProvedor_Empresa FOREIGN KEY (idEmpresa) REFERENCES empresa (idEmpresa),
    CONSTRAINT pkProvedor PRIMARY KEY (idPersona)
)   COLLATE utf8mb4_general_ci;

create table perfil(
    idPerfil int Auto_Increment,
    nombre varchar(20),
    CONSTRAINT pkPerfil PRIMARY KEY (idPerfil)
)   COLLATE utf8mb4_general_ci;

create table usuario(
    idPersona int not null,
    usuario varchar(10),
    contrasena varchar(50),
    ultimoInicio DATETIME,
    idPerfil int not null,
    activo TINYINT DEFAULT 1,
    CONSTRAINT pkUsuario PRIMARY KEY (idPersona),
    CONSTRAINT fkUsuario_Persona FOREIGN KEY (idPersona) REFERENCES persona (idPersona),
    CONSTRAINT fkUsuario_Perfil FOREIGN KEY (idPerfil) REFERENCES perfil (idPerfil)
)   COLLATE utf8mb4_general_ci;

create table compra(
    idCompra int Auto_Increment,
    idProvedor int not null,
    idEmpleado int not null,
    fecha datetime not null,
    CONSTRAINT pkCompra PRIMARY KEY (idCompra),
    CONSTRAINT fkCompra_Provedor FOREIGN KEY (idProvedor) REFERENCES provedor (idPersona),
    CONSTRAINT fkCompra_Empleado FOREIGN key (idEmpleado) REFERENCES persona (idPersona)
)   COLLATE utf8mb4_general_ci;

create table intermediaCompraProductoEntrada(
    idCompra int not null,
    idProducto int not null,
    cantidad int not null,
    subtotal decimal(10,2) not null,
    CONSTRAINT pkIntermediaCompraProductoEntrada PRIMARY KEY (idCompra, idProducto),
    CONSTRAINT fkIntermediaCompraProductoEntrada_Compra FOREIGN KEY (idCompra) REFERENCES compra (idCompra),
    CONSTRAINT fkIntermediaCompraProductoEntrada_Producto FOREIGN KEY (idProducto) REFERENCES producto (idProducto)
)   COLLATE utf8mb4_general_ci;

create table intermediaCompraProductoSalida(
    idCompra int not null,
    idProducto int not null,
    cantidad int not null,
    CONSTRAINT pkIntermediaCompraProductoSalida PRIMARY KEY (idCompra, idProducto),
    CONSTRAINT fkIntermediaCompraProductoSalida_Compra FOREIGN KEY (idCompra) REFERENCES compra (idCompra),
    CONSTRAINT fkIntermediaCompraProductoSalida_Producto FOREIGN KEY (idProducto) REFERENCES producto (idProducto)
)   COLLATE utf8mb4_general_ci;

CREATE TABLE cliente(
    idPersona int not null,
    CONSTRAINT pkCliente PRIMARY KEY (idPersona),
    CONSTRAINT fkCliente FOREIGN KEY (idPersona) REFERENCES persona (idPersona)
)   COLLATE utf8mb4_general_ci;

create TABLE formaPago(
    idFormaPago int auto_increment,
    descripcion varchar(50),
    CONSTRAINT pkFormaPago PRIMARY KEY (idFormaPago)
)   COLLATE utf8mb4_general_ci;

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

)   COLLATE utf8mb4_general_ci;

create table intermediaVentaProductoSalida(
    idVenta BIGINT not null,
    idProducto int not null,
    cantidad int not null,
    costo decimal(15,2) not null,
    CONSTRAINT pkIntermediaVentaProductoSalida PRIMARY KEY (idVenta, idProducto),
    CONSTRAINT fkIntermediaVentaProductoSalida_Venta FOREIGN KEY (idVenta) references venta (idVenta),
    CONSTRAINT fkIntermediaVentaProductoSalida_Producto FOREIGN KEY (idProducto) REFERENCES  producto (idProducto)
)   COLLATE utf8mb4_general_ci;

create table intermediaVentaProductoEntrada(
    idVenta BIGINT not null,
    idProducto int not null,
    cantidad int not null,
    CONSTRAINT pkIntermediaVentaProductoEntrada PRIMARY KEY (idVenta, idProducto),
    CONSTRAINT fkIntermediaVentaProductoEntrada_Venta FOREIGN KEY (idVenta) references venta (idVenta),
    CONSTRAINT fkIntermediaVentaProductoEntrada_Producto FOREIGN KEY (idProducto) REFERENCES  producto (idProducto)
)   COLLATE utf8mb4_general_ci;

/*Seccion pendiente*/
/*Seccion menu*/
create table menu(
    idMenu int Auto_Increment,
    nombre varchar (30),
    direccion varchar(100),
    CONSTRAINT pkMenu PRIMARY KEY (idMenu)
) COLLATE utf8mb4_general_ci;

create table intermediaPerfilMenu(
    idMenu int not null,
    idPerfil int not null,
    CONSTRAINT pkIntermediaPerfilMenu PRIMARY KEY (idMenu, idPerfil),
    CONSTRAINT fkIntermediaPerfilMenu_Menu FOREIGN KEY (idMenu) REFERENCES menu (idMenu),
    CONSTRAINT fkIntermediaPerfilMenu_Perfil FOREIGN KEY (idPerfil) REFERENCES  perfil (idPerfil) 
) COLLATE utf8mb4_general_ci;

create table factura (
    idVenta int not null,
    CONSTRAINT pkFactura PRIMARY KEY (idVenta),
    CONSTRAINT fkFactura_Venta FOREIGN KEY (idVenta) REFERENCES venta (idVenta)
) COLLATE utf8mb4_general_ci;

/*Seccion producto*/
insert into categoriaProducto values
(null, 'Servicio'),
(null, 'Batería de auto'),
(null, 'Batería de moto'),
(null, 'Batería AA'),
(null, 'Anticongelante'),
(null, 'Aromatizante'),
(null, 'Sujetadores'),
(null, 'Terminales'),
(null, 'Limpiador'),
(null, 'Aerosol multiusos'),
(null, 'Aditivos para gasolina'),
(null, 'Crema'),
(null, 'Aceite'),
(null, 'Insumos');

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
(null, 'Gallito', 0),
(null, 'TOHR', 0);;

insert into cascos values 
(null, 1, 255.20),
(null, 2, 331.76),
(null, 3, 433.84),
(null, 4, 510.40),
(null, 5, 638.00),
(null, 6, 1276.00);

insert into tipo (idTipo, nombre, idCasco) values 
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
/*Se dejaron de fabricar y parecen ser grupo 2*/
(null, 'GC2-122-6V', 2),
(null, 'GC8-117-8V',2),
(null, 'NS40',1),
(null, 'NS40Z',1),
(null, 'U1',1),/*Fin de los tipos para baterias de auto*/
/*Aqui comienzan las baterias de moto y sin casco*/
/*CONVENCIONAL*/
(null, '12N5-3B', null),
(null, '12N7-3B', null),
(null, '12N7B-3A', null),
(null, '12N9-4B-1', null),
(null, '12N10-3B', null),
(null, '12N12A-4A-1', null),
(null, '12N14-3A', null),
(null, 'CB3L-B', null),
(null, 'CB4L-B', null),
(null, 'CB5L-B', null),
(null, 'CB6.5L-B', null),
(null, 'CB7-A', null),
(null, 'CB9-B', null),
(null, 'CB12A-A', null),
(null, 'CB14L-A2', null),
(null, 'CB16CL-B', null),
/*AGM LIBRE DE MANTENIMIENTO*/ 
(null, 'CTX4L-BS', null),
(null, 'CTX5L-BS', null),
(null, 'CTX7A-BS', null),
(null, 'CTX7L-BS', null),
(null, 'CT7B-BS', null),
(null, 'CTX9-BS', null),
(null, 'CT9B-BS', null),
(null, 'CTZ10S-BS', null),
(null, 'CTX12-BS', null),
(null, 'CTX14L-BS', null),
(null, 'CTX14-BS', null),
(null, 'CT12B-BS', null),
(null, 'CTX14AH-BS', null),
(null, 'CTX14AHL-BS', null),
(null, 'CT14B-BS', null),
(null, 'CTX16CL-B-BS', null),
(null, 'CTX20CH-BS', null),
(null, 'CTX20HL-BS', null),
(null, 'CTX24HL-BS', null),
(null, 'CTX30L-BS', null),
/*Optima*/
(null, 'OR7525',2),
(null,'OR 35',3),
(null,'OR 3478',3),
(null,'OR34',3),
(null,'OR34R',3),
(null,'OR51R',1),
(null,'OA7525',2),
(null,'OA3478',3),
(null,'OA34',3),
(null,'34M',NULL),/*Es bateria de lancha asi que no les importa*/
(null,'OA35',3),
(null,'OA31T',5),
(null,'D34M',3),
(null,'D37M',4),
(null,'D31M',5);

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

/*Optima*/
insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
(null, 0, 2, 9, 78,1),
(null, 0, 2, 9, 79,1),
(null, 0, 2, 9, 80,1),
(null, 0, 2, 9, 81,1),
(null, 0, 2, 9, 82,1),
(null, 0, 2, 9, 83,1),
(null, 0, 2, 9, 84,1),
(null, 0, 2, 9, 85,1),
(null, 0, 2, 9, 86,1),
(null, 0, 2, 9, 87,1),
(null, 0, 2, 9, 88,1),
(null, 0, 2, 9, 89,1),
(null, 0, 2, 9, 90,1),
(null, 0, 2, 9, 91,1),
(null, 0, 2, 9, 92,1);

insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
/*Gallito*/
(null,0,2,10,1,1),
(null,0,2,10,2,1),
(null,0,2,10,3,1),
(null,0,2,10,4,1),
(null,0,2,10,5,1),
(null,0,2,10,6,1),
(null,0,2,10,7,1),
(null,0,2,10,8,1),
(null,0,2,10,9,1),
(null,0,2,10,10,1),
(null,0,2,10,11,1),
(null,0,2,10,12,1),
(null,0,2,10,13,1),
(null,0,2,10,14,1),
(null,0,2,10,15,1),
(null,0,2,10,16,1),
(null,0,2,10,17,1),
(null,0,2,10,18,1),
(null,0,2,10,19,1),
(null,0,2,10,20,1),
(null,0,2,10,21,1),
(null,0,2,10,22,1),
(null,0,2,10,23,1),
(null,0,2,10,24,1),
(null,0,2,10,25,1),
(null,0,2,10,26,1),
(null,0,2,10,27,1),
(null,0,2,10,28,1),
(null,0,2,10,29,1),
(null,0,2,10,30,1),
(null,0,2,10,31,1),
(null,0,2,10,32,1),
(null,0,2,10,33,1),
(null,0,2,10,34,1),
(null,0,2,10,35,1),
(null,0,2,10,36,1),
(null,0,2,10,37,1),
(null,0,2,10,38,1),
(null,0,2,10,39,1),
(null,0,2,10,40,1),
(null,0,2,10,41,1), /*Retoma las barerias de optima*/
(null, 0, 2, 10, 78,1),
(null, 0, 2, 10, 79,1),
(null, 0, 2, 10, 80,1),
(null, 0, 2, 10, 81,1),
(null, 0, 2, 10, 82,1),
(null, 0, 2, 10, 83,1),
(null, 0, 2, 10, 84,1),
(null, 0, 2, 10, 85,1),
(null, 0, 2, 10, 86,1),
(null, 0, 2, 10, 87,1),
(null, 0, 2, 10, 88,1),
(null, 0, 2, 10, 89,1),
(null, 0, 2, 10, 90,1),
(null, 0, 2, 10, 91,1),
(null, 0, 2, 10, 92,1);

/*Baterias de moto*/
insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
(null,0,3,1,42,1),
(null,0,3,1,43,1),
(null,0,3,1,44,1),
(null,0,3,1,45,1),
(null,0,3,1,46,1),
(null,0,3,1,47,1),
(null,0,3,1,48,1),
(null,0,3,1,49,1),
(null,0,3,1,50,1),
(null,0,3,1,51,1),
(null,0,3,1,52,1),
(null,0,3,1,53,1),
(null,0,3,1,54,1),
(null,0,3,1,55,1),
(null,0,3,1,56,1),
(null,0,3,1,57,1),
/*AGM*/
(null,0,3,8,58,1),
(null,0,3,8,59,1),
(null,0,3,8,60,1),
(null,0,3,8,61,1),
(null,0,3,8,62,1),
(null,0,3,8,63,1),
(null,0,3,8,64,1),
(null,0,3,8,65,1),
(null,0,3,8,66,1),
(null,0,3,8,67,1),
(null,0,3,8,68,1),
(null,0,3,8,69,1),
(null,0,3,8,70,1),
(null,0,3,8,71,1),
(null,0,3,8,72,1),
(null,0,3,8,73,1),
(null,0,3,8,74,1),
(null,0,3,8,75,1),
(null,0,3,8,76,1),
(null,0,3,8,77,1);

/*Servicios*/
/*insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
(null,0, 1,11,78,1),
(null,0, 1,11,79,1),
(null,0, 1,11,80,1);*/

/*De marca especifica*/
/*select p.idProducto, t.nombre, t.idCasco, mp.nombre as marca 
from producto p
join tipo t on p.idTipo = t.idTipo
join marcaProducto mp on p.idMarca = mp.idMarca
where p.idMarca=3;*/

/*De todas las marcas*/
select p.idProducto, mp.nombre as marca, t.nombre as tipo, t.idCasco as casco
from producto p
join tipo t on p.idTipo = t.idTipo
join marcaProducto mp on p.idMarca = mp.idMarca;

/*Muestra solo baterias que tienen casco*/
select p.idProducto, mp.nombre as marca, t.nombre as tipo, t.idCasco as casco
from producto p
join tipo t on p.idTipo = t.idTipo
join cascos c on t.idCasco = c.idCasco
join marcaProducto mp on p.idMarca = mp.idMarca;


/*Listado de Precios*/ 
insert into precios (idPrecio, idProducto, precio, garantia, fecha, activo) values 
/*Primero baterias sin garantía*/
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
(null,134,3880.00,0,curdate(),1),
/*Precio oprima*/
(null,135,3825.00,0,curdate(),1),
(null,136,3655.00,0,curdate(),1),
(null,137,4037.50,0,curdate(),1),
(null,138,3867.50,0,curdate(),1),
(null,139,3867.50,0,curdate(),1),
(null,140,3315.00,0,curdate(),1),
(null,141,4377.50,0,curdate(),1),
(null,142,4802.50,0,curdate(),1),
(null,143,4717.50,0,curdate(),1),
(null,144,4080.00,0,curdate(),1),
(null,145,4377.50,0,curdate(),1),
(null,146,5907.50,0,curdate(),1),
(null,147,4802.50,0,curdate(),1),
(null,148,5737.50,0,curdate(),1),
(null,149,6077.50,0,curdate(),1),
/*Asigna precio de 500 a los gallitos*/
(null,150,500.00,0,curdate(),1),
(null,151,500.00,0,curdate(),1),
(null,152,500.00,0,curdate(),1),
(null,153,500.00,0,curdate(),1),
(null,154,500.00,0,curdate(),1),
(null,155,500.00,0,curdate(),1),
(null,156,500.00,0,curdate(),1),
(null,157,500.00,0,curdate(),1),
(null,158,500.00,0,curdate(),1),
(null,159,500.00,0,curdate(),1),
(null,160,500.00,0,curdate(),1),
(null,161,500.00,0,curdate(),1),
(null,162,500.00,0,curdate(),1),
(null,163,500.00,0,curdate(),1),
(null,164,500.00,0,curdate(),1),
(null,165,500.00,0,curdate(),1),
(null,166,500.00,0,curdate(),1),
(null,167,500.00,0,curdate(),1),
(null,168,500.00,0,curdate(),1),
(null,169,500.00,0,curdate(),1),
(null,170,500.00,0,curdate(),1),
(null,171,500.00,0,curdate(),1),
(null,172,500.00,0,curdate(),1),
(null,173,500.00,0,curdate(),1),
(null,174,500.00,0,curdate(),1),
(null,175,500.00,0,curdate(),1),
(null,176,500.00,0,curdate(),1),
(null,177,500.00,0,curdate(),1),
(null,178,500.00,0,curdate(),1),
(null,179,500.00,0,curdate(),1),
(null,180,500.00,0,curdate(),1),
(null,181,500.00,0,curdate(),1),
(null,182,500.00,0,curdate(),1),
(null,183,500.00,0,curdate(),1),
(null,184,500.00,0,curdate(),1),
(null,185,500.00,0,curdate(),1),
(null,186,500.00,0,curdate(),1),
(null,187,500.00,0,curdate(),1),
(null,188,500.00,0,curdate(),1),
(null,189,500.00,0,curdate(),1),
(null,190,500.00,0,curdate(),1),
(null,191,500.00,0,curdate(),1),
(null,192,500.00,0,curdate(),1),
(null,193,500.00,0,curdate(),1),
(null,194,500.00,0,curdate(),1),
(null,195,500.00,0,curdate(),1),
(null,196,500.00,0,curdate(),1),
(null,197,500.00,0,curdate(),1),
(null,198,500.00,0,curdate(),1),
(null,199,500.00,0,curdate(),1),
(null,200,500.00,0,curdate(),1),
(null,201,500.00,0,curdate(),1),
(null,202,500.00,0,curdate(),1),
(null,203,500.00,0,curdate(),1),
(null,204,500.00,0,curdate(),1),
(null,205,500.00,0,curdate(),1),
/*Baterias de moto*/ /*Se esta utilizando el precio sin iva que se quedara como precio sin garantia*/
(null,206,465.52,0,curdate(),1),
(null,207,560.34,0,curdate(),1),
(null,208,560.34,0,curdate(),1),
(null,209,577.59,0,curdate(),1),
(null,210,650.86,0,curdate(),1),
(null,211,672.41,0,curdate(),1),
(null,212,793.10,0,curdate(),1),
(null,213,389.62,0,curdate(),1),
(null,214,413.79,0,curdate(),1),
(null,215,491.38,0,curdate(),1),
(null,216,560.34,0,curdate(),1),
(null,217,603.45,0,curdate(),1),
(null,218,633.62,0,curdate(),1),
(null,219,758.62,0,curdate(),1),
(null,220,836.21,0,curdate(),1),
(null,221,1094.83,0,curdate(),1),
(null,222,431.03,0,curdate(),1),
(null,223,512.93,0,curdate(),1),
(null,224,629.31,0,curdate(),1),
(null,225,706.90,0,curdate(),1),
(null,226,810.34,0,curdate(),1),
(null,227,810.34,0,curdate(),1),
(null,228,922.41,0,curdate(),1),
(null,229,935.34,0,curdate(),1),
(null,230,965.52,0,curdate(),1),
(null,231,1017.24,0,curdate(),1),
(null,232,1025.86,0,curdate(),1),
(null,233,1034.48,0,curdate(),1),
(null,234,1103.45,0,curdate(),1),
(null,235,1103.45,0,curdate(),1),
(null,236,1112.07,0,curdate(),1),
(null,237,1258.62,0,curdate(),1),
(null,238,1275.86,0,curdate(),1),
(null,239,1387.93,0,curdate(),1),
(null,240,1472.76,0,curdate(),1),
(null,241,1948.28,0,curdate(),1),
/*Servicios*/
/*(null,242,50.00,0,curdate(),1),
(null,243,50.00,0,curdate(),1),
(null,244,50.00,0,curdate(),1),*/

/*Se repiten baterias pero esta vez con garantia*/
/*Lth*/
/*TODO agregar precios con garantia*/
(null,1,2000.00,1,curdate(),1),
(null,2,2200.00,1,curdate(),1),
(null,3,2400.00,1,curdate(),1),
(null,4,2000.00,1,curdate(),1),
(null,5,2900.00,1,curdate(),1),
(null,6,2600.00,1,curdate(),1),
(null,7,2450.00,1,curdate(),1),
(null,8,2660.00,1,curdate(),1),
(null,9,2450.00,1,curdate(),1),
(null,10,2660.00,1,curdate(),1),
(null,11,2600.00,1,curdate(),1),
(null,12,2750.00,1,curdate(),1),
(null,13,2400.00,1,curdate(),1),
(null,14,1750.00,1,curdate(),1),
(null,15,4400.00,1,curdate(),1),
(null,16,3770.00,1,curdate(),1),
(null,17,2600.00,1,curdate(),1),
(null,18,2000.00,1,curdate(),1),
(null,19,2300.00,1,curdate(),1),
(null,20,2300.00,1,curdate(),1),
(null,21,2100.00,1,curdate(),1),
(null,22,2550.00,1,curdate(),1),
(null,23,2900.00,1,curdate(),1),
(null,24,2400.00,1,curdate(),1),
(null,25,2400.00,1,curdate(),1),
(null,26,2200.00,1,curdate(),1),
(null,27,2550.00,1,curdate(),1),
(null,28,2700.00,1,curdate(),1),
(null,29,2350.00,1,curdate(),1),
(null,30,2600.00,1,curdate(),1),
(null,31,4700.00,1,curdate(),1),
(null,32,2000.00,1,curdate(),1),
(null,33,3000.00,1,curdate(),1),
(null,34,2100.00,1,curdate(),1),
(null,35,2100.00,1,curdate(),1),
/*LTH TAXI*/
(null,36,2200.00,1,curdate(),1),
(null,37,2950.00,1,curdate(),1),
(null,38,2730.00,1,curdate(),1),
(null,39,2730.00,1,curdate(),1),
(null,40,3050.00,1,curdate(),1),
/*LTH HITEC*/
(null,41,2200.00,1,curdate(),1),
(null,42,2450.00,1,curdate(),1),
(null,43,2650.00,1,curdate(),1),
(null,44,2200.00,1,curdate(),1),
(null,45,3200.00,1,curdate(),1),
(null,46,2900.00,1,curdate(),1),
(null,47,2850.00,1,curdate(),1),
(null,48,3050.00,1,curdate(),1),
(null,49,2650.00,1,curdate(),1),
(null,50,2850.00,1,curdate(),1),
(null,51,2550.00,1,curdate(),1),
(null,52,2800.00,1,curdate(),1),
(null,53,3200.00,1,curdate(),1),
(null,54,3250.00,1,curdate(),1),
(null,55,2400.00,1,curdate(),1),
(null,56,2950.00,1,curdate(),1),
(null,57,2600.00,1,curdate(),1),
(null,58,2900.00,1,curdate(),1),
(null,59,2350.00,1,curdate(),1),
(null,60,2200.00,1,curdate(),1),
/*LTH SUV*/
(null,61,2950.00,1,curdate(),1),
(null,62,2730.60,1,curdate(),1),
(null,63,2730.60,1,curdate(),1),
(null,64,3050.00,1,curdate(),1),
/*Cronos*/
(null,65,1450.00,1,curdate(),1),
(null,66,1550.00,1,curdate(),1),
(null,67,1800.00,1,curdate(),1),
(null,68,2050.00,1,curdate(),1),
(null,69,2050.00,1,curdate(),1),
(null,70,1900.00,1,curdate(),1),
(null,71,1800.00,1,curdate(),1),
(null,72,3270.40,1,curdate(),1),
(null,73,1950.00,1,curdate(),1),
(null,74,1450.00,1,curdate(),1),
(null,75,1550.00,1,curdate(),1),
(null,76,1800.00,1,curdate(),1),
(null,77,1650.00,1,curdate(),1),
(null,78,2050.00,1,curdate(),1),
(null,79,1800.00,1,curdate(),1),
(null,80,1950.00,1,curdate(),1),
(null,81,4000.00,1,curdate(),1),
(null,82,1450.00,1,curdate(),1),
(null,83,1600.00,1,curdate(),1),
/*AMERICANA*/
(null,84,1650.00,1,curdate(),1),
(null,85,1700.00,1,curdate(),1),
(null,86,2000.00,1,curdate(),1),
(null,87,1650.00,1,curdate(),1),
(null,88,2350.00,1,curdate(),1),
(null,89,2200.00,1,curdate(),1),
(null,90,2050.00,1,curdate(),1),
(null,91,2200.00,1,curdate(),1),
(null,92,2050.00,1,curdate(),1),
(null,93,2200.00,1,curdate(),1),
(null,94,2200.00,1,curdate(),1),
(null,95,2350.00,1,curdate(),1),
(null,96,2000.00,1,curdate(),1),
(null,97,3270.00,1,curdate(),1),
(null,98,2200.00,1,curdate(),1),
(null,99,1650.00,1,curdate(),1),
(null,100,1850.00,1,curdate(),1),
(null,101,1850.00,1,curdate(),1),
(null,102,1750.00,1,curdate(),1),
(null,103,2050.00,1,curdate(),1),
(null,104,2350.00,1,curdate(),1),
(null,105,1950.00,1,curdate(),1),
(null,106,1950.00,1,curdate(),1),
(null,107,1800.00,1,curdate(),1),
(null,108,2050.00,1,curdate(),1),
(null,109,2200.00,1,curdate(),1),
(null,110,2000.00,1,curdate(),1),
(null,111,2200.00,1,curdate(),1),
(null,112,4000.00,1,curdate(),1),
(null,113,1650.00,1,curdate(),1),
(null,114,2450.00,1,curdate(),1),
(null,115,1750.00,1,curdate(),1),
(null,116,1750.00,1,curdate(),1),
/*Escpecial*/
(null,117,2050.00,1,curdate(),1),
(null,118,2300.00,1,curdate(),1),
(null,119,2700.00,1,curdate(),1),
(null,120,3450.00,1,curdate(),1),
(null,121,3050.00,1,curdate(),1),
(null,122,5050.00,1,curdate(),1),
(null,123,3250.00,1,curdate(),1),
(null,124,3300.00,1,curdate(),1),
(null,125,1400.00,1,curdate(),1),
/*AGM*/
(null,126,4100.00,1,curdate(),1),
(null,127,5450.00,1,curdate(),1),
(null,128,4400.00,1,curdate(),1),
(null,129,4050.00,1,curdate(),1),
(null,130,4150.00,1,curdate(),1),
(null,131,4800.00,1,curdate(),1),
(null,132,4950.00,1,curdate(),1),
(null,133,4450.00,1,curdate(),1),
(null,134,4850.00,1,curdate(),1),
/*Precio oprima*/
(null,135,4500.00,1,curdate(),1),
(null,136,4300.00,1,curdate(),1),
(null,137,4750.50,1,curdate(),1),
(null,138,4550.50,1,curdate(),1),
(null,139,4550.50,1,curdate(),1),
(null,140,3900.00,1,curdate(),1),
(null,141,5150.50,1,curdate(),1),
(null,142,5650.50,1,curdate(),1),
(null,143,5650.50,1,curdate(),1),
(null,144,5550.00,1,curdate(),1),
(null,145,4800.50,1,curdate(),1),
(null,146,5150.50,1,curdate(),1),
(null,147,6950.50,1,curdate(),1),
(null,148,5650.50,1,curdate(),1),
(null,149,6750.50,1,curdate(),1),
(null,150,7150.00,1,curdate(),1),
/*Baterias de moto*/
/*Batera LTH de moto*/
(null,206,540.00,1,curdate(),1),
(null,207,650.00,1,curdate(),1),
(null,208,650.00,1,curdate(),1),
(null,209,670.00,1,curdate(),1),
(null,210,755.00,1,curdate(),1),
(null,211,780.00,1,curdate(),1),
(null,212,920.00,1,curdate(),1),
(null,213,445.00,1,curdate(),1),
(null,214,480.00,1,curdate(),1),
(null,215,570.00,1,curdate(),1),
(null,216,650.00,1,curdate(),1),
(null,217,700.00,1,curdate(),1),
(null,218,735.00,1,curdate(),1),
(null,219,880.00,1,curdate(),1),
(null,220,970.00,1,curdate(),1),
(null,221,1270.00,1,curdate(),1),
/*AGM*/
(null,222,500.00,1,curdate(),1),
(null,223,595.00,1,curdate(),1),
(null,224,730.00,1,curdate(),1),
(null,225,820.00,1,curdate(),1),
(null,226,940.00,1,curdate(),1),
(null,227,940.00,1,curdate(),1),
(null,228,1070.00,1,curdate(),1),
(null,229,1085.00,1,curdate(),1),
(null,230,1120.00,1,curdate(),1),
(null,231,1180.00,1,curdate(),1),
(null,232,1190.00,1,curdate(),1),
(null,233,1200.00,1,curdate(),1),
(null,234,1280.00,1,curdate(),1),
(null,235,1280.00,1,curdate(),1),
(null,236,1290.00,1,curdate(),1),
(null,237,1460.00,1,curdate(),1),
(null,238,1480.00,1,curdate(),1),
(null,239,1610.00,1,curdate(),1),
(null,240,1720.00,1,curdate(),1),
(null,241,2260.00,1,curdate(),1);

/*Arroja los resultados cascos (mayoria de baterias)*/
select p.idProducto, mp.nombre as marca, t.nombre as tipo,
(select
r.precio from precios r
where p.idProducto=r.idProducto and 
r.activo=1 and 
r.garantia=0 limit 1) as precio,
c.numeroDeCasco as casco, c.precio
from producto p
join tipo t on p.idTipo = t.idTipo
join marcaProducto mp on p.idMarca = mp.idMarca
join cascos c on t.idCasco=t.idCasco
order by mp.idmarca;


/*Se incluyen los productos que no son baterias*/
insert into producto (idProducto, cantidad, idCategoria, idMarca, idTipo, activo) values
(null,0,5,11,null,1);
insert into precios (idPrecio, idProducto, precio, garantia, fecha, activo) values 
(null,242,75,0,curdate(),1);

insert into persona values 
(null, 'Gabriela', 'Garza', 'Bernal','','3311215488'),
(null, 'Angel Iván', 'Garza', 'Bernal','','3321164306'),
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

insert into menu values
(null, 'Editar Productos', 'Vista/Catalogo/Productos'),
(null, 'Nuevo Producto', 'Vista/Catalogo/NuevoProducto'),
(null, 'Nuevo Empleado', 'Vista/Empleado/nuevoEmpleado'),
(null, 'Vender', 'Vista/Venta/venta'),
(null, 'Automovil', 'Vista/Automoviles/nuevoAuto');

insert into intermediaPerfilMenu (idPerfil, idMenu) values
(1,1),
(1,2),
(1,3),
(1,4),
(2,3);

/*Seccion Autos*/

insert into tipoAuto (nombre) values
("Automovil"),
("SUV's"),
("Pickup"),
("Comercial");

insert into marcaAuto (nombre) values
('Acura'),
('Alfa Romeo'),
('Audi'),
('BMW'),
('Buick'),
('Cadillac'),
('Chevrolet'),
('Chrysler'),
('Dodge'),
('Fiat'),
('Ford'),
('GMC'),
('Honda'),
('Hummer'),
('Hyundai'),
('Infiniti'),
('Isuzu'),
('Jaguar'),
('Jeep'),
('Kia'),
('Land Rover'),
('LincoIn'),
('Mazda'),
('Mercedez-Benz'),
('Mercury'),
('Mini'),
('Mistubishi'),
('Nissan'),
('Peugeot'),
('Piaggio'),
('Pontiac'),
('Porsche'),
('RAM'),
('Renault'),
('SAAB'),
('Seat'),
('Smart'),
('Subaru'),
('Suzuki'),
('Toyota'),
('Volkswagen');


/*Se esta usando id bateria primera opcion 1 para pruebas*/
insert into modeloAuto (nombre,idMarca,idTipoAuto,anioInicio, anioFin) values 
/*Acura*/
('ILX',1,1,2013,2018),
('Legend',1,1,1989,1990),
('Legend',1,1,1991,1995),
('MDX',1,1,2004,2015),
('MDX',1,1,2016,2018),
('RDX',1,1,2007,2018),
('RL',1,1,2004,2012),
('RLX',1,1,2014,2015),
('TL',1,1,2004,2014),
('TLX 2.4',1,1,2015,2018),
('TLX V6-3.5',1,1,2014,2018),
('TSX',1,1,2004,2014),
/*Alfa Romeo*/
('147',2,1,2003,2010),
('156',2,1,1997,2006),
('Guilietta',2,1,2015,2018),
('Mito',2,1,2015,2018),
/*audi*/
('A1',3,1,2013,2018),
('A1 SportBack',3,1,2013,2018),
('A3',3,1,1996,2018),
('A3 Carbio',3,1,2013,2018),
('A3 SportBack',3,1,2013,2018),
('A4 2.0',3,1,2005,2011),
('A5',3,1,2005,2018),
('A5 SportBack',3,1,2013,2018),
('A6',3,1,1997,2016),
('A7 SportBack',3,1,2013,2016),
('Q3',3,1,2013,2018),
('Q5',3,1,2009,2018),
('RS5 4.2',3,1,2007,2014),
('S3',3,1,1997,2018),
('S4',3,1,1997,2018),
('TT 2.0',3,1,1997,2018),
('TT 3.2',3,1,1997,2018),
('TTS 2.0',3,1,1998,2018),
/*BMW*/
('528',4,1,1997,2018),/*Tiene un simbolo raro I l o | al final*/
('535',4,1,1997,2018),
('M1',4,1,2013,2018),
('M3',4,1,1998,2018),
('Serie 1',4,1,2004,2018),
('Serie 1 Coupe',4,1,2013,2018),
('Serie 1 M Coupe',4,1,2011,2012),
('Serie 3',4,1,1998,2018),
('X1',4,1,2013,2018),
('X2',4,1,1998,2010),
('X3',4,1,2011,2018),
('Z3',4,1,1998,2012),
('Z4',4,1,2001,2018),
('Z4 Roadster',4,1,2010,2011),
('Z4 Roadster',4,1,2012,2012),
/*Buick*/
('Enclave',5,2,2013,2018),
('Encore',5,2,2014,2018),
('Lacrosse',5,1,2013,2015),
('Regal',5,1,1980,1996),
('Regal',5,1,2011,2015),
('Regal V6-3.8',5,1,1997,2004),
('Verano',5,1,2013,2015),
/*Cadilac*/
('ATS',6,1,2013,2014),
('CATERA',6,1,1997,2001),
('CTS',6,1,2007,2013),
('CTS',6,1,2014,2015),
('CTS V',6,1,2013,2014),
('DEVILLE',6,1,1999,2012),
('ELDORADO',6,1,1996,2002),
('ESCALADE',6,1,2013,2014),
('ESCALADE',6,1,2015,2015),
('ESCALADE ESV',6,1,1999,2014),
('ESCALADE EXT',6,1,1999,2015),
('FLETWOOD',6,1,1999,2012),
('LESABRE',6,1,1999,2012),
('SEVILLE',6,1,1999,2012),
('SRX',6,1,1999,2015),
('STS',6,1,2008,2012),
('XLR',6,1,2007,2012),
/*CHEVROLET*/
('ATRA',7,1,1999,2010),
('AVALANCHE',7,1,2002,2007),
('AVALNCHE',7,1,2011,2014),
('AVEO',7,1,2008,2012),
('AVEO',7,1,2013,2018),
('BEAT',7,1,2017,2018),
('BLAZER',7,1,1982,2002),
('CAMARO',7,1,1992,2002),
('CAMARO',7,1,2010,2015),
('CAMARO',7,1,2016,2019),
('CAPTATIVA',7,1,2008,2015),
('CAVALIER',7,1,1987,2006),
('CELEBRITY',7,1,1989,1994),
('CENTURY',7,1,1989,2005),
('CHEVY',7,1,1994,2012),
('CHEYENNE',7,1,1995,2007),
('CHEYENNE',7,1,2008,2018),
('CITATION',7,1,1991,1995),
('COLORADO',7,1,2009,2014),
('COLORADO',7,1,2015,2019),
('CORSA',7,1,1994,2012),
('CORSICA',7,1,1987,1996),
('CORVETTE',7,1,1991,1996),
('CORVETTE',7,1,1997,2000),
('CORVETTE',7,1,2004,2005),
('CORVETTE',7,1,2006,2013),
('CORVETTE',7,1,2014,2019),
('CRUZE',7,1,2011,2018),
('CUTLASS',7,1,1989,1997),
('CURLASS',7,1,1998,1999),
('EPICA',7,1,2006,2011),
('EQUINOX',7,1,2005,2006),
('EQUINOX',7,1,2007,2018),
('EXPRESS VAN',7,1,1992,2019),
('HHR',7,1,2007,2012),
('IMPALA',7,1,1994,2013),
('LUMINA',7,1,1990,1995),
('LUMINA',7,1,1996,2001),
('LUV',7,1,1998,2005),
('MALIBU',7,1,1997,2007),
('MALIBU',7,1,2008,2015),
('MALIBU',7,1,2016,2019),
('MATIZ',7,1,2011,2015),
('MERIVA',7,1,2002,2012),
('OPTRA',7,1,2006,2010),
('PICKUP C-20 CUSTOM',7,1,1992,2007),
('PICKUP C-20 CUSTOM',7,1,2008,2012),
('S-10',7,1,1982,2002),
('S-10',7,1,2016,2018),
('SILHOUETTE',7,1,1990,1996),
('SILHOUETTE',7,1,1997,2004),
('SILVERADO',7,1,1996,2007),
('SILVERADO',7,1,2008,2013),
('SILVERADO',7,1,2014,2019),
('SILVERADO 1500',7,1,2014,2019),
('SILVERADO 2500',7,1,2014,2019),
('SILVERADO 3500',7,1,2014,2019),
('SONIC',7,1,2013,2018),
('SONORA',7,1,2000,2006),
('SPARK',7,1,2010,2019),
('SUBURBAN',7,1,1990,2007),
('SUBURBAN',7,1,2008,2014),
('SUBURBAN',7,1,2015,2019),
('TAHOE',7,1,2007,2014),
('TAHOE',7,1,2015,2019),
('TIGRA',7,1,1994,2004),
('TORNADO',7,1,1994,2004),
('TRACKER',7,1,1989,2004),
('TRAILBLAZER',7,1,2002,2008),
('TRANS AM',7,1,1982,1992),
('TRAVERSE',7,1,2009,2018),
('TRAX',7,1,2013,2018),
('UPLANDER',7,1,2005,2009),
('VECTRA',7,1,2003,2011),
('VENTURE',7,1,1997,2004),
('ZAFIRA',7,1,2002,2008),
/*CHRYSLER*/
('200',8,1,2011,2015),
('300',8,1,2006,2014),
('300',8,1,2015,2018),
('300C',8,1,2006,2015),
('300C',8,1,2016,2016),
('300M',8,1,1998,2004),
('CIRRUS',8,1,1995,1997),
('CIRRUS',8,1,2008,2012),
('CONCORDE',8,1,1993,2004),
('CORDOBA',8,1,1980,1987),
('CROSSFIRE',8,1,2004,2008),
('IMPERIAL',8,1,1990,1993),
('LE PARON',8,1,1980,1995),
('NEW YORKER',8,1,1980,2006),
('PACIFICA',8,1,2004,2008),
('PACIFICA',8,1,2017,2018),
('PHANTOM',8,1,1987,1995),
('PT CRUISER',8,1,2000,2010),
('TOWN & COUNTRY',8,1,1991,2014),
('TOWN & COUNTRY',8,1,2015,2015),
('TOWN & COUNTRY',8,1,2016,2016),
/*DODGE*/
('ASPEN',9,1,2007,2012),
('ATOS',9,1,2001,2012),
('ATTITTUDE',9,1,2006,2018),
('AVENGER',9,1,2006,2015),
('CALIBER',9,1,2006,2012),
('CARAVAN',9,1,1993,2010),
('CARAVAN',9,1,2011,2011),
('CARGO VAN',9,1,1994,2012),
('CHALLENGER',9,1,2006,2018),
('CHARGER',9,1,2006,2019),
('COLT',9,1,1980,1995),
('CONVERSION VAN',9,1,1994,2012),
('DAKOTA',9,1,1993,2012),
('DART',9,1,2013,2016),
('DODGE 1000',9,1,2009,2012),
('DURANGO',9,1,1998,2003),
('DURANGO',9,1,2004,2010),
('DURANGO',9,1,2011,2014),
('GRAND CARAVAN',9,1,1993,2010),
('GRAND CARAVAN',9,1,2011,2011),
('GRAND CHEROKEE',9,1,1993,1998),
('GRAND CHEROKEE',9,1,1999,2004),
('GRAND CHEROKE',9,1,2005,2010),
('GRAND CHEROKE',9,1,2011,2016),
('GRAND VOYAGER',9,1,1983,2011),
('H100',9,1,2004,2014),
('I10',9,1,2013,2014),
('JOURNEY',9,1,2009,2018),
('LHS',9,1,1994,2001),
('NEON',9,1,1994,1999),
('NEON',9,1,2000,2006),
('NEON',9,1,2017,2018),
('NIGHT RUNNER SRT-10',9,1,2004,2006),
('RAM (1500,2500,3500,4000)',9,1,1994,2001),
('RAM (1500,2500,3500,4000)',9,1,2002,2005),
('RAM (1500,2500,3500,4000)',9,1,2006,2014),
('RAM (1500,2500,3500,4000)',9,1,2015,2018),
('RAM 700',9,1,2016,2018),
('RAM CHARGER',9,1,1980,2001),
('RAM WAGON',9,1,1989,2012),
('SHADOW',9,1,1987,1994),
('SPIRIT',9,1,1987,1995),
('STRATUS',9,1,1995,2006),
('VERNA',9,1,2004,2005),
('VIPER',9,1,1992,2012),
('VISION',9,1,2015,2018),
('VOYAGER',9,1,1988,2011),
('RAM ST',9,1,2013,2014),
/*FIAT*/
('500',10,1,2007,2018),
('ALBEA',10,1,2004,2012),
('FIAT BRAVO',10,1,2004,2012),
('GRANDE PUNTO',10,1,2007,2010),
('GRANDE PUNTO (3PTAS)',10,1,2009,2012),
('RANDE PUNTO TURBO',10,1,2009,2012),
('IDEA',10,1,2007,2012),
('IDEA AVENTURE',10,1,2009,2012),
('PALIO',10,1,2004,2018),
('PALIO SPORTING',10,1,2016,2016),
('PANDA',10,1,2007,2012),
('PUNTO',10,1,2013,2014),
('STILO',10,1,2004,2012),
('STRADA',10,1,2007,2014),
('UNO',10,1,2013,2018),
('PALIO ADVENTURE',10,1,2004,2012),
('PALIO ADVENTURE',10,1,2013,2018),
/*FORD*/
('AEROSTAR',11,1,1986,1997),
('CLUB WAGON',11,1,1991,2012),
('CONTOUR',11,1,1995,2000),
('COUGAR',11,1,1984,1997),
('COURIER',11,1,1997,2012),
('CROWN VICTORIA',11,1,1983,2008),
('CROWN VICTORIA',11,1,2009,2012),
('E-150/350',11,1,2013,2014),
('ECOLINE 150',11,1,1997,2000),
('ECOLINE 350',11,1,1997,2000),
('ECOSPORT',11,1,2003,2018),
('EDGE',11,1,2007,2010),
('EDGE',11,1,2011,2015),
('EDGE',11,1,2016,2018),
('ESCAPE',11,1,2001,2020),
('ESCAPE',11,1,2011,2015),
('ESCORT',11,1,1993,1996),
('ESCORT',11,1,997,2003),
('EXCURSION',11,1,2000,2006),
('EXPEDITION',11,1,1997,2018),
('EXPLORER',11,1,2013,2019),
('EXPLORER SPORT TRAC',11,1,2000,2010),
('FIESTA',11,1,1995,2019),
('FIGO',11,1,2016,2018),
('FIVE HUNDRED',11,1,2004,2007),
('FOCUS',11,1,1998,2018),
('FREESTAR',11,1,2005,2012),
('FUSION',11,1,2006,2018),
('GHIA',11,1,1984,1994),
('GRAND MARQUIS',11,1,1983,1992),
('GRAND MARQUIS',11,1,1993,2011),
('IKON',11,1,1997,2015),
('KA',11,1,1997,2015),
('LOBO',11,1,1991,2014),
('LOBO',11,1,2015,2018),
('LOBO XLT',11,1,2015,2016),
('MONDEO',11,1,2000,2007),
('MUNSTANG',11,1,1990,2004),
('MUNSTANG',11,1,2005,2014),
('MUNSTANG SHELBY',11,1,2005,2014),
('MYSTIQUE',11,1,1995,2000),
('PICKUP FORD (F-SERIES)',11,1,1990,2018),
('RANGER',11,1,1983,2002),
('RANGER',11,1,2003,2016),
('RANGER',11,1,2017,2018),
('RAPTOR',11,1,2013,2014),
('SABLE',11,1,1993,1995),
('SABLE',11,1,1996,2005),
('SABLE',11,1,2008,2009),
('TAURUS',11,1,1992,1995),
('TAURUS',11,1,1996,2007),
('THUNDERBIRD',11,1,1987,1997),
('THUNDERBIRD',11,1,1998,2005),
('TOPAZ',11,1,1984,1994),
('TRANSIT',11,1,2009,2018),
('WINDSTAR',11,1,1995,2004),
('ESCAPE 2.5',11,1,2011,2019),
('MUSTANG V8-5.0',11,1,2011,2019),
/*GMC*/
('ANCADIA',12,1,2007,2019),
('CANYON',12,1,2004,2014),
('ENVOY',12,1,2002,2012),
('JIMMY',12,1,1992,2006),
('JIMMY',12,1,1997,1998),
('SAFARI',12,1,1992,2003),
('SAVANA',12,1,1996,2012),
('SIERRA',12,1,1992,2006),
('SIERRA',12,1,2003,2014),
('SIERRA',12,1,2007,2018),
('SONOMA',12,1,1992,2004),
('SONOMA',12,1,1994,1996),
('TERRAIN',12,1,2013,2019),
('YUKON',12,1,1992,2006),
('YUKON',12,1,2007,2019),
/*Honda*/
('ACCORD 4 CIL (2.2L)',13,1,1992,1993),
('ACCORD 4 CIL (2.2L)',13,1,1994,1997),
('ACCORD 4 CIL (2.3L)',13,1,1998,2002),
('ACCORD 4 CIL (2.4L) AUTOM',13,1,2003,2014),
('ACCORD 4 CIL (2.4L) STD',13,1,2003,2018),
('ACCORD 4 CIL (2.7L)',13,1,1995,1995),
('ACCORD 4 CIL (2.2L)',13,1,1996,2005),
('ACCORD 6 CIL (2.2L)',13,1,1995,1995),
('ACCORD 6 CIL (2.2L)',13,1,1996,2005),
('ACCORD 6 CIL (2.2L)',13,1,2006,2014),
('BR-V',13,1,2017,2018),
('CITY',13,1,2013,2015),
('CITY',13,1,2016,2016),
('CITY',13,1,2017,2018),
('CIVIC',13,1,2004,2019),
('CIVIC COUPE',13,1,1992,2014),
('CIVIC HYBRID',13,1,1997,2015),
('CIVIC TURBO',13,1,2016,2019),
('CROSSTOUR',13,1,2013,2014),
('CR-V',13,1,2002,2019),
('CR-Z',13,1,2014,2015),
('ELEMENT',13,1,2003,2012),
('FIT',13,1,2009,2019),
('HR-V',13,1,2015,2019),
('ODYSSEY',13,1,1995,2018),
('ODYSSEY',13,1,2018,2019),
('PASSPORT',13,1,1994,1997),
('PASSPORT',13,1,1998,2002),
('PILOT',13,1,1995,2016),
('PILOT',13,1,2017,2019),
('PRELUDE',13,1,1992,2001),
('RIDGELINE',13,1,2004,2014),
('ACCORD 4 CIL (1.5L)',13,1,2017,2018),
('ACCORD 4 CIL (2.0L)',13,1,2018,2019),
('CIVIC TYPE R',13,1,2018,2019),
/*Hummer*/
('HUMMER H1',14,1,2002,2006),
('HUMMER H2',14,1,2003,2007),
('HUMMER H2',14,1,2008,2014),
('HUMMER H3',14,1,2006,2014),
('HUMMER H3T',14,1,2006,2014),
/*Hyundai*/
('CRETA',15,1,2016,2018),
('ELANTRA',15,1,2016,2018),
('GRAND I10',15,1,2016,20189),
('I10',15,1,2016,2018),
('TUCSON',15,1,2016,2018),
('ACCENT',15,1,2018,2019),
/*Infiniti*/
('FX',16,1,2013,2014),
('G37 COUPE',16,1,2008,2013),
('G37 SEDAN',16,1,2008,2013),
('G COUPE',16,1,2013,2014),
('G SEDAN',16,1,2013,2014),
('I30',16,1,1996,2014),
('JX',16,1,2013,2014),
('M',16,1,2013,2014),
('M37',16,1,2011,2014),
('Q45',16,1,1997,1998),
('Q45',16,1,1999,2014),
('Q45',16,1,2007,2011),
('Q50',16,1,2016,2018),
('QX',16,1,2013,2018),
('QX70',16,1,2016,2018),
/*Isuzu*/
('PICK UP AUTOM',17,1,1988,1995),
('PICK UP',17,1,1988,1995),
('RODEO',17,1,1992,2004),
('TROOPER',17,1,1992,2001),
/*Jaguar*/
('X-TYPE 2.5',18,1,1997,2012),
('X-TYPE 3.0',18,1,1997,2012),
/*Jeep*/
('CHEROKEE',19,1,1991,2012),
('COMMANDER',19,1,2006,2012),
('COMPASS',19,1,2007,2016),
('COMPASS',19,1,2017,2019),
('LIBERTY',19,1,2000,2001),
('LIBERTY',19,1,2003,2013),
('PATRIOT',19,1,2006,2018),
('WRANGLER',19,1,2015,2018),
('WRANGLER RUBICON',19,1,1991,2014),
('WRANGLER SE',19,1,1991,2014),
('WRANGLER X',19,1,1991,2014),
('CHEROKEE 2.4',19,1,2014,2018),
('CHEROKEE 3.2',19,1,2014,2019),
/*Kia*/
('NIRO',20,1,2016,2016),
('RIO SC',20,1,2015,2016),
('RIO UB',20,1,2015,2018),
('SOUL',20,1,2016,2018),
('SPORTAGE',20,1,2016,2016),
('SPORTAGE',20,1,2017,2019),
('SFDONA',20,1,2018,2018),
('FORTE',20,1,2016,2018),
/*Land Rover*/
('DEFENDER',21,1,2013,2015),
('DISCOVERY',21,1,1998,2004),
('EVOQUE',21,1,2013,2018),
('FREELANDER',21,1,2002,2002),
('FREELANDER',21,1,2003,2005),
('LR2',21,1,2007,2014),
('RANGE ROVER SPORT',21,1,2009,2018),
/*LincoIn*/
('AVIATOR',22,1,2000,20012),
('BLACKWOOD',22,1,2000,2012),
('CONTINENTAL',22,1,2000,2012),
('CONTINENTAL',22,1,2017,2018),
('LS',22,1,2000,2012),
('MARK LT',22,1,1998,2014),
('MARK VIII',22,1,1993,2012),
('MKS',22,1,2007,2014),
('MKX',22,1,2007,2015),
('MKX',22,1,2016,2018),
('MKZ',22,1,2017,2018),
('NAVIGATOR',22,1,2013,2018),
('TOWN CAR',22,1,1994,2012),
('ZEPHIR',22,1,2006,2012),
('MKC',22,1,2018,2018),
/*Mazda*/
('',23,1,,),
('',23,1,,),
('',23,1,,),
('',23,1,,),
('',23,1,,),
/*Mercedes-Benz*/
('',24,1,,),
('',24,1,,),
('',24,1,,),
('',24,1,,),
('',24,1,,),
/*Mercury*/
('',25,1,,),
('',25,1,,),
('',25,1,,),
('',25,1,,),
('',25,1,,),
/*MINI*/

/*MITSUBISHI*/

/*NISSAN*/

/*PEUGEOT*/

/*PIAGGIO*/

/*PONTIAC*/

('Porsche'),
('RAM'),
('Renault'),
('SAAB'),
('Seat'),
('Smart'),
('Subaru'),
('Suzuki'),
('Toyota'),
('Volkswagen');


/*Se hacen las inserciones de que tipo de pila llevaria un modelo determinado*/
insert into intermediamodeloauto_tipo (idTipo,idModelo) VALUES 
/*Audi*/
(27,1),
(4,2),
(14,2),
(2,3),
(12,3),
(13,3),
(4,4),
(14,4),
(24,5),
(14,6),
(3,6),
(2,7),
(12,7),
(13,7),
(14,8),
(3,8),
(3,9),
(14,9),
(3,10),
(14,10),
(24,11),
(18,11);

/*Consulta que permite ver los autos posibles coocando su modelo, tipo y marca*/
select * 
from modeloauto moa
join marcaauto ma on moa.idMarca = ma.idMarca
join tipoauto ta on moa.idTipoAuto=ta.idTipoAuto;

/*Busca los tipos de baterias que se le pueden poner a  un carro*/
select * 
from modeloauto moa
join intermediamodeloauto_tipo imt on moa.idModelo=imt.idModelo
join tipo t on imt.idTipo=t.idTipo
left join cascos c on t.idCasco=c.idCasco
order by moa.idModelo;


/*Permite ver los menus de un perfil determinado*/
select p.idPerfil, m.idMenu, m.nombre, m.direccion from perfil p  
join intermediaPerfilMenu ipm on p.idPerfil=ipm.idPerfil
join menu m on ipm.idMenu=m.idMenu where p.idPerfil=1;

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
) COLLATE utf8mb4_general_ci;

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
) COLLATE utf8mb4_general_ci;


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
    WHERE usuario = username AND contrasena = password_p AND u.activo=1 limit 1;
 
END
||
DELIMITER ;
call iniciosesion('gaby','123');


/*Get productos*/

select p.idProducto, mp.nombre as marca, t.nombre as tipo, cp.nombre as categoria, p.cantidad, 
        r.precio, r.idPrecio, t.idCasco as casco,
            (select r.precio from cascos r
            where r.idCasco=t.idCasco) as precioCasco
        from producto p
        join categoriaProducto cp on p.idCategoria = cp.idCategoria
        join tipo t on p.idTipo = t.idTipo
        join marcaProducto mp on p.idMarca = mp.idMarca
        join precios r on p.idProducto=r.idProducto
        where p.idCategoria=2 and mp.idMarca=3 and
        r.activo=1 and r.garantia=0;


        
select p.idProducto, mp.nombre as marca, t.nombre as tipo, cp.nombre as categoria, p.cantidad, 
        r.precio, r.idPrecio, t.idCasco as casco,
            (select r.precio from cascos r
            where r.idCasco=t.idCasco) as precioCasco
        from producto p
        join categoriaProducto cp on p.idCategoria = cp.idCategoria
        join tipo t on p.idTipo = t.idTipo
        join marcaProducto mp on p.idMarca = mp.idMarca
        join precios r on p.idProducto=r.idProducto
        where p.idCategoria=3 and mp.idMarca=6 and
        r.activo=1 and r.garantia=0;
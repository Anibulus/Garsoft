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
    anio int null,    
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
(null, 'Pila de auto'),
(null, 'Pila de moto'),
(null, 'Pila AA'),
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
(null, 'Nuevo Empleado', 'Vista/Empleado/NuevoProducto'),
(null, 'Vender', 'Vista/Venta/venta');

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
('Buick'),
('Cadillac'),
('Chevrolet'),
('Chrysler'),
('Dodge'),
('Ford'),
('GMC'),
('Honda'),
('Hyundai'),
('Jeep'),
('Kia'),
('Mazda'),
('Nissa'),
('Toyota'),
('Volkswagen');


/*Se esta usando id bateria primera opcion 1 para pruebas*/
insert into modeloAuto (nombre,idMarca,anio) values 
('147',2,1),
('158',2,1),
('Guileta',2,1),
('Mito',2,1),
('A1',3,1),
('A1 SportBack',3,1);

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
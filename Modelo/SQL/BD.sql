create database garsoft;
use garsoft;
create table marcaAuto(
    idMarca int AUTO_INCREMENT,
    nombre varchar(20) not null,
    CONSTRAINT pkMarcaAuto PRIMARY KEY (idMarca)
);

create table categoriaProducto(
    idCategoria int Auto_Increment,
    nombre varchar(50) not null,
    CONSTRAINT pkCategoriaProducto PRIMARY KEY (idCategoria)   
);

create table producto(
    idProducto int Auto_Increment,
    nombre varchar(50) not null,
    idCategoria int default 1 /*o not null*/,
    precioMayoreo decimal(15,2),
    precioPublico decimal(15,2),
    costo decimal(15,2),
    activo TINYINT default 0, /*Esta campo muestra si se vende o no por parte de ellos*/
    CONSTRAINT pkProducto PRIMARY KEY (idProducto),
    CONSTRAINT fkProducto_Categora FOREIGN KEY (idCategoria) references categoriaProducto (idCategoria)
);

create table modeloAuto(
    idModelo int Auto_Increment,
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
);


/*Seccion compra*/
create table persona(
    idPersona int Auto_Increment,
    nombre varchar(50) not null,
    apellido1 varchar(50) not null,
    apellido2 varchar(50),
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
    costo decimal(15,2),
    CONSTRAINT pkCompra PRIMARY KEY (idCompra),
    CONSTRAINT fkCompra_Provedor FOREIGN KEY (idProvedor) REFERENCES provedor (idPersona),
    CONSTRAINT fkCompra_Empleado FOREIGN key (idEmpleado) REFERENCES persona (idPersona)
);

create table intermediaCompraProducto(
    idCompra int not null,
    idProducto int not null,
    cantidad int not null,
    /*TODO ver si costo*/
    CONSTRAINT pkIntermediaCompraProducto PRIMARY KEY (idCompra, idProducto),
    CONSTRAINT fkIntermediaCompraProducto FOREIGN KEY (idCompra) REFERENCES compra (idCompra),
    CONSTRAINT fkIntermediaCompraProducto FOREIGN KEY (idProducto) REFERENCES producto (idProducto) 
);

CREATE TABLE cliente (
    idPersona int not null,
    CONSTRAINT pkCliente PRIMARY KEY (idPersona),
    CONSTRAINT fkCliente FOREIGN KEY (idPersona) REFERENCES persona (idPersona)
);

create table venta (
    idVenta bigint Auto_Increment,
    /*TipoVenta (Precio publico o mayoreo),
    Tipo compra (creadito, efectivo, etc),*/
    idModelo int,
    idEmpleado int,
    idCliente int,
    CONSTRAINT pkVenta PRIMARY KEY (idVenta)
);

create table intermediaVentaProducto(
    idVenta BIGINT not null,
    idProducto int not null,
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
    CONSTRAINT pkMenu PRIMARY KEY (idMenu)
);

create table factura (
    idVenta int not null,
    CONSTRAINT pkFactura PRIMARY KEY (idVenta),
    CONSTRAINT fkFactura_Venta FOREIGN KEY (idVenta) REFERENCES venta (idVenta)
);

/*Seccion producto*/
insert into categoriaProducto values
(null,'Servicio'),
(null,'Bateria'),
(null,'Anticongelante');

insert into producto  values 
('Servicio',1);


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


/*Empleados*/
insert into persona values 
(null, 'Gaby', 'Garza', null),
(null, 'Angel Iván', 'Garza', null),
(null, 'Jonathan', 'Quien sabe', null),
(null, 'Mario', 'Quien Sabe', null),
(null, 'Cliente', 'Anónimo', null);/*Sera usado para cuando no pidan datos*/

insert into perfil VALUES
(null,'Admnistrador'),
(null,'Empleado');
insert into usuario values 
(1,'Gaby','123',CURDATE(),1),
(2,'Ivon','123',CURDATE(),1),
(3,'Jony','123',CURDATE(),2),
(4,'Mario','123',CURDATE(),2);

insert into empresa values 
(null, 'LTH');

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


/*NEW.Column*/
DELIMITER $$;
CREATE 
    TRIGGER ElevacionPrecio after UPDATE on producto
    insert into TRElevacionPrecio values (null,1,1,CURDATE(),1,new.precioPublico);
END$$
DELIMITER ;

/*Ejemplo con ifelse*/
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



/*Este si me funciono*/
CREATE PROCEDURE simpleproc (OUT param1 INT)
SELECT COUNT(*) INTO param1 FROM t;
SELECT @a;
CREATE FUNCTION hello (s CHAR(20)) RETURNS CHAR(50)
RETURN CONCAT('Hello, ',s,'!');
SELECT hello('world');


/*Consultas del programa*/

Delimiter //
CREATE FUNCTION iniciarSesion
 (usuariot VARCHAR(10)/*, contrasenat varchar(50)*/) RETURNS int
begin
RETURN select * from usuario where usuario=usuariot /*&& constrasena=contrasenat*/;
END 
//
delimiter ;
SELECT hello('world');



DELIMITER ||
CREATE FUNCTION InicioSesion (username VARCHAR(8), password_p VARCHAR(20))
    RETURNS int
    NOT DETERMINISTIC
    READS SQL DATA
BEGIN
    RETURN (SELECT idPersona FROM `usuario` WHERE usuario = username AND contrasena = password_p);
    /*Return exists (query)*/
END
||
DELIMITER ;
SELECT InicioSesion('gaby','123');



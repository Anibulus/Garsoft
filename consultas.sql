/*drop database garsoft*/
/*delete from persona where idPersona = 5;*/
/*delete from usuario where idPersona = 5;*/
/*drop table persona*/
use garsoft;

select * from perfil;
select * from persona;
select * from usuario;
select * from menu;
select * from categoriaProducto;
select * from marcaProducto;
select * from producto;
select * from precios;

insert into usuario (idPersona,usuario,contrasena,ultimoInicio,idPerfil,activo) values (2,"gg", "123",now(),1,1); 
insert into usuario (idPersona,usuario,contrasena,ultimoInicio,idPerfil,activo) values (3,"gg", "abd35",now(),1,1); 
update persona set correo = 'naranajarrs@gmail.com' where idPersona =1;
update usuario set activo = 1 where idPersona =3;

update categoriaProducto set nombre = 'Pila' where idCategoria = 2;
insert into intermediaperfilmenu values (4,2);

select u.contrasena 
from usuario u
join persona p on p.idPersona = u.idPersona
where correo = 'naranajarrs@gmail.com';
update menu set direccion = 'Vista/Empleado/nuevoEmpleado' where idMenu = 3;
update menu set nombre = 'Empleados' where idMenu = 3;

insert into menu (nombre,direccion) values ("Reportes","Vista/Reportes/inventario");

call iniciosesion("ivon","123");

select p.idPerfil, m.idMenu, m.nombre, m.direccion from perfil p  
        join intermediaPerfilMenu ipm on p.idPerfil=ipm.idPerfil
        join menu m on ipm.idMenu=m.idMenu where p.idPerfil=1;
      
drop procedure NuevoEmpleado;   
 
DELIMITER ||
CREATE Procedure InicioSesion (username VARCHAR(10), password_p VARCHAR(20))
BEGIN 
	set @idp = 0;
    set @idp = (SELECT idPersona FROM usuario WHERE usuario = username AND contrasena = password_p AND activo=1 limit 1);
    set @est = 0;
    set @est = (SELECT if(idPersona is Null, 'false', 'true') as esta FROM usuario WHERE usuario = username  AND contrasena = password_p AND activo=1 limit 1);
    SELECT u.idPersona, u.idPerfil, p.nombre, p.apellido1 FROM usuario u
    join persona p on u.idPersona = p.idPersona
    WHERE usuario = username AND contrasena = password_p AND u.activo=1 limit 1;
    if @est = 'true' then
    update usuario set ultimoInicio = current_timestamp()
    where idPersona = @idp;
    end if;
END
||
DELIMITER ;
select @idp;  
 select @est;
 
DELIMITER ||
CREATE Procedure NuevoEmpleado (nombre VARCHAR(50), apellidop VARCHAR(50),apellidom VARCHAR(50),correo VARCHAR(50),telefono VARCHAR(50),usuario VARCHAR(50),
	pass VARCHAR(50), tipo int)
BEGIN
	set @idpe = 0;
    insert into persona values (null, nombre, apellidop, apellidom, correo, telefono);
    set @idpe = (select MAX(idPersona) as idpe from persona); 
    insert into usuario values (@idpe,usuario,pass,current_timestamp(),tipo,1);
END
||
DELIMITER ;
call NuevoEmpleado ("samuel", "najar","rosales","correo","123456781","sam","123456","1");
insert into persona values (null, nombre, apellidop, apellidom, correo, telefono);
select idPersona from persona where correo = "zamunajar@mail.com";

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad, pr.precio 
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join precios pr on pr.idProducto = p.idProducto
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo 
where c.idCategoria = 3
order by p.idProducto limit 10;

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo 
where c.idCategoria = 4
order by p.idProducto limit 100;

select p.* from persona p 
join usuario u on p.idPersona = u.idPersona
where u.idPerfil != 3 and u.activo = 1 ;

Select * from persona where idPersona =1;

select p.idProducto, mp.nombre as marca, t.nombre as tipo, cp.nombre as categoria, p.cantidad, r.precio, r.idPrecio, t.idCasco as casco,
(select r.precio from cascos r where r.idCasco=t.idCasco) as precioCasco 
from producto p 
join categoriaProducto cp on p.idCategoria = cp.idCategoria 
join tipo t on p.idTipo = t.idTipo 
join marcaProducto mp on p.idMarca = mp.idMarca 
join precios r on p.idProducto=r.idProducto 
where mp.idMarca = 1 and t.idTipo =3 ;

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad, pr.precio
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join precios pr on pr.idProducto = p.idProducto
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo 
where c.idCategoria = 2 and pr.garantia = 0
order by p.idProducto limit 100;

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo 
where c.idCategoria = 2 
order by p.idProducto limit 100;

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad , pr.precio
from producto p 
join precios pr on pr.idProducto = p.idProducto
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo 
where p.idProducto = 1
order by p.idProducto limit 100;

select * from precios where idProducto =1;

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad,
(select pr.precio from precios pr where pr.idProducto = p.idProducto and pr.garantia=0 limit 1) as precioPublico,
(select pr2.precio from precios pr2 where pr2.idProducto = p.idProducto and pr2.garantia=1 limit 1) as precioGarantia
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo 
where c.idCategoria = 2 
order by p.idProducto limit 100;

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo 
where c.idCategoria = 3
order by p.idProducto limit 100;

insert into formapago (descripcion) values ("Efectivo");
insert into cliente values (3);
insert into venta (anio,fecha,idModelo,idEmpleado,idCliente,idFormaPago) values (2021,'2021-02-19',1,2,1,1);
insert into intermediaventaproductosalida values (4,1,1,3000.00);

select * from formapago;
select * from venta;
select * from producto;
select * from intermediaventaproductosalida;

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo
join intermediaventaproductosalida i on p.idProducto = i.idProducto
where i.idVenta = 1;

select v.idVenta,v.anio,v.fecha,
(select concat(p.nombre," ",p.apellido1)from persona p join cliente cl on p.idPersona = cl.idPersona) as Cliente,
mo.nombre as Modelo_Auto,
(select distinct ma.nombre from marcaauto ma join modeloauto mm on ma.idMarca = mm.idMarca ) as Marca_Auto,
f.descripcion as Pago,pe.nombre as Vendio
from venta v 
join modeloauto mo on v.idModelo = mo.idModelo
join persona pe on v.idEmpleado = pe.idPersona
join formapago f on v.idFormaPago = f.idFormaPago
where v.idVenta = 1; 

select v.idVenta,v.fecha,
(select concat(p.nombre," ",p.apellido1)from persona p join cliente cl on p.idPersona = cl.idPersona) as Cliente,
mo.nombre as Modelo_Auto,
(select distinct ma.nombre from marcaauto ma join modeloauto mm on ma.idMarca = mm.idMarca ) as Marca_Auto,
f.descripcion as Pago,pe.nombre as Vendio,p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo
from venta v 
join modeloauto mo on v.idModelo = mo.idModelo
join persona pe on v.idEmpleado = pe.idPersona
join formapago f on v.idFormaPago = f.idFormaPago
join intermediaventaproductosalida i on v.idVenta = i.idVenta
join producto p on p.idProducto = i.idProducto
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo
where MONTHNAME(v.fecha) = 'January' and v.anio = 2020;
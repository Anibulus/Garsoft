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

insert into usuario (idPersona,usuario,contrasena,ultimoInicio,idPerfil,activo) values (2,"gg", "123",now(),1,1); 
insert into usuario (idPersona,usuario,contrasena,ultimoInicio,idPerfil,activo) values (3,"gg", "abd35",now(),1,1); 
update persona set correo = 'naranajarrs@gmail.com' where idPersona =1;
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
    set @idp = (SELECT idPersona FROM usuario WHERE usuario = username COLLATE utf8mb4_general_ci AND contrasena = password_p COLLATE utf8mb4_general_ci AND activo=1 limit 1);
    set @est = 0;
    set @est = (SELECT if(idPersona is Null, 'false', 'true') as esta FROM usuario WHERE usuario = username COLLATE utf8mb4_general_ci AND contrasena = password_p COLLATE utf8mb4_general_ci AND activo=1 limit 1);
    SELECT u.idPersona, u.idPerfil, p.nombre, p.apellido1 FROM usuario u
    join persona p on u.idPersona = p.idPersona
    WHERE usuario = username COLLATE utf8mb4_general_ci AND contrasena = password_p COLLATE utf8mb4_general_ci AND u.activo=1 limit 1;
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

select p.idProducto, c.nombre as Categoria,m.nombre as Marca,t.nombre as Tipo,p.cantidad 
from producto p 
join categoriaproducto c on p.idCategoria = c.idCategoria
join marcaproducto m on p.idMarca = m.idMarca
join tipo t on p.idTipo = t.idTipo order by p.idProducto limit 10;

select p.* from persona p 
join usuario u on p.idPersona = u.idPersona
where u.idPerfil != 3 and u.activo = 1 ;
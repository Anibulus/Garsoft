use garsoft;

select * from perfil;
select * from persona;
select * from usuario;

insert into usuario (idPersona,usuario,contrasena,ultimoInicio,idPerfil,activo) values (2,"gg", "123",now(),1,1); 
insert into usuario (idPersona,usuario,contrasena,ultimoInicio,idPerfil,activo) values (3,"gg", "abd35",now(),1,1); 
update persona set correo = 'naranajarrs@gmail.com' where idPersona =1;

select u.contrasena 
from usuario u
join persona p on p.idPersona = u.idPersona
where correo = 'naranajarrs@gmail.com';
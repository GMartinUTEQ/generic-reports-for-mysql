create database genreportbuilder;

use genreportbuilder;

create table usuario(
    idusuario int PRIMARY KEY auto_increment,
    nombreusuario varchar
(25) not null default '',
    contrasena varchar
(1000) not null default '',
    isadmin TINYINT not null default 0,
    activo TINYINT not null default 0,
    idsistema int not null default 0
);

insert into usuario
values(0, 'admin', md5('12345678'), 1, 1, 1);
insert into usuario
values(0, 'invitado', md5('12345678'), 0, 1, 1);

create table modelo(
    idmodelo int PRIMARY KEY auto_increment,
    idsistema int not null default 0,
    nombremodelo varchar
(255) not null default '',
    campos VARCHAR
(2500) not null default '',
    tablas VARCHAR
(5000) not null default '',
    host varchar
(1000) not null default '',
    dbusr varchar
(1000) not null default '',
    dbpass varchar
(1000) not null default '',
    dbname varchar
(1000) not null default '',
    activo TINYINT not null default 0
);

create table sistema(
    idsistema int PRIMARY KEY auto_increment, 
    nombresistema varchar
(1000) not null default '',
    activo TINYINT not null default 0
);

insert into sistema
values(0, 'Bolsa de trabajo', 1);

/*

select detalleventa.idproducto, cliente.idcliente as `Clave de cliente`, venta.idventa as `No. Venta`, detalleventa.cantidad, venta.fecha, cliente.nombre as `Nombre del cliente`, cliente.rfc, cliente.direccion , cliente.idusuario as `Clave de usuario`, producto.idcategoria as `Clave de categoría`, producto.claveproducto as `clave del producto`, producto.nombreproducto as `Nombre del producto`, producto.descripcionproducto as `Descripción`, producto.fechaalta as `Fecha de alta del producto`, producto.activo, producto.urlfoto from detalleventa inner join venta using(idventa) inner join cliente using(idcliente) inner join producto using(idproducto) inner join sucursal on sucursal.idsucursal = venta.idsuc

 detalleventa.idproducto, cliente.idcliente as 'Clave de cliente', venta.idventa as 'No. Venta', detalleventa.cantidad, venta.fecha, cliente.nombre as 'Nombre del cliente', clieente.rfc, cliente.direccion , cliente.idusuario as 'Clave de usuario', producto.idcategoria as 'Clave de categoría', producto.claveproducto as 'clave del producto', producto.nombreproducto as 'Nombre del producto', producto.descripcionproducto as 'Descripción, producto.fechaalta as 'Fecha de alta del producto', producto.activo, producto.urlfoto
*/

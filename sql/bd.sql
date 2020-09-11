/*==============================================================*/
/* DBMS name:   MySQL 5.0                  */
/* Created on:   27/08/2020 06:36:26 p.m.           */
/*==============================================================*/


drop table if exists ALMACENES;

drop table if exists ARTICULOS;

drop table if exists CANALES;

drop table if exists CLIENTES;

drop table if exists CLI_X_RUTA;

drop table if exists COMPROBANTES;

drop table if exists DEPOSITOS;

drop table if exists DETALLE_COMPROBANTES;

drop table if exists DETALLE_MOVIMIENTO_STOCK;

drop table if exists DETALLE_PEDIDO;

drop table if exists DOCUMENTOS;

drop table if exists FLETEROS;

drop table if exists IMPUESTOS;

drop table if exists IMP_X_TIPO_IVA;

drop table if exists LISTAS_PRECIO;

drop table if exists MOVILES;

drop table if exists MOVIMIENTOS_STOCK;

drop table if exists PEDIDOS;

drop table if exists PERSO_X_RUT;

drop table if exists PRECIO_VENTA;

drop table if exists PROVEEDORES;

drop table if exists PROV_X_ARTICULO;

drop table if exists FLETEROS_X_MOVIL;

drop table if exists RUTAS;

drop table if exists STKLOTE;

drop table if exists STOCK_ALMACEN;

drop table if exists SUCURSALES;

drop table if exists TIPOMOV;

drop table if exists TIPOS_IVA;

drop table if exists TIPO_RUTA;

drop table if exists VENDEDORES;

/*==============================================================*/
/* Table: ALMACENES                       */
/*==============================================================*/
create table ALMACENES
(
  ID_ALMACEN      int not null auto_increment,
  ID_DEPOSITO     int,
  DESALMA       varchar(50),
  primary key (ID_ALMACEN)
);

/*==============================================================*/
/* Table: ARTICULOS                       */
/*==============================================================*/
create table ARTICULOS
(
  ID_ARTICULO     int not null auto_increment,
  DESCRIPCION     varchar(60),
  FECALTA       date default NULL,
  VALOR        float ,
  INTERNOS       float ,
  EXENTO        int ,
  IVA         float ,
  ANULADO       int ,
  CODBARRA       varchar(26),
  BLTXPLT       int ,
  ALCOHOL       int default 1,
  PESO         float ,
  MARGEN        float ,
  FRESCURA       int ,
  CANTXCAJA      int,
  primary key (ID_ARTICULO)
);

/*==============================================================*/
/* Table: CANALES                        */
/*==============================================================*/
create table CANALES
(
  ID_CANAL       int not null auto_increment,
  DESCRIPCION     varchar(40),
  primary key (ID_CANAL)
);

/*==============================================================*/
/* Table: CLIENTES                       */
/*==============================================================*/
create table CLIENTES
(
  ID_CLIENTE      int not null auto_increment,
  ID_CANAL       int,
  ID_LISTA       int,
  ID_TIPO_IVA     int,
  ID_SUCURSAL     int,
  NOM_CLIENTE     varchar(60),
  FANTASIA     varchar(60),  
  CODPOST       int ,
  CONTACTO       varchar(50),
  DOMI_CLIENTE     varchar(60),
  TELEFONOS      varchar(26),
  DOMI_ENTREGA     varchar(80),
  XCOORD        varchar(21) default '0',
  YCOORD        varchar(21) default '0',
  MODUSR        varchar(30),
  MODFECHA       date default NULL,
  ID_TIPO_PAGO       int ,
  EMAIL        varchar(100),
  ANULADO       int ,
  FECALTA       date default NULL,
  FECANU        date ,
  COMENTARIO      varchar(100),
  primary key (ID_CLIENTE)
);

/*==============================================================*/
/* Table: CLI_X_RUTA                      */
/*==============================================================*/
create table CLI_X_RUTA
(
  ID_RUTA       int ,
  RUTA         int ,
  ID_CLIENTE      int ,
  FECRUTAHASTA     date ,
  FECRUTADESDE     date
);

/*==============================================================*/
/* Table: COMPROBANTES                     */
/*==============================================================*/
create table COMPROBANTES
(
  ID_COMPROBANTE    int not null auto_increment,
  ID_DOCUMENTO     int,
  ID_PROVEEDOR     int ,
  TIPOMOV       varchar(6),
  ID_MOVIMIENTO    int,
  ID_VENDEDOR     int ,
  COM_ID_COMPROBANTE  int,
  ID_CLIENTE      int ,
  BRUTO        float ,
  CTACTE        int ,
  FECHAFAC       date default NULL,
  FECPAGA       date default NULL,
  OPERADOR       float,
  INTERNOS       float ,
  IVA1         float ,
  NRODOC        int ,
  SERIE        int ,
  PERIB        float ,
  TASA_MUNI      float,
  TOTAL        float ,
  ANULADO       int ,
  primary key (ID_COMPROBANTE)
);

/*==============================================================*/
/* Table: DEPOSITOS                       */
/*==============================================================*/
create table DEPOSITOS
(
  ID_DEPOSITO     int not null auto_increment,
  DESCRIPCION     varchar(60),
  ANULADO       int ,
  XCOORD        varchar(60) default '0',
  YCOORD        varchar(60) default '0',
  CALLE        varchar(50),
  ALTURA        int ,
  primary key (ID_DEPOSITO)
);

/*==============================================================*/
/* Table: DETALLE_COMPROBANTES                 */
/*==============================================================*/
create table DETALLE_COMPROBANTES
(
  ID_DETALLE      int not null auto_increment,
  ID_ARTICULO     int ,
  ID_COMPROBANTE    int,
  BONIF        float ,
  CANT         int ,
  LETRA        varchar(2),
  NRODOC        int ,
  PRECIO        float ,
  SERIE        int ,
  PESO         float ,
  IVA         float ,
  IVA1         float ,
  INTERNOS       float ,
  PERIB        float ,
  primary key (ID_DETALLE)
);

/*==============================================================*/
/* Table: DETALLE_MOVIMIENTO_STOCK               */
/*==============================================================*/
create table DETALLE_MOVIMIENTO_STOCK
(
  ID_DETALLE_MOV    int not null auto_increment,
  MOV_ID_PROVEEDOR   int ,
  TIPOMOV       varchar(6),
  ID_MOVIMIENTO    int,
  ID_ARTICULO     int ,
  ID_LOTE       int ,
  FECVTOLOTE      date default NULL,
  ID_PROVEEDOR     int ,
  CANT         int ,
  PRECIO        float ,
  ANULADO       int ,
  BONIF        float ,
  primary key (ID_DETALLE_MOV)
);

/*==============================================================*/
/* Table: DETALLE_PEDIDO                    */
/*==============================================================*/
create table DETALLE_PEDIDO
(
  ID_DETALLE_PEDIDO  int not null auto_increment,
  ID_ARTICULO     int ,
  ID_PEDIDO      int,
  BONIF        float ,
  CANT         int ,
  PRECIO        float ,
  IVA         float ,
  INTERNOS       float ,
  PERIB        float ,
  primary key (ID_DETALLE_PEDIDO)
);

/*==============================================================*/
/* Table: DOCUMENTOS                      */
/*==============================================================*/
create table DOCUMENTOS
(
  ID_DOCUMENTO     int not null auto_increment,
  DESCRIPCION     varchar(50),
  LETRA        char(1),
  SIGNO        varchar(1),
  primary key (ID_DOCUMENTO)
);

/*==============================================================*/
/* Table: FLETEROS                       */
/*==============================================================*/
create table FLETEROS
(
  ID_FLETERO      int not null auto_increment,
  NOM_FLETERO     varchar(40),
  TELEFONO       varchar(40),
  ANULADO       int ,
  primary key (ID_FLETERO)
);

/*==============================================================*/
/* Table: IMPUESTOS                       */
/*==============================================================*/
create table IMPUESTOS
(
  ID_IMPUESTO     int not null auto_increment,
  DESCRIPCION     varchar(30),
  ALICUOTA       float,
  primary key (ID_IMPUESTO)
);

/*==============================================================*/
/* Table: IMP_X_TIPO_IVA                    */
/*==============================================================*/
create table IMP_X_TIPO_IVA
(
  ID_TIPO_IVA     int not null,
  ID_IMPUESTO     int not null,
  primary key (ID_TIPO_IVA, ID_IMPUESTO)
);

/*==============================================================*/
/* Table: LISTAS_PRECIO                     */
/*==============================================================*/
create table LISTAS_PRECIO
(
  ID_LISTA       int not null auto_increment,
  DESCRIPCION     varchar(20),
  primary key (ID_LISTA)
);

/*==============================================================*/
/* Table: MOVILES                        */
/*==============================================================*/
create table MOVILES
(
  ID_MOVIL       int not null auto_increment,
  NOM_MOVIL      varchar(60),
  CHAPA        varchar(16),
  VEHICULO       varchar(52),
  PROPIO        int ,
  MODELO        varchar(8),
  MAXPESO       float ,
  ANULADO       int,
  primary key (ID_MOVIL)
);

/*==============================================================*/
/* Table: MOVIMIENTOS_STOCK                   */
/*==============================================================*/
create table MOVIMIENTOS_STOCK
(
  ID_PROVEEDOR     int not null auto_increment,
  TIPOMOV       varchar(6) not null,
  ID_MOVIMIENTO    int not null,
  ID_DOCUMENTO     int,
  ID_MOVIL       int ,
  FECENTRE       date default NULL,
  NROLIQ        int ,
  NROMOV        int ,
  OPERADOR       varchar(30),
  FECHALIQ       date default NULL,
  HORAEMI       varchar(16),
  ANULADO       tinyint ,
  SERIE        int ,
  OBSERVACIONES    varchar(100),
  primary key (ID_PROVEEDOR, TIPOMOV, ID_MOVIMIENTO)
);

/*==============================================================*/
/* Table: PEDIDOS                        */
/*==============================================================*/
create table PEDIDOS
(
  ID_PEDIDO      int not null auto_increment,
  ID_CLIENTE      int ,
  ID_VENDEDOR     int ,
  FECHA        date,
  HORA         time,
  TOTAL        float,
  NETO         float ,
  CTACTE        int ,
  OPERADOR       varchar(30),
  INTERNOS       float ,
  IVA         float ,
  PERIB        float ,
  TASA_MUNI      float,
  ANULADO       int ,
  primary key (ID_PEDIDO)
);

/*==============================================================*/
/* Table: PERSO_X_RUT                      */
/*==============================================================*/
create table PERSO_X_RUT
(
  ID_RUTA       int ,
  RUTA         int ,
  ID_VENDEDOR     int ,
  DIASVIS       varchar(30),
  FECRUTAHASTA     date ,
  FECRUTADESDE     date
);

/*==============================================================*/
/* Table: PRECIO_VENTA                     */
/*==============================================================*/
create table PRECIO_VENTA
(
  ID_ARTICULO     int ,
  ID_LISTA       int,
  PRECIO        float
);

/*==============================================================*/
/* Table: PROVEEDORES                      */
/*==============================================================*/
create table PROVEEDORES
(
  ID_PROVEEDOR     int not null auto_increment,
  ID_TIPO_IVA     int,
  NOMPROV       varchar(50),
  DOMIPROV       varchar(70),
  DIAS         int ,
  NUMBRU        varchar(30),
  NUMCUIT       varchar(26),
  TELEFONO       varchar(40),
  ANULADO       int ,
  primary key (ID_PROVEEDOR)
);

/*==============================================================*/
/* Table: PROV_X_ARTICULO                    */
/*==============================================================*/
create table PROV_X_ARTICULO
(
  ID_PROVEEDOR     int ,
  ID_ARTICULO     int ,
  PRECIO_COMPRA    float
);

/*==============================================================*/
/* Table: FLETEROS_X_MOVIL                    */
/*==============================================================*/
create table FLETEROS_X_MOVIL
(
  ID_FLETERO      int not null,
  ID_MOVIL       int not null ,
  primary key (ID_FLETERO, ID_MOVIL)
);

/*==============================================================*/
/* Table: RUTAS                         */
/*==============================================================*/
create table RUTAS
(
  ID_RUTA       int not null auto_increment,
  ID_TIPO_RUTA     int,
  ID_SUCURSAL     int,
  DESCRIPCION     varchar(60),
  ANULADO       int ,
  primary key (ID_RUTA)
);

/*==============================================================*/
/* Table: STKLOTE                        */
/*==============================================================*/
create table STKLOTE
(
  ID_LOTE       int not null auto_increment,
  FECVTOLOTE      date default NULL,
  CANT         int ,
  primary key (ID_LOTE, FECVTOLOTE)
);

/*==============================================================*/
/* Table: STOCK_ALMACEN                     */
/*==============================================================*/
create table STOCK_ALMACEN
(
  ID_ARTICULO     int ,
  ID_ALMACEN      int ,
  CANTIDAD       int
);

/*==============================================================*/
/* Table: SUCURSALES                      */
/*==============================================================*/
create table SUCURSALES
(
  ID_SUCURSAL     int not null auto_increment,
  DESCRIPCION     char(10),
  primary key (ID_SUCURSAL)
);

/*==============================================================*/
/* Table: TIPOMOV                        */
/*==============================================================*/
create table TIPOMOV
(
  TIPOMOV       varchar(6) not null,
  DESCMOV       varchar(64),
  primary key (TIPOMOV)
);

/*==============================================================*/
/* Table: TIPOS_IVA                       */
/*==============================================================*/
create table TIPOS_IVA
(
  ID_TIPO_IVA     int not null auto_increment,
  DESCRIPCION     varchar(40),
  primary key (ID_TIPO_IVA)
);

/*==============================================================*/
/* Table: TIPO_RUTA                       */
/*==============================================================*/
create table TIPO_RUTA
(
  ID_TIPO_RUTA     int not null auto_increment,
  DESCRIPCION     varchar(50),
  primary key (ID_TIPO_RUTA)
);

/*==============================================================*/
/* Table: VENDEDORES                      */
/*==============================================================*/
create table VENDEDORES
(
  ID_VENDEDOR     int not null auto_increment,
  ID_SUCURSAL     int,
  VEN_ID_VENDEDOR   int ,
  NOM_VENEDDOR     varchar(60),
  CARGO        varchar(2) default 'V',
  DOMICILIO      varchar(70),
  TELEFOS       varchar(40),
  ANULADO       int ,
  primary key (ID_VENDEDOR)
);

create table TIPOS_PAGO
(
   ID_TIPO_PAGO         int not null auto_increment,
   DESCRIPCION          varchar(40),
   primary key (ID_TIPO_PAGO)
);

alter table CLIENTES add constraint FK_REFERENCE_43 foreign key (ID_TIPO_PAGO)
      references TIPOS_PAGO (ID_TIPO_PAGO) on delete restrict on update restrict;

alter table ALMACENES add constraint FK_REFERENCE_8 foreign key (ID_DEPOSITO)
   references DEPOSITOS (ID_DEPOSITO) on delete restrict on update restrict;

alter table CLIENTES add constraint FK_RELATIONSHIP_22 foreign key (ID_SUCURSAL)
   references SUCURSALES (ID_SUCURSAL) on delete restrict on update restrict;

alter table CLIENTES add constraint FK_RELATIONSHIP_24 foreign key (ID_LISTA)
   references LISTAS_PRECIO (ID_LISTA) on delete restrict on update restrict;

alter table CLIENTES add constraint FK_RELATIONSHIP_34 foreign key (ID_CANAL)
   references CANALES (ID_CANAL) on delete restrict on update restrict;

alter table CLIENTES add constraint FK_RELATIONSHIP_37 foreign key (ID_TIPO_IVA)
   references TIPOS_IVA (ID_TIPO_IVA) on delete restrict on update restrict;

alter table CLI_X_RUTA add constraint FK_REFERENCE_2 foreign key (ID_RUTA)
   references RUTAS (ID_RUTA) on delete restrict on update restrict;

alter table CLI_X_RUTA add constraint FK_REFERENCE_3 foreign key (ID_CLIENTE)
   references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table COMPROBANTES add constraint FK_REFERENCE_11 foreign key (COM_ID_COMPROBANTE)
   references COMPROBANTES (ID_COMPROBANTE) on delete restrict on update restrict;

alter table COMPROBANTES add constraint FK_RELATIONSHIP_27 foreign key (ID_VENDEDOR)
   references VENDEDORES (ID_VENDEDOR) on delete restrict on update restrict;

alter table COMPROBANTES add constraint FK_RELATIONSHIP_29 foreign key (ID_PROVEEDOR, TIPOMOV, ID_MOVIMIENTO)
   references MOVIMIENTOS_STOCK (ID_PROVEEDOR, TIPOMOV, ID_MOVIMIENTO) on delete restrict on update restrict;

alter table COMPROBANTES add constraint FK_RELATIONSHIP_30 foreign key (ID_DOCUMENTO)
   references DOCUMENTOS (ID_DOCUMENTO) on delete restrict on update restrict;

alter table COMPROBANTES add constraint FK_RELATIONSHIP_31 foreign key (ID_CLIENTE)
   references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table DETALLE_COMPROBANTES add constraint FK_REFERENCE_12 foreign key (ID_COMPROBANTE)
   references COMPROBANTES (ID_COMPROBANTE) on delete restrict on update restrict;

alter table DETALLE_COMPROBANTES add constraint FK_REFERENCE_13 foreign key (ID_ARTICULO)
   references ARTICULOS (ID_ARTICULO) on delete restrict on update restrict;

alter table DETALLE_MOVIMIENTO_STOCK add constraint FK_REFERENCE_17 foreign key (ID_ARTICULO)
   references ARTICULOS (ID_ARTICULO) on delete restrict on update restrict;

alter table DETALLE_MOVIMIENTO_STOCK add constraint FK_REFERENCE_18 foreign key (MOV_ID_PROVEEDOR, TIPOMOV, ID_MOVIMIENTO)
   references MOVIMIENTOS_STOCK (ID_PROVEEDOR, TIPOMOV, ID_MOVIMIENTO) on delete restrict on update restrict;

alter table DETALLE_MOVIMIENTO_STOCK add constraint FK_REFERENCE_19 foreign key (ID_LOTE, FECVTOLOTE)
   references STKLOTE (ID_LOTE, FECVTOLOTE) on delete restrict on update restrict;

alter table DETALLE_PEDIDO add constraint FK_RELATIONSHIP_33 foreign key (ID_PEDIDO)
   references PEDIDOS (ID_PEDIDO) on delete restrict on update restrict;

alter table DETALLE_PEDIDO add constraint FK_RELATIONSHIP_40 foreign key (ID_ARTICULO)
   references ARTICULOS (ID_ARTICULO) on delete restrict on update restrict;

alter table IMP_X_TIPO_IVA add constraint FK_RELATIONSHIP_380 foreign key (ID_IMPUESTO)
   references IMPUESTOS (ID_IMPUESTO) on delete restrict on update restrict;

alter table IMP_X_TIPO_IVA add constraint FK_RELATIONSHIP_38 foreign key (ID_TIPO_IVA)
   references TIPOS_IVA (ID_TIPO_IVA) on delete restrict on update restrict;

alter table MOVIMIENTOS_STOCK add constraint FK_REFERENCE_15 foreign key (ID_MOVIL)
   references MOVILES (ID_MOVIL) on delete restrict on update restrict;

alter table MOVIMIENTOS_STOCK add constraint FK_REFERENCE_16 foreign key (ID_PROVEEDOR)
   references PROVEEDORES (ID_PROVEEDOR) on delete restrict on update restrict;

alter table MOVIMIENTOS_STOCK add constraint FK_REFERENCE_20 foreign key (TIPOMOV)
   references TIPOMOV (TIPOMOV) on delete restrict on update restrict;

alter table MOVIMIENTOS_STOCK add constraint FK_RELATIONSHIP_35 foreign key (ID_DOCUMENTO)
   references DOCUMENTOS (ID_DOCUMENTO) on delete restrict on update restrict;

alter table PEDIDOS add constraint FK_RELATIONSHIP_28 foreign key (ID_VENDEDOR)
   references VENDEDORES (ID_VENDEDOR) on delete restrict on update restrict;

alter table PEDIDOS add constraint FK_RELATIONSHIP_32 foreign key (ID_CLIENTE)
   references CLIENTES (ID_CLIENTE) on delete restrict on update restrict;

alter table PERSO_X_RUT add constraint FK_REFERENCE_4 foreign key (ID_VENDEDOR)
   references VENDEDORES (ID_VENDEDOR) on delete restrict on update restrict;

alter table PERSO_X_RUT add constraint FK_REFERENCE_5 foreign key (ID_RUTA)
   references RUTAS (ID_RUTA) on delete restrict on update restrict;

alter table PRECIO_VENTA add constraint FK_RELATIONSHIP_25 foreign key (ID_LISTA)
   references LISTAS_PRECIO (ID_LISTA) on delete restrict on update restrict;

alter table PRECIO_VENTA add constraint FK_RELATIONSHIP_26 foreign key (ID_ARTICULO)
   references ARTICULOS (ID_ARTICULO) on delete restrict on update restrict;

alter table PROVEEDORES add constraint FK_RELATIONSHIP_36 foreign key (ID_TIPO_IVA)
   references TIPOS_IVA (ID_TIPO_IVA) on delete restrict on update restrict;

alter table PROV_X_ARTICULO add constraint FK_REFERENCE_6 foreign key (ID_PROVEEDOR)
   references PROVEEDORES (ID_PROVEEDOR) on delete restrict on update restrict;

alter table PROV_X_ARTICULO add constraint FK_REFERENCE_7 foreign key (ID_ARTICULO)
   references ARTICULOS (ID_ARTICULO) on delete restrict on update restrict;

alter table FLETEROS_X_MOVIL add constraint FK_FLETEROS_X_MOVIL0 foreign key (ID_FLETERO)
   references FLETEROS (ID_FLETERO) on delete restrict on update restrict;

alter table FLETEROS_X_MOVIL add constraint FK_FLETEROS_X_MOVIL foreign key (ID_MOVIL)
   references MOVILES (ID_MOVIL) on delete restrict on update restrict;

alter table RUTAS add constraint FK_REFERENCE_1 foreign key (ID_TIPO_RUTA)
   references TIPO_RUTA (ID_TIPO_RUTA) on delete restrict on update restrict;

alter table RUTAS add constraint FK_RELATIONSHIP_23 foreign key (ID_SUCURSAL)
   references SUCURSALES (ID_SUCURSAL) on delete restrict on update restrict;

alter table STOCK_ALMACEN add constraint FK_REFERENCE_10 foreign key (ID_ARTICULO)
   references ARTICULOS (ID_ARTICULO) on delete restrict on update restrict;

alter table STOCK_ALMACEN add constraint FK_REFERENCE_9 foreign key (ID_ALMACEN)
   references ALMACENES (ID_ALMACEN) on delete restrict on update restrict;

alter table VENDEDORES add constraint FK_REFERENCE_14 foreign key (VEN_ID_VENDEDOR)
   references VENDEDORES (ID_VENDEDOR) on delete restrict on update restrict;

alter table VENDEDORES add constraint FK_RELATIONSHIP_21 foreign key (ID_SUCURSAL)
   references SUCURSALES (ID_SUCURSAL) on delete restrict on update restrict;


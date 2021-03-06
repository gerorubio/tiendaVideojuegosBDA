DROP CLUSTER clu_desarrollador;
DROP INDEX idx_cluster_desarrollador ON CLUSTER clu_desarrollador TABLESPACE USERS;
DROP TABLE DESARROLLADOR;
DROP TABLE GENERO;
DROP TABLE VIDEOJUEGO_GENERO;
DROP TABLE EDITOR;
DROP TABLE IDIOMAS;
DROP TABLE VIDEOJUEGO;
DROP BITMAP INDEX index_genero;
DROP BITMAP INDEX index_editor;
DROP BITMAP INDEX index_idiomas;

CREATE CLUSTER clu_desarrollador(id_desarrollador NUMBER(7))
  SIZE 200
  TABLESPACE USERS;

CREATE INDEX idx_cluster_desarrollador ON CLUSTER clu_desarrollador TABLESPACE USERS;




--tablas indice organizado

CREATE TABLE GENERO (
  id_genero            NUMBER(7) NOT NULL ,
  nombre_genero        VARCHAR2(20) NOT NULL,
  CONSTRAINT PK_GENERO PRIMARY KEY(id_genero)
) ORGANIZATION INDEX TABLESPACE USERS;



CREATE TABLE EDITOR (
  id_editor            NUMBER(7) NOT NULL,
  nombre_editor        VARCHAR2(50) NOT NULL,
  CONSTRAINT PK_EDITOR PRIMARY KEY(id_editor)
) ORGANIZATION INDEX TABLESPACE USERS;

CREATE TABLE IDIOMAS (
  id_idioma             NUMBER(7) NOT NULL,
  nombre_idioma         VARCHAR2(30) NOT NULL,
  CONSTRAINT PK_IDIOMA PRIMARY KEY(id_idioma)
) ORGANIZATION INDEX TABLESPACE USERS;

--Cluster
CREATE TABLE DESARROLLADOR (
  id_desarrollador NUMBER(7) NOT NULL,
  nombre_desarrollador VARCHAR2(50) NOT NULL,
  CONSTRAINT PK_DESARROLLADOR PRIMARY KEY(id_desarrollador)
) CLUSTER clu_desarrollador(id_desarrollador);


CREATE TABLE VIDEOJUEGO
(
  id_videojuego        NUMBER(10) NOT NULL ,
  nombre               VARCHAR2(50) NOT NULL ,
  precio               NUMBER(6,2) NULL ,
  fecha_lanzamiento    DATE NULL ,
  id_desarrollador     NUMBER(7) NOT NULL ,
  id_editor            NUMBER(7) NOT NULL ,
  trailer              VARCHAR2(30) NULL ,
  sinopsis             VARCHAR2(150) NOT NULL ,
  clasificacion        VARCHAR2(4) NULL,
  id_idioma            NUMBER(7) NOT NULL,
  CONSTRAINT PK_VIDEOJUEGO PRIMARY KEY(id_videojuego),
  CONSTRAINT FK_VIDEOJUEGO_DESARROLLADOR FOREIGN KEY (id_desarrollador) 
    REFERENCES DESARROLLADOR(id_desarrollador),
  CONSTRAINT FK_VIDEOJUEGO_EDITOR FOREIGN KEY (id_editor) 
    REFERENCES EDITOR(id_editor),
  CONSTRAINT FK_VIDEOJUEGO_IDIOMA FOREIGN KEY (id_idioma)
    REFERENCES IDIOMAS(id_idioma)
) CLUSTER clu_desarrollador(id_desarrollador);


CREATE TABLE VIDEOJUEGO_GENERO
(
  id_videojuego        NUMBER(10) NOT NULL ,
  id_genero            NUMBER(7) NOT NULL,
  CONSTRAINT PK_VIDEOJUEGO_GENERO PRIMARY KEY (id_videojuego,id_genero)
  CONSTRAINT FK_VIDEOGENERO_VIDEOJUEGO FOREIGN KEY (id_videojuego) 
    REFERENCES VIDEOJUEGO(id_videojuego),
  CONSTRAINT FK_VIDEOGENERO_GENERO FOREIGN KEY (id_genero) 
    REFERENCES GENERO(id_genero)
) ORGANIZATION INDEX TABLESPACE USERS;

--bitmaps

CREATE BITMAP INDEX index_genero ON GENERO(id_genero) TABLESPACE USERS
  STORAGE(initial 4K Next 4K PCTINCREASE 0);

CREATE BITMAP INDEX index_editor ON EDITOR(id_editor) TABLESPACE USERS
  STORAGE(initial 4K Next 4K PCTINCREASE 0);

CREATE BITMAP INDEX index_idiomas ON IDIOMAS(id_idioma) TABLESPACE USERS
  STORAGE(initial 4K Next 4K PCTINCREASE 0);


--INSERTS

INSERT INTO DESARROLLADOR VALUES(001,'Rockstar North');
INSERT INTO DESARROLLADOR VALUES(002,'FromSoftware Inc');
INSERT INTO DESARROLLADOR VALUES(003,'SEGA');
INSERT INTO DESARROLLADOR VALUES(004,'DICE');
INSERT INTO DESARROLLADOR VALUES(005,'Tango Gameworks');
INSERT INTO DESARROLLADOR VALUES(006,'Team Cherry');

INSERT INTO GENERO VALUES(001,'Mundo Abierto');
INSERT INTO GENERO VALUES(002,'Acci??n');
INSERT INTO GENERO VALUES(003,'Multijugador');
INSERT INTO GENERO VALUES(004,'Arcade');
INSERT INTO GENERO VALUES(005,'Aventura');
INSERT INTO GENERO VALUES(006,'Sobrenatural');

INSERT INTO EDITOR VALUES(001,'Bandai Namco');
INSERT INTO EDITOR VALUES(002,'Rockstar Games');
INSERT INTO EDITOR VALUES(003,'Activision');
INSERT INTO EDITOR VALUES(004,'SEGA');
INSERT INTO EDITOR VALUES(005,'Electronic Arts');
INSERT INTO EDITOR VALUES(006,'Bethesda Softworks');
INSERT INTO EDITOR VALUES(007,'Team Cherry');

INSERT INTO IDIOMAS VALUES(01,'Ingl??s');
INSERT INTO IDIOMAS VALUES(02,'Espa??ol');
INSERT INTO IDIOMAS VALUES(03,'Japones');
INSERT INTO IDIOMAS VALUES(04,'Chino');
INSERT INTO IDIOMAS VALUES(05,'Coreano');
INSERT INTO IDIOMAS VALUES(06,'Frances');
INSERT INTO IDIOMAS VALUES(07,'Italiano');

INSERT INTO VIDEOJUEGO VALUES(1,'Grand Theft Auto V',445.69,'14/04/15',001,002,'GTA5.jpg','Grand Theft Auto V para PC ofrece a los jugadores la opci??n de explorar el galardonado mundo de Los Santos y el condado de Blaine','M17',01);
INSERT INTO VIDEOJUEGO VALUES(2,'Elden Ring',1200.00,'24/02/22',002,001,'eldenring.mp4','EL NUEVO JUEGO DE ROL Y ACCI??N DE AMBIENTACI??N FANT??STICA','M17',02);
INSERT INTO VIDEOJUEGO VALUES(3,'Sekiro: ShadowsDie Twice',1200.00,'21/03/19',002,003,'sekiro.mp4','V??ngate. Restituye tu honor. Mata con ingenio.','M17',03);
INSERT INTO VIDEOJUEGO VALUES(4,'Hatsune Miku: Project DIVA Mega Mix+',499.00,'22/05/22',004,003,'miku.mp4','Disfruta de la gira definitiva de Hatsune Miku.','M17',03);
INSERT INTO VIDEOJUEGO VALUES(5,'STAR WARS Battlefront',439.00,'16/11/15',004,005,'swbattle.jpg','La Ed. Ultimate de STAR WARS Battlefront incluye la Ed. Deluxe de STAR WARS Battlefront adem??s del pase de temporada de STAR WARS Battlefront','T',06);
INSERT INTO VIDEOJUEGO VALUES(6,'Ghostwire: Tokyo',1079.00,'24/02/22',005,006,'ghost.jpg','La poblaci??n de Tokio ha desaparecido y unas mort??feras fuerzas sobrenaturales merodean por las calles. ','M17',04);

INSERT INTO VIDEOJUEGO_GENERO VALUES(1,001);
INSERT INTO VIDEOJUEGO_GENERO VALUES(1,002);
INSERT INTO VIDEOJUEGO_GENERO VALUES(2,001);
INSERT INTO VIDEOJUEGO_GENERO VALUES(2,002);
INSERT INTO VIDEOJUEGO_GENERO VALUES(3,001);
INSERT INTO VIDEOJUEGO_GENERO VALUES(3,002);
INSERT INTO VIDEOJUEGO_GENERO VALUES(4,004);
INSERT INTO VIDEOJUEGO_GENERO VALUES(5,002);
INSERT INTO VIDEOJUEGO_GENERO VALUES(5,003);
INSERT INTO VIDEOJUEGO_GENERO VALUES(6,005);
INSERT INTO VIDEOJUEGO_GENERO VALUES(6,006);



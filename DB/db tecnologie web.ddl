-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Fri Jan 16 11:18:56 2026 
-- * LUN file: C:\Users\user\OneDrive\Desktop\uni\tecnologie web\db tecnologie web.lun 
-- * Schema: tecnologieWeb logico/SQL 
-- ********************************************* 


-- Database Section
-- ________________ 

drop database if exists tecnologieWeb;
create database if not exists tecnologieWeb;
use tecnologieWeb;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table UTENTE (
     nome char(50) not null,
     email char(50) not null,
     cognome char(50) not null,
     admin boolean not null default false,
     password char(20) not null,
     constraint ID_UTENTE_ID primary key (email));

create table GRUPPO (
     nome char(30) not null,
     numero_partecipanti int not null,
     descr_breve char(100) not null,
     descr_lunga text(1000) not null,
     privato boolean not null,
     idGruppo int not null auto_increment,
     corso_di_riferimento char(50) not null,
     creatore char(50) not null,
     constraint ID_GRUPPO_ID primary key (idGruppo));

create table CORSO (
     nome char(50) not null,
     constraint ID_CORSO_ID primary key (nome));

create table TAG (
     nome char(30) not null,
     constraint ID_TAG_ID primary key (nome));

create table NOTIFICA (
     testo text(500) not null,
     oggetto char(30) not null,
     tipo enum ("messaggio","richiesta","segnalazione") not null,
     data datetime not null,
     idNotifica int not null auto_increment,
     mittente char(50) not null,
     constraint ID_NOTIFICA_ID primary key (idNotifica));

create table fa_parte (
     idGruppo int not null auto_increment,
     email char(50) not null,
     constraint ID_fa_parte_ID primary key (idGruppo, email));

create table possiede (
     nome char(30) not null,
     idGruppo int not null,
     constraint ID_possiede_ID primary key (nome, idGruppo));

create table riceve (
     destinatario char(50) not null,
     idNotifica int not null,
     visto boolean not null default false,
     constraint ID_riceve_ID primary key (destinatario, idNotifica));

create table CHAT (
     idChat int not null auto_increment,
     idGruppo int not null,
     constraint ID_CHAT_ID primary key (idChat));

create table messaggio (
     idChat int not null,
     idNotifica int not null,
     constraint ID_messaggio_ID primary key (idChat,idNotifica));

create table notifica_in_gruppo (
     idGruppo int not null,
     idNotifica int not null,
     constraint ID_notifica_in_gruppo_ID primary key (idGruppo,idNotifica));


-- Constraints Section
-- ___________________ 

alter table GRUPPO add constraint REF_GRUPP_CORSO_FK
     foreign key (corso_di_riferimento)
     references CORSO(nome)
     on delete cascade;

alter table GRUPPO add constraint REF_GRUPP_UTENT_FK
     foreign key (creatore)
     references UTENTE(email);

/*alter table NOTIFICA add constraint ID_NOTIFICA_CHK
     check(exists(select * from riceve
                  where riceve.idNotifica = idNotifica)); */

alter table NOTIFICA add constraint REF_NOTIF_UTENT_FK
     foreign key (mittente)
     references UTENTE(email);

alter table fa_parte add constraint REF_fa_pa_UTENT_FK
     foreign key (email)
     references UTENTE(email);

alter table fa_parte add constraint EQU_fa_pa_GRUPP
     foreign key (idGruppo)
     references GRUPPO(idGruppo)
     on delete cascade;

alter table possiede add constraint EQU_possi_GRUPP_FK
     foreign key (idGruppo)
     references GRUPPO(idGruppo)
     on delete cascade;

alter table possiede add constraint REF_possi_TAG
     foreign key (nome)
     references TAG(nome)
     on delete cascade;

alter table riceve add constraint EQU_ricev_NOTIF_FK
     foreign key (idNotifica)
     references NOTIFICA(idNotifica)
     on delete cascade;

alter table riceve add constraint REF_ricev_UTENT
     foreign key (destinatario)
     references UTENTE(email)
     on delete cascade;

alter table CHAT add constraint EQU_CHAT_GRUPP
     foreign key (idGruppo)
     references GRUPPO(idGruppo)
     on delete cascade;

alter table messaggio add constraint REF_mess_CHAT_FK
     foreign key (idChat)
     references CHAT(idChat)
     on delete cascade;

alter table messaggio add constraint REF_mess_NOTIF_FK
     foreign key (idNotifica)
     references NOTIFICA(idNotifica)
     on delete cascade;

alter table notifica_in_gruppo add constraint REF_NOT_GROUP
     foreign key (idNotifica)
     references NOTIFICA(idNotifica)
     on delete cascade;

alter table notifica_in_gruppo add constraint REF_GROUP_NOT
     foreign key (idGruppo)
     references GRUPPO(idGruppo)
     on delete cascade;
     

/*alter table GRUPPO add constraint ID_GRUPPO_CHK
     check(exists(select * from fa_parte
                  where fa_parte.idGruppo = idGruppo)); 

alter table GRUPPO add constraint ID_GRUPPO_CHK
     check(exists(select * from possiede
                  where possiede.idGruppo = idGruppo)); */

-- Index Section
-- _____________ 

create unique index ID_UTENTE_IND
     on UTENTE (email);

create unique index ID_GRUPPO_IND
     on GRUPPO (idGruppo);

create index REF_GRUPP_CORSO_IND
     on GRUPPO (corso_di_riferimento);

create index REF_GRUPP_UTENT_IND
     on GRUPPO (creatore);

create unique index ID_CORSO_IND
     on CORSO (nome);

create unique index ID_TAG_IND
     on TAG (nome);

create unique index ID_NOTIFICA_IND
     on NOTIFICA (idNotifica);

create index REF_NOTIF_UTENT_IND
     on NOTIFICA (mittente);

create unique index ID_fa_parte_IND
     on fa_parte (idGruppo, email);

create index REF_fa_pa_UTENT_IND
     on fa_parte (email);

create unique index ID_possiede_IND
     on possiede (nome, idGruppo);

create index EQU_possi_GRUPP_IND
     on possiede (idGruppo);

create unique index ID_riceve_IND
     on riceve (destinatario, idNotifica);

create index EQU_ricev_NOTIF_IND
     on riceve (idNotifica);

create unique index ID_CHAT_IND
     on CHAT (idChat);

create index EQU_CHAT_GRUPP_IND
     on CHAT (idGruppo);

create index ID_mess_IND
     on messaggio (idChat,idNotifica);

create index REF_mess_NOTIF_IND
     on messaggio (idNotifica);

use tecnologieWeb;
insert into corso(nome) 
values ("Tecnologie Web"),("OOP"),("Programmazione"),("Basi di dati");

insert into utente(nome,cognome,email,password) 
values ("Alessandro", "Ravaioli", "alessandro.ravaioli@studio.unibo.it","Ciao"),
	("Daniele", "Tramonti", "daniele.tramonti@studio.unibo.it","ciao"),
       ("Marco", "Bulgarelli", "marco.bulgarelli@studio.unibo.it","ciao"),
       ("Carlo", "Verdi", "carlo.verdi@studio.unibo.it","ciao"),
       ("Mario", "Rossi", "mario.rossi@studio.unibo.it","ciao"),
       ("Fulvia", "Bianchi", "fulvia.bianchi@studio.unibo.it","ciao"),
       ("Caterina", "Gialli", "caterina.gialli@studio.unibo.it","ciao"),
       ("Gennaro", "Fabbri", "gennaro.fabbri@studio.unibo.it","ciao"),
       ("Giovanni", "Bianchi", "giovanni.bianchi@studio.unibo.it","ciao"),
       ("Roberto", "Verdi", "roberto.verdi@studio.unibo.it","ciao");

insert into utente(nome,cognome,email,password,admin)
values ("Gianni","Rossi","gianni.rossi@studio.unibo.it","admin",true); 
       
insert into gruppo(nome,numero_partecipanti,descr_breve,descr_lunga,privato,corso_di_riferimento,creatore)
values ("test",3,"breve","luuuuuunga",false,"Tecnologie Web","alessandro.ravaioli@studio.unibo.it"),
	("test",3,"breve","luuuuuunga",false,"Tecnologie Web","carlo.verdi@studio.unibo.it"),
       ("test",3,"breve","luuuuuunga",false,"Tecnologie Web","gennaro.fabbri@studio.unibo.it"),
       ("test",4,"breve","luuuuuunga",false,"OOP","alessandro.ravaioli@studio.unibo.it"),
       ("test",4,"breve","luuuuuunga",false,"OOP","mario.rossi@studio.unibo.it"),
       ("test",4,"breve","luuuuuunga",true,"OOP","roberto.verdi@studio.unibo.it"),
       ("test",3,"breve","luuuuuunga",false,"Basi di dati","alessandro.ravaioli@studio.unibo.it"),
       ("test",3,"breve","luuuuuunga",true,"Basi di dati","fulvia.bianchi@studio.unibo.it"),
       ("test",2,"breve","luuuuuunga",false,"Basi di dati","gennaro.fabbri@studio.unibo.it"),
       ("test",4,"breve","luuuuuunga",false,"Programmazione","alessandro.ravaioli@studio.unibo.it");


insert into fa_parte(idGruppo,email)
values (1,"alessandro.ravaioli@studio.unibo.it"), (1,"daniele.tramonti@studio.unibo.it"), (1,"marco.bulgarelli@studio.unibo.it"),
       (2,"carlo.verdi@studio.unibo.it"), (2,"mario.rossi@studio.unibo.it"), (2,"fulvia.bianchi@studio.unibo.it"),
       (3,"gennaro.fabbri@studio.unibo.it"), (3,"giovanni.bianchi@studio.unibo.it"), (3,"roberto.verdi@studio.unibo.it"),
       (4,"alessandro.ravaioli@studio.unibo.it"), (4,"daniele.tramonti@studio.unibo.it"), (4,"marco.bulgarelli@studio.unibo.it"), (4,"carlo.verdi@studio.unibo.it"),
       (5,"mario.rossi@studio.unibo.it"), (5,"fulvia.bianchi@studio.unibo.it"), (5,"gennaro.fabbri@studio.unibo.it"),
       (6,"roberto.verdi@studio.unibo.it"), (6,"giovanni.bianchi@studio.unibo.it"),
       (7,"alessandro.ravaioli@studio.unibo.it"), (7,"daniele.tramonti@studio.unibo.it"), (7,"marco.bulgarelli@studio.unibo.it"),
       (8,"fulvia.bianchi@studio.unibo.it"), (8,"mario.rossi@studio.unibo.it"),
       (9,"gennaro.fabbri@studio.unibo.it"),
       (10,"alessandro.ravaioli@studio.unibo.it"), (10,"daniele.tramonti@studio.unibo.it"), (10,"marco.bulgarelli@studio.unibo.it"), (10,"roberto.verdi@studio.unibo.it");

-- commentare questa query qui sotto se si usa il database coi filtri, questa è solo per i tag
insert into tag(nome)
values ("online"),("in presenza"),("gioco"),("simulatore"),("accessibile"),("sufficiente"),("ghost");

insert into notifica(testo,oggetto,tipo,mittente,data)
values ("prima prova di messaggio chissa se funziona","test","messaggio","alessandro.ravaioli@studio.unibo.it",NOW()),
       ("Messaggio di prova non so cosa scrivere, ciao","prova","messaggio","alessandro.ravaioli@studio.unibo.it",NOW()),
       ("Buongiorno, vorrei entrare nel gruppo","richiesta entrata","richiesta","gennaro.fabbri@studio.unibo.it",NOW());

insert into riceve(destinatario,idNotifica)
values ("daniele.tramonti@studio.unibo.it",1),("marco.bulgarelli@studio.unibo.it",1),
       ("marco.bulgarelli@studio.unibo.it",2),("daniele.tramonti@studio.unibo.it",2),("carlo.verdi@studio.unibo.it",2),
       ("marco.bulgarelli@studio.unibo.it",3);

INSERT INTO possiede(idGruppo,nome) 
values (1,"ghost"),(2,"ghost"),(3,"ghost"),(4,"ghost"),(5,"ghost"),(6,"ghost"),(7,"ghost"),(8,"ghost"),(9,"ghost"),(10,"ghost");

insert into possiede(nome,idGruppo)
values ("online",1),("online",3),("online",4),("online",10),("online",7),
	("gioco",4),("gioco",5),
       ("accessibile",1),("accessibile",2),("accessibile",3),("accessibile",5),("accessibile",10),
       ("in presenza",9),("in presenza",2),("in presenza",6),
       ("simulatore",6),("simulatore",8),
       ("sufficiente",3);

insert into CHAT(idChat,idGruppo) 
values (1,1),(2,2),(3,3),(4,4),(5,5),(6,6),(7,7),(8,8),(9,9),(10,10);

insert into messaggio(idChat,idNotifica)
values (1,1),(4,2);

insert into notifica_in_gruppo(idNotifica, idGruppo)
values (3,1);

/*
delete from corso where nome = "TecnologieWeb";
delete from utente;
*/
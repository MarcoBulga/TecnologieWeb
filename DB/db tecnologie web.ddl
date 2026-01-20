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
     telefono numeric(10) not null,
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


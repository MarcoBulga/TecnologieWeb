use tecnologieWeb;
insert into corso(nome)
values ("Basi di dati"),("OOP"),("Programmazione"),("Tecnologie Web");
insert into utente(nome,cognome,email,password,admin)
values ("Alessandro","Ravaioli","alessandro.ravaioli@studio.unibo.it","Ciao",0),
("Carlo","Verdi","carlo.verdi@studio.unibo.it","ciao",0),
("Caterina","Gialli","caterina.gialli@studio.unibo.it","ciao",0),
("Daniele","Tramonti","daniele.tramonti@studio.unibo.it","ciao",0),
("Fulvia","Bianchi","fulvia.bianchi@studio.unibo.it","ciao",0),
("Gennaro","Fabbri","gennaro.fabbri@studio.unibo.it","ciao",0),
("Gianni","Rossi","gianni.rossi@studio.unibo.it","admin",1),
("Giovanni","Bianchi","giovanni.bianchi@studio.unibo.it","ciao",0),
("Marco","Bulgarelli","marco.bulgarelli@studio.unibo.it","ciao",0),
("Mario","Rossi","mario.rossi@studio.unibo.it","ciao",0),
("Roberto","Verdi","roberto.verdi@studio.unibo.it","ciao",0);

insert into gruppo(nome,numero_partecipanti,descr_breve,descr_lunga,privato,corso_di_riferimento,creatore)
values ("ricerca gruppi",3,"breve","luuuuuunga",0,"Tecnologie Web","alessandro.ravaioli@studio.unibo.it"),
("test",3,"breve","luuuuuunga",0,"Tecnologie Web","carlo.verdi@studio.unibo.it"),
("test",3,"breve","luuuuuunga",0,"Tecnologie Web","gennaro.fabbri@studio.unibo.it"),
("test",4,"breve","luuuuuunga",0,"OOP","alessandro.ravaioli@studio.unibo.it"),
("test",4,"breve","luuuuuunga",0,"OOP","mario.rossi@studio.unibo.it"),
("test",4,"breve","luuuuuunga",1,"OOP","roberto.verdi@studio.unibo.it"),
("associazioneSportiva",3,"breve","luuuuuunga",0,"Basi di dati","alessandro.ravaioli@studio.unibo.it"),
("test",3,"breve","luuuuuunga",1,"Basi di dati","fulvia.bianchi@studio.unibo.it"),
("test",2,"breve","luuuuuunga",0,"Basi di dati","gennaro.fabbri@studio.unibo.it"),
("test",4,"breve","luuuuuunga",0,"Programmazione","alessandro.ravaioli@studio.unibo.it"),
("disperati",4,"ho bisogno di un idea per un progetto","l'obiettivo sarebbe quello di fare come progetto un gioco da consegnare prima di settembre, idee ancora non chiare sulle specifiche",0,"OOP","marco.bulgarelli@studio.unibo.it"),
("ricerca",6,"qualcuno vuole studiare?","ho bisogno di qualcuno con cui studiare, percui ho creato questo gruppo",1,"Tecnologie Web","alessandro.ravaioli@studio.unibo.it");

insert into fa_parte(idGruppo,email,data_unione)
values (1,"alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58"),
(1,"daniele.tramonti@studio.unibo.it","2026-01-22 12:45:58"),
(1,"marco.bulgarelli@studio.unibo.it","2026-01-22 12:45:58"),
(2,"carlo.verdi@studio.unibo.it","2026-01-22 12:45:58"),
(2,"fulvia.bianchi@studio.unibo.it","2026-01-22 12:45:58"),
(2,"mario.rossi@studio.unibo.it","2026-01-22 12:45:58"),
(3,"gennaro.fabbri@studio.unibo.it","2026-01-22 12:45:58"),
(3,"giovanni.bianchi@studio.unibo.it","2026-01-22 12:45:58"),
(3,"roberto.verdi@studio.unibo.it","2026-01-22 12:45:58"),
(4,"alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58"),
(4,"carlo.verdi@studio.unibo.it","2026-01-22 12:45:58"),
(4,"daniele.tramonti@studio.unibo.it","2026-01-22 12:45:58"),
(4,"marco.bulgarelli@studio.unibo.it","2026-01-22 12:45:58"),
(5,"fulvia.bianchi@studio.unibo.it","2026-01-22 12:45:58"),
(5,"gennaro.fabbri@studio.unibo.it","2026-01-22 12:45:58"),
(5,"mario.rossi@studio.unibo.it","2026-01-22 12:45:58"),
(6,"giovanni.bianchi@studio.unibo.it","2026-01-22 12:45:58"),
(6,"roberto.verdi@studio.unibo.it","2026-01-22 12:45:58"),
(7,"alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58"),
(7,"daniele.tramonti@studio.unibo.it","2026-01-22 12:45:58"),
(7,"marco.bulgarelli@studio.unibo.it","2026-01-22 12:45:58"),
(8,"fulvia.bianchi@studio.unibo.it","2026-01-22 12:45:58"),
(8,"mario.rossi@studio.unibo.it","2026-01-22 12:45:58"),
(9,"gennaro.fabbri@studio.unibo.it","2026-01-22 12:45:58"),
(10,"alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58"),
(10,"daniele.tramonti@studio.unibo.it","2026-01-22 12:45:58"),
(10,"roberto.verdi@studio.unibo.it","2026-01-22 12:45:58"),
(11,"alessandro.ravaioli@studio.unibo.it","2026-01-22 19:20:00"),
(11,"marco.bulgarelli@studio.unibo.it","2026-01-22 18:53:39"),
(11,"roberto.verdi@studio.unibo.it","2026-01-22 19:09:19"),
(12,"alessandro.ravaioli@studio.unibo.it","2026-01-22 19:08:19");

insert into tag(nome)
values ("accessibile"),("avanzato"),("design"),("ghost"),("gioco"),("grafica"),("in presenza"),("laboratorio"),("mattina"),("online"),("pomeriggio"),("primo anno"),("principiante"),("progetto"),("programmazione"),("quarto anno"),("quinto anno"),("secondo anno"),("serale"),("simulatore"),("studio"),("sufficiente"),("terzo anno"),("weekend");

insert into notifica(testo,oggetto,tipo,mittente,data,idNotifica)
values ("prima prova di messaggio chissa se funziona","test","messaggio","alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58",1),
("Messaggio di prova non so cosa scrivere, ciao","prova","messaggio","alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58",2),
("Buongiorno, vorrei entrare nel gruppo","richiesta entrata","richiesta","gennaro.fabbri@studio.unibo.it","2026-01-22 12:45:58",3);

insert into riceve(destinatario,idNotifica)
values ("daniele.tramonti@studio.unibo.it",1),("marco.bulgarelli@studio.unibo.it",1),
       ("marco.bulgarelli@studio.unibo.it",2),("daniele.tramonti@studio.unibo.it",2),("carlo.verdi@studio.unibo.it",2),
       ("marco.bulgarelli@studio.unibo.it",3);

INSERT INTO possiede(idGruppo,nome)
values (1,"accessibile"),
(2,"accessibile"),
(3,"accessibile"),
(5,"accessibile"),
(10,"accessibile"),
(1,"ghost"),
(2,"ghost"),
(3,"ghost"),
(4,"ghost"),
(5,"ghost"),
(6,"ghost"),
(7,"ghost"),
(8,"ghost"),
(9,"ghost"),
(10,"ghost"),
(11,"ghost"),
(12,"ghost"),
(4,"gioco"),
(5,"gioco"),
(11,"gioco"),
(2,"in presenza"),
(6,"in presenza"),
(9,"in presenza"),
(1,"online"),
(3,"online"),
(4,"online"),
(7,"online"),
(10,"online"),
(11,"online"),
(12,"online"),
(12,"pomeriggio"),
(6,"simulatore"),
(8,"simulatore"),
(12,"studio"),
(3,"sufficiente"),
(12,"terzo anno");

insert into CHAT(idChat,idGruppo)
values (1,1),
(2,2),
(3,3),
(4,4),
(5,5),
(6,6),
(7,7),
(8,8),
(9,9),
(10,10),
(11,11),
(12,12);

insert into messaggio(idChat,idNotifica)
values (1,1),(4,2);

insert into notifica_in_gruppo(idNotifica, idGruppo)
values (3,1);

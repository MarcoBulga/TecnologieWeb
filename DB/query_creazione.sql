insert into corso(nome) 
values ("Tecnologie Web"),("OOP"),("Programmazione"),("Basi di dati");

insert into utente(nome,cognome,email,telefono,password) 
values ("Alessandro", "Ravaioli", "alessandro.ravaioli@studio.unibo.it", 1234567890,"Ciao"),
	   ("Daniele", "Tramonti", "daniele.tramonti@studio.unibo.it", 1234567890,"ciao"),
       ("Marco", "Bulgarelli", "marco.bulgarelli@studio.unibo.it", 1234567890,"ciao"),
       ("Carlo", "Verdi", "carlo.verdi@studio.unibo.it", 1234567890,"ciao"),
       ("Mario", "Rossi", "mario.rossi@studio.unibo.it", 1234567890,"ciao"),
       ("Fulvia", "Bianchi", "fulvia.bianchi@studio.unibo.it", 1234567890,"ciao"),
       ("Caterina", "Gialli", "caterina.gialli@studio.unibo.it", 1234567890,"ciao"),
       ("Gennaro", "Fabbri", "gennaro.fabbri@studio.unibo.it", 1234567890,"ciao"),
       ("Giovanni", "Bianchi", "giovanni.bianchi@studio.unibo.it", 1234567890,"ciao"),
       ("Roberto", "Verdi", "roberto.verdi@studio.unibo.it", 1234567890,"ciao");
       
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
values ("online"),("in presenza"),("gioco"),("simulatore"),("accessibile"),("sufficiente");

insert into notifica(testo,oggetto,tipo,mittente)
values ("prima prova di messaggio chissa se funziona","test","messaggio","alessandro.ravaioli@studio.unibo.it");

insert into riceve(destinatario,idNotifica)
values ("daniele.tramonti@studio.unibo.it",1);

insert into possiede(nome,idGruppo)
values ("online",1),
	   ("gioco",1);
/*
delete from corso where nome = "TecnologieWeb";
delete from utente;
*/
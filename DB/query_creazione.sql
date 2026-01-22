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
values ("Web Dev Pro",4,"Sviluppo sito E-commerce","L'obiettivo è creare una piattaforma e-commerce completa con carrello dinamico e gestione pagamenti. Usiamo PHP per il backend e CSS moderno per il frontend.",0,"Tecnologie Web","alessandro.ravaioli@studio.unibo.it"),
("Social Network Uni",3,"Mini social per studenti","Progetto focalizzato sulla creazione di un'area riservata agli studenti per scambiarsi appunti e feedback sui corsi. Interfaccia responsive e database MySQL.",0,"Tecnologie Web","carlo.verdi@studio.unibo.it"),
("Study Web",3,"Ripasso esame insieme","Ho creato questo gruppo per rivedere insieme le ultime slide del corso e fare simulazioni di domande d'esame. Aperto a chiunque voglia collaborare seriamente.",0,"Tecnologie Web","gennaro.fabbri@studio.unibo.it"),
("Java Game Engine",4,"Motore grafico 2D in Java","Vogliamo sviluppare un piccolo motore di gioco 2D utilizzando i design pattern visti a lezione (Singleton, Factory, Observer). Punto di arrivo: un clone di Pacman.",0,"OOP","alessandro.ravaioli@studio.unibo.it"),
("Gestionali Aziendali",4,"Software gestione magazzino","Esercitazione avanzata sulla gerarchia delle classi e polimorfismo per simulare la gestione delle scorte in un magazzino logistico. Uso intensivo di interfacce.",0,"OOP","mario.rossi@studio.unibo.it"),
("Cyber Hunters",4,"Videogioco a turni","Sviluppo di un gioco strategico a turni in Java. Cerchiamo persone creative per definire le meccaniche di combattimento e l'albero delle abilità dei personaggi.",1,"OOP","roberto.verdi@studio.unibo.it"),
("OOP Secrets",3,"Focus su Design Patterns","Gruppo di studio avanzato dedicato esclusivamente alla comprensione dei pattern strutturali e comportamentali in vista dello scritto.",0,"OOP","alessandro.ravaioli@studio.unibo.it"),
("Gym Database",3,"Progetto gestione Palestre","Modellazione concettuale e logica di un database per una catena di palestre. Include gestione abbonamenti, corsi e ingressi tramite SQL.",1,"Basi di dati","fulvia.bianchi@studio.unibo.it"),
("Library System",2,"Gestione Biblioteca Digitale","Progettazione schema ER per una biblioteca: gestione prestiti, catalogazione libri e profili utente. Focus particolare sulla normalizzazione delle tabelle.",0,"Basi di dati","gennaro.fabbri@studio.unibo.it"),
("SQL Masters",4,"Ottimizzazione Query","Siamo in due e vogliamo approfondire le query complesse e i trigger. Cerchiamo qualcuno che voglia sporcarsi le mani con SQL avanzato.",0,"Basi di dati","alessandro.ravaioli@studio.unibo.it"),
("Algoritmi Lab",4,"Risoluzione problemi C","Incontri settimanali per risolvere esercizi su grafi, alberi e strutture dati complesse in linguaggio C. Ottimo per prepararsi al laboratorio.",0,"Programmazione","marco.bulgarelli@studio.unibo.it"),
("Codice Pulito",6,"Basi di programmazione","Gruppo dedicato a chi è all'inizio e vuole capire meglio come strutturare i primi algoritmi e gestire la memoria (puntatori e array).",1,"Programmazione","alessandro.ravaioli@studio.unibo.it");

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
values ("Come va?","test","messaggio","alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58",1),
("Ci vediamo stasera?","prova","messaggio","alessandro.ravaioli@studio.unibo.it","2026-01-22 12:45:58",2),
("Buongiorno, vorrei entrare nel gruppo","richiesta entrata","richiesta","gennaro.fabbri@studio.unibo.it","2026-01-22 12:45:58",3);

insert into riceve(destinatario,idNotifica)
values ("daniele.tramonti@studio.unibo.it",1),("marco.bulgarelli@studio.unibo.it",1),
       ("marco.bulgarelli@studio.unibo.it",2),("daniele.tramonti@studio.unibo.it",2),("carlo.verdi@studio.unibo.it",2),
       ("marco.bulgarelli@studio.unibo.it",3);

INSERT INTO possiede(idGruppo,nome)
values (1,"progetto"),
(1,"programmazione"),
(1,"pomeriggio"),
(2,"progetto"),
(2,"design"),
(2,"secondo anno"),
(3,"studio"),
(3,"online"),
(3,"mattina"),
(4,"gioco"),
(4,"programmazione"),
(4,"avanzato"),
(5,"progetto"),
(5,"laboratorio"),
(5,"in presenza"),
(6,"gioco"),
(6,"grafica"),
(6,"weekend"),
(7,"studio"),
(7,"avanzato"),
(7,"serale"),
(8,"progetto"),
(8,"secondo anno"),
(8,"pomeriggio"),
(9,"progetto"),
(9,"sufficiente"),
(9,"online"),
(10,"avanzato"),
(10,"programmazione"),
(10,"laboratorio"),
(11,"programmazione"),
(11,"primo anno"),
(11,"in presenza"),
(12,"principiante"),
(12,"studio"),
(12,"primo anno"),

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

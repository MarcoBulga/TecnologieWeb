insert into corso(nome) value ("TecnologieWeb");

insert into utente(nome,cognome,mail,telefono) 
values ("Alessandro", "Ravaioli", "alessandro.ravaioli8@studio.unibo.it", 1234567890),
	   ("Daniele", "Tramonti", "daniele.tramonti8@studio.unibo.it", 1234567890),
       ("Marco", "Bulgarelli", "marco.bulgarelli8@studio.unibo.it", 1234567890);
       
insert into gruppo(nome,numero_partecipanti,descr_breve,descr_lunga,privato,corso_di_riferimento,creatore)
values ("test",3,"breve","luuuuuunga",false,"TecnologieWeb","alessandro.ravaioli8@studio.unibo.it");

-- Query 1: dato un utente ottenere tutti i gruppi a cui appartiene
SELECT distinct gruppo.* FROM fa_parte JOIN gruppo ON gruppo.idGruppo = fa_parte.idGruppo 
WHERE fa_parte.email = "marco.bulgarelli@studio.unibo.it";

-- Query 2: dato un gruppo ottenere tutti i suoi partecipanti
SELECT utente.nome nome,cognome FROM utente JOIN fa_parte JOIN gruppo ON (utente.email = fa_parte.email AND gruppo.idGruppo = fa_parte.idGruppo)
WHERE gruppo.idGruppo = 6;

-- Query 3: dato un utente ottenere tutte le sue notifiche
SELECT notifica.* FROM notifica JOIN riceve ON notifica.idNotifica = riceve.idNotifica
WHERE destinatario = "daniele.tramonti@studio.unibo.it";

-- Query 4: 

select * from utente where password like "ciao";
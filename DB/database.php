<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error) {
            die("connection failed: ".$this->db->connect_error);
        }
    }

    public function getGroupId() {return $this->db->insert_id;}

    public function getUsers() {
        $stmt = $this->db->prepare("SELECT nome, cognome from utente");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($email, $password) {
        $stmt = $this->db->prepare("SELECT email, nome, cognome, admin from utente where email = ? and password = ?");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGroups($email, $limit = null) {
        if($limit === null) {
            $stmt = $this->db->prepare("SELECT distinct gruppo.* FROM fa_parte JOIN gruppo ON gruppo.idGruppo = fa_parte.idGruppo 
                                        WHERE fa_parte.email = ?");
            $stmt->bind_param('s', $email);
        } else {
            $stmt = $this->db->prepare("SELECT distinct gruppo.* FROM fa_parte JOIN gruppo ON gruppo.idGruppo = fa_parte.idGruppo 
                                        WHERE fa_parte.email = ?
                                        ORDER BY gruppo.nome LIMIT ?,2");
            $stmt->bind_param('si', $email,$limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPartecipants($idGruppo) {
        $stmt = $this->db->prepare("SELECT utente.* FROM utente JOIN fa_parte JOIN gruppo ON (utente.email = fa_parte.email AND gruppo.idGruppo = fa_parte.idGruppo)
                                    WHERE gruppo.idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNumberOfPartecipants($idGruppo) {
        $result = $this->getPartecipants($idGruppo);
        return count($result);
    }

    public function addAdministratorToGroup($email, $idGruppo) {
        $stmt = $this->db->prepare("INSERT INTO fa_parte (email, idGruppo) VALUES (?, ?)");
        $stmt->bind_param('si', $email, $idGruppo);
        $result = $stmt->execute();
        return $result;
    }

    public function insertGroupFilters($idGruppo,$filters) {
        foreach($filters as $filter) {
            $stmt = $this->db->prepare("INSERT INTO possiede(idGruppo,nome) VALUE (?,?)");
            $stmt->bind_param('is', $idGruppo,$filter);
            $stmt->execute();
        }
    }

    public function createNewGroup($name, $course, $size, $isPrivate, $shortDesc, $longDesc,$filters) {
        $stmt = $this->db->prepare("INSERT INTO gruppo (nome, numero_partecipanti, descr_breve, descr_lunga, privato, corso_di_riferimento, creatore) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sississ', $name, $size, $shortDesc, $longDesc, $isPrivate, $course, $_SESSION['email']);
        $result = $stmt->execute();

        $id = $this->getGroupId();
        $this->addAdministratorToGroup($_SESSION['email'], $id);
        $filters[] = "ghost";
        $this->insertGroupFilters($id,$filters);

        $stmt = $this->db->prepare("INSERT INTO chat(idGruppo) value (?)");
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $result;
    }

    public function updateGroup($name, $size, $isPrivate, $shortDesc, $longDesc, $idGruppo) {
        $stmt = $this->db->prepare("UPDATE gruppo
                                    SET nome = ?, numero_partecipanti = ?, descr_breve = ?, descr_lunga = ?, privato = ?
                                    WHERE idGruppo = ?");
        $stmt->bind_param('sissisi', $name, $size, $shortDesc, $longDesc, $isPrivate, $course, $idGruppo);
        $result = $stmt->execute();

        return $result;
    }

    public function doesUserExist($email) {
        $stmt = $this->db->prepare("SELECT * FROM utente 
                                    WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertNewUser($name, $surname, $email, $phone, $password) {
        $stmt = $this->db->prepare("INSERT into utente(nome,cognome,email,telefono,password) 
                                    values (?,?,?,?,?)");
        $stmt->bind_param('sssis',$name,$surname,$email,$phone,$password);
        $stmt->execute();
        $result = $this->db->affected_rows;

        return $result;
    }

    public function getAllFilters() {
        $stmt = $this->db->prepare("SELECT * FROM tag where nome <> 'ghost'");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllCourses() {
        $stmt = $this->db->prepare("SELECT * FROM corso");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function removeUserFromGroup($email, $idGruppo) {
        $stmt = $this->db->prepare("DELETE FROM fa_parte WHERE email = ? AND idGruppo = ?");
        $stmt->bind_param('si', $email, $idGruppo);
        $result = $stmt->execute();
        return $result;
    }

    public function addUserToGroup($email, $idGruppo) {
        $stmt = $this->db->prepare("INSERT INTO fa_parte (email, idGruppo) VALUES (?, ?)");
        $stmt->bind_param('si', $email, $idGruppo);
        $result = $stmt->execute();
        return $result;
    }

    public function isGroupPrivate($idGruppo) {
        $stmt = $this->db->prepare("SELECT privato FROM gruppo WHERE idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        $firstRow = $result->fetch_assoc();  /*prende solo la prima riga*/
        return $firstRow['privato'];
    }

    public function searchNameWithUser($name,$limit = null) {
        $name = "%".$name."%";
        if($limit === null) {
            $stmt = $this->db->prepare("SELECT * FROM gruppo WHERE nome LIKE ? AND idGruppo IN (SELECT idGruppo FROM fa_parte WHERE email = ?)");
            $stmt->bind_param('ss',$name,$_SESSION['email']);
        } else {
           $stmt = $this->db->prepare("SELECT * FROM gruppo WHERE nome LIKE ? AND idGruppo IN (SELECT idGruppo FROM fa_parte WHERE email = ?) ORDER BY nome LIMIT ?,2");
            $stmt->bind_param('ssi',$name,$_SESSION['email'],$limit); 
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function groupsWithNoUserInSession($limit = null) {
        if($limit === null) {
            $stmt = $this->db->prepare("SELECT * FROM gruppo WHERE idGruppo NOT IN (SELECT idGruppo FROM fa_parte WHERE email = ?)");
            $stmt->bind_param('s', $_SESSION['email']);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM gruppo WHERE idGruppo NOT IN (SELECT idGruppo FROM fa_parte WHERE email = ?) ORDER BY nome LIMIT ?,2");
            $stmt->bind_param('si', $_SESSION['email'],$limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchByFilters($filters, $name, $email, $course, $limit = null) {
        $first = true;
        $name = "%".$name."%";
        $query = "SELECT gruppo.* FROM gruppo JOIN possiede ON gruppo.idGruppo = possiede.idGruppo WHERE ";
        $query .= "gruppo.nome LIKE ? AND gruppo.corso_di_riferimento = ? AND (";
        foreach($filters as $filter) {
            if($first) {
                $query .= " possiede.nome = \"".$filter."\"";
                $first = false;
            } else {
                $query.= " OR possiede.nome = \"".$filter."\"";
            }
        }
        $query .= ") GROUP BY gruppo.idGruppo, possiede.idGruppo HAVING gruppo.idGruppo NOT IN (SELECT idGruppo from fa_parte where email = ? )ORDER BY count(gruppo.idGruppo) DESC";
        if($limit === null) {
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sss', $name, $course, $email);
        } else {
            $query .= " LIMIT ?,2";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('sssi', $name, $course, $email, $limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchNameAndCourse($name, $course, $limit = null) {
        $name = "%".$name."%";
        if($limit === null) {
            $stmt = $this->db->prepare("SELECT * FROM gruppo WHERE nome LIKE ? AND corso_di_riferimento = ? AND idGruppo NOT IN (SELECT idGruppo FROM fa_parte WHERE email = ?)");
            $stmt->bind_param('sss',$name,$course,$_SESSION['email']);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM gruppo WHERE nome LIKE ? AND corso_di_riferimento = ? AND idGruppo NOT IN (SELECT idGruppo FROM fa_parte WHERE email = ?) ORDER BY nome LIMIT ?,2");
            $stmt->bind_param('sssi',$name,$course,$_SESSION['email'], $limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkAdministrator($idGruppo) {
        $stmt = $this->db->prepare("SELECT idGruppo FROM gruppo WHERE idGruppo = ? AND creatore = ?");
        $stmt->bind_param('is', $idGruppo, $_SESSION['email']);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function getGroupName($idGruppo) {
        $stmt = $this->db->prepare("SELECT nome FROM gruppo WHERE idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result(); /*questo restituisce un oggetto mysqli non un tipo di oggetto scrivibile*/

        $row = $result->fetch_assoc(); /*prende solo la prima riga del risultato*/

        return $row["nome"];
    }

    public function getGroupShortDescription($idGruppo) {
        $stmt = $this->db->prepare("SELECT descr_breve FROM gruppo WHERE idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result(); /*questo restituisce un oggetto mysqli non un tipo di oggetto scrivibile*/

        $row = $result->fetch_assoc(); /*prende solo la prima riga del risultato*/

        return $row["descr_breve"];
    }

    public function getGroupLongDescription($idGruppo) {
        $stmt = $this->db->prepare("SELECT descr_lunga FROM gruppo WHERE idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result(); /*questo restituisce un oggetto mysqli non un tipo di oggetto scrivibile*/

        $row = $result->fetch_assoc(); /*prende solo la prima riga del risultato*/

        return $row["descr_lunga"];
    }

    public function getGroupTags($idGruppo) {
        $stmt = $this->db->prepare("SELECT *
                                    FROM possiede 
                                    WHERE idGruppo = ?
                                    AND nome <> 'ghost'");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGroupMaxPartecipants($idGruppo) {
        $stmt = $this->db->prepare("SELECT numero_partecipanti
                                    FROM gruppo
                                    WHERE idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row['numero_partecipanti'];
    }

    public function deleteUserFromGroup($email, $idGruppo) {
        $stmt = $this->db->prepare("DELETE FROM fa_parte
                                    WHERE email = ? AND idGruppo = ?");
        $stmt->bind_param('si', $email, $idGruppo);
        $result = $stmt->execute();

        return $result; 
    }

    public function updateGroupName($name, $idGruppo) {
        $stmt = $this->db->prepare("UPDATE gruppo
                                    SET nome = ?
                                    WHERE idGruppo = ?");
        $stmt->bind_param('si', $name, $idGruppo);
        $result = $stmt->execute();

        return $result;
    }

    public function updateGroupLongDescription($descr, $idGruppo) {
        $stmt = $this->db->prepare("UPDATE gruppo
                                    SET descr_lunga = ?
                                    WHERE idGruppo = ?");
        $stmt->bind_param('si', $descr, $idGruppo);
        $result = $stmt->execute();

        return $result;
    }

    public function updateGroupShortDescription($descr, $idGruppo) {
        $stmt = $this->db->prepare("UPDATE gruppo
                                    SET descr_breve = ?
                                    WHERE idGruppo = ?");
        $stmt->bind_param('si', $descr, $idGruppo);
        $result = $stmt->execute();

        return $result;
    }

    public function getAllNotifications($email) {
        $stmt = $this->db->prepare("(SELECT n.*, g.idGruppo, g.nome AS nomeGruppo
                                        FROM notifica n
                                        JOIN riceve r ON n.idNotifica = r.idNotifica 
                                        LEFT JOIN notifica_in_gruppo nig ON n.idNotifica = nig.idNotifica
                                        LEFT JOIN gruppo g ON nig.idGruppo = g.idGruppo
                                        WHERE r.destinatario = ?
									    and nig.idGruppo is not null)
                                    UNION (SELECT n.*, g.idGruppo, g.nome AS nomeGruppo
                                            from notifica n join messaggio m on n.idNotifica = m.idNotifica
                                            LEFT JOIN chat on chat.idChat = m.idChat
                                            LEFT join gruppo g on chat.idGruppo = g.idGruppo
                                            LEFT join riceve r ON n.idNotifica = r.idNotifica 
                                            WHERE r.destinatario = ?)
                                    ORDER BY DATA DESC");
        $stmt->bind_param('ss',$email,$email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkGroupPartecipants($idGruppo) {
        $stmt = $this->db->prepare("SELECT *
                                    FROM fa_parte
                                    WHERE idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows <= 0) {
            $result = $this->deleteGroup($idGruppo);
            return 1;
        } else {
            return 0;
        }
    }

    public function deleteGroup($idGruppo) {
        $stmt = $this->db->prepare("DELETE FROM gruppo
                                    WHERE idGruppo = ?");
        $stmt->bind_param('i', $idGruppo);
        $result = $stmt->execute();

        return $result;
    }

    public function isUserInGroup($email, $idGruppo) {
        $stmt = $this->db->prepare("SELECT *
                                    FROM fa_parte
                                    WHERE email = ? AND idGruppo = ?");
        $stmt->bind_param('si', $email, $idGruppo);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    /*$receivers è un array di email, tutti quelli che devono ricevere il messaggio*/ 
    public function sendMessage($sender,$text,$object,$type,$receivers) {
        $stmt = $this->db->prepare("INSERT INTO notifica(mittente,testo,oggetto,tipo,data) VALUES (?,?,?,?,NOW())");
        $stmt->bind_param('ssss',$sender,$text,$object,$type);
        $stmt->execute();
        $id = $this->db->insert_id;

        foreach($receivers as $receiver) {
            if($receiver != $sender) {
                $stmt = $this->db->prepare("INSERT INTO riceve(destinatario,idNotifica) VALUES (?,?)");
                $stmt->bind_param('si',$receiver,$id);
                $stmt->execute();
            }
        }
        return $id;
    }

    public function sendRequest($sender,$text,$object,$type,$receivers,$idGruppo) {
        $idNotifica = $this->sendMessage($sender,$text,$object,$type,$receivers);
        $stmt = $this->db->prepare("INSERT INTO notifica_in_gruppo(idGruppo, idNotifica) VALUES (?,?)");
        $stmt->bind_param('ii', $idGruppo, $idNotifica);
        return $stmt->execute();
    }

    public function markAsRead($notification,$email) {
        $stmt = $this->db->prepare("UPDATE riceve SET visto = true WHERE idNotifica = ? AND destinatario = ?");
        $stmt->bind_param("is",$notification,$email);
        $stmt->execute();
        $result = $this->db->affected_rows;

        return $result;
    }

    public function getGroupMessages($groupId) {
        $stmt = $this->db->prepare("SELECT notifica.* 
                                    from notifica join messaggio join chat on notifica.idNotifica = messaggio.idNotifica and messaggio.idChat = chat.idChat
                                    where chat.idGruppo = ?");
        $stmt->bind_param('i',$groupId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteNotification($idNotifica) {
        $stmt = $this->db->prepare("DELETE FROM notifica WHERE idNotifica = ?");
        $stmt->bind_param('i', $idNotifica);
        return $stmt->execute();
    }

    public function getGroupChatId($groupId) {
        $stmt = $this->db->prepare("SELECT idChat from CHAT where idGruppo = ?");
        $stmt->bind_param("i",$groupId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc(); 

        return $row["idChat"];
    }

    public function newMessageInChat($sender,$text,$groupId) {
        $persons = $this->getPartecipants($groupId);
        $emails = array();
        foreach($persons as $person) {
            $emails[] = $person['email'];
        }
        $id = $this->sendMessage($sender,$text,"New message","messaggio",$emails);

        $stmt = $this->db->prepare("INSERT INTO messaggio(idNotifica,idChat) VALUES (?,?)");
        $stmt->bind_param("ii",$id,$groupId);
        $stmt->execute(); 
    }

    public function getAdmins() {
        $stmt = $this->db->prepare("SELECT email
                                    FROM utente
                                    WHERE admin = true");
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return array_column($rows, 'email');
    }

    public function getAllReports($limit = null) {
        if($limit === null) {
            $stmt = $this->db->prepare("SELECT * from notifica where tipo = 'segnalazione'");
        } else {
            $stmt = $this->db->prepare("SELECT * from notifica where tipo = 'segnalazione' ORDER BY data LIMIT ?,2");
            $stmt->bind_param('i',$limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function searchReports($string, $limit = null) {
        $string = "%".$string."%";
        if($limit === null) {
            $stmt = $this->db->prepare("SELECT * from notifica where tipo = 'segnalazione' and oggetto like ?");
            $stmt->bind_param('s',$string);
        } else {
            $stmt = $this->db->prepare("SELECT * from notifica where tipo = 'segnalazione' and oggetto like ? ORDER BY data LIMIT ?,2");
            $stmt->bind_param('si',$string,$limit);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificationObject($idNotifica) {
        $stmt = $this->db->prepare("SELECT oggetto
                                    FROM notifica 
                                    WHERE idNotifica = ?");
        $stmt->bind_param("i", $idNotifica);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['oggetto'];
    }

    public function getNotificationText($idNotifica) {
        $stmt = $this->db->prepare("SELECT testo
                                    FROM notifica 
                                    WHERE idNotifica = ?");
        $stmt->bind_param("i", $idNotifica);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['testo'];
    }

    public function getNumberOfUserGroups($email) {
        return count($this->getGroups($email));
    }

    public function addCourse($nome) {
        $stmt = $this->db->prepare("INSERT INTO corso(nome) VALUES (?)");
        $stmt->bind_param('s', $nome);
        return $stmt->execute();
    }

    public function deleteCourse($nome) {
        $stmt = $this->db->prepare("DELETE FROM corso WHERE nome = ?");
        $stmt->bind_param('s', $nome);
        return $stmt->execute();
    }
} 
?>
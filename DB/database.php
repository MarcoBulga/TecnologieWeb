<?php
class DatabaseHelper {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if($this->db->connect_error) {
            die("connection failed: ".$this->db->connect_error);
        }
    }

    public function getUsers() {
        $stmt = $this->db->prepare("SELECT nome, cognome from utente");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function checkLogin($email, $password) {
        $stmt = $this->db->prepare("SELECT email, nome, cognome from utente where email = ? and password = ?");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getGroups($email) {
       $stmt = $this->db->prepare("SELECT distinct gruppo.* FROM fa_parte JOIN gruppo ON gruppo.idGruppo = fa_parte.idGruppo 
                                    WHERE fa_parte.email = ?");
        $stmt->bind_param('s', $email);
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

    public function createNewGroup($name, $course, $size, $isPrivate, $shortDesc, $longDesc) {
        $stmt = $this->db->prepare("INSERT INTO gruppo (nome, numero_partecipanti, descr_breve, descr_lunga, privato, corso_di_riferimento, creatore) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sississ', $name, $size, $shortDesc, $longDesc, $isPrivate, $course, $_SESSION['email']);
        $result = $stmt->execute();
        return $result;
    }

    public function addAdministratorToGroup($email, $idGruppo) {
        $stmt = $this->db->prepare("INSERT INTO fa_parte (email, idGruppo) VALUES (?, ?)");
        $stmt->bind_param('si', $email, $idGruppo);
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
        $stmt = $this->db->prepare("SELECT * FROM tag");
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

    public function getGroupId() {return $this->db->insert_id;}

    public function removeUserFromGroup($email, $idGruppo) {
        $stmt = $this->db->prepare("DELETE FROM fa_parte WHERE email = ? AND idGruppo = ?");
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
} 
?>
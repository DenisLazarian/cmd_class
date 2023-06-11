<?php 

namespace App\Models;

class Mdl_mail
{

    private $db;

    public function __construct()
    {
        // Create connection
        $this->db = new \mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        // Check connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        } 
    }

    public function __destruct()
    {
        if ($this->db != null)
            $this->db->close();
    }

    public function getAllMails($user_id)
    {
        $sql = "SELECT * FROM mensajes where destinatario_id =". $user_id;
        $sql .= " OR propietario_id =". $user_id ." ORDER BY fecha DESC";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // $res = $result->fetch_assoc();
            $res = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $res = null;
        }
        return $res;
    }

    public function getMail($id){
        $stmt = $this->db->prepare("SELECT * FROM mails WHERE id = ?");
        $stmt->bind_param("i", 
            $id
        );

        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
            $res = $result->fetch_assoc();
        else
            $res = null;
        
        $stmt->close();
        // $this->db->close();
        return $res;
    }

    function saveMail($mail){
        $visto = 0;
        $stmt = $this->db->prepare("INSERT INTO mensajes (propietario_id, destinatario_id, asunto, cuerpo, visto, fecha) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", 
            $mail['propietario_id'],
            $mail['destinatario_id'],
            $mail['asunto'],
            $mail['mensaje'],
            $visto,
        );

        $stmt->execute();
        $stmt->close();
        // $this->db->close();
    }

    function deleteMail($id){
        $stmt = $this->db->prepare("DELETE FROM mensajes WHERE id = ?");
        $stmt->bind_param("i", 
            $id
        );

        $stmt->execute();
        $stmt->close();
        $this->db->close();
    }

    function updateMail($mail){
        $stmt = $this->db->prepare("UPDATE mensajes SET name = ?, mail = ?, subject = ?, message = ? WHERE
        id = ?");
        $stmt->bind_param("ssssi", 
            $mail['name'],
            $mail['mail'],
            $mail['subject'],
            $mail['message'],
            $mail['id']
        );

    }

    function getMailById($id){
        $query = "SELECT * FROM mensajes WHERE id = $id";
        $result = $this->db->query($query);
        
        if($result->num_rows > 0)
            $res = $result->fetch_assoc();
        else
            $res = null;
        

        if($res['destinatario_id'] === $_SESSION['user']['id']){ // si el destinatario lo ve, se marca como visto
            $queryUpdate = "UPDATE mensajes SET visto = 1 WHERE id = ". $id ;
            $this->db->query($queryUpdate);
        }

        return $res;
    }

    function resend_mail($mail){
        $visto = 0;
        $stmt = $this->db->prepare("INSERT INTO mensajes (propietario_id, destinatario_id, asunto, cuerpo, visto, Referencia , type, fecha) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", 
            $mail['propietario_id'],
            $mail['destinatario_id'],
            $mail['asunto'],
            $mail['mensaje'],
            $mail['referencia'],
            $mail['type'],
            $visto,
        );

        $stmt->execute();
        $stmt->close();
        // $this->db->close();
    }
}
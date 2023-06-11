<?php
namespace App\Models;


class Mdl_users
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

    public function getAllGuests()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            // $res = $result->fetch_assoc();
            $res = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $res = null;
        }
        return $res;
    }

    public function getUserById($id){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
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
        return $res;
    }

    public function getUser($name){
        $stmt = $this->db->prepare("SELECT * FROM users WHERE mail = ?");
        $stmt->bind_param("s", 
            $name
        );

        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0)
            $res = $result->fetch_assoc();
        else
            $res = null;
        
        $stmt->close();
        return $res;
    }

    function saveUser($user){

        $ifExistMail = $this->getUser($user['mail']);

        if($ifExistMail != null){
            die("El usuario ya existe");
        }

        $stmt = $this->db->prepare("INSERT INTO users (mail, contraseña, nombre, apellido) VALUES (?, ?, ?, ?)");
    
        $stmt->bind_param("ssss", 
            $user["mail"],
            $user["password"],
            $user["nombre"],
            $user["apellidos"]
        );

        $stmt->execute();
        $this->db->close();
    }

}

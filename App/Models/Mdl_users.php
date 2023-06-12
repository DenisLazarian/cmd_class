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

    public function update($id, $user){
        
        if(isset($user['password']) && !empty($user['password'])){
            $stmt = $this->db->prepare("UPDATE users SET mail = ?, contraseña = ?, nombre = ?, apellido = ?, nivel = ?, edat = ? WHERE id = ?");
            $stmt->bind_param("ssssiii", 
                $user["mail"],
                $user["password"],
                $user["nombre"],
                $user["apellidos"],
                $user["nivel"],
                $user["edad"],
                $id
            );
        }else{
            $stmt = $this->db->prepare("UPDATE users SET mail = ?, nombre = ?, apellido = ?, nivel = ?, edat = ? WHERE id = ?");
            $stmt->bind_param("sssiii", 
                $user["mail"],
                $user["nombre"],
                $user["apellidos"],
                $user["nivel"],
                $user["edad"],
                $id
            );
        }

        $stmt->execute();
        $stmt->close();
        // $this->db->close();
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

        $stmt = $this->db->prepare("INSERT INTO users (mail, contraseña, nombre, apellido, nivel, edat) VALUES (?, ?, ?, ?, ?, ?)");
    
        $stmt->bind_param("ssssii", 
            $user["mail"],
            $user["password"],
            $user["nombre"],
            $user["apellidos"],
            $user["nivel"],
            $user["edad"]
        );

        $stmt->execute();
        $this->db->close();
    }

    public function delete_user($id){
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", 
            $id
        );

        $stmt->execute();
        $stmt->close();
        // $this->db->close();
    }

}

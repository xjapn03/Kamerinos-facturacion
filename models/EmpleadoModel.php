<?php

class EmpleadoModel {
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $id_rol;
    private $nombre_rol;
    private $pdo;

    public function __construct()
    {
    	try {
    		$this->pdo = new Database;
	    } catch (PDOException $e) {
	    	die($e->getMessage());
	    }    
    }


// Método para obtener todos los empleados
public function getAll()
{
    try {    		
        $strSql = "SELECT empleados.nombre, empleados.email, roles.nombre_rol as nombre_rol
                    FROM empleados
                    INNER JOIN roles ON empleados.id_rol = roles.id_rol";
        
        $stmt = $this->pdo->query($strSql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como array asociativo
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}


    // Método para verificar el login de un empleado
    public function validacion($data)
    {
        try {            
            $strSql = "SELECT * FROM empleados
                        INNER JOIN roles ON empleados.id_rol=roles.id_rol
                        WHERE email='".$data['email']."' AND password='".md5($data['password'])."'";
            //$user= $this->pdo->select($strSql);
            //$LoginId=$user[0]->idUsers;
            //$Login=1;
            //$array = json_decode(json_encode($user), true);
            //echo ($strSql);
            //print_r ($array[0]);
            //print_r($_SESSION);
            //die();
            return $this->pdo->select($strSql);

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para obtener un empleado por ID
    public function getById($id)
    {
        try {            
            $strSql = "SELECT * FROM empleados WHERE id_empleado = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para registrar un nuevo empleado
    public function newUser($data)
    {   
        try {
            $data['password'] = md5($data['password']);
            $sql = "INSERT INTO empleados (nombre, apellido, email, password, id_rol) VALUES (:nombre, :apellido, :email, :password, :id_rol)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'email' => $data['email'],
                'password' => $data['password'],
                'id_rol' => $data['id_rol']
            ]);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    // Método para editar un empleado
    public function editUser($data)
    {
        try {      
            $strSql = "UPDATE empleados SET nombre = :nombre, apellido = :apellido, email = :email, id_rol = :id_rol WHERE id_empleado = :id_empleado";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'email' => $data['email'],
                'id_rol' => $data['id_rol'],
                'id_empleado' => $data['id_empleado']
            ]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }

    // Método para eliminar un empleado
    public function deleteUser($id)
    {
        try {            
            $strSql = "DELETE FROM empleados WHERE id_empleado = :id";
            $stmt = $this->pdo->prepare($strSql);
            $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            die($e->getMessage());
        }    
    }
}
?>
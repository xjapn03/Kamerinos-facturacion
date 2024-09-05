<?php 
class Database extends PDO 
{
    // Definición de Atributos de la Clase
    private $driver     = 'mysql';
    private $host       = 'localhost';    
    private $dbName     = 'sandra1';
    private $charset    = 'utf8';
    private $user       = 'root';
    private $password   = '';

    public function __construct()
    {
        try {                    
            parent::__construct("{$this->driver}:host={$this->host};dbname={$this->dbName};charset={$this->charset}", $this->user, $this->password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Conexión Fallida: {$e->getMessage()}";
        }
    }

    // Método para realizar consultas a la BD
    public function select($strSql, $arrayData = array(), $fetchMode = PDO::FETCH_OBJ)
    {
        try {
            $query = $this->prepare($strSql);

            foreach ($arrayData as $key => $value) 
                $query->bindValue(":$key", $value);
            
            if (!$query->execute()) {
                echo "Error, la consulta no se realizó";
            } else {
                return $query->fetchAll($fetchMode);
            }
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    // Método para realizar las inserciones en la BD
    public function insert($table, $data)
    {
        try {
            // Ordenar array por key
            ksort($data);
            // Obtener nombre de los campos
            $fieldNames = implode('`, `', array_keys($data));
            // Obtener los valores
            $fieldValues = ':' . implode(', :', array_keys($data));
            // String de la sentencia
            $strSql = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
            // Asignación de parámetros a la sentencia
            foreach ($data as $key => $value) {
                $strSql->bindValue(":$key", $value);
            }
            // Ejecución de la sentencia SQL
            $strSql->execute();
        } catch (PDOException $e) {
            die("Error al insertar: " . $e->getMessage());
        }
    }
    public function update($table, $data, $where)
    {
        try {
            // Ordenar array por key
            ksort($data);
            $fieldDetails = '';
            foreach ($data as $key => $value) {
                $fieldDetails .= "`$key` = :$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');
            $query = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
            foreach ($data as $key => $value) {
                $query->bindValue(":$key", $value);
            }
            $query->execute();
        } catch (PDOException $e) {
            die("Error al actualizar: " . $e->getMessage());
        }    
    }
    public function delete($table, $where)
    {
        try {            
            return $this->exec("DELETE FROM $table WHERE $where");
        } catch (PDOException $e) {
            die("Error al eliminar: " . $e->getMessage());
        }    
    }
}
//$db = new Database();
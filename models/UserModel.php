<?php
class UserModel {

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getUsers() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error al obtener usuarios: ' . $e->getMessage());
        }
    }

    public function getUserById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM users WHERE user_id = ?");
            $statement->execute([$id]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener usuarios: ' . $e->getMessage());
            return false;
        }
    }

    public function addUser($name, $surname, $email, $password, $role) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users (name, surname, email, password, role) VALUES (?, ?, ?, ?, ?)");
            return $stmt->execute([$name, $surname, $email, $password, $role]);
        } catch (PDOException $e){
            error_log('Error al agregar usuario: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateUser($user_id, $name, $surname, $email, $role)
    {
        try {
                $stmt = $this->connection->prepare("UPDATE users SET name = ?, surname = ?, email = ?, role = ? WHERE user_id = ?");
                return $stmt->execute([$name, $surname, $email, $role, $user_id]);
        } catch (PDOException $e) {
            error_log('Error al actualizar el usuario: ' . $e->getMessage());
            throw $e;
        }
    }



    public function deleteUser($user_id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM users WHERE user_id = ?");
            return $statement->execute([$user_id]);
        } catch (PDOException $e) {
            error_log('Error al borrar usuario: ' . $e->getMessage());
            throw $e;
        }
    }

}


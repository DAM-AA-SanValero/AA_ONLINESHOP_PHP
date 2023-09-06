<?php

include '../models/connection/Connection.php';
include '../models/UserModel.php';

class UserController {

    private $userModel;

    public function __construct() {
        $connection = new Connection();
        $pdo = $connection->connect();
        $this->userModel = new UserModel($pdo);
    }

    public function getUsers() {
        $users = $this->userModel->getUsers();
        include 'views/users/UserView.php';
    }

    public function addUser($name, $surname, $email, $password, $role){
        try {
            return $this->userModel->addUser($name, $surname, $email, $password, $role);
        } catch (Exception $e) {
            error_log('Error al agregar el usuario en el controlador: ' . $e->getMessage());
            return false;
        }
    }

    public function updateUser($user_id, $name, $surname, $email, $role)
    {
        try {
            return $this->userModel->updateUser($user_id, $name, $surname, $email, $role);
        } catch (Exception $e) {
            error_log('Error al actualizar el usuario en el controlador: ' . $e->getMessage());
            return false;
        }
    }


    public function deleteUser($user_id) {
        try {
            return $this->userModel->deleteUser($user_id);
        } catch (Exception $e) {
            error_log('Error al borrar venta en el controlador: ' . $e->getMessage());
            return false;
        }
    }
}

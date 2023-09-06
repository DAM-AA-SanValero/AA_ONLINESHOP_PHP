<?php

include '../models/connection/Connection.php';
include '../models/LoginModel.php';

class LoginController{

   private $connection;

    public function __construct()
    {
        session_start();
        $connection = new Connection();
        $this->connection = $connection->connect();
    }

    public function loginUser(){
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $login = new LoginModel($this->connection, $_POST['email'], $_POST['password']);
            return $login->login();
        } else {
            return "Form data uncompleted";
        }
    }
}

$loginController = new LoginController();
$result = $loginController->loginUser();

if ($result) {
    header('Location: /aa_onlineshop/views/MainMenuView.php');
} else {
    header('Location: /aa_onlineshop/index.php');
}

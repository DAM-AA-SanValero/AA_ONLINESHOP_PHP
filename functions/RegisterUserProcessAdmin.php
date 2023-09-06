<?php
include '../controllers/UserController.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'administrator';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['surname'])
        && isset($_POST['email']) && isset($_POST['password'])) {

        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        try {
            $userController = new UserController();
            $result = $userController->addUser($_POST['name'], $_POST['surname'],
                $_POST['email'], $hashed_password, $_POST['role']);

            if ($result) {
                echo "Registro exitoso";
                {
                    header('Location: ../views/users/UserView.php');
                }
            } else {
                echo "Error al registrarse";
                header('Location: /aa_onlineshop/views/users/RegisterUserView.php');
            }


        } catch
        (Exception $e) {
            header('Location: ../views/users/RegisterUserView.php?error=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header('Location: ../views/users/RegisterUserView.php');
        exit();
    }
}
<?php
include '../controllers/UserController.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['user_id'])) {

        $user_id = $_POST['user_id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        try {
            $userController = new UserController();
            $result = $userController->updateUser($user_id, $name, $surname, $email, $role);

            if ($result) {
                header("Location: ../views/users/UserView.php");
                exit();
            } else {
                echo "Error al actualizar el usuario.";
            }

        } catch (Exception $e) {
            header('Location: ../views/sales/UpdateSaleView.php?error=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        echo "Todos los campos son requeridos.";
    }
} else {
    echo "No se recibieron datos de formulario.";
}
?>

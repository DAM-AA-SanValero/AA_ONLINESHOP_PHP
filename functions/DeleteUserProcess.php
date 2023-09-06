<?php
include '../controllers/UserController.php';

try {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $controller = new UserController();

        if ($controller->deleteUser($id)) {
            header("Location: ../views/users/UserView.php");
            exit();
        } else {
            echo "Error al eliminar el usuario.";
        }
    } else {
        echo "ID no proporcionado.";
    }
} catch (Exception $e) {
    error_log("Un error ocurrió en el proceso de eliminación: " . $e->getMessage());
    echo "Ocurrió un error al tratar de eliminar la categoría. Por favor, inténtelo de nuevo más tarde.";
}


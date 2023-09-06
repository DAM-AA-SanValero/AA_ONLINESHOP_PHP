<?php
include '../controllers/CategoryController.php';

try {
    if (isset($_POST['name']) && isset($_POST['description'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];

        $controller = new CategoryController();

        if ($controller->addCategory($name, $description)) {
            header("Location: ../views/categories/CategoryView.php");
            exit();
        } else {
            echo "Error al registrar la categoría.";
        }
    } else {
        echo "Todos los campos son requeridos.";
    }
} catch (Exception $e) {
    error_log("Un error ocurrió en el proceso de registro: " . $e->getMessage());
    echo "Ocurrió un error al tratar de registrar la categoría. Por favor, inténtelo de nuevo más tarde.";
}
?>

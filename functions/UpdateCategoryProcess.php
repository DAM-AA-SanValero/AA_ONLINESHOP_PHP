<?php
include '../controllers/CategoryController.php';

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['category_id'])) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];

            $controller = new CategoryController();
            $result = $controller->updateCategory($category_id, $name, $description);

            if ($result) {
                header("Location: ../views/categories/CategoryView.php");
                exit();
            } else {
                echo "Error al actualizar la categoría.";
            }
        } else {
            echo "Todos los campos son requeridos.";
        }
    } else {
        echo "No se recibieron datos de formulario.";
    }
} catch (Exception $e) {
    error_log("Un error ocurrió en el proceso de actualización: " . $e->getMessage());
    echo "Ocurrió un error al tratar de actualizar la categoría. Por favor, inténtelo de nuevo más tarde.";
}
?>



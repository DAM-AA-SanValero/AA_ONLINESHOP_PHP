<?php
include '../controllers/CategoryController.php';

try {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $controller = new CategoryController();

        if ($controller->deleteCategory($id)) {
            header("Location: ../views/categories/CategoryView.php");
            exit();
        } else {
            echo "Error al eliminar la categoría.";
        }
    } else {
        echo "ID no proporcionado.";
    }
} catch (Exception $e) {
    error_log("Un error ocurrió en el proceso de eliminación: " . $e->getMessage());
    echo "Ocurrió un error al tratar de eliminar la categoría. Por favor, inténtelo de nuevo más tarde.";
}
?>

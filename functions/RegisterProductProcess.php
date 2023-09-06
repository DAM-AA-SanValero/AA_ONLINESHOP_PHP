<?php
include '../controllers/ProductController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && is_numeric($_POST['price'])) {

        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $register_date = $_POST['register_date'];

        $stock = isset($_POST['stock']) && $_POST['stock'] == 'yes' ? 1 : 0;


        try {
            $productController = new ProductController();
            $result = $productController->addProduct($name, $category_id, $description, $price, $register_date, $stock);

            if ($result) {
                header('Location: ../views/products/ProductView.php');
                exit();
            } else {
                // Aquí podrías redirigir al formulario con un mensaje de error
                header('Location: ../views/products/RegisterProductView.php?error=Error al registrar el producto');
                exit();
            }
        } catch (Exception $e) {
            // Aquí podrías redirigir al formulario con un mensaje de error más específico
            header('Location: ../views/products/RegisterProductView.php?error=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header('Location: ../views/products/RegisterProductView.php?error=Todos los campos son requeridos.');
        exit();
    }
}
?>


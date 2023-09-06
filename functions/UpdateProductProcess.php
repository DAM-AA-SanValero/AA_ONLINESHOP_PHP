<?php
include '../controllers/ProductController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['product_id']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price'])
        && is_numeric($_POST['price']) && !empty($_POST['category_id'])) {

        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $register_date = $_POST['register_date'];
        $stock = isset($_POST['stock']) ? 1 : 0;
        $category_id = $_POST['category_id'];

        try {
            $productController = new ProductController();
            $result = $productController->updateProduct($product_id, $name, $description, $price, $register_date, $stock, $category_id); // Modificado para incluir category_id

            if ($result) {
                header('Location: ../views/products/ProductView.php');
                exit();
            } else {
                header('Location: ../views/products/UpdateProductView.php?error=Error al actualizar el producto');
                exit();
            }
        } catch (Exception $e) {
            header('Location: ../views/products/UpdateProductView.php?error=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header('Location: ../views/products/UpdateProductView.php?error=Todos los campos son requeridos.');
        exit();
    }
}

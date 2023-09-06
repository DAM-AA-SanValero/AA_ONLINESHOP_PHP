<?php
include '../controllers/SaleController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['user_id']) && !empty($_POST['product_id']) && !empty($_POST['sale_id'])
        && is_numeric($_POST['amount'])) {

        $sale_id = $_POST['sale_id'];
        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $sale_date = $_POST['sale_date'];
        $amount = $_POST['amount'];


        try {
            $saleController = new SaleController();
            $result = $saleController->updateSale($sale_id, $user_id, $product_id, $sale_date, $amount);

            if ($result) {
                header('Location: ../views/sales/SaleView.php');
                exit();
            } else {
                header('Location: ../views/sales/UpdateSaleView.php?error=Error al actualizar el producto');
                exit();
            }
        } catch (Exception $e) {
            header('Location: ../views/sales/UpdateSaleView.php?error=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header('Location: ../views/sales/UpdateSaleView.php?error=Todos los campos son requeridos.');
        exit();
    }
}

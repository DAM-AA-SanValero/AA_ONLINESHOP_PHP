<?php
include '../controllers/SaleController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['sale_date']) && is_numeric($_POST['amount'])) {

        $user_id = $_POST['user_id'];
        $product_id = $_POST['product_id'];
        $sale_date = $_POST['sale_date'];
        $amount = $_POST['amount'];

        try {
            $saleController = new SaleController();
            $result = $saleController->addSale($user_id, $product_id, $sale_date, $amount);

            if ($result) {
                header('Location: ../views/sales/SaleView.php');
                exit();
            } else {
                header('Location: ../views/sales/RegisterSaleView.php?error=Error al registrar el producto');
                exit();
            }
        } catch (Exception $e) {
            header('Location: ../views/sales/RegisterSaleView.php?error=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        header('Location: ../views/sales/RegisterSaleView.php');
        exit();
    }
}
?>

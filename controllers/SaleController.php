<?php
include '../models/connection/Connection.php';
include '../models/SaleModel.php';

class SaleController{

    private $saleModel;

    public function __construct() {
        $connection = new Connection();
        $pdo = $connection->connect();
        $this->saleModel = new SaleModel($pdo);
    }

    public function getSaleById($id) {
        try {
            return $this->saleModel->getSalesById($id);
        } catch (Exception $e) {
            error_log('Error al obtener producto: ' . $e->getMessage());
            throw $e;
        }
    }


    public function addSale($user_id, $product_id, $sale_date, $amount) {
        try {
            return $this->saleModel->addSale($user_id, $product_id, $sale_date, $amount);
        } catch (Exception $e) {
            error_log('Error al agregar venta en el controlador: ' . $e->getMessage());
            return false;
        }
    }

    public function updateSale($sale_id, $user_id,  $product_id,  $sale_date, $amount) {
        try {
            return $this->saleModel->updateSale($sale_id, $user_id,  $product_id,  $sale_date, $amount);
        } catch (Exception $e) {
            error_log('Error al actualizar venta en el controlador: ' . $e->getMessage());
            return false;
        }
    }


    public function deleteSale($sale_id) {
        try {
            return $this->saleModel->deleteSale($sale_id);
        } catch (Exception $e) {
            error_log('Error al borrar venta en el controlador: ' . $e->getMessage());
            return false;
        }
    }
}

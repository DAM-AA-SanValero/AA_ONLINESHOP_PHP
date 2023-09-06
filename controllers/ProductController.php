<?php
include '../models/connection/Connection.php';
include '../models/ProductModel.php';
class ProductController{

    private $productModel;

    public function __construct() {
        $connection = new Connection();
        $pdo = $connection->connect();
        $this->productModel = new ProductModel($pdo);
    }

    public function getProductById($id) {
        try {
            return $this->productModel->getProductById($id);
        } catch (Exception $e) {
            error_log('Error al obtener producto: ' . $e->getMessage());
            throw $e;
        }
    }


    public function addProduct($name,$category_id, $description, $price, $register_date, $stock) {
        try {
            return $this->productModel->addProduct($name, $category_id, $description, $price, $register_date, $stock);
        } catch (Exception $e) {
            error_log('Error al agregar producto en el controlador: ' . $e->getMessage());
            return false;
        }
    }



    public function updateProduct($product_id, $name, $description, $price, $register_date, $stock, $category_id) {  // Añadido category_id
        try {
            return $this->productModel->updateProduct($product_id, $name, $description, $price, $register_date, $stock, $category_id);  // Modificado para incluir category_id
        } catch (Exception $e) {
            error_log('Error al actualizar producto en el controlador: ' . $e->getMessage());
            return false;
        }
    }


    public function deleteProduct($product_id) {
        try {
            return $this->productModel->deleteProduct($product_id);
        } catch (Exception $e) {
            error_log('Error al borrar producto en el controlador: ' . $e->getMessage());
            return false;
        }
    }


}
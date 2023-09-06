<?php

class SaleModel{

    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getSales() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM sales");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error al obtener ventas: ' . $e->getMessage());
        }
    }

    public function getSaleById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM sales WHERE product_id = ?");
            $statement->execute([$id]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener venta: ' . $e->getMessage());
            return false;
        }
    }

    public function addSale($user_id, $product_id, $sale_date, $amount) {
        try {
            $statement = $this->connection->prepare("INSERT INTO sales (user_id, product_id, sale_date, amount) VALUES (?, ?, ?, ?)");
            return $statement->execute([$user_id, $product_id, $sale_date, $amount]);
        } catch (PDOException $e) {
            error_log('Error al agregar venta: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateSale($sale_id, $user_id,  $product_id,  $sale_date, $amount)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE sales SET user_id = ?, product_id = ?, sale_date = ?, amount = ? WHERE sale_id = ?");
            return $stmt->execute([$user_id,  $product_id,  $sale_date, $amount, $sale_id]);
        } catch (PDOException $e) {
            error_log('Error al actualizar la venta: ' . $e->getMessage());
            throw $e;
        }
    }


    public function deleteSale($sale_id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM sales WHERE sale_id = ?");
            return $statement->execute([$sale_id]);
        } catch (PDOException $e) {
            error_log('Error al borrar producto: ' . $e->getMessage());
            throw $e;
        }
    }
}

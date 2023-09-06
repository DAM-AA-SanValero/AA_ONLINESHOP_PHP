<?php

class ProductModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getProducts() {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM products");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error al obtener productos: ' . $e->getMessage());
        }
    }

    public function getProductById($id) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM products WHERE product_id = ?");
            $statement->execute([$id]);
            return $statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Error al obtener producto: ' . $e->getMessage());
            return false;
        }
    }


    public function addProduct($name,$category_id, $description, $price, $register_date, $stock  ) {
        try {
            $statement = $this->connection->prepare("INSERT INTO products (name, category_id, description, price, register_date, stock) VALUES (?, ?, ?, ?, ?, ?)");
            return $statement->execute([$name, $category_id, $description, $price, $register_date, $stock]);
        } catch (PDOException $e) {
            error_log('Error al agregar producto: ' . $e->getMessage());
            throw $e;
        }
    }



    public function updateProduct($product_id, $name, $description, $price, $register_date, $stock, $category_id) {
        try {
            $stmt = $this->connection->prepare("UPDATE products SET name = ?, description = ?, price = ?, register_date = ?, stock = ?, category_id = ? WHERE product_id = ?");
            return $stmt->execute([$name, $description, $price, $register_date, $stock, $category_id, $product_id]);
        } catch (PDOException $e) {
            error_log('Error al actualizar el producto: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteProduct($product_id) {
        try {
            $statement = $this->connection->prepare("DELETE FROM products WHERE product_id = ?");
            return $statement->execute([$product_id]);
        } catch (PDOException $e) {
            error_log('Error al borrar producto: ' . $e->getMessage());
            throw $e;
        }
    }



}

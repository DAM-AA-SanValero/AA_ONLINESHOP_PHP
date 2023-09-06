<?php
require_once "connection/Database.php";
class CategoryModel{

    public $connection;
    public $name;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getCategories($table)
    {
        try {
            if ($table !== 'categories') {
                throw new Exception('Nombre de tabla no permitido');
            }

            $query = 'SELECT * FROM ' . $table;
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOException $e) {
            error_log("Error en la base de datos: " . $e->getMessage());
            throw new Exception('Error en la base de datos');
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            throw $e;
        }
    }

    public function addCategory($name, $description) {
        try {
            $statement = $this->connection->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
            return $statement->execute([$name, $description]);
        } catch (PDOException $e) {
            error_log('Error al agregar categoría: ' . $e->getMessage());
            return false;
        }
    }

    public function updateCategory($category_id, $name, $description) {
        try {
            $stmt = $this->connection->prepare("UPDATE categories SET name = :name, description = :description WHERE category_id = :category_id");
            return $stmt->execute([':name' => $name, ':description' => $description, ':category_id' => $category_id]);
        } catch (PDOException $e) {
            error_log('Error al actualizar la categoría: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteCategory($category_id) {
        try {
            $stmt = $this->connection->prepare("DELETE FROM categories WHERE category_id = :category_id");
            return $stmt->execute([':category_id' => $category_id]);
        } catch (PDOException $e) {
            error_log('Error al eliminar la categoría: ' . $e->getMessage());
            return false;
        }
    }
}

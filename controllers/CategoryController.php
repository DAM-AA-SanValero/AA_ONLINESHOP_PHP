<?php
include '../models/connection/Connection.php';
include '../models/CategoryModel.php';

class CategoryController
{

    private $categoryModel;

    public function __construct()
    {
        $connection = new Connection();
        $pdo = $connection->connect();
        $this->categoryModel = new CategoryModel($pdo);
    }

    public function getCategories()
    {
        try {
            $categories = $this->categoryModel->getCategories("categories");
            header('Location: /aa_onlineshop/views/categories/CategoryView.php');
            return $this->categoryModel->getCategories("categories");

        } catch (PDOException $e) {
            echo "Error en la base de datos: " . $e->getMessage();
        }
    }


    public function addCategory($name, $description) {
        try {
            return $this->categoryModel->addCategory($name, $description);
        } catch (Exception $e) {
            error_log('Error al agregar categoría en el controlador: ' . $e->getMessage());
            return false;
        }
    }

    public function updateCategory($category_id, $name, $description) {
        try {
            $result = $this->categoryModel->updateCategory($category_id, $name, $description);
            if ($result) {
                return true;
            } else {
                echo "Error al actualizar la categoría.";
            }
        } catch (Exception $e) {
            error_log('Error al actualizar categoría en el controlador: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteCategory($id) {
        try {
            return $this->categoryModel->deleteCategory($id);
        } catch (Exception $e) {
            error_log('Error al eliminar categoría en el controlador: ' . $e->getMessage());
            return false;
        }
    }
}

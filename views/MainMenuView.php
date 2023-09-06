<?php
include 'header.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'administrator';
?>

    <section>
    <div id="container">
    <div class="tablesDB">
        <a href="util/logout.php"><img src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
<?php if ($isAdmin) { ?>
    <div class="row1">
        <div class="table">
            <a href="views/users/UserView.php"><img src="assets/images/user.png" alt="Tabla de Usuarios"
                                              class="userviewimage"></a>
            <h3>Usuarios</h3>
        </div>
        <div class="table">
            <a href="views/sales/SaleView.php"><img src="assets/images/sale.png" alt="Tabla de ventas" class="saleviewimage"></a>
            <h3>Ventas</h3>
        </div>

    </div>
    <?php } ?>
    <div class="row2">
        <div class="table">
            <a href="views/categories/CategoryView.php"><img src="assets/images/category.png" alt="Tabla de categorías"
                                                  class="categoryviewimage"></a>
            <h3>Categorías</h3>
        </div>
        <div class="table">
            <a href="views/products/ProductView.php"><img src="assets/images/product.png" alt="Tabla de productos"
                                                 class="productviewimage"></a>
            <h3>Productos</h3>
        </div>

    </div>
    </div>
    </div>

    </section>

    <?php
    require_once 'footer.php';
    ?>
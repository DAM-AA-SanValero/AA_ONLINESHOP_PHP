<?php
include '../header.php';
include '../../models/connection/Connection.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'administrator';

$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM products';
$statement = $connection->prepare($query);
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<nav>
    <div id="menu">
        <?php if ($isAdmin): ?>
            <a href="views/users/UserView.php">Users</a>
            <a href="views/sales/SaleView.php">Sales</a>
        <?php endif; ?>
        <a href="views/categories/CategoryView.php">Categories</a>
    </div>
</nav>
<section class="categories">
    <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
    <h2>-- PRODUCTS --</h2>
    <?php if ($isAdmin): ?>
    <h5><a href="views/products/RegisterProductView.php">Register product</h5></a>
    <?php endif; ?>

    <?php if (!empty($products)): ?>
        <div class="column_name">
            <?php if ($isAdmin): ?>
                <div class="field">
                    <h4>Id</h4>
                </div>
                <div class="field">
                    <h4>Category_Id</h4>
                </div>
            <?php endif; ?>
            <div class="field">
                <h4>Product</h4>
            </div>
            <div class="field">
                <h4>Description</h4>
            </div>
            <div class="field">
                <h4>Price</h4>
            </div>
            <div class="field">
                <h4>Register Date</h4>
            </div>
            <div class="field">
                <h4>Stock</h4>
            </div>
        </div>

        <?php foreach ($products as $field): ?>
            <div class="registers">
                <?php if ($isAdmin): ?>
                    <div class="field">
                        <div class="catid">
                        <p><?php echo $field['product_id']; ?>  </p>
                        <div class="functionsId">
                            <a href="views/products/UpdateProductView.php?id=<?php echo $field['product_id']; ?>">
                                <img class="icon" src="assets/images/edit.png" alt="Edit"></a>
                            <a href="functions/DeleteProductProcess.php?id=<?php echo $field['product_id'];?>"><img class="icon" src="assets/images/delete.png" alt="Delete"></a>
                        </div>
                        </div>


                    </div>
                    <div class="field">
                        <p><?php echo $field['category_id']; ?></p>
                    </div>
                <?php endif; ?>
                <div class="field">
                    <p><?php echo $field['name']; ?></p>
                </div>
                <div class="field">
                    <p><?php echo $field['description']; ?></p>
                </div>
                <div class="field">
                    <p><?php echo $field['price']; ?></p>
                </div>
                <div class="field">
                    <p><?php echo $field['register_date']; ?></p>
                </div>
                <div class="field">
                    <p><?php echo $field['stock'] == 0 ? 'NO' : 'YES'; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay productos registrados en el sistema.</p>
    <?php endif; ?>
</section>
<?php include '../footer.php'; ?>

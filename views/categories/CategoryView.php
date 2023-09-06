<?php
include '../header.php';
include '../../models/connection/Connection.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'administrator';

$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM categories';
$statement = $connection->prepare($query);
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<nav>
    <div id="menu">
        <?php if ($isAdmin): ?>
            <a href="views/users/UserView.php">Users</a>
            <a href="views/sales/SaleView.php">Sales</a>
        <?php endif; ?>
        <a href="views/products/ProductView.php">Products</a>
    </div>
</nav>
<section class="categories">
    <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
    <h2>-- CATEGORIES --</h2>
    <?php if ($isAdmin): ?>
    <h5><a href="views/categories/RegisterCategoryView.php">Register category</h5></a>
    <?php endif; ?>

    <?php if (!empty($categories)): ?>
        <div class="column_name">
            <?php if ($isAdmin): ?>
                <div class="field">
                    <h4>Id</h4>
                </div>
            <?php endif; ?>
            <div class="field">
                <h4>Category</h4>
            </div>
            <div class="field">
                <h4>Description</h4>
            </div>
        </div>

        <?php foreach ($categories as $field): ?>
            <div class="registers">
                <?php if ($isAdmin): ?>
                    <div class="field">
                        <?php if ($isAdmin): ?> <div class="catid">
                        <p><?php echo $field['category_id']; ?>  </p>
                        <div class="functionsId">
                            <a href="views/categories/UpdateCategoryView.php?id=<?php echo $field['category_id']; ?>">
                                <img class="icon" src="assets/images/edit.png" alt="Edit"></a>
                            <a href="functions/DeleteCategoryProcess.php?id=<?php echo $field['category_id'];?>"><img class="icon" src="assets/images/delete.png" alt="Delete"></a>
                        </div>

                        </div>

                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <div class="field">
                    <p><?php echo $field['name']; ?></p>
                </div>
                <div class="field">
                    <p><?php echo $field['description']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No hay categorías registradas en el sistema.</p>
    <?php endif; ?>
</section>
<?php include '../footer.php'; ?>

<?php
include '../header.php';
include '../../models/connection/Connection.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'administrator';

$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM sales';
$statement = $connection->prepare($query);
$statement->execute();
$sales = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($isAdmin):
    ?>
    <nav>
        <div id="menu">
            <a href="views/users/UserView.php">Users</a>
            <a href="views/products/ProductView.php">Products</a>
            <a href="views/categories/CategoryView.php">Categories</a>
        </div>
    </nav>
    <section class="categories">
        <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
        <h2>-- SALES --</h2>
        <h5><a href="views/sales/RegisterSaleView.php">Register sale</h5></a>

        <?php if (!empty($sales)): ?>
            <div class="column_name">
                <div class="field">
                    <h4>Id</h4>
                </div>
                <div class="field">
                    <h4>User_id</h4>
                </div>
                <div class="field">
                    <h4>Product_id</h4>
                </div>
                <div class="field">
                    <h4>Sale_date</h4>
                </div>
                <div class="field">
                    <h4>Amount</h4>
                </div>
            </div>

            <?php foreach ($sales as $field): ?>
                <div class="registers">
                    <div class="field">
                        <div class="catid">
                            <p><?php echo $field['sale_id']; ?>  </p>
                            <div class="functionsId">
                                <a href="views/sales/UpdateSaleView.php?id=<?php echo $field['sale_id']; ?>">
                                    <img class="icon" src="assets/images/edit.png" alt="Edit"></a>
                                <a href="functions/DeleteSaleProcess.php?id=<?php echo $field['sale_id']; ?>">
                                    <img class="icon" src="assets/images/delete.png" alt="Delete"></a>
                            </div>

                        </div>
                    </div>
                    <div class="field">
                        <p><?php echo $field['user_id']; ?></p>
                    </div>
                    <div class="field">
                        <p><?php echo $field['product_id']; ?></p>
                    </div>
                    <div class="field">
                        <p><?php echo $field['sale_date']; ?></p>
                    </div>
                    <div class="field">
                        <p><?php echo $field['amount']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay ventas registradas en el sistema.</p>
        <?php endif; ?>
    </section>
<?php endif; ?>
<?php include '../footer.php'; ?>


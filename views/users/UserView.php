<?php
include '../header.php';
include '../../models/connection/Connection.php';
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'administrator';

$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM users';
$statement = $connection->prepare($query);
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($isAdmin):
    ?>
    <nav>
        <div id="menu">
            <a href="views/sales/SaleView.php">Sales</a>
            <a href="views/products/ProductView.php">Products</a>
            <a href="views/categories/CategoryView.php">Categories</a>
        </div>
    </nav>

    <section class="categories">
        <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
        <h2>-- USERS --</h2>
        <h5><a href="views/users/RegisterUserView.php">Register user</h5></a>

        <?php if (!empty($users)): ?>
            <div class="column_name">
                <div class="field">
                    <h4>Id</h4>
                </div>
                <div class="field">
                    <h4>Name</h4>
                </div>
                <div class="field">
                    <h4>Surname</h4>
                </div>
                <div class="field">
                    <h4>Email</h4>
                </div>
                <div class="field">
                    <h4>Role</h4>
                </div>
            </div>

            <?php foreach ($users as $field): ?>
                <div class="registers">
                    <div class="field">
                        <div class="catid">
                            <p><?php echo $field['user_id']; ?>  </p>
                            <div class="functionsId">
                                <a href="views/users/UpdateUserView.php?id=<?php echo $field['user_id']; ?>">
                                    <img class="icon" src="assets/images/edit.png" alt="Edit"></a>
                                <a href="functions/DeleteUserProcess.php?id=<?php echo $field['user_id']; ?>">
                                    <img class="icon" src="assets/images/delete.png" alt="Delete"></a>
                            </div>

                        </div>
                    </div>
                    <div class="field">
                        <p><?php echo $field['name']; ?></p>
                    </div>
                    <div class="field">
                        <p><?php echo $field['surname']; ?></p>
                    </div>
                    <div class="field">
                        <p><?php echo $field['email']; ?></p>
                    </div>
                    <div class="field">
                        <p><?php echo $field['role']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay usuarios registradas en el sistema.</p>
        <?php endif; ?>
    </section>
<?php endif; ?>
<?php include '../footer.php'; ?>

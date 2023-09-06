<?php
include "../header.php";
include '../../models/connection/Connection.php';

$connection = new Connection();
$connection->connect();
$query_users = 'SELECT * FROM users';
$statement_users = $connection->prepare($query_users);
$statement_users->execute();
$users = $statement_users->fetchAll(PDO::FETCH_ASSOC);

$query_products = 'SELECT * FROM products';
$statement_products = $connection->prepare($query_products);
$statement_products->execute();
$products = $statement_products->fetchAll(PDO::FETCH_ASSOC);

$today = date("Y-m-d");
?>
<section class="form">
    <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
    <form action="functions/RegisterSaleProcess.php" name="formulario" method="POST">
        <h1>REGISTER A SALE</h1>

        <label for="user_id">User ID:</label>
        <select id="user_id" name="user_id">
            <?php foreach ($users as $user): ?>
                <option value="<?php echo $user['user_id']; ?>">
                    <?php echo $user['user_id'] . ' - ' . $user['email']; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="product_id">Product ID:</label>
        <select id="product_id" name="product_id">
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['product_id']; ?>">
                    <?php echo $product['product_id'] . ' - ' . $product['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Sale Date:</label>
        <input id="sale_date" type="date" name="sale_date" value="<?php echo $today; ?>" required>
        <br><br>

        <label>Amount:</label>
        <input id="amount" type="number" step="0.01" placeholder="valor 0 o positivo.." name="amount" min="0">
        <br><br>

        <button class="boton" type="submit">ADD SALE</button>
    </form>
</section>


<?php
include "../footer.php";
?>

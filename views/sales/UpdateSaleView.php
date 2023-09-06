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


if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];
    $query_sales = 'SELECT * FROM sales WHERE sale_id = :id';
    $statement_sales = $connection->prepare($query_sales);
    $statement_sales->bindParam(':id', $sale_id, PDO::PARAM_INT);
    $statement_sales->execute();
    $sale = $statement_sales->fetch(PDO::FETCH_ASSOC);
} else {
    die("El ID de la venta no fue especificado.");
}





?>
    <section class="form">

        <form action="functions/UpdateSaleProcess.php" name="formulario" method="POST">
            <h1>UPDATE A SALE</h1>

            <input type="hidden" name="sale_id" value="<?php echo $sale['sale_id']; ?>">

            <label for="user_id">User ID:</label>
            <select id="user_id" name="user_id">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['user_id']; ?>"
                        <?php echo ($sale['user_id'] == $user['user_id']) ? 'selected' : ''; ?>>
                        <?php echo $user['user_id'] . ' - ' . $user['email']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label for="product_id">Product ID:</label>
            <select id="product_id" name="product_id">
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['product_id']; ?>"
                        <?php echo ($sale['product_id'] == $product['product_id']) ? 'selected' : ''; ?>>
                        <?php echo $product['product_id'] . ' - ' . $product['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>

            <label>Sale Date:</label>
            <input id="sale_date" type="date" name="sale_date" value="<?php echo $sale['sale_date']; ?>">
            <br><br>


            <label>Amount:</label>
            <input id="amount" type="number" step="0.01" value="<?php echo $sale['amount']; ?>" name="amount" min="0">
            <br><br>

            <button class="boton" type="submit">UPDATE</button>
        </form>

    </section>

<?php
include "../footer.php";
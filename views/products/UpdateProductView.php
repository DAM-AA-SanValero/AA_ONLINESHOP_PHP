<?php
include "../header.php";
include '../../models/connection/Connection.php';

$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM categories';
$statement = $connection->prepare($query);
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);


if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query2 = 'SELECT * FROM products WHERE product_id = :id';
    $statement2 = $connection->prepare($query2);
    $statement2->bindParam(':id', $product_id, PDO::PARAM_INT);
    $statement2->execute();
    $product = $statement2->fetch(PDO::FETCH_ASSOC);
} else {
    die("El ID del producto no fue especificado.");
}



?>
<section class="form">
    <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
    <form action="functions/UpdateProductProcess.php" name="formulario" method="POST">
        <h1>UPDATE A PRODUCT</h1>

        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

        <label>Product:</label>
        <input id="name" type="text" value="<?php echo htmlspecialchars($product['name']); ?>" name="name" required>
        <br><br>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo $category['category_id']; ?>"
                    <?php echo ($product['category_id'] == $category['category_id']) ? 'selected' : ''; ?>>
                    <?php echo $category['category_id'] . ' - ' . $category['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Description:</label>
        <textarea id="description" name="description" maxlength="1000" required>
        <?php echo htmlspecialchars($product['description']); ?>
    </textarea>
        <br><br>

        <label>Price:</label>
        <input id="price" type="number" step="0.01" value="<?php echo $product['price']; ?>" name="price" min="0" required>
        <br><br>

        <label>Register Date:</label>
        <input id="register_date" type="date" name="register_date" value="<?php echo $product['register_date']; ?>">
        <br><br>

        <label for="stock">In Stock:</label>
        <input type="checkbox" id="stock" name="stock" value="yes"
            <?php echo ($product['stock'] == 1) ? 'checked' : ''; ?>
        >
        <br><br>

        <button class="boton" type="submit">UPDATE</button>
    </form>

</section>

<?php
include "../footer.php";
?>

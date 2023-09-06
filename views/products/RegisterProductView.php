<?php
include "../header.php";
include '../../models/connection/Connection.php';

$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM categories';
$statement = $connection->prepare($query);
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

$today = date("Y-m-d");
?>
<section class="form">
    <a href="util/logout.php"><img style = "text-align: center;" src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
    <form action="functions/RegisterProductProcess.php" name="formulario" method="POST">
        <h1>REGISTER A PRODUCT</h1>

        <label>Product:</label>
        <input id="name" type="text" placeholder="Product*" name="name" required>
        <br><br>

        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id">
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category['category_id']); ?>">
                    <?php echo htmlspecialchars($category['category_id'] . ' - ' . $category['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <br><br>

        <label>Description:</label>
        <textarea id="description" placeholder="max 1000 palabras..." name="description" maxlength="1000" required></textarea>
        <br><br>

        <label>Price:</label>
        <input id="price" type="number" step="0.01" placeholder="valor 0 o positivo.." name="price" min="0" required>
        <br><br>

        <label>Register Date:</label>
        <input id="register_date" type="date" name="register_date" value="<?php echo $today; ?>" required>
        <br><br>

        <label for="stock">In Stock:</label>
        <input type="checkbox" id="stock" name="stock" value="yes" checked>

        <br><br>

        <button class="boton" type="submit">ADD PRODUCT</button>
    </form>
</section>


<?php
include "../footer.php";
?>



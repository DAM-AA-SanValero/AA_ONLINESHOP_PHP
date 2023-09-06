<?php
include "../header.php";

$category_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($category_id === null) {
    die('No se especificó un ID de categoría.');
}
?>
<section class="form">
    <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
    <form action="functions/UpdateCategoryProcess.php" name="formulario" method="POST">

        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">

        <h1>UPDATE CATEGORY</h1>
        <label>Category:</label>
        <input id="name" type="text" placeholder="Category*" name="name">
        <br><br>
        <label>Description:</label>
        <input id="description" type="text" placeholder="max 1000 palabras..." name="description">
        <br><br>
        <button class="boton" type="submit">UPDATE</button>
    </form>
</section>

<?php
include "../footer.php";
?>

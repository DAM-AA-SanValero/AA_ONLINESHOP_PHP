<?php
include "../header.php";
?>
    <section class="form">
        <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
        <form action="functions/RegisterCategoryProcess.php" name="formulario" method="POST">
        <h1>REGISTER A CATEGORY</h1>
        <label>Category:</label>
        <input id="name" type="text" placeholder="Category*" name="name">
        <br><br>
        <label>Description:</label>
        <input id="description" type="text" placeholder="max 1000 palabras..." name="description">
        <br><br>

        <button class="boton" type="submit">ADD CATEGORY</button>
        </form>
    </section>

<?php
include "../footer.php";
?>



<?php
include "views/header.php";
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'administrator';
?>
    <section class="form">
        <form action="controllers/LoginController.php" name="formulario" method="POST">
        <h1>INICIA SESIÓN</h1>
        <label>E-mail:</label>
        <input id="email" type="text" placeholder="Correo electrónico*" name="email" size="50">
        <br><br>
        <label>Contraseña:</label>
        <input id="password" type="password" placeholder="Contraseña*" name="password">
        <br><br>

        <button class="boton" type="submit">ACCEDER</button>
        <br><br>

       <?php if(!$isAdmin){ ?>


        <h4>Si no eres usuario, registrate <a href="views/users/RegisterUserView.php">aqui</a></h4>
    <?php } ?>
        </form>
    </section>

<?php

include "views/footer.php";
?>
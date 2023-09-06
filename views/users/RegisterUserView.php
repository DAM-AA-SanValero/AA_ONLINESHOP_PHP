<?php
include "../header.php";
include '../../models/connection/Connection.php';

$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 'administrator';


$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM users';
$statement = $connection->prepare($query);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$isAdmin){?>
    <section class="form">
        <form action="functions/RegisterUserProcess.php" name="formulario" method="POST">
        <h1>REGISTRATE</h1>
        <label>Nombre:</label>
        <input id="name" type="text" placeholder="Nombre*" name="name">
        <br><br>
        <label>Apellido:</label>
        <input id="surname" type="text" placeholder="Apellido*" name="surname">
        <br><br>
        <label>E-mail:</label>
        <input id="email" type="email" placeholder="Correo electrónico*" name="email">
        <br><br>
        <label>Contraseña:</label>
        <input id="password" type="password" placeholder="Contraseña*" name="password">
        <br><br>

            <label>Role:</label>
            <select id="role" name="role">
                <option value="administrator" <?php echo ($user['role'] == 'administrator') ? 'selected' : ''; ?>>Administrator</option>
                <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
            </select>
            <br><br>

        <button class="boton" type="submit">CREAR CUENTA</button>
        </form>
    </section>

<?php } else{ ?>
    <section class="form">
        <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
        <form action="functions/RegisterUserProcessAdmin.php" name="formulario" method="POST">
            <h1>REGISTRA UN USUARIO</h1>
            <label>Nombre:</label>
            <input id="name" type="text" placeholder="Nombre*" name="name">
            <br><br>
            <label>Apellido:</label>
            <input id="surname" type="text" placeholder="Apellido*" name="surname">
            <br><br>
            <label>E-mail:</label>
            <input id="email" type="email" placeholder="Correo electrónico*" name="email">
            <br><br>
            <label>Contraseña:</label>
            <input id="password" type="password" placeholder="Contraseña*" name="password">
            <br><br>

            <label>Role:</label>
            <select id="role" name="role">
                <option value="administrator" <?php echo ($user['role'] == 'administrator') ? 'selected' : ''; ?>>Administrator</option>
                <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
            </select>
            <br><br>

            <button class="boton" type="submit">AÑADIR USUARIO</button>
        </form>
    </section>
<?php }
include "../footer.php";
?>



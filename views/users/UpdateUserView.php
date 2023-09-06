<?php
include "../header.php";
include '../../models/connection/Connection.php';

$user_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($user_id === null) {
    die('No se especificó un ID de usuario.');
}

$connection = new Connection();
$connection->connect();
$query = 'SELECT * FROM users WHERE user_id = :user_id';
$statement = $connection->prepare($query);
$statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

?>
<section class="form">
    <a href="util/logout.php"><img style = "text-align: center"; src="assets/images/logout.png" alt="Log Out" class="logoutimage"></a>
    <form action="functions/UpdateUserProcess.php" name="formulario" method="POST">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <h1>UPDATE AN USER</h1>
        <label>Nombre:</label>
        <input id="name" type="text" placeholder="Nombre*" name="name" value="<?php echo $user['name']; ?>">
        <br><br>

        <label>Apellido:</label>
        <input id="surname" type="text" placeholder="Apellido*" name="surname" value="<?php echo $user['surname']; ?>">
        <br><br>

        <label>E-mail:</label>
        <input id="email" type="email" placeholder="Correo electrónico*" name="email" value="<?php echo $user['email']; ?>">
        <br><br>

        <label>Role:</label>
        <select id="role" name="role">
            <option value="administrator" <?php echo ($user['role'] == 'administrator') ? 'selected' : ''; ?>>Administrator</option>
            <option value="user" <?php echo ($user['role'] == 'user') ? 'selected' : ''; ?>>User</option>
        </select>

        <br><br>

        <button class="boton" type="submit">UPDATE</button>
    </form>
</section>

<?php
include "../footer.php";
?>

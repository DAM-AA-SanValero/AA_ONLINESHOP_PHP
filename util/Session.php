<?php
class Session {

    function __construct() {
        session_start();
    }

    public function set($nombre, $valor, $u_level, $valor2) {
        $_SESSION[$nombre] = $valor;
        $_SESSION[$u_level] = $valor2;
    }

    public function borrar_sesion() {
        $_SESSION = array();
        session_destroy();
        header("Location: ../index.php");
    }
}
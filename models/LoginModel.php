<?php

class LoginModel
{
    private $connection;
    private $email;
    private $password;

    public function __construct($pdo, $email, $password)
    {
        $this->connection = $pdo;
        $this->email = $email;
        $this->password = $password;
    }

    public function login()
    {
        $statement = $this->connection->prepare("SELECT * FROM users WHERE email = ?");
        $statement->execute([$this->email]);
        $user = $statement->fetch();

        if ($user && password_verify($this->password, $user['password'])) {
            $this->setSession($user);
            return true;

        } else {return false;}
    }

    private function setSession($user)
    {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['role'] = $user['role'];
    }
}

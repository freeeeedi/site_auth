<?php
require_once('UserStore.php');

class Auth
{
    public $user_store;
    public $db;

    public function __construct(DataBase $db)
    {
        $this->db = $db;
        if ($this->db->connection->connect_error) {
            return $this->db->connection->connect_error;
        }
        $this->user_store = new UserStore($db);
    }

    public function login($login, $password)
    {
        $auth_check = $this->user_store->checkUser($login, $password);

        return $auth_check;
    }
}

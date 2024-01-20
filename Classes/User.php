<?php

require_once('UserStore.php');

class User
{
    private $user_store;

    public function __construct(DataBase $db)
    {
        $this->user_store = new UserStore($db);
    }

    public function getUserByID($id)
    {
        $result = $this->user_store->getUserByID($id);

        return $result;
    }

    public function getUserID($login)
    {
        $result = $this->user_store->getUserID($login);

        return $result;
    }

    public function updateUserInfo($column, $value, $user_id)
    {
        $result = $this->user_store->updateUserInfo($column, $value, $user_id);

        return $result;
    }

    public function createUser($login, $password, $email = '', $phone = '')
    {
        $result = $this->user_store->createUser($login, $password, $email, $phone);

        return $result;
    }
}

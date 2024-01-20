<?php

class UserStore
{
    public $db_connection;

    public function __construct(DataBase $db)
    {
        $this->db_connection = $db->connection;
    }

    public function checkUser($login, $password)
    {
        $result = [];

        if ($this->db_connection->connect_error) {

            $result = $this->db_connection->connect_error;

            return $result;
        }

        $query = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
        $login_check_query = $this->db_connection->query($query);

        if ($login_check_query->num_rows) {

            $result = $this->getUser($login);

            return $result;
        }

        return [
            'result' => false,
            'message' => 'Неправильный логин или пароль'
        ];
    }

    public function getUser($login)
    {
        $query = "SELECT * FROM users WHERE login = '$login'";
        $user_result = $this->db_connection->query($query);

        if ($user_result->num_rows) {

            $user_array = $this->resultToArray($user_result);

            return [
                'result' => true,
                'user' => $user_array
            ];
        }

        return [
            'result' => false,
            'message' => 'Неправильный логин'
        ];
    }

    public function getUserByID($id)
    {
        $query = "SELECT * FROM users WHERE id = '$id'";
        $user_result = $this->db_connection->query($query);

        if ($user_result->num_rows) {

            $user_array = $this->resultToArray($user_result);

            return [
                'result' => true,
                'user' => $user_array
            ];
        }

        return [
            'result' => false,
            'message' => 'Пользователя с таким id нет'
        ];
    }

    public function getUserID($login)
    {
        $query = "SELECT * FROM users WHERE login = '$login'";
        $user_result = $this->db_connection->query($query);

        if ($user_result->num_rows) {

            $user_array = $this->resultToArray($user_result);

            return [
                'result' => true,
                'id' => $user_array['id']
            ];
        }

        return [
            'result' => false,
            'message' => 'Неправильный логин'
        ];
    }

    public function updateUserInfo($column, $value, $user_id)
    {
        $query = "UPDATE users SET $column = '$value' WHERE id = $user_id";
        $result = $this->db_connection->query($query);

        return $result;
    }

    public function createUser($login, $password, $email = '', $phone = '')
    {
        $check_user = $this->getUserID($login);

        if ($check_user['result'] === false) {

            $query = "INSERT INTO users SET login = '$login', password = '$password', email = '$email', phone = '$phone'";
            $result = $this->db_connection->query($query);

            if ($result) {

                return [
                    'result' => $result,
                    'message' => 'Вы успешно зарешестрировались!'
                ];

            } else {

                return [
                    'result' => $result,
                    'message' => 'При регистрации произошла ошибка, попробуйте снова.'
                ];

            }

        }

        return [
            'result' => false,
            'message' => 'Такой логин уже существует.'
        ];
    }

    public function resultToArray($result)
    {
        return $result->fetch_assoc();
    }
}

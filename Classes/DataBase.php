<?php
class DataBase
{
    public $server = 'localhost';
    public $login = 'root';
    public $password = '';
    public $database = 'project';
    public $charset = 'utf8';
    public $connection;

    public function __construct()
    {
        $this->connection = new mysqli($this->server, $this->login, $this->password, $this->database);

        if ($this->connection != false) {
            $this->connection->set_charset($this->charset);
        }

        if ($this->connection->connect_error) {
            return $this->connection->connect_error;
        }
    }
}

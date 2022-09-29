<?php

class Database
{
    private $user ;
    private $host;
    private $pass ;
    private $db;

    public function __construct()
    {
        $this->user = "root";
        $this->host = "localhost";
        $this->pass = "root";
        $this->db = "test_for_middle";
    }
    public function connect()
    {
        $link = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        return $link;
    }
}
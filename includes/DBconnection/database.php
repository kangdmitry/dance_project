<?php
class Database
{
    var $host = "";
    var $user = "";
    var $password = "";
    var $db = "";

    public $link;

    public function Database($host, $user, $password, $db)
    {
        $this->host=$host;
        $this->user=$user;
        $this->password=$password;
        $this->db=$db;

    }

    public function connect()
    {
        $this->link = new mysqli($this->host,$this->user,$this->password,$this->db);
        if (mysqli_connect_error())
        {
            return null;
        }
        else {
            return $this->link;
        }
    }
}
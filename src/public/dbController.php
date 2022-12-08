<?php

class dbController
{
    private mysqli $db;

    public function connect()
    {
        try {
            $this->db = new mysqli('db', 'root', 'test123', 'web');
        } catch (Exception $e) {
            echo 'Error connecting to database';
        }
    }

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS adverts(
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            titles VARCHAR(255) NOT NULL,
            name VARCHAR(255) NOT NULL,
            description VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL
        )";
        $this->db->query($sql);
    }

    public function addAdvert($titles, $name, $desc, $email)
    {
        $sql = "INSERT INTO adverts(titles, name, description, email) VALUES(
            '{$titles}',
            '{$name}',
            '{$desc}',
            '{$email}'
        )";
        $this->db->query($sql);
    }

    public function getAdverts()
    {
        $sql = "SELECT * FROM adverts";
        $result = $this->db->query($sql);
        return $result;
    }
}
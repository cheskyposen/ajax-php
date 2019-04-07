<?php

class User
{
    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data){
        $this->db->query('INSERT INTO users (name, age, email, username, password) VALUES(:name, :age, :email, :username, :password)');
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':age', $data['age']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
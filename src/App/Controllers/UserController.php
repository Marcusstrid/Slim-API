<?php


namespace App\Controllers;

class UserController
{

    private $db;

    public function __construct($pdo)
    {
        $this->db =$pdo;    
    }

    public function getAll(){

        $getAllUsers = $this->db->prepare('SELECT * FROM users');
        $getAllUsers->execute();
        $allUsers= $getAllUsers->fetchAll();
        return $allUsers;
        
    }

    public function getOne($id)
    {
        $getOneUsers = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $getOneUsers->execute([':id' => $id]);
        return $getOneUsers->fetch();

    }


    public function add($user)
    {
       
        $addOneUser = $this->db->prepare(
            'INSERT INTO users (username) VALUES (:username)'
           
        );
        $addOneUser = $this->db->prepare(
        'INSERT INTO users (password) VALUES (:password)'
        );

        
        $addOneUser->execute([':username'  => $user['username']]);
        $addOneUser ->execute([':password' => $user['password']]);
      
        return [
          'id'          => (int)$this->db->lastInsertId(),
          'user'     => $user['user'],
          'password'   => $user['password']
        ];
    }

}








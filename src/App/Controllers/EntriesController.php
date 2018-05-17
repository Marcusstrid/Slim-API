<?php


namespace App\Controllers;


class EntriesController
{


    private $db;

   
    public function __construct($pdo)
    {
        $this->db =$pdo;    
    }




    public function getAll(){

        $getAllEntries = $this->db->prepare('SELECT * FROM entries DESC LIMIT 20');
        $getAllEntries->execute();
        $allEntries= $getAllEntries->fetchAll();
        return $allEntries;
        
    }

    public function getOne($id)
    {
        $getOneEntry = $this->db->prepare('SELECT * FROM entries WHERE entryID = :entryID');
        $getOneEntry->execute([':entryID' => $id]);
        return $getOneEntry->fetch();
    }


    public function add($entry)
    {
       
        $addOneEntry = $this->db->prepare(
            'INSERT INTO entries (title) VALUES (:title)'
           
        );
        $addOneEntry = $this->db->prepare(
        'INSERT INTO entries (content) VALUES (:content)'
        );

        
        $addOneEntry->execute([':title'  => $entry['title']]);
        $addOneEntry ->execute([':content' => $entry['content']]);
      
        return [
          'entryID'          => (int)$this->db->lastInsertId(),
          'title'     => $entry['title'],
          'content'   => $entry['content']
        ];
    }


    public function getTwentyEntries(){

        $getTwentyEntries = $this->db->prepare('SELECT * FROM entries LIMIT 20');
        $getTwentyEntries->execute();
        $twentyEntries= $getTwentyEntries->fetchAll();
        return $twentyEntries;
        
    }

}
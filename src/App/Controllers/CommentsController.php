<?php


namespace App\Controllers;


class CommentsController
{


    private $db;

   
    public function __construct($pdo)
    {
        $this->db =$pdo;    
    }




    public function getAll(){

        $getAllComments = $this->db->prepare('SELECT * FROM comments');
        $getAllComments->execute();
        $allComments= $getAllComments->fetchAll();
        return $allComments;
        
    }

    public function getTwentyLastComments(){

        $getTwentyComments = $this->db->prepare('SELECT * FROM comments DESC LIMIT 20');
        $getTwentyComments->execute();
        $TwentyComments= $getTwentyComments->fetchAll();
        return $TwentyComments;
        
    }

   



    public function getOne($id)
    {
        $getOneComment = $this->db->prepare('SELECT * FROM comments WHERE commentID = :commentID');
        $getOneComment->execute([':commentID' => $id]);
        return $getOneComment->fetch();
    }


    public function add($comment)
    {
       
        $addOneComment = $this->db->prepare(
            'INSERT INTO comments (commentID) VALUES (:commentID)'
           
        );
        $addOneComment = $this->db->prepare(
            'INSERT INTO comments (entryID) VALUES (:entryID)'
           
        );
        $addOneComment = $this->db->prepare(
            'INSERT INTO comments (content) VALUES (:content)'
           
        );
        $addOneComment = $this->db->prepare(
            'INSERT INTO comments (CreatedBy) VALUES (:CreatedBy)'
           
        );
        $addOneComment = $this->db->prepare(
            'INSERT INTO comments (CreatedAt) VALUES (:CreatedAt)'
           
        );

        
        $addOneComment->execute([':commentID'  => $comment['commentID']]);
        $addOneComment ->execute([':entryID' => $comment['entryID']]);
        $addOneComment ->execute([':content' => $comment['content']]);
        $addOneComment ->execute([':CreatedBy' => $comment['CreatedBy']]);
        $addOneComment ->execute([':CreatedAt' => $comment['CreatedAt']]);
      
        return [
          'commentID'          => (int)$this->db->lastInsertId(),
          'content'     => $comment['content'],
        
        ];
    }


}
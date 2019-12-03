<?php

include_once "Conexao.php";

class Post extends Conexao {

    public function createPost($img, $description, $user_id){
        $db = parent::criarConexao();

        $query = $db->prepare("INSERT INTO posts (img, descricao, user_id) values(?,?,?)");
        return $query->execute([$img, $description, $user_id]);
    }

    public function listPosts(){ 
        $db = parent::criarConexao(); 

        $query = $db->query('SELECT posts.id, posts.img, posts.descricao, users.nomeCompleto, users.imagemPerfil from posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC'); 
        $result = $query->fetchAll(PDO::FETCH_OBJ); 
        return $result;
    }
}

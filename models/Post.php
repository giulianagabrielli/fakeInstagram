<?php

include_once "Conexao.php";

class Post extends Conexao {

    public function criarPost($img, $descricao, $user_id){ 
        // Comunicando com o banco de dados. Para acessar um método da classe mãe: parent. 
        $db = parent::criarConexao();

        $query = $db->prepare("INSERT INTO posts(img, descricao, user_id) values(?,?,?)");
        return $query->execute([$img, $descricao, $user_id]);
    }

    public function listarPosts(){ 
        $db = parent::criarConexao(); 

        $query = $db->query('SELECT posts.img, posts.descricao, users.nomeCompleto, users.imagemPerfil from posts LEFT JOIN users ON posts.user_id = users.id ORDER BY posts.id DESC'); 
        $resultado = $query->fetchAll(PDO::FETCH_OBJ); 
        return $resultado;
        
    }


}

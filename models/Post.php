<?php

include_once "Conexao.php";

class Post extends Conexao {

    public function criarPost($image, $descricao){ 
        $db = parent::criarConexao();  // Comunicando com o banco de dados. Para acessar um método da classe mãe: parent. 

        $query = $db->prepare("INSERT INTO posts(img, descricao) values(?,?)");
        return $query->execute([$image, $descricao]);
    }

    public function listarPosts(){ 
        $db = parent::criarConexao(); 

        $query = $db->query('SELECT * from posts ORDER BY id DESC'); 
        $resultado = $query->fetchAll(PDO::FETCH_OBJ); 
        return $resultado;
        
    }


}

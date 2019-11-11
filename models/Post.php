<?php

include_once "Conexao.php";

class Post extends Conexao {

    public function criarPost($image, $descricao){ // função para criar um post
        $db = parent::criarConexao();  // para acessar o método da classe mãe - parent. Comunicando com o banco de dados

        $query = $db->prepare("INSERT INTO posts(img, descricao) values(?,?)");
        return $query->execute([$image, $descricao]);
    }

    public function listarPosts(){ // função para listar os posts
        $db = parent::criarConexao(); 

        $query = $db->query('SELECT * from posts ORDER BY id DESC'); // pegando posts do banco de dados
        $resultado = $query->fetchAll(PDO::FETCH_OBJ); // query fixa, não depende do que o usuário vai digitar, por isso não tem prepare/execute. FETCH_OBJ vai retornar uma lista de objetos. Cada post é um objeto.
        return $resultado;
        
    }


}

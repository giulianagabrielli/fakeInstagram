<?php

include_once "Conexao.php";

class Post extends Conexao {

    public function criarPost($image, $descricao){ // função para criar um post
        $db = parent::criarConexao();  // para acessar o método da classe mãe - parent

        $query = $db->prepare("INSERT INTO posts(img, descricao) values(?,?)");
        return $query->execute([$image, $descricao]);
    }



}

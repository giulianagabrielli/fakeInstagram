<?php

include_once "Conexao.php";

class User extends Conexao {

    public function criarUsuario($imagemPerfil, $nomeCompleto, $email, $senha){ 

        // comunicando com o banco de dados
        $db = parent::criarConexao();  

        // colocando dados no banco e retornando objeto????
        $query = $db->prepare("INSERT INTO users(imagemPerfil, nomeCompleto, email, senha) values(?,?,?,?)");
        return $query->execute([$imagemPerfil, $nomeCompleto, $email, $senha]);
    }

   


}

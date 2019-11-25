<?php

include_once "Conexao.php";

class User extends Conexao {

    public function criarUsuario($imagemPerfil, $nomeCompleto, $email, $senha){ 
        $db = parent::criarConexao();  

        $query = $db->prepare("INSERT INTO users(imagemPerfil, nomeCompleto, email, senha) values(?,?,?,?)");
        return $query->execute([$imagemPerfil, $nomeCompleto, $email, $senha]);
    }

   


}

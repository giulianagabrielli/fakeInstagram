<?php

include_once "Conexao.php";

class User extends Conexao {

    public function createUser($imgProfile, $fullName, $email, $password){ 
        $db = parent::criarConexao();  

        $query = $db->prepare("INSERT INTO users (imagemPerfil, nomeCompleto, email, senha) values(?,?,?,?)");
        return $query->execute([$imgProfile, $fullName, $email, $password]);
    }

    public function userLogin($email, $password){ 
        $db = parent::criarConexao();  

        $query = $db->prepare("SELECT * FROM users WHERE email=? AND senha=?");
        $query->execute([$email, $password]);

        // validação 
        if ($query != false) {
            $loginResult = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $loginResult; 
    }
}

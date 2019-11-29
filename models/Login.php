<?php

include_once "Conexao.php";

class Login extends Conexao {

    public function usuarioLogado($email, $senha){ 

        // comunicando com o banco de dados
        $db = parent::criarConexao();  

        // pegando do banco as informações de usuário e senha
        $query = $db->prepare("SELECT * FROM users WHERE email=? AND senha=?");
        $query->execute([$email, $senha]);

        // transformando informações em array assoc
        if ($query != false) {
            $resultadoLogin = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $resultadoLogin; 

    }

   


}
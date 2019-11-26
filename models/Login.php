<?php

include_once "Conexao.php";

class Login extends Conexao {

    public function usuarioLogado($email, $senha){ 

        // comunicando com o banco de dados
        $db = parent::criarConexao();  

        // pegando do banho as informações de usuário e senha
        $query = $db->prepare("SELECT * FROM users WHERE email=? AND senha=?");
        $query->execute([$email, $senha]);

        // rever essa condicional
        if ($query != false) {
            $resultadoLogin = $query->fetchAll(PDO::FETCH_ASSOC);
        }

        return $resultadoLogin;


    }

   


}
<?php

include_once "Conexao.php";

class User extends Conexao {

    // função para colocar as informações do novo usuário no banco de dados
    public function criarUsuario($caminhoImagemPerfil, $nomeCompleto, $email, $senha){ 
        // comunicando com o banco de dados
        $db = parent::criarConexao();  

        // colocando dados no banco 
        $query = $db->prepare("INSERT INTO users(imagemPerfil, nomeCompleto, email, senha) values(?,?,?,?)");
        return $query->execute([$caminhoImagemPerfil, $nomeCompleto, $email, $senha]);
    }

    // função para logar o usuário cadastrado
    public function usuarioLogado($email, $senha){ 

        // comunicando com o banco de dados
        $db = parent::criarConexao();  

        // pegando do banco as informações de usuário e senha
        $query = $db->prepare("SELECT * FROM users WHERE email=? AND senha=?");
        $query->execute([$email, $senha]);

        // verificação da query
        if ($query != false) {
            $resultadoLogin = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $resultadoLogin; 

    }

   


}

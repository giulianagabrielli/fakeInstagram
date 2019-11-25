<?php

include_once "models/User.php";

class UserController {
    
    public function acao($rotas){
        switch($rotas){
            case "cadastrar-user":
                $this->cadastroUser();
            break;   
        }
    }

    private function viewFormularioUser(){
        include "views/newUser.php";
    }


    private function cadastroUser(){
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //imagem de perfil
        $imagemPerfil = $_FILES['img']['name']; // Dúvida no img. Qual é o nome? img ou imagemPerfil
        $linkTemp = $_FILES ['img']['tmp_name'];
        $caminhoImagemPerfil = "views/img/$imagemPerfil";
        move_uploaded_file($linkTemp, $caminhoSalvar);

        //criando objeto User
        $user = new User(); 
        $resultado = $user->criarUsuario($caminhoImagemPerfil, $nomeCompleto, $email, $senha); // função em User.php

        //precisa de verificação??

    }
}
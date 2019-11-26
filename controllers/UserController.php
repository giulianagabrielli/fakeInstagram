<?php

include_once "models/User.php";

class UserController {
    
    public function acao($rotas){
        switch($rotas){
            case "cadastrar-user":
                $this->cadastroUser();
            break;   
            case "formulario-user":
                $this->viewFormularioUser();
            break;
        }
    }

    // formulário para novo usário
    private function viewFormularioUser(){
        include "views/newUser.php";
    }

    private function cadastroUser(){

        //nomeCompleto, email e senha
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //imagem de perfil
        $imagemPerfil = $_FILES['imagemPerfil']['name']; 
        $linkTemp = $_FILES ['imagemPerfil']['tmp_name'];
        $caminhoImagemPerfil = "views/img/$imagemPerfil";
        move_uploaded_file($linkTemp, $caminhoImagemPerfil);

        //criando objeto User
        $user = new User(); 
        $resultado = $user->criarUsuario($caminhoImagemPerfil, $nomeCompleto, $email, $senha);

        //verificação
        if ($resultado){
            header('Location:/fakeinstagram/posts'); 
        } else {
            echo "Deu errado!!";
        }

    }


}
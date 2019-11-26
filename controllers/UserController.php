<?php

include_once "models/User.php";

include_once "models/Login.php";

class UserController {
    
    public function acao($rotas){
        switch($rotas){
            case "cadastrar-user":
                $this->cadastroUser();
            break;   
            case "formulario-user":
                $this->viewFormularioUser();
            break;
            case "login-user":
                $this->loginUser();
            break;
            case "formulario-login-user":
                $this->viewFormularioLoginUser();
            break;
            
        }
    }

    // formulário para novo usário
    private function viewFormularioUser(){
        include "views/newUser.php";
    }

    // pegando informações do formulário e enviando via post para o banco de dados
    private function cadastroUser(){

        //nomeCompleto, email e senha inseridos no formulário de cadastro
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //imagem de perfil inserida no formulário de cadastro
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

    // formulário para login
    private function viewFormularioLoginUser(){
        include "views/newLogin.php";
    }

    // pegando informações do formulário de login via post
    private function loginUser(){

        //email e senha inseridos no formulário de login
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //criando objeto Login
        $user = new Login(); 
        $resultado = $user->usuarioLogado($email, $senha);

        //verificação
        if ($resultado){
            header('Location:/fakeinstagram/posts'); 
        } else {
            echo "Deu errado!!";
        }


    }

}
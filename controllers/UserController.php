<?php

session_start();

include_once "models/User.php";

class UserController {
    
    public function acao($rotas){
        switch($rotas){
            case "cadastrar-user":
                $this->cadastroUser(); // função que cadastra o usuário
            break;   
            case "formulario-user":
                $this->viewFormularioUser(); // função que visualiza o formulário de cadastro do usuário
            break;
            case "login-user":
                $this->loginUser(); // função que loga o usuário
            break;
            case "formulario-login-user":
                $this->viewFormularioLoginUser(); // função que visualiza o formulário de login do usuário
            break;
            case "logout-user": // função para deslogar o usuário
                $this->logoutUser();
            break;
        }
    }

    // formulário para novo usário
    private function viewFormularioUser(){
        include "views/newUser.php";
    }

    // pegando informações do formulário e enviando para o banco de dados
    private function cadastroUser(){

        //nomeCompleto, email e senha inseridos no formulário de cadastro
        $nomeCompleto = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        //imagem de perfil inserida no formulário de cadastro
        $arquivoImg = $_FILES['imagemPerfil']['name']; 
        $linkTemp = $_FILES ['imagemPerfil']['tmp_name'];
        $caminhoImagemPerfil = "views/img/$arquivoImg";
        move_uploaded_file($linkTemp, $caminhoImagemPerfil);

        //criando objeto User e acessando o método criarUsuario() de User.php
        $user = new User(); 
        $resultado = $user->criarUsuario($caminhoImagemPerfil, $nomeCompleto, $email, $senha);

        //verificação do cadastro de novo usuário
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

    // pegando informações do formulário de login 
    private function loginUser(){

        //email e senha inseridos no formulário de login
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        //criando objeto Login e acessando a função usuarioLogado() em User.php
        $user = new User(); 
        $resultado = $user->usuarioLogado($email, $senha);

        // verificação se o dado enviado pelo usuário é o mesmo armazenado no banco de dados
        if($resultado) {
            // criando sessão de usuário logado
            $_SESSION['sessionUserName'] = $resultado[0]['nomeCompleto'];
            // $_SESSION["sessionUserId"]  = [$resultado[0]["id"]];

            header('Location:/fakeinstagram/posts');
        } else {
            echo "E-mail ou senha inválidos.";
        }
    }

    // logout do usuário
    private function logoutUser(){
        session_start();
        session_destroy();
        header('Location:/fakeinstagram/posts');
    }


}
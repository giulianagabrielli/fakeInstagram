<?php
// iniciando sessão
session_start();

include_once "models/User.php";

class UserController {
    
    public function acao($rotas){ //associando rotas a métodos
        switch($rotas){
            case "formulario-user":
                $this->viewFormUser(); 
            break;
            case "cadastrar-user":
                $this->registerUser(); 
            break;   
            case "formulario-login-user":
                $this->viewFormLoginUser(); 
            break;
            case "login-user":
                $this->loginUser(); 
            break;
            case "logout-user": 
                $this->logoutUser();
            break;
        }
    }

    // visualização de formulário para novo usário
    private function viewFormUser(){
        include "views/newUser.php";
    }

    // pegando informações do formulário de novo usuário e enviando para db
    private function registerUser(){

        //nomeCompleto, email e senha 
        $fullName = $_POST['nomeCompleto'];
        $email = $_POST['email'];
        $password = $_POST['senha'];
        // Está dando um erro quando tento criptografar a senha e não sei pq: $password = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        //imagem de perfil 
        $fileName = $_FILES['imagemPerfil']['name']; 
        $linkTemp = $_FILES ['imagemPerfil']['tmp_name'];
        $savingImgProfile = "views/img/$fileName";
        move_uploaded_file($linkTemp, $savingImgProfile);

        //acessando método da classe User 
        $user = new User(); 
        $result = $user->createUser($savingImgProfile, $fullName, $email, $password);

        //verificação do cadastro de novo usuário
        if ($result){
            header('Location:/fakeinstagram/posts'); 
        } else {
            echo "Deu errado!!";
        }
    }

    // visualização do formulário de login
    private function viewFormLoginUser(){
        include "views/newLogin.php";
    }

    // pegando informações do formulário de login 
    private function loginUser(){

        //email e senha 
        $email = $_POST['email'];
        $password = $_POST['senha'];

        //acessando método da classe User
        $user = new User(); 
        $result = $user->userLogin($email, $password);

        // validação
        if($result) {

            // criando sessão de usuário logado
            $_SESSION['sessionUserName'] = [$result[0]['nomeCompleto']];
            $_SESSION['sessionUserId'] = [$result[0]['id']];
        
            header('Location:/fakeinstagram/posts');
        } else {
            echo "E-mail ou senha inválidos.";
        }
    }

    // logout do usuário
    private function logoutUser(){
        session_start();
        session_unset();
        session_destroy();
        header('Location:/fakeinstagram/posts');
    }
}
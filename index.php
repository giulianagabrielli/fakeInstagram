<?php //arquivo com as rotas.

$rotas = key($_GET)?key($_GET):"posts";

switch($rotas){
    case "posts": //página inicial que mostra todos os posts feitos
        include "controllers/PostController.php"; 
        $controller = new PostController();
        $controller->acao($rotas); 
    break;
    case "formulario-post": //visualização do formulário de novo post
        include "controllers/PostController.php";
        $controller = new PostController();
        $controller->acao($rotas);
    break;
    case "cadastrar-post": //envio das informações do formulário de novo post para db
        include "controllers/PostController.php";
        $controller = new PostController();
        $controller->acao($rotas);
    break;
    case "formulario-user": //visualização do formulário de novo usuário
        include "controllers/UserController.php";
        $controller = new UserController();
        $controller->acao($rotas);
    break;
    case "cadastrar-user": //envio das informações do formulário de novo usuário para db
        include "controllers/UserController.php";
        $controller = new UserController();
        $controller->acao($rotas);
    break;
    case "formulario-login-user": //visualização do formulário de login
        include "controllers/UserController.php";
        $controller = new UserController();
        $controller->acao($rotas);
    break;
    case "login-user": //buscando informações em db para logar usuário
        include "controllers/UserController.php";
        $controller = new UserController();
        $controller->acao($rotas);
    break;
    case "logout-user": //encerrando sessão de usuário logado
        include "controllers/UserController.php";
        $controller = new UserController();
        $controller->acao($rotas);
    break;
} 
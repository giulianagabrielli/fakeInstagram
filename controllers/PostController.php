<?php

session_start();
include_once "models/Post.php";

class PostController {
    
    public function acao($rotas){
        switch($rotas){
            case "posts":
                $this->listarPosts();
            break;
            case "formulario-post":
                $this->viewFormularioPost();
            break;
            case "cadastrar-post":
                $this->cadastroPost();
            break;
                
        }
    }

    // formulário de novo post
    private function viewFormularioPost(){
        if(isset($_SESSION['sessionUserName'][0])){
            include "views/newPost.php";
        } else {
            include "views/newLogin.php";
        }
        
    }

    // visualização das imagens postadas
    private function viewPosts(){
        include "views/posts.php";
    }

    // pegando as informações do formulário de post e enviando para o banco de dados
    private function cadastroPost(){
        // descrição
        $descricao = $_POST['descricao']; 

        // imagem
        $nomeArquivo = $_FILES['img']['name']; 
        $linkTemp = $_FILES ['img']['tmp_name'];
        $caminhoSalvar = "views/img/$nomeArquivo";
        move_uploaded_file($linkTemp, $caminhoSalvar);

        // user_id
        $id = $_SESSION['sessionUserId'][0];

        // criando objeto Post
        $post = new Post(); 
        $resultado = $post->criarPost($caminhoSalvar, $descricao, $id); 

        // validação
        if ($resultado){
        
            // iniciando sessão
            $_SESSION['sessionUserId'] = [$resultado[0]['id']];

            header('Location:/fakeinstagram/posts');
        } else {
            echo "Não foi possível cadastrar o post!";
        }
    }

    // colocando os posts em ordem cronológica do mais recente para o mais antigo
    private function listarPosts(){
        $post = new Post(); // criar um objeto do tipo Post para poder acessar o método listarPosts()
        $listaPosts = $post->listarPosts();
        $_REQUEST['posts'] = $listaPosts; // pega tudo do get e do post. Criando uma associação da listaPosts com a superglobal $_REQUEST 
        $this->viewPosts(); // chamando o método viewPosts
    }


}
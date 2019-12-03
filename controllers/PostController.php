<?php
// iniciando sessão
session_start();

include_once "models/Post.php";

class PostController {
    
    public function acao($rotas){ //associando rotas a métodos
        switch($rotas){
            case "formulario-post":
                $this->viewFormPost();
            break;
            case "cadastrar-post":
                $this->registerPost();
            break;    
            case "posts":
                $this->listPosts();
            break;   
        }
    }

    // visualização de formulário de novo post
    private function viewFormPost(){
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

    // pegando as informações do formulário de post e enviando para db
    private function registerPost(){
        // descrição
        $description = $_POST['descricao']; 

        // imagem
        $fileName = $_FILES['img']['name']; 
        $linkTemp = $_FILES ['img']['tmp_name'];
        $savingImgFile = "views/img/$fileName";
        move_uploaded_file($linkTemp, $savingImgFile);

        // pegando o id através da sessão aberta
        $id = $_SESSION['sessionUserId'][0];

        // acessando método da classe Post
        $post = new Post(); 
        $result = $post->createPost($savingImgFile, $description, $id); 

        // validação
        if ($result){
            header('Location:/fakeinstagram/posts');
        } else {
            echo "Não foi possível cadastrar o post!";
        }
    }

    // listando os posts na página principal
    private function listPosts(){
        $post = new Post(); 
        $listPosts = $post->listPosts();
        $_REQUEST['posts'] = $listPosts; 
        $this->viewPosts(); 
    }
}
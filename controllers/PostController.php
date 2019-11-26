<?php

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

    private function viewFormularioPost(){
        include "views/newPost.php";
    }

    private function viewPosts(){
        include "views/posts.php";
    }

    private function cadastroPost(){
        // descrição
        $descricao = $_POST['descricao']; 

        // imagem
        $nomeArquivo = $_FILES['img']['name']; 
        $linkTemp = $_FILES ['img']['tmp_name'];
        $caminhoSalvar = "views/img/$nomeArquivo";
        move_uploaded_file($linkTemp, $caminhoSalvar);

        $post = new Post(); // criando objeto Post
        $resultado = $post->criarPost($caminhoSalvar, $descricao); // função em Post.php

        if ($resultado){
            header('Location:/fakeinstagram/posts'); //header para mover o usuário para outro lugar
        } else {
            echo "Deu errado!!";
        }
    }

    private function listarPosts(){
        $post = new Post(); // criar um objeto do tipo Post para poder acessar o método listarPosts()
        $listaPosts = $post->listarPosts();
        $_REQUEST['posts'] = $listaPosts; // pega tudo do get e do post. Criando uma associação da listaPosts com a superglobal $_REQUEST 
        $this->viewPosts(); // chamando o método viewPosts
    }


}
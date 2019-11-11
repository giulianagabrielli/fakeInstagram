<?php

include_once "models/Post.php";

class PostController {
    
    public function acao($rotas){
        switch($rotas){
            case "posts":
            $this->viewPosts();
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

        $descricao = $_POST['descricao'];

        $nomeArquivo = $_FILES['img']['name'];
        $linkTemp = $_FILES ['img']['tmp_name'];
        $caminhoSalvar = "views/img/$nomeArquivo";

        move_uploaded_file($linkTemp, $caminhoSalvar);

        $post = new Post();
        $resultado = $post->criarPost($caminhoSalvar, $descricao);

        if ($resultado){
            header('Location:/fakeinstagram/posts'); //header para mover o usuário para outro lugar
        }
    }


}
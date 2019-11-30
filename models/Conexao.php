<?php

class Conexao { // classe para criar a conexão com o banco de dados
    private $host = 'mysql:host=localhost;dbname=instagram;port=8889';
    private $user = 'root';
    private $pass = 'root';

    protected function criarConexao(){ 
        return new PDO($this->host, $this->user, $this->pass);
    }
}

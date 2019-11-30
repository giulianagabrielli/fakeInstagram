<?php

// iniciar sessão se existir usuário logado
$usuarioLogado = isset ($_SESSION ['sessionUserName'])? $_SESSION['sessionUserName']:[];
var_dump($usuarioLogado);

?>

<header>
        <nav class="navbar topo-instagran justify-content-center">
            <a class="navbar-brand" href="/fakeinstagram/posts">
                <img width="90" src="views/img/logo.png" alt="" srcset="">
                Instagram
            </a>

            <ul class="nav">
            <?php if($usuarioLogado) { ?>
                <li class="nav-item">
                    <a class="nav-link disabled"> <?php "Oi, ".$usuarioLogado ?> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/fakeinstagram/logout-user">Sair</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link active" href="/fakeinstagram/formulario-user">Cadastro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/fakeinstagram/formulario-login-user">Login</a>
                </li>
            <?php } ?>
            </ul>
        </nav>
</header>
<?php

// iniciar sessão se existir usuário logado
//session_start();
$nomeUsuario = isset ($_SESSION ['sessionUserName'])? $_SESSION['sessionUserName'][0]:[];
//print_r($nomeUsuario);

?>

<header>
        <nav class="navbar topo-instagran justify-content-center">
            <a class="navbar-brand" href="/fakeinstagram/posts">
                <img width="90" src="views/img/logo.png" alt="" srcset="">
                Instagram
            </a>

            <ul class="nav">
            <?php if($nomeUsuario) { ?>
                <li class="nav-item">
                    <a class="nav-link disabled"> <?php echo "Olá, $nomeUsuario" ?> </a>
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
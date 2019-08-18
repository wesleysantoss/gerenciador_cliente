<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>
        <?php echo $title ?>
    </title>

    <link href="<?php echo PATH_URL ?>/assets/css/libs/bootstrap/bootstrap.min.css?v=<?php echo filemtime('app/assets/css/libs/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?php echo PATH_URL ?>/assets/css/global.css?v=<?php echo filemtime('app/assets/css/global.css') ?>" rel="stylesheet">

    <script src="https://kit.fontawesome.com/1dbdce141d.js"></script>

    <?php
        if(!empty($css)){
            foreach($css as $row){
                if(file_exists('app/assets/css/' . $row)){
                    $path = PATH_URL . '/assets/css/' . $row;
                    $version = filemtime('app/assets/css/' . $row);
                    echo '<link href="'.$path.'?v='.$version.'" rel="stylesheet">';
                }
            }
        }
    ?>
</head>
<body>
    <?php if(isset($_SESSION['usuario'])){ ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-cinza-claro">
            <a class="navbar-brand" href="#">Gerenciador de clientes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/gerenciador-cliente/home">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">  
                            <i class="fas fa-user-friends"></i> Clientes
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/gerenciador-cliente/cadastrar-cliente">
                                <i class="fas fa-user-edit"></i> Cadastrar
                            </a>
                            <a class="dropdown-item" href="/gerenciador-cliente/listar-cliente">
                                <i class="fas fa-users"></i> Listar
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a style="color: #c0392b" class="nav-link" href="/gerenciador-cliente/login/sair">
                            <i class="fas fa-sign-out-alt"></i> Sair
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <?php } ?>
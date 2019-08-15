<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>
        <?php echo $title ?>
    </title>

    <link href="<?php echo PATH_URL ?>/assets/css/libs/bootstrap/bootstrap.min.css?v=<?php echo filemtime(PATH . '/assets/css/libs/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">

    <link href="<?php echo PATH_URL ?>/assets/css/global.css?v=<?php echo filemtime(PATH . '/assets/css/global.css') ?>" rel="stylesheet">

    <?php
        if(!empty($css)){
            foreach($css as $row){
                if(file_exists('app/assets/css/' . $row)){
                    $path = PATH_URL . '/assets/css/' . $row;
                    $version = filemtime(PATH . '/assets/css/' . $row);
                    echo '<link href="'.$path.'?v='.$version.'" rel="stylesheet">';
                }
            }
        }
    ?>
</head>
<body>
    <?php if(isset($_SESSION['usuario'])){ ?>
        <ul class="nav justify-content-center menu_principal">
            <li class="nav-item">
                <a class="nav-link" href="/gerenciador-cliente/home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/gerenciador-cliente/cliente">Cadastrar cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/gerenciador-cliente/cliente/listar">Listar clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sair" href="/gerenciador-cliente/login/sair">Sair</a>
            </li>
        </ul>
    <?php } ?>
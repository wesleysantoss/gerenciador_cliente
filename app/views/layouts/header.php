<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <title>
        <?php echo $title ?>
    </title>

    <link href="<?php echo PATH_URL ?>/assets/css/libs/bootstrap/bootstrap.min.css?v=<?php echo filemtime(PATH . '/assets/css/libs/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">

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
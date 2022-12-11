<?php

use App\routes\Api;

require_once __DIR__ . '/vendor/autoload.php';

defineEnvVars();

new Api();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulário - Superlógica</title>
    </head>
    <body>
        <?php
            renderView('form');
        ?>
    </body>
</html>l

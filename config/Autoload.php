<?php

    spl_autoload_register(function (string $fullName) {
        $caminhoArquivo =  "/var/www/html/$fullName";
        $caminhoArquivo = str_replace('\\', DIRECTORY_SEPARATOR, $caminhoArquivo);
        $caminhoArquivo .= '.php';
        
        if (file_exists($caminhoArquivo)) {
            require_once $caminhoArquivo;
        } else {
            echo "Arquivo não encontrado... ". PHP_EOL ." Caminho: $caminhoArquivo";
        }
    });

<?php

    function getApiKey() {
        $dotevn = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
        $dotevn->load();

        return $_ENV['API_KEY'];
    }
?>

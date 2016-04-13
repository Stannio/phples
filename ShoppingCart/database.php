<?php
    $database_config = parse_ini_file('config.ini');

    try{
        $conn = new PDO(
            "mysql:host=" . $database_config['host'] .
            ";dbname=" . $database_config['database'],
            $database_config['user'],
            $database_config['pass']
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if($database_config['debug']){
            echo 'Connected Successfully';
        }
    }catch(PDOException $er){
        if($database_config['debug']){
            echo "Connection Failed " . $er->getMessage();
        }
    }
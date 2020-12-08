<?php   
    session_start();

    require 'vendor/autoload.php';
    try 
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }
    catch (Exception $e)
    {
        // Normal exception if we are in azure context !
    }
    
    require 'repository.php';
    $repo = new Repository();
?>

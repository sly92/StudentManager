<?php

include_once 'includes/config.php';

try {
    $bdd = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD, array( PDO::ATTR_PERSISTENT => true ));
    // set the PDO error mode to exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage().'<br/>'.'N° : '.$e->getCode();
    }

?>
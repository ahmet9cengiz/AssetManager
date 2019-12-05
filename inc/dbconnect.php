<?php
    $hostname = 'localhost';
    $username = 'stbarnar';
    $password = 'nono123';
    try {
      $con = new PDO("mysql:host=$hostname;dbname=stbarnar_db", $username, $password);
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
?>

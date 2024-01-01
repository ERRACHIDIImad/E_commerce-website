<?php if (!session_id())
    session_start();
    $PDO = new PDO("mysql:host=localhost;port=3306;dbname=site web de vente", "root", '');
?>
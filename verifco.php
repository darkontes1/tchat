<?php
session_start();
    $meow = 'Meow_kitty_cat';
    $toto = array();
    if(empty($_SESSION)){
        $_SESSION['connect'] = FALSE;
        $_SESSION['pseudo'] = $meow;
    }
    //var_dump($_SESSION);
    try{
        $db = new PDO('mysql:host=localhost;dbname=tchat','root','');
    } catch(PDOException $ex){
       echo '<br/>';
       echo 'echec lors de la connexion a MySQL : ('.$ex->getCode().')';
       echo $ex->getMessage();
       exit();
    }
    if(isset($_REQUEST['pseudo']) && isset($_REQUEST['pass']) && !empty($_REQUEST['pseudo']) && !empty($_REQUEST['pass'])){
        $pseudo = $_REQUEST['pseudo'];
        $query = 'SELECT * FROM users WHERE pseudo = :pseudo AND password = :pass';
        $data = $db->prepare($query);
        $data->bindValue('pseudo',$_REQUEST['pseudo'],PDO::PARAM_STR);
        $data->bindValue('pass',$_REQUEST['pass'],PDO::PARAM_STR);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($result)>0){
            echo json_encode(count($result));
            $_SESSION['connect'] = TRUE;
            $_SESSION['pseudo'] = $pseudo;
        }
    }
    if(isset($_REQUEST['action']) && $_REQUEST['action']=="deco"){
        $_SESSION['connect'] = FALSE;
        $_SESSION['pseudo'] = $meow;
    }
?>
<?php
session_start();
    $meow = 'Meow_kitty_cat';   //variable pour éviter la $_SESSION['pseudo'] que ça soit vite
    $toto = array();    //tableau pour l'envoie en AJAX
    //Si la session est vide, on la rempli
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
    //Si le pseudo et le pass sont remplis
    if(isset($_REQUEST['pseudo']) && isset($_REQUEST['pass']) && !empty($_REQUEST['pseudo']) && !empty($_REQUEST['pass'])){
        $pseudo = $_REQUEST['pseudo'];
        $pass = $_REQUEST['pass'];
        //On regarde si ils sont dans la base de données
        $query = 'SELECT * FROM users WHERE pseudo = :pseudo AND password = :pass';
        $data = $db->prepare($query);
        $data->bindValue('pseudo',$pseudo,PDO::PARAM_STR);
        $data->bindValue('pass',$pass,PDO::PARAM_STR);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        //On compte si on trouve des résultats(au moins un résultat)
        if(count($result)>0){
            echo json_encode(count($result));
            $_SESSION['connect'] = TRUE;
            $_SESSION['pseudo'] = $pseudo;
        }
    }
    //Si on déco
    if(isset($_REQUEST['action']) && $_REQUEST['action']=="deco"){
        $_SESSION['connect'] = FALSE;
        $_SESSION['pseudo'] = $meow;
    }
?>
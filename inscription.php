<?php
    //$toto = array();
    try{
        $db = new PDO('mysql:host=localhost;dbname=tchat','root','');
    }
    catch(PDOException $ex){
        echo '<br/>';
        echo 'echec lors de la connexion a MySQL : ('.$ex->getCode().')';
        echo $ex->getMessage();
        exit();
    }
    //Si le pseudo,password et la vérification du password sont remplis
    if(isset($_REQUEST['valueIns']) && isset($_REQUEST['passIns']) && isset($_REQUEST['passVeri']) && 
        !empty($_REQUEST['valueIns']) && !empty($_REQUEST['passIns'])&& !empty($_REQUEST['passVeri'])){
        $query = 'SELECT * FROM users WHERE pseudo = :pseudo';
        $data = $db->prepare($query);
        $data->bindValue('pseudo',$_REQUEST['valueIns'],PDO::PARAM_STR);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        if(count($result)==0){
            if ($_REQUEST['passVeri']==$_REQUEST['passIns']){
                //ajoute à la bdd le pseudo et password
                $query = 'INSERT INTO users(pseudo,password) VALUES (:pseudo,:password)';
                $data = $db->prepare($query);
                $data->bindValue('pseudo',$_REQUEST['valueIns'],PDO::PARAM_STR);
                $data->bindValue('password',$_REQUEST['passIns'],PDO::PARAM_STR);
                $data->execute();       
            }
            else{
                echo "Les mot de passe sont différents !";
            }
        }
        else{
            echo "Le pseudo est déjà enregistré";
        }
    }
?>
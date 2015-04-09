<?php
    //$toto = array();
    try{
        //Connexion à la BDD
        $db = new PDO('mysql:host=localhost;dbname=tchat','root','');
    //Lancement d'exception si ça rate
    } catch(PDOException $ex){
       echo '<br/>';
       echo 'echec lors de la connexion a MySQL : ('.$ex->getCode().')';
       echo $ex->getMessage();
       exit();
    }
    //Si le pseudo et le message sont trouvés
    if(isset($_REQUEST['user']) && isset($_REQUEST['message']) && !empty($_REQUEST['user']) && !empty($_REQUEST['message'])){
        //Il lance la requête d'ajout de user/ip/message
        $query = 'INSERT INTO messages(user,ip,message) VALUES (:user,:ip,:message)';
        $data = $db->prepare($query);
        $data->bindValue('user',$_REQUEST['user'],PDO::PARAM_STR);
        $data->bindValue('ip',$_SERVER["REMOTE_ADDR"],PDO::PARAM_STR);
        $data->bindValue('message',$_REQUEST['message'],PDO::PARAM_STR);
        $data->execute();
    }
    /*if(!isset($id)){
        $id = $db->lastInsertId('id');
    }*/
    $id = 0;
    //Récupère les messages et les affiche
    $query = 'SELECT * FROM messages WHERE id > :id ORDER BY id';
    //echo $id;
    //$query = 'SELECT * FROM messages WHERE date > NOW()';
    $data = $db->prepare($query);
    $data->bindValue('id',$id,PDO::PARAM_INT);
    $data->execute();
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
    //print_r($result);
    echo json_encode($result);
    //echo json_encode($toto);
?>
<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=tchat','root','');
    } catch(PDOException $ex){
       echo '<br/>';
       echo 'echec lors de la connexion a MySQL : ('.$ex->getCode().')';
       echo $ex->getMessage();
       exit();
    }
    //Si on a l'id, on affiche la liste des messages depuis notre dernière connexion
    if(isset($_REQUEST['id'])){
        $query = 'SELECT * FROM messages WHERE id > :id';
        $data = $db->prepare($query);
        $data->bindValue('id',$_REQUEST['id'],PDO::PARAM_INT);
        $data->execute();
        $result = $data->fetchAll(PDO::FETCH_ASSOC);
        //print_r($result);
        echo json_encode($result);
        //header("location:tchat.html");
    }
    //Sinon on rentre dans la bdd le message contenu dans la textarea
    else{
        $query = 'INSERT INTO messages(user,message) VALUES (:user,:message)';
        $data = $db->prepare($query);
        $data->bindValue('user',$_REQUEST['user'],PDO::PARAM_INT);
        $data->bindValue('message',$_REQUEST['message'],PDO::PARAM_STR);
        $data->execute();
        //header("location:tchat.html");
    }
?>
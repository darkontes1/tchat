<?php
    //$toto = array();
    try{
        $db = new PDO('mysql:host=localhost;dbname=tchat','root','');
    } catch(PDOException $ex){
       echo '<br/>';
       echo 'echec lors de la connexion a MySQL : ('.$ex->getCode().')';
       echo $ex->getMessage();
       exit();
    }
    
    if(isset($_REQUEST['valueInsc']) && isset($_REQUEST['passIns']) &&
     !empty($_REQUEST['valueInsc']) && !empty($_REQUEST['passIns'])&&
      isset($_REQUEST['passVeri']) && !empty($_REQUEST['passVeri'])){
      if ($_REQUEST['passVeri']==$_REQUEST['passIns']) {
        
      
        $query = 'INSERT INTO user(pseudo,password) VALUES (:pseudo,:password)';
        
        $data = $db->prepare($query);
        $data->bindValue('pseudo',$_REQUEST['valueInsc'],PDO::PARAM_STR);
        $data->bindValue(':password',$_REQUEST['passIns'],PDO::PARAM_STR);
        
        $data->execute();
    
      }
    }

?>
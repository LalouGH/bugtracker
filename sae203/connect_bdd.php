<<?php 
    $username = "root";
    $password = "";
    try { $db= new PDO('mysql:host=localhost;dbname=u759437353_dblalouadl',$username,$password); }
    catch (Exception $e){ die('Erreur: ' . $e->getMessage() ); }

    function IDtoLogin($id, $db){
        $sql="SELECT * FROM sae203_users WHERE id = $id;";
        $requete = $db->prepare($sql);           
        $requete->execute();                     
        $users_info = $requete->fetchall();

        foreach($users_info as $userinfo){
            return $userinfo['login'];
    }
}
    ?>
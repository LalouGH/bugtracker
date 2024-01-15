<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de gestion de ticket - Développeur</title>
    <?php include("connect_bdd.php");?>
    <?php session_start();?>
    <?php $ticket_id = $_GET['ticket_id'];
          $_SESSION['ticket_id'] = $ticket_id;?>
          
    <?php if($_SESSION['status'] == "0"){
        header('Location: admin_page.php');
    }
    
    if($_SESSION['status'] == "2"){
        header('Location: tester_page.php');
    }?>
    <link rel="stylesheet" href="src/styles/style_dev.css">
    <link rel="icon" type="image/x-icon" href="src/fav1.ico">
</head>
    <body>
    <header>
    <div class="bugtracker_info">
        <img src="src/logo_bugtracker.svg" alt="Logo" class="logo">
        <h1 class="title">Bug-Tracker - <?php echo "Ticket N°". $ticket_id;"";?></h1>
    </div>
    <div class="user-info">
        <img src="src/user-solid.svg" alt="User Icon" class="user-icon">
        <span class="username"><?php echo $_SESSION['login'];?></span>
        <a href="deconnexion.php" class="logout-link">Déconnexion</a>
    </div>
</header>
<div class="ticket-information">
    <div class="ticket-information-content">
    <?php
                $ticket_conclusion="";
                $sql = "SELECT * FROM sae203_tickets WHERE id = $ticket_id;";
                $requete = $db->prepare($sql);
                $requete->execute();
                $ticket_infos = $requete->fetchall();
                foreach ($ticket_infos as $ticket_info) { 
                    echo "<h1>Titre : ".$ticket_info['title']."</h1>";
                    echo "<p><strong>Type de bug : </span></strong>".$ticket_info['tag']."</p>";
                    echo "<p><strong>Description du ticket : </span></strong>".$ticket_info['ticket_desc']."</p>";
                    echo "<p><strong>Etat du ticket : </span></strong>".$ticket_info['ticket_status']."</p>";
                    echo "<p><strong>Commentaire du développeur : </strong>".$ticket_info['dev_comment']."</p>";
                }
                    ?>
    </div>
</div>
<div class="ticket-gestion">
    <div class="ticket-gestion-content">
        <h1>Traitement du ticket</h1>
            <form action="ticket_dev_update.php" method="post">
                <label for="ticket_status"><br>Changement de statut du ticket :</label>
                <select name="ticket_status" id="ticket_status">
                    <option value="En cours de traitement">En cours de traitement</option>
                    <option value="Rejeté">Rejeté</option>
                    <option value="Résolu">Résolu</option>
                </select>
                <label for="dev_comment">Commentaire du développeur :</label>
                <textarea name="dev_comment" id="dev_comment" cols="30" rows="10"></textarea>
                <input type="submit" value="Mettre à jour le ticket">
            </form>
    </div>
</div>
        <a class="return-link" href="dev_page.php">Retour vers la page developpeur</a>
    </body>
</html>
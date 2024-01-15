
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création du ticket</title>
    <?php include('connect_bdd.php');
    session_start();
    if($_SESSION['status'] == "0"){
        header('Location: admin_page.php');
    }
    
    if($_SESSION['status'] == "1"){
        header('Location: dev_page.php');
    }?>
    <link rel="stylesheet" href="src/styles/style_testeur.css">
    <link rel="icon" type="image/x-icon" href="src/fav1.ico">
</head>
<body>
<header>
    <div class="bugtracker_info">
        <img src="src/logo_bugtracker.svg" alt="Logo" class="logo">
        <h1 class="title">Bug-Tracker</h1>
    </div>
    <div class="user-info">
        <img src="src/user-solid.svg" alt="User Icon" class="user-icon">
        <span class="username"><?php echo $_SESSION['login'];?></span>
        <a href="deconnexion.php" class="logout-link">Déconnexion</a>
    </div>
</header>
<?php

// attribution des informations du formulaire de ticket dans des variables correspondantes
if($_SESSION['status'] === "2"){
$title = $_POST['title'];
$title = filter_var($title, FILTER_SANITIZE_SPECIAL_CHARS);
$user_id = $_SESSION['user_id'];
$creation_date = date('Y-m-d-H:i:s');
$tag = $_POST['tag'];
$ticket_desc = $_POST['ticket_desc'];
$ticket_desc = filter_var($ticket_desc, FILTER_SANITIZE_SPECIAL_CHARS);
$ticket_status = "En attente"; // valeur par défaut du statut du ticket, en attente de quelqu'un qui traite le ticket
$dev_comment = "Aucun commentaire ajouté pour le moment"; // valeur par défaut du commentaire, en attente de quelqu'un qui traite le dossier

// requête SQL pour la création de ticket

    $sql='INSERT INTO sae203_tickets (title, user_id, creation_date, tag, ticket_desc, ticket_status, dev_comment) VALUES (?, ?, ?, ?, ?, ?, ?)';
    $values = ["$title", "$user_id", "$creation_date", "$tag", "$ticket_desc", "$ticket_status", "$dev_comment"];
    $requete = $db->prepare($sql); 
   

// test en cas de succés ou d'échec de création de ticket
?><div class="ticket-creation-message">
        <div class="ticket-creation-message-content">
<?php if ($requete->execute($values)){
    echo "<h2>Ticket crée avec succès!<br></h2>"; // en cas de succès, les valeurs sont bien inséré dans la base de donnée et le texte de succée s'affiche
    }
} 

else{
        echo "<h2>Erreur : la création du ticket n'a pas été effectuée, veuillez réessayer<br></h2>"; // en cas d'échec, les valeurs ne sont pas inséré dans la base de donnée et le texte de d'échec s'affiche, demandant à lutilisateur de réessayer
    }
?>
        <a class="return-link" href="tester_page.php">Retour vers la page testeur</a>
        </div>
    </div>





</body>
</html>
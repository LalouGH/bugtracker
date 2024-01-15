<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des testeurs</title>
    <link rel="stylesheet" href="src/styles/style_testeur.css">
    <link rel="icon" type="image/x-icon" href="src/fav1.ico">
    <?php include('connect_bdd.php');
    session_start();
    if($_SESSION['status'] == "0"){
        header('Location: admin_page.php');
    }
    
    if($_SESSION['status'] == "1"){
        header('Location: dev_page.php');
    }?>
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
<h1>Page des testeurs</h1>
    <div class="ticket-creation">
        <div class="ticket-creation-content">
        <h2>Ajout d'un ticket</h2>
        <form action="ticket_creation.php" method="post">
            <label for="title">Titre du bug</label>
            <input type="text" name="title" id="title">
            <label for="tag">Tag</label>
            <select id="tag" name="tag">
                <option value="Problème d'interface">Problème d'interface</option>
                <option value="Crash">Crash</option>
                <option value="Faute d'orthographe">Faute d'orthographe</option>
            </select>
            <label for="description">Description du bug</label>
            <textarea name="ticket_desc" id="ticket_desc"></textarea>
            <input type="submit" value="Valider">
        </div>
    </form>
    </div>
<div class="ticket-list">
    <div class="ticket-list-content">
    <h2>Tableaux des tickets</h2>
    <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Tag</th>
                        <th>Date de création</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Développeur assignée</th>
                        <th>Date de résolution</th>
                        <th>Commentaire du développeur</th>
                    </tr>
            </thead>
            <tbody>
            <?php

            
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM sae203_tickets WHERE user_id = $user_id;";
            $requete = $db->prepare($sql);
            $requete->execute();
            $tickets = $requete->fetchall();
            foreach($tickets as $ticket){
                if($ticket['dev_assign'] != NULL){
                    $dev_assign = IDtoLogin($ticket['dev_assign'],$db);
                }
                else{
                    $dev_assign = "";
                }
                
                echo "<tr><td>". $ticket['id']."</td><td>". $ticket['title']."</td><td>". $ticket['tag']."</td><td>". 
                $ticket['creation_date']."</td><td>". $ticket['ticket_desc']."</td><td>". $ticket['ticket_status']."</td><td>". $dev_assign ."
                </td><td>". $ticket['resolution_date']."
                </td><td>". $ticket['dev_comment']."</td></tr>";};
            ?>
                </tbody>
            </table>
    </div>
</div>
<br>
</body>
</html>




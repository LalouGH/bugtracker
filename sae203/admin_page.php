<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de l'administrateur</title>
    <link rel="stylesheet" href="src/styles/style_admin.css">
    <link rel="icon" type="image/x-icon" href="src/fav1.ico">
    <?php include ('connect_bdd.php')?>
    <?php session_start()?>
    <?php if($_SESSION['status'] == "1"){
        header('Location: dev_page.php');
    }
    
    if($_SESSION['status'] == "2"){
        header('Location: tester_page.php');
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
<div class="ticket-list">
    <div class="ticket-list-content">
        <h2>Tableaux des tickets</h2>
    <?php  
        $sql='SELECT * FROM sae203_tickets';
        $requete = $db->prepare($sql);           
        $requete->execute();                     
        $tickets = $requete->fetchall();
    ?>
        <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Tag</th>
                        <th>Date de création</th>
                        <th>Description</th>
                        <th>Créateur du ticket</th>
                        <th>Statut</th>
                        <th>Priorité</th>
                        <th>Développeur assigné</th>
                        <th>Date d'assignation</th>
                        <th>Date de résolution</th>
                        <th>Commentaire du développeur</th>
                    </tr>
            </thead>
            <tbody>
                <?php 
                //traduction de l'id du créateur du ticket et l'id du developpeur assigné par le nom d'utilisateur affecté à l'id
                $ticket_creator = "";
                $dev_assign = "";
                foreach($tickets as $ticket){
                    if($ticket['dev_assign'] != NULL){
                        $dev_assign = IDtoLogin($ticket['dev_assign'],$db);
                    }
                    else{
                        $dev_assign= "";
                    }
                    
                    if($ticket['user_id'] != NULL){
                        $ticket_creator = IDtoLogin($ticket['user_id'],$db);
                    }
                    else{
                        $ticket_creator == NULL; 
                    }

                    // Affichage du ticket

                    echo "<tr><td>". $ticket['id']."</td><td>". 
                    $ticket['title']."</td><td>". $ticket['tag']."</td><td>". 
                    $ticket['creation_date']."</td><td>". $ticket['ticket_desc']."</td><td>". 
                    $ticket_creator ."</td><td>". $ticket['ticket_status']."</td><td>". 
                    $ticket['ticket_priority']."</td><td>". $dev_assign."</td><td>". 
                    $ticket['assign_date']."</td><td>". $ticket['resolution_date']."</td><td>". $ticket['dev_comment']."</td></tr>";};
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="ticket-modification">
    <div class="ticket-modification-content">
    <?php 
                $sql='SELECT * FROM sae203_users WHERE status = 1';
                $requete = $db->prepare($sql);           // programme récupérant les informations
                $requete->execute();                     // de la table "sae203_users" et les attribue a la variable $users
                $devs = $requete->fetchall();

                $sql='SELECT id, title FROM sae203_tickets';
                $requete2 = $db->prepare($sql);           // programme récupérant les informations
                $requete2->execute();                     // de la table "sae203_users" et les attribue a la variable $users
                $tickets_info = $requete2->fetchall();

                $sql='SELECT ticket_status FROM sae203_tickets';
                $requete3 = $db->prepare($sql);           // programme récupérant les informations
                $requete3->execute();                     // de la table "sae203_users" et les attribue a la variable $users
                $tickets_status = $requete3->fetchall();

?>
        <h2>Attribution et priorité du ticket</h2>
        <p>Dans le cas d'un rejet du ticket, il faut quand même compléter le formulaire mais les informations d'assignation et de priorité ne seront pas prise en compte.</p>
        <form action="ticket_modification.php" method="post">
            <label for="ticket_selection">Quel ticket souhaiter-vous modifier ? </label>
            <select name="ticket_selection" id="ticket_selection">
            <?php
                foreach ($tickets_info as $ticket_info) {
                    echo "<option value='".$ticket_info['id']."'>".$ticket_info['id']." : ".$ticket_info['title']."</option>";
                }?>
            </select>
            <br>
            <label for="ticket_status"><br>Changement de statut du ticket </label>
            <select name="ticket_status" id="ticket_status">
            <option value="En cours de traitement">En cours de traitement</option>
            <option value="Rejeté">Rejeté</option>
        </select>
        <br>
            <label for="dev_assign"><br>Assignez un développeur </label>
            <select name="dev_assign" id="dev_assign">
                <?php
                foreach ($devs as $dev) {
                    echo "<option value='".$dev['id']."'>".$dev['login']."</option>";
                }?>
        </select>
        <br>
        <label for="ticket_priority">Priorité de traitement du ticket</label>
        
            <input type="radio" name="ticket_priority" value="1" required></input>
            <label for="ticket_priority">1</label>
            <input type="radio" name="ticket_priority" value="2" required></input>
            <label for="ticket_priority">2</label>
            <input type="radio" name="ticket_priority" value="3" required></input>
            <label for="ticket_priority">3</label>
            <input type="radio" name="ticket_priority" value="4" required></input>
            <label for="ticket_priority">4</label>
            <input type="radio" name="ticket_priority" value="5" required></input>
            <label for="ticket_priority">5</label>
        <br>
        <input type="submit" value="Modifier">
    </form>
    </div>
</div>
</body>
</html>
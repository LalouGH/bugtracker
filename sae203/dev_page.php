<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page des développeurs</title>
    <link rel="stylesheet" href="src/styles/style_dev.css">
    <link rel="icon" type="image/x-icon" href="src/fav1.ico">
    <?php include('connect_bdd.php');
     session_start();
     ?>
     <?php if($_SESSION['status'] == "0"){
        header('Location: admin_page.php');
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
    <h1>Page des développeurs</h1>
</body>
</html>
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
                        <th>Créateur du ticket</th>
                        <th>Statut</th>
                        <th>Priorité</th>
                        <th>Date d'assignation</th>
                        <th>Date de résolution</th>
                        <th>Commentaire</th>
                        <th>Gestion</th>
                    </tr>
            </thead>
            <tbody>
                
            <?php
            $user_id = $_SESSION['user_id'];
            $sql="SELECT * FROM sae203_tickets WHERE dev_assign = $user_id";
            $requete= $db->prepare($sql);
            $requete->execute();
            $tickets = $requete->fetchall();

            foreach($tickets as $ticket){
                           
                if($ticket['user_id'] != NULL){
                    $ticket_creator = IDtoLogin($ticket['user_id'],$db);
                }
                else{
                    $ticket_creator == NULL; // Cette ligne de code n'est pas censé se produire, on peut donc mettre "pas d'utilisateur à l'origine du ticket" mais cela est (je pense) impossible
                };
                $ticket_id = $ticket['id']; 
                echo "<tr><td><strong>". $ticket['id']."</strong></td><td>". 
                $ticket['title']."</td><td>". $ticket['tag']."</td><td>". 
                $ticket['creation_date']."</td><td>". $ticket['ticket_desc']."</td><td>". 
                $ticket_creator ."</td><td>". $ticket['ticket_status']."</td><td>". 
                $ticket['ticket_priority']."</td><td>". $ticket['assign_date']."</td><td>". 
                $ticket['resolution_date']."</td><td>". $ticket['dev_comment']."</td><td>"."<a class='ticket-link' href='ticket_dev_control.php?ticket_id=$ticket_id'>Modifier</a>"."</td></tr>";};
            ?>
            </tbody>
        </table>
    </div>
</div>  
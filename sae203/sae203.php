<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BugTracker - Connexion</title>
    <link rel="icon" type="image/x-icon" href="src/fav1.ico">
    <link rel="stylesheet" href="src/styles/style_auth.css">
    <?php include('connect_bdd.php');?>
</head>
<body>
  <header>
    <img src="src/logo_bugtracker.svg" alt="Logo" class="logo">
    <h1 class="title">Bug-Tracker</h1>
  </header>
<body>
    <br>
<?php 
$error_message = "";
    if (isset($_POST["username"]) && isset($_POST["password"])){
        $username = $_POST['username']; // attribue les informations saisie dans le formulaire à la variable $username
        $password = $_POST['password']; // attribue les informations saisie dans le formulaire à la variable $password

        //filtration pour eviter l'éxécution de script javascript et les balises html
        
        $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);

        $sql='SELECT * FROM sae203_users';
        $requete = $db->prepare($sql);           // programme récupérant les informations
        $requete->execute();                     // de la table "sae203_users" et les attribue a la variable $users
        $users = $requete->fetchall();

        foreach($users as $auth){
            if ($auth['login'] == $username){
                if ($auth['password'] == sha1($password)){
                    session_start();
                        $_SESSION['user_id'] = $auth['id'];
                        $_SESSION['login'] = $auth['login'];
                        $_SESSION['status'] = $auth['status'];

                    if ($auth['status'] == 0){ // 0 = statut du rôle d'administrateur, si le statut de l'utilisateur est égale à 0, il est redirigé vers la page administrateur
                        header('Location: admin_page.php');
                    }

                    if ($auth['status'] == 1){ // 1 = statut du rôle de développeur, si le statut de l'utilisateur est égale à 0, il est redirigé vers la page développeur
                        header('Location: dev_page.php');
                    }

                    if ($auth['status'] == 2){ // 2 = statut du rôle de testeur, si le statut de l'utilisateur est égale à 0, il est redirigé vers la page testeur
                        header('Location: tester_page.php');
                    }  
                    
                } 
                
            }      
        } 
        if ($auth['login'] !== $username && $auth['password'] !== sha1($password)){ // si un identifiant et mot de passe autre sont entrés, le message "Mot de passe incorrect" est affiché.
            $error_message = "<p>Mot de passe incorrect</p>";
        } 
    }
?>
<div class="authbox">

        <div class="authbox-content">
        <h2>Connexion</h2>
        <?php echo "$error_message"?>
        <form action="#" method="POST">
            <label for="login">Entrez votre identifiant</label>
            <input type="text" name="username" id="username" required>
            <label for="MDP">Entrez votre mot de passe</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Connexion">
        </form>
   </div>
</div>
</body>
</html>
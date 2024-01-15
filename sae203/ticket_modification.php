<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du ticket</title>
    <?php include ('connect_bdd.php')?>
    
    <?php session_start();
    if($_SESSION['status'] == "1"){
        header('Location: dev_page.php');
    }
    
    if($_SESSION['status'] == "2"){
        header('Location: tester_page.php');
    }?>
</head>
<body>
    <?php
    $ticket_selection = $_POST['ticket_selection'];
    $dev_assign = $_POST['dev_assign'];
    $assign_date = date('Y-m-d-H:i:s');
    $priority = $_POST['ticket_priority'];
    $resolution_date = "";
    $ticket_status = "";
    $dev_comment = "";
    if ($_POST['ticket_status'] == "En cours de traitement"){
        $ticket_status = "En cours de traitement";
        $resolution_date = NULL;
    }

    if ($_POST['ticket_status'] == "Rejeté"){
        $ticket_status = "Rejeté";
        $resolution_date = date('Y-m-d-H:i:s');
        $dev_assign = NULL;
        $priority = NULL;
        $dev_comment = "Rejeté par l'administrateur";
    }
    
    $sql='UPDATE sae203_tickets SET dev_assign = ?, ticket_priority = ?, assign_date = ?, ticket_status = ?, dev_comment=?, resolution_date = ? WHERE id = ?';
    $values = [$dev_assign, $priority, $assign_date, $ticket_status, $dev_comment, $resolution_date, $ticket_selection];
    $requete = $db->prepare($sql);   
    $requete->execute($values);   
    
    header('Location: admin_page.php');
    ?>  


    
</body>
</html>
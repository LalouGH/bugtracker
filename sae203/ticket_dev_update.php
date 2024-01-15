<?php session_start();  
if($_SESSION['status'] == "0"){
        header('Location: admin_page.php');
    }
    
    if($_SESSION['status'] == "2"){
        header('Location: tester_page.php');
    }?>

<?php
                include('connect_bdd.php');
                $ticket_id = $_SESSION['ticket_id'];
                $dev_comment = $_POST['dev_comment'];
                $resolution_date = NULL; 
                $ticket_status = $_POST['ticket_status'];

                if ($ticket_status == "En cours de traitement") {
                    $ticket_status = "En cours de traitement";
                    $resolution_date = NULL;
                    
                } 
                
                if ($ticket_status == "Rejeté" or $ticket_status == "Résolu") {
                    $ticket_status_update = $ticket_status;
                    $resolution_date = date('Y-m-d H:i:s');
                }
                                
                $sql='UPDATE sae203_tickets SET ticket_status = ?, dev_comment = ?, resolution_date = ? WHERE id = ?';
                $values = ["$ticket_status_update", "$dev_comment", "$resolution_date", "$ticket_id"];
                $requete = $db->prepare($sql);   
                $requete->execute($values);
                header('Location: dev_page.php');              
?>


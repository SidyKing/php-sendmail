<?php
    if(isset($_POST["submit"]) and !empty($_POST["submit"])){
        if(!empty($_POST["name"]) or !empty($_POST["email"]) or !empty($_POST["objet"]) or !empty($_POST["message"])){
            $name = test_input($_POST["name"]);
            $email = test_input($_POST["email"]);
            $objet = test_input($_POST["objet"]);
            $message = test_input($_POST["message"]);

            if(!filter_var($email.FILTER_VALIDATE_EMAIL)){
                $error = "Ceci n'est pas une adresse mail.";
            }
            else{
                $dest = $email;
                $sujet = $objet;
                $corp = "
                    Vous avez recu un message
                        Nom :".$name." 
                        Mail :".$email." 
                        Objet :".$objet." 
                        
                        ".nl2br($message)." ";
                $headers = "From: ".$email;
                if (mail($dest, $sujet, $corp, $headers)) {
                  $error= "Email envoye avec succes a $dest ...";
                } else {
                  $error= "Echec de l'envoi de l'email...";
                  }
            }
        }
        else{
            $error = "Vous devez completer tous les champs.";
        }
    }

    function test_input($data){
        $data= trim($data);
        $data= stripslashes($data);
        $data= htmlspecialchars($data);
        return $data;
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>PHP MAIL</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <style type="text/css">
    .container{
        margin-top : 60px;
    }
    </style>
</head>
<body>
    <h1 align="center" >ENVOIE DE MAIL AVEC PHP</br> <img   src="logo.jpg" width="300px"></h1>

    <div class="container">
        <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputName">Votre Nom</label>
            <input type="text" class="form-control" id="inputName" name="name" aria-describedby="emailHelp" placeholder="Sidy TRAORE">
    
        </div>
        <div class="form-group">
            <label for="inputEmail">Email du destinataire</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="exemple@exemple.com" name="email">
        </div>
        <div class="form-group">
            <label for="inputObjet">Objet de l'email</label>
            <input type="text" class="form-control" id="inputObjet" placeholder="demande d'emploie" name="objet">
        </div>
        <div class="form-group">
            <label for="txtarea">Votre Message</label>
            <textarea class="form-control" id="txtarea" placeholder="Bonjour..." rows="3" name="message"></textarea>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Envoyer">
        </form>
        <?php if(isset($_POST["submit"])){ echo $error;} ?>
    </div>
    
</body>
</html>
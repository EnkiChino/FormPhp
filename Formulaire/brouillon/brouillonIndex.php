
<?php 
    //name des input:
    //initialisation pour qu'à la premiere connexion toute ces variables soient vide
    //sera executé tout le temps
        // $firstName = $name = $email = $phone = $message = "";
        // $firstNameError = $nameError = $emailError = $phoneError = $messageError = "";
        // $isSuccess = false;
        // $emailTo = "Enkichino@gmail.com";
    // changeons toute ces variables pour les mettre dans un array
    // au dessus on faisait des variables, maintenannt firstName devient un élément de mon array
        //afin de passer dans mon AJAX un seul et meme objet, plus simple
    $array = array( "firstName" => "", "name" => "", "email" => "", "phone" => "","message" => "",
                    "firstNameError" => "", "nameError" => "", "emailError" => "", "phoneError" => "","messageError" => "",
                    "isSuccess" => "false");
    $emailTo = "Enkichino@gmail.com";// sauf l'email, pas besoin qu il passe dans le AJAX, il reste tout le temps comme ça


    //Maintenant je veux, que lorque un user arrive sur ma page les données soient vide, "".
    // mais si il revient alors qu il avait dejà sumbit son formulaire, se soit enregistré
    // if($_SERVER["REQUEST_METHOD"] == "POST")// dans ce cas c'est si le user à deja validé une fois le submit
    // s'executera que quand la request method sera POST
    if($_SERVER["REQUEST_METHOD"] == "POST")// dans ce cas c'est si le user à deja validé une fois le submit
    {
        // $firstName = verifyInput($_POST["firstName"]);
        // $name = verifyInput($_POST["name"]);
        // $email = verifyInput($_POST["email"]);
        // $phone = verifyInput($_POST["phone"]);
        // $message = verifyInput($_POST["message"]);
        // $isSuccess = true;
        // $emailText = "";
    // 
        $array["firstName"] = verifyInput($_POST["firstName"]);
        $array["name"] = verifyInput($_POST["name"]);
        $array["email"] = verifyInput($_POST["email"]);
        $array["phone"] = verifyInput($_POST["phone"]);
        $array["message"] = verifyInput($_POST["message"]);
        $array["isSuccess"] = true;
        $emailText = "";
            //maintenant validation du form coté serveur
            if(empty($firstName))// est-ce que le prénom est vide 
            {
                $firstNameError = "Hey, n'oublies pas de rentrer ton Prénom mon pote!!";
                $isSuccess = false;
            }
            else{
                $emailText = $emailText . "firstname: $firstName\n";
            }
            if(empty($name))// est-ce que le prénom est vide 
            {
                $nameError = "Hey, n'oublies pas de rentrer ton nom mon pote!!";
                $isSuccess = false;
            }
                $emailText .= "Name: $name\n";// pas besoin de rajouter le else quand 1 seule condittion
     
            if(!isEmail($email))// si ce n'est pas un email valide, si isEmail est different de $email
            {
                $emailError = "Ton email est bizzare :D";
                $isSuccess = false;
            }
            else{
                $emailText = "Email: $email\n";
            }
            // ordre condition mail
            if(empty($email))// est-ce que le prénom est vide 
            {
                $emailError = "Hey, et comment je te contacte si tu ne me laisses pas d'email :)";
                $isSuccess = false;
            }
            if(!isPhone($phone))
            {
                $phoneError = "Que des chiffres ou espaces please man";
                $isSuccess = false;
            }
            else{
                $emailText = "Téléphone: $phone\n";
            }
            if(empty($message))// est-ce que le message est vide 
            {
                $messageError = "Ecris moi un p'tit mot mon lou avant de partir ;)";
                $isSuccess = false;
            }
            else{
                $emailText = "Message: $message\n";
            }
            if($isSuccess)
            {  
                $headers = "From: $firstName $name <$email> \r\nReply-To: $email";
                // $header = de qui vient cet email, à qui répondre quand on appui sur répondre 
                //\r\n = pour aller à la ligne
                mail($emailTo, "Un message pour Enki le Génie", $emailText, $headers);
                $firstName = $name = $email = $phone = $message = "";// lorsque l' email est envoyé, on vide tout
            }

    }
    function isPhone($var)
    {
        return preg_match("/^[0-9 ]*$/", $var);
    }
    function isEmail($var)// le $var = $email
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);//compare notre $var au FILTER_VALIDATE_EMAIL pour verifier si c'est un email valide
    }
//A la 1ere instance, les champs sont vide avec $firstName = "" --> string vide
    // sauf si par exemple dans le champ value du $name, j'ai concaténé le mot test value="<?php echo $name . 'test';>" --> ici la value ne sera plus vide des le debut
// dès lors que le user appuies sur submit, àa met en place le if($_SERVER["REQUEST_METHOD"] == "POST")
    // qui à partir de là enregistre les informations $_POST["firstName"] entrées.

    //SECURITE: Ci dessous pour verifier nos input 
    // {
    //     $firstName = verifyInput($_POST["firstName"]);
    //     $name = verifyInput($_POST["name"]);
    //     $email = verifyInput($_POST["email"]);
    //     $phone = verifyInput($_POST["phone"]);
    //     $message = verifyInput($_POST["message"]);

    // }
//SECURITE: Ci dessous pour verifier nos input 
//permet de nettoyer ce qui est entré dans les inputs
        function verifyInput($var)
        {
            $var = trim($var);// evite de pouvoir rajouter des espaces
            $var = stripslashes($var);// enleve les antislash
            $var = htmlspecialchars($var);

            return $var;
        }

?>





<!DOCTYPE html>
<html>
    <head>
        <title>Contactez-moi</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <!-- Optional theme -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">

    </head>

    <body>
<!--class="container" ne prends pas toute la page, et permet une responsivité-->
        <div class="container">
            <div class="border-orange"></div>
            <div class="heading">
                <h2>Contactez-moi</h2>
            </div>
            <div class="row">
<!--offset permet d'avoir un espace égale de chaques cotés du container sur toute les plateforme-->
                <div class="col-lg-10 col-lg-offset-1">
<!--method="POST" plus souvent utilé que GET, dans la barre de recherche, les informations ne sont pas visibles-->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="contact-form" role="form">
<!--SECURITE:Pour eviter faille xss rajouter <php echo "htmlspecialchars"($_SERVER["PHP_SELF"]);?>-->
                    <!--Faille xss http://localhost:8888/Formulaire/index.php/"><script>alert('hey')</script>-->
<!--1 ere rangée Nom et prenom-->
                        <div class="row">
                            <!--NOM-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="firstName">Prénom<span class="red"> *</span></label>
                                <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Votre prénom" value="<?php echo $firstName;?>">
                                <p class="comments"><?php echo $firstNameError;?></p><!--message error-->
                            </div>
                            <!--PRENOM-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="name">Nom<span class="red"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="<?php echo $name;?>">
                                <!-- Dans la value,j'integre du code php qui lorsque le user entrera et validera le form, sera enregistré en POST -->
                                <p class="comments"><?php echo $nameError;?></p><!--message error-->
                            </div>
<!--2 eme rangée email et telephone-->
                            <!--EMAIL-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="email">Email<span class="red"> *</span></label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Votre email" value="<?php echo $email;?>">
                                <!-- Dans la value,j'integre du code php qui lorsque le user entrera et validera le form, sera enregistré en POST -->

                                <p class="comments"><?php echo $emailError;?></p><!--message error-->
                            </div>
                            <!--TELEPHONE-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="phone">Téléphone<!--<span class="red"> *</span>--></label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre numéro de téléphone" value="<?php echo $phone;?>">
                                <!-- Dans la value,j'integre du code php qui lorsque le user entrera et validera le form, sera enregistré en POST -->
                                <p class="comments"><?php echo $phoneError;?></p>
                            </div>
<!--3 eme rangée zone de text-->
                            <!--ZONE DE TEXTE-->
                            <div class="col-md-12"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="message">Message<span class="red"> *</span></label>
                                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Votre message" ><?php echo $message;?></textarea><!--pas besoin de nombre de colonne vu qu il prend toute la place-->
                                <!-- Dans un texte area le php est ajouter non pas dans uen value mais le texte lui meme-->
                                <p class="comments"><?php echo $messageError;?></p><!--message error-->
                            </div>
<!--4 eme rangée phrase pour parler des infos requis-->
                            <!--PHRASE * REQUISE-->
                            <div class="col-md-12"><!--la valeur du for du label doit etre identique au id du input-->
                                <p class="infoRequired"><span class="red"> * </span>Ces informations sont requises</p>
                            </div>
<!--5 eme rangée boutton submit-->
                            <!--BOUTTON SUBMIT-->
                            <div class="col-md-12"><!--la valeur du for du label doit etre identique au id du input-->
                                <input type="submit" class="button1" value="Envoyer">
                                <!-- Lors de la validation du formulaire, cela execute une 2 eme instance avec action="<<php echo $_SERVER["PHP_SELF"];?>" -->
                                <!-- j'entrerai alors dans le if du php du début et les informations entrées dans le form sont stockées-->
                            </div>
                        </div>

                        <p class="thank-you" style="display:<?php if($isSuccess) echo 'block'; else echo 'none'; ?>">Votre message à bien été envoyé, merci de m'avoir contacté  :-)</p>
                        <!--display permet de le rendre invisible, contrairement à display:block-->
                        <!-- si le $isSuccess est true alors display:block pour voir le message, si false alors display:none -->
                        
                    </form>
                </div>
            </div>

        </div>
    <!--partie Js download sur bootstrap-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="scripts/script.js"></script>
    </body>
</html>



<head>
        <title>Contactez-moi</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <!-- Optional theme -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">

    </head>


        <!--partie Js download sur bootstrap-->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="scripts/script.js"></script>



    //javascript

$(function()
{
    $('#contact-form').submit(function(e)//Lorque l' on soumet(bouton submit) contact-form alors il se passe ce qu il y a dans cette fonction event
    {   //prevent default: je veux avec le POST pouvoir changer ce qu il y a dans mon #contact-form
        e.preventDefault();// enleve le comportement par defaut (le defaut étant de passer par une autre page là je ne veux pas)
        $('.comments').empty();// remettre tout les comments à 0 lors du submit
        var postdata = $('#contact-form').serialize();//prends tout les infos qui sont dans #contact-form et les mettre dans la var postdata
        //partie AJAX
            //On prend les infos de notre formulaire
            //On les envoie à un fichier externe de PHP
            //Qui va traiter ces infos
            //Nous renvoyer de l' information
            //Et avec ce resultat de l'information on va mettre à jour les élements html et css
            //Dans le meme page (celle du #contact-form)
                //Affichage
        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postdata,
            dataType: 'json',
            success: function (result) 
            {
                if(result.isSuccess) // si le resultat de isSuccess est true
                {
                    //je rajoute append la phrase de remerciement
                    $("#contact-form").append("<p class='thank-you'>Votre message à bien été envoyé, merci de m'avoir contacté  :-)</p>");
                    // je fais un reset de tout les élément du #contact-form ( string = "")
                    $("#contact-form")[0].reset();
                }
                else
                {
                    // la je sélectionne avec + le comment qui faitparti de #fistName et je mets dans le html le resuktat.firstNameError
                    $("#firstName + .comments").html(result.firstNameError);
                    $("#name + .comments").html(result.nameError);
                    $("#email + .comments").html(result.emailError);
                    $("#phone + .comments").html(result.phoneError);
                    $("#message + .comments").html(result.messageError);
                }   
            }
        });
    })
})
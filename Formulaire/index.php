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
                    <form action="" method="post" id="contact-form" role="form">
<!--SECURITE:Pour eviter faille xss rajouter <php echo "htmlspecialchars"($_SERVER["PHP_SELF"]);?>-->
                    <!--Faille xss http://localhost:8888/Formulaire/index.php/"><script>alert('hey')</script>-->
<!--1 ere rangée Nom et prenom-->
                        <div class="row">
                            <!--NOM-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="firstName">Prénom<span class="red"> *</span></label>
                                <input type="text" id="firstName" name="firstName" class="form-control" placeholder="Votre prénom" value="">
                                <p class="comments"></p><!--message error-->
                            </div>
                            <!--PRENOM-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="name">Nom<span class="red"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" value="">
                                <!-- Dans la value,j'integre du code php qui lorsque le user entrera et validera le form, sera enregistré en POST -->
                                <p class="comments"><!--message error-->
                            </div>
<!--2 eme rangée email et telephone-->
                            <!--EMAIL-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="email">Email<span class="red"> *</span></label>
                                <input type="text" id="email" name="email" class="form-control" placeholder="Votre email" value="">
                                <!-- Dans la value,j'integre du code php qui lorsque le user entrera et validera le form, sera enregistré en POST -->

                                <p class="comments"></p><!--message error-->
                            </div>
                            <!--TELEPHONE-->
                            <div class="col-md-6"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="phone">Téléphone<!--<span class="red"> *</span>--></label>
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Votre numéro de téléphone" value="">
                                <!-- Dans la value,j'integre du code php qui lorsque le user entrera et validera le form, sera enregistré en POST -->
                                <p class="comments"></p>
                            </div>
<!--3 eme rangée zone de text-->
                            <!--ZONE DE TEXTE-->
                            <div class="col-md-12"><!--la valeur du for du label doit etre identique au id du input-->
                                <label for="message">Message<span class="red"> *</span></label>
                                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Votre message" ></textarea><!--pas besoin de nombre de colonne vu qu il prend toute la place-->
                                <!-- Dans un texte area le php est ajouter non pas dans uen value mais le texte lui meme-->
                                <p class="comments"></p><!--message error-->
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
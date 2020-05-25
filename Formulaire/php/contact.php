


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
        // changer toute les variables du dessous par le array maintenant crée
            //ex: $isSuccess = false; devient $array["isSuccess"] = true;
            //maintenant validation du form coté serveur
            if(empty($array["firstName"]))// est-ce que le prénom est vide 
            {
                $$array["firstNameError"] = "Hey, n'oublies pas de rentrer ton Prénom mon pote!!";
                $array["isSuccess"] = false;
            }
            else{
                $emailText = $emailText . "Firstname: {$array["firstName"]}\n";//les accolades spécifi à php que c'est uen variable
            }
            if(empty($array["name"]))// est-ce que le prénom est vide 
            {
                $$array["name"] = "Hey, n'oublies pas de rentrer ton nom mon pote!!";
                $array["isSuccess"] = false;
            }
                $emailText .= "Name: {$array["name"]}\n";// pas besoin de rajouter le else quand 1 seule condittion
     
            if(!isEmail($array["email"]))// si ce n'est pas un email valide, si isEmail est different de $email
            {
                $$array["emailError"] = "Ton email est bizzare :D";
                $array["isSuccess"] = false;
            }
            else{
                $emailText = "Email: {$array["email"]}\n";
            }
            // ordre condition mail
            if(empty($array["email"]))// est-ce que le prénom est vide 
            {
                $$array["emailError"] = "Hey, et comment je te contacte si tu ne me laisses pas d'email :)";
                $array["isSuccess"] = false;
            }
            if(!isPhone($array["phone"]))
            {
                $$array["phoneError"] = "Que des chiffres ou espaces please man";
                $array["isSuccess"] = false;
            }
            else{
                $emailText = "Téléphone: {$array["phone"]}\n";
            }
            if(empty($array["message"]))// est-ce que le message est vide 
            {
                $$array["messageError"] = "Ecris moi un p'tit mot mon lou avant de partir ;)";
                $array["isSuccess"] = false;
            }
            else{
                $emailText = "Message: {$array["message"]}\n";
            }
            if($array["isSuccess"])
            {  
                $headers = "From: {$array["firstName"]} {$array["name"]} <{$array["email"]}> \r\nReply-To: {$array["firstName"]}";
                // $header = de qui vient cet email, à qui répondre quand on appui sur répondre 
                //\r\n = pour aller à la ligne
                mail($emailTo, "Un message pour Enki le Génie", $emailText, $headers);
                // $firstName = $name = $email = $phone = $message = "";// inutile maintenant lorsque l' email est envoyé, on vide tout
            }
        // A la fin de ce script PHP if($_SERVER["REQUEST_METHOD"] == "POST")
            //avec l'élément du script js success: function (result)
                // pour renvoyer le resultat Json
        echo json_encode($array);// permet de renvoyer tout ce qui est fait avec PHP
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
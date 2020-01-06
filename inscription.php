<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
<?php require ("nav.php"); ?>
</header>
    <main>
        <?php
        $login = NULL;
        $password = NULL;
        
        if (empty($_SESSION['login'])) {
            ?>
            <div class="form-style-connexion">
            <form action="" method="post">
            <input placeholder="Pseudo" type="text" name="login" required/>
        
        <input placeholder="Mot de passe" type="password" name="password" required/>
 
        <input placeholder="Confirme ton mot de passe" type="password" name="cpassword" required/>
   
<input class="submit" type="submit" name="inscription" value="Inscription">
            </form>
        </div> 
        <?php
        
        
            if (isset($_POST['inscription'])) {
                $login = $_POST['login'];
                $password= password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost' => 8));
        
                if($_POST['password'] != $_POST['cpassword'])
                {
                    ?>
                    <div class="error">
                        <span>
                           Your password and confirmed password doesn't match
                     </span>
                     </div>
                     <?php
                }
                else{
        
                
                $connexion = mysqli_connect("localhost","root","","discussion");
                $requete = "SELECT login FROM utilisateurs WHERE login = '".$login."'";
                $query = mysqli_query($connexion, $requete);
                $resultat = mysqli_fetch_array($query);
        
                if(!empty($resultat))
                {
                    ?>
                    <div class="error">
                        <span>
                           Ton pseudo est déjà pris par un membre de la famille bro !
                     </span>
                     </div>
                     <?php
                }
                else
                {
                    $requete2 = "INSERT INTO utilisateurs(login, password) VALUES (\"$login\",\"$password\")";
                    $query = mysqli_query($connexion, $requete2);
                    header("location:connexion.php");
                }
            }
             
            }
        }
        else
        {
            ?>
            <div class="error">
                <span>
                   Tu fais déjà partie de la famille !
             </span>
             </div>
             <?php
        }
        
        ?>
        </main>
        <footer>
<?php require ("footer.php"); ?>
    </footer>
        </body>
        </html>
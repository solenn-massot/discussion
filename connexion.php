<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
<?php require ("nav.php"); ?>
</header>
    <main>
        <?php
    if(empty($_SESSION['login']))
{
    ?>
<div class="form-style-connexion">
<form action="connexion.php" method="post">
    <input placeholder="Pseudo" type="text" name="login" value="" required />
     
   <input placeholder="Mot de passe" type="password" name="password" value="" required/>
     
    <input class="submit" type="submit" name="connexion" value="Connexion" />
</form>
</div>
<?php
if(isset($_POST['connexion']))
{
    if(empty($_POST['login']))
    {
        ?>
        <div class="error">
        <span>
           Rentre ton pseudo fréro !
     </span>
     </div>
     <?php
    }
    else
    {
        if(empty($_POST['password']))
        {
            ?>
                <div class="error">
                <span>
                  Rentre ton mot de passe bécasse !
             </span>
             </div>
             <?php
        }
        else
        {
            $login = $_POST['login'];
            $connexion = mysqli_connect("localhost","root","","discussion");
            if(!$connexion)
            {
                ?>
                <div class="error">
                <span>
                   Une erreur s'est produite, réessaye plus tard. En attendant, tu peux aller écouter notre musique !
             </span>
             </div>
             <?php
            }
            else
            {
                $requete = "SELECT login, password FROM utilisateurs WHERE login = '".$login."'";
                $query = mysqli_query($connexion, $requete);
                $resultat = mysqli_fetch_array($query);

                if(!empty($resultat))
                {   
                    if ($_POST['login'] == $resultat['login'])
                    {
                    if (password_verify($_POST['password'], $resultat['password']))
                    {
                        $_SESSION['login'] = $_POST['login'] ;
                        $_SESSION['password'] = $_POST['password'] ;
                        header("location:index.php");
                    }
                    else
                    {
                       ?>
                       <div class="error">
                       <span>
                           Ya un soucis avec ton mot de passe ma biche !
                    </span>
                    </div>
                    <?php
                    }
                }
                }
                else
                {
                    ?>
                    <div class="error">
                    <span>
                        Ya un problème avec ton pseudo mon beau !
                 </span>
                    </div>
                 <?php
                }
                
            }
        }
    }
}


}
else{
    ?>
    <div class="error">
        <span>
            T'es déjà connecté
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

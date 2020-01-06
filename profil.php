<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
<?php require ("nav.php"); ?>
</header>
    <main>
        <?php
        if(!empty($_SESSION['login']))
        {
        $login = $_SESSION['login'];
        $password = $_SESSION['password'];
        
        
        ?>
        <div class="form-style-connexion">
        <form action="profil.php" method="post">
                Pseudo: <input placeholder="<?php echo"$login"?>" type="text" name="login" value="" required/>
        
                Mot de passe: <input type="password" name="password" value="" required/>
        
                Confirme ton mot de passe : <input type="password" name="cpassword" value="" required/>
        
                <input type="submit" name="connexion" value="Connexion" />
            </form>
        </div>
        
        <?php
        
        if(isset($_POST['connexion']))
        {
            $newlogin = $_POST['login'];
            $newpassword = $_POST['password'];
            if($_POST['password'] != $_POST['cpassword'])
            {
                ?>
            <div class="error">
                        <span>
                          Tes mots de passe ne sont pas les mêmes !
                     </span>
                     </div>
                     <?php
            }
            else
    {
        $connexion = mysqli_connect("localhost","root","","discussion");
        $requete = "SELECT login FROM utilisateurs WHERE login = \"$newlogin\"";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);

        if(empty($resultat))
        {
            $requete2 = "SELECT * FROM utilisateurs WHERE login = \"$login\"";
            $query2 = mysqli_query($connexion, $requete2);
            $resultat2 = mysqli_fetch_assoc($query2);
            $id = $resultat2['id'];
            $update = "UPDATE utilisateurs SET login =\"$newlogin\", password = \"$newpassword\" WHERE id = \"$id\"";
            $query3 = mysqli_query($connexion, $update);
            $_SESSION['login'] = $newlogin ; 
            $_SESSION['password'] = $newpassword;
            header("location:profil.php");
        }
                else
                {
                    ?>
            <div class="error">
                        <span>
                           Le pseudo est déjà pris, sorry !
                     </span>
                     </div>
                     <?php
                }
            }
        }
        }
        else
        {
            ?>
            <div class="error">
                        <span>
                           Tu dois faire partie de la HxC family pour voir cette page !
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
        